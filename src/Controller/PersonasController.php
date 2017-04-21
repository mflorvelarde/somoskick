<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class PersonasController extends AppController{


    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['changepassword','registrarok']);
    }

    public function index() {
        $personas = $this->paginate($this->Personas);

        $this->set(compact('personas'));
        $this->set('_serialize', ['personas']);
    }

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
                if ($this->isClient($this->Auth->user('id'))) {
                    return $this->redirect(['controller'=>'Home','action' => 'clientes']);

                } else {
                    return $this->redirect(['controller'=>'Home','action' => 'admin']);
                }
            }

            $this->Flash->error(__('Invalid username or password, try again'));
        }
        $this->viewBuilder()->layout('blankLayout');
    }

    public function changepassword($code) {
        $persona = $this->Personas->find()
            ->where(['contrasena' => $code])
            ->first();
        if (!is_null($persona)) {
            $this->viewBuilder()->layout('blankLayout');
            if ($this->request->is(['patch', 'post', 'put'])) {
                $requestData = $this->request->data;
                $contrasena = $requestData["contrasena"];
                $chequeo = $requestData["chequeo"];

                if ($contrasena === $chequeo) {
                    $persona->contrasena = $contrasena;
                    $persona->contrasena_reset = 0;
                    $persona->fecha_modificacion = Time::now();
                    $persona->usuario_modificacion = $persona->id;

                    $this->Personas->save($persona);
                    return $this->redirect(['action' => 'login']);
                }
            }
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
        $this->set(compact('contrasena'));
        $this->set('_serialize', ['contrasena']);
        $this->set(compact('chequeo'));
        $this->set('_serialize', ['chequeo']);
    }

    public function registrarok() {
        $this->viewBuilder()->layout('blankLayout');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->redirect(['action' => 'login']);
        }
    }

    public function add() {
        $persona = $this->Personas->newEntity();
        if ($this->request->is('post')) {
            $persona = $this->Personas->patchEntity($persona, $this->request->data);

            $persona->contrasena = "velarde";

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
