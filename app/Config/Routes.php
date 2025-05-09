<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Pokemon;
use App\Controllers\Pages;
use App\Controllers\Ajax;
use App\Controllers\Assets;

$routes->get('/', 'Home::index');
$routes->get('pokemon', [Pokemon::class, 'index']);
$routes->get('pokemon/new', [Pokemon::class, 'new']);
$routes->post('pokemon', [Pokemon::class, 'create']);
$routes->get('pokemon/search', [Pokemon::class, 'search']);
$routes->get('assets/images/(:any)', [Assets::class, 'images']);
$routes->get('pokemon/(:segment)', [Pokemon::class, 'show']);

$routes->get('ajax/get/(:segment)', [Ajax::class, 'get']);
$routes->get('ajax/suggest/(:any)', [Ajax::class, 'suggest']);
$routes->get('store_locations', [Pages::class, 'storeLocations']);

$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);