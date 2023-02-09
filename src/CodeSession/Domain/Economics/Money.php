<?php

declare(strict_types=1);


namespace CodeSession\Domain\Economics;


class Money implements MoneyInterface
{
    private int $amount;

    private CurrencyInterface $currency;

    public function __construct(int $amount, CurrencyInterface $currency)
    {
        $this->amount   = $amount;
        $this->currency = $currency;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): CurrencyInterface
    {
        return $this->currency;
    }
}
