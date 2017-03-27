<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 27/3/17
 * Time: 5:31 AM
 */

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Tarifas_Aplicada extends Entity {
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}