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

class CuotasController extends AppController {
    public function add($tarifa_aplicada_id, $error = null) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $tarifasAplicadasTable = TableRegistry::get('TarifasAplicadas');
            $tarifa_aplicada = $tarifasAplicadasTable->get($tarifa_aplicada_id, ['contain' => ['Tarifas']]);
            $tarifa = $tarifa_aplicada->tarifa;

            $inicioPago = $tarifa_aplicada->fecha_primer_pago;

            $cuotas = array();
            $date = Time::create($inicioPago->year, $inicioPago->month, $inicioPago->day);

            for ($i = 0; $i < $tarifa->cantidad_cuotas; $i++) {
                $cuota = $this->Cuotas->newEntity();
                $cuota->vencimiento = $date;
                array_push($cuotas, $cuota);
                $date = Time::create($date->year, $date->month + 1, 10);

            }

            $campos = array();

            //Defino los montos de las cuotas
            if ((is_null($tarifa->monto_pesos) || $tarifa->monto_pesos == 0) && $tarifa->monto_dolares != 0) {
                $cuotaPromedio = floor($tarifa->monto_dolares / $tarifa->cantidad_cuotas);
                for ($i = 0; $i < count($cuotas); $i++) {
                    if ($i == count($cuotas) - 1) {
                        $cuotas[$i]->monto_dolares = $tarifa->monto_dolares - $cuotaPromedio * (count($cuotas) - 1);
                    } else $cuotas[$i]->monto_dolares = $cuotaPromedio;
                    $cuotas[$i]->monto_pesos = 0;

                    $arrayCuota = array();
                    $labelmontoDolares = "montoDolares" . $i;
                    $labelmontoPesos = "montoPesos" . $i;
                    $labelVencimiento = "vencimiento" . $i;
                    array_push($arrayCuota, $labelmontoDolares);
                    array_push($arrayCuota, $labelmontoPesos);
                    array_push($arrayCuota, $labelVencimiento);
                    array_push($arrayCuota, $cuotas[$i]);

                    array_push($campos, $arrayCuota);
                }
            } else if ($tarifa->monto_pesos != 0 && (is_null($tarifa->monto_dolares) || $tarifa->monto_dolares == 0)) {
                $cuotaPromedio = floor($tarifa->monto_pesos / $tarifa->cantidad_cuotas);
                for ($i = 0; $i < count($cuotas); $i++) {
                    if ($i == count($cuotas) - 1) {
                        $cuotas[$i]->monto_pesos = $tarifa->monto_pesos - $cuotaPromedio * (count($cuotas) - 1);
                    } else $cuotas[$i]->monto_pesos = $cuotaPromedio;
                    $cuotas[$i]->monto_dolares = 0;

                    $arrayCuota = array();
                    $labelmontoDolares = "montoDolares" . $i;
                    $labelmontoPesos = "montoPesos" . $i;
                    $labelVencimiento = "vencimiento" . $i;
                    array_push($arrayCuota, $labelmontoDolares);
                    array_push($arrayCuota, $labelmontoPesos);
                    array_push($arrayCuota, $labelVencimiento);
                    array_push($arrayCuota, $cuotas[$i]);

                    array_push($campos, $arrayCuota);
                }
            } else {
                $dolaresEnPesosAprox = $tarifa->monto_dolares * 16;
                $porcentajePesos = ($tarifa->monto_pesos / $dolaresEnPesosAprox);
                $porcentajeDolares = 1 - $porcentajePesos;
                $cantidadCuotasDolares = round($porcentajeDolares * $tarifa->cantidad_cuotas / 100);
                if ($cantidadCuotasDolares == 0) $cantidadCuotasDolares = 1;
                $cantidadCuotasPesos = $tarifa->cantidad_cuotas - $cantidadCuotasDolares;

                $index = 0;

                for ($i = 0; $i < count($cuotas); $i++) {
                    if ($index < $cantidadCuotasDolares) {
                        $cuotas[$i]->monto_dolares = $tarifa->monto_dolares / $cantidadCuotasDolares;
                        $cuotas[$i]->monto_pesos = 0;
                    } else {
                        $cuotas[$i]->monto_pesos = $tarifa->monto_pesos / $cantidadCuotasPesos;
                        $cuotas[$i]->monto_dolares = 0;
                    }
                    $index = $index + 1;


                    $arrayCuota = array();
                    $labelmontoDolares = "montoDolas" . $i;
                    $labelmontoPesos = "montoPesos" . $i;
                    $labelVencimiento = "vencimiento" . $i;
                    array_push($arrayCuota, $labelmontoDolares);
                    array_push($arrayCuota, $labelmontoPesos);
                    array_push($arrayCuota, $labelVencimiento);
                    array_push($arrayCuota, $cuotas[$i]);

                    array_push($campos, $arrayCuota);
                }
            }
            $this->set(compact('campos'));


            if ($this->request->is('post')) {
                $data = $this->request->data;

                $sumPesos = 0;
                $sumDolares = 0;

                //Valido que los montos estén ok
                for ($i = 0; $i < count($cuotas); $i++) {
                    $sumPesos += $data['montoPesos' . $i];
                    $sumDolares += $data['montoDolares' . $i];
                }
                if ($sumPesos == $tarifa->monto_pesos && $sumDolares == $tarifa->monto_dolares) {

                    for ($i = 0; $i < count($cuotas); $i++) {
                        $vencimientoCargado = Time::create($data['vencimiento' . $i]['year'],
                            $data['vencimiento' . $i]['month'], $data['vencimiento' . $i]['day']);
                        $cuotaCargada = $this->Cuotas->newEntity();
                        $cuotaCargada->tarifa_aplicada_id = $tarifa_aplicada_id;
                        $cuotaCargada->monto_pesos = $data['montoPesos' . $i];
                        $cuotaCargada->monto_dolares = $data['montoDolares' . $i];
                        $cuotaCargada->vencimiento = $vencimientoCargado;
                        $cuotaCargada->usuario_creacion = $this->Auth->user('id');;
                        $cuotaCargada->fecha_creacion = Time::now();
                        $cuotaCargada->cuota_eliminado = 0;
                        $this->Cuotas->save($cuotaCargada);
                    }
                    $this->generarCuotasAplicadas($tarifa_aplicada_id);
                    return $this->redirect(
                        ['controller' => 'Grupos', 'action' => 'verplanes']
                    );
                } else {
                    $error = "La suma de los montos de las cuotas no coincide con el total de la tarifa";
                }
            }

            $this->set(compact('sumPesos'));
            $this->set('_serialize', ['sumPesos']);
            $this->set(compact('sumDolares'));
            $this->set('_serialize', ['sumDolares']);


            $this->set(compact('tarifa'));
            $this->set('_serialize', ['tarifa']);
            $this->set(compact('error'));
            $this->set('_serialize', ['error']);
            $this->set(compact('cuotas'));
            $this->set('_serialize', ['cuotas']);
            $this->set(compact('tarifa_aplicada'));
            $this->set('_serialize', ['tarifa_aplicada']);
            $this->set(compact('inicioPago'));
            $this->set('_serialize', ['inicioPago']);
            $this->set(compact('date'));
            $this->set('_serialize', ['date']);
            $this->set('campos', $campos);

        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    private function generarCuotasAplicadas($tarifa_aplicada_id){
        $pasajerosdegruposTable = TableRegistry::get('Pasajerosdegrupos');
        $queryPasajeros = $pasajerosdegruposTable->find('all',['contain' => ['Grupos']])
            ->where(['grupo_eliminado' => 0, 'pasajerodegrupo_eliminado' => 0,
                'grupos.tarifa_aplicada_id' => $tarifa_aplicada_id]);

        $resultPasajeros = $queryPasajeros->toList();

        $cuotas = $this->Cuotas->find('all')->where(['tarifa_aplicada_id' => $tarifa_aplicada_id,'cuota_eliminado' => 0]);

        $cuotasAplicadasTable = TableRegistry::get('CuotasAplicadas');
        $cuotasAplicadasParaPasajeros = array();
        foreach ($resultPasajeros as $pasajero) {
            if (!(!is_null($pasajero->tarifa_aplicada_id) && $pasajero->tarifa_aplicada_id != $tarifa_aplicada_id)) {
                foreach ($cuotas as $cuota) {
                    $cuotaAplicada = $cuotasAplicadasTable->newEntity();
                    $cuotaAplicada->cuota_id = $cuota->id;
                    $cuotaAplicada->pasajero_grupo_id = $pasajero->id;
                    $cuotaAplicada->usuario_creacion = $this->Auth->user('id');;
                    $cuotaAplicada->fecha_creacion = Time::now();
                    $cuotaAplicada->cuota_aplicada_eliminado = 0;
                    array_push($cuotasAplicadasParaPasajeros, $cuota);
                }
            }
        }
        if (count($cuotasAplicadasParaPasajeros) > 0) {
            $entities = $cuotasAplicadasTable->newEntities($cuotasAplicadasParaPasajeros);
            $cuotasAplicadasTable->saveMany($entities);
        }
    }

    public function view ($tarifa_aplicada_id) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $tarifasAplicadasTable = TableRegistry::get('TarifasAplicadas');
            $tarifa_aplicada = $tarifasAplicadasTable->get($tarifa_aplicada_id, ['contain' => ['Tarifas']]);
            $tarifa = $tarifa_aplicada->tarifa;

            $cuotas = $this->Cuotas->find('all')->where(['tarifa_aplicada_id' => $tarifa_aplicada_id,'cuota_eliminado' => 0]);

            $this->set('tarifa_aplicada_id', $tarifa_aplicada_id);
            $this->set('tarifa', $tarifa);
            $this->set('cuotas', $cuotas);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function edit ($tarifa_aplicada_id) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $error = '';
            $tarifasAplicadasTable = TableRegistry::get('TarifasAplicadas');
            $tarifa_aplicada = $tarifasAplicadasTable->get($tarifa_aplicada_id, ['contain' => ['Tarifas']]);
            $tarifa = $tarifa_aplicada->tarifa;

            $cuotasQuery = $this->Cuotas->find('all')->where(['tarifa_aplicada_id' => $tarifa_aplicada_id,'cuota_eliminado' => 0]);
            $cuotas = $cuotasQuery->toList();
            $campos = array();
            for ($i = 0; $i < count($cuotas); $i++) {
                $arrayCuota = array();
                $labelmontoDolares = "montoDolares" . $i;
                $labelmontoPesos = "montoPesos" . $i;
                $labelVencimiento = "vencimiento" . $i;
                array_push($arrayCuota, $labelmontoDolares);
                array_push($arrayCuota, $labelmontoPesos);
                array_push($arrayCuota, $labelVencimiento);
                array_push($arrayCuota, $cuotas[$i]);

                array_push($campos, $arrayCuota);
            }
            if ($this->request->is('post')) {
                $data = $this->request->data;

                $sumPesos = 0;
                $sumDolares = 0;

                //Valido que los montos estén ok
                for ($i = 0; $i < count($cuotas); $i++) {
                    $sumPesos += $data['montoPesos' . $i];
                    $sumDolares += $data['montoDolares' . $i];
                }
                if ($sumPesos == $tarifa->monto_pesos && $sumDolares == $tarifa->monto_dolares) {
                    for ($i = 0; $i < count($cuotas); $i++) {
                        $vencimientoCargado =Time::create($data['vencimiento' . $i]['year'],
                            $data['vencimiento' . $i]['month'], $data['vencimiento' . $i]['day']);

                        $cuotas[$i]->vencimiento = $vencimientoCargado;
                        $cuotas[$i]->monto_pesos = $data['montoPesos' . $i];
                        $cuotas[$i]->monto_dolares = $data['montoDolares' . $i];
                        $cuotas[$i]->vencimiento = $vencimientoCargado;
                        $cuotas[$i]->usuario_modificacion = $this->Auth->user('id');;
                        $cuotas[$i]->fecha_modificacion = Time::now();

                    }
                    $this->Cuotas->saveMany($cuotas);
                    $this->generarCuotasAplicadas($tarifa_aplicada_id);
                    return $this->redirect(
                        ['controller' => 'Tarifas', 'action' => 'index']
                    );
                } else {
                    $error = "La suma de los montos de las cuotas no coincide con el total de la tarifa";
                }
            }
            $this->set('error', $error);
            $this->set('tarifa', $tarifa);
            $this->set('cuotas', $cuotas);
            $this->set('campos', $campos);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function addToPasajero($tarifa_aplicada_id, $error = null){
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $tarifasAplicadasTable = TableRegistry::get('TarifasAplicadas');
            $tarifa_aplicada = $tarifasAplicadasTable->get($tarifa_aplicada_id, ['contain' => ['Tarifas']]);
            $tarifa = $tarifa_aplicada->tarifa;

            $inicioPago = $tarifa_aplicada->fecha_primer_pago;

            $cuotas = array();
            $date = Time::create($inicioPago->year, $inicioPago->month, $inicioPago->day);

            for ($i = 0; $i < $tarifa->cantidad_cuotas; $i++) {
                $cuota = $this->Cuotas->newEntity();
                $cuota->vencimiento = $date;
                array_push($cuotas, $cuota);
                $date = Time::create($date->year, $date->month + 1, 10);

            }

            $campos = array();

            //Defino los montos de las cuotas
            if ((is_null($tarifa->monto_pesos) || $tarifa->monto_pesos == 0) && $tarifa->monto_dolares = !0) {
                $cuotaPromedio = floor($tarifa->monto_dolares / $tarifa->cantidad_cuotas);
                for ($i = 0; $i < count($cuotas); $i++) {
                    if ($i == count($cuotas) - 1) {
                        $cuotas[$i]->monto_dolares = $tarifa->monto_dolares - $cuotaPromedio * (count($cuotas) - 1);
                    } else $cuotas[$i]->monto_dolares = $cuotaPromedio;
                    $cuotas[$i]->monto_pesos = 0;

                    $arrayCuota = array();
                    $labelmontoDolares = "montoDolares" . $i;
                    $labelmontoPesos = "montoPesos" . $i;
                    $labelVencimiento = "vencimiento" . $i;
                    array_push($arrayCuota, $labelmontoDolares);
                    array_push($arrayCuota, $labelmontoPesos);
                    array_push($arrayCuota, $labelVencimiento);
                    array_push($arrayCuota, $cuotas[$i]);

                    array_push($campos, $arrayCuota);
                }
            } else if ($tarifa->monto_pesos != 0 && (is_null($tarifa->monto_dolares) || $tarifa->monto_dolares == 0)) {
                $cuotaPromedio = floor($tarifa->monto_pesos / $tarifa->cantidad_cuotas);
                for ($i = 0; $i < count($cuotas); $i++) {
                    if ($i == count($cuotas) - 1) {
                        $cuotas[$i]->monto_pesos = $tarifa->monto_pesos - $cuotaPromedio * (count($cuotas) - 1);
                    } else $cuotas[$i]->monto_pesos = $cuotaPromedio;
                    $cuotas[$i]->monto_dolares = 0;

                    $arrayCuota = array();
                    $labelmontoDolares = "montoDolares" . $i;
                    $labelmontoPesos = "montoPesos" . $i;
                    $labelVencimiento = "vencimiento" . $i;
                    array_push($arrayCuota, $labelmontoDolares);
                    array_push($arrayCuota, $labelmontoPesos);
                    array_push($arrayCuota, $labelVencimiento);
                    array_push($arrayCuota, $cuotas[$i]);

                    array_push($campos, $arrayCuota);
                }
            } else {
                $dolaresEnPesosAprox = $tarifa->monto_dolares * 16;
                $porcentajePesos = ($tarifa->monto_pesos / $dolaresEnPesosAprox);
                $porcentajeDolares = 1 - $porcentajePesos;
                $cantidadCuotasDolares = round($porcentajeDolares * $tarifa->cantidad_cuotas / 100);
                if ($cantidadCuotasDolares == 0) $cantidadCuotasDolares = 1;
                $cantidadCuotasPesos = $tarifa->cantidad_cuotas - $cantidadCuotasDolares;

                $index = 0;

                for ($i = 0; $i < count($cuotas); $i++) {
                    if ($index < $cantidadCuotasDolares) {
                        $cuotas[$i]->monto_dolares = $tarifa->monto_dolares / $cantidadCuotasDolares;
                        $cuotas[$i]->monto_pesos = 0;
                    } else {
                        $cuotas[$i]->monto_pesos = $tarifa->monto_pesos / $cantidadCuotasPesos;
                        $cuotas[$i]->monto_dolares = 0;
                    }
                    $index = $index + 1;


                    $arrayCuota = array();
                    $labelmontoDolares = "montoDolas" . $i;
                    $labelmontoPesos = "montoPesos" . $i;
                    $labelVencimiento = "vencimiento" . $i;
                    array_push($arrayCuota, $labelmontoDolares);
                    array_push($arrayCuota, $labelmontoPesos);
                    array_push($arrayCuota, $labelVencimiento);
                    array_push($arrayCuota, $cuotas[$i]);

                    array_push($campos, $arrayCuota);
                }
            }
            $this->set(compact('campos'));


            if ($this->request->is('post')) {
                $data = $this->request->data;

                $sumPesos = 0;
                $sumDolares = 0;

                //Valido que los montos estén ok
                for ($i = 0; $i < count($cuotas); $i++) {
                    $sumPesos += $data['montoPesos' . $i];
                    $sumDolares += $data['montoDolares' . $i];
                }
                if ($sumPesos == $tarifa->monto_pesos && $sumDolares == $tarifa->monto_dolares) {

                    for ($i = 0; $i < count($cuotas); $i++) {
                        $vencimientoCargado =Time::create($data['vencimiento' . $i]['year'],
                            $data['vencimiento' . $i]['month'], $data['vencimiento' . $i]['day']);
                        $cuotaCargada = $this->Cuotas->newEntity();
                        $cuotaCargada->tarifa_aplicada_id = $tarifa_aplicada_id;
                        $cuotaCargada->monto_pesos = $data['montoPesos' . $i];
                        $cuotaCargada->monto_dolares = $data['montoDolares' . $i];
                        $cuotaCargada->vencimiento = $vencimientoCargado;
                        $cuotaCargada->usuario_creacion = $this->Auth->user('id');;
                        $cuotaCargada->fecha_creacion = Time::now();
                        $cuotaCargada->cuota_eliminado = 0;
                        $this->Cuotas->save($cuotaCargada);
                    }

                    $pasajerosdegruposTable = TableRegistry::get('Pasajerosdegrupos');
                    $queryPasajeros = $pasajerosdegruposTable->find('all', ['contain' => ['Pasajeros']])
                        ->where(['pasajerodegrupo_eliminado' => 0, 'tarifa_aplicada_id' => $tarifa_aplicada_id]);

                    $resultPasajeros = $queryPasajeros->toList();

                    $cuotas = $this->Cuotas->find('all')->where(['tarifa_aplicada_id' => $tarifa_aplicada_id,'cuota_eliminado' => 0]);

                    $cuotasAplicadasTable = TableRegistry::get('CuotasAplicadas');
                    foreach ($resultPasajeros as $pasajerodegrupo) {
                        $this->eliminarCuotasAplicadasDePlanViejo($pasajerodegrupo->id);
                        $insert = $cuotasAplicadasTable->query();
                        $insert->insert(['cuota_id', 'pasajero_grupo_id', 'cuota_aplicada_eliminado',
                            'fecha_creacion', 'usuario_creacion']);
                            foreach ($cuotas as $cuota) {
                                $insert->values([
                                    'cuota_id' => $cuota->id,
                                    'pasajero_grupo_id' => $pasajerodegrupo->id,
                                    'cuota_aplicada_eliminado' => 0,
                                    'fecha_creacion' => Time::now(),
                                    'usuario_creacion' => $this->Auth->user('id')
                                ]);
                            }
                            $insert->execute();
                    }
                    $this->set('$resultPasajeros', $resultPasajeros);

                    return $this->redirect(
                        ['controller' => 'Pasajeros', 'action' => 'view', $resultPasajeros[0]->pasajero->id]
                    );
                } else {
                    $error = "La suma de los montos de las cuotas no coincide con el total de la tarifa";
                }
            }
            $this->set(compact('tarifa'));
            $this->set('_serialize', ['tarifa']);
            $this->set(compact('error'));
            $this->set('_serialize', ['error']);
            $this->set(compact('cuotas'));
            $this->set('_serialize', ['cuotas']);
            $this->set(compact('tarifa_aplicada'));
            $this->set('_serialize', ['tarifa_aplicada']);
            $this->set(compact('inicioPago'));
            $this->set('_serialize', ['inicioPago']);
            $this->set(compact('date'));
            $this->set('_serialize', ['date']);
            $this->set('campos', $campos);

        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    private function eliminarCuotasAplicadasDePlanViejo($idPasajeroGrupo) {
        $cuotasAplicadasTable = TableRegistry::get('CuotasAplicadas');
        $query = $cuotasAplicadasTable->query();
        $query->update()
            ->set(['cuota_aplicada_eliminado' => 1, 'fecha_eliminado' => Time::now(), 'usuario_eliminado' => $this->Auth->user('id')])
            ->where(['pasajero_grupo_id' => $idPasajeroGrupo])
            ->execute();
    }
}