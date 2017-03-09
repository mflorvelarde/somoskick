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

    public function initialize() {
        parent::initialize();
        $this->Auth->allow('registrar');
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


    public function registrar($pasajero = null) {
        $this->viewBuilder()->layout('blankLayout');
        $familiar1 = $this->Responsables->newEntity();
        $familiar2 = $this->Responsables->newEntity();
        $pasajeroEntity = json_decode($pasajero);
        $cuitcuil1 = "";
        $cuitcuil2 = "";

        if ($this->request->is('post')) {
            $familiar1 = $this->Responsables->patchEntity($familiar1, $this->request->data, [
                'associated' => [
                    'Personas'
                ]
            ]);

            if ($cuitcuil1 === "Cuil") {
                $familiar1->cuil = $familiar1->cuit;
                $familiar1->cuit = null;
            }

            $familiar2 = $this->Responsables->patchEntity($familiar2, $this->request->data, [
                'associated' => [
                    'Personas'
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


/*
            $result = TableRegistry::get('Grupos')->save($grupos);
            $grupos_id = $result->id;

            $camada->usuario_creacion = 2;
            $camada->fecha_creacion = Time::now();
            $camada->eliminado = 0;
            $camada->grupo = null;
            $camada->grupo_id = $grupos_id;*/
/*
            if ($this->Camadas->save($camada)) {
                $this->Flash->success(__('La camada fue guardada'));

                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error(__('La camada no pudo ser guardada. Por favor, intente nuevamente'));
            }*/

            //$basePersonas = TableRegistry::get('Pasajeros');
            //  $personaPasajero = $pasajero->persona;

            //$resultPersonaPasajero = $basePersonas->save($pasajero);

            //$result = TableRegistry::get('Grupos')->save($grupos);
            //$grupos_id = $result->id;





            return $this->redirect(
                ['controller' => 'Mediopagos', 'action' => 'registrar', json_encode(compact('familia'))]
            );
        }

        $this->set(compact('pasajeroEntity'));
        $this->set(compact('cuitcuil1'));
        $this->set('_serialize', ['cuitcuil1']);
        $this->set(compact('cuitcuil2'));
        $this->set('_serialize', ['cuitcuil2']);
        $this->set(compact('familiar1'));
        $this->set('_serialize', ['familiar1']);
        $this->set(compact('familiar2'));
        $this->set('_serialize', ['familiar2']);
    }

    private function persistirResponsable($responsable) {
        $idPersona = $this->persistirPersona($responsable->persona);

        $responsable->persona = null;
        $responsable->persona_id = $idPersona;

        $resultResponsable = $this->Responsables->save($responsable);

        return $resultResponsable->id;
    }

    private function persistirPasajero($pasajero) {
        $basePasajeros = TableRegistry::get('Pasajeros');
        $pasajeroEntity = $basePasajeros->newEntity();

        $idPersona = $this->persistirPersona($pasajero->persona);

        $pasajeroEntity->persona = null;
        $pasajeroEntity->persona_id = $idPersona;
        $pasajeroEntity->eliminado = 0;
        $pasajeroEntity->fecha_creacion = Time::now();

        $resultPasajero = $basePasajeros->save($pasajeroEntity);

        return $resultPasajero->id;
    }

    private function persistirPersona($persona) {
        $direccion_id = $this->persistirDireccion($persona->direccion);
        $basePersonas = TableRegistry::get('Personas');
        $personaEntity = $basePersonas->newEntity();

        $personaEntity->direccion_id = $direccion_id;
        $personaEntity->direccion = null;
        $personaEntity->nombre = $persona->nombre;
        $personaEntity->apellido = $persona->apellido;
        $personaEntity->dni = $persona->dni;
        $personaEntity->telefono = $persona->telefono;
        $personaEntity->celular = $persona->celular;
        $personaEntity->nacionalidad = $persona->nacionalidad;
        $personaEntity->sexo = $persona->sexo;
        $personaEntity->mail = $persona->mail;
        $personaEntity->eliminado = 0;
        $personaEntity->perfil = "CLIENTE";
        $personaEntity->fecha_creacion = Time::now();
        $personaEntity->contrasena = $persona->dni . Time::now()->toDateTimeString();

        $resultPersona = $basePersonas->save($personaEntity);

        return $resultPersona->id;
    }

    private function persistirDireccion($direccion) {
        $baseDireccion = TableRegistry::get('Direcciones');
        $direccionEntity = $baseDireccion->newEntity();

        $direccionEntity->calle = $direccion->calle;
        $direccionEntity->numero = $direccion->numero;
        $direccionEntity->piso = $direccion->piso;
        $direccionEntity->departamento = $direccion->departamento;
        $direccionEntity->codigo_postal = $direccion->codigo_postal;
        $direccionEntity->ciudad = $direccion->ciudad;
        $direccionEntity->pais = $direccion->pais;
        $direccionEntity->fecha_creacion = Time::now();
        $direccionEntity->usuario_creacion = 2;
        $direccionEntity->eliminado = 0;

        $resultDireccion = $baseDireccion->save($direccionEntity);

        return $resultDireccion->id;
    }

}