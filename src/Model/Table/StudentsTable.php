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
        $this->belongsTo('Specials', [
            'foreignKey' => 'special_id'
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
            ->add('special_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('special_id', 'create')
            ->notEmpty('special_id')
            ->add('student_id', [
                'valid' => [
                    'rule' => 'validateUnique',
                        'provider' => 'table',
                        'message' => 'ID is cloning'],
                'valid_num' => [
                    'rule' => 'numeric',
                        'message' => 'ID isn\'t numeric']

            ])

            ->notEmpty('student_id', 'A ID is required')
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name')
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name')
            ->add('grade_level', [
                'valid' => [
                    'rule' => 'numeric',
                    'message' => 'Grade isn\'t numeric',
                ]
            ])
            ->requirePresence('grade_level', 'create')
            ->notEmpty('grade_level', 'A Grade Level is required')
            ->add('user_name', [
                'valid' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'User Name is cloning']
            ])
            ->requirePresence('user_name', 'create')
            ->notEmpty('user_name', 'A User Name is required')
            ->add('password', 'valid', ['rule' => 'numeric'])
            ->requirePresence('password', 'create')
            ->notEmpty('password', 'A Password is required')
            ->add('status_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('status_id', 'create')
            ->notEmpty('status_id')
            ->add('send_photo_google', 'valid', ['rule' => 'numeric'])
            ->requirePresence('send_photo_google', 'create');

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
        $rules->add($rules->existsIn(['special_id'], 'Specials'));
        $rules->add($rules->existsIn(['status_id'], 'Status'));
        return $rules;
    }

}
