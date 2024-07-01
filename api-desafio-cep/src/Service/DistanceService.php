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

    public function calculateDistance(string $cep1, string $cep2): float
    {
        return $cep1 > $cep2 ? 1000 : 2000;
    }

    protected function validateCreateDistance(string $cep1, string $cep2) : void
    {
        if (!($cep1 && $cep2)) {
            throw new \InvalidArgumentException();
        }
    }
}
