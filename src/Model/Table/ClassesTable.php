<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Classes Model
 */
class ClassesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('classes');
        $this->belongsTo('Schools', [
            'foreignKey' => 'school_id'
        ]);
        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id'
        ]);
        $this->belongsTo('Staffs', [
            'foreignKey' => 'staff_id'
        ]);
        $this->hasMany('Classes', [
            'foreignKey' => 'class_id'
        ]);
        $this->hasMany('Rosters', [
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
            ->add('course_name', 'valid', ['rule' => 'numeric'])
            ->requirePresence('course_name', 'create')
            ->notEmpty('course_name')
            ->requirePresence('section_name', 'create')
            ->notEmpty('section_name')
            ->requirePresence('period_name', 'create')
            ->notEmpty('period_name')
            ->add('staff_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('staff_id', 'create')
            ->notEmpty('staff_id');

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
        $rules->add($rules->existsIn(['staff_id'], 'Staffs'));
        return $rules;
    }
}
