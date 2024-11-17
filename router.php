<?php

require_once 'libs/router.php';
require_once 'api/controllers/siniestro.api.controller.php';

$router = new Router();

$router->addRoute('siniestros', 'GET', 'SiniestroApiController', 'getListSiniestros');
$router->addRoute('siniestros/:id', 'GET', 'SiniestroApiController', 'getSiniestroId');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);