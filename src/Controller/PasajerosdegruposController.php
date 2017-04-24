<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 19/2/17
 * Time: 8:14 PM
 */

namespace App\Controller;
use App\Model\Entity\Diccionario;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;


class PasajerosDeGruposController extends AppController {

    public function index($grupo_id = null) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            if ($grupo_id == null) {
                $pasajerosGrupos = $this->Pasajerosdegrupos->find('all', ['contain' => ['Diccionarios', 'Pasajeros' => ['Personas'], 'Grupos']])
                    ->where(['pasajerodegrupo_eliminado' => 0]);
            } else {
                $pasajerosGrupos = $this->Pasajerosdegrupos->find('all', ['contain' => ['Diccionarios', 'Pasajeros' => ['Personas'], 'Grupos']])
                    ->where(['id_grupo' => $grupo_id, 'pasajerodegrupo_eliminado' => 0]);
            }

            $diccionarios = $this->getDiccionariosPasajerosDeGrupo();

            $regular_id = -1;
            $activo_id = -1;
            foreach ($diccionarios as $diccionario) {
                if ($diccionario->param2 === "SITUACION" && $diccionario->param3 === "REGULAR") $regular_id = $diccionario->id;
                if ($diccionario->param2 === "CUENTA" && $diccionario->param3 === "ACTIVO") $activo_id = $diccionario->id;

            }

            foreach ($pasajerosGrupos as $pasajerosGrupo) {
                if ($pasajerosGrupo->regularidad = $regular_id) $pasajerosGrupo->regular = "Regular";
                else $pasajerosGrupo->regular = "Irregular";

                if ($pasajerosGrupo->actividad_cuenta = $activo_id) $pasajerosGrupo->cuenta = "Activo";
                else $pasajerosGrupo->cuenta = "Inactivo";
            }
            $this->set('regular_id', $regular_id);
            $this->set('activo_id', $activo_id);
            $this->set('pasajerosGrupos', $pasajerosGrupos);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    private function getDiccionariosPasajerosDeGrupo() {
        return TableRegistry::get('Diccionarios')->find('all')->where(['param1' => "PASAJEROS_DE_GRUPOS"]);
    }

    /**
     * Index method
     * @return \Cake\Network\Response|null
     */
    public function pasajerosDeGrupo($grupo_id = null) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $this->viewBuilder()->layout('ajax');

            $query = $this->Pasajerosdegrupos->find('all', ['contain' => ['Diccionarios', 'Pasajeros' => ['Personas'], 'Grupos']])
                ->where(['id_grupo' => $grupo_id]);

            $pasajerosdegrupos = $this->paginate($query);
            $this->set('pasajerosdegrupos', $pasajerosdegrupos);
            $this->set('_serialize', ['pasajerosdegrupos']);

            //        $nombre_grupo = $pasajerosdegrupos->first()->grupo->nombre;
            $registrados = $pasajerosdegrupos->count();
            //        $pasajerosEstimados = $pasajerosdegrupos->first()->grupo->pasajeros_estimados;
            $hombres = 0;
            $mujeres = 0;
            $totalPesos = 1000;
            $totalDolares = 1000;
            $pagoPesos = 150;
            $pagoDolares = 100;
            $acompanantes = array();
            $regulares = array();
            $listaEspera = array();


            foreach ($pasajerosdegrupos as $pasajero) {
                if (strcmp($pasajero->persona, "F")) $mujeres = $mujeres + 1;
                else $hombres = $hombres + 1;

                if ($pasajero->acompanante) array_push($acompanantes, $pasajero);
                else array_push($regulares, $pasajero);
            }

            $this->set('hombres', $hombres);
            $this->set('mujeres', $mujeres);
            $this->set('registrados', $registrados);
            //        $this->set('nombre_grupo', $nombre_grupo);
            //        $this->set('pasajerosEstimados', $pasajerosEstimados);
            $this->set('acompanantes', $acompanantes);
            $this->set('regulares', $regulares);
            $this->set('listaEspera', $listaEspera);
            $this->set('totalPesos', $totalPesos);
            $this->set('totalDolares', $totalDolares);
            $this->set('pagoPesos', $pagoPesos);
            $this->set('pagoDolares', $pagoDolares);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function aceptarcontrato($pasajerogrupoID=null) {
        $userID = $this->Auth->user('id');
        if ($this->isClient($userID)) {
            $this->viewBuilder()->layout('clientsBlankLayout');
            if (is_null($pasajerogrupoID)) {
                $responsablesTable = TableRegistry::get('Responsables');
                $responsable = $responsablesTable->find('all', ['contain' => ['Pasajeros']])
                    ->where(['Responsables.persona_id' => $userID])
                    ->first();

                if (is_null($responsable)) {
                    $pasajerosTable = TableRegistry::get('Pasajeros');
                    $pasajero = $pasajerosTable->find('all')
                        ->where(['persona_id' => $userID])
                        ->first();
                    $idPasajero = $pasajero['id'];
                } else {
                    $idPasajero = $responsable['pasajero']['id'];
                }
                $pasajerodegrupo= TableRegistry::get('Pasajerosdegrupos')->find()
                    ->where(['id_pasajero' => $idPasajero, 'pasajerodegrupo_eliminado' => 0])
                    ->first();
                $pasajerogrupoID= $pasajerodegrupo['id'];
            }

            $pasajerogrupo = $this->Pasajerosdegrupos->get($pasajerogrupoID);

            $gruposTable = TableRegistry::get('Grupos');
            $query = $gruposTable->find()
                ->where(['id' => $pasajerogrupo->id_grupo]);
            $grupo = $query->first();
            $contratoID = $grupo['contrato'];

            if ($this->request->is(['patch', 'post', 'put'])) {
                $pasajerogrupo->tarifa_aceptada = 1;
                $this->Pasajerosdegrupos->save($pasajerogrupo);
                return $this->redirect(['action' => 'aceptarplan', $pasajerogrupoID]);
            }
            $this->set('contratoID', $contratoID);
            $this->set('pasajerogrupo', $pasajerogrupo);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function aceptarplan($pasajerogrupoID=null) {
        $userID = $this->Auth->user('id');
        if ($this->isClient($userID)) {
            $this->viewBuilder()->layout('clientsBlankLayout');
            if (is_null($pasajerogrupoID)) {
                $responsablesTable = TableRegistry::get('Responsables');
                $responsable = $responsablesTable->find('all', ['contain' => ['Pasajeros']])
                    ->where(['Responsables.persona_id' => $userID])
                    ->first();

                if (is_null($responsable)) {
                    $pasajerosTable = TableRegistry::get('Pasajeros');
                    $pasajero = $pasajerosTable->find('all')
                        ->where(['persona_id' => $userID])
                        ->first();
                    $idPasajero = $pasajero['id'];
                } else {
                    $idPasajero = $responsable['pasajero']['id'];
                }
                $pasajerodegrupo= TableRegistry::get('Pasajerosdegrupos')->find()
                    ->where(['id_pasajero' => $idPasajero, 'pasajerodegrupo_eliminado' => 0])
                    ->first();
                $pasajerogrupoID= $pasajerodegrupo['id'];
            }
            $pasajerogrupo = $this->Pasajerosdegrupos->get($pasajerogrupoID);
            $cuotasAplicadasTable = TableRegistry::get('CuotasAplicadas');
                
            $query = $cuotasAplicadasTable->find('all', ['contain' => ['Cuotas', 'pasajerosdegrupos']])
                ->where(['pasajero_grupo_id' => $pasajerogrupoID, 'cuota_aplicada_eliminado' => 0]);
            $cuotas = $this->paginate($query);

            if ($cuotas->count() <= 0) {
                $cuotas = array();
            }


            if ($this->request->is(['patch', 'post', 'put'])) {
                $pasajerogrupo->plan_aceptado = 1;
                $this->Pasajerosdegrupos->save($pasajerogrupo);
                return $this->redirect(
                    ['controller' => 'Home', 'action' => 'clientes', $pasajerogrupoID])
                ;
            }

            $this->set(compact('cuotas'));
            $this->set('_serialize', ['cuotas']);

        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }
}