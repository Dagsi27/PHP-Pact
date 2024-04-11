<?php

namespace Tests;

use GuzzleHttp\Psr7\Uri;
use PhpPact\Standalone\ProviderVerifier\Model\VerifierConfig;
use PhpPact\Standalone\ProviderVerifier\Verifier;
use PHPUnit\Framework\TestCase;

class ConsumerTest extends TestCase
{
    public function testExampleConsumer()
    {
        $config = new VerifierConfig();
        $config->setProviderName("personProvider")
            ->setProviderVersion("1.0.0")
            ->setProviderBaseUrl(new Uri("http://host.docker.internal:9132"))
            ->setBrokerUri(new Uri("http://host.docker.internal:9292"))
            ->setPublishResults(true);

        $verifier = new Verifier($config);
        $verifier->verifyAll();

        $this->assertTrue(true);
    }
}
