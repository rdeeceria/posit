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

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
	$routes->group('categories', function($routes) {
			$routes->get('', 'categories::index');
			$routes->get('(:any)', 'categories::show/$1');
			$routes->post('create', 'categories::create');
			$routes->put('(:any)', 'categories::update/$1');
			$routes->delete('(:any)', 'categories::delete/$1');
	});

	$routes->group('products', function($routes) {
		$routes->get('', 'products::index');
		$routes->get('(:any)', 'products::show/$1');
		$routes->post('create', 'products::create');
		$routes->put('(:any)', 'products::update/$1');
		$routes->delete('(:any)', 'products::delete/$1');
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
