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

    public function listAll() : array
    {
        $stmt = $this->pdo->query("SELECT * FROM ".self::TABLE);
        $distances = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        $response = [];

        foreach($distances as $item) {
            $distance = new Distance();
            $distance->setId($item['id']);
            $distance->setCep1($item['cep1']);
            $distance->setCep2($item['cep2']);
            $distance->setDistance($item['distance']);
            $distance->setDateCreated(new \DateTime($item['date_created']));
            $distance->setDateModification(new \DateTime($item['date_modification']));

            $response[] = $distance;
        }

        return $response;
    }

    public function saveAll(array $distances): bool
{
    $params = [];
    $prepare_values = [];
    foreach ($distances as $index => $distance) {
        $id = ":id_$index";
        $cep1 = ":cep1_$index";
        $cep2 = ":cep2_$index";
        $distance_value = ":distance_$index";
        $date_created = ":date_created_$index";
        $date_modification = ":date_modification_$index";

        $prepare_values[] = "($id, $cep1, $cep2, $distance_value, $date_created, $date_modification)";

        $params[$id] = $distance->getId();
        $params[$cep1] = $distance->getCep1();
        $params[$cep2] = $distance->getCep2();
        $params[$distance_value] = $distance->getDistance();
        $params[$date_created] = $distance->getDateCreated()->format('Y-m-d H:i:s');
        $params[$date_modification] = $distance->getDateModification()->format('Y-m-d H:i:s');
    }

    $sql = 'INSERT INTO ' . self::TABLE . ' (id, cep1, cep2, distance, date_created, date_modification) VALUES ' . implode(', ', $prepare_values);
    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute($params);
}

}
