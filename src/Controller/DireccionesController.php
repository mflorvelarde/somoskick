<?php

namespace App\Controller;

/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 8/3/17
 * Time: 4:51 PM
 */
class DireccionesController extends AppController {

    public function add() {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $direccion = $this->Direcciones->newEntity();
            if ($this->request->is('post')) {
                $direccion = $this->Direcciones->patchEntity($direccion, $this->request->data);

                // $user->password = 'gwinn';

                if ($this->Direcciones->save($direccion)) {
                    $this->Flash->success(__('The user has been saved.'));

                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            }
            $this->set(compact('direccion'));
            $this->set('_serialize', ['direccion']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }
}