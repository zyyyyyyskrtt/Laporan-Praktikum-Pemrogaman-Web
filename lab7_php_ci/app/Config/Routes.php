<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
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
$routes->get('/', 'Home::index');

#$routes->resource('post');#

// Rute untuk membaca data (Bebas diakses agar tabel awal bisa tampil)
$routes->get('post', 'Post::index');
$routes->get('post/(:segment)', 'Post::show/$1');

// Mengamankan method POST, PUT, dan DELETE khusus untuk manipulasi data
$routes->post('post', 'Post::create', ['filter' => 'apiauth']);
$routes->put('post/(:segment)', 'Post::update/$1', ['filter' => 'apiauth']);
$routes->delete('post/(:segment)', 'Post::delete/$1', ['filter' => 'apiauth']);


$routes->match(['get', 'post'], '/user/login', 'User::login');

$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');

$routes->post('api/login', 'Api\Auth::login');

$routes->get('/artikel', 'Artikel::index');
// Routing untuk artikel detail (publik)
$routes->get('/artikel/(:any)', 'Artikel::view/$1');

$routes->get('/ajax', 'AjaxController::index');
$routes->get('/ajax/getData', 'AjaxController::getData');
$routes->delete('/ajax/delete/(:num)', 'AjaxController::delete/$1');

// Routing untuk menu admin
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('artikel', 'Artikel::admin_index');
    $routes->add('artikel/add', 'Artikel::add');
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1');
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}