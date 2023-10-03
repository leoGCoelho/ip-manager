<?php
declare(strict_types=1);

namespace App\Controller\Admin;
use App\Controller\AppController;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $clients = $this->paginate($this->Clients);

        $this->set(compact('clients'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($project_id=null)
    {
        $client = $this->Clients->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $client = $this->Clients->patchEntity($client, $data);
            if ($this->Clients->save($client)) {
                $project_client_data = [
                    'project_id' => $project_id,
                    'client_id' => $client->id,
                ];

                $project_client = $this->Clients->ProjectClients->newEmptyEntity();
                $project_client = $this->Clients->ProjectClients->patchEntity($project_client, $project_client_data);
                if ($this->Clients->ProjectClients->save($project_client)) {
                    $this->Flash->success(__('The client has been saved.'));

                    return $this->redirect(['controller' => 'Projects', 'action' => 'view', $project_id]);
                }
            }
            $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }
        $this->set(compact('client', 'project_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $project_id=null)
    {
        $client = $this->Clients->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved.'));

                return $this->redirect(['controller'=>'Projects','action' => 'view', $project_id]);
            }
            $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }
        $this->set(compact('client'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $project_id=null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $client = $this->Clients->get($id);
        $project_clients = $this->loadModel('ProjectClients')->find()->where(['client_id' => $id]);

        foreach($project_clients as $proj){
            if (!$this->ProjectClients->delete($proj)) $this->Flash->error(__('The project-client could not be deleted. Please, try again.'));
        }

        if ($this->Clients->delete($client)) {
            $this->Flash->success(__('The client has been deleted.'));
        } else {
            $this->Flash->error(__('The client could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'Projects','action' => 'view', $project_id]);
    }
}
