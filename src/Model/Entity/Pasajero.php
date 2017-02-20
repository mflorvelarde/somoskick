<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 19/2/17
 * Time: 7:49 PM
 */

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Pasajero extends Entity {

    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}