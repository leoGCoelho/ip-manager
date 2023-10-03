<?php
declare(strict_types=1);

namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class RolesController extends AppController
{
    public function index()
    {
        $roles = $this->paginate($this->Roles);
        $title = 'Cargos';
        $this->set(compact('roles', 'title'));
    }
    
    public function add()
    {
        $role = $this->Roles->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $hasTitle = $this->Roles->find()->where(['title' => $data['title']])->isEmpty();
            if ($hasTitle) {
                $role = $this->Roles->patchEntity($role, $data);
                if ($this->Roles->save($role)) {
                    $this->reportActivities($role, 1);
                    $this->loadModel('RoleSections');
                    foreach ($data['Sections'] as $k=>$section) {
                        $inputdata = [];
                        $inputdata['role_id'] = $role->id;
                        $inputdata['section_id'] = $k;
                        $inputdata['permission'] = 0;
                        if ($section['r']) $inputdata['permission'] = 1;
                        if ($section['w']) $inputdata['permission'] = 2;
                        $role_section = $this->RoleSections->newEntity($inputdata);
                        $this->RoleSections->save($role_section);
                    }
                    $this->Flash->success(__('The role has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $sections = $this->loadModel('Sections')->find()->contain(['Paginas']);
        $title = 'Cargos';
        $this->set(compact('role', 'sections', 'title'));
        $this->render('edit');
    }
    
    public function edit($id = null)
    {
        $role = $this->Roles->get($id, ['contain' => ['RoleSections']]);
        $arrsection = [];
        foreach ($role->sections as $section) {
            $arrsection[$section->section_id] = $section;
        }
        $role->sections = $arrsection;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $hasTitle = $this->Roles->find()->where(['title' => $data['title'], 'id !=' => $id])->isEmpty();
            if ($hasTitle) {
                $role = $this->Roles->patchEntity($role, $data);
                $this->reportActivities($role, 2);
                if ($this->Roles->save($role)) {
                    $this->loadModel('RoleSections');
                    foreach ($data['Sections'] as $k=>$section) {
                        $inputdata = [];
                        $inputdata['role_id'] = $role->id;
                        $inputdata['section_id'] = $k;
                        $inputdata['permission'] = 0;
                        if ($section['r']) $inputdata['permission'] = 1;
                        if ($section['w']) $inputdata['permission'] = 2;
                        $old = $this->RoleSections->find()->where(['role_id' => $role->id, 'section_id' => $k])->first();
                        if (!empty($old)) {
                            $role_section = $this->RoleSections->patchEntity($old, $inputdata);
                        } else {
                            $role_section = $this->RoleSections->newEntity($inputdata);
                        }
                        if ($this->RoleSections->save($role_section)) {
                            
                        }
                    }
                    $this->Flash->success(__('The role has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $sections = $this->loadModel('Sections')->find()->contain(['Paginas']);
        $title = 'Cargos';
        $this->set(compact('role', 'sections', 'title'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id, ['contain' => ['RoleSections']]);
        $role_id = $role->id;
        $this->reportActivities($role, 3);
        if ($this->Roles->delete($role)) {
            $this->RoleSections->deleteAll(['role_id' => $role_id]);
            $this->Flash->success(__('The role has been deleted.'));
        } else {
            $this->Flash->error(__('The role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
