<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 17/4/17
 * Time: 4:39 AM
 */

namespace App\Controller;


class PreviajeController  extends AppController {
    public function info() {
        $userID = $this->Auth->user('id');
        if ($this->isClient($userID)) {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'underconstruction']
            );
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

}