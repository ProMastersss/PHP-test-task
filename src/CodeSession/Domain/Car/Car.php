<?php

declare(strict_types=1);


namespace CodeSession\Domain\Car;


class Car implements CarInterface
{
    private int $brand;
    private int $model;
    private int $geo;

    public function __construct(int $brand, int $model, int $geo)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->geo   = $geo;
    }

    public function getBrand(): int
    {
        return $this->brand;
    }

    public function getModel(): int
    {
        return $this->model;
    }

    public function getGeo(): int
    {
        return $this->geo;
    }
}
