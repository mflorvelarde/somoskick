<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 15/2/17
 * Time: 6:26 PM
 */

namespace App\Controller;



class PasajerosController extends AppController {

    /**
     * Index method
     * @return \Cake\Network\Response|null
     */
    public function listAll($camada_id = null) {
        $this->viewBuilder()->layout('ajax');

    //              if ($colegio_id != null) {
    //                    $query = $this->Camadas->find('all')->where(['colegios_id' => $colegio_id]);
    //                } else {
    //                    $query = $this->Camadas->find('all');
    //                }
/*            if ($colegio_id != null) {
                $query = $this->Camadas->find('all', ['contain' => ['Colegios'], ['Grupos']])->where(['colegio_id' => $colegio_id]);
            } else {
                $query = $this->Camadas->find('all', ['contain' => ['Colegios'], ['Grupos']]);
            }
            $this->set('camadas', $this->paginate($query));
            $this->set('_serialize', ['camadas']);*/
    }
}