<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');

    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $navname = '';
        if (isset($this->Authentication->getIdentity()->name)){
            $navname = (empty($this->Authentication->getIdentity()->name) || $this->Authentication->getIdentity()->name=='') ? strstr($this->Authentication->getIdentity()->email, '@', true) : $this->Authentication->getIdentity()->name;
        }
        if (isset($this->Authentication->getIdentity()->id)) {
            $loggeduser_organizations = $this->loadModel('UserOrganizations')->find()->contain(['Organizations', 'Users'])->where(['user_id' => $this->Authentication->getIdentity()->id]);
            $this->set(compact('loggeduser_organizations'));

            $projects_src = $this->loadModel('Projects')->find('all', [
                'contain' => ['UserProjects' => ['Users'], 'Organizations'],
                'order' => ['Projects.name' => 'ASC']
            ])->toArray();
            $projects = [];
            foreach ($projects_src as $project) {
                foreach($project['user_projects'] as $user_project){
                    if($user_project['user_id'] == $this->Authentication->getIdentity()->id){
                        array_push($projects, $project);
                        break;
                    }
                }
            }
            $this->set(compact('projects'));
        }
        $pagtitle = "Página";
        
        $this->set(compact('navname', 'pagtitle'));
    }

    public function isAuthorized($user = null) {
        dd($user);
        // $user = $this->loadModel('Users')->get($user['id']);
        // $autho = $this->loadModel('RoleSections')->find()->contain(['Sections'])->where(['role_id' => $user->role_id, 'Sections.classname' => $this->request->getParam('controller')])->first();
        // if (empty($autho)) return false;
        // switch ($this->request->getParam('action')) {
        //     case 'index':
        //     case 'view':
        //         if ($autho->permission != 1 && $autho->permission != 2) return false;
        //         break; 
        //     default:
        //         if ($autho->permission != 2) return false;
        //         break; 
        // }
        
        // $autho_list = $this->RoleSections->find()->contain(['Sections'])->where(['role_id' => $user->role_id])->toArray();
        // $_autho_list = [];
        // foreach ($autho_list as $autho) {
        //     $_autho_list[$autho->section->classname] = $autho;
        // }
        // $this->autho_list = $_autho_list;
        // $this->set(compact('_autho_list'));
        // return true;
    }
}
