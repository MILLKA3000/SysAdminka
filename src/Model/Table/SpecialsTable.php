<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Specials Model
 */
class SpecialsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('specials');
        $this->displayField('name');
        $this->primaryKey('special_id');

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
            ->add('special_id', [
                'valid' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'ID is cloning'],
                'valid_num' => [
                    'rule' => 'numeric',
                    'message' => 'ID isn\'t numeric']

            ])
            ->allowEmpty('special_id', 'create')
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['id'], 'Specials'));
        return $rules;
    }
}
