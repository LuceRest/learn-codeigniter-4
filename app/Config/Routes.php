<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Pages::index');

$routes->get('/coba', function() {
    echo "Hello World!";
});

$routes->get('/coba/about/(:any)/(:num)', 'Coba::about/$1/$2');      # :any -> mengambil apapun nilai yang ada di url | $1 -> akan mengambil placeholder di paramater url

$routes->get('/users', 'Admin\Users::index');

$routes->get('/home', 'Pages::index');
$routes->get('/about', 'Pages::about');
$routes->get('/contact', 'Pages::contact');

$routes->get('/comics', 'Comics::index');
$routes->get('/comics/create', 'Comics::create');
// $routes->get('/comics/change', 'Comics::change');
$routes->post('/comics/save', 'Comics::save');

// $routes->get('/comics/delete/(:num)', 'Comics::delete/$1');
$routes->delete('/comics/(:num)', 'Comics::delete/$1');

$routes->get('/comics/edit/(:segment)', 'Comics::edit/$1');
$routes->post('/comics/update/(:segment)', 'Comics::update/$1');

$routes->get('/comics/(:segment)', 'Comics::detail/$1');


$routes->get('/orang', 'Orang::index');
