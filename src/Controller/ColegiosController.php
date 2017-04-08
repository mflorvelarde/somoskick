<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 4/2/17
 * Time: 8:40 PM
 */

namespace App\Controller;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

class ColegiosController extends AppController{

    public function index() {
        $colegios = $this->Colegios->find('all')->where(['colegio_eliminado' => 0]);

        $this->set(compact('colegios'));
        $this->set('_serialize', ['colegios']);
    }

    public function view($id = null) {
        $colegio = $this->Colegios->get($id, ['contain' => ['Direcciones']]);

        $this->set('colegio', $colegio);
        $this->set('_serialize', ['colegio']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $colegio = $this->Colegios->newEntity();
        if ($this->request->is('post')) {

            $colegio = $this->Colegios->patchEntity($colegio, $this->request->data, [
                'associated' => [
                    'Direcciones'
                ]
            ]);

            $colegio->usuario_creacion = $this->Auth->user('id');;
            $colegio->fecha_creacion = Time::now();
            $colegio->colegio_eliminado = 0;
            $colegio->direccion_id = $this->guardarDireccion($colegio->direccione);

            if ($this->Colegios->save($colegio)) {
                $this->Flash->success(__('El colegio fue guardado'));

                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error(__('El colegio no pudo ser guardado. Por favor, intente nuevamente'));
            }
        }
        $this->set(compact('colegio'));
        $this->set('_serialize', ['colegio']);
    }

    public function guardarDireccion($direccion) {
        $result = TableRegistry::get('Direcciones')->save($direccion);
        return $result->id;
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

        $colegio = $this->Colegios->get($id);
        $colegio->colegio_eliminado = 1;
        $colegio->usuario_eliminado = $this->Auth->user('id');;
        $colegio->fecha_eliminado = Time::now();
        if ($this->Colegios->save($colegio)) {
            $this->Flash->success(__('El colegio fue eliminado'));
        } else {
            $this->Flash->error(__('El colegio no pudo ser eliminado. Por favor, intente nuevamente'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function viewCamadas ($id = null) {
        return $this->redirect(
            ['controller' => 'Camadas', 'action' => 'index', $id]
        );
    }

    public function addCamada ($id = null) {
        return $this->redirect(
            ['controller' => 'Camadas', 'action' => 'add', $id]
        );
    }

    public function edit($id = null) {
        $colegio = $this->Colegios->get($id, ['contain' => ['Direcciones']]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $colegio = $this->Colegios->patchEntity($colegio, $this->request->data, [
                'associated' => [
                    'Direcciones'
                ]
            ]);

            $colegio->usuario_modificacion = $this->Auth->user('id');
            $colegio->fecha_modificacion = Time::now();
            $colegio->direccion_id = $this->guardarDireccion($colegio->direccione);


            if ($this->Colegios->save($colegio)) {
                $this->Flash->success(__('El colegio fue guardado'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El colegio no pudo ser guardado. Por favor, intente nuevamente'));
            }
        }
        $this->set(compact('colegio'));
        $this->set('_serialize', ['colegio']);
    }
}