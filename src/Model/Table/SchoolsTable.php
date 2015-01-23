<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Schools Model
 */
class SchoolsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('schools');
        $this->displayField('school_id');
        $this->primaryKey('school_id');

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator instance
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('school_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('school_id', 'create')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }


}
