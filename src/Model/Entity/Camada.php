<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 5/2/17
 * Time: 1:15 AM
 */

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Camada extends Entity {
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}