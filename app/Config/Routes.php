<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('admin', static function ($routes) {
    $routes->get('/', 'Admin\Home\HomeController::index');

    $routes->get('login', 'Admin\Login\LoginController::index');
});

$routes->get('/', 'Front\Home\Home::index');
$routes->group('products', static function ($routes) {
    $routes->get('/', 'Front\Products\ProductsController::list');
});
$routes->group('news', static function ($routes) {
    $routes->get('/', 'Front\News\NewsController::list');
});
$routes->group('contacts', static function ($routes) {
    $routes->get('/', 'Front\Contacts\ContactsController::index');
});

