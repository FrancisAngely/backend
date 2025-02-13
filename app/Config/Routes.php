<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

$routes->get('class', 'Classes::index');
$routes->post('class', 'Classes::store');
$routes->get('class/(:num)', 'Classes::show/$1');
$routes->put('class/(:num)', 'Classes::update/$1');
$routes->delete('class/(:num)', 'Classes::destroy/$1');

$routes->get('students', 'Students::index');
$routes->post('students', 'Students::store');
$routes->get('students/(:num)', 'Students::show/$1');
$routes->put('students/(:num)', 'Students::update/$1');
$routes->delete('students/(:num)', 'Students::destroy/$1');


$routes->get('usuarios', 'Usuarios::index');
$routes->post('usuarios', 'Usuarios::store');
$routes->get('usuarios/(:num)', 'Usuarios::show/$1');
$routes->put('usuarios/(:num)', 'Usuarios::update/$1');
$routes->delete('usuarios/(:num)', 'Usuarios::destroy/$1');
$routes->get('usuarios/datatable', 'Usuarios::datatable');


$routes->get('heroes', 'Heroes::index');
$routes->post('heroes', 'Heroes::store');
$routes->get('heroes/(:num)', 'Heroes::show/$1');
$routes->put('heroes/(:num)', 'Heroes::update/$1');
$routes->delete('heroes/(:num)', 'Heroes::destroy/$1');


$routes->get('localidades', 'Localidades::index');
$routes->post('localidades', 'Localidades::store');
$routes->get('localidades/(:num)', 'Localidades::show/$1');
$routes->put('localidades/(:num)', 'Localidades::update/$1');
$routes->delete('localidades/(:num)', 'Localidades::destroy/$1');



$routes->get('roles', 'Roles::index');
$routes->post('roles', 'Roles::store');
$routes->get('roles/(:num)', 'Roles::show/$1');
$routes->put('roles/(:num)', 'Roles::update/$1');
$routes->delete('roles/(:num)', 'Roles::destroy/$1');


$routes->get('clientes', 'Clientes::index');
$routes->post('clientes', 'Clientes::store');
$routes->get('clientes/(:num)', 'Clientes::show/$1');
$routes->put('clientes/(:num)', 'Clientes::update/$1');
$routes->delete('clientes/(:num)', 'Clientes::destroy/$1');

$routes->get('contactos', 'Contactos::index');
$routes->post('contactos', 'Contactos::store');
$routes->get('contactos/(:num)', 'Contactos::show/$1');
$routes->put('contactos/(:num)', 'Contactos::update/$1');
$routes->delete('contactos/(:num)', 'Contactos::destroy/$1');