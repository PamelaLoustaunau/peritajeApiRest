<?php

require_once 'libs/router.php';
require_once 'api/controllers/siniestro.api.controller.php';
require_once 'api/controllers/user.api.controller.php';
require_once 'api/middlewares/jwt.auth.middleware.php';


$router = new Router();
$router->addMiddleware(new JWTAuthMiddleware());

$router->addRoute('siniestros', 'GET', 'SiniestroApiController', 'getListSiniestros');
$router->addRoute('siniestros/:id', 'GET', 'SiniestroApiController', 'getSiniestroId');
$router->addRoute('siniestros', 'POST', 'SiniestroApiController', 'addSiniestro');
$router->addRoute('siniestros/:id', 'DELETE', 'SiniestroApiController', 'deleteSiniestro');
$router->addRoute('siniestros/:id', 'PUT', 'SiniestroApiController', 'modifySiniestro');

$router->addRoute('login', 'GET', 'UserApiController', 'getToken');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);