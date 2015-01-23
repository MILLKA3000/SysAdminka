<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Staff Entity.
 */
class Staff extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'school_id' => true,
        'first_name' => true,
        'last_name' => true,
        'user_name' => true,
        'password' => true,
        'school' => true,
        'staff' => true,
    ];
}
