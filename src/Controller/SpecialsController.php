<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Specials Controller
 *
 * @property \App\Model\Table\SpecialsTable $Specials
 */
class SpecialsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('specials', $this->paginate($this->Specials));
    }

    /**
     * View method
     *
     * @param string|null $id Special id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function view($id = null)
    {
        $special = $this->Specials->get($id);
        $this->set('special', $special);
    }

    /**
     * Add method
     *
     * @return void
     */
    public function add()
    {
        $disabled='';
        $special = $this->Specials->newEntity();
        if ($this->request->is('post')) {
            $special = $this->Specials->patchEntity($special, $this->request->data);
            if ($this->Specials->save($special)) {
                $this->Flash->success('The special has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The special could not be saved. Please, try again.');
            }
        }
        $this->set(compact('special','disabled'));
        $this->render('edit');
    }

    /**
     * Edit method
     *
     * @param string|null $id Special id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null)
    {
        $disabled='disabled';
        $special = $this->Specials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $special = $this->Specials->patchEntity($special, $this->request->data);
            if ($this->Specials->save($special)) {
                $this->Flash->success('The special has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The special could not be saved. Please, try again.');
            }
        }
        $this->set(compact('special','disabled'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Special id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function delete($id = null)
    {
        $special = $this->Specials->get($id);
        if ($this->Specials->delete($special)) {
            $this->Flash->success('The special has been deleted.');
        } else {
            $this->Flash->error('The special could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
