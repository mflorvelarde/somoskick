<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 6/2/17
 * Time: 2:15 AM
 */

namespace App\Model\Table;

use Cake\ORM\Table;


class TarifasTable extends Table {
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('tarifas');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->hasOne('Viajes', [
            'className' => 'Viajes',
            'foreignKey' => 'id',
            'bindingKey' => 'viaje_id'
        ]);
    }

}