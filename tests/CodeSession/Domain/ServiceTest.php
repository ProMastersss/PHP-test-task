<?php

declare(strict_types=1);

namespace CodeSession\Test\Domain\Car;

use CodeSession\Domain\Car\Car;
use CodeSession\Domain\Economics\CurrencyInterface;
use CodeSession\Domain\Economics\MoneyInterface;
use CodeSession\Domain\Service;
use CodeSession\Domain\SimilarCar\SimilarCarInterface;
use CodeSession\Domain\SimilarCar\SimilarCarsFetcherInterface;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    private $car;
    private $similarCarFetcherStub;
    private $service;

    public function setUp(): void
    {
        $this->car = new Car(1, 1, 1);
        $this->similarCarFetcherStub = $this->createStub(SimilarCarsFetcherInterface::class);
        $this->service = new Service($this->similarCarFetcherStub);
    }

    /**
     * @dataProvider provider
     * @param array $similarCarsValues
     * @param integer $expected
     * @return void
     */
    public function testMedianPrice(array $similarCarsValues, int $expected)
    {
        $cars = [];
        foreach ($similarCarsValues as list($currency, $value)) {
            $cars[] = $this->createSimilarCar($currency, $value);
        }

        $currency = $this->createStub(CurrencyInterface::class);
        $currency->method('getValue')->willReturn(CurrencyInterface::RUR);
        $this->similarCarFetcherStub->method('fetchByCar')->willReturn($cars);
        $market = $this->service->getMarket($this->car, $currency);
        $medianPrice = $market->getMedianPrice()->getAmount();
        $this->assertEquals($expected, $medianPrice);
    }

    private function provider()
    {
        return [
            // case 0
            [
                [],
                0
            ],
            // case 1
            [
                [
                    [CurrencyInterface::RUR, 1]
                ],
                1
            ],
            // case 2
            [
                [
                    [CurrencyInterface::RUR, 1], [CurrencyInterface::USD, 1], [CurrencyInterface::RUR, 5]
                ],
                3
            ],
            // case 3
            [
                [
                    [CurrencyInterface::RUR, 1], [CurrencyInterface::RUR, 1]
                ],
                1
            ],
            // case 4
            [
                [
                    [CurrencyInterface::RUR, 3], [CurrencyInterface::RUR, 5]
                ],
                4
            ],
            // case 5
            [
                [
                    [CurrencyInterface::RUR, 5], [CurrencyInterface::RUR, 5], [CurrencyInterface::RUR, 3]
                ],
                5
            ],
            // case 6
            [
                [
                    [CurrencyInterface::RUR, 9], [CurrencyInterface::RUR, 5], [CurrencyInterface::RUR, 3]
                ],
                5
            ],
            // case 7
            [
                [
                    [CurrencyInterface::RUR, 5], [CurrencyInterface::RUR, 3], [CurrencyInterface::RUR, 11], [CurrencyInterface::RUR, 9]
                ],
                7
            ]
        ];
    }

    private function createSimilarCar(string $currencyStr, int $value): SimilarCarInterface
    {
        $currency = $this->createStub(CurrencyInterface::class);
        $currency->method('getValue')->willReturn($currencyStr);

        $money = $this->createStub(MoneyInterface::class);
        $money->method('getCurrency')->willReturn($currency);
        $money->method('getAmount')->willReturn($value);

        $similarCar = $this->createStub(SimilarCarInterface::class);
        $similarCar->method('getSellingPrice')->willReturn($money);

        return $similarCar;
    }
}
