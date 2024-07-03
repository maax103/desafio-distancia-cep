<?php

namespace App\Interfaces;

use App\Entity\Distance;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface DistanceServiceInterface
{
    public function createDistance(string $cep1, string $cep2): Distance;
    public function calculateDistance(string $cep1, string $cep2): ?float;
    
    /**
     * @return Distance[]
     */
    public function listDistances() : ?array;
    public function createDistancesFromCsv(?UploadedFile $file, string $separator) : int;
}
