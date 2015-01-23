<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Rosters Model
 */
class RostersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('rosters');
        $this->belongsTo('Schools', [
            'foreignKey' => 'school_id'
        ]);
        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id'
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
            ->add('school_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('school_id', 'create')
            ->notEmpty('school_id')
            ->add('class_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('class_id', 'create')
            ->notEmpty('class_id')
            ->requirePresence('student_id', 'create')
            ->notEmpty('student_id');

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
        $rules->add($rules->existsIn(['class_id'], 'Classes'));
        return $rules;
    }
}
