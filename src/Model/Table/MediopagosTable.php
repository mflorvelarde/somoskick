<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 27/2/17
 * Time: 11:05 AM
 */

namespace App\Model\Table;

use Cake\ORM\Table;


class MediopagosTable extends Table {
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('mediopagos');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->hasOne('Pasajeros', [
            'className' => 'Pasajeros',
            'foreignKey' => 'id',
            'bindingKey' => 'pasajero_id'
        ]);

        $this->hasOne('Direcciones', [
            'className' => 'Direcciones',
            'foreignKey' => 'id',
            'bindingKey' => 'direccion_id'
        ]);
    }
}