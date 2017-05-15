<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 19/2/17
 * Time: 8:14 PM
 */

namespace App\Controller;
use App\Model\Entity\Diccionario;
use App\Model\Entity\Responsable;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;


class PasajerosDeGruposController extends AppController {

    public $paginate = [
        'limit' => 200,
    ];

    public function initialize(){
        parent::initialize();
        $this->loadComponent('Paginator');
    }

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

                if ($pasajerosGrupo->tarifa_aceptada) {
                    $pasajerosGrupo->contratoaceptado = "<span class=\"label label-success\">Aceptado</span>";
                } else {
                    $pasajerosGrupo->contratoaceptado =  "<span class=\"label label-danger\">Pendiente</span>";
                }

                if ($pasajerosGrupo->plan_aceptado) {
                    $pasajerosGrupo->planaceptado = "<span class=\"label label-success\">Aceptado</span>";
                } else {
                    $pasajerosGrupo->planaceptado =  "<span class=\"label label-danger\">Pendiente</span>";
                }

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


            $query = $this->Pasajerosdegrupos->find('all', ['contain' => ['Diccionarios',
                'TarifasAplicadas' => ['Tarifas'], 'Pasajeros' => ['Personas'], 'Grupos' => ['TarifasAplicadas' => ['Tarifas']]]])
                ->where(['id_grupo' => $grupo_id, 'pasajerodegrupo_eliminado' => 0]);

            $pasajerosdegrupos = $this->paginate($query);
            $this->set('pasajerosdegrupos', $pasajerosdegrupos);
            $this->set('_serialize', ['pasajerosdegrupos']);
            $pasajeros_estimados = 0;
            if ($pasajerosdegrupos->count() > 0) {
                $unpasajero = $pasajerosdegrupos->first();
                $pasajeros_estimados = $unpasajero['grupo']['pasajeros_estimados'];
            }
            $registrados = $pasajerosdegrupos->count();
            $hombres = 0;
            $mujeres = 0;
            $totalPesos = 0;
            $totalDolares = 0;
            $acompanantes = array();
            $regulares = array();
            $listaEspera = array();

            $diccionarios = $this->getDiccionariosPasajerosDeGrupo();

            $regular_id = -1;
            $activo_id = -1;
            foreach ($diccionarios as $diccionario) {
                if ($diccionario->param2 === "SITUACION" && $diccionario->param3 === "REGULAR") $regular_id = $diccionario->id;
                if ($diccionario->param2 === "CUENTA" && $diccionario->param3 === "ACTIVO") $activo_id = $diccionario->id;

            }

            foreach ($pasajerosdegrupos as $pasajero) {
                if (!is_null($pasajero['persona']['sexo'])) {
                    if (strcmp($pasajero->persona->sexo, "F")) $mujeres = $mujeres + 1;
                    else $hombres = $hombres + 1;
                }

                if ($pasajero['tarifa_aplicada_id'] == null) {
                    $pasajero['tarifas_aplicada'] = $pasajero['grupo']['tarifas_aplicada'];
                }

                $totalPesos = $totalPesos + $pasajero['tarifas_aplicada']['tarifa']['monto_pesos'];
                $totalDolares = $totalDolares + $pasajero['tarifas_aplicada']['tarifa']['monto_dolares'];

                if ($pasajero->regularidad = $regular_id) $pasajero->regular = "Regular";
                else $pasajero->regular = "Irregular";

                if ($pasajero->actividad_cuenta = $activo_id) $pasajero->cuenta = "Activo";
                else $pasajero->cuenta = "Inactivo";


                if ($pasajero->tarifa_aceptada) {
                    $pasajero->contratoaceptado = "<span class=\"label label-success\">Aceptado</span>";
                } else {
                    $pasajero->contratoaceptado =  "<span class=\"label label-danger\">Pendiente</span>";
                }

                if ($pasajero->plan_aceptado) {
                    $pasajero->planaceptado = "<span class=\"label label-success\">Aceptado</span>";
                } else {
                    $pasajero->planaceptado =  "<span class=\"label label-danger\">Pendiente</span>";
                }

                if ($pasajero->acompanante) array_push($acompanantes, $pasajero);
                else array_push($regulares, $pasajero);
            }

            $this->set('pasajeros_estimados', $pasajeros_estimados);
            $this->set('hombres', $hombres);
            $this->set('mujeres', $mujeres);
            $this->set('registrados', $registrados);
            $this->set('acompanantes', $acompanantes);
            $this->set('regulares', $regulares);
            $this->set('listaEspera', $listaEspera);
            $this->set('totalPesos', $totalPesos);
            $this->set('totalDolares', $totalDolares);

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
                    ->where(['Responsables.persona_id' => $userID, 'responsable_eliminado' => 0])
                    ->first();

                if (is_null($responsable)) {
                    $pasajerosTable = TableRegistry::get('Pasajeros');
                    $pasajero = $pasajerosTable->find('all')
                        ->where(['persona_id' => $userID, 'pasajero_eliminado' => 0])
                        ->first();
                    $idPasajero = $pasajero['id'];
                } else {
                    $idPasajero = $responsable['pasajero']['id'];
                }

                $pasajerodegrupo= TableRegistry::get('Pasajerosdegrupos')->find()
                    ->where(['id_pasajero' => $idPasajero, 'pasajerodegrupo_eliminado' => 0])
                    ->first();
                $this->set('$pasajerodegrupo', $pasajerodegrupo);

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
                    ->where(['Responsables.persona_id' => $userID, 'pasajero_eliminado' => 0])
                    ->first();

                if (is_null($responsable)) {
                    $pasajerosTable = TableRegistry::get('Pasajeros');
                    $pasajero = $pasajerosTable->find('all')
                        ->where(['persona_id' => $userID, 'pasajero_eliminado' => 0])
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
                
            $query = $cuotasAplicadasTable->find('all', ['contain' => ['Cuotas', 'Pasajerosdegrupos']])
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

    public function verPasajero($idPasajero) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            return $this->redirect(
                ['controller' => 'Pasajeros', 'action' => 'view', $idPasajero]
            );
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function editarPasajero($idPasajero) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            return $this->redirect(
                ['controller' => 'Pasajeros', 'action' => 'edit', $idPasajero]
            );
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function borrarPasajero($idPasajeroGrupo) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $pasajeroGrupo = $this->Pasajerosdegrupos->get($idPasajeroGrupo, ['contain' => ['Pasajeros' => ['Personas']]]);
            $pasajero = $pasajeroGrupo->pasajero;
            $persona = $pasajero->persona;

            $basePersona = TableRegistry::get('Personas');
            $persona->persona_eliminado = 1;
            $persona->usuario_eliminado = $this->Auth->user('id');;
            $persona->fecha_eliminado = Time::now();
            $result = $basePersona->save($persona);

            $basePasajeros = TableRegistry::get('Pasajeros');
            $pasajero->pasajero_eliminado = 1;
            $pasajero->usuario_eliminado = $this->Auth->user('id');;
            $pasajero->fecha_eliminado = Time::now();
            $result = $basePasajeros->save($pasajero);

            $pasajeroGrupo->pasajerodegrupo_eliminado = 1;
            $pasajeroGrupo->usuario_eliminado = $this->Auth->user('id');;
            $pasajeroGrupo->fecha_eliminado = Time::now();
            $result = $this->Pasajerosdegrupos->save($pasajeroGrupo);

            $responsables = TableRegistry::get('Responsables')->find('all')->where(['pasajero_id' => $pasajero->id]);
            foreach ($responsables as $responsable) {
                $persona = $basePersona->get($responsable->persona_id);
                $persona->usuario_eliminado = $this->Auth->user('id');
                $persona->fecha_eliminado = $this->Auth->user('id');
                $persona->persona_eliminado = 1;
                $basePersona->save($persona);

                $responsable->usuario_eliminado = $this->Auth->user('id');
                $responsable->fecha_eliminado = $this->Auth->user('id');
                $responsable->responsable_eliminado = 1;

                TableRegistry::get('Responsables')->save($responsable);
            }
            return $this->redirect(['action' => 'index']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function generarreporte() {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $showOptions = true;
            $showTable=false;
            $pasajerodegrupo = $this->Pasajerosdegrupos->newEntity();
            $options = array("personas.nombre"=>"nombre", "personas.apellido"=>"apellido", "personas.dni"=>"dni",
                "personas.telefono"=>"telefono", "personas.celular"=>"celular", "personas.sexo"=>"sexo",
                "personas.nacionalidad"=>"nacionalidad", "personas.mail"=>"mail", "direccion"=>"direccion",
                "pasajeros.pasaporte"=>"pasaporte");

            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->data;
                $chosenOptions = $data['atributos'];
                $query = $this->Pasajerosdegrupos->find()
                    ->hydrate(false)
                    ->join([
                        'pasajeros' => [
                            'table' => 'pasajeros',
                            'type' => 'INNER',
                            'conditions' => 'pasajeros.id = id_pasajero',
                        ],
                        'personas' => [
                            'table' => 'personas',
                            'type' => 'INNER',
                            'conditions' => 'personas.id = persona_id',
                        ]
                    ])
                    ->select(array_values($chosenOptions))
                    ->where(['persona_eliminado' => 0, 'pasajero_eliminado'=>0]);
                $pasajerosdegrupo = $query->toArray();

                $headers = array();
                foreach ($chosenOptions as $option) {
                    if (array_key_exists($option, $options)) {
                        array_push($headers,$options[$option]);
                    }
                }

                $showOptions = false;
                $showTable = true;
                $this->set('headers', $headers);
                $this->set('pasajerosGrupos', $pasajerosdegrupo);
            }
            $this->set('options', $options);
            $this->set('showOptions', $showOptions);
            $this->set('showTable', $showTable);
            $this->set('pasajerodegrupo', $pasajerodegrupo);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }
}