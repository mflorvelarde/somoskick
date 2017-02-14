<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 7/2/17
 * Time: 8:29 AM
 */

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class ResponsablesController extends AppController{

    public function add() {
        $responsable = $this->Responsables->newEntity();

        if ($this->request->is('post')) {
            $responsable = $this->Responsables->patchEntity($responsable, $this->request->data, [
                'associated' => [
                    'Usuario'
                ]
            ]);

            $usuario = TableRegistry::get('Usuario')->newEntity();
            $usuario->nombre = $responsable->grupo->nombre;
            $usuario->contrato = $responsable->grupo->contrato;
            $usuario->eliminado = 0;
            $usuario->fecha_creacion = Time::now();
            $usuario->usuario_creacion = 2;

            $result = TableRegistry::get('Grupos')->save($usuario);
            $grupo_id = $result->id;

            $responsable->usuario_creacion = 2;
            $responsable->fecha_creacion = Time::now();
            $responsable->eliminado = 0;
            $responsable->grupo = null;
            $responsable->grupo_id = $grupo_id;
            $responsable->colegio_id = 1;

            if ($this->Camadas->save($responsable)) {
                $this->Flash->success(__('La camada fue guardada'));

                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error(__('La camada no pudo ser guardada. Por favor, intente nuevamente'));
            }
        }
        $this->set(compact('responsable'));
        $this->set('_serialize', ['camada']);
    }
}