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
                    'foreignKey' => 'id',
                    'bindingKey' => 'grupo_id'
        ]);

        $this->hasOne('Colegios', [
            'className' => 'Colegios',
            'foreignKey' => 'id',
            'bindingKey' => 'colegio_id'
        ]);

        $this->hasOne('Personas', [
            'className' => 'Personas',
            'foreignKey' => 'id',
            'bindingKey' => 'vendedor_id'
        ]);

        $this->hasOne('Diccionarios', [
            'className' => 'Diccionarios',
            'foreignKey' => 'id',
            'bindingKey' => 'diccionario_id'
        ]);

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
    }
}