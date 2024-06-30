<?php 

namespace App\Entity;

class Distance
{
    private $id;
    private $cep1;
    private $cep2;
    private $distance;
    private $dateCreated;
    private $dateModification;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCep1(): string
    {
        return $this->cep1;
    }

    public function setCep1(string $cep1): void
    {
        $this->cep1 = $cep1;
    }

    public function getCep2(): string
    {
        return $this->cep2;
    }

    public function setCep2(string $cep2): void
    {
        $this->cep2 = $cep2;
    }

    public function getDistance(): float
    {
        return $this->distance;
    }

    public function setDistance(float $distance): void
    {
        $this->distance = $distance;
    }

    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTime $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    public function getDateModification(): \DateTime
    {
        return $this->dateModification;
    }

    public function setDateModification(\DateTime $dateModification): void
    {
        $this->dateModification = $dateModification;
    }
}
