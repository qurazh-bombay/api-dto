<?php
declare(strict_types = 1);

namespace App\DTO;

class CurrencyRate
{
    private string $disclaimer;

    private string $license;

    private int $timestamp;

    private string $base;

    private CurrencyRateCollection $rates;

    public function __construct(array $data)
    {
        $this->disclaimer = $data['disclaimer'];
        $this->license    = $data['license'];
        $this->timestamp  = $data['timestamp'];
        $this->base       = $data['base'];
        $this->rates      = new CurrencyRateCollection($data['rates']);
    }

    public function getDisclaimer(): string
    {
        return $this->disclaimer;
    }

    public function getLicense(): string
    {
        return $this->license;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getBase(): string
    {
        return $this->base;
    }

    public function getRates(): CurrencyRateCollection
    {
        return $this->rates;
    }
}
