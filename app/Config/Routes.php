<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Web Routes (Traditional Views)
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

// API Routes
$routes->group('api', static function($routes) {
    // Products API
    $routes->get('products', 'Home::apiGetProducts');
    $routes->get('products/category/(:segment)', 'Home::apiGetProductsByCategory/$1');
    $routes->get('products/(:num)', 'Home::apiGetProduct/$1');
    
    // Admin API
    $routes->post('admin/login', 'Admin::apiLogin');
    $routes->post('admin/logout', 'Admin::apiLogout');
    $routes->post('admin/products', 'Admin::apiAddProduct');
    $routes->delete('admin/products/(:num)/(:num)', 'Admin::apiDeleteProduct/$1/$2');
});

