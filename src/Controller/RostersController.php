<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Rosters Controller
 *
 * @property \App\Model\Table\RostersTable $Rosters
 */
class RostersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Schools', 'Classes', 'Students']
        ];
        $this->set('rosters', $this->paginate($this->Rosters));
    }

    /**
     * View method
     *
     * @param string|null $id Roster id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function view($id = null)
    {
        $roster = $this->Rosters->get($id, [
            'contain' => ['Schools', 'Classes', 'Students']
        ]);
        $this->set('roster', $roster);
    }

    /**
     * Add method
     *
     * @return void
     */
    public function add()
    {
        $roster = $this->Rosters->newEntity();
        if ($this->request->is('post')) {
            $roster = $this->Rosters->patchEntity($roster, $this->request->data);
            if ($this->Rosters->save($roster)) {
                $this->Flash->success('The roster has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The roster could not be saved. Please, try again.');
            }
        }
        $schools = $this->Rosters->Schools->find('list', ['limit' => 200]);
        $classes = $this->Rosters->Classes->find('list', ['limit' => 200]);
        $students = $this->Rosters->Students->find('list', ['limit' => 200]);
        $this->set(compact('roster', 'schools', 'classes', 'students'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Roster id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null)
    {
        $roster = $this->Rosters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $roster = $this->Rosters->patchEntity($roster, $this->request->data);
            if ($this->Rosters->save($roster)) {
                $this->Flash->success('The roster has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The roster could not be saved. Please, try again.');
            }
        }
        $schools = $this->Rosters->Schools->find('list', ['limit' => 200]);
        $classes = $this->Rosters->Classes->find('list', ['limit' => 200]);
        $students = $this->Rosters->Students->find('list', ['limit' => 200]);
        $this->set(compact('roster', 'schools', 'classes', 'students'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Roster id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $roster = $this->Rosters->get($id);
        if ($this->Rosters->delete($roster)) {
            $this->Flash->success('The roster has been deleted.');
        } else {
            $this->Flash->error('The roster could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
