<?php
declare(strict_types=1);

namespace App\Controller\Admin;
use App\Controller\AppController;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 * @method \App\Model\Entity\Project[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjectsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

    public function index()
    {
        //dd($projects);

        $pagtitle = "Todos Projetos";

        $this->set(compact('pagtitle'));
    }

    /**
     * View method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => ['UserProjects' => ['Users'], 'Organizations', 'ProjectClients' => ['Clients']]
        ])->toArray();

        $this->set(compact('project'));
    }

    public function confirm($token = null)
    {
        $this->set(compact('token'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($organization_id = null)
    {
        $project = $this->Projects->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['token'] = md5(uniqid((string) rand(), true));
            $project = $this->Projects->patchEntity($project, $data);
            if ($this->Projects->save($project)) {
                $usrproj = [
                    'user_id' => $this->Authentication->getIdentity()->id,
                    'project_id' => $project->id,
                    'role_id' => 1
                ];

                $userProject = $this->Projects->UserProjects->newEmptyEntity();
                $userProject = $this->Projects->UserProjects->patchEntity($userProject, $usrproj);
                if (!$this->Projects->UserProjects->save($userProject)) {
                    $this->Flash->error(__('The project could not be saved. Please, try again.'));
                }

                $this->Flash->success(__('The project has been saved. Token: ' . $data['token']));

                //return $this->redirect(['action' => 'view', $project->id]);
                return $this->redirect(['controller' => 'Projects', 'action' => 'confirm', $data['token']]);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
        $this->set(compact('project', 'organization_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['action' => 'view', $project->id]);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
        $this->set(compact('project'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id, [
            'contain' => ['ProjectClients'=> ['Clients']],
        ]);

        foreach ($project->project_clients as $ip) {
            if(!$this->Projects->ProjectClients->Clients->delete($ip->client))
            {
                $this->Flash->error(__('The project could not be deleted $ID='.$ip->client->id.'. Please, try again.'));
                return $this->redirect(['action' => 'view', $project->id]);
            }
        }

        if ($this->Projects->delete($project)) {
            $this->Flash->success(__('The project has been deleted.'));
        } else {
            $this->Flash->error(__('The project could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
    }
}
