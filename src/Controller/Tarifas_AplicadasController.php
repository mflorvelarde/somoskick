<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 7/2/17
 * Time: 6:11 AM
 */

namespace App\Controller;


class Tarifas_AplicadasController extends AppController{

    /**
     * Index method
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $this->viewBuilder()->layout('clientsLayout');
    }
}