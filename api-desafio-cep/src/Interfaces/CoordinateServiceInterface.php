<?php 

namespace App\Interfaces;

use App\Dto\Coordinate;

interface CoordinateServiceInterface {
    /**
     * @return Coordinate[]
     */
    public function fetchCoordinates(array $ceps) : ?array;
    public function fetchCoordinate(string $cep) : ?Coordinate;
}