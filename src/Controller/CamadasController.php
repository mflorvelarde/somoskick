<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 5/2/17
 * Time: 1:15 AM
 */

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class CamadasController extends AppController{

    /**
     * Index method
     * @return \Cake\Network\Response|null
     */
    public function index($colegio_id = null) {

              if ($colegio_id != null) {
                    $query = $this->Camadas->find('all')->where(['colegios_id' => $colegio_id]);
                } else {
                    $query = $this->Camadas->find('all');
                }
/*        if ($colegio_id != null) {
            $query = $this->Camadas->find('all', ['contain' => ['Colegios'], ['Grupos']])->where(['colegios_id' => $colegio_id]);
        } else {
            $query = $this->Camadas->find('all', ['contain' => ['Colegios'], ['Grupos']]);
        }*/
        $this->set('camadas', $this->paginate($query));
        $this->set('_serialize', ['camadas']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $camada = $this->Camadas->get($id);

        $this->set('camada', $camada);
        $this->set('_serialize', ['camada']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($colegioId = null) {
        $camada = $this->Camadas->newEntity();
        if ($colegioId != null) {
            $camada->colegios_id = $colegioId;
        }

        if ($this->request->is('post')) {
            $camada = $this->Camadas->patchEntity($camada, $this->request->data, [
                'associated' => [
                    'Grupos'
                ]
            ]);

            $grupos = TableRegistry::get('Grupos')->newEntity();
            $grupos->nombre = $camada->grupo->nombre;
            $grupos->contrato = $camada->grupo->contrato;
            $grupos->eliminado = 0;
            $grupos->fecha_creacion = Time::now();
            $grupos->usuario_creacion = 2;

            $result = TableRegistry::get('Grupos')->save($grupos);
            $grupos_id = $result->id;

            $camada->usuario_creacion = 2;
            $camada->fecha_creacion = date("d/m/Y");
            $camada->eliminado = 0;
            $camada->grupo = null;
            $camada->grupos_id = $grupos_id;

            if ($this->Camadas->save($camada)) {
                $this->Flash->success(__('La camada fue guardada'));

                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error(__('La camada no pudo ser guardada. Por favor, intente nuevamente'));
            }
        }
        $this->set(compact('camada'));
        $this->set('_serialize', ['camada']);
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

        $camada = $this->Camadas->get($id);
        $camada->eliminado = 1;
        $camada->usuario_eliminado = 2;
        $camada->fecha_eliminado = date("d/m/Y");
        if ($this->Camadas->save($camada)) {
            $this->Flash->success(__('La camada fue eliminada'));
        } else {
            $this->Flash->error(__('La camada no pudo ser eliminada. Por favor, intente nuevamente'));
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
        $camada = $this->Camadas->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $camada = $this->Camadas->patchEntity($camada, $this->request->data);
            $camada->usuario_modificacion = 2;
            $camada->fecha_modificacion = date("d/m/Y");

            if ($this->Camadas->save($camada)) {
                $this->Flash->success(__('La camada fue guardada'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La camada no pudo ser guardada. Por favor, intente nuevamente'));
            }
        }
        $this->set(compact('camada'));
        $this->set('_serialize', ['camada']);
    }
}