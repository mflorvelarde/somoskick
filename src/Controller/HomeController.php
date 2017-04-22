<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 16/4/17
 * Time: 6:17 PM
 */

namespace App\Controller;

use Cake\ORM\TableRegistry;

class HomeController extends AppController {

    public function home() {
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'loginAction' => [ 'controller' => 'Personas', 'action' => 'login', 'plugin' => false], // or 'Members' if plugin ],
            'loginRedirect' => [
                'controller' => 'Camadas',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Personas',
                'action' => 'login'
            ],
            'authenticate' => ['Form' => ['userModel' => 'Personas','fields' => ['username' => 'mail', 'password' => 'contrasena']]]
        ]);
    }
    public function admin() {
        $userID = $this->Auth->user('id');
        if (!$this->isNotClient($userID)) {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function clientes() {
        $userID = $this->Auth->user('id');
        if ($this->isClient($userID)) {
            $idPasajero = $this->getPasajeroID($userID);
            $pasajero= TableRegistry::get('Pasajerosdegrupos')->find()
                ->where(['id_pasajero' => $idPasajero, 'pasajerodegrupo_eliminado' => 0])
                ->first();
            if ($pasajero->tarifa_aceptada) {
                $this->viewBuilder()->layout('clientsLayout');
            } else {
                return $this->redirect(
                    ['controller' => 'Pasajerosdegrupos', 'action' => 'aceptarContrato', $pasajero->id]
                );            }


        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }
}