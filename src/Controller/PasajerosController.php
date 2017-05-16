<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 15/2/17
 * Time: 6:26 PM
 */

namespace App\Controller;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\ORM\ResultSet;



class PasajerosController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['registrarse']);
    }

    public function listAll($camada_id = null) {
/*        $this->viewBuilder()->layout('ajax');

        $query = $this->Camadas->find('all', ['contain' => ['Personas']])
            ->where(['camada_id' => $camada_id]);

        $this->set('camadas', $this->paginate($query));
        $this->set('_serialize', ['camadas']);*/
    }

    public function registrarse($mensaje = null) {
        $this->viewBuilder()->layout('blankLayout');
        $responsablesTable = TableRegistry::get('Responsables');
        $personasTable = TableRegistry::get('Personas');
        $direccionesTable = TableRegistry::get('Direcciones');
        $medioPagosTable = TableRegistry::get('Mediopagos');
        $medioPago = $medioPagosTable->newEntity();
        $pasajero = $this->Pasajeros->newEntity();
        $responsable1 = $responsablesTable->newEntity();
        $responsable2 = $responsablesTable->newEntity();
        $pasajero->codigo_grupo = "";
        $codigoGrupo = "";
        $mensaje = '';
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requestData = $this->request->data;
            $data = $requestData["codigoGrupo"];
            $responsable1vacio = false;
            $responsable2vacio = false;
            $validacionesOK = true;

            $gruposTable = TableRegistry::get('Grupos');
            $query = $gruposTable->find('all')->where(['codigo_grupo' => $data, 'grupo_eliminado' => 0]);
            $grupo = $query->first();

            if (!is_null($grupo)) {
                $personaBase = $personasTable->find('all')
                    ->where(['dni' => $requestData['pasajero']['persona']['dni'],'persona_eliminado' => 0])
                    ->first();
                if (is_null($personaBase)) {
                    $personaMail = $personasTable->find('all')
                        ->where(['mail' => $requestData['pasajero']['persona']['mail'], 'persona_eliminado' => 0])
                        ->first();
                    if (is_null($personaMail)) {
                        if (strlen($requestData['responsable1']['persona']['mail']) > 0) {
                            $responsable1mail = $personasTable->find('all')
                                ->where(['mail' => $requestData['responsable1']['persona']['mail'], 'persona_eliminado' => 0])
                                ->first();
                            if (!is_null($responsable1mail)) {
                                $validacionesOK = false;
                                $mensaje = 'Correo electrónico del paso 2 ya registrado';
                            }
                        } else {
                            $responsable1vacio = true;
                        }
                        if (strlen($requestData['responsable2']['persona']['mail']) > 0) {
                            $responsable2mail = $personasTable->find('all')
                                ->where(['mail' => $requestData['responsable2']['persona']['mail'], 'persona_eliminado' => 0])
                                ->first();
                            if (!is_null($responsable2mail)) {
                                $validacionesOK = false;
                                $mensaje = 'Correo electrónico del paso 3 ya registrado';
                            }
                        } else {
                            $responsable2vacio = true;
                        }
                    } else {
                        $validacionesOK = false;
                        $mensaje = 'Correo electrónico del pasajero ya registrado';
                    }
                } else {
                    $validacionesOK = false;
                    $mensaje = 'Pasajero ya registrado';
                }
            }  else {
                $validacionesOK = false;
                $mensaje = 'Código de grupo inválido. Por favor, intente nuevamente';
            }

            if ($validacionesOK) {
                //Persistencia del pasajero - Direccion, persona, pasajero y pasajero de grupo
                $direccionPasajero = $direccionesTable->newEntity();
                $direccionPasajero->calle = $requestData['pasajero']['persona']['direccione']['calle'];
                $direccionPasajero->numero = $requestData['pasajero']['persona']['direccione']['numero'];
                $direccionPasajero->piso = $requestData['pasajero']['persona']['direccione']['piso'];
                $direccionPasajero->departamento = $requestData['pasajero']['persona']['direccione']['departamento'];
                $direccionPasajero->ciudad = $requestData['pasajero']['persona']['direccione']['ciudad'];
                $direccionPasajero->pais = $requestData['pasajero']['persona']['direccione']['pais'];
                $direccionPasajero->codigo_postal = $requestData['pasajero']['persona']['direccione']['codigo_postal'];
                $direccionPasajeroId = $this->persistirDireccion($direccionPasajero);

                $persona = $personasTable->newEntity();
                $persona->nombre = $requestData['pasajero']['persona']['nombre'];
                $persona->apellido = $requestData['pasajero']['persona']['apellido'];
                $persona->dni = $requestData['pasajero']['persona']['dni'];
                $persona->telefono = $requestData['pasajero']['persona']['telefono'];
                $persona->celular = $requestData['pasajero']['persona']['celular'];
                $persona->nacionalidad = $requestData['pasajero']['persona']['nacionalidad'];
                $persona->mail = $requestData['pasajero']['persona']['mail'];
                $persona->fecha_nacimiento = $requestData['pasajero']['persona']['fecha_nacimiento'];
                $persona->direccion_id = $direccionPasajeroId;
                $persona->sexo = $requestData['sexo'];

                $persona_id = $this->persistirPersona($persona);

                $pasajero->fecha_creacion = Time::now();
                $pasajero->pasajero_eliminado = 0;
                $pasajero->persona_id = $persona_id;

                $result = $this->Pasajeros->save($pasajero);
                $pasajero_id = $result->id;

                $pasajerosGruposTable = TableRegistry::get('Pasajerosdegrupos');
                $pasajeroGrupo = $pasajerosGruposTable->newEntity();
                $pasajeroGrupo->id_pasajero = $pasajero_id;
                $pasajeroGrupo->id_grupo = $grupo->id;
                $pasajeroGrupo->acompanante = 0;
                $pasajeroGrupo->lista_espera = 0;
                $pasajeroGrupo->actividad_cuenta = $this->getInactivo()->id;
                $pasajeroGrupo->regularidad = $this->getRegular()->id;
                $pasajeroGrupo->pasajerodegrupo_eliminado = 0;
                $pasajeroGrupo->fecha_creacion = Time::now();
                $pasajeroGrupo->usuario_creacion = $persona_id;

                $result = $pasajerosGruposTable->save($pasajeroGrupo);
                $pasajeroGrupo_id = $result->id;

                $this->aplicarCuotasAPasajero($pasajeroGrupo_id, $grupo->tarifa_aplicada_id, $persona_id);

                //Persistencia del responsable1
                if (!$responsable1vacio) {
                    $familiar1 = $responsablesTable->newEntity();
                    $personaFamiliar1 = $personasTable->newEntity();

                    $personaFamiliar1->nombre = $requestData['responsable1']['persona']['nombre'];
                    $personaFamiliar1->apellido = $requestData['responsable1']['persona']['apellido'];
                    $personaFamiliar1->dni = $requestData['responsable1']['persona']['dni'];
                    $personaFamiliar1->telefono = $requestData['responsable1']['persona']['telefono'];
                    $personaFamiliar1->celular = $requestData['responsable1']['persona']['celular'];
                    $personaFamiliar1->nacionalidad = $requestData['responsable1']['persona']['nacionalidad'];
                    $personaFamiliar1->mail = $requestData['responsable1']['persona']['mail'];
                    $personaFamiliar1->fecha_nacimiento = $requestData['responsable1']['persona']['fecha_nacimiento'];
                    $personaFamiliar1->sexo = 'M';

                    if (strlen($requestData['responsable1']['persona']['direccione']['pais']) > 0) {

                        //Tomo los datos de la direccion cargada en el formulario para la direccion
                        $direccionResponsable1 = $direccionesTable->newEntity();
                        $direccionResponsable1->calle = $requestData['responsable1']['persona']['direccione']['calle'];
                        $direccionResponsable1->numero = $requestData['responsable1']['persona']['direccione']['numero'];
                        $direccionResponsable1->piso = $requestData['responsable1']['persona']['direccione']['piso'];
                        $direccionResponsable1->departamento = $requestData['responsable1']['persona']['direccione']['departamento'];
                        $direccionResponsable1->ciudad = $requestData['responsable1']['persona']['direccione']['ciudad'];
                        $direccionResponsable1->pais = $requestData['responsable1']['persona']['direccione']['pais'];
                        $direccionResponsable1->codigo_postal = $requestData['responsable1']['persona']['direccione']['codigo_postal'];

                        $direccionFamiliar1id = $this->persistirDireccion($direccionResponsable1);


                    } else {
                        $direccionFamiliar1id = $direccionPasajeroId;
                    }

                    $personaFamiliar1->direccion_id = $direccionFamiliar1id;
                    $responsable1Personaid = $this->persistirPersona($personaFamiliar1);

                    if ($requestData['cuitcuil1'] === "Cuil") {
                        $familiar1->cuil = $requestData['responsable1']['cuit'];
                        $familiar1->cuit = null;
                    } else {
                        $familiar1->cuil = null;
                        $familiar1->cuit = $requestData['responsable1']['cuit'];
                    }

                    $familiar1->persona_id = $responsable1Personaid;
                    $familiar1->pasajero_id = $pasajero_id;
                    $familiar1->fecha_creacion = Time::now();
                    $familiar1->responsable_eliminado = 0;

                    $resultFamiliar1 = $responsablesTable->save($familiar1);
                    $familiar1Id = $resultFamiliar1->id;
                }


                //Persistencia del responsable2
                if (!$responsable2vacio) {
                    $familiar2 = $responsablesTable->newEntity();
                    $personaFamiliar2 = $personasTable->newEntity();

                    $personaFamiliar2->nombre = $requestData['responsable2']['persona']['nombre'];
                    $personaFamiliar2->apellido = $requestData['responsable2']['persona']['apellido'];
                    $personaFamiliar2->dni = $requestData['responsable2']['persona']['dni'];
                    $personaFamiliar2->telefono = $requestData['responsable2']['persona']['telefono'];
                    $personaFamiliar2->celular = $requestData['responsable2']['persona']['celular'];
                    $personaFamiliar2->nacionalidad = $requestData['responsable2']['persona']['nacionalidad'];
                    $personaFamiliar2->mail = $requestData['responsable2']['persona']['mail'];
                    $personaFamiliar2->fecha_nacimiento = $requestData['responsable2']['persona']['fecha_nacimiento'];
                    $personaFamiliar2->sexo = 'F';

                    if (strlen($requestData['responsable2']['persona']['direccione']['pais']) > 0) {

                        //Tomo los datos de la direccion cargada en el formulario para la direccion
                        $direccionResponsable2 = $direccionesTable->newEntity();
                        $direccionResponsable2->calle = $requestData['responsable2']['persona']['direccione']['calle'];
                        $direccionResponsable2->numero = $requestData['responsable2']['persona']['direccione']['numero'];
                        $direccionResponsable2->piso = $requestData['responsable2']['persona']['direccione']['piso'];
                        $direccionResponsable2->departamento = $requestData['responsable2']['persona']['direccione']['departamento'];
                        $direccionResponsable2->ciudad = $requestData['responsable2']['persona']['direccione']['ciudad'];
                        $direccionResponsable2->pais = $requestData['responsable2']['persona']['direccione']['pais'];
                        $direccionResponsable2->codigo_postal = $requestData['responsable2']['persona']['direccione']['codigo_postal'];

                        $direccionFamiliar2id = $this->persistirDireccion($direccionResponsable2);


                    } else {
                        $direccionFamiliar2id = $direccionPasajeroId;
                    }

                    $personaFamiliar2->direccion_id = $direccionFamiliar2id;
                    $responsable2Personaid = $this->persistirPersona($personaFamiliar2);

                    if ($requestData['cuitcuil2'] === "Cuil") {
                        $familiar2->cuil = $requestData['responsable2']['cuit'];
                        $familiar2->cuit = null;
                    } else {
                        $familiar2->cuil = null;
                        $familiar2->cuit = $requestData['responsable2']['cuit'];
                    }
                    $familiar2->persona_id = $responsable2Personaid;
                    $familiar2->pasajero_id = $pasajero_id;
                    $familiar2->fecha_creacion = Time::now();
                    $familiar2->responsable_eliminado = 0;

                    $resultFamiliar2 = $responsablesTable->save($familiar2);
                    $familiar2Id = $resultFamiliar2->id;
                }

                //Persisto el medio de pago
                $direccionMedioPago = $direccionesTable->newEntity();
                $direccionMedioPago->calle = $requestData['medioPago']['direccione']['calle'];
                $direccionMedioPago->numero = $requestData['medioPago']['direccione']['numero'];
                $direccionMedioPago->piso = $requestData['medioPago']['direccione']['piso'];
                $direccionMedioPago->departamento = $requestData['medioPago']['direccione']['departamento'];
                $direccionMedioPago->ciudad = $requestData['medioPago']['direccione']['ciudad'];
                $direccionMedioPago->pais = $requestData['medioPago']['direccione']['pais'];
                $direccionMedioPago->codigo_postal = $requestData['medioPago']['direccione']['codigo_postal'];

                $medioPagoDireccionID = $this->persistirDireccion($direccionMedioPago);

                $medioPago->usuario_creacion = $persona_id;
                $medioPago->fecha_creacion = Time::now();
                $medioPago->mediopago_eliminado = 0;
                $medioPago->pasajero_id = $pasajero_id;
                $medioPago->direccion_id = $medioPagoDireccionID;
                $medioPago->tipo_factura = $requestData['medioPago']['tipo_factura'];
                $medioPago->razon_social = $requestData['medioPago']['razon_social'];
                $medioPago->condicionIVA = $requestData['medioPago']['condicionIVA'];

                if ($requestData['medioPago']['cuitcuil'] === "Cuil") {
                    $medioPago->cuil = $requestData['medioPago']['cuit'];
                    $medioPago->cuit = null;
                } else {
                    $medioPago->cuil = null;
                    $medioPago->cuit = $requestData['medioPago']['cuit'];
                }

                $resultMedioPago = $medioPagosTable->save($medioPago);

                return $this->redirect(
                    ['controller' => 'Personas', 'action' => 'registrarok']
                );
            }
            $this->set(compact('responsable1vacio'));
            $this->set(compact('validacionesOK'));

            $this->set(compact('requestData'));
        }
        $this->set(compact('mensaje'));
        $this->set('_serialize', ['mensaje']);
        $this->set(compact('medioPago'));
        $this->set('_serialize', ['medioPago']);
        $this->set(compact('responsable1'));
        $this->set('_serialize', ['responsable1']);
        $this->set(compact('responsable2'));
        $this->set('_serialize', ['responsable2']);
        $this->set(compact('pasajero'));
        $this->set('_serialize', ['pasajero']);
        $this->set(compact('codigoGrupo'));
        $this->set('_serialize', ['codigoGrupo']);
    }

    private function aplicarCuotasAPasajero($pasajeroGrupoID, $tarifaID, $persona_id) {
        $cuotasAplicadasTable = TableRegistry::get('CuotasAplicadas');
        $cuotasTable = TableRegistry::get('Cuotas');
        $query = $cuotasTable->find('all')
            ->where(['tarifa_aplicada_id' => $tarifaID]);
        $cuotas = $this->paginate($query);

        $cuotasAplicadas = array();
        foreach ($cuotas as $cuota) {
            $cuotaAplicada = $cuotasAplicadasTable->newEntity();
            $cuotaAplicada->cuota_id = $cuota->id;
            $cuotaAplicada->pasajero_grupo_id = $pasajeroGrupoID;
            $cuotaAplicada->usuario_creacion = $persona_id;
            $cuotaAplicada->fecha_creacion = Time::now();
            $cuotaAplicada->cuota_aplicada_eliminado = 0;

            array_push($cuotasAplicadas, $cuotaAplicada);
        }
        $cuotasAplicadasTable->saveMany($cuotasAplicadas);
        $this->set(compact('cuotasAplicadas'));
        $this->set(compact('cuotas'));
    }

    private function sendWelcomeEmail($code, $mail) {

        $email = new Email('default');
        $email->sender('administracion@somoskick.com', 'Kick');
        $email->from('administracion@somoskick.com')
            ->addTo($mail)
            ->subject('Se ha registrado correctamente')
            ->emailFormat('html')
            ->viewVars(['code' => $code])
            ->template('default');
        $email->send();
    }


    private function persistirDireccion($direccion) {
        $baseDireccion = TableRegistry::get('Direcciones');

        $direccion->fecha_creacion = Time::now();
        $direccion->direccion_eliminado = 0;

        $resultDireccion = $baseDireccion->save($direccion);

        return $resultDireccion->id;
    }

    private function persistirPersona($persona) {
        $basePersonas = TableRegistry::get('Personas');
        $fecha_nacimiento =  Time::createFromDate($persona->fecha_nacimiento['year'],$persona->fecha_nacimiento['month'],
            $persona->fecha_nacimiento['day']);

        $contrasena = md5($persona->dni . Time::now()->toDateTimeString());
        $result = $query = $basePersonas->query()
            ->insert(['nombre', 'apellido', 'dni', 'telefono', 'celular', 'nacionalidad', 'mail', 'contrasena',
                    'perfil', 'fecha_nacimiento', 'direccion_id', 'contrasena_reset', 'persona_eliminado',
                    'fecha_creacion'])
            ->values(['nombre' => $persona->nombre, 'apellido' => $persona->apellido, 'dni' => $persona->dni,
                'telefono' => $persona->telefono, 'celular' => $persona->celular, 'nacionalidad' => $persona->nacionalidad,
                'mail' => $persona->mail, 'contrasena' => $contrasena,
                'perfil' => "CLIENTE", 'fecha_nacimiento' => $fecha_nacimiento,
                'direccion_id' => $persona->direccion_id, 'contrasena_reset' => 1, 'persona_eliminado' => 0,
                'fecha_creacion' => Time::now()])
            ->execute();

        $mail = $persona->mail;
        $this->sendWelcomeEmail($contrasena, $mail);
        $id = $result->lastInsertId('Personas');
        return $id;
    }

    private function getRegular() {
        $query = TableRegistry::get('Diccionarios')->find('all')->where(['param1' => "PASAJEROS_DE_GRUPOS",
            'param2' => 'SITUACION', 'param3' => 'REGULAR']);
        return $query->first();
    }

    private function getInactivo() {
        $query = TableRegistry::get('Diccionarios')->find('all')->where(['param1' => "PASAJEROS_DE_GRUPOS",
            'param2' => 'CUENTA', 'param3' => 'INACTIVO']);
        return $query->first();
    }

    public function miperfil() {
        $userID = $this->Auth->user('id');
        if ($this->isClient($userID)) {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'underconstruction']
            );
        } else {
            return $this->redirect(
                ['controller' => 'Error', 'action' => 'notAuthorized']
            );
        }
    }

    public function view ($id) {
        $pasajero = $this->Pasajeros->get($id, ['contain' => ['Personas' => ['Direcciones']]]);

        $responsablesTable = TableRegistry::get('Responsables');
        $responsablesQuery = $responsablesTable->find('all', ['contain' => ['Personas' => ['Direcciones']]])
            ->where(['pasajero_id' => $id]);
        $responsables = $this->paginate($responsablesQuery);

        $pasajeroGrupo = TableRegistry::get('Pasajerosdegrupos')->find()
            ->where(['id_pasajero' => $id])
            ->first();
        $pasajeroGrupoID = $pasajeroGrupo->id;

        $this->set(compact('pasajeroGrupoID'));
        $this->set(compact('pasajero'));
        $this->set('_serialize', ['pasajero']);
        $this->set(compact('responsables'));
        $this->set('_serialize', ['responsables']);
    }

    private function registrarseold() {
        $this->viewBuilder()->layout('blankLayout');
        $pasajero = $this->Pasajeros->newEntity();
        $pasajero->codigo_grupo = "";
        $codigoGrupo = "";

        if ($this->request->is(['patch', 'post', 'put'])) {
            $requestData = $this->request->data;
            $sexo  = $requestData["sexo"];
            $data = $requestData["codigoGrupo"];

            $gruposTable = TableRegistry::get('Grupos');
            $query = $gruposTable->find('all')->where(['codigo_grupo' => $data, 'grupo_eliminado' => 0]);
            $grupo = $query->first();

            if (!is_null($grupo)) {
                $pasajero = $this->Pasajeros->patchEntity($pasajero, $this->request->data, [
                    'associated' => [
                        'Personas' => [
                            'associated' => ['Direcciones']
                        ]
                    ]
                ]);
                $personaBase = TableRegistry::get('Personas')->find('all')->where(['dni' => $pasajero->persona->dni,
                    'persona_eliminado' => 0])->first();
                if (is_null($personaBase)) {
                    $personaMail = TableRegistry::get('Personas')->find('all')->where(['mail' => $pasajero->persona->mail,
                        'persona_eliminado' => 0])->first();
                    if (is_null($personaMail)) {
                        $pasajero->persona->sexo = $sexo;
                        $persona_id = $this->persistirPersona($pasajero->persona);
                        $pasajero->fecha_creacion = Time::now();
                        $pasajero->pasajero_eliminado = 0;
                        $pasajero->persona_id = $persona_id;

                        $result = $this->Pasajeros->save($pasajero);
                        $pasajero_id = $result->id;

                        $pasajerosGruposTable = TableRegistry::get('Pasajerosdegrupos');
                        $pasajeroGrupo = $pasajerosGruposTable->newEntity();
                        $pasajeroGrupo->id_pasajero = $pasajero_id;
                        $pasajeroGrupo->id_grupo = $grupo->id;
                        $pasajeroGrupo->acompanante = 0;
                        $pasajeroGrupo->lista_espera = 0;
                        $pasajeroGrupo->actividad_cuenta = $this->getInactivo()->id;
                        $pasajeroGrupo->regularidad = $this->getRegular()->id;
                        $pasajeroGrupo->pasajerodegrupo_eliminado = 0;
                        $pasajeroGrupo->fecha_creacion = Time::now();
                        $pasajeroGrupo->usuario_creacion = $persona_id;

                        $result = $pasajerosGruposTable->save($pasajeroGrupo);
                        $pasajeroGrupo_id = $result->id;

                        $this->aplicarCuotasAPasajero($pasajeroGrupo_id, $grupo->tarifa_aplicada_id, $persona_id);

                        return $this->redirect(
                            ['controller' => 'Responsables', 'action' => 'paso2', $pasajeroGrupo_id]
                        );
                    } else {
                        $mensaje = 'Correo electrónico ya registrado';
                    }
                } else {
                    $mensaje = 'Pasajero ya registrado';
                    return $this->redirect(['action' => 'registrarse', $mensaje]);
                }
            } else {
                $this->Flash->error(__('Código de grupo inválido. Por favor, intente nuevamente'));
            }
        }
        $this->set(compact('mensaje'));
        $this->set('_serialize', ['mensaje']);
        $this->set(compact('pasajero'));
        $this->set('_serialize', ['pasajero']);
        $this->set(compact('codigoGrupo'));
        $this->set('_serialize', ['codigoGrupo']);
    }
}