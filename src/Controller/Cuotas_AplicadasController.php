<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 6/2/17
 * Time: 4:35 AM
 */

namespace App\Controller;

use Cake\I18n\Time;


class Cuotas_AplicadasController extends AppController{


    /**
     * Index method
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $cuotasAplicadas = $this->paginate($this->Cuotas_aplicadas);


//        $query = $articles->find('all', ['contain' => ['Authors', 'Comments']]);
//
//
//        $query = $articles->find();
//        $query->contain(['Authors', 'Comments'], true);


        $this->set(compact('cuotasAplicadas'));
        $this->set('_serialize', ['cuotasAplicadas']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $colegio = $this->Colegios->get($id);

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
            $colegio = $this->Colegios->patchEntity($colegio, $this->request->data);
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
            }
        }
        $this->set(compact('colegio'));
        $this->set('_serialize', ['colegio']);
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
        $colegio->eliminado = 1;
        $colegio->usuario_eliminado = 2;
        $colegio->fecha_eliminado = Time::now();
        if ($this->Colegios->save($colegio)) {
            $this->Flash->success(__('El colegio fue eliminado'));
        } else {
            $this->Flash->error(__('El colegio no pudo ser eliminado. Por favor, intente nuevamente'));
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
    public function edit($id = null) {
        $colegio = $this->Colegios->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $colegio = $this->Colegios->patchEntity($colegio, $this->request->data);
            $colegio->usuario_modificacion = 2;
            $colegio->fecha_modificacion = Time::now();

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