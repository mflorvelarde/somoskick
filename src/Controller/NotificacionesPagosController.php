<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 6/2/17
 * Time: 4:41 AM
 */

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;


class NotificacionesPagosController extends AppController{


    /**
     * Index method
     * @return \Cake\Network\Response|null
     */
    public function index() {
//        $notificacionesPagos = $this->paginate($this->NotificacionesPagos);
//
//        $this->set(compact('notificacionesPagos'));
//        $this->set('_serialize', ['notificacionesPagos']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $notificacionesPagos = $this->NotificacionesPagos->get($id);

        $this->set('colegio', $notificacionesPagos);
        $this->set('_serialize', ['notificacionesPagos']);
    }

    public function viewnotifications($cuotaAplicadaID) {
        $userID = $this->Auth->user('id');
        if ($this->isClient($userID)) {
            $this->viewBuilder()->layout('ajax');
            $notificacionesQuery = $this->NotificacionesPagos->find('all', ['contain' => ['Diccionarios']])
                ->where(['notificacion_pago_eliminado' => 0,
                    'cuota_aplicada_id' => $cuotaAplicadaID
                ]);
            $notificaciones = $this->paginate($notificacionesQuery);

            foreach ($notificaciones as $notificacion) {
                if ($notificacion->monto_pesos != 0 && !is_null($notificacion->monto_pesos)) {
                    $notificacion->moneda = "ARS";
                    $notificacion->monto = $notificacion->monto_pesos;
                } else {
                    $notificacion->moneda = "US$";
                    $notificacion->monto = $notificacion->monto_dolares;
                }
            }

            $this->set('notificaciones', $notificaciones);
            $this->set('_serialize', ['notificaciones']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function add($cuotaAplicadaID) {
        $userID = $this->Auth->user('id');
        if ($this->isClient($userID)) {
            $this->viewBuilder()->layout('ajax');
            $notificacion = $this->NotificacionesPagos->newEntity();
            $this->request->data['cuota_aplicada_id'] = $cuotaAplicadaID;
    //        $notificacion->cuota_aplicada_id = $cuotaAplicadaID;
            if ($this->request->is('post')) {
                $requestData = $this->request->data;

                if (strcmp($requestData["moneda"], "dolares")) $notificacion->monto_dolares = $requestData["monto_pesos"];
                else $notificacion->monto_pesos = $requestData["monto_pesos"];

                $fechaPago = $requestData["fecha_pago"];
                $notificacion->fecha_pago = Time::create($fechaPago["year"], $fechaPago["month"], $fechaPago["day"]);
                $notificacion->cuota_aplicada_id = $cuotaAplicadaID;

                if (strcmp($requestData["paymentType"], "deposito")) {
                    $notificacion->medio_pago = "deposito";
                    $notificacion->medio_deposito = $requestData["tipoDeposito"];
                    $notificacion->banco = $requestData["banco"];
                    $notificacion->sucursal = $requestData["sucursal"];
                } else if (strcmp($requestData["paymentType"], "transferencia")) {
                    $notificacion->medio_pago = "transferencia";
                    $notificacion->cuit_cuil = $requestData["cuit"];
                    $notificacion->banco = $requestData["bancoDestino"];
                }

                $diccionarios = $this->getDiccionariosStatus();
                $status = 0;
                foreach ($diccionarios as $diccionario) {
                    if ($diccionario->param3 === "PENDIENTE") {
                        $status = $diccionario->id;
                        break;
                    }
                }

                $notificacion->status = $status;
                $notificacion->notificacion_pago_eliminado = 0;
                $notificacion->fecha_creacion = Time::now();
                $notificacion->usuario_creacion = $this->Auth->user('id');

                $this->NotificacionesPagos->save($notificacion);


                /*            $file = $requestData["submittedfile"];

                            $path = $file["tmp_name"] . "/" . $file["name"];
                            $fichero_subido = $path . basename($_FILES[$file["tmp_name"]][$file["name"]]);
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $data = file_get_contents($path);
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);*/

    //            $resultado = "";
    //            if (move_uploaded_file($_FILES[$file["tmp_name"]][$file["name"]], $fichero_subido)) {
    //                $resultado = "El fichero es válido y se subió con éxito.\n";
    //            } else {
    //                $resultado = "¡Posible ataque de subida de ficheros!\n";
    //            }


                //  $notificacion->comprobante = $base64;
    //            $colegio = $this->Colegios->patchEntity($colegio, $this->request->data);
    //            $colegio->usuario_creacion = $this->Auth->user('id');;
    //            $colegio->fecha_creacion = Time::now();
    //            $colegio->colegio_eliminado = 0;
    //
    //            if ($this->Colegios->save($colegio)) {
    //                $this->Flash->success(__('El colegio fue guardado'));
    //
    //                return $this->redirect(['action' => 'index']);
    //            }
    //            else {
    //                $this->Flash->error(__('El colegio no pudo ser guardado. Por favor, intente nuevamente'));
    //            }

                return $this->irCuotas();
            }
            $this->set(compact('resultado'));
            $this->set('_serialize', ['resultado']);
            $this->set(compact('fichero_subido'));
            $this->set('_serialize', ['fichero_subido']);
            $this->set(compact('requestData'));
            $this->set('_serialize', ['requestData']);
            $this->set(compact('notificacion'));
            $this->set('_serialize', ['notificacion']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function irCuotas() {
        return $this->redirect(
        ['controller' => 'CuotasAplicadas', 'action' => 'index']
        );
    }

    private function getDiccionariosStatus() {
        return TableRegistry::get('Diccionarios')->find('all')->where(['param1' => "NOTIFICACION_PAGO", 'param2' => "STATUS"]);
    }
}