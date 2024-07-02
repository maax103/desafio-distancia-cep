<?php

namespace App\Interfaces;

use App\Entity\Distance;

interface DistanceServiceInterface
{
    public function createDistance(string $cep1, string $cep2): Distance;
    public function calculateDistance(string $cep1, string $cep2): ?float;
    
    /**
     * @return Distance[]
     */
    public function listDistances() : ?array;
}
