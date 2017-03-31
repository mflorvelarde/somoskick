<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 4/2/17
 * Time: 8:38 PM
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class ColegiosTable extends Table {
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('colegios');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->hasOne('Personas', [
            'className' => 'Personas',
            'foreignKey' => 'id',
            'bindingKey' => 'usuario_creacion'
        ]);

        $this->hasOne('Personas', [
            'className' => 'Personas',
            'foreignKey' => 'id',
            'bindingKey' => 'usuario_modificacion'
        ]);

        $this->hasOne('Personas', [
            'className' => 'Personas',
            'foreignKey' => 'id',
            'bindingKey' => 'usuario_eliminado'
        ]);

        $this->hasOne('Direcciones', [
            'className' => 'Direcciones',
            'foreignKey' => 'id',
            'bindingKey' => 'direccion_id'
        ]);
    }
}