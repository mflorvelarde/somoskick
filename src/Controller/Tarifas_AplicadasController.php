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

    public function creartarifaaplicada($tarifa_id, $grupo_id) {
        $tarifaAplicada = $this->TarifasAplicadas->newEntity();
        $tarifaAplicada->tarifa_id = $tarifa_id;
        $tarifaAplicada->grupo_id = $grupo_id;

        if ($this->Colegios->save($tarifaAplicada)) {
            $this->Flash->success(__('El colegio fue guardado'));

            return $this->redirect(['action' => 'index']);
        }
        else {
            $this->Flash->error(__('El colegio no pudo ser guardado. Por favor, intente nuevamente'));
        }

    }
}