<?php

namespace App\Controller;

use App\Entity\Distance;
use App\Interfaces\DistanceServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    public function list(Request $request): JsonResponse
    {
        $distances = $this->distanceService->listDistances();
        return new JsonResponse(array_map(fn(Distance $distance) => $distance->toArray(), $distances));
    }

    public function importCsv(Request $request): Response
    {
        $file       = $request->files->get('file');
        $separator  = $request->get('separator', ';');

        if (!$file) {
            return new Response('No file uploaded', Response::HTTP_BAD_REQUEST);
        }

        if ($file->getClientOriginalExtension() !== 'csv') {
            return new Response('Invalid file type', Response::HTTP_BAD_REQUEST);
        }

        $amout = $this->distanceService->createDistancesFromCsv($file, $separator);
        return new Response($amout);
    }
}
