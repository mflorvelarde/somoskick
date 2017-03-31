<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 7/2/17
 * Time: 8:29 AM
 */

namespace App\Controller;

use App\Model\Entity\Responsable;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class ResponsablesController extends AppController{
    public $pasajero;
    public $responsable1;
    public $responsable2;

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['registrar', 'paso2', 'paso3']);
    }

    public function add() {
        $responsable = $this->Responsables->newEntity();

        if ($this->request->is('post')) {
            $responsable = $this->Responsables->patchEntity($responsable, $this->request->data, [
                'associated' => [
                    'Personas'
                ]
            ]);
        }
    }

    public function paso2($pasajeroGrupo_id) {
        $pasajeroGrupo = TableRegistry::get('Pasajerosdegrupos')->get($pasajeroGrupo_id,
            ['contain' => ['Diccionarios', 'Pasajeros' => ['Personas'],'Grupos']]);


        $this->viewBuilder()->layout('blankLayout');
        $familiar1 = $this->Responsables->newEntity();
        $cuitcuil1 = "";

        if ($this->request->is('post')) {
            $familiar1 = $this->Responsables->patchEntity($familiar1, $this->request->data, [
                'associated' => [
                    'Personas' => [
                        'associated' => ['Direcciones']
                    ]
                ]
            ]);

            if ($cuitcuil1 === "Cuil") {
                $familiar1->cuil = $familiar1->cuit;
                $familiar1->cuit = null;
            }

            $persona_id = $this->persistirPersona($familiar1->persona);

            $familiar1->usuario_creacion = $pasajeroGrupo->pasajero->persona->id;
            $familiar1->fecha_creacion = Time::now();
            $familiar1->eliminado = 0;
            $familiar1->persona_id = $persona_id;
            $familiar1->pasajero_id = $pasajeroGrupo->pasajero->id;
            $familiar_id = $this->persistirResponsable($familiar1);

            return $this->redirect(['action' => 'paso3', $pasajeroGrupo_id]);
        }
        $this->set(compact('familiar1'));
        $this->set('_serialize', ['familiar1']);
        $this->set(compact('cuitcuil1'));
        $this->set('_serialize', ['cuitcuil1']);
    }

    public function paso3($pasajeroGrupo_id) {
        $pasajeroGrupo = TableRegistry::get('Pasajerosdegrupos')->get($pasajeroGrupo_id,
            ['contain' => ['Diccionarios', 'Pasajeros' => ['Personas'],'Grupos']]);


        $this->viewBuilder()->layout('blankLayout');
        $familiar1 = $this->Responsables->newEntity();
        $cuitcuil1 = "";

        if ($this->request->is('post')) {
            $familiar1 = $this->Responsables->patchEntity($familiar1, $this->request->data, [
                'associated' => [
                    'Personas' => [
                        'associated' => ['Direcciones']
                    ]
                ]
            ]);

            if ($cuitcuil1 === "Cuil") {
                $familiar1->cuil = $familiar1->cuit;
                $familiar1->cuit = null;
            }

            $persona_id = $this->persistirPersona($familiar1->persona);

            $familiar1->usuario_creacion = $pasajeroGrupo->pasajero->persona->id;
            $familiar1->fecha_creacion = Time::now();
            $familiar1->eliminado = 0;
            $familiar1->persona_id = $persona_id;
            $familiar1->pasajero_id = $pasajeroGrupo->pasajero->id;
            $familiar_id = $this->persistirResponsable($familiar1);

            return $this->redirect(
                ['controller' => 'Mediopagos', 'action' => 'registrar', $pasajeroGrupo->pasajero->id]
            );
        }
        $this->set(compact('familiar1'));
        $this->set('_serialize', ['familiar1']);
        $this->set(compact('cuitcuil1'));
        $this->set('_serialize', ['cuitcuil1']);
    }

    public function registrar($pasajero = null) {
        $this->viewBuilder()->layout('blankLayout');
        $familiar1 = $this->Responsables->newEntity();
        $familiar2 = $this->Responsables->newEntity();
        $direccion1 = TableRegistry::get('Direcciones')->newEntity();
        $direccion2 = TableRegistry::get('Direcciones')->newEntity();
        $pasajeroEntity = json_decode($pasajero);
        $cuitcuil1 = "";
        $cuitcuil2 = "";

        if ($this->request->is('post')) {
            $familiar1 = $this->Responsables->patchEntity($familiar1, $this->request->data, [
                'associated' => [
                    'Personas' => [
                        'associated' => ['Direcciones']
                    ]
                ]
            ]);

            if ($cuitcuil1 === "Cuil") {
                $familiar1->cuil = $familiar1->cuit;
                $familiar1->cuit = null;
            }

            $familiar2 = $this->Responsables->patchEntity($familiar2, $this->request->data, [
                'associated' => [
                    'Personas' => [
                        'associated' => ['Direcciones']
                    ]
                ]
            ]);

            if ($cuitcuil2 === "Cuil") {
                $familiar2->cuil = $familiar2->cuit;
                $familiar2->cuit = null;
            }

            if ($cuitcuil1 === "Cuil") {
                $familiar1->cuil = $familiar1->cuit;
                $familiar1->cuit = null;
            }

            $familiar1->usuario_creacion = 2;
            $familiar1->fecha_creacion = Time::now();
            $familiar1->eliminado = 0;


            $familiar2->usuario_creacion = 2;
            $familiar2->fecha_creacion = Time::now();
            $familiar2->eliminado = 0;

            $pasajero_id = $this->persistirPasajero($pasajeroEntity->pasajero);

            $familiar1->pasajero_id = $pasajero_id;
            $familiar1->pasajero = null;
            $familiar2->pasajero_id = $pasajero_id;
            $familiar2->pasajero = null;

            $responable1_id = $this->persistirResponsable($familiar1);
            $responable2_id = $this->persistirResponsable($familiar2);

            $familia = array("pasajero"=>$pasajero_id,"responsable1"=>$responable1_id,"responsable2"=>$responable2_id);

            return $this->redirect(
                ['controller' => 'Mediopagos', 'action' => 'registrar', json_encode(compact('familia'))]
            );
        }

        $this->set(compact('pasajeroEntity'));
        $this->set(compact('cuitcuil1'));
        $this->set('_serialize', ['cuitcuil1']);
        $this->set(compact('cuitcuil2'));
        $this->set('_serialize', ['cuitcuil2']);
        $this->set(compact('direccion1'));
        $this->set('_serialize', ['direccion1']);
        $this->set(compact('direccion2'));
        $this->set('_serialize', ['direccion2']);
        $this->set(compact('familiar1'));
        $this->set('_serialize', ['familiar1']);
        $this->set(compact('familiar2'));
        $this->set('_serialize', ['familiar2']);
    }

    private function persistirResponsable($responsable) {
        $resultResponsable = $this->Responsables->save($responsable);
        return $resultResponsable->id;
    }

    public function step2($pasajeroGrupo) {
        $this->set(compact('pasajeroGrupo'));
        $this->set('_serialize', ['pasajeroGrupo']);
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

}