<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Customers
$routes->get('customers', 'CustomersController::index');
$routes->get('customers/create', 'CustomersController::create'); //Menarik form tambah
$routes->post('customers/insert', 'CustomersController::insert'); //Mengirim data ke database
$routes->get('customers/edit/(:num)', 'CustomersController::edit/$1'); //Menarik form ubah
$routes->post('customers/update/(:num)', 'CustomersController::update/$1'); //Mengirim data update ke database
$routes->get('customers/delete/(:segment)', 'CustomersController::delete/$1'); //menghapus data

// Drivers
$routes->get('drivers', 'DriversController::index');
$routes->get('drivers/create', 'DriversController::create'); //Menarik form tambah
$routes->post('drivers/insert', 'DriversController::insert'); //Mengirim data ke database
$routes->get('drivers/edit/(:num)', 'DriversController::edit/$1'); //Menarik form ubah
$routes->post('drivers/update/(:num)', 'DriversController::update/$1'); //Mengirim data update ke database
$routes->Get('drivers/delete/(:segment)', 'DriversController::delete/$1'); //menghapus data

// Restaurants
$routes->get('restaurants', 'RestaurantsController::index');
$routes->get('restaurants/create', 'RestaurantsController::create'); //Menarik form tambah
$routes->post('restaurants/insert', 'RestaurantsController::insert'); //Mengirim data ke database
$routes->get('restaurants/edit/(:num)', 'RestaurantsController::edit/$1'); //Menarik form ubah
$routes->post('restaurants/update/(:num)', 'RestaurantsController::update/$1'); //Mengirim data update ke database
$routes->Get('restaurants/delete/(:segment)', 'RestaurantsController::delete/$1'); //menghapus data

// Menus
$routes->get('menus', 'MenusController::index');
$routes->get('menus/create', 'MenusController::create'); //Menarik form tambah
$routes->post('menus/insert', 'MenusController::insert'); //Mengirim data ke database
$routes->get('menus/edit/(:num)', 'MenusController::edit/$1'); //Menarik form ubah
$routes->post('menus/update/(:num)', 'MenusController::update/$1'); //Mengirim data update ke database
$routes->Get('menus/delete/(:segment)', 'MenusController::delete/$1'); //menghapus data

