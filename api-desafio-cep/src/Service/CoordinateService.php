<?php

namespace App\Service;

use App\Dto\Coordinate;
use App\Interfaces\CoordinateServiceInterface;

class CoordinateService implements CoordinateServiceInterface
{
    
    public function fetchCoordinates(array $ceps): ?array
    {
        $response = [];
        foreach($ceps as $cep) {
            $response[] = $this->fetchCoordinate($cep);
        }

        return $response;
    }

    public function fetchCoordinate(string $cep) : ?Coordinate
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $_ENV['API_CEP_URL']."/$cep");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new \RuntimeException("cURL error: $error");
        }

        curl_close($ch);

        $data = json_decode($response, true);

        if(!isset($data['location']['coordinates'])) {
            return null;
        }

        return new Coordinate(
            $data['location']['coordinates']['latitude'],
            $data['location']['coordinates']['longitude'],
        );
    }
}