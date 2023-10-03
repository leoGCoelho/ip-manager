<?php
declare(strict_types=1);

namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Routing\Router;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['login', 'makeDefaultUser']);
    }

    public $paginate = [
        'Users' => [
            'limit' => 8,
            'order' => [
                'Users.name' => 'asc'
            ]
        ]
    ];

    public function login()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            return $this->redirect(['_name' => 'admin_index']);
        }
        if ($this->request->is('post')) {
            $this->Flash->error('E-mail ou senha inválido');
        }
        $this->viewBuilder()->disableAutoLayout();
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['_name' => 'admin_users_login']);
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->paginate($this->Users);
        $pageurl = Router::url(['_name' => 'admin_users_index']) . '?page=';
        $pageindex = ((is_null($this->request->getParam('page'))) && ($this->request->getParam('page')!=0)) ? $this->request->getParam('page') : 1;
        $pageindex = intval($pageindex);

        $pagtitle = "Todos Usuários";
        $this->set(compact('users', 'pagtitle', 'pageurl', 'pageindex'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $pagtitle = "Visualizar Usuário";
        $this->set(compact('user', 'pagtitle'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $pagtitle = "Adicionar Usuário";
        $this->set(compact('user', 'pagtitle'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $pagtitle = "Editar Usuário";
        $this->set(compact('user', 'pagtitle'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        if ($this->Authentication->getIdentity()->id == $id) {
            $this->Flash->error(__('Você não pode excluir seu próprio usuário.'));
            return $this->redirect(['action' => 'index']);
        }

        $user = $this->Users->get($id);$user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function unlock($id = null)
    {
        
    }

    public function makeDefaultUser($password = 'senha123'){
        dd((new DefaultPasswordHasher())->hash($password));
    }
}
