<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Classes Controller
 *
 * @property \App\Model\Table\ClassesTable $Classes
 */
class ClassesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Schools', 'Staffs']
        ];
        $this->set('classes', $this->paginate($this->Classes));
    }

    /**
     * View method
     *
     * @param string|null $id Class id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function view($id = null)
    {
        $class = $this->Classes->get($id, [
            'contain' => ['Schools', 'Staffs', 'Classes', 'Rosters']
        ]);
        $this->set('class', $class);
    }

    /**
     * Add method
     *
     * @return void
     */
    public function add()
    {
        $class = $this->Classes->newEntity();
        if ($this->request->is('post')) {
            $class = $this->Classes->patchEntity($class, $this->request->data);
            if ($this->Classes->save($class)) {
                $this->Flash->success('The class has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The class could not be saved. Please, try again.');
            }
        }
        $schools = $this->Classes->Schools->find('list', ['limit' => 200]);
        $staffs = $this->Classes->Staffs->find('list', ['limit' => 200]);
        $this->set(compact('class', 'schools', 'staffs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Class id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null)
    {
        $class = $this->Classes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $class = $this->Classes->patchEntity($class, $this->request->data);
            if ($this->Classes->save($class)) {
                $this->Flash->success('The class has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The class could not be saved. Please, try again.');
            }
        }
        $schools = $this->Classes->Schools->find('list', ['limit' => 200]);
        $staffs = $this->Classes->Staffs->find('list', ['limit' => 200]);
        $this->set(compact('class', 'schools', 'staffs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Class id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $class = $this->Classes->get($id);
        if ($this->Classes->delete($class)) {
            $this->Flash->success('The class has been deleted.');
        } else {
            $this->Flash->error('The class could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
