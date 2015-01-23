<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Staff Controller
 *
 * @property \App\Model\Table\StaffTable $Staff
 */
class StaffController extends AppController
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
        $this->set('staff', $this->paginate($this->Staff));
    }

    /**
     * View method
     *
     * @param string|null $id Staff id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function view($id = null)
    {
        $staff = $this->Staff->get($id, [
            'contain' => ['Schools', 'Staffs']
        ]);
        $this->set('staff', $staff);
    }

    /**
     * Add method
     *
     * @return void
     */
    public function add()
    {
        $staff = $this->Staff->newEntity();
        if ($this->request->is('post')) {
            $staff = $this->Staff->patchEntity($staff, $this->request->data);
            if ($this->Staff->save($staff)) {
                $this->Flash->success('The staff has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The staff could not be saved. Please, try again.');
            }
        }
        $schools = $this->Staff->Schools->find('list', ['limit' => 200]);
        $staffs = $this->Staff->Staffs->find('list', ['limit' => 200]);
        $this->set(compact('staff', 'schools', 'staffs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Staff id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null)
    {
        $staff = $this->Staff->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $staff = $this->Staff->patchEntity($staff, $this->request->data);
            if ($this->Staff->save($staff)) {
                $this->Flash->success('The staff has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The staff could not be saved. Please, try again.');
            }
        }
        $schools = $this->Staff->Schools->find('list', ['limit' => 200]);
        $staffs = $this->Staff->Staffs->find('list', ['limit' => 200]);
        $this->set(compact('staff', 'schools', 'staffs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Staff id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $staff = $this->Staff->get($id);
        if ($this->Staff->delete($staff)) {
            $this->Flash->success('The staff has been deleted.');
        } else {
            $this->Flash->error('The staff could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
