<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class PersonasController extends AppController{


    public function initialize() {
        parent::initialize();
        $this->Auth->allow('registrarok');
    }

    /**
     * Index method
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $personas = $this->paginate($this->Personas);

        $this->set(compact('personas'));
        $this->set('_serialize', ['personas']);
    }
    

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $persona = $this->Personas->get($id);

        $this->set('persona', $persona);
        $this->set('_serialize', ['persona']);
    }

    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect(['controller'=>'Camadas','action' => 'index']);
            }

            $this->Flash->error(__('Invalid username or password, try again'));
        }
        $this->viewBuilder()->layout('blankLayout');
    }


    public function registrarok() {
        $this->viewBuilder()->layout('blankLayout');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->redirect(['action' => 'login']);
        }
    }
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $persona = $this->Personas->newEntity();
        if ($this->request->is('post')) {
            $persona = $this->Personas->patchEntity($persona, $this->request->data);

            $persona->direccion_id = 1;
           // $user->password = 'gwinn';

            if ($this->Personas->save($persona)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('persona'));
        $this->set('_serialize', ['persona']);
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

        $persona = $this->Personas->get($id);
        if ($this->Personas->delete($persona)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
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
        $persona = $this->Personas->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put']))
        {
            $persona = $this->Personas->patchEntity($persona, $this->request->data);

            if ($this->Personas->save($persona)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('persona'));
        $this->set('_serialize', ['persona']);
    }

    public function irRegistrarse() {
        return $this->redirect(
            ['controller' => 'Pasajeros', 'action' => 'registrarse']
        );
    }
}
