<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Network\Request;

include_once('Firebird/class_firebird.php');
use class_ibase_fb;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 */
class SyncController extends AppController
{

    var $uses = array('Students');

    private $contingent; //object for connect with contingent

    private $students;

    private $speciality;

    private $status = false;

    private $message = array();

    private $options = array();

    private static $ukrainianToEnglishRules = [
        'А' => 'A',
        'Б' => 'B',
        'В' => 'V',
        'Г' => 'H',
        'Ґ' => 'G',
        'Д' => 'D',
        'Е' => 'E',
        'Є' => 'Ye',
        'Ж' => 'Zh',
        'З' => 'Z',
        'И' => 'Y',
        'І' => 'I',
        'Ї' => 'Yi',
        'Й' => 'Y',
        'К' => 'K',
        'Л' => 'L',
        'М' => 'M',
        'Н' => 'N',
        'О' => 'O',
        'П' => 'P',
        'Р' => 'R',
        'С' => 'S',
        'Т' => 'T',
        'У' => 'U',
        'Ф' => 'F',
        'Х' => 'Kh',
        'Ц' => 'Ts',
        'Ч' => 'Ch',
        'Ш' => 'Sh',
        'Щ' => 'Shch',
        'Ь' => '',
        'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'h',
        'ґ' => 'g',
        'д' => 'd',
        'е' => 'e',
        'є' => 'ie',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'y',
        'і' => 'i',
        'ї' => 'i',
        'й' => 'i',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'kh',
        'ц' => 'ts',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'shch',
        'ь'  => '',
        'ю' => 'iu',
        'я' => 'ia',
        '\'' => ''
    ];

    public function beforeFilter(){
        $this->contingent = new class_ibase_fb();
        $this->contingent->sql_connect();
    }

    public function index(){
        return $this->redirect(['action' => 'contingent']);
    }

    /*
     * Get all students with Contingent
     */
    private function _get_students_semesters($semester){
//        $this->students = $this->contingent->gets("
//			SELECT STUDENTS.DEPARTMENTID,STUDENTS.SEMESTER,STUDENTS.FIO,STUDENTS.STUDENTID,STUDENTS.PHOTO,STUDENTS.ARCHIVE,STUDENTS.GROUPNUM
//			FROM STUDENTS WHERE STUDENTS.SEMESTER = ".$semester." and ARCHIVE=0");
    }

    private function _get_students(){
        $this->students = $this->contingent->gets("
			SELECT STUDENTS.DEPARTMENTID,STUDENTS.SEMESTER,STUDENTS.FIO,STUDENTS.STUDENTID,STUDENTS.PHOTO,STUDENTS.ARCHIVE,STUDENTS.GROUPNUM,STUDENTS.STATUS,STUDENTS.SPECIALITYID
			FROM STUDENTS WHERE ARCHIVE=0");
    }
    private function _get_speciality(){
        $this->speciality = $this->contingent->gets("
			SELECT SPECIALITYID,SPECIALITY FROM GUIDE_SPECIALITY WHERE USE=1");
    }
    public function contingent(){

        if ($this->request->is('post')) {
            if ($this->request->data(['special'])==on){
                $this->_get_speciality();
                $this->_sync_C_with_LDB_spec();
            }


            if ($this->request->data['archive']==on){
                $this->_sync_archive();
            }

            if ($this->request->data(['all_students'])==on){
                 $this->_get_students();
                 $this->_sync_C_with_LDB_users();
            }
            if ($this->status==true){
                $this->loadModel('Synchronized');
                $data = $this->Synchronized->newEntity();
                $data['status_contingent']='ok';
                $data['status_google']='--';
                $data['statistics']=json_encode($this->options);
                $data['date']=mktime();
                if ($this->Synchronized->save($data)) {
                    $this->message[]['message']='Sync is Ok. DB write status Ok.';
                }
            }
            $this->Flash->error_form($this->message);
        }
        $this->render('index');
    }

    private function _sync_archive(){
        $this->loadModel('Students');
        $students = $this->Students->find()->where(['((grade_level > 9) OR ((grade_level IN (1,2,3)) AND (school_id=44)))']);
        foreach($students as $student){
            $student_of_contingent = $this->contingent->gets("SELECT STUDENTS.ARCHIVE FROM STUDENTS WHERE STUDENTID LIKE '".$student->student_id."'");
            if ($student_of_contingent[1]['ARCHIVE']==1){
                $data = $this->Students->get($student->id);
                $data['status_id']=10;
                if ($this->Students->save($data)) {
                    $this->status=true;
                    $this->options['students_arhive']++;
                    $this->message[]['message']='Students is in archive: '. $this->options['students_arhive'];
                }
            }
        }
        if($this->options['students_arhive']==0){
            $this->message[]['message']="Sorry, no isn't the students in archive of Contingent now";
        }
    }

//-----------------------------------------------------------------------------------------------------------------------
    public function api(){
        $this->_get_students();
        $this->_sync_C_with_LDB_users();
        if ($this->status==true){
            $this->loadModel('Synchronized');
            $data = $this->Synchronized->newEntity();
            $data['status_contingent']='ok';
            $data['status_google']='--';
            $data['statistics']=json_encode($this->options);
            $data['date']=mktime();
            if ($this->Synchronized->save($data)) {
//                $this->message[]['message']='Sync is Ok. DB write status Ok.';
            }
        }
        $this->layout = 'ajax';
        $this->render(false);
    }
//-----------------------------------------------------------------------------------------------------------------------
    /*
     * Sync Contingent with Local DataBase
     */
    private function _sync_C_with_LDB_spec(){
        $this->loadModel('Specials');
        foreach($this->speciality as $speciality_of_contingent){
            $specials_ldb = $this->Specials->find()
                ->where(['special_id ' => $speciality_of_contingent['SPECIALITYID']])
                ->first();
                if (isset($specials_ldb)){
                    $rename=0;
                    $data = $this->Specials->find()->where(['special_id'=>$specials_ldb->special_id])->first();;
                    if ($speciality_of_contingent['SPECIALITYID']!=$specials_ldb->special_id){
                        $rename++;
                        $data['special_id']=$speciality_of_contingent['SPECIALITYID'];
                    }
                    if ($speciality_of_contingent['SPECIALITY']!=$specials_ldb->name){
                        $rename++;
                        $data['name']=$speciality_of_contingent['SPECIALITY'];
                    }
                    if($rename>0){
                        if ($this->Specials->save($data)) {
                            $this->options['rename_specials']++;
                            $this->status=true;
//                            $this->message[]['message']='Editing speciality: '.$this->options['rename_specials'];
                        }
                    }
                }else{
                    $data = $this->Specials->newEntity();
                    $data['special_id'] = $speciality_of_contingent['SPECIALITYID'];
                    $data['name'] = $speciality_of_contingent['SPECIALITY'];
                    if ($this->Specials->save($data)) {
                        $this->options['new_specials']++;
                        $this->status=true;
//                        $this->message[]['message']='New speciality: '.$this->options['new_specials'];

                    }
                }
        }
        if(($this->options['rename_specials']==0) and ($this->options['new_specials']==0)){
            $this->message[]['message']="Sorry, no isn't the new speciality in Contingent now";
        }
    }

    /*
     * Sync Contingent with Local DataBase
     */
    private function _sync_C_with_LDB_users(){
        $this->loadModel('Students');
        foreach($this->students as $student_of_contingent){
            $student_ldb = $this->Students->find()
                ->where(['student_id ' => $student_of_contingent['STUDENTID']])
                ->first();
            if ($student_of_contingent['STATUS']=='С'){
                if (isset($student_ldb)){
                    $rename=0;
                    $name = $this->_emplode_fi($student_of_contingent['FIO']);
                    $data = $this->Students->get($student_ldb->id);
                    if ($student_of_contingent['DEPARTMENTID']!=$student_ldb->school_id){
                        $rename++;
                        $data['school_id']=$student_of_contingent['DEPARTMENTID'];
                    }
                    if ($student_of_contingent['SPECIALITYID']!=$student_ldb->special_id){
                        $rename++;
                        $data['special_id']=$student_of_contingent['SPECIALITYID'];
                    }
                    if ($student_of_contingent['SEMESTER']!=$student_ldb->grade_level){
                        $rename++;
                        $data['grade_level']=$student_of_contingent['SEMESTER'];
                    }
                    if ($student_of_contingent['GROUPNUM']!=$student_ldb->groupnum){
                        $rename++;
                        $data['groupnum']=$student_of_contingent['GROUPNUM'];
                    }
                    if ($name['fname']!=$student_ldb->first_name){
                        $rename++;
                        $data['first_name']=$name['fname'];
                    }
                    if ($name['lname']!=$student_ldb->last_name){
                        $rename++;
                        $data['last_name']=$name['lname'];
                    }
                    if ($student_of_contingent['ARCHIVE']==true and $student_ldb->status_id!=10){
                        $rename++;
                        $data['status_id'] = 10;
                        $this->options['archive_student']++;
                    }else if ($student_of_contingent['ARCHIVE']==false and $student_ldb->status_id==10){
                        $rename++;
                        $data['status_id'] = 1;
                    }
                        if($rename>0){

                            if ($this->Students->save($data)) {
                                $this->options['rename_student']++;
                                $this->status=true;
//                                $this->message[]['message']='Editing students: '.$this->options['rename_student'];
                            }
                        }


                }else{

                    $name = $this->_emplode_fi($student_of_contingent['FIO']);
                    $data = $this->Students->newEntity();
                    $data['student_id'] = $student_of_contingent['STUDENTID'];
                    $data['school_id'] = $student_of_contingent['DEPARTMENTID'];
                    $data['special_id'] = $student_of_contingent['SPECIALITYID'];
                    $data['groupnum'] = $student_of_contingent['GROUPNUM'];
                    $data['first_name'] = $name['fname'];
                    $data['last_name'] = $name['lname'];
                    $data['user_name'] = $name['uname'];
                    $data['grade_level'] = $student_of_contingent['SEMESTER'];
                    $data['password'] = $this->_generate_pass();
                    $student_of_contingent['ARCHIVE']==1 ?  $data['status_id'] = 10 :  $data['status_id'] = 1;

                    $student_login_clone = $this->Students->find()
                        ->where(['user_name' => $name['uname']])
                        ->first();

                    if (isset($student_login_clone)){
                        $data['status_id'] = 3;
                        $this->options['clone_login_in students']++;
                    }

                    if ($this->Students->save($data)) {
                        $this->options['new_student']++;
                        $this->status=true;
//                        $this->message[]['message']='New students: '.$this->options['new_student'];
                    }
                }
            }
        }
        if(($this->options['rename_student']==0) and ($this->options['new_student']==0)){
            $this->message[]['message']="Sorry, no isn't the new students in Contingent now";
        }

    }
    /*
     * create user name
     */
    private function _create_username($ukrainianText){
            $transliteratedText = '';
            if (mb_strlen($ukrainianText) > 0) {
                $transliteratedText = str_replace(
                    array_keys(self::$ukrainianToEnglishRules),
                    array_values(self::$ukrainianToEnglishRules),
                    $ukrainianText
                );
            }
            return strtolower($transliteratedText);
    }


    /*
     * generate pass
     */
    private function _generate_pass(){
        return rand(10000000,99999999);
    }

    /*
     * implode fio -> fname, lname
     */
    private function _emplode_fi($str){
        $str = str_replace("(","",$str);
        $str = str_replace(")","",$str);
        $fullname = explode(" ", $str);
        $name['fname']=$fullname[0];
        $fullname[0] = str_replace("'","",$fullname[0]);
        $fullname[1] = str_replace("'","",$fullname[1]);
        $fullname[2] = str_replace("'","",$fullname[2]);
        $name['uname']=$this->_create_username($fullname[0])."_".$this->_create_username($fullname[1][0].$fullname[1][1].$fullname[1][2].$fullname[1][3].$fullname[2][0].$fullname[2][1].$fullname[2][2].$fullname[2][3]);
        unset($fullname[0]);
        $name['lname']=implode(" ", $fullname);
        return $name;
    }
}
