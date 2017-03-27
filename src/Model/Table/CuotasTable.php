<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 6/2/17
 * Time: 4:32 AM
 */

namespace App\Model\Table;
use Cake\ORM\Table;


class CuotasTable extends Table {
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('cuotas');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->hasOne('TarifasAplicadas', [
            'className' => 'TarifasAplicadas',
            'foreignKey' => 'id',
            'bindingKey' => 'tarifa_aplicada_id'
        ]);
    }
}