<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 5/2/17
 * Time: 1:15 AM
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class CamadasTable extends Table {
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('camadas');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->hasOne('Grupos', [
                    'className' => 'Grupos',
                    'foreignKey' => 'id'
        ]);

        $this->hasOne('Colegios', [
            'className' => 'Colegios',
            'foreignKey' => 'id',
            'bindingKey' => 'colegio_id'
        ]);
    }
}