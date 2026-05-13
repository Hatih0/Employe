<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ========== ROUTES AUTHENTIFICATION ==========
$routes->get('/', 'EmployeController::login');
$routes->post('/authenticate', 'EmployeController::authenticate');

// ========== ROUTES DASHBOARD ==========
$routes->get('/dashboard', 'DashboardEmployeController::dashboard');

// ========== ROUTES DEPARTEMENTS (CRUD) ==========
$routes->get('/departements', 'Departements::index');
$routes->get('/departements/create', 'Departements::create');
$routes->post('/departements/store', 'Departements::store');
$routes->get('/departements/json', 'Departements::json');
$routes->get('/departements/(:num)', 'Departements::show/$1');
$routes->get('/departements/(:num)/edit', 'Departements::edit/$1');
$routes->post('/departements/(:num)/update', 'Departements::update/$1');
$routes->post('/departements/(:num)/delete', 'Departements::delete/$1');

// ========== ROUTES EMPLOYES (CRUD) ==========
$routes->get('/employes', 'Employes::index');
$routes->get('/employes/create', 'Employes::create');
$routes->post('/employes/store', 'Employes::store');
$routes->get('/employes/json', 'Employes::json');
$routes->get('/employes/(:num)', 'Employes::show/$1');
$routes->get('/employes/(:num)/edit', 'Employes::edit/$1');
$routes->post('/employes/(:num)/update', 'Employes::update/$1');
$routes->post('/employes/(:num)/delete', 'Employes::delete/$1');

// ========== ROUTES TYPES DE CONGES (CRUD) ==========
$routes->get('/types-conges', 'TypeConges::index');
$routes->get('/types-conges/create', 'TypeConges::create');
$routes->post('/types-conges/store', 'TypeConges::store');
$routes->get('/types-conges/json', 'TypeConges::json');
$routes->get('/types-conges/(:num)', 'TypeConges::show/$1');
$routes->get('/types-conges/(:num)/edit', 'TypeConges::edit/$1');
$routes->post('/types-conges/(:num)/update', 'TypeConges::update/$1');
$routes->post('/types-conges/(:num)/delete', 'TypeConges::delete/$1');

// ========== ROUTES CONGES (GESTION) ==========
$routes->get('/conges', 'Conges::index');
$routes->get('/conges/create', 'Conges::create');
$routes->post('/conges/store', 'Conges::store');
$routes->get('/conges/json', 'Conges::json');
$routes->get('/conges/en-attente', 'Conges::demandesEnAttente');
$routes->get('/conges/par-statut/(:segment)', 'Conges::parStatut/$1');
$routes->get('/conges/par-departement/(:num)', 'Conges::parDepartement/$1');
$routes->get('/conges/soldes', 'Conges::soldes');
$routes->get('/conges/solde/(:num)', 'Conges::solde/$1');
$routes->post('/conges/(:num)/approuver', 'Conges::approuver/$1');
$routes->post('/conges/(:num)/refuser', 'Conges::refuser/$1');
$routes->get('/conges/(:num)', 'Conges::show/$1');
