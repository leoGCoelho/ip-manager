<?php
declare(strict_types=1);

namespace App\Controller\Admin;
use App\Controller\AppController;

/**
 * Dashboard Controller
 *
 * @method \App\Model\Entity\Dashboard[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $dashboard = null;
        $pagtitle = "Página Inicial";
        $this->set(compact('dashboard', 'pagtitle'));
    }
}
