<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 27/3/17
 * Time: 5:34 AM
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class TarifasAplicadasTable extends Table {
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('tarifas_aplicadas');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->hasOne('Tarifas', [
            'className' => 'Tarifas',
            'foreignKey' => 'id',
            'bindingKey' => 'tarifa_id'
        ]);

        $this->hasOne('Viajes', [
            'className' => 'Viajes',
            'foreignKey' => 'id',
            'bindingKey' => 'viaje_id'
        ]);
    }
}