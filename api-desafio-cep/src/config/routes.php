<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use App\Controller\DistanceController;

$routes = new RouteCollection();

$routes->add('create', new Route('/api/distance', [
    '_controller' => [DistanceController::class, 'create'],
]));

return $routes;
