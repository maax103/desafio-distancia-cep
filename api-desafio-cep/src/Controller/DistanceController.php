<?php

namespace App\Controller;

use App\Interfaces\DistanceServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DistanceController extends AbstractController
{
    private $distanceService;

    public function __construct(DistanceServiceInterface $distanceService)
    {
        $this->distanceService = $distanceService;
    }

    public function create(Request $request): JsonResponse
    {
        
        $cep1 = $request->get('cep1');
        $cep2 = $request->get('cep2');
        $distance = $this->distanceService->createDistance($cep1, $cep2);

        return new JsonResponse([
            'id' => $distance->getId(),
            'cep1' => $distance->getCep1(),
            'cep2' => $distance->getCep2(),
            'distance' => $distance->getDistance(),
            'date_created' => $distance->getDateCreated()->format('Y-m-d H:i:s'),
            'date_modification' => $distance->getDateModification()->format('Y-m-d H:i:s'),
        ]);
    }
}
