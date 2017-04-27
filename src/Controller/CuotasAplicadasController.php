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

class CuotasAplicadasController extends AppController{


    /**
     * Index method
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $userID = $this->Auth->user('id');
        if ($this->isClient($userID)) {
            $this->viewBuilder()->layout('clientsLayout');

            $idPasajero = $this->getPasajeroID($userID);
            $pasajeroGrupo = TableRegistry::get('Pasajerosdegrupos')->find()
                ->where(['id_pasajero' => $idPasajero])
                ->first();

            $idPasajeroGrupo = $pasajeroGrupo->id;
            $idsCuotas = array();
            $query = $this->CuotasAplicadas->find('all', ['contain' => ['Cuotas', 'pasajerosdegrupos']])
                ->where(['pasajero_grupo_id' => $idPasajeroGrupo, 'cuota_aplicada_eliminado' => 0]);
            $cuotas = $this->paginate($query);

            $today = Time::now();

            if ($cuotas->count() > 0) {
                foreach ($cuotas as $cuota) {

                    if ($today > $cuota->cuota->vencimiento) {
                        $cuota->status = "<span class=\"label label-danger\">Cuota vencida</span>";
                    } else {
                        $cuota->status = "<span class=\"label label-info\">Cuota vigente</span>";
                    }
             //       $cuota->cuota->vencimeinto->
    //                $cuota->cuota->venciminento = Type::build('datetime')->useLocaleParser()->setLocaleFormat('YYYY-mm-dd');
                    array_push($idsCuotas, $cuota->id);
                }


                //Type::build('datetime')->useLocaleParser()->setLocaleFormat('YYYY-mm-dd');


                $notificacionesTable = TableRegistry::get('NotificacionesPagos');
                $notificacionesQuery = $notificacionesTable->find('all', ['contain' => ['Diccionarios']])
                    ->where(['notificacion_pago_eliminado' => 0,
                        'cuota_aplicada_id IN' => $idsCuotas]);

                $notificaciones = $this->paginate($notificacionesQuery);

                foreach ($notificaciones as $noticacion) {
                    foreach ($cuotas as $cuota) {
                        $notificacionesParaCuota = array();
                        $statusNotificaciones = array();
                        $tieneNotificaciones = false;
                        $cuota->tieneNotif =0;
                        if ($noticacion->cuota_aplicada_id == $cuota->id) {
                            array_push($notificacionesParaCuota, $noticacion);
                            array_push($statusNotificaciones, $noticacion->diccionario->param3);
                            $cuota->tieneNotif = 1;
                            $cuota->tieneNotificaciones = true;
                            $tieneNotificaciones = true;
                        }
                        $cuota->notificaciones = $notificacionesParaCuota;
                        if ($tieneNotificaciones) {
                            if (in_array("ACREDITADA", $statusNotificaciones)) {
                                $cuota->status = "<span class=\"label label-success\">Pago acreditado</span>";
                                $cuota->statusNotif = "<span class=\"label label-success\">Notificación acreditada</span>";
                            } else if (in_array("PENDIENTE", $statusNotificaciones)) {
                                $cuota->statusNotif = "<span class=\"label label-info\">Pendiente de revisión</span>";
                            } else if (in_array("RECHAZADA", $statusNotificaciones)) {
                                $cuota->statusNotif = "<span class=\"label label-danger\">Rechazada</span>";
                            }
//                            if (in_array("RECHAZADA", $statusNotificaciones) || in_array("CANCELADA", $statusNotificaciones)) {
//                                if (!in_array("ACREDITADA", $statusNotificaciones) && !in_array("PENDIENTE", $statusNotificaciones)) {
//                                    $cuota->status = "<span class=\"label label-success\">Pago acreditado</span>";
//                                    //  $cuota->boton = "<button type=\"button\" class=\"btn btn-block btn-default btn-xs\" onclick=\"showNotif($cuota->id)\" style=\"width:120px\">Ver notificaciones</button>" . $cuota->boton;
//                                }
//                            } else {
//                                //$cuota->boton = "<button type=\"button\" class=\"btn btn-block btn-default btn-xs\" onclick=\"showNotif($cuota->id)\" style=\"width:120px\">Ver notificaciones</button>";
//                            }
                        }

                    }
                }
            } else {
                $cuotas = array();
            }

            $this->set(compact('cuotas'));
            $this->set('_serialize', ['cuotas']);
            $this->set(compact('notificaciones'));
            $this->set('_serialize', ['notificaciones']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function verNotificacionesDePasajeroGrupo($idPasajeroGrupo) {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $idsCuotas = array();
            $query = $this->CuotasAplicadas->find('all', ['contain' => ['Cuotas', 'pasajerosdegrupos']])
                ->where(['pasajero_grupo_id' => $idPasajeroGrupo, 'cuota_aplicada_eliminado' => 0]);
            $cuotas = $this->paginate($query);

            $today = Time::now();

            if ($cuotas->count() > 0) {
                foreach ($cuotas as $cuota) {

                    if ($today > $cuota->cuota->vencimiento) {
                        $cuota->status = "<span class=\"label label-danger\">Cuota vencida</span>";
                    } else {
                        $cuota->status = "<span class=\"label label-info\">Cuota vigente</span>";
                    }
                    array_push($idsCuotas, $cuota->id);
                }

                $notificacionesTable = TableRegistry::get('NotificacionesPagos');
                $notificacionesQuery = $notificacionesTable->find('all', ['contain' => ['Diccionarios']])
                    ->where(['notificacion_pago_eliminado' => 0,
                        'cuota_aplicada_id IN' => $idsCuotas]);

                $notificaciones = $this->paginate($notificacionesQuery);

                foreach ($notificaciones as $noticacion) {
                    foreach ($cuotas as $cuota) {
                        $notificacionesParaCuota = array();
                        $statusNotificaciones = array();
                        $tieneNotificaciones = false;
                        $cuota->tieneNotif =0;
                        if ($noticacion->cuota_aplicada_id == $cuota->id) {
                            array_push($notificacionesParaCuota, $noticacion);
                            array_push($statusNotificaciones, $noticacion->diccionario->param3);
                            $cuota->tieneNotif = 1;
                            $cuota->tieneNotificaciones = true;
                            $tieneNotificaciones = true;
                        }
                        $cuota->notificaciones = $notificacionesParaCuota;
                        if ($tieneNotificaciones) {
                            if (in_array("ACREDITADA", $statusNotificaciones)) {
                                $cuota->status = "<span class=\"label label-success\">Pago acreditado</span>";
                                $cuota->statusNotif = "<span class=\"label label-success\">Notificación acreditada</span>";
                            } else if (in_array("PENDIENTE", $statusNotificaciones)) {
                                $cuota->statusNotif = "<span class=\"label label-info\">Pendiente de revisión</span>";
                            } else if (in_array("RECHAZADA", $statusNotificaciones)) {
                                $cuota->statusNotif = "<span class=\"label label-danger\">Rechazada</span>";
                            }
                        }

                    }
                }
            } else {
                $cuotas = array();
            }

            $this->set(compact('cuotas'));
            $this->set('_serialize', ['cuotas']);
            $this->set(compact('notificaciones'));
            $this->set('_serialize', ['notificaciones']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function viewNotificaciones($cuotaAplicadaID) {
        return $this->redirect(
            ['controller' => 'NotificacionesPagos', 'action' => 'viewnotifications', $cuotaAplicadaID]
        );
    }

    public function cargarNotificaciones($cuotaAplicadaID) {
        return $this->redirect(
            ['controller' => 'NotificacionesPagos', 'action' => 'add', $cuotaAplicadaID]
        );
    }

//    private function getCuotasStatus() {
//        return TableRegistry::get('Diccionarios')->find('all')->where(['param1' => "NOTIFICACION_PAGO", 'param2' => "STATUS"]);
//    }

    private function getDiccionariosStatus() {
        return TableRegistry::get('Diccionarios')->find('all')->where(['param1' => "NOTIFICACION_PAGO", 'param2' => "STATUS"]);
    }

    private function getStatusPendiente() {
        $row = TableRegistry::get('Diccionarios')->find('all')->where(['param1' => "NOTIFICACION_PAGO",
            'param2' => "STATUS", 'param3' => 'PENDIENTE'])->first();
        return $row->id;
    }

    public function verNotificacionesPendientes() {
        $userID = $this->Auth->user('id');
        if ($this->isNotClient($userID)) {
            $idsCuotas = array();
            $query = $this->CuotasAplicadas->find('all', ['contain' => ['Cuotas', 'pasajerosdegrupos']])
                ->where(['pasajero_grupo_id' => $idPasajeroGrupo, 'cuota_aplicada_eliminado' => 0]);
            $cuotas = $this->paginate($query);

            $today = Time::now();

            if ($cuotas->count() > 0) {
                foreach ($cuotas as $cuota) {

                    if ($today > $cuota->cuota->vencimiento) {
                        $cuota->status = "<span class=\"label label-danger\">Cuota vencida</span>";
                    } else {
                        $cuota->status = "<span class=\"label label-info\">Cuota vigente</span>";
                    }
                    array_push($idsCuotas, $cuota->id);
                }

                $notificacionesTable = TableRegistry::get('NotificacionesPagos');
                $notificacionesQuery = $notificacionesTable->find('all', ['contain' => ['Diccionarios']])
                    ->where(['notificacion_pago_eliminado' => 0,
                        'cuota_aplicada_id IN' => $idsCuotas]);

                $notificaciones = $this->paginate($notificacionesQuery);

                foreach ($notificaciones as $noticacion) {
                    foreach ($cuotas as $cuota) {
                        $notificacionesParaCuota = array();
                        $statusNotificaciones = array();
                        $tieneNotificaciones = false;
                        $cuota->tieneNotif =0;
                        if ($noticacion->cuota_aplicada_id == $cuota->id) {
                            array_push($notificacionesParaCuota, $noticacion);
                            array_push($statusNotificaciones, $noticacion->diccionario->param3);
                            $cuota->tieneNotif = 1;
                            $cuota->tieneNotificaciones = true;
                            $tieneNotificaciones = true;
                        }
                        $cuota->notificaciones = $notificacionesParaCuota;
                        if ($tieneNotificaciones) {
                            if (in_array("ACREDITADA", $statusNotificaciones)) {
                                $cuota->status = "<span class=\"label label-success\">Pago acreditado</span>";
                                $cuota->statusNotif = "<span class=\"label label-success\">Notificación acreditada</span>";
                            } else if (in_array("PENDIENTE", $statusNotificaciones)) {
                                $cuota->statusNotif = "<span class=\"label label-info\">Pendiente de revisión</span>";
                            } else if (in_array("RECHAZADA", $statusNotificaciones)) {
                                $cuota->statusNotif = "<span class=\"label label-danger\">Rechazada</span>";
                            }
                        }

                    }
                }
            } else {
                $cuotas = array();
            }

            $this->set(compact('cuotas'));
            $this->set('_serialize', ['cuotas']);
            $this->set(compact('notificaciones'));
            $this->set('_serialize', ['notificaciones']);
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }
}