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
    $routes->post("create", "Services::create");
    $routes->post("update/(:num)", "Services::update/$1");
    $routes->delete("delete/(:num)", "Services::delete/$1");
    $routes->get("index", "Services::index", ['filter' => 'authFilter']);
});

$routes->group("branch_office", function($routes) {
    $routes->post("create", "Branch::create");
    $routes->post("update/(:num)", "Branch::update/$1");
    $routes->delete("delete/(:num)", "Branch::delete/$1");
    $routes->get("index", "Branch::index", ['filter' => 'authFilter']);
});

$routes->group("servicesimages", function($routes) {
    $routes->post("create", "ServicesImages::create");
    $routes->post("update/(:num)", "ServicesImages::update/$1");
    $routes->delete("delete/(:num)", "ServicesImages::delete/$1");
    $routes->get("index", "ServicesImages::index", ['filter' => 'authFilter']);
});