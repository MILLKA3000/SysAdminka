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
    public function beforeFilter(){
        $contingent = new class_ibase_fb();
        $contingent->sql_connect();
    }

    public function index(){

    }

    public function contingent(){


        $this->render('index');
    }
}