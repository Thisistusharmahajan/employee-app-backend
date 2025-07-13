<?php

use App\Controllers\EmployeeController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->get('employees','EmployeeController::index');
$routes->post('employees','EmployeeController::store');
$routes->post('employees/update/(:num)','EmployeeController::update/$1');
$routes->delete('employees/delete/(:num)','EmployeeController::delete/$1');
$routes->get('employees/getById/(:num)','EmployeeController::getById/$1');
$routes->get('employees/getAll','EmployeeController::getAll/');