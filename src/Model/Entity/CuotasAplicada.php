<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 6/2/17
 * Time: 4:32 AM
 */

namespace App\Model\Entity;
use Cake\ORM\Entity;

class CuotasAplicada extends Entity {
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}