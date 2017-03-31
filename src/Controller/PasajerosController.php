<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 15/2/17
 * Time: 6:26 PM
 */

namespace App\Controller;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;


class PasajerosController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow('registrarse');
    }

    /**
     * Index method
     * @return \Cake\Network\Response|null
     */
    public function listAll($camada_id = null) {
/*        $this->viewBuilder()->layout('ajax');

        $query = $this->Camadas->find('all', ['contain' => ['Personas']])
            ->where(['camada_id' => $camada_id]);

        $this->set('camadas', $this->paginate($query));
        $this->set('_serialize', ['camadas']);*/
    }


    public function registrarse() {
        $this->viewBuilder()->layout('blankLayout');
        $pasajero = $this->Pasajeros->newEntity();
        $codigoGrupo = "";

        if ($this->request->is(['patch', 'post', 'put'])) {
            $gruposTable = TableRegistry::get('Grupos');
            $query = $gruposTable->find('all')->where(['codigo_grupo' => $codigoGrupo, 'eliminado' => 0]);
            $grupo = $query->first();

            if (!is_null($grupo)) {
                $pasajero = $this->Pasajeros->patchEntity($pasajero, $this->request->data, [
                    'associated' => [
                        'Personas' => [
                            'associated' => ['Direcciones']
                        ]
                    ]
                ]);

                $persona_id = $this->persistirPersona($pasajero->persona);
                $pasajero->fecha_creacion = Time::now();
                $pasajero->eliminado = 0;
                $pasajero->persona_id = $persona_id;

                $result = $this->Pasajeros->save($pasajero);
                $pasajero_id = $result->id;

                $pasajerosGruposTable = TableRegistry::get('Pasajerosdegrupos');
                $pasajeroGrupo = $pasajerosGruposTable->newEntity();
                $pasajeroGrupo->id_pasajero = $pasajero_id;
                $pasajeroGrupo->id_grupo = $grupo->id;
                $pasajeroGrupo->acompanante = 0;
                $pasajeroGrupo->lista_espera = 0;
                $pasajeroGrupo->actividad_cuenta = $this->getInactivo()->id;
                $pasajeroGrupo->regularidad = $this->getRegular()->id;
                $pasajeroGrupo->eliminado = 0;
                $pasajeroGrupo->fecha_creacion = Time::now();
                $pasajeroGrupo->usuario_creacion = $this->Auth->user('id');

                $result = $pasajerosGruposTable->save($pasajeroGrupo);
                $pasajeroGrupo_id = $result->id;

                return $this->redirect(
                    ['controller' => 'Responsables', 'action' => 'paso2', $pasajeroGrupo_id]
                );
            } else {
                $this->Flash->error(__('Código de grupo inválido. Por favor, intente nuevamente'));
            }



        }


        $this->set(compact('pasajero'));
        $this->set('_serialize', ['pasajero']);
        $this->set(compact('codigoGrupo'));
        $this->set('_serialize', ['codigoGrupo']);
    }


    private function persistirDireccion($direccion) {
        $baseDireccion = TableRegistry::get('Direcciones');

        $direccion->fecha_creacion = Time::now();
        $direccion->usuario_creacion = 2;
        $direccion->eliminado = 0;

        $resultDireccion = $baseDireccion->save($direccion);

        return $resultDireccion->id;
    }

    private function persistirPersona($persona) {
        $direcion_id = $this->persistirDireccion($persona->direccione);
        $basePersonas = TableRegistry::get('Personas');

        $persona->eliminado = 0;
        $persona->perfil = "CLIENTE";
        $persona->fecha_creacion = Time::now();
        $persona->contrasena = $persona->dni . Time::now()->toDateTimeString();
        $persona->direccion_id = $direcion_id;

        $resultPersona = $basePersonas->save($persona);
        return $resultPersona->id;
    }

    private function getRegular() {
        $query = TableRegistry::get('Diccionarios')->find('all')->where(['param1' => "PASAJEROS_DE_GRUPOS",
            'param2' => 'SITUACION', 'param3' => 'REGULAR']);
        return $query->first();
    }

    private function getInactivo() {
        $query = TableRegistry::get('Diccionarios')->find('all')->where(['param1' => "PASAJEROS_DE_GRUPOS",
            'param2' => 'CUENTA', 'param3' => 'INACTIVO']);
        return $query->first();
    }

}