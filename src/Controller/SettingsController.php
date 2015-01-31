<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Settings Controller
 *
 * @property \App\Model\Table\SettingsTable $Settings
 */
class SettingsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('settings', $this->paginate($this->Settings));
    }

    /**
     * View method
     *
     * @param string|null $id Setting id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
//    public function view($id = null)
//    {
//        $setting = $this->Settings->get($id, [
//            'contain' => []
//        ]);
//        $this->set('setting', $setting);
//    }

    /**
     * Add method
     *
     * @return void
     */
    public function add()
    {
        $setting = $this->Settings->newEntity();
        if ($this->request->is('post')) {
            $setting = $this->Settings->patchEntity($setting, $this->request->data);
            if ($this->Settings->save($setting)) {
                $this->Flash->success('The setting has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The setting could not be saved. Please, try again.');
            }
        }
        $this->set(compact('setting'));
        $this->render('edit');
    }

    /**
     * Edit method
     *
     * @param string|null $id Setting id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null)
    {
        $disabled='disabled';
        $setting = $this->Settings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (is_array($this->request->data['config'])){
                $this->request->data['value'] = json_encode($this->request->data['config']);
            }
            $setting = $this->Settings->patchEntity($setting, $this->request->data);
            if ($this->Settings->save($setting)) {
                $this->Flash->success('The setting has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The setting could not be saved. Please, try again.');
            }
        }
        $this->set(compact('setting','disabled'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Setting id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
//    public function delete($id = null)
//    {
//        $this->request->allowMethod(['post', 'delete']);
//        $setting = $this->Settings->get($id);
//        if ($this->Settings->delete($setting)) {
//            $this->Flash->success('The setting has been deleted.');
//        } else {
//            $this->Flash->error('The setting could not be deleted. Please, try again.');
//        }
//        return $this->redirect(['action' => 'index']);
//    }



}
