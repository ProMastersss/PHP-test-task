<?php

declare(strict_types=1);


namespace CodeSession\Domain\Market;


use CodeSession\Domain\Car\CarInterface;
use CodeSession\Domain\Economics\MoneyInterface;

interface MarketInterface
{
    public function getCar(): CarInterface;

    public function getMedianPrice(): MoneyInterface;
}
