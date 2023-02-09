<?php

declare(strict_types=1);

namespace CodeSession\Domain;

use CodeSession\Domain\Car\CarInterface;
use CodeSession\Domain\Economics\CurrencyInterface;
use CodeSession\Domain\Economics\Money;
use CodeSession\Domain\Market\MarketInterface;
use CodeSession\Domain\SimilarCar\SimilarCarInterface;
use CodeSession\Domain\SimilarCar\SimilarCarsFetcherInterface;

class Service
{
    private SimilarCarsFetcherInterface $similarCarsFetcher;

    public function __construct(SimilarCarsFetcherInterface $similarCarsFetcher)
    {
        $this->similarCarsFetcher = $similarCarsFetcher;
    }

    public function getMarket(CarInterface $car, CurrencyInterface $currency): MarketInterface
    {
        $similarCars = $this->similarCarsFetcher->fetchByCar($car);

        $carsByCurrency = \array_filter($similarCars, function (SimilarCarInterface $simaularCar) use ($currency) {
            return $simaularCar->getSellingPrice()->getCurrency()->getValue() === $currency->getValue();
        });

        if (empty($carsByCurrency)) {
            $medianValue = 0;
        } else {
            usort($carsByCurrency, function (SimilarCarInterface $simaularCar, SimilarCarInterface $simaularCar2) {
                return $simaularCar->getSellingPrice()->getAmount() <=> $simaularCar2->getSellingPrice()->getAmount();
            });

            $countCars = \count($carsByCurrency);
            if ($countCars % 2 === 0) {
                $indexMiddle = $countCars / 2;
                $carPrice = $carsByCurrency[$indexMiddle]->getSellingPrice()->getAmount();
                $carPrice2 = $carsByCurrency[$indexMiddle - 1]->getSellingPrice()->getAmount();
                $medianValue = (int) \round(($carPrice + $carPrice2) / 2);
            } else {
                $indexMiddle = $countCars > 1 ? (int) ($countCars / 2) : 0;
                $medianValue = $carsByCurrency[$indexMiddle]->getSellingPrice()->getAmount();
            }
        }

        $medianPrice = new Money($medianValue, $currency);
        return new Market($car, $medianPrice);
    }
}
