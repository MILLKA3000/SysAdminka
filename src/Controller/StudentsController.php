<?php
namespace App\Controller;


use App\Controller\AppController;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 */
class StudentsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */

    public function index($statuses=1,$search=NULL)
    {

        $this->loadModel('Settings');
        $this->settings = $this->Settings->_get_settings();
        $status = $this->Students->Status->find('list', ['limit' => 50]);
        $this->set('students', $this->Students->find()->contain(['Schools','Status','Specials'])->limit(10000));
        $this->set('viev_photo_students',$this->Settings->__find_setting('viev_photo_students',$this->settings));
        $this->set(compact('status','statuses','search'));
    }

    public function count_student(){
        $this->layout='ajax';
        $this->autoRender = false;
        $data = $this->Students->find()->where(['(send_photo_google=0 AND status_id=1)'])->limit($this->Settings->__find_setting('limit_send_photo',$this->Settings->_get_settings()));
        echo json_encode($data);
    }

    public function save_google_post($id){
        $data = $this->Students->get($id);
        $data['send_photo_google']=1;
        $this->Students->save($data);
        echo "Ok";
        $this->layout='ajax';
        $this->autoRender = false;
    }

    public function delete_google_post($id){
        $data = $this->Students->get($id);
        $data['send_photo_google']=0;
        $this->Students->save($data);
        echo "Ok";
        $this->layout='ajax';
        $this->autoRender = false;
    }
    /**
     * View method
     *
     * @param string|null $id Student id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
//    public function view($id = null)
//    {
//        $student = $this->Students->get($id, [
//            'contain' => ['Schools']
//        ]);
//        $this->set('student', $student);
//    }

    /**
     * Add method
     *
     * @return void
     */
//    public function add()
//    {
//        $student = $this->Students->newEntity();
//        if ($this->request->is('post')) {
//            $student = $this->Students->patchEntity($student, $this->request->data);
//            if ($this->Students->save($student)) {
//                $this->Flash->success('The student has been saved.');
//                return $this->redirect(['action' => 'index']);
//            } else {
//                $this->Flash->error('The student could not be saved. Please, try again.');
//            }
//        }
//        $schools = $this->Students->Schools->find('list', ['limit' => 200]);
//        $students = $this->Students->Students->find('list', ['limit' => 200]);
//        $this->set(compact('student', 'schools', 'students'));
//    }

    /**
     * Edit method
     *
     * @param string|null $id Student id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null)
    {
        $student = $this->Students->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $student = $this->Students->patchEntity($student, $this->request->data);
            if ($this->Students->save($student)) {

               $this->Flash->success('The student has been saved.');
               return $this->redirect(['action' => 'index']);
            } else {

                $this->Flash->error('The student could not be saved. Please, try again.');
            }
        }
        $schools = $this->Students->Schools->find('list', ['limit' => 50]);
        $specials = $this->Students->Specials->find('list', ['limit' => 50]);
        $status = $this->Students->Status->find('list', ['limit' => 50]);
        $this->set(compact('student', 'schools','status','specials'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Student id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function delete($id = null)
    {
        $student = $this->Students->find()->where(['status_id'=>10,'id'=>$id])->first();
        if (isset($student)){
        if ($this->Students->delete($student)) {
            $this->Flash->success('The student has been deleted.');
        } else {
            $this->Flash->error('The student could not be deleted. Please, try again.');
        }
        }else{
            $this->Flash->error('The student could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }



}
