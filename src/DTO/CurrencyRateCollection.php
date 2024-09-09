<?php
declare(strict_types = 1);

namespace App\DTO;

class CurrencyRateCollection
{
    private array $currencies = [];

    public function __construct(array $rates)
    {
        foreach ($rates as $currency => $rate) {
            $this->currencies[$currency] = new CurrencyRateValue($currency, $rate);
        }
    }

    public function get(string $currencyCode): ?CurrencyRateValue
    {
        return $this->currencies[$currencyCode] ?? null;
    }

    public function all(): array
    {
        return $this->currencies;
    }
}
