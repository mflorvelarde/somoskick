<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class PersonasController extends AppController{


    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['changepassword','registrarok', 'cambiocontrasenaok', 'cambiarcontrasena']);
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

    private function sendResetPasswordMail($code, $mail) {
        $email = new Email();
        $email->sender('administracion@somoskick.com', 'Kick');
        $email->from('administracion@somoskick.com')
            ->addTo($mail)
            ->subject('Cambio de contraseña')
            ->emailFormat('html')
            ->viewVars(['code' => $code])
            ->template('cambiocontrasena');
        $email->send();
    }

    public function cambiarcontrasena() {
        $this->viewBuilder()->layout('blankLayout');
        $mensaje = '';
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requestData = $this->request->data;
            $mail = $requestData["mail"];

            $basePersonas = TableRegistry::get('Personas');
            $persona = $this->Personas->find()
                ->where(['mail' => $mail])
                ->first();
            if (!is_null($persona)) {
                $contrasena = md5($persona->dni . Time::now()->toDateTimeString());
                $query = $basePersonas->query();
                $query->update()
                    ->set(['contrasena' => $contrasena, 'contrasena_reset' => 1, 'usuario_modificacion' => $persona->id, 'fecha_modificacion' => Time::now()])
                    ->where(['mail' => $mail])
                    ->execute();
                $this->sendResetPasswordMail($contrasena, $mail);
                return $this->redirect(['action' => 'cambiocontrasenaok']);
            } else {
                $mensaje = 'Dirección de correo ingresada incorrecta';
            }
        }
        $this->set(compact('mensaje'));
        $this->set(compact('email'));
        $this->set('_serialize', ['email']);
    }

    public function registrarok() {
        $this->viewBuilder()->layout('blankLayout');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->redirect(['action' => 'login']);
        }
    }

    public function cambiocontrasenaok() {
        $this->viewBuilder()->layout('blankLayout');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->redirect(['action' => 'login']);
        }
    }

    public function add() {
        $userID = $this->Auth->user('id');
        if ($this->isAdmin($userID)) {
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
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
        $this->set(compact('persona'));
        $this->set('_serialize', ['persona']);
    }

    public function delete($id = null)
    {
        $userID = $this->Auth->user('id');
        if ($this->isAdmin($userID)) {
            $this->request->allowMethod(['post', 'delete']);

            $persona = $this->Personas->get($id);
            if ($this->Personas->delete($persona)) {
                $this->Flash->success(__('The user has been deleted.'));
            } else {
                $this->Flash->error(__('The user could not be deleted. Please, try again.'));
            }
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }

        return $this->redirect(['action' => 'index']);
    }

    public function edit($id = null) {
        $userID = $this->Auth->user('id');
        if ($this->isAdmin($userID)) {
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
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
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
