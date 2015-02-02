<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Settings Model
 */
class SettingsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('settings');
        $this->displayField('name');
        $this->primaryKey('id');
    }

    public function _get_settings(){

        return $this->settings = $this->find()->all();
    }

    public function __find_setting($value,$array){
        $array = json_decode(json_encode($array), true);
        foreach($array as $line){

            if($line['name']==$value) return $line['value'];
        }

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
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->requirePresence('note', 'create')
            ->notEmpty('note');


        return $validator;
    }

//    public function beforeSave($event, $entity, $options)
//    {
//        die;
//        is_array($this->value)===true ? $this->value = json_encode($setting->value,true) : $this->value;
//    }


}
