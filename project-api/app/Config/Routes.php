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

$routes->group("branchimages", function($routes) {
    $routes->post("create", "BranchImages::create");
    $routes->post("update/(:num)", "BranchImages::update/$1");
    $routes->delete("delete/(:num)", "BranchImages::delete/$1");
    $routes->get("index", "BranchImages::index", ['filter' => 'authFilter']);
});