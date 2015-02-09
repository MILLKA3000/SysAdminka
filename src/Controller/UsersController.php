<?php
namespace App\Controller;
include_once('Component/Google_Api/autoload.php');
use App\Controller\AppController;
use Google_Client;
use Google_Service_Oauth2;
use Google_Service_Plus;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    private $client_id = '943473990893-ja51t9rhce8789lal48gtpmbh4oht945.apps.googleusercontent.com';
    private $client_secret = 'NqRmhVDrVd54AgEp9-7E7f4H';
    private $redirect_uri = 'http://adm.milka.co.vu/users/oauth2callback';
    private $client;

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {

                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
        $this->layout="login";
    }

    public function logout()
    {
        unset($_SESSION['access_token']);
        unset($_SESSION['service_token']);

        return $this->redirect($this->Auth->logout());
    }

    /*
     *
     *  for Oauth google authorization
     *
     */
    public function oauth2callback(){
        $this->client = new Google_Client();
        $this->client->setApplicationName("SysAdminka");
        $this->client->setClientId($this->client_id);
        $this->client->setClientSecret($this->client_secret);
        $this->client->setRedirectUri($this->redirect_uri);
        $this->client->setScopes(array(
            "https://www.googleapis.com/auth/plus.login",
            "https://www.googleapis.com/auth/userinfo.email",
            "https://www.googleapis.com/auth/userinfo.profile",
            "https://www.googleapis.com/auth/plus.me"
        ));
        $this->service = new Google_Service_Oauth2($this->client);
        if (isset($_GET['code'])) {
            $this->client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $this->client->getAccessToken();
            $user = $this->service->userinfo_v2_me->get();
            $sync_user_auth = $this->Users->find()->where(['email LIKE "'.$user->getEmail().'"'])->first();
            if (isset($sync_user_auth)){

                $data['id'] =  $sync_user_auth->id;
                $data['email'] = $sync_user_auth->email;
                $data['fname'] = $sync_user_auth->fname;
                $data['lname'] = $sync_user_auth->lname;
                $this->Auth->setUser($data);
                return $this->redirect($this->Auth->redirectUrl());
                die;
            }else{
                $this->Flash->error(__('This google account no access'));
                return $this->redirect($this->Auth->logout());
                die;
            }
        }

        if (isset($_SESSION['access_token'])) {
            $this->client->setAccessToken($_SESSION['access_token']);
        }

        if (!$this->client->getAccessToken()) {
            $authUrl = $this->client->createAuthUrl();
            header("Location: ".$authUrl);
            die;
        }
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('users', $this->paginate($this->Users));
    }

    /**
     * View method
     *
     * @param string|null $id User id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $this->set('user', $user);
    }


    /**
     * Add method
     *
     * @return void
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $this->set(compact('user'));
        $this->render('edit');
    }

    /**
     * Edit method
     *
     * @param string|null $id User id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function delete($id = null)
    {
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
