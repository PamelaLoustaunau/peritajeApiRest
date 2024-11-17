<?php

require_once 'libs/router.php';
require_once 'api/controllers/siniestro.api.controller.php';

$router = new Router();

$router->addRoute('siniestros', 'GET', 'SiniestroApiController', 'getListSiniestros');
$router->addRoute('siniestros/:id', 'GET', 'SiniestroApiController', 'getSiniestroId');
$router->addRoute('siniestros', 'POST', 'SiniestroApiController', 'addSiniestro');
$router->addRoute('siniestros/:id', 'DELETE', 'SiniestroApiController', 'deleteSiniestro');
$router->addRoute('siniestros/:id', 'PUT', 'SiniestroApiController', 'modifySiniestro');


$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);