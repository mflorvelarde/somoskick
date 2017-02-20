<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 19/2/17
 * Time: 9:37 AM
 */

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Diccionario extends Entity {

    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}