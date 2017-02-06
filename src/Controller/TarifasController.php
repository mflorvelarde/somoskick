<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 6/2/17
 * Time: 2:52 AM
 */

namespace App\Controller;


class TarifasController extends AppController {
    /**
     * Index method
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $tarifas = $this->paginate($this->Tarifas);

        $this->set(compact('tarifas'));
        $this->set('_serialize', ['tarifas']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tarifa = $this->Tarifas->get($id);

        $this->set('tarifa', $tarifa);
        $this->set('_serialize', ['tarifa']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tarifa = $this->Tarifas->newEntity();
        if ($this->request->is('post')) {
            $tarifa = $this->Tarifas->patchEntity($tarifa, $this->request->data);
            $tarifa->usuario_creacion = 2;
            $tarifa->fecha_creacion = date("d/m/Y");
            $tarifa->eliminado = 0;

            if ($this->Tarifas->save($tarifa)) {
                $this->Flash->success(__('La tarifa fue guardada'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La tarifa no pudo ser guardada. Por favor, intente nuevamente'));
            }
        }
        $this->set(compact('tarifa'));
        $this->set('_serialize', ['tarifa']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $tarifa = $this->Tarifas->get($id);
        $tarifa->eliminado = 1;
        $tarifa->usuario_eliminado = 2;
        $tarifa->fecha_eliminado = date("d/m/Y");
        if ($this->Tarifas->save($tarifa)) {
            $this->Flash->success(__('La tarifa fue eliminada'));
        } else {
            $this->Flash->error(__('La tarifa no pudo ser eliminada. Por favor, intente nuevamente'));
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
        $tarifa = $this->Tarifas->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $tarifa = $this->Tarifas->patchEntity($tarifa, $this->request->data);
            $tarifa->usuario_modificacion = 2;
            $tarifa->fecha_modificacion = date("d/m/Y");

            if ($this->Tarifas->save($tarifa)) {
                $this->Flash->success(__('La tarifa fue guardada'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La tarifa no pudo ser guardada. Por favor, intente nuevamente'));
            }
        }
        $this->set(compact('tarifa'));
        $this->set('_serialize', ['tarifa']);
    }
}