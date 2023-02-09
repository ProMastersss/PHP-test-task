<?php

declare(strict_types=1);


namespace CodeSession\Domain\Economics;


interface MoneyInterface
{

    public function getAmount(): int;

    public function getCurrency(): CurrencyInterface;
}
