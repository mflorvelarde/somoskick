<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 4/2/17
 * Time: 8:34 PM
 */

namespace App\Model\Entity;


use Cake\ORM\Entity;

class Grupo extends Entity {
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}