<?php

use Api\Controllers\AliveController;
use Api\Controllers\CarController;
use Api\Controllers\RaceController;
use Api\Controllers\UserController;
use Api\Router\Router;

$router = new Router();

$router->get('/', AliveController::class, 'index');
$router->get('/cars/hashCar', CarController::class, 'findByHashCar');

$router->post('/startRace', RaceController::class, 'startRace');

$router->put('/updatePositions', CarController::class, 'updatePositions');
$router->put('/defineAllPositions', CarController::class, 'defineAllPositions');

$router->put('/acceptRace', CarController::class, 'acceptRace');
$router->put('/refuseRace', CarController::class, 'refuseRace');
$router->put('/cars/number', CarController::class, 'updateNumber');

$router->resource('/users', UserController::class);

$router->resource('/cars', CarController::class);

echo $router->handleRequest();
