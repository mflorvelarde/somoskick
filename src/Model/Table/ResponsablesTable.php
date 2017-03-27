<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 7/2/17
 * Time: 8:16 AM
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class ResponsablesTable extends Table {
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('responsables');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->hasOne('Personas', [
            'className' => 'Personas',
            'foreignKey' => 'id',
            'bindingKey' => 'persona_id'
        ]);

        $this->hasOne('Pasajeros', [
            'className' => 'Pasajeros',
            'foreignKey' => 'id',
            'bindingKey' => 'pasajero_id'
        ]);
    }
}