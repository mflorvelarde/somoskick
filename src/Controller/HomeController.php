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

//    public function home() {
//        $this->loadComponent('RequestHandler');
//        $this->loadComponent('Flash');
//
//        $this->loadComponent('Auth', [
//            'loginAction' => [ 'controller' => 'Personas', 'action' => 'login', 'plugin' => false], // or 'Members' if plugin ],
//            'loginRedirect' => [
//                'controller' => 'Home',
//                'action' => 'clientes'
//            ],
//            'logoutRedirect' => [
//                'controller' => 'Personas',
//                'action' => 'login'
//            ],
//            'authenticate' => ['Form' => ['userModel' => 'Personas','fields' => ['username' => 'mail', 'password' => 'contrasena']]]
//        ]);
//    }

public function home() {
    $userID = $this->Auth->user('id');
    if ($this->isClient($userID)) {
        $this->clientes();
    } else {
        $this->admin();
    }
}

    public function login () {
        $userID = $this->Auth->user('id');
        if ($this->isClient($userID)) {
            $this->clientes();
        } else {
            $this->admin();
        }
    }
    public function admin() {
        $userID = $this->Auth->user('id');
        if ($this->isClient($userID)) {
            $this->clientes();
        }
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
            if (!$pasajero->tarifa_aceptada) {
                return $this->redirect(
                    ['controller' => 'Pasajerosdegrupos', 'action' => 'aceptarcontrato', $pasajero->id]
                );
            } else if (!$pasajero->plan_aceptado) {
                return $this->redirect(
                    ['controller' => 'Pasajerosdegrupos', 'action' => 'aceptarplan', $pasajero->id]
                );
            } else {
                $this->viewBuilder()->layout('clientsLayout');
            }
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }
}