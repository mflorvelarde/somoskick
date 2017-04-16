<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 7/2/17
 * Time: 6:11 AM
 */

namespace App\Controller;


class TarifasAplicadasController extends AppController{

    /**
     * Index method
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $this->viewBuilder()->layout('clientsLayout');
    }

    public function aplicartarifaagrupos($data_json) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $data = json_decode($data_json);

            $grupos = $data->Grupos;
            $primeracuota = $data->primeracuota;

            $this->set('grupos', $grupos);
            $this->set('_serialize', ['grupos']);
            $this->set('primeracuota', $primeracuota);
            $this->set('_serialize', ['primeracuota']);
            $this->set('data', $data);
            $this->set('_serialize', ['data']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function creartarifaaplicada($tarifa_id, $grupo_id) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $tarifaAplicada = $this->TarifasAplicadas->newEntity();
            $tarifaAplicada->tarifa_id = $tarifa_id;
            $tarifaAplicada->grupo_id = $grupo_id;
            $tarifaAplicada->tarifa_aplicada_eliminado = 0;

            if ($this->Colegios->save($tarifaAplicada)) {
                $this->Flash->success(__('El colegio fue guardado'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El colegio no pudo ser guardado. Por favor, intente nuevamente'));
            }
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }
}