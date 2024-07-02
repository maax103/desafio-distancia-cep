<?php

namespace App\Service;

use App\Dto\Coordinate;
use App\Entity\Distance;
use App\Interfaces\CoordinateServiceInterface;
use App\Interfaces\DistanceServiceInterface;
use App\Interfaces\DistanceRepositoryInterface;

class DistanceService implements DistanceServiceInterface
{
    private $distanceRepository;
    private $coordinateService;

    public function __construct(DistanceRepositoryInterface $distanceRepository, CoordinateServiceInterface $coordinateService)
    {
        $this->distanceRepository = $distanceRepository;
        $this->coordinateService = $coordinateService;
    }

    public function createDistance(string $cep1, string $cep2): Distance
    {
        $this->validateCreateDistance($cep1, $cep2);

        $distance = new Distance();
        $distance->setCep1($cep1);
        $distance->setCep2($cep2);
        $distance->setDistance($this->calculateDistance($cep1, $cep2));
        $distance->setDateCreated(new \DateTime());
        $distance->setDateModification(new \DateTime());

        $this->distanceRepository->save($distance);

        return $distance;
    }

    public function calculateDistance(string $cep1, string $cep2): ?float
    {

        $coordinates = $this->coordinateService->fetchCoordinates([$cep1, $cep2]);
        if(!($coordinates[0] && $coordinates[1])) return null;

        return $this->calculateWithHaversine($coordinates[0], $coordinates[1]);
    }

    protected function calculateWithHaversine(Coordinate $c1, Coordinate $c2): float
    {
        $lat1 = deg2rad($c1->getLatitude());
        $lon1 = deg2rad($c1->getLongitude());
        $lat2 = deg2rad($c2->getLatitude());
        $lon2 = deg2rad($c2->getLongitude());

        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;

        // Haversine
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * asin(sqrt($a));

        $earth_radius = 6371;

        $distance_km = $c * $earth_radius;

        return $distance_km;
    }

    protected function validateCreateDistance(string $cep1, string $cep2) : void
    {
        if (!($cep1 && $cep2)) {
            throw new \InvalidArgumentException();
        }
    }

    public function listDistances() : ?array
    {
        return $this->distanceRepository->listAll();
    }
}
