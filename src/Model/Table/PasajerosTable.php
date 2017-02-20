<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 19/2/17
 * Time: 7:47 PM
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class PasajerosTable extends Table {
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('pasajeros');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->hasOne('Personas', [
            'className' => 'Personas',
            'foreignKey' => 'id',
            'bindingKey' => 'persona_id'
        ]);
    }
}