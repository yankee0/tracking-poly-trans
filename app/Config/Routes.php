<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Web::home');
$routes->get('tracking', 'Web::tracking');
$routes->group('api', function ($routes) {
  $routes->get('track/(:segment)', 'Api::track/$1');
});
