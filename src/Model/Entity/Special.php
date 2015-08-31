<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Special Entity.
 */
class Special extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'special_id' => true,
        'code' => true,
    ];

    protected function _getName()
    {
        return $this->_properties['name'];
    }
}
