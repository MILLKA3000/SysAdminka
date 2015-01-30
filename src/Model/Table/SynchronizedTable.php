<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Synchronized Model
 */
class SynchronizedTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('synchronized');
        $this->primaryKey('id');
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('id', 'create')
            ->notEmpty('id')
            ->requirePresence('status_contingent', 'create')
            ->notEmpty('status_contingent')
            ->requirePresence('status_google', 'create')
            ->notEmpty('status_google')
            ->requirePresence('statistics', 'create')
            ->notEmpty('statistics')
            ->add('date', 'valid', ['rule' => 'timestamp'])
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        return $validator;
    }
}
