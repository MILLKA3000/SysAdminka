<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * School Entity.
 */
class School extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'school_id' => true
    ];


}
