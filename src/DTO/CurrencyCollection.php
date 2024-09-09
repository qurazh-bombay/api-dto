<?php
declare(strict_types = 1);

namespace App\DTO;

class CurrencyCollection
{
    private array $currencies = [];

    public function __construct(array $currenciesData)
    {
        foreach ($currenciesData as $code => $name) {
            $this->currencies[$code] = new CurrencyName($code, $name);
        }
    }

    public function get(string $currencyCode): ?CurrencyName
    {
        return $this->currencies[$currencyCode] ?? null;
    }

    public function all(): array
    {
        return $this->currencies;
    }
}
