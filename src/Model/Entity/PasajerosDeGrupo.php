<?php
/**
 * Created by PhpStorm.
 * User: florenciavelarde
 * Date: 19/2/17
 * Time: 7:54 PM
 */

namespace App\Model\Entity;

use Cake\ORM\Entity;

class PasajerosDeGrupo extends Entity {

    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}