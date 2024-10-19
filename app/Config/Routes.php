<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'home::index');
$routes->get('home', 'home::index');
$routes->get('/signup', 'Signup::new', ['filter' => 'guest']);
$routes->get('/login','Login::new', ['filter' => 'guest']);
$routes->post('/login/create', 'Login::create');
$routes->get('Tasks', 'Tasks::index');
$routes->add('tasks/index.php', 'Tasks::index');
$routes->get('/migrate', 'Migrate::index');
$routes->get('tasks/show/(:num)', 'Tasks::show/$1');
$routes->get('tasks/new', 'Tasks::new');
$routes->get('/tasks/new', 'Tasks::new');      
$routes->post('/tasks/create', 'Tasks::create'); 
$routes->get('tasks/create', 'Tasks::create');
$routes->post('tasks/create', 'Tasks::create');
$routes->get('tasks', 'Tasks::index');
$routes->get('tasks/edit/(:num)', 'Tasks::edit/$1');
$routes->post('tasks/update/(:num)', 'Tasks::update/$1');
$routes->post('/tasks/delete/(:num)', 'Tasks::delete/$1');
$routes->get('signup/new', 'Signup::new');
$routes->post('signup/create', 'Signup::create');
$routes->get('signup/success', 'Signup::success');
$routes->get('/logout', 'Login::delete');
$routes->get('/logout', 'Login::logout');
$routes->get('showLogoutMessage', 'Login::showLogoutMessage');
$routes->get('/login/showLogoutMessage', 'Login::showLogoutMessage');
$routes->get('index', 'home::index'); 
$routes->get('tasks/index', 'Tasks::index');
$routes->get('admin/users', 'Admin\Users::index');
$routes->get('admin/users/show/(:num)', 'Admin\Users::show/$1');
$routes->group('admin', function($routes) {
    $routes->get('users', 'Admin\Users::index'); 
    $routes->get('users/show/(:num)', 'Admin\Users::show/$1'); 
    $routes->get('users/new', 'Admin\Users::new'); 
    $routes->post('users/create', 'Admin\Users::create'); 
});
$routes->get('admin/users/edit/(:num)', 'Admin\Users::edit/$1');
$routes->post('admin/users/update/(:num)', 'Admin\Users::update/$1');
$routes->post('admin/users/delete/(:num)', 'Admin\Users::delete/$1');
$routes->get('home/testemail', 'Home::testEmail');
$routes->get('signup/activate/(:any)', 'Signup::activate/$1');
$routes->get('password/forgot', 'Password::forgot');
$routes->post('password/processforgot', 'Password::processForgot');
$routes->get('password/resetsent', 'Password::resetsent');
$routes->get('password/reset/(:any)', 'Password::reset/$1');
$routes->post('password/processreset/(:any)', 'Password::processReset/$1');







