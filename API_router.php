<?php
require_once './libs/router/router.php';

require_once './libs/jwt/jwt.middleware.php';

require_once './app/middlewares/guard-api.middleware.php';
require_once './app/controllers/jugadoresAPIController.php';
require_once './app/controllers/auth-api.controller.php';

// instancio el router
$router = new Router();

$router->addMiddleware(new JWTMiddleware());

// defino los endpoints
$router->addRoute('auth/login',     'GET',     'AuthApiController',    'login');

$router->addRoute('jugadores',         'GET',      'jugadoresAPIController',    'getJugadores');
$router->addRoute('jugadores/:id',     'GET',      'jugadoresAPIController',    'getJugador');

$router->addMiddleware(new GuardMiddleware());

$router->addRoute('jugadores/:id',     'DELETE',   'jugadoresAPIController',    'deleteJugador');
$router->addRoute('jugadores',         'POST',     'jugadoresAPIController',    'insertJugador');
$router->addRoute('jugadores/:id',     'PUT',      'jugadoresAPIController',    'updateJugador');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
