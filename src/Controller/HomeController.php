<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 16/4/17
 * Time: 6:17 PM
 */

namespace App\Controller;


class HomeController extends AppController {
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
            $this->viewBuilder()->layout('clientsLayout');
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }
}