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
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $grupos_options = $this->Grupos->find('list', array(
                'conditions' => array('tarifa_aplicada_id IS' => null, 'grupo_eliminado' => 0),
                'valueField' => array('nombre')
            ));

            $grupo = $this->Grupos->newEntity();
            $tarifa = TableRegistry::get('Tarifas')->get($tarifa_id, ['contain' => []]);
            $primeracuota = Time::now();

            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->data;
                $json = json_encode($data);
                $entity = json_decode($json);

                $tarifasAplicadasTable = TableRegistry::get('TarifasAplicadas');
                $tarifaAplicada = $tarifasAplicadasTable->newEntity();
                $tarifaAplicada->tarifa_id = $tarifa_id;
                $tarifaAplicada->tarifa_aplicada_eliminado = 0;
                $tarifaAplicada->fecha_primer_pago = Time::create($entity->primeracuota->year,
                    $entity->primeracuota->month, $entity->primeracuota->day);
                $tarifaAplicada->fecha_creacion = Time::now();
                $tarifaAplicada->usuario_creacion = $this->Auth->user('id');;

                $result = $tarifasAplicadasTable->save($tarifaAplicada);
                $tarifaAplicadaID = $result->id;

                $this->agregarTarifaAplicadaAgrupos($entity->Grupos, $tarifaAplicadaID);
                $this->agregarTarifaAplicadaApasajerosdDeGrupos($entity->Grupos, $tarifaAplicadaID);

                return $this->redirect(
                    ['controller' => 'Cuotas', 'action' => 'add', $tarifaAplicadaID]
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
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function contrato() {
        $userID = $this->Auth->user('id');
        if ($userID) {
            $responsablesTable = TableRegistry::get('Responsables');
            $responsable = $responsablesTable->find('all', ['contain' => ['Pasajeros']])
                ->where(['Responsables.persona_id' => $userID])
                ->first();

            $idPasajero = $this->getPasajeroID($userID);

            $query = $this->Grupos->find()
                ->hydrate(false)
                ->join([
                    'pasajerosdegrupos' => [
                        'table' => 'pasajerosdegrupos',
                        'type' => 'INNER',
                        'conditions' => ['id_grupo = Grupos.id']
                    ],
                    'pasajeros' => [
                        'table' => 'pasajeros',
                        'type' => 'INNER',
                        'conditions' => ['pasajeros.id = id_pasajero'],
                    ]

            ])->where(['pasajeros.id' => $idPasajero]);
            $grupo = $this->paginate($query)->first();

            $filesTable = TableRegistry::get('Files');
            $file = $filesTable->find()
                ->where(['id' => $grupo['contrato'], 'status' => 1])
                ->first();

            if ($file) {
                $this->response->file($file->path . $file->name);
                $this->response->header('Content-Disposition', 'inline');
                return $this->response;
            } else {
                return $this->redirect(
                    ['controller' => 'Home', 'action' => 'clientes']
                );
            }
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }

    }

    public function vercontrato($id) {
        $userID = $this->Auth->user('id');
        if (!is_null($userID)) {
            $this->viewBuilder()->layout('ajax');
            $filesTable = TableRegistry::get('Files');
            $file = $filesTable->find()
                ->where(['id' => $id, 'status' => 1])
                ->first();
            $this->set('file', $file);

//
//            if ($file) {
//                $this->response->file($file->path . $file->name);
//                $this->response->header('Content-Disposition', 'inline');
//                return $this->response;
//            }
        }
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
            'conditions' => array('id_grupo IN' => $grupoIDs, 'pasajerodegrupo_eliminado' => 0)
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