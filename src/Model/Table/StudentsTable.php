<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Students Model
 */
class StudentsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('students');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Schools', [
            'foreignKey' => 'school_id'
        ]);

        $this->belongsTo('Status', [
            'foreignKey' => 'status_id'
        ]);

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
            ->allowEmpty('id', 'create')
            ->add('school_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('school_id', 'create')
            ->notEmpty('school_id')
            ->notEmpty('student_id')
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name')
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name')
            ->add('grade_level', 'valid', ['rule' => 'numeric'])
            ->requirePresence('grade_level', 'create')
            ->notEmpty('grade_level')
            ->requirePresence('user_name', 'create')
            ->notEmpty('user_name')
            ->add('password', 'valid', ['rule' => 'numeric'])
            ->requirePresence('password', 'create')
            ->notEmpty('password')
            ->add('status_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('status_id', 'create')
            ->notEmpty('status_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['school_id'], 'Schools'));
        $rules->add($rules->existsIn(['status_id'], 'Status'));
        return $rules;
    }
}
