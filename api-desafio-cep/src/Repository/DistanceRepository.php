<?php

namespace App\Repository;

use App\Entity\Distance;
use App\Interfaces\DistanceRepositoryInterface;

class DistanceRepository implements DistanceRepositoryInterface
{
    private $distances = [];

    public function save(Distance $distance): void
    {
        $this->distances[] = $distance;
    }

    public function find(int $id): ?Distance
    {
        foreach ($this->distances as $distance) {
            if ($distance->getId() === $id) {
                return $distance;
            }
        }
        return null;
    }
}
