<?php
declare(strict_types = 1);

namespace App\Handler;

use App\Validator\ValidatorInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class RateHandler
{
    private ClientInterface $client;

    private ValidatorInterface $validator;

    public function __construct(ClientInterface $client, ValidatorInterface $validator)
    {
        $this->client    = $client;
        $this->validator = $validator;
    }

    public function get(string $url, array $options, string $dto, array $constraints = []): mixed
    {
        try {
            $response = $this->client->get($url, $options);
            $data     = json_decode($response->getBody()->getContents(), true);

            if ($this->validator->validate($data, $constraints)) {
                return new $dto($data);
            }

            return null;
        } catch (RequestException $e) {
            // обработка ошибок (если не статус 200)
            var_dump($e->getMessage());
        } catch (GuzzleException $e) {
            // обработка ошибок
            var_dump($e->getMessage());
        }

        return null;
    }
}
