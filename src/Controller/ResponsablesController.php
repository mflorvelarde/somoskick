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

            $familiar1->usuario_creacion = 2;
            $familiar1->fecha_creacion = Time::now();
            $familiar1->eliminado = 0;


            $familiar2->usuario_creacion = 2;
            $familiar2->fecha_creacion = Time::now();
            $familiar2->eliminado = 0;

            $persona_id = $this->persistirPasajero($pasajeroEntity);

            //$basePersonas = TableRegistry::get('Pasajeros');
            //  $personaPasajero = $pasajero->persona;

            //$resultPersonaPasajero = $basePersonas->save($pasajero);

            //$result = TableRegistry::get('Grupos')->save($grupos);
            //$grupos_id = $result->id;





            return $this->redirect(
                ['controller' => 'Mediopagos', 'action' => 'registrar', $pasajero,
                    json_encode(compact('familiar1')), json_encode(compact('familiar2'))]
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

    private function persistirResponsable($responsable = null) {

    }

    private function persistirPasajero($pasajero = null) {
        $basePersonas = TableRegistry::get('Pasajeros');
        $resultPersonaPasajero = $basePersonas->save($pasajero);

        return $resultPersonaPasajero->id;
    }
}