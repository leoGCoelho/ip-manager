<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

$routes->setRouteClass(Route::class);
//$routes->registerMiddleware('csrf', new CsrfProtectionMiddleware());

$routes->scope('/', function (RouteBuilder $builder) {
    //$builder->applyMiddleware('csrf');
    
    /*
        * Here, we are connecting '/' (base path) to a controller called 'Pages',
        * its action called 'display', and we pass a param to select the view file
        * to use (in this case, templates/Pages/home.php)...
        */
    $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
});

$routes->prefix('Admin', function (RouteBuilder $routes) {
    //$routes->applyMiddleware('csrf');
    
    $routes->connect('/', ['controller' => 'Dashboard', 'action' => 'index'], ['_name' => 'admin_index']);       //STATUS DA BASE LOCAL E DA BASE DA EASYCARROS
    $routes->connect('/login', ['controller' => 'Users', 'action' => 'login'], ['_name' => 'admin_users_login']);       //STATUS DA BASE LOCAL E DA BASE DA EASYCARROS
    $routes->connect('/logout', ['controller' => 'Users', 'action' => 'logout'], ['_name' => 'admin_users_logout']);       //STATUS DA BASE LOCAL E DA BASE DA EASYCARROS
    //$routes->connect('/makeuser/{password}', ['controller' => 'Users', 'action' => 'makeDefaultUser'], ['_name' => 'make_default_user'])->setPass(['password']);
    $routes->get('/users', ['controller' => 'Users', 'action' => 'index'], 'admin_users_index');
    $routes->connect('/users/unlock/{id}', ['controller' => 'Users', 'action' => 'unlock'], ['_name' => 'admin_users_unlock'])->setPass(['id']);
    $routes->connect('/user/{id}', ['controller' => 'Users', 'action' => 'edit'], ['_name' => 'admin_users_edit'])->setPass(['id']);
    $routes->connect('/user/delete/{id}', ['controller' => 'Users', 'action' => 'delete'], ['_name' => 'admin_users_delete'])->setPass(['id']);
    $routes->get('/roles', ['controller' => 'Roles', 'action' => 'index'], 'admin_roles_index');
    $routes->get('/activities', ['controller' => 'Activities', 'action' => 'index'], 'admin_activities_index');
    // $routes->connect('/roles', ['controller' => 'Roles', 'action' => 'index'], ['_name' => 'admin_roles_index']);

    $routes->get('/projects', ['controller' => 'Projects', 'action' => 'index'], 'admin_projects_index');
    $routes->connect('/projects/add/{organization_id}', ['controller' => 'Projects', 'action' => 'add'], ['_name' => 'admin_projects_add'])->setPass(['organization_id']);
    $routes->get('/projects/view/{id}', ['controller' => 'Projects', 'action' => 'view'], 'admin_projects_view')->setPass(['id']);
    $routes->connect('/projects/edit/{id}', ['controller' => 'Projects', 'action' => 'edit'], ['_name' => 'admin_projects_edit'])->setPass(['id']);
    $routes->connect('/projects/delete/{id}', ['controller' => 'Projects', 'action' => 'delete'], ['_name' => 'admin_projects_delete'])->setPass(['id']);
    $routes->get('/projects/confirm/{hash}', ['controller' => 'Projects', 'action' => 'confirm'],  'admin_projects_confirm')->setPass(['hash']);

    $routes->connect('/clients/add/{project_id}', ['controller' => 'Clients', 'action' => 'add'],  ['_name' => 'admin_clients_confirm'])->setPass(['project_id']);
    $routes->connect('/clients/delete/{id}/{project_id}', ['controller' => 'Clients', 'action' => 'delete'], ['_name' => 'admin_clients_delete'])->setPass(['id', 'project_id']);


});

$routes->prefix('Api', function (RouteBuilder $routes) {
    //$routes->applyMiddleware('csrf');
    
    $routes->connect('/', 'Api::index');                //STATUS DA BASE LOCAL E DA BASE DA EASYCARROS
    $routes->connect('/checkip', 'Api::checkip');       //VERIFICA IP DO PROJETO | $HASH
});

$routes->fallbacks();
