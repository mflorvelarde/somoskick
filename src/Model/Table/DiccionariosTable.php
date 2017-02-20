<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 19/2/17
 * Time: 9:37 AM
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class DiccionariosTable extends Table {
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('diccionarios');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
    }
}