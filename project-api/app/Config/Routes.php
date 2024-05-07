<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group("api", function($routes) {
    $routes->post("register", "Register::index");
    $routes->post("login", "Login::index");
    $routes->get("users", "UserApi::index", ['filter' => 'authFilter']);
});

$routes->group("services", function($routes) {
    $routes->get("index", "Services::index", ['filter' => 'authFilter']);
});

$routes->group("servicesimages", function($routes) {

    $routes->get("index", "ServicesImages::index", ['filter' => 'authFilter']);
});