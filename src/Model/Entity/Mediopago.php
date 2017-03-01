<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 27/2/17
 * Time: 11:05 AM
 */

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Mediopago extends Entity {

    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}