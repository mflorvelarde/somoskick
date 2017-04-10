<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 4/2/17
 * Time: 8:40 PM
 */

namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class GruposController  extends AppController{

    public function aplicartarifa($tarifa_id) {
        $grupos_options = $this->Grupos->find('list', array(
            'conditions' => array('	tarifa_aplicada_id IS' => null),
            'valueField' => array('nombre')
        ));

        $grupo = $this->Grupos->newEntity();
        $tarifa = TableRegistry::get('Tarifas')->get($tarifa_id, ['contain' => []]);
        $primeracuota = Time::now();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            $json = json_encode($data);

            $tarifasAplicadasTable = TableRegistry::get('TarifasAplicadas');
            $tarifaAplicada = $tarifasAplicadasTable->newEntity();
            $tarifaAplicada->tarifa_id;
            $tarifaAplicada->tarifa_aplicada_eliminado = 0;
            $tarifaAplicada->fecha_creacion = Time::now();
            $tarifaAplicada->usuario_creacion = $this->Auth->user('id');;

            $result = $tarifasAplicadasTable->save($tarifaAplicada);
            $tarifaAplicadaID = $result->id;

            $entity = json_decode($json);

            $this->agregarTarifaAplicadaAgrupos($entity->Grupos , $tarifaAplicadaID);
            $this->agregarTarifaAplicadaApasajerosdDeGrupos($entity->Grupos , $tarifaAplicadaID);

            return $this->redirect(
                ['controller' => 'Tarifas_aplicadas', 'action' => 'aplicartarifaagrupos', $json]
            );
        }

        $this->set('grupo', $grupo);
        $this->set('_serialize', ['grupo']);
        $this->set('grupos_options', $grupos_options);
        $this->set('_serialize', ['grupos_options']);
        $this->set('primeracuota', $primeracuota);
        $this->set('_serialize', ['primeracuota']);
        $this->set('tarifa', $tarifa);
        $this->set('_serialize', ['tarifa']);
    }

    private function agregarTarifaAplicadaAgrupos($ids, $tarifaAplicadaID) {
        $queryResults = $this->Grupos->find('all', array(
            'conditions' => array('id IN' => $ids)
        ));

        foreach ($queryResults as $result) {
            $result->usuario_modificacion = $this->Auth->user('id');
            $result->fecha_modificacion = Time::now();
            $result->tarifa_aplicada_id = $tarifaAplicadaID;
        }

        $this->Grupos->saveMany($queryResults);
    }

    private function agregarTarifaAplicadaApasajerosdDeGrupos($grupoIDs, $tarifaAplicadaID) {
        $pasajerosDeGruposTable = TableRegistry::get('Pasajerosdegrupos');
        $pasajerosDeGrupos = $pasajerosDeGruposTable->find('all', array(
            'conditions' => array('id IN' => $grupoIDs)
        ));
        foreach ($pasajerosDeGrupos as $pasajero) {
            $pasajero->usuario_modificacion = $this->Auth->user('id');
            $pasajero->fecha_modificacion = Time::now();
            $pasajero->tarifa_aplicada_id = $tarifaAplicadaID;
            $pasajero->tarifa_aceptada = 0;
        }
        $result = $pasajerosDeGruposTable->saveMany($pasajerosDeGrupos);
    }
}