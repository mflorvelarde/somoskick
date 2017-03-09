<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 2/3/17
 * Time: 8:35 PM
 */

namespace App\Controller;


class ClientControllers extends AppController {
    protected function isAuthorized($user) {
        if (isset($user['perfil']) && $user['perfil'] === 'CLIENTE') {
            return true;
        }
        return false;
    }
}