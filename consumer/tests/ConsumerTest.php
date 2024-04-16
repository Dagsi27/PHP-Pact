<?php

namespace Tests;

use App\Service\PersonConsumer;
use GuzzleHttp\Client;
use PhpPact\Consumer\InteractionBuilder;
use PhpPact\Consumer\Model\ConsumerRequest;
use PhpPact\Consumer\Model\ProviderResponse;
use PhpPact\Standalone\Exception\MissingEnvVariableException;
use PhpPact\Standalone\MockService\MockServerEnvConfig;
use PHPUnit\Framework\TestCase;
use PHPUnit\TestRunner\TestResult\TestResult;

class ConsumerTest extends TestCase
{
    /**
     * @throws MissingEnvVariableException
     */
    public function testGetPersonById()
    {
        $id = "1";
        $firstName = "Daniel";
        $lastName = "Śliżewski";
        $alias = "test";

        $request = new ConsumerRequest();
        $request->setMethod("GET")
            ->setPath("/person/" . $id);

        $response = new ProviderResponse();
        $response->setStatus(200)
            ->setBody(
                [
                    "first_name" => $firstName,
                    "last_name" => $lastName,
                    "alias" => $alias,
                ]
            );

        $config = new MockServerEnvConfig();

        $builder = new InteractionBuilder($config);
        $builder->given("Person Dade Murphy (Zero Cool) exists")
            ->uponReceiving("GET person for id: " . $id)
            ->with($request)
            ->willRespondWith($response);

        $client = new Client(["base_uri" => $config->getBaseUri()]);
        $consumer = new PersonConsumer($client);

        $person = $consumer->getPersonById($id);

        $this->assertTrue($builder->verify());
        $this->assertEquals($firstName, $person->getFirstName());
        $this->assertEquals($lastName, $person->getLastName());
        $this->assertEquals($alias, $person->getAlias());
    }

    public function testFetchPersons()
    {
        $firstName = "Daniel";
        $lastName = "Śliżewski";
        $alias = "test";

        $request = new ConsumerRequest();
        $request->setMethod("GET")
            ->setPath("/person");

        $response = new ProviderResponse();
        $response->setStatus(200)
            ->setBody([
                [
                    "first_name" => $firstName,
                    "last_name" => $lastName,
                    "alias" => $alias,
                ]
            ]);

        $config = new MockServerEnvConfig();

        $builder = new InteractionBuilder($config);
        $builder->given("Person but first should be Daniel")
            ->uponReceiving("Fetch persona")
            ->with($request)
            ->willRespondWith($response);


        $client = new Client(["base_uri" => $config->getBaseUri()]);

        $consumer = new PersonConsumer($client);

        $person = $consumer->allPerson();

        $this->assertTrue($builder->verify());
    }
}
