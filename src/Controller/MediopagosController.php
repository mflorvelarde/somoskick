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

    public function registrar($pasajero = null, $responsable1 = null, $responsable2 = null) {
        $this->viewBuilder()->layout('blankLayout');
        $medioPago = $this->Mediopagos->newEntity();
        $cuitcuil = "";

        if ($this->request->is(['patch', 'post', 'put'])) {
            $medioPago = $this->MedioPagos->patchEntity($pasajero, $this->request->data, [
                'associated' => ['Pasajeros', 'Direcciones']]);

            $medioPago->usuario_creacion = 2;
            $medioPago->fecha_creacion = Time::now();
            $medioPago->eliminado = 0;





        }

        $this->set(compact('medioPago'));
        $this->set('_serialize', ['medioPago']);
        $this->set(compact('cuitcuil'));
        $this->set('_serialize', ['cuitcuil']);
    }

}