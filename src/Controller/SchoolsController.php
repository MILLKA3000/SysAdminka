<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Schools Controller
 *
 * @property \App\Model\Table\SchoolsTable $Schools
 */
class SchoolsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('schools', $this->paginate($this->Schools));
    }

    /**
     * View method
     *
     * @param string|null $id School id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function view($id = null)
    {
        $school = $this->Schools->get($id);
       $this->set('school', $school);
    }

    /**
     * Add method
     *
     * @return void
     */
    public function add()
    {
        $disabled='';
        $school = $this->Schools->newEntity();
        if ($this->request->is('post')) {
            $school = $this->Schools->patchEntity($school, $this->request->data);
            if ($this->Schools->save($school)) {
                $this->Flash->success('The school has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The school could not be saved. Please, try again.');
            }
        }

        $this->set(compact('school','disabled'));
        $this->render('edit');
    }

    /**
     * Edit method
     *
     * @param string|null $id School id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null)
    {
        $disabled='disabled';
        $school = $this->Schools->find()
            ->where(['id' => $id])
            ->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $school = $this->Schools->patchEntity($school, $this->request->data);
            if ($this->Schools->save($school)) {
                $this->Flash->success('The school has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The school could not be saved. Please, try again.');
            }
        }
                $this->set(compact('school','disabled'));
    }

    /**
     * Delete method
     *
     * @param string|null $id School id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function delete($id = null)
    {
//        $this->request->allowMethod(['post', 'delete']);
        $school = $this->Schools->find()->where(['id' => $id])->first();
        if ($this->Schools->delete($school)) {
            $this->Flash->success('The school has been deleted.');
        } else {
            $this->Flash->error('The school could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }



}
