<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/vetements', 'Home::vetement');
$routes->get('/homme', 'Home::homme');
$routes->get('/chaussures', 'Home::chaussures');
$routes->get('/jalabe', 'Home::jalabe');
$routes->get('/parfum', 'Home::parfum');
$routes->match(['GET', 'POST'], '/admin', 'Admin::login');


$routes->match(['POST'], 'login', 'Admin::login');
$routes->get('logout', 'Admin::logout');
$routes->match(['POST'], 'admin/products/add', 'Admin::addProduct');
$routes->match(['POST'], 'admin/products/delete/(:segment)/(:segment)', 'Admin::deleteProduct/$1/$2');
$routes->get('dashboard', 'Dashboard::index');
