<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 7/2/17
 * Time: 8:16 AM
 */

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Responsable extends Entity {
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}