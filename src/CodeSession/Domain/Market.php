<?php

declare(strict_types=1);

namespace CodeSession\Domain;

use CodeSession\Domain\Car\CarInterface;
use CodeSession\Domain\Economics\MoneyInterface;
use CodeSession\Domain\Market\MarketInterface;

class Market implements MarketInterface
{
    private CarInterface $car;
    private MoneyInterface $medianPrice;

    public function __construct(CarInterface $car, MoneyInterface $medianPrice)
    {
        $this->car = $car;
        $this->medianPrice = $medianPrice;
    }

    public function getCar(): CarInterface
    {
        return $this->car;
    }

    public function getMedianPrice(): MoneyInterface
    {
        return $this->medianPrice;
    }
}
