<?php

namespace App\Tests\Service;

use App\Service\DistanceService;
use App\Dto\Coordinate;
use App\Entity\Distance;
use App\Interfaces\CoordinateServiceInterface;
use App\Interfaces\DistanceRepositoryInterface;
use PHPUnit\Framework\TestCase;

class DistanceServiceTest extends TestCase
{
    private $distanceRepository;
    private $coordinateService;
    private $distanceService;

    protected function setUp(): void
    {
        $this->distanceRepository = $this->createMock(DistanceRepositoryInterface::class);
        $this->coordinateService = $this->createMock(CoordinateServiceInterface::class);
        $this->distanceService = new DistanceService($this->distanceRepository, $this->coordinateService);
    }

    public function testCreateDistance()
    {
        $cep1 = '12345678';
        $cep2 = '87654321';
        $this->coordinateService->method('fetchCoordinates')->willReturn([
            new Coordinate(40.748817, -73.985428),
            new Coordinate(34.052235, -118.243683)
        ]);

        $distance = $this->distanceService->createDistance($cep1, $cep2);

        $this->assertInstanceOf(Distance::class, $distance);
        $this->assertEquals($cep1, $distance->getCep1());
        $this->assertEquals($cep2, $distance->getCep2());
        $this->assertNotNull($distance->getDistance());
        $this->assertNotNull($distance->getDateCreated());
        $this->assertNotNull($distance->getDateModification());
    }

    public function testCalculateDistance()
    {
        $cep1 = '12345678';
        $cep2 = '87654321';
        $this->coordinateService->method('fetchCoordinates')->willReturn([
            new Coordinate(40.748817, -73.985428),
            new Coordinate(34.052235, -118.243683)
        ]);

        $distance = $this->distanceService->calculateDistance($cep1, $cep2);

        $this->assertNotNull($distance);
        $this->assertGreaterThan(0, $distance);
    }

    public function testListDistances()
    {
        $expectedDistances = [
            new Distance(),
            new Distance()
        ];
        $this->distanceRepository->method('listAll')->willReturn($expectedDistances);

        $distances = $this->distanceService->listDistances();

        $this->assertCount(2, $distances);
        $this->assertEquals($expectedDistances, $distances);
    }
}
