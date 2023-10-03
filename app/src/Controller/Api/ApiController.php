<?php
declare(strict_types=1);

namespace App\Controller\Api;
use App\Controller\AppController;
use Cake\Event\EventInterface;

/**
 * Api Controller
 *
 * @method \App\Model\Entity\Api[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApiController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['index', 'checkip']);
    }

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function SetResponseMsg($msg=null, $cod=200){
        $response_msg = $this->response->withType('application/json')->withStringBody(json_encode($msg))->withStatus($cod);
        return $response_msg;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        return $this->SetResponseMsg(['success'=>true]);
    }

    /**
     * View method
     *
     * @param string|null $id Api id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function checkip()
    {
        if (!($this->request->is(['get']))){
            return $this->SetResponseMsg(['success'=>false, 'cod'=>10], 405);
        }

        $request_data = (string) $this->request->getBody();
        $request_data = json_decode($request_data, true);

        if((!isset($request_data['ip'])) || (is_null($request_data['ip'])))
            return $this->SetResponseMsg(['success'=>false, 'cod'=>11], 400);

        $token = null;
        if(isset($this->request->getHeader('Authorization')[0])){
            if (preg_match('/Bearer\s(\S+)/', $this->request->getHeader('Authorization')[0], $matches)) 
                $token = $matches[1];
             else 
                return $this->SetResponseMsg(['success'=>false, 'cod'=>12], 401);
            
        } else
            return $this->SetResponseMsg(['success'=>false, 'cod'=>12], 401);
        
        $project = $this->loadModel('Projects')->find('all', [
            'conditions' => ['token' => $token, 'serverip'=>$this->request->clientIp()],
        ])->first();

        if(is_null($project))
            return $this->SetResponseMsg(['success'=>false, 'cod'=>13], 401);

        $client = $this->loadModel('Clients')->find('all', ['conditions'=>['clientip'=>$request_data['ip']]])->first();
        
        if(is_null($client))
            return $this->SetResponseMsg(['success'=>false, 'cod'=>14], 404);

        $ipchecked = $this->loadModel('ProjectClients')->find('all', ['conditions'=>['project_id'=>$project->id,'client_id'=>$client->id]])->first();

        if(is_null($ipchecked))
            return $this->SetResponseMsg(['success'=>false, 'cod'=>14], 404);

        return $this->SetResponseMsg(['success'=>true], 200);
    }

    
}
