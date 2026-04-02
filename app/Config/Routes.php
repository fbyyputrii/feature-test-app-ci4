<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//auth
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attemptLogin');
$routes->get('/logout', 'Auth::logout');

$routes->get('/dashboard', 'Dashboard::index');

//pegawai
$routes->get('/pegawai', 'Pegawai::index');
$routes->get('/pegawai/create', 'Pegawai::create');
$routes->post('/pegawai/store', 'Pegawai::store');
$routes->get('/pegawai/edit/(:num)', 'Pegawai::edit/$1');
$routes->post('/pegawai/update/(:num)', 'Pegawai::update/$1');
$routes->post('/pegawai/delete/(:num)', 'Pegawai::delete/$1');
$routes->get('/pegawai/detail/(:num)', 'Pegawai::detail/$1');

//tunjangan
$routes->get('/tunjangan', 'Tunjangan::index');
$routes->get('/tunjangan/create', 'Tunjangan::create');
$routes->post('/tunjangan/store', 'Tunjangan::store');

//logs
$routes->get('/logs', 'Dashboard::logs');

//users
$routes->get('/users', 'UserController::index');
$routes->get('/users/create', 'UserController::create');
$routes->post('/users/store', 'UserController::store');
$routes->get('/users/edit/(:num)', 'UserController::edit/$1');
$routes->post('/users/update/(:num)', 'UserController::update/$1');
$routes->get('/users/delete/(:num)', 'UserController::delete/$1');

//roles
$routes->get('/roles', 'RoleController::index');
$routes->get('/roles/create', 'RoleController::create');
$routes->post('/roles/store', 'RoleController::store');
$routes->get('/roles/edit/(:num)', 'RoleController::edit/$1');
$routes->post('/roles/update/(:num)', 'RoleController::update/$1');
$routes->get('/roles/delete/(:num)', 'RoleController::delete/$1');

//setting tunjangan
$routes->get('/setting', 'Setting::index');
$routes->post('/setting/update', 'Setting::update');

//api
$routes->group('api', function($routes) {
    $routes->resource('pegawai', [
        'controller' => 'Api\PegawaiApi'
    ]);
});