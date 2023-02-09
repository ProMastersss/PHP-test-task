<?php

declare(strict_types=1);


namespace CodeSession\Domain\SimilarCar;


use CodeSession\Domain\Economics\MoneyInterface;
use DateTimeInterface;

interface SimilarCarInterface
{
    public function getSellingPrice(): MoneyInterface;

    public function getArrivedAt(): DateTimeInterface;
}
