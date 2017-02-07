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


//        $this->hasMany('Camadas', [
//            'className' => 'Camadas',
//        ]);
    }
}