<?php

namespace App\Repository;

use App\Entity\Distance;
use App\Interfaces\DistanceRepositoryInterface;

class DistanceRepository extends BaseRepository implements DistanceRepositoryInterface
{
    const TABLE = 'distance';
    private $distances = [];

    public function save(Distance &$distance): void
    {
        $params = [
            ':id'                   => $distance->getId(),
            ':cep1'                 => $distance->getCep1(),
            ':cep2'                 => $distance->getCep2(),
            ':distance'             => $distance->getDistance(),
            ':date_created'         => $distance->getDateCreated()->format('Y-m-d H:i:s'),
            ':date_modification'    => $distance->getDateModification()->format('Y-m-d H:i:s'),
        ];

        $stmt = $this->pdo->prepare(
            'INSERT INTO '.self::TABLE.'(id, cep1, cep2, distance, date_created, date_modification)
                VALUES (:id, :cep1, :cep2, :distance, :date_created, :date_modification)'
        );

        $success = $stmt->execute($params);
        if ($success) {
            $distance->setId($this->pdo->lastInsertId());
        }
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
