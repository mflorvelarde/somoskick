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
    /**
     * Index method
     * @return \Cake\Network\Response|null
     */
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

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
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
            $tarifa = $this->Tarifas->get($id, ['contain' => []]);

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
            $this->set(compact('tarifa'));
            $this->set('_serialize', ['tarifa']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }
}