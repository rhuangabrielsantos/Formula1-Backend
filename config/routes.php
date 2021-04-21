<?php

use Api\Controllers\AliveController;
use Api\Controllers\CarController;
use Api\Controllers\UserController;
use Api\Router\Router;

$router = new Router();

$router->get('/', AliveController::class, 'index');
$router->resource('/users', UserController::class);
$router->resource('/cars', CarController::class);

echo $router->handleRequest();
