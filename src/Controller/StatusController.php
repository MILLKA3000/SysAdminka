<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Status Controller
 *
 * @property \App\Model\Table\StatusTable $Status
 */
class StatusController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => []
        ];
        $this->set('status', $this->paginate($this->Status));
    }

    /**
     * View method
     *
     * @param string|null $id Status id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
//    public function view($id = null)
//    {
//        $status = $this->Status->get($id, [
//            'contain' => [ 'Students']
//        ]);
//        $this->set('status', $status);
//    }

    /**
     * Add method
     *
     * @return void
     */
    public function add()
    {

        $status = $this->Status->newEntity();
        if ($this->request->is('post')) {
            $status = $this->Status->patchEntity($status, $this->request->data);
            if ($this->Status->save($status)) {
                $this->Flash->success('The status has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The status could not be saved. Please, try again.');
            }
        }
        $this->set(compact('status'));
        $this->render('edit');
    }

    /**
     * Edit method
     *
     * @param string|null $id Status id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null)
    {
        $status = $this->Status->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $status = $this->Status->patchEntity($status, $this->request->data);
            if ($this->Status->save($status)) {
                $this->Flash->success('The status has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The status could not be saved. Please, try again.');
            }
        }

        $this->set(compact('status'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Status id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function delete($id = null)
    {
//        $this->request->allowMethod(['post', 'delete']);
        $status = $this->Status->get($id);
        if ($this->Status->delete($status)) {
            $this->Flash->success('The status has been deleted.');
        } else {
            $this->Flash->error('The status could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
