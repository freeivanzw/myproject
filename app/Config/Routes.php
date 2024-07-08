<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('admin', static function ($routes) {
    $routes->group('/', ['filter' => 'adminAuth'], static function ($routes) {
        $routes->get('/', 'Admin\Home\HomeController::index');

        $routes->group('auth', static function ($routes) {
            $routes->get('logout', 'Admin\Auth\AuthController::logout');
            $routes->post('register', 'Admin\Auth\AuthController::register');
        });
    });

    $routes->group('auth', static function ($routes) {
        $routes->get('login', 'Admin\Auth\AuthController::login');
        $routes->post('login', 'Admin\Auth\AuthController::enter');
    });
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

