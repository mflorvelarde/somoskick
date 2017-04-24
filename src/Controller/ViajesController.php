<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 5/2/17
 * Time: 12:36 AM
 */

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class ViajesController extends AppController {
    /**
     * Index method
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $viajes = $this->Viajes->find('all')->where(['viaje_eliminado' => 0]);

            $this->set(compact('viajes'));
            $this->set('_serialize', ['viajes']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }


    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $viaje = $this->Viajes->newEntity();

            if ($this->request->is('post')) {
                $viaje = $this->Viajes->patchEntity($viaje, $this->request->data);
                $viaje->usuario_creacion = $this->Auth->user('id');
                $viaje->fecha_creacion = Time::now();
                $viaje->viaje_eliminado = 0;

                if ($this->Viajes->save($viaje)) {
                    $this->Flash->success(__('El viaje fue guardado'));

                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('El viaje no pudo ser guardado. Por favor, intente nuevamente'));
                }
            }

            $this->set(compact('viaje'));
            $this->set('_serialize', ['viaje']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $this->request->allowMethod(['post', 'delete']);

            $viaje = $this->Viajes->get($id);
            $viaje->viaje_eliminado = 1;
            $viaje->usuario_eliminado = $this->Auth->user('id');
            $viaje->fecha_eliminado = Time::now();
            if ($this->Viajes->save($viaje)) {
                $this->Flash->success(__('El viaje fue eliminado'));
            } else {
                $this->Flash->error(__('El viaje no pudo ser eliminado. Por favor, intente nuevamente'));
            }

            return $this->redirect(['action' => 'index']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $viaje = $this->Viajes->get($id, ['contain' => []]);

            if ($this->request->is(['patch', 'post', 'put'])) {
                $viaje = $this->Viajes->patchEntity($viaje, $this->request->data);
                $viaje->usuario_modificacion = $this->Auth->user('id');
                $viaje->fecha_modificacion = Time::now();

                if ($this->Viajes->save($viaje)) {
                    $this->Flash->success(__('El viaje fue guardado'));

                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('El viaje no pudo ser guardado. Por favor, intente nuevamente'));
                }
            }
            $this->set(compact('viaje'));
            $this->set('_serialize', ['viaje']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function view() {
        $userID = $this->Auth->user('id');
        if ($this->isClient($userID)) {
            $this->viewBuilder()->layout('clientsLayout');

            $idPasajero = $this->getPasajeroID($userID);

            $pasajero= TableRegistry::get('Pasajerosdegrupos')->find()
                ->where(['id_pasajero' => $idPasajero, 'pasajerodegrupo_eliminado' => 0])
                ->first();


            $camadaQuery = TableRegistry::get('Camadas')->find('all', ['contain' => ['Colegios', 'Grupos']])
                ->where(['grupo_id' => $pasajero->id_grupo, 'camada_eliminado' => 0]);
            $camada = $camadaQuery->first();

            $tarifaAplicadaID = $camada['grupo']['tarifa_aplicada_id'];
            $tarifaTable = TableRegistry::get('Tarifas');
            if (!is_null($tarifaAplicadaID)) {
                $tarifaAplicadaTable = TableRegistry::get('TarifasAplicadas',['contain' => ['Tarifas']]);
                $tarifaAplicada = $tarifaAplicadaTable->get($tarifaAplicadaID);
                $tarifa = $tarifaTable->get($tarifaAplicada['tarifa_id'], ['contain' => ['Viajes']]);
                $viaje = $tarifa['viaje'];
            } else {
                $tarifa = $tarifaTable->newEntity();
            }


            $this->set(compact('pasajero'));

            $this->set(compact('tarifaAplicada'));
            $this->set(compact('tarifa'));
            $this->set('_serialize', ['tarifa']);
            $this->set(compact('viaje'));
            $this->set('_serialize', ['viaje']);
            $this->set(compact('camada'));
            $this->set('_serialize', ['camada']);

        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

}