<?php

use Api\Controllers\AliveController;
use Api\Controllers\UserController;
use Api\Router\Router;

$router = new Router();

$router->get('/', AliveController::class, 'index');
$router->resource('/user', UserController::class);

echo $router->handleRequest();
