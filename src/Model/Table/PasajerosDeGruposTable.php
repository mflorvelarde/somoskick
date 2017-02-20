<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 19/2/17
 * Time: 7:52 PM
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class PasajerosDeGruposTable extends Table {
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('pasajeros_de_grupos');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->hasOne('Pasajeros', [
            'className' => 'Pasajeros',
            'foreignKey' => 'id',
            'bindingKey' => 'id_pasajero'
        ]);

        $this->hasOne('Grupos', [
            'className' => 'Grupos',
            'foreignKey' => 'id',
            'bindingKey' => 'id_grupo'
        ]);


        $this->hasMany('Diccionarios', [
            'className' => 'Diccionarios',
            'foreignKey' => 'id',
            'bindingKey' => 'actividad_cuenta'
        ]);

        $this->hasOne('Diccionarios', [
            'className' => 'Diccionarios',
            'foreignKey' => 'id',
            'bindingKey' => 'regularidad'
        ]);
    }
}