<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 19/2/17
 * Time: 8:14 PM
 */

namespace App\Controller;
use App\Model\Entity\Diccionario;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;


class PasajerosDeGruposController extends AppController {

    /**
     * Index method
     * @return \Cake\Network\Response|null
     */
    public function pasajerosDeGrupo($grupo_id = null) {
        $this->viewBuilder()->layout('ajax');

        $query = $this->Pasajerosdegrupos->find('all', ['contain' => ['Diccionarios', 'Pasajeros' => ['Personas'],'Grupos']])
            ->where(['id_grupo' => $grupo_id]);

        $pasajerosdegrupos = $this->paginate($query);
        $this->set('pasajerosdegrupos', $pasajerosdegrupos);
        $this->set('_serialize', ['pasajerosdegrupos']);

//        $nombre_grupo = $pasajerosdegrupos->first()->grupo->nombre;
        $registrados = $pasajerosdegrupos->count();
//        $pasajerosEstimados = $pasajerosdegrupos->first()->grupo->pasajeros_estimados;
        $hombres = 0;
        $mujeres = 0;
        $totalPesos = 1000;
        $totalDolares = 1000;
        $pagoPesos = 150;
        $pagoDolares = 100;
        $acompanantes = array();
        $regulares = array();
        $listaEspera = array();


        foreach ($pasajerosdegrupos as $pasajero) {
            if (strcmp($pasajero->persona,"F")) $mujeres = $mujeres + 1;
            else $hombres = $hombres + 1;

            if ($pasajero->acompanante) array_push($acompanantes, $pasajero);
            else array_push($regulares, $pasajero);
        }

        $this->set('hombres', $hombres);
        $this->set('mujeres', $mujeres);
        $this->set('registrados', $registrados);
//        $this->set('nombre_grupo', $nombre_grupo);
//        $this->set('pasajerosEstimados', $pasajerosEstimados);
        $this->set('acompanantes', $acompanantes);
        $this->set('regulares', $regulares);
        $this->set('listaEspera', $listaEspera);
        $this->set('totalPesos', $totalPesos);
        $this->set('totalDolares', $totalDolares);
        $this->set('pagoPesos', $pagoPesos);
        $this->set('pagoDolares', $pagoDolares);

    }
}