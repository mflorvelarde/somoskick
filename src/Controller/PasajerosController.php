<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 15/2/17
 * Time: 6:26 PM
 */

namespace App\Controller;
use Cake\I18n\Time;


class PasajerosController extends AppController {

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
            $pasajero = $this->Pasajeros->patchEntity($pasajero, $this->request->data, [
                'associated' => [
                    'Personas' => [
                        'associated' => ['Direcciones']
                    ]
                ]
            ]);

            $pasajero->usuario_creacion = 2;
            $pasajero->fecha_creacion = Time::now();
            $pasajero->eliminado = 0;

            return $this->redirect(
                ['controller' => 'Responsables', 'action' => 'registrar', json_encode(compact('pasajero'))]
            );
        }


        $this->set(compact('pasajero'));
        $this->set('_serialize', ['pasajero']);
        $this->set(compact('codigoGrupo'));
        $this->set('_serialize', ['codigoGrupo']);
    }

    public function registrarResponsable() {

    }
}