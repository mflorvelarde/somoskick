<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 5/2/17
 * Time: 1:15 AM
 */

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class CamadasController extends AppController{

    public function index($colegio_id = null) {
    //    $persona = $this->Auth->user('id');
      //  if ($this->isAdmin($persona)) {

        $pasajerosdegrupos = TableRegistry::get('Pasajerosdegrupos');

        if ($colegio_id != null) {
            $query = $this->Camadas->find('all', ['contain' => ['Colegios', 'Grupos', 'Diccionarios', 'Personas']])
                ->where(['colegio_id' => $colegio_id, 'camada_eliminado' => 0]);

            $queryPasajeros = $pasajerosdegrupos->find()
                ->hydrate(false)
                ->join([
                    'pasajeros' => [
                        'table' => 'pasajeros',
                        'type' => 'INNER',
                        'conditions' => 'pasajeros.id = id_pasajero',
                    ],
                    'grupos' => [
                        'table' => 'grupos',
                        'type' => 'INNER',
                        'conditions' => 'grupos.id = id_grupo',
                    ],
                    'camadas' => [
                        'table' => 'camadas',
                        'type' => 'INNER',
                        'conditions' => 'grupos.id = grupo_id',
                    ]
                ])
                ->where(['camadas.colegio_id' => $colegio_id])
            ;

        } else {
            $query = $this->Camadas->find('all', ['contain' => ['Colegios', 'Grupos', 'Diccionarios', 'Personas']])
                ->where(['camada_eliminado' => 0]);

            $queryPasajeros = $pasajerosdegrupos->find()
                ->hydrate(false)
                ->join([
                    'pasajeros' => [
                        'table' => 'pasajeros',
                        'type' => 'INNER',
                        'conditions' => 'pasajeros.id = id_pasajero',
                    ],
                    'grupos' => [
                        'table' => 'grupos',
                        'type' => 'INNER',
                        'conditions' => 'grupos.id = id_grupo',
                    ],
                    'camadas' => [
                        'table' => 'camadas',
                        'type' => 'INNER',
                        'conditions' => 'grupos.id = grupo_id',
                    ]
                ])
            ;
        }
        $camadas = $this->paginate($query);
        $resultPasajeros = $queryPasajeros->toList();
        $diccionarios = $this->getDiccionariosPasajerosDeGrupo();

        $regular_id = -1;
        $activo_id = -1;
        foreach ($diccionarios as $diccionario) {
            if ($diccionario->param2 === "SITUACION" && $diccionario->param3 === "REGULAR") $regular_id = $diccionario->id;
            if ($diccionario->param2 === "CUENTA" && $diccionario->param3 === "ACTIVO") $activo_id = $diccionario->id;

        }

        foreach ($camadas as $camadaEntity) {
            $regulares = 0;
            $activos = 0;
/*            if (!is_null($resultPasajeros) && $resultPasajeros != array()) {
                foreach ($resultPasajeros as $pasajero) {
                    if (!is_null($pasajero) && $pasajero != array()) {
                       if ($pasajero->id_grupo == $camadaEntity->id_grupo) {
                            if ($pasajero->actividad_cuenta == $activo_id) $activos = $activos + 1;
                            if ($pasajero->regularidad == $regular_id) $regulares = $regulares + 1;
                            $resultPasajeros = array_diff($resultPasajeros, array($pasajero));
                        }
                    }

                }
            }*/
            $camadaEntity->regulares = $regulares;
            $camadaEntity->registrados = $regulares;

            if (is_null($camadaEntity->persona)) {
                $personaVacia = TableRegistry::get('Personas')->newEntity();
                $personaVacia->nombre = "";
                $camadaEntity->persona = $personaVacia;
            }
            if (is_null($camadaEntity->grupo->pasajeros_estimados)) {
                $camadaEntity->grupo->pasajeros_estimados = "";
            }
        }



        $this->set('diccionarios', $diccionarios);
        $this->set('_serialize', ['diccionarios']);
        $this->set('resultPasajeros', $resultPasajeros);
        $this->set('_serialize', ['resultPasajeros']);
        $this->set('camadas', $camadas);
        $this->set('_serialize', ['camadas']);
    }

    public function view($id = null) {
        $camada = $this->Camadas->get($id, ['contain' => ['Colegios', 'Grupos' => ['Tarifas_Aplicadas' => ['Tarifas']],
            'Diccionarios', 'Personas']]);

        if (is_null($camada->grupo->tarifas__aplicada) || $camada->grupo->tarifas__aplicada != array()) {
            $tarifa = TableRegistry::get('Tarifas')->newEntity();
            $tarifa->descripcion = "";
            $tarifas__aplicada = TableRegistry::get('TarifasAplicadas')->newEntity();
            $tarifas__aplicada->tarifa = $tarifa;
            $camada->grupo->tarifas__aplicada = $tarifas__aplicada;
        }

        $this->set(compact('camada'));
        $this->set('_serialize', ['camada']);
    }

    private function getDiccionariosPasajerosDeGrupo() {
        return TableRegistry::get('Diccionarios')->find('all')->where(['param1' => "PASAJEROS_DE_GRUPOS"]);
    }

    public function add($colegioId = null) {
        $colegios_options = array();
        $camada = $this->Camadas->newEntity();
        $colegiosTable = TableRegistry::get('Colegios');

        if ($colegioId != null) {
            $colegios_options = $colegiosTable->find('list', array(
                'conditions' => array('id' => $colegioId),
                'valueField' => array('nombre')
            ));
            $camada->colegio_id = $colegioId;
        } else {
            $colegios_options = $colegiosTable->find('list', ['valueField' => 'nombre']);
        }

        $vendedores = TableRegistry::get('Personas')->find('list', array(
            'conditions' => array('perfil != ' => 'CLIENTE'),
            'order'=> array('nombre'),
            'valueField' => array('nombre')
        ));

        $estados =  TableRegistry::get('Diccionarios')->find('list', array(
            'conditions' => array('param1' => 'CAMADAS', 'param2' => 'STATUS'),
            'valueField' => array('value')
        ));

        if ($this->request->is('post')) {
            $camada = $this->Camadas->patchEntity($camada, $this->request->data, [
                'associated' => [
                    'Grupos'
                ]
            ]);

            $grupos = TableRegistry::get('Grupos')->newEntity();
            $grupos->nombre = $camada->grupo->nombre;
            $grupos->contrato = $camada->grupo->contrato;
            $grupos->pasajeros_estimados = $camada->grupo->pasajeros_estimados;
            $grupos->grupo_eliminado = 0;
            $grupos->codigo_grupo = $this->generateGroupCode();
            $grupos->fecha_creacion = Time::now();
            $grupos->usuario_creacion = $this->Auth->user('id');;

            $result = TableRegistry::get('Grupos')->save($grupos);
            $grupos_id = $result->id;

            $camada->usuario_creacion = $this->Auth->user('id');;
            $camada->fecha_creacion = Time::now();
            $camada->camada_eliminado = 0;
            $camada->grupo = null;
            $camada->grupo_id = $grupos_id;

            if ($this->Camadas->save($camada)) {
                $this->Flash->success(__('La camada fue guardada'));

                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error(__('La camada no pudo ser guardada. Por favor, intente nuevamente'));
            }
        }
        $this->set(compact('estados'));
        $this->set('_serialize', ['estados']);
        $this->set(compact('vendedores'));
        $this->set('_serialize', ['vendedores']);
        $this->set(compact('colegios_options'));
        $this->set('_serialize', ['colegios_options']);
        $this->set(compact('camada'));
        $this->set('_serialize', ['camada']);
    }

    private function generateGroupCode() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $code = '';
        for ($i = 0; $i < 16; $i++) {
            $code .= $characters[rand(0, $charactersLength - 1)];
        }
        return $code;
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);

        $camada = $this->Camadas->get($id);
        $camada->camada_eliminado = 1;
        $camada->usuario_eliminado = $this->Auth->user('id');;
        $camada->fecha_eliminado = date("d/m/Y");
        if ($this->Camadas->save($camada)) {
            $this->Flash->success(__('La camada fue eliminada'));
        } else {
            $this->Flash->error(__('La camada no pudo ser eliminada. Por favor, intente nuevamente'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function buscartarifas($camada_id) {
        $camada = $this->Camadas->get($camada_id, ['contain' => ['Colegios', 'Grupos', 'Diccionarios']]);
        $tarifas = TableRegistry::get('Tarifas')->find('all');

        $this->set(compact('fecha_inicio'));
        $this->set('_serialize', ['fecha_inicio']);
        $this->set(compact('camada'));
        $this->set('_serialize', ['camada']);
        $this->set(compact('tarifas'));
        $this->set('_serialize', ['tarifas']);
    }

    public function seleccionarfecha($tarifa_id, $camada_id) {
        $this->viewBuilder()->layout('ajax');

        $fecha_inicio = null;
        $this->set(compact('fecha_inicio'));
        $this->set('_serialize', ['fecha_inicio']);
    }

    public function aplicartarifa($tarifa_id, $camada_id) {
        $camada = $this->Camadas->get($camada_id, ['contain' => ['Colegios', 'Grupos', 'Diccionarios', 'Personas']]);

        $tarifasAplicadasTable = TableRegistry::get('TarifasAplicadas');
        $tarifaAplicada = $tarifasAplicadasTable->newEntity();
        $tarifaAplicada->tarifa_id = $tarifa_id;
        $tarifaAplicada->usuario_creacion = 2;
        $tarifaAplicada->fecha_creacion = Time::now();
        $tarifaAplicada->tarifa_aplicada_eliminado = 0;

        $result = $tarifasAplicadasTable->save($tarifaAplicada);
        $tarifaAplicada_id = $result->id;

        $camada->grupo->tarifa_aplicada_id = $tarifaAplicada_id;
        TableRegistry::get('Grupos')->save($camada->grupo);

        return $this->redirect(
            ['controller' => 'Cuotas', 'action' => 'add', $tarifaAplicada_id]
        );
    }

    public function edit($id = null) {
        if ($id == null) {
            $id = 8;
        }
        $camada = $this->Camadas->get($id, ['contain' => ['Grupos']]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $camada = $this->Camadas->patchEntity($camada, $this->request->data);
            $camada->usuario_modificacion = $this->Auth->user('id');;
            $camada->fecha_modificacion = date("d/m/Y");

            if ($this->Camadas->save($camada)) {
                $this->Flash->success(__('La camada fue guardada'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La camada no pudo ser guardada. Por favor, intente nuevamente'));
            }
        }
        $this->set(compact('camada'));
        $this->set('_serialize', ['camada']);
    }
}