<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'TaskController::index');

$routes->group('tasks', static function ($routes) {
    $routes->get('index', 'TaskController::index');

    $routes->get('create', 'TaskController::create');
    $routes->post('store', 'TaskController::store');

    $routes->get('edit/(:num)', 'TaskController::edit/$1');
    $routes->post('update/(:num)', 'TaskController::update/$1');

    $routes->post('destroy/(:num)', 'TaskController::destroy/$1');
});

$routes->group('tasksAPI', static function ($routes) {
    $routes->get('index', 'TaskAPIController::index');
    $routes->get('(:num)', 'TaskAPIController::show/$1');

    $routes->post('store', 'TaskAPIController::store');
    $routes->put('update/(:num)', 'TaskAPIController::update/$1');

    $routes->delete('destroy/(:num)', 'TaskAPIController::destroy/$1');
});