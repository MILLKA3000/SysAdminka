<?php
namespace App\Controller;
use App\Controller\AppController;

include_once('Firebird/class_firebird.php');
use class_ibase_fb;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 */
class SyncController extends AppController
{
    private $contingent;

    public function beforeFilter(){
        $this->contingent = new class_ibase_fb();
        $this->contingent->sql_connect();
    }

    public function index(){

    }

    public function contingent(){
        $this->contingent = new class_ibase_fb();
        $this->contingent->sql_connect();
        $stydents = $this->contingent->select("
			SELECT FIRST 10 STUDENTS.FIO,STUDENTS.GROUPNUM,STUDENTS.EDUBASISID,STUDENTS.SEX,STUDENTS.BIRTHDATE,STUDENTS.STUDENTID
			FROM STUDENTS ");
        print_r($stydents);
        $this->render('index');
    }
}