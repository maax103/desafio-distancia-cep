<?php

namespace App\Interfaces;

use App\Entity\Distance;

interface DistanceRepositoryInterface
{
    public function save(Distance &$distance): void;
    public function find(int $id): ?Distance;

    /**
     * @return Distance[]
     */
    public function listAll(): array;

    /**
     * @param Distance[] $distances
     */
    public function saveAll(array $distances) : bool;
}
