<?php
declare(strict_types = 1);

use App\DTO\CurrencyCollection;
use App\DTO\CurrencyRate;
use App\Handler\RateHandler;
use App\Validator\Validator;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

require __DIR__ . '/vendor/autoload.php';

$client = new Client([
    'base_uri' => 'https://openexchangerates.org/api/',
    'timeout'  => 2.0,
]);

$options = [
    'query' => [
        'app_id' => '97fcdc9e0bcc47098e308b703ac10337',
    ],
];

$handler = new RateHandler($client, new Validator());

try {
    $rates = $handler->get('latest.json', $options, CurrencyRate::class);

    if ($rates instanceof CurrencyRate) {
        var_dump($rates->getRates()->get('RUB')?->getRate());
    }

    $rates = $handler->get('historical/2012-07-10.json', $options, CurrencyRate::class);

    if ($rates instanceof CurrencyRate) {
        var_dump($rates->getRates()->get('RUB')?->getRate());
    }

    $currencies = $handler->get('currencies.json', $options, CurrencyCollection::class);

    if ($currencies instanceof CurrencyCollection) {
        var_dump($currencies->get('RUB')?->getName());
    }
} catch (\Throwable $th) {
    // обработка ошибок
    var_dump($th->getMessage());
}
