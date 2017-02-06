<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 5/2/17
 * Time: 12:36 AM
 */

namespace App\Controller;

use App\Controller\AppController;

class ViajesController extends AppController {
    /**
     * Index method
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $viajes = $this->paginate($this->Viajes);

        $this->set(compact('viajes'));
        $this->set('_serialize', ['viajes']);
    }


    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $viaje = $this->Viajes->newEntity();

        if ($this->request->is('post')) {
            $viaje = $this->Viajes->patchEntity($viaje, $this->request->data);
            $viaje->usuario_creacion = 2;
            $viaje->fecha_creacion = date("d/m/Y");
            $viaje->eliminado = 0;

            if ($this->Viajes->save($viaje)) {
                $this->Flash->success(__('El viaje fue guardado'));

                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error(__('El viaje no pudo ser guardado. Por favor, intente nuevamente'));
            }
        }
        $this->set(compact('viaje'));
        $this->set('_serialize', ['viaje']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);

        $viaje = $this->Viajes->get($id);
        $viaje->eliminado = 1;
        $viaje->usuario_eliminado = 2;
        $viaje->fecha_eliminado = date("d/m/Y");
        if ($this->Viajes->save($viaje)) {
            $this->Flash->success(__('El viaje fue eliminado'));
        } else {
            $this->Flash->error(__('El viaje no pudo ser eliminado. Por favor, intente nuevamente'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $viaje = $this->Viajes->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $viaje = $this->Viajes->patchEntity($viaje, $this->request->data);
            $viaje->usuario_modificacion = 2;
            $viaje->fecha_modificacion = date("d/m/Y");

            if ($this->Viajes->save($viaje)) {
                $this->Flash->success(__('El viaje fue guardado'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El viaje no pudo ser guardado. Por favor, intente nuevamente'));
            }
        }
        $this->set(compact('viaje'));
        $this->set('_serialize', ['viaje']);
    }

}