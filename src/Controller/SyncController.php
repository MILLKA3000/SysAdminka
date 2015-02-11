<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Network\Request;

use Cake\Network\Http\Client;;

include_once('Firebird/class_firebird.php');
include_once('Component/Google_Api/autoload.php');
include_once ('Component/Google_Api/src/Google/Client.php');
include_once ('Component/Google_Api/src/Google/Sevice/Oauth2.php');
include_once ('Component/Google_Api/src/Google/Auth/AssertionCredentials.php');
include_once('Component/CsvComponent.php');

use class_ibase_fb;
use Google_Client;
use Google_Auth_AssertionCredentials;
use Google_Service_Directory;
use Google_Service_Oauth2;
use Cake\Network\Email\Email;
use CsvComponent;


/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 */
class SyncController extends AppController
{
    private static $ukrainianToEnglishRules = [
        'А' => 'A',
        'Б' => 'B',
        'В' => 'V',
        'Г' => 'G',
        'Ґ' => 'G',
        'Д' => 'D',
        'Е' => 'E',
        'Є' => 'E',
        'Ж' => 'J',
        'З' => 'Z',
        'И' => 'Y',
        'І' => 'I',
        'Ї' => 'Yi',
        'Й' => 'J',
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
        'Х' => 'H',
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
        'г' => 'g',
        'ґ' => 'g',
        'д' => 'd',
        'е' => 'e',
        'є' => 'e',
        'ж' => 'j',
        'з' => 'z',
        'и' => 'y',
        'і' => 'i',
        'ї' => 'yi',
        'й' => 'j',
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
        'х' => 'h',
        'ц' => 'ts',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'shch',
        'ь'  => '',
        'ю' => 'yu',
        'я' => 'ya',
        '\'' => ''
    ];

    private $options_csv;

    private $max;

    private $user_for_Api =  "admin4eg@tdmu.edu.ua";

    private $service_account_name = '943473990893-gkf9eek54q9ij5oh0nm1e77487fdd8n4@developer.gserviceaccount.com';

    var $uses = array('Students');

    private $contingent; //object for connect with contingent

    private $students;

    private $speciality;

    private $status = false;

    private $message = array();

    private $options = array();

    private $client;

    private $service;

    private $test;


    public function beforeFilter(){  // Constructor
        $this->contingent = new class_ibase_fb();
        $this->contingent->sql_connect();
        $this->options_csv = [
            'length' => 0,
            'delimiter' => ',',
            'enclosure' => '"',
            'escape' => '\\',
            'headers' => true,
            'text' => false,
        ];
    }

    public function index(){
        return $this->redirect(['action' => 'contingent']);
    }

    private function _get_students(){
        $this->students = $this->contingent->gets("
			SELECT STUDENTS.DEPARTMENTID,STUDENTS.SEMESTER,STUDENTS.FIO,STUDENTS.NFIO,STUDENTS.STUDENTID,STUDENTS.PHOTO,STUDENTS.ARCHIVE,STUDENTS.GROUPNUM,STUDENTS.STATUS,STUDENTS.SPECIALITYID
			FROM STUDENTS WHERE ARCHIVE=0");
    }
    private function _get_speciality(){
        $this->speciality = $this->contingent->gets("
			SELECT SPECIALITYID,SPECIALITY,CODE FROM GUIDE_SPECIALITY WHERE USE=1");
    }

    private function _test_ping(){
        $this->test = $this->contingent->gets("
			SELECT First 1 STUDENTID
			FROM STUDENTS WHERE ARCHIVE=0");
        if (!isset($this->test[1]['STUDENTID'])) $this->Flash->error('Connect to Contingent not found!!!');
    }


    /*
     *
     * function for connect with directory Api Google
     *
     */
    private function connect_google_api(){
        $this->client = new Google_Client();
        $this->client->setApplicationName("SysAdminka");
        $key = (file_get_contents(ROOT.DS."webroot".DS."Google_key".DS."1fa047635e4bac618edbe30d56e074cff7ad9a75-privatekey.p12"));
        $this->service = new Google_Service_Directory($this->client);
        if (isset($_SESSION['service_token'])) {
            $this->client->setAccessToken($_SESSION['service_token']);
        }
        $cred = new Google_Auth_AssertionCredentials(
            $this->service_account_name,
            array('https://www.googleapis.com/auth/admin.directory.user'),
            $key,
            'notasecret'
        );
        $cred->sub = $this->user_for_Api;
        $this->client->setAssertionCredentials($cred);
        if ($this->client->getAuth()->isAccessTokenExpired()) {
            $this->client->getAuth()->refreshTokenWithAssertion($cred);
        }
        $_SESSION['service_token'] = $this->client->getAccessToken();
    }

    /*
     *
     *  for Service google
     *
     */
    public function LDB_ToGoogle_photo($user,$force=NULL){
        $this->connect_google_api();
        $datas = new \Google_Service_Directory_UserPhoto();
            $user_of_google = $this->service->
                users->
                listUsers(['orderBy'=>'email',
                           'domain'=>'tdmu.edu.ua',
                           'query'=>'email='.$user.'@tdmu.edu.ua'])
                ->getUsers();
            if(count($user_of_google)>0){

//                $this->service->users_photos->delete($user.'@tdmu.edu.ua');
                try {
                    $this->service->users_photos->get($user.'@tdmu.edu.ua');
                } catch (\Exception $e) {
                    $force=true;
                }
                if ($force==true){
                    $datas->setPhotoData($this->base64url_encode(file_get_contents(ROOT.DS."webroot".DS."photo".DS.$user.".jpg")));
                    $datas->setWidth(124);
                    $this->service->users_photos->update($user.'@tdmu.edu.ua',$datas);
                    echo "Ok";
                }
            }
        $this->layout='ajax';
        $this->autoRender = false;
    }
        /*
         *
         *  Delete photo in google
         *
         */
    public function LDB_ToGoogle_photo_delete($user){
        $this->connect_google_api();
        $user_of_google = $this->service->
            users->
            listUsers(['orderBy'=>'email',
                       'domain'=>'tdmu.edu.ua',
                       'query'=>'email='.$user.'@tdmu.edu.ua'])
            ->getUsers();
        if(count($user_of_google)>0){
            $this->service->users_photos->delete($user.'@tdmu.edu.ua');
            echo "Ok";
        }
        $this->layout='ajax';
        $this->autoRender = false;
    }
        /*
         *
         *  Get all information the student with google
         *
         */
    public function Get_info_google($user){
        $this->connect_google_api();
        $user_of_google = $this->service->users->get($user.'@tdmu.edu.ua');
        $user_of_google->setName = $user_of_google->name;
        echo json_encode($user_of_google);
        $this->layout='ajax';
        $this->autoRender = false;
    }

    private function base64url_encode($mime) {
        return rtrim(strtr(base64_encode($mime), '+/', '-_'), '=');
    }

    public function contingent(){
    $this->_test_ping();
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
            if ($this->request->data['photo']==on){
                $this->_get_students();
                $this->_sync_C_with_LDB_photo();
            }
            if ($this->request->data['google_photo']==on){
                $this->set('modal_google',true);
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
            $this->message[]['message']="Sorry, there are no new records in Contingent databace";
        }
    }

    private function _view_photo_blob($photo){
        header("Content-Type: image/jpeg");
        ibase_blob_echo($photo);
    }

    private function _sync_C_with_LDB_photo(){

        foreach($this->students as $student_of_contingent){
            $name = $this->_emplode_fi($student_of_contingent['FIO']);
            $img = ibase_blob_get(ibase_blob_open($student_of_contingent['PHOTO']), ibase_blob_info($student_of_contingent['PHOTO'])[0]);
            file_put_contents('photo/'.$name['uname'].'.jpg', $img);

        }
        $this->message[]['message']='Sync photos was successful';

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
                ->where(['special_id ' => $speciality_of_contingent['SPECIALITYID'].' AND status_id != 7'])
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
                    if ($speciality_of_contingent['CODE']!=$specials_ldb->code){
                        $rename++;
                        $data['code']=$speciality_of_contingent['CODE'];
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
                    $data['code'] = $speciality_of_contingent['CODE'];
                    if ($this->Specials->save($data)) {
                        $this->options['new_specials']++;
                        $this->status=true;
//                        $this->message[]['message']='New speciality: '.$this->options['new_specials'];

                    }
                }
        }
        if(($this->options['rename_specials']==0) and ($this->options['new_specials']==0)){
            $this->message[]['message']="Sorry, there are no new records in Contingent databace";
        }
    }



    /*
     * Sync Students with Contingent into Local DataBase
     */
    private function _sync_C_with_LDB_users(){
        $this->loadModel('Students');
        $this->_max_id();
        foreach($this->students as $student_of_contingent){
            $student_ldb = $this->Students->find()
                ->where(['student_id ' => $student_of_contingent['STUDENTID']])
                ->first();
            if ($student_of_contingent['STATUS']=='С'){
                if (isset($student_ldb)){
                    $rename=0;
                    $student_of_contingent['NFIO']!=null ? $name = $this->_emplode_fi($student_of_contingent['NFIO']) : $name = $this->_emplode_fi($student_of_contingent['FIO']);
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
                    $student_of_contingent['NFIO']!=null ? $name = $this->_emplode_fi($student_of_contingent['NFIO']) : $name = $this->_emplode_fi($student_of_contingent['FIO']);
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
                        $new_student_for_email++;
                        $this->options['new_student']++;
                        $this->status=true;
//                        $this->message[]['message']='New students: '.$this->options['new_student'];
                    }
                }
            }
        }
        if(($this->options['rename_student']==0) and ($this->options['new_student']==0)){
            $this->message[]['message']="Sorry, there are no new records in Contingent databace";
        }
        if (count($new_student_for_email)>0){
            $this->send_email($new_student_for_email,"New students in SysAdmin!");
        }
    }

    private function _max_id(){
        $this->loadModel('Students');
        $this->max = $this->Students->find('all', array('order'=>'Students.id DESC'))->first();
    }

    private function send_email($new_student_for_email,$title){
        $this->loadModel('Synchronized');
        $email = new Email('default');
        $Csv = new CsvComponent($this->options_csv);
        if (isset($this->max->id)){
            $data = $this->Students->find()->where(['id >'.$this->max->id])->all();
        }else{
            $data = $this->Students->find()->all();
        }
        $data =json_decode(json_encode($data), true);
        $Csv->exportCsv(ROOT.DS."webroot".DS."files/emails/".$_SESSION['Auth']['User']['id'].".csv", array($data), $this->options_csv);
        $email->from([$this->Settings->__find_setting('admin_emails',$this->Settings->_get_settings()) => 'Admilka(TDMU)'])
            ->to(json_decode($this->Settings->__find_setting('admin_emails_for_send',$this->Settings->_get_settings())))
            ->subject($title)
            ->attachments([ROOT.DS."webroot".DS."files/emails/".$_SESSION['Auth']['User']['id'].".csv"])
            ->send($title);
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
        if ($str[0]==' '){$str = substr($str, 1);}
        $str = str_replace("(","",$str);
        $str = str_replace(")","",$str);
        $str = str_replace("-","",$str);
        $str = str_replace("'","",$str);
        $str = str_replace(":","",$str);
        $str = str_replace(".","",$str);
        $str = str_replace("`","",$str);
        $str = str_replace("\"","",$str);
        $fullname = explode(" ", $str);
        $name['lname']=$fullname[0];
        $name['uname']=$this->_create_username($fullname[0])."_".$this->_create_username($fullname[1][0].$fullname[1][1].$fullname[1][2].$fullname[1][3].$fullname[2][0].$fullname[2][1].$fullname[2][2].$fullname[2][3]);
        unset($fullname[0]);
        $name['fname']=implode(" ", $fullname);
        return $name;
    }
}
