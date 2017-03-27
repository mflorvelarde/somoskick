<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 6/2/17
 * Time: 4:35 AM
 */

namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class CuotasController extends AppController{



    /**
     * Index method
     * @return \Cake\Network\Response|null
     */
    public function index() {

       // $cuotas = $this->paginate($this->Cuotas);;
        //$cuotas = $this->paginate($this->Cuotas);
        /*
                $query = $this->Camadas->find('all')->where(['colegios_id' => $colegio_id]);
                $this->set('camadas', $this->paginate($query));*/


/*        $query = $this->Cuotas->find('all');
        $query->contain(['Cuotas_Aplicadas']);
        $this->set('cuotas', $this->paginate($query));*/


        // As an option to find()
     //   $query = $cuotas->find('all', ['contain' => ['Cuotas_Aplicadas']]);

        // As a method on the query object
/*        $query = $cuotas->find('all');
/*        $query->contain(['Cuotas_Aplicadas']);*/
  /*      $query = $cuotas
            ->find()
            ->contain([
                'Cuotas_aplicadas'
            ]);*/

/*        $this->paginate = [
            'contain' => ['Cuotas_aplicadas']
        ];

        $this->set('cuotas', $this->paginate($this->Cuotas));*/

        //$this->set('cuotas', $this->paginate($query));


        $cuotas = $this->paginate($this->Cuotas);
        $this->set(compact('cuotas'));

    $this->set('_serialize', ['cuotas']);
/*

        $this->set(compact('$cuotas'));
        $this->set('_serialize', ['cuotas']);*/
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $colegio = $this->Colegios->get($id);

        $this->set('colegio', $colegio);
        $this->set('_serialize', ['colegio']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($tarifaJson = null) {
        $tarifa = json_decode($tarifaJson)->tarifa;
        if ($tarifaJson != null) {
            $inicioPago = $tarifa->inicio_pago;
            $finPago = $tarifa->fin_pago;

            $cuotas = TableRegistry::get('Cuotas')->newEntities($this->request->data);
            $date = date('Y-m-d', strtotime('+1 month',  strtotime($inicioPago)));
            $meses = 0;

            while ($date < $finPago) {
                $cuota = $this->Cuotas->newEntity();
                $cuota->vencimiento = $date;
                array_push($cuotas, $cuota);
                $meses = $meses + 1;
                $date = date('Y-m-d', strtotime('+1 month',  strtotime($date)));
            }
            if ($tarifa->monto_pesos == 0 && $tarifa->monto_dolares =! 0) {
                foreach ($cuotas as $cuota) {
                    $cuota->monto_dolares = $tarifa->monto_dolares / $meses;
                }
            } else if ($tarifa->monto_pesos != 0 && $tarifa->monto_dolares == 0) {
                foreach ($cuotas as $cuota) {
                    $cuota->monto_pesos = $tarifa->monto_pesos / $meses;
                }
            } else {
                $dolaresEnPesosAprox = $tarifa->monto_dolares*16;
                $porcentajePesos = ($tarifa->monto_pesos / $dolaresEnPesosAprox);
                $porcentajeDolares = 1 - $porcentajePesos;
                $cantidadCuotasDolares = round($porcentajeDolares * $meses / 100);
                if ($cantidadCuotasDolares == 0) $cantidadCuotasDolares = 1;
                $cantidadCuotasPesos = $meses - $cantidadCuotasDolares;

                for ($i = 0; $i < $cantidadCuotasDolares; $i++) {
                    $cuotas[$i]->monto_dolares = $tarifa->monto_dolares / $cantidadCuotasDolares;
                    $cuotas[$i]->monto_pesos = 0;
                }
                for ($i = $cantidadCuotasDolares; $i < $meses; $i++) {
                    $cuotas[$i]->monto_pesos = $tarifa->monto_pesos / $cantidadCuotasPesos;
                    $cuotas[$i]->monto_dolares = 0;
                }
            }

        }
        if ($this->request->is('post')) {
            $cuotasTableRegistry = TableRegistry::get('Cuotas');
            $entities = $cuotasTableRegistry->newEntities($this->request->data);
            $this->set(compact('entities'));
            $this->set('_serialize', ['entities']);

            /*             $cuotasTableRegistry->connection()->transactional(function () use ($cuotasTableRegistry, $entities) {
                            foreach ($entities as $entity) {
                               $entity->tarifa_id = $tarifa->id;
                    $cuotasTableRegistry->save($entity, ['atomic' => false]);
                }
            });*/

            foreach ($cuotas as $cuota) {
                $entity = $this->Cuotas->newEntity();
                $entity->monto_pesos = $cuota->monto_pesos;
                $entity->monto_dolares = $cuota->monto_dolares;
            }


/*
            foreach ($entities as $cuota) {
               // $cuota = $this->Cuotas->patchEntity($cuota, $this->request->data);
                $cuota->tarifa_id = $tarifa->id;
                $cuota->usuario_creacion = 2;
                $cuota->fecha_creacion = Time::now();
                $cuota->eliminado = 0;

                $this->Cuotas->save($cuota);
            }*/
/*            $colegio = $this->Colegios->patchEntity($colegio, $this->request->data);
            $colegio->usuario_creacion = 2;
            $colegio->fecha_creacion = Time::now();
            $colegio->eliminado = 0;
            $colegio->direccion_id = 1;

            if ($this->Colegios->save($colegio)) {
                $this->Flash->success(__('El colegio fue guardado'));

                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->error(__('El colegio no pudo ser guardado. Por favor, intente nuevamente'));
            }*/
        }
        $this->set(compact('tarifa'));
        $this->set('_serialize', ['tarifa']);
        $this->set(compact('cuotas'));
        $this->set('_serialize', ['cuotas']);
        $this->set(compact('diff'));
        $this->set('_serialize', ['diff']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);

        $colegio = $this->Colegios->get($id);
        $colegio->eliminado = 1;
        $colegio->usuario_eliminado = 2;
        $colegio->fecha_eliminado = Time::now();
        if ($this->Colegios->save($colegio)) {
            $this->Flash->success(__('El colegio fue eliminado'));
        } else {
            $this->Flash->error(__('El colegio no pudo ser eliminado. Por favor, intente nuevamente'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $colegio = $this->Colegios->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $colegio = $this->Colegios->patchEntity($colegio, $this->request->data);
            $colegio->usuario_modificacion = 2;
            $colegio->fecha_modificacion = Time::now();

            if ($this->Colegios->save($colegio)) {
                $this->Flash->success(__('El colegio fue guardado'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El colegio no pudo ser guardado. Por favor, intente nuevamente'));
            }
        }
        $this->set(compact('colegio'));
        $this->set('_serialize', ['colegio']);
    }

}