<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use App\Controller\DistanceController;

$routes = new RouteCollection();

$routes->add('create', 
    new Route('/api/distance/create',
    ['_controller' => [DistanceController::class, 'create'],
]));

$routes->add('list', 
    new Route('/api/distance/list',
    ['_controller' => [DistanceController::class, 'list'],
]));

return $routes;
