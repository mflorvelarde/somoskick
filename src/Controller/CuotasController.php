<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 6/2/17
 * Time: 4:35 AM
 */

namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class CuotasController extends AppController{


    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($tarifa_aplicada_id) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $tarifasAplicadasTable = TableRegistry::get('TarifasAplicadas');
            $tarifa_aplicada = $tarifasAplicadasTable->get($tarifa_aplicada_id, ['contain' => ['Tarifas']]);
            $tarifa = $tarifa_aplicada->tarifa;
            //        $grupos = TableRegistry::get('Grupos')->find('all', ['contain' => ['Colegios', 'Grupos', 'Diccionarios', 'Personas']])
            //            ->where(['colegio_id' => $colegio_id, 'camada_eliminado' => 0]);

            $inicioPago = $tarifa_aplicada->fecha_primer_pago;
            $finPago = $tarifa->fin_pago;

            $cuotas = TableRegistry::get('Cuotas')->newEntities($this->request->data);
            $date = date('Y-m-d', strtotime('+1 month', strtotime($inicioPago)));
            $meses = 0;

            $this->set(compact('tarifa_aplicada'));
            $this->set('_serialize', ['tarifa_aplicada']);
            $this->set(compact('inicioPago'));
            $this->set('_serialize', ['inicioPago']);
            $this->set(compact('date'));
            $this->set('_serialize', ['date']);
            $this->set(compact('finPago'));
            $this->set('_serialize', ['finPago']);

            while ($date < $finPago) {
                $cuota = $this->Cuotas->newEntity();
                $cuota->vencimiento = $date;
                array_push($cuotas, $cuota);
                $meses = $meses + 1;
                $date = date('Y-m-d', strtotime('+1 month', strtotime($date)));
            }


            if ((is_null($tarifa->monto_pesos) || $tarifa->monto_pesos == 0) && $tarifa->monto_dolares = !0) {
                foreach ($cuotas as $cuota) {
                    $cuota->monto_dolares = $tarifa->monto_dolares / $meses;
                }
            } else if ($tarifa->monto_pesos != 0 && (is_null($tarifa->monto_dolares) || $tarifa->monto_dolares == 0)) {
                foreach ($cuotas as $cuota) {
                    $cuota->monto_pesos = $tarifa->monto_pesos / $meses;
                }
            } else {
                $dolaresEnPesosAprox = $tarifa->monto_dolares * 16;
                $porcentajePesos = ($tarifa->monto_pesos / $dolaresEnPesosAprox);
                $porcentajeDolares = 1 - $porcentajePesos;
                $cantidadCuotasDolares = round($porcentajeDolares * $meses / 100);
                if ($cantidadCuotasDolares == 0) $cantidadCuotasDolares = 1;
                $cantidadCuotasPesos = $meses - $cantidadCuotasDolares;

                $index = 0;
                foreach ($cuotas as $cuota) {
                    if ($index < $cantidadCuotasDolares) {
                        $cuota->monto_dolares = $tarifa->monto_dolares / $cantidadCuotasDolares;
                        $cuota->monto_pesos = 0;
                    } else {
                        $cuota->monto_pesos = $tarifa->monto_pesos / $cantidadCuotasPesos;
                        $cuota->monto_dolares = 0;
                    }
                    $index = $index + 1;
                }

                /*
                            for ($i = 0; $i < $cantidadCuotasDolares; $i++) {
                                $cuotas[$i]->monto_dolares = $tarifa->monto_dolares / $cantidadCuotasDolares;
                                $cuotas[$i]->monto_pesos = 0;
                            }
                            for ($i = $cantidadCuotasDolares; $i < $meses; $i++) {
                                $cuotas[$i]->monto_pesos = $tarifa->monto_pesos / $cantidadCuotasPesos;
                                $cuotas[$i]->monto_dolares = 0;
                            }*/
            }


            if ($this->request->is('post')) {
                $cuotasTableRegistry = TableRegistry::get('Cuotas');
                $entities = $cuotasTableRegistry->newEntities($this->request->data);
                $this->set(compact('entities'));
                $this->set('_serialize', ['entities']);

                /*             $cuotasTableRegistry->connection()->transactional(function () use ($cuotasTableRegistry, $entities) {
                                foreach ($entities as $entity) {
                                   $entity->tarifa_id = $tarifa->id;
                        $cuotasTableRegistry->save($entity, ['atomic' => false]);
                    }
                });*/

                foreach ($cuotas as $cuota) {
                    $entity = $this->Cuotas->newEntity();
                    $entity->monto_pesos = $cuota->monto_pesos;
                    $entity->monto_dolares = $cuota->monto_dolares;
                }


                /*
                            foreach ($entities as $cuota) {
                               // $cuota = $this->Cuotas->patchEntity($cuota, $this->request->data);
                                $cuota->tarifa_id = $tarifa->id;
                                $cuota->usuario_creacion = 2;
                                $cuota->fecha_creacion = Time::now();
                                $cuota->eliminado = 0;

                                $this->Cuotas->save($cuota);
                            }*/
                /*            $colegio = $this->Colegios->patchEntity($colegio, $this->request->data);
                            $colegio->usuario_creacion = 2;
                            $colegio->fecha_creacion = Time::now();
                            $colegio->eliminado = 0;
                            $colegio->direccion_id = 1;

                            if ($this->Colegios->save($colegio)) {
                                $this->Flash->success(__('El colegio fue guardado'));

                                return $this->redirect(['action' => 'index']);
                            }
                            else {
                                $this->Flash->error(__('El colegio no pudo ser guardado. Por favor, intente nuevamente'));
                            }*/
            }
            $this->set(compact('tarifa'));
            $this->set('_serialize', ['tarifa']);
            $this->set(compact('cuotas'));
            $this->set('_serialize', ['cuotas']);
            /*        $this->set(compact('diff'));
                    $this->set('_serialize', ['diff']);*/
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }
}