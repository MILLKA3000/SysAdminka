<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Class Entity.
 */
class Class extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'school_id' => true,
        'class_id' => true,
        'course_name' => true,
        'section_name' => true,
        'period_name' => true,
        'staff_id' => true,
        'school' => true,
        'classes' => true,
        'staff' => true,
        'rosters' => true,
    ];
}
