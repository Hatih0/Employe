<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'EmployeController::login');
$routes->post('/authenticate', 'EmployeController::authenticate');
$routes->get('/index.php/dashboard', 'DashboardEmployeController::dashboard');
$routes->get('/dashboard', 'DashboardEmployeController::dashboard');
$routes->get('/profil', 'ProfilController::index');
$routes->post('/profil/modifier', 'ProfilController::modifier');
$routes->get('/demanderConge', 'CongeController::index');
$routes->post('/envoyerDemande', 'CongeController::envoyerDemande');
$routes->get('/MesDemandes', 'DashboardEmployeController::MesDemandes');
$routes->get('/supprimerDemande/(:num)', 'CongeController::supprimerDemande/$1');