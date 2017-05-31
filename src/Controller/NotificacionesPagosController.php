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

    public function index() {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $idsCuotas = array();

            $notificacionesQuery = $this->NotificacionesPagos->find('all', ['contain' => ['Diccionarios', 'CuotasAplicadas'
            => ['Pasajerosdegrupos' => ['Pasajeros' => ['Personas']], 'Cuotas' => ['TarifasAplicadas' => ['Tarifas']]]]])
                ->where(['notificacion_pago_eliminado' => 0]);
            $notificaciones = $this->paginate($notificacionesQuery);

            $statusList = $this->getDiccionariosStatus();
            foreach ($notificaciones as $notificacion) {
                foreach ($statusList as $status) {
                    if ($notificacion->status == $status->id) {
                        if ($status->param3 === "PENDIENTE") {
                            $notificacion->statusNotif = "<span class=\"label label-info\">Pendiente de revisión</span>";
                        } else if ($status->param3 === "RECHAZADA") {
                            $notificacion->statusNotif = "<span class=\"label label-danger\">Rechazada</span>";
                        } else if ($status->param3 === "ACREDITADA") {
                            $notificacion->statusNotif = "<span class=\"label label-success\">Pago acreditado</span>";
                        } else if ($status->param3 === "CANCELADA") {
                            $notificacion->statusNotif =  "<span class=\"label label-warning\">Cancelada</span>";
                        }
                    }
                }

            }
            $this->set('_serialize', ['notificaciones']);
            $this->set(compact('notificaciones'));
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function view($id = null) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $notificacion = $this->NotificacionesPagos->get($id, ['contain' => [
                'Diccionarios',
                'CuotasAplicadas' => ['Cuotas', 'Pasajerosdegrupos' => ['Grupos','Pasajeros' => ['Personas']]
                ]
            ]]);

            $cuota = $notificacion->cuotas_aplicada->cuota;

            if ($cuota->monto_pesos != 0 && !is_null($cuota->monto_pesos)) {
                $cuota->moneda = "ARS";
                $cuota->monto = $cuota->monto_pesos;
            } else {
                $cuota->moneda = "US$";
                $cuota->monto = $cuota->monto_dolares;
            }

            if ($notificacion->monto_pesos != 0 && !is_null($notificacion->monto_pesos)) {
                $notificacion->moneda = "ARS";
                $notificacion->monto = $notificacion->monto_pesos;
            } else {
                $notificacion->moneda = "US$";
                $notificacion->monto = $notificacion->monto_dolares;
            }

            $this->set('cuota', $cuota);
            $this->set('notificacion', $notificacion);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function viewnotifications($cuotaAplicadaID) {
        $userID = $this->Auth->user('id');
        if ($this->isClient($userID)) {
            $this->viewBuilder()->layout('clientsLayout');
            $notificacionesQuery = $this->NotificacionesPagos->find('all', ['contain' => ['Diccionarios']])
                ->where(['notificacion_pago_eliminado' => 0,
                    'cuota_aplicada_id' => $cuotaAplicadaID
                ]);
            $notificaciones = $this->paginate($notificacionesQuery);
            $filesTable = TableRegistry::get('files');
//            $comprobante = "https://placeholdit.imgix.net/~text?txtsize=28&txt=300%C3%97300&w=300&h=300";
            $ids = array();
            foreach ($notificaciones as $notificacion) {
                if ($notificacion->monto_pesos != 0 && !is_null($notificacion->monto_pesos)) {
                    $notificacion->moneda = "ARS";
                    $notificacion->monto = $notificacion->monto_pesos;
                } else {
                    $notificacion->moneda = "US$";
                    $notificacion->monto = $notificacion->monto_dolares;
                }
                array_push($ids, $notificacion->comprobante);
            }
            $comprobantes = $filesTable->find('all')->where(['id IN ' => $ids, 'status' => 1]);
            foreach ($notificaciones as $notificacion) {
                foreach ($comprobantes as $comprobante) {
                    if ($notificacion->comprobante == $comprobante->id) {
                        if ($comprobante->extension === "pdf") {
//                            $notificacion->vercomprobante = "";
//                            $notificacion->vercomprobante = ".$.this->Html->link(__('Ver comprobante'), ['action' => 'vercomprobante',"
//                            . $comprobante->id . "] , array('class'=>'btn btn-block btn-primary btn-xs') )";
                        } else {
                            $notificacion->vercomprobante = "<img style='max-width: 100%' src='data:image/png;base64,"
                                . $comprobante->contenido . "'/>";
                        }
                        $notificacion->fileComprobante = $comprobante;
                    }
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

    public function vercomprobante($idComprobante) {
        $userID = $this->Auth->user('id');
        if ($userID) {
            $this->viewBuilder()->layout('ajax');
            $filesTable = TableRegistry::get('Files');
            $file = $filesTable->find()
                ->where(['id' => $idComprobante, 'status' => 1])
                ->first();
            $this->response->file("data:application/pdf;base64," . $file->contenido);
   //         $this->response->file(base64_decode($file->contenido));
            $this->response->header('Content-Disposition', 'inline');
            return $this->response;
        //    $this->set('file', base64_decode($file->contenido));
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function verNotificacionesPasajero($cuotaAplicadaID) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $notificacionesQuery = $this->NotificacionesPagos->find('all', ['contain' => [
                'Diccionarios',
                'CuotasAplicadas' => ['Cuotas', 'Pasajerosdegrupos' => ['Grupos','Pasajeros' => ['Personas']]]]])
                ->where(['notificacion_pago_eliminado' => 0,
                    'cuota_aplicada_id' => $cuotaAplicadaID
                ]);

            /*            $notificacion = $this->NotificacionesPagos->get($id, ['contain' => [
                'Diccionarios',
                'CuotasAplicadas' => ['Cuotas', 'Pasajerosdegrupos' => ['Grupos','Pasajeros' => ['Personas']]
                ]
            ]]);*/
            $notificaciones = $this->paginate($notificacionesQuery);

            foreach ($notificaciones as $notificacion) {
                if ($notificacion->cuotas_aplicada->cuota->monto_pesos != 0 &&
                    !is_null($notificacion->cuotas_aplicada->cuota->monto_pesos)) {
                    $notificacion->cuotas_aplicada->cuota->moneda = "ARS";
                    $notificacion->cuotas_aplicada->cuota->monto = $notificacion->cuotas_aplicada->cuota->monto_pesos;
                } else {
                    $notificacion->cuotas_aplicada->cuota->moneda= "US$";
                    $notificacion->cuotas_aplicada->cuota->monto= $notificacion->cuotas_aplicada->cuota->monto__dolares;
                }

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
            $this->viewBuilder()->layout('clientsLayout');
            $notificacion = $this->NotificacionesPagos->newEntity();
            $this->request->data['cuota_aplicada_id'] = $cuotaAplicadaID;
    //        $notificacion->cuota_aplicada_id = $cuotaAplicadaID;
            if ($this->request->is('post')) {
                $requestData = $this->request->data;

                if ($requestData["moneda"] === "dolares") $notificacion->monto_dolares = $requestData["monto_pesos"];
                else $notificacion->monto_pesos = $requestData["monto_pesos"];

                $fechaPago = $requestData["fecha_pago"];
                $notificacion->fecha_pago = Time::create($fechaPago["year"], $fechaPago["month"], $fechaPago["day"]);
                $notificacion->cuota_aplicada_id = $cuotaAplicadaID;

                if (strcmp($requestData["paymentType"], "deposito") == 0) {
                    $notificacion->medio_pago = "deposito";
                    $notificacion->medio_deposito = $requestData["tipoDeposito"];
                    $notificacion->banco = $requestData["banco"];
                    $notificacion->sucursal = $requestData["sucursal"];
                    $notificacion->numero_sobre = $requestData["numero_sobre"];
                    $notificacion->numero_transaccion = $requestData["numero_transaccion"];

                } else if (strcmp($requestData["paymentType"], "transferencia") == 0) {
                    $notificacion->medio_pago = "transferencia";
                    $notificacion->cuit_cuil = $requestData["cuit"];
                    $notificacion->banco = $requestData["bancoDestino"];
                    $notificacion->numero_comprobante = $requestData["numero_comprobante"];
                }

                $diccionarios = $this->getDiccionariosStatus();
                $status = 0;
                foreach ($diccionarios as $diccionario) {
                    if ($diccionario->param3 === "PENDIENTE") {
                        $status = $diccionario->id;
                        break;
                    }
                }
//
//                $data = $this->request->data['file']['tmp_name'];
//                $base64 = base64_encode(file_get_contents($data));
//
//
//                $fileTable = TableRegistry::get('files');
//                $file = $fileTable->newEntity();
//                $file->contenido = $base64;
//                $fileResult = $fileTable->save($file);
//                $idFile = $fileResult->id;
//
//                if ($this->request->data['file']['type'] === "application/pdf") {
//                    $file->extension = "pdf";
//                } else {
//                    $file->extension = "png";
//                }

                $notificacion->status = $status;
                $notificacion->notificacion_pago_eliminado = 0;
                $notificacion->fecha_creacion = Time::now();
                $notificacion->usuario_creacion = $this->Auth->user('id');
//                $notificacion->comprobante = $idFile;
//
                $this->NotificacionesPagos->save($notificacion);
//
                return $this->irCuotas();
            }
            $this->set(compact('cuotaAplicadaID'));
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

    public function pendientes() {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $idsCuotas = array();
            $statusPendiente = $this->getStatusPendiente();

            $notificacionesQuery = $this->NotificacionesPagos->find('all', ['contain' => ['Diccionarios', 'CuotasAplicadas'
                => ['Pasajerosdegrupos' => ['Pasajeros' => ['Personas']],'Cuotas' => ['TarifasAplicadas' => ['Tarifas']]]]])
                ->where(['status' => $statusPendiente, 'notificacion_pago_eliminado' => 0]);

            $notificaciones = $this->paginate($notificacionesQuery);

            $this->set(compact('notificaciones'));
            $this->set('_serialize', ['notificaciones']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function acreditar($idNotificacion, $return) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $notificacion = $this->NotificacionesPagos->get($idNotificacion);
            $notificacion->status = $this->getStatusAcreditada();
            $notificacion->usuario_modificacion = $this->Auth->user('id');;
            $notificacion->fecha_modificacion = Time::now();

            $this->NotificacionesPagos->save($notificacion);

            return $this->redirect(['action' => $return]);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function rechazar($idNotificacion, $return) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $notificacion = $this->NotificacionesPagos->get($idNotificacion);
            $notificacion->status = $this->getStatusRechazada();
            $notificacion->usuario_modificacion = $this->Auth->user('id');;
            $notificacion->fecha_modificacion = Time::now();

            $this->NotificacionesPagos->save($notificacion);

            return $this->redirect(['action' => $return]);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    private function getStatusPendiente() {
        $row = TableRegistry::get('Diccionarios')->find('all')->where(['param1' => "NOTIFICACION_PAGO",
            'param2' => "STATUS", 'param3' => 'PENDIENTE'])->first();
        return $row->id;
    }

    private function getStatusAcreditada() {
        $row = TableRegistry::get('Diccionarios')->find('all')->where(['param1' => "NOTIFICACION_PAGO",
            'param2' => "STATUS", 'param3' => 'ACREDITADA'])->first();
        return $row->id;
    }

    private function getStatusRechazada() {
        $row = TableRegistry::get('Diccionarios')->find('all')->where(['param1' => "NOTIFICACION_PAGO",
            'param2' => "STATUS", 'param3' => 'RECHAZADA'])->first();
        return $row->id;
    }

//    public function fileupload() {
//        $notificacion = $this->NotificacionesPagos->newEntity();
//        if ($this->request->is('post')) {
//            $file = $this->request->data['file'];
//            $fileName = $this->request->data['file']['name'];
//            $uploadPath = 'uploads/files/';
//            $uploadFile = $uploadPath . $fileName;
//            $data = $this->request->data['file']['tmp_name'];
//            $base64 = base64_encode(file_get_contents($data));
////            if (move_uploaded_file($this->request->data['file']['tmp_name'], $uploadFile)) {
////
////            }
//            $this->set(compact('data'));
//            $this->set(compact('base64'));
//            $this->set('_serialize', ['base64']);
//
//        }
//        $this->set(compact('notificacion'));
//
//    }
}