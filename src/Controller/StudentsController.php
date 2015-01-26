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

    public function index($statuses=0)
    {

        $this->paginate = [
            'contain' => ['Schools','Status'],
            'conditions' => ['Students.status_id' => $statuses],
            'limit' => '25'
        ];
        $status = $this->Students->Status->find('list', ['limit' => 200]);
        $this->set('students', $this->paginate($this->Students));
        $this->set(compact('status','statuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Student id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function view($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => ['Schools']
        ]);
        $this->set('student', $student);
    }

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
        $schools = $this->Students->Schools->find('list', ['limit' => 20]);
        $status = $this->Students->Status->find('list', ['limit' => 20]);
        $this->set(compact('student', 'schools','status'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Student id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
//    public function delete($id = null)
//    {
//        $this->request->allowMethod(['post', 'delete']);
//        $student = $this->Students->get($id);
//        if ($this->Students->delete($student)) {
//            $this->Flash->success('The student has been deleted.');
//        } else {
//            $this->Flash->error('The student could not be deleted. Please, try again.');
//        }
//        return $this->redirect(['action' => 'index']);
//    }

    function beforeSave() {
        die;
    }

}
