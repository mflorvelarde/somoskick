<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 8/3/17
 * Time: 4:36 PM
 */

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Direccion extends Entity {
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}