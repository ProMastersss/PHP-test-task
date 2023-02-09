<?php

declare(strict_types=1);


namespace CodeSession\Domain\Economics;


use CodeSession\Domain\Economics\Exceptions\UnavailableCurrencyException;

class Currency implements CurrencyInterface
{
    private string $value;

    private static array $availableCurrencies = [
        CurrencyInterface::RUR,
        CurrencyInterface::USD,
        CurrencyInterface::EUR,
    ];

    public function __construct(string $value)
    {
        if (!in_array($value, self::$availableCurrencies, true)) {
            throw new UnavailableCurrencyException();
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
