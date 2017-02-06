<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 6/2/17
 * Time: 4:39 AM
 */

namespace App\Model\Table;
use Cake\ORM\Table;

class Notificaciones_PagosTable extends Table {
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('notificacionesPagos');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->hasOne('Cuotas', [
            'className' => 'Cuotas',
            'foreignKey' => 'cuota_id'
        ]);
    }
}