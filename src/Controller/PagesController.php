<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

    private $stat;

    private $settings;



    private function _get_statuses($id_status){
        $this->loadModel('Students');
        return $this->Students->find()->where(["status_id IN (".$id_status.")"])->count();
    }



    protected function __sum_stat($stats){

        $a2sum = array();

        foreach($stats as $k=>$stat){
            $array = json_decode($stat->statistics);
            $sum[] = $array;
        }

        foreach ($sum as $k=>$subArray) {
            foreach ($subArray as $id=>$value) {
                $a2sum[$id]+=$value;
            }
        }
        return $a2sum;
    }

    public function display()
    {
        $this->loadModel('Synchronized');

        $this->settings = $this->Settings->_get_settings();
        $stats = $this->Synchronized->find()
            ->where(['and'=>[["Synchronized.date > ".mktime(0,0,0,$this->Settings->__find_setting('display_stat_last',$this->settings))],["Synchronized.date < ".mktime()]]])->all();

        $data = $this->__sum_stat($stats);
        $data['conflict_students'] = $this->_get_statuses("3,7");
        $data['archive_students'] = $this->_get_statuses("10");
        $synchronized = $this->Synchronized->find()
            ->where(['and'=>[["Synchronized.date > ".mktime(0,0,0,$this->Settings->__find_setting('display_stat_last',$this->settings))],["Synchronized.date < ".mktime()]]])
            ->sortBy('date','DESC');
            $this->set('display_chart',$this->Settings->__find_setting('display_chart',$this->settings));
            $this->set('display_log_dashbord',$this->Settings->__find_setting('display_log_dashbord',$this->settings));
            $this->set(compact('data','synchronized'));
        $this->render('home');
    }
}
