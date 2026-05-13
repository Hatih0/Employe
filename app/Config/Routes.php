<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'EmployeController::login');
$routes->post('/authenticate', 'EmployeController::authenticate');
$routes->get('/index.php/dashboard', 'DashboardEmployeController::dashboard');
$routes->get('/demanderConge', 'CongeController::index');
$routes->post('/envoyerDemande', 'CongeController::envoyerDemande');
$routes->get('/MesDemandes', 'DashboardEmployeController::MesDemandes');
$routes->get('/supprimerDemande/(:num)', 'CongeController::supprimerDemande/$1');