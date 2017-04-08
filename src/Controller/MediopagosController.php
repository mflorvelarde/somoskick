<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 27/2/17
 * Time: 11:12 AM
 */

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class MediopagosController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow('registrar');
    }

    public function registrar($pasajero_id) {
        $this->viewBuilder()->layout('blankLayout');
        $medioPago = $this->Mediopagos->newEntity();
        $cuitcuil = "";

        if ($this->request->is(['patch', 'post', 'put'])) {
            $medioPago = $this->Mediopagos->patchEntity($medioPago, $this->request->data, [
                'associated' => ['Pasajeros', 'Direcciones']]);

            $direccion_id = $this->persistirDireccion($medioPago->direccione, $pasajero_id);

            $medioPago->usuario_creacion = $this->Auth->user('id');
            $medioPago->fecha_creacion = Time::now();
            $medioPago->mediopago_eliminado = 0;
            $medioPago->pasajero_id = $pasajero_id;
            $medioPago->direccion_id = $direccion_id;
            $this->Mediopagos->save($medioPago);

        }

        $this->set(compact('medioPago'));
        $this->set('_serialize', ['medioPago']);
        $this->set(compact('cuitcuil'));
        $this->set('_serialize', ['cuitcuil']);
    }

    private function persistirDireccion($direccion, $pasajero_id) {
        $baseDireccion = TableRegistry::get('Direcciones');

        $direccion->fecha_creacion = Time::now();
        $direccion->usuario_creacion = $pasajero_id;
        $direccion->direccion_eliminado = 0;

        $resultDireccion = $baseDireccion->save($direccion);

        return $resultDireccion->id;
    }

}