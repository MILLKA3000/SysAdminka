<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Status Model
 */
class StatusTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('status');
        $this->displayField('name');
        $this->belongsTo('Statuses', [
            'foreignKey' => 'status_id'
        ]);
        $this->hasMany('Status', [
            'foreignKey' => 'status_id'
        ]);
        $this->hasMany('Students', [
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
            ->add('status_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('status_id', 'create')
            ->notEmpty('status_id')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

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
        $rules->add($rules->existsIn(['status_id'], 'Statuses'));
        return $rules;
    }
}
