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

            $responsablesTable = TableRegistry::get('Responsables');
            $responsable = $responsablesTable->find('all', ['contain' => ['Pasajeros']])
                ->where(['Responsables.persona_id' => $userID])
                ->first();

            if (is_null($responsable)) {
                $pasajerosTable = TableRegistry::get('Pasajeros');
                $pasajero = $pasajerosTable->find()
                    ->where(['persona_id' => $userID])
                    ->first();
                $idPasajero = $pasajero->id;
            } else {
                $idPasajero = $responsable->pasjero->id;
            }

            $pasajeroGrupo = TableRegistry::get('Pasajerosdegrupos')->find()
                ->where(['id_pasajero' => $idPasajero])
                ->first();

            $idPasajeroGrupo = $pasajeroGrupo->id;
            $idsCuotas = array();
            $query = $this->CuotasAplicadas->find('all', ['contain' => ['Cuotas', 'pasajerosdegrupos']])
                ->where(['pasajero_grupo_id' => $idPasajeroGrupo, 'cuota_aplicada_eliminado' => 0]);
            $cuotas = $this->paginate($query);

            if ($cuotas->count() > 0) {
                foreach ($cuotas as $cuota) {
                    $cuota->boton = "<button type=\"button\" class=\"btn btn-block btn-default btn-xs cargar-notif\"
                                onclick=\"openNotifForm($cuota->id)\" style=\"width:120px\">Cargar notificación</button>";

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
                        if ($noticacion->cuota_aplicada_id == $cuota->id) {
                            array_push($notificacionesParaCuota, $noticacion);
                            array_push($statusNotificaciones, $noticacion->diccionario->param3);
                            $tieneNotificaciones = true;
                        }
                        $cuota->notificaciones = $notificacionesParaCuota;
                        if ($tieneNotificaciones) {
                            if (in_array("RECHAZADA", $statusNotificaciones) || in_array("CANCELADA", $statusNotificaciones)) {
                                if (!in_array("ACREDITADA", $statusNotificaciones) && !in_array("PENDIENTE", $statusNotificaciones)) {
                                    $cuota->boton = "<button type=\"button\" class=\"btn btn-block btn-default btn-xs\" onclick=\"showNotif($cuota->id)\" style=\"width:120px\">Ver notificaciones</button>" . $cuota->boton;
                                }
                            } else {
                                $cuota->boton = "<button type=\"button\" class=\"btn btn-block btn-default btn-xs\" onclick=\"showNotif($cuota->id)\" style=\"width:120px\">Ver notificaciones</button>";
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

    private function getDiccionariosStatus() {
        return TableRegistry::get('Diccionarios')->find('all')->where(['param1' => "NOTIFICACION_PAGO", 'param2' => "STATUS"]);
    }
}