<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('dashboard', 'Dashboard::index');
$routes->addRedirect('/', 'dashboard');

$routes->get('category', 'Category::index');
$routes->match(['get', 'post'], 'category/create', 'Category::create');
$routes->match(['get', 'post'], 'category/update/(:any)', 'Category::update/$1');
$routes->get('category/delete/(:any)', 'Category::delete/$1');
$routes->addRedirect('category/update', 'category');

$routes->get('product', 'Product::index');
$routes->match(['get', 'post'], 'product/create', 'Product::create');
$routes->match(['get', 'post'], 'product/update/(:any)', 'Product::update/$1');
$routes->get('product/delete/(:any)', 'Product::delete/$1');
$routes->addRedirect('product/update', 'product');

$routes->get('/sse', 'Sse::index');
$routes->get('/stream', 'Sse::stream');

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes)
{
	$routes->group('profil', function($routes)
	{
		$routes->add('users', 'Profil::index');
		$routes->get('users/(:num)', 'Profil::show/$1');
		$routes->put('users/(:num)', 'Profil::update/$1');
	});
});

/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
