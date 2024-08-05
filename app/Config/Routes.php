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

        $routes->group('products', static function ($routes) {
            $routes->get('/', 'Admin\Products\ProductsController::index');
            $routes->post('/', 'Admin\Products\ProductsController::create');
            $routes->get('(:num)', 'Admin\Products\ProductsController::edit/$1');
            $routes->post('(:num)', 'Admin\Products\ProductsController::saveChanges');
            
            $routes->group('remove', static function ($routes) {
                $routes->get('(:num)', 'Admin\Products\ProductsController::remove/$1');
                
                $routes->get('mainPhoto',  'Admin\Products\ProductsController::removeMainPhoto');
            });
        });

        $routes->group('news', static function ($routes) {
            $routes->get('/', 'Admin\News\NewsController::list');
            $routes->post('/', 'Admin\News\NewsController::create');
            $routes->get('(:num)', 'Admin\News\NewsController::edit/$1');
            $routes->post('(:num)', 'Admin\News\NewsController::saveChanges');
            $routes->get('remove/(:num)', 'Admin\News\NewsController::remove/$1');
        });

        $routes->group('contacts', static function ($routes) {
            $routes->get('/', 'Admin\Contacts\ContactsController::index');
            $routes->get('create-store', 'Admin\Contacts\ContactsController::createStore');
            $routes->post('create-phone', 'Admin\Contacts\ContactsController::createPhone');
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
    $routes->get('(:num)', 'Front\Products\ProductsController::details/$1');
});
$routes->group('news', static function ($routes) {
    $routes->get('/', 'Front\News\NewsController::list');
    $routes->get('(:num)', 'Front\News\NewsController::details/$1');
});
$routes->group('contacts', static function ($routes) {
    $routes->get('/', 'Front\Contacts\ContactsController::index');
});

