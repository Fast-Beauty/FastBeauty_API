<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group("api", function ($routes) {
    $routes->post("register", "Register::index");
    $routes->post("login", "Login::index");
    $routes->get("users", "UserApi::index", ['filter' => 'authFilter']);
});

$routes->group("services", function ($routes) {
    $routes->post("create", "Services::create", ['filter' => 'authFilter']);
    $routes->post("update/(:num)", "Services::update/$1", ['filter' => 'authFilter']);
    $routes->delete("delete/(:num)", "Services::delete/$1", ['filter' => 'authFilter']);
    $routes->get("index", "Services::index");
});

$routes->group("branchimages", function ($routes) {
    $routes->post("create", "BranchImages::create", ['filter' => 'authFilter']);
    $routes->post("update/(:num)", "BranchImages::update/$1", ['filter' => 'authFilter']);
    $routes->delete("delete/(:num)", "BranchImages::delete/$1", ['filter' => 'authFilter']);
    $routes->get("index", "BranchImages::index");
});

$routes->group("branch_office", function ($routes) {
    $routes->post("create", "Branch::create", ['filter' => 'authFilter']);
    $routes->post("update/(:num)", "Branch::update/$1", ['filter' => 'authFilter']);
    $routes->delete("delete/(:num)", "Branch::delete/$1", ['filter' => 'authFilter']);
    $routes->get("index", "Branch::index");
});

$routes->group("servicesimages", function ($routes) {
    $routes->post("create", "ServicesImages::create", ['filter' => 'authFilter']);
    $routes->post("update/(:num)", "ServicesImages::update/$1", ['filter' => 'authFilter']);
    $routes->delete("delete/(:num)", "ServicesImages::delete/$1", ['filter' => 'authFilter']);
    $routes->get("index", "ServicesImages::index");
});

$routes->group("appointments", function ($routes) {
    $routes->post("create", "Appointments::create");
    $routes->post("update/(:num)", "Appointments::update/$1", ['filter' => 'authFilter']);
    $routes->delete("delete/(:num)", "Appointments::delete/$1", ['filter' => 'authFilter']);
    $routes->get("index", "Appointments::index");
});
