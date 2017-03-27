<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 4/2/17
 * Time: 8:40 PM
 */

namespace App\Controller;
use Cake\ORM\TableRegistry;

class GruposController  extends AppController{

    public function aplicartarifa($tarifa_id) {
        $tarifa = TableRegistry::get('Tarifas')->get($tarifa_id, ['contain' => []]);
        $query = $this->Grupos->find('all');
        $grupos = $this->paginate($query);
        $nombres = array();
        $selected = array();

        foreach ($grupos as $grupo) {
            array_push($nombres, [$grupo->nombre]);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            $this->set('data', $data);
            $this->set('_serialize', ['data']);
            return $this->redirect(['action' => 'aplicartarifa']);

        }

        $this->set('grupos', $grupos);
        $this->set('_serialize', ['grupos']);
        $this->set('tarifa', $tarifa);
        $this->set('_serialize', ['tarifa']);
        $this->set('nombres', $nombres);
        $this->set('_serialize', ['nombres']);
        $this->set('selected', $selected);
        $this->set('_serialize', ['selected']);
    }

}