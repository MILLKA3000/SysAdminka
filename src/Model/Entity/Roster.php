<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Roster Entity.
 */
class Roster extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'school_id' => true,
        'class_id' => true,
        'student_id' => true,
        'school' => true,
        'class' => true,
        'student' => true,
    ];
}
