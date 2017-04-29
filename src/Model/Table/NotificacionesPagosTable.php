<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 6/2/17
 * Time: 4:39 AM
 */

namespace App\Model\Table;
use Cake\ORM\Table;

class NotificacionesPagosTable extends Table {
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('notificaciones_pagos');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->hasOne('CuotasAplicadas', [
            'className' => 'CuotasAplicadas',
            'foreignKey' => 'id',
            'bindingKey' => 'cuota_aplicada_id'
        ]);

        $this->hasOne('Diccionarios', [
            'className' => 'Diccionarios',
            'foreignKey' => 'id',
            'bindingKey' => 'status'
        ]);
    }
}