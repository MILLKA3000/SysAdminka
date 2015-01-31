<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Synchronized Controller
 *
 * @property \App\Model\Table\SynchronizedTable $Synchronized
 */
class SynchronizedController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('synchronized', $this->paginate($this->Synchronized)->sortBy('date','DESC'));
    }

    /**
     * View method
     *
     * @param string|null $id Synchronized id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function view($id = null)
    {
        $synchronized = $this->Synchronized->get($id, [
            'contain' => []
        ]);
        $this->set('synchronized', $synchronized);
    }

    /**
     * Add method
     *
     * @return void
     */
//    public function add()
//    {
//        $synchronized = $this->Synchronized->newEntity();
//        if ($this->request->is('post')) {
//            $synchronized = $this->Synchronized->patchEntity($synchronized, $this->request->data);
//            if ($this->Synchronized->save($synchronized)) {
//                $this->Flash->success('The synchronized has been saved.');
//                return $this->redirect(['action' => 'index']);
//            } else {
//                $this->Flash->error('The synchronized could not be saved. Please, try again.');
//            }
//        }
//        $this->set(compact('synchronized'));
//    }

    /**
     * Edit method
     *
     * @param string|null $id Synchronized id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
//    public function edit($id = null)
//    {
//        $synchronized = $this->Synchronized->get($id, [
//            'contain' => []
//        ]);
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            $synchronized = $this->Synchronized->patchEntity($synchronized, $this->request->data);
//            if ($this->Synchronized->save($synchronized)) {
//                $this->Flash->success('The synchronized has been saved.');
//                return $this->redirect(['action' => 'index']);
//            } else {
//                $this->Flash->error('The synchronized could not be saved. Please, try again.');
//            }
//        }
//        $this->set(compact('synchronized'));
//    }

    /**
     * Delete method
     *
     * @param string|null $id Synchronized id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
//    public function delete($id = null)
//    {
//        $this->request->allowMethod(['post', 'delete']);
//        $synchronized = $this->Synchronized->get($id);
//        if ($this->Synchronized->delete($synchronized)) {
//            $this->Flash->success('The synchronized has been deleted.');
//        } else {
//            $this->Flash->error('The synchronized could not be deleted. Please, try again.');
//        }
//        return $this->redirect(['action' => 'index']);
//    }
}
