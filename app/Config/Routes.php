<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'EmployeController::login');
$routes->post('/authenticate', 'EmployeController::authenticate');
$routes->get('/index.php/dashboard', 'DashboardEmployeController::dashboard');
