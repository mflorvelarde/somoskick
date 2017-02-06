<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 6/2/17
 * Time: 4:38 AM
 */

namespace App\Model\Entity;
use Cake\ORM\Entity;

class Notificaciones_Pago extends Entity {
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}