<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Student Entity.
 */
class Student extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'id' => true,
        'school_id' => true,
        'special_id'=> true,
        'groupnum' => true,
        'first_name' => true,
        'last_name' => true,
        'grade_level' => true,
        'user_name' => true,
        'password' => true,
        'status_id' => true,
        'school' => true,
        'students' => true,
        'rosters' => true,
    ];
}
