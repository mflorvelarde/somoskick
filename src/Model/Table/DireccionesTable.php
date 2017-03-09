<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 8/3/17
 * Time: 4:37 PM
 */

namespace App\Model\Table;

use Cake\ORM\Table;


class DireccionesTable extends Table {
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('direcciones');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
    }
}