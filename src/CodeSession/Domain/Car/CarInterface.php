<?php

declare(strict_types=1);


namespace CodeSession\Domain\Car;


interface CarInterface
{
    public function getBrand(): int;

    public function getModel(): int;

    public function getGeo(): int;
}
