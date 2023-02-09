<?php

declare(strict_types=1);

namespace CodeSession\Test\Domain\Car;

use CodeSession\Domain\Car\Car;
use PHPUnit\Framework\TestCase;

class CarTest extends TestCase
{
    public function testCarCreatesSuccessfully()
    {
        $car = new Car(1,2,3);

        $this->assertEquals(1, $car->getBrand());
        $this->assertEquals(2, $car->getModel());
        $this->assertEquals(3, $car->getGeo());
    }
}
