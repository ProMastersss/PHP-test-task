<?php

declare(strict_types=1);


namespace CodeSession\Domain\SimilarCar;


use CodeSession\Domain\Car\CarInterface;

interface SimilarCarsFetcherInterface
{

    /**
     * @param CarInterface $car
     *
     * @return SimilarCarInterface[]
     */
    public function fetchByCar(CarInterface $car): array;
}
