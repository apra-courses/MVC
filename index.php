<?php

chdir(dirname(__DIR__));
require_once __DIR__ . '/app/controllers/PostController.php';
require_once __DIR__ . '/DB/DbFactory.php';
require_once __DIR__ . '/helpers/function.php';
require_once __DIR__ . '/helpers/function.php';
require_once __DIR__ . '/core/Router.php';

$data = require __DIR__ . '/config/database.php';
$appConfig = require '/config/app.config.php';

try {
    $pdoConn = App\DB\DbFactory::create($data);
    $router = new Router($pdoConn->getConn());
    $router->loadRoutes($appConfig['routes']);
    $controller = $router->dispatch();
    $controller->display();
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

