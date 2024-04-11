<?php
declare(strict_types=1);

namespace App\Service;

use App\Models\Person;
use GuzzleHttp\Client;

class PersonConsumer
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getPersonById(string $id) : Person
    {
        $response = $this->client->get(
            "/person/" . $id,
            [
                "headers" => [
                    "Accept" => "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7"
                ]
            ]
        );

        $body = json_decode($response->getBody()->getContents(), true);

        return new Person(
            $body["first_name"],
            $body["last_name"],
            $body["alias"]
        );
    }
}
