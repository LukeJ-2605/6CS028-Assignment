<?php


use CodeIgniter\Router\RouteCollection;
use App\Controllers\Home;
use App\Controllers\Pages;
use App\Controllers\PokemonController;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('pokemon', [PokemonController::class, 'index']);          
$routes->get('pokemon/view/(:any)', [PokemonController::class, 'show']);
$routes->get('(:segment)', [Pages::class, 'view']);
