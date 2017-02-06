<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 6/2/17
 * Time: 2:15 AM
 */

namespace App\Model\Entity;

use Cake\ORM\Entity;


class Tarifa extends Entity {
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}