<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 6/2/17
 * Time: 4:32 AM
 */

namespace App\Model\Table;
use Cake\ORM\Table;


class CuotasAplicadasTable extends Table {
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('cuotas_aplicadas');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->hasOne('Cuotas', [
            'className' => 'Cuotas',
            'foreignKey' => 'id',
            'bindingKey' => 'cuota_id'
        ]);

        $this->hasOne('pasajeros_de_grupos', [
            'className' => 'Pasajeros_de_grupos',
            'foreignKey' => 'id',
            'bindingKey' => 'pasajero_grupo_id'
        ]);

    }
}