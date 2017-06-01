<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 6/2/17
 * Time: 2:52 AM
 */

namespace App\Controller;

use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class TarifasController extends AppController {

    public function index() {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $tarifas = $this->Tarifas->find('all')->where(['tarifa_eliminado' => 0]);

            $this->set(compact('tarifas'));
            $this->set('_serialize', ['tarifas']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function view($id = null) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $tarifa = $this->Tarifas->get($id, ['contain' => ['Viajes']]);

            $this->set('tarifa', $tarifa);
            $this->set('_serialize', ['tarifa']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function add() {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $tarifa = $this->Tarifas->newEntity();
            $viajesTable = TableRegistry::get('Viajes');
            $viajes_options = $viajesTable->find('list', array(
                'conditions' => array('viaje_eliminado' => 0),
                'valueField' => array('destino')
            ));


            if ($this->request->is('post')) {
                $tarifa = $this->Tarifas->patchEntity($tarifa, $this->request->data);
                $tarifa->usuario_creacion = $userID;
                $tarifa->fecha_creacion = Time::now();
                $tarifa->tarifa_eliminado = 0;

                if ($this->Tarifas->save($tarifa)) {
                    $this->Flash->success(__('La tarifa fue guardada'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('La tarifa no pudo ser guardada. Por favor, intente nuevamente'));
                }
            }
            $this->set(compact('viajes_options'));
            $this->set('_serialize', ['viajes_options']);
            $this->set(compact('tarifa'));
            $this->set('_serialize', ['tarifa']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function aplicarGrupos($tarifa_id) {
        return $this->redirect(
            ['controller' => 'Grupos', 'action' => 'aplicartarifa', $tarifa_id]
        );
    }

    public function delete($id = null) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $this->request->allowMethod(['post', 'delete']);

            $tarifa = $this->Tarifas->get($id);
            $tarifa->tarifa_eliminado = 1;
            $tarifa->usuario_eliminado = $userID;
            $tarifa->fecha_eliminado = Time::now();
            if ($this->Tarifas->save($tarifa)) {
                $this->Flash->success(__('La tarifa fue eliminada'));
            } else {
                $this->Flash->error(__('La tarifa no pudo ser eliminada. Por favor, intente nuevamente'));
            }

            return $this->redirect(['action' => 'index']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function edit($id = null) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $tarifa = $this->Tarifas->get($id, ['contain' => []]);
            $viajesTable = TableRegistry::get('Viajes');
            $viajes_options = $viajesTable->find('list', array(
                'conditions' => array('viaje_eliminado' => 0),
                'valueField' => array('destino')
            ));

            if ($this->request->is(['patch', 'post', 'put'])) {
                $tarifa = $this->Tarifas->patchEntity($tarifa, $this->request->data);
                $tarifa->usuario_modificacion = $userID;
                $tarifa->fecha_modificacion = Time::now();

                if ($this->Tarifas->save($tarifa)) {
                    $this->Flash->success(__('La tarifa fue guardada'));

                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('La tarifa no pudo ser guardada. Por favor, intente nuevamente'));
                }
            }
            $this->set(compact('viajes_options'));
            $this->set('_serialize', ['viajes_options']);
            $this->set(compact('tarifa'));
            $this->set('_serialize', ['tarifa']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function aplicarapasajero($idPasajerodegrupo) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $pasajerosTable = TableRegistry::get('Pasajerosdegrupos');
            $pasajerodegrupo = $pasajerosTable->get($idPasajerodegrupo, ['contain' => ['Grupos','Pasajeros' => ['Personas']]]);

            $tarifas_options = $this->Tarifas->find('list', array(
                'conditions' => array('tarifa_eliminado' => 0),
                'valueField' => array('descripcion')
            ));
            $primeracuota = Time::now();

            if ($this->request->is(['post', 'put'])) {
                $data = $this->request->data;
                $json = json_encode($data);
                $entity = json_decode($json);

                $tarifasAplicadasTable = TableRegistry::get('TarifasAplicadas');
                $tarifaAplicada = $tarifasAplicadasTable->newEntity();
                $tarifaAplicada->tarifa_id = $entity->Tarifas;
                $tarifaAplicada->tarifa_aplicada_eliminado = 0;
                $tarifaAplicada->fecha_primer_pago = Time::create($entity->primeracuota->year,
                    $entity->primeracuota->month, $entity->primeracuota->day);
                $tarifaAplicada->fecha_creacion = Time::now();
                $tarifaAplicada->usuario_creacion = $this->Auth->user('id');

                $result = $tarifasAplicadasTable->save($tarifaAplicada);
                $tarifaAplicadaID = $result->id;

                $pasajerodegrupo->tarifa_aplicada_id = $tarifaAplicadaID;
                $pasajerodegrupo->plan_aceptado = 0;
                $pasajerodegrupo->fecha_modificaion = Time::now();
                $pasajerodegrupo->usuario_modificacion = $this->Auth->user('id');
                $resultPasajero = $pasajerosTable->save($pasajerodegrupo);


                return $this->redirect(
                    ['controller' => 'Cuotas', 'action' => 'addToPasajero', $tarifaAplicadaID]
                );
            }

            $this->set('_serialize', ['entity']);
            $this->set('primeracuota', $primeracuota);
            $this->set('_serialize', ['primeracuota']);
            $this->set(compact('tarifas_options'));
            $this->set('_serialize', ['tarifas_options']);
            $this->set(compact('pasajerodegrupo'));
            $this->set('_serialize', ['pasajerodegrupo']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }
}