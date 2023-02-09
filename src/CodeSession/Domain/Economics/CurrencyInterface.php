<?php

declare(strict_types=1);


namespace CodeSession\Domain\Economics;


interface CurrencyInterface
{
    public const RUR = 'RUR';
    public const USD = 'USD';
    public const EUR = 'EUR';

    public function getValue(): string;
}
