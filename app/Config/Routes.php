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

$routes->get('alumnos', 'Alumnos::index');
$routes->post('alumnos', 'Alumnos::store');
$routes->get('alumnos/(:num)', 'Alumnos::show/$1');
$routes->put('alumnos/(:num)', 'Alumnos::update/$1');
$routes->delete('alumnos/(:num)', 'Alumnos::destroy/$1');

$routes->get('notas', 'Notas::index');
$routes->post('notas', 'Notas::store');
$routes->get('notas/(:num)', 'Notas::show/$1');
$routes->put('notas/(:num)', 'Notas::update/$1');
$routes->delete('notas/(:num)', 'Notas::destroy/$1');

$routes->get('modulo', 'Modulo::index');
$routes->post('modulo', 'Modulo::store');
$routes->get('modulo/(:num)', 'Modulo::show/$1');
$routes->put('modulo/(:num)', 'Modulo::update/$1');
$routes->delete('modulo/(:num)', 'Modulo::destroy/$1');


$routes->get('usuarios', 'Usuarios::index');
$routes->post('usuarios', 'Usuarios::store');
$routes->get('usuarios/(:num)', 'Usuarios::show/$1');
$routes->put('usuarios/(:num)', 'Usuarios::update/$1');
$routes->delete('usuarios/(:num)', 'Usuarios::destroy/$1');
$routes->get('usuarios/datatable', 'Usuarios::datatable');
$routes->post('usuarios/login', 'Usuarios::login');

$routes->get('roles', 'Roles::index');
$routes->post('roles', 'Roles::store');
$routes->get('roles/(:num)', 'Roles::show/$1');
$routes->put('roles/(:num)', 'Roles::update/$1');
$routes->delete('roles/(:num)', 'Roles::destroy/$1');
