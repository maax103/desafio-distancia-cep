<?php

namespace App\Service;

use App\Entity\Distance;
use App\Interfaces\DistanceServiceInterface;
use App\Interfaces\DistanceRepositoryInterface;

class DistanceService implements DistanceServiceInterface
{
    private $distanceRepository;

    public function __construct(DistanceRepositoryInterface $distanceRepository)
    {
        $this->distanceRepository = $distanceRepository;
    }

    public function createDistance(string $cep1, string $cep2): Distance
    {
        $distance = new Distance();
        $distance->setCep1($cep1);
        $distance->setCep2($cep2);
        $distance->setDistance(1000);
        $distance->setDateCreated(new \DateTime());
        $distance->setDateModification(new \DateTime());

        $this->distanceRepository->save($distance);

        return $distance;
    }
}
