<?php

namespace Komptip\PhpTiktokSdk;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class MockablePhpTiktokSdk extends PhpTiktokSdk
{
    private ?MockHandler $mockHandler;
    private ?HandlerStack $handlerStack;
    public ?Client $httpClient;

    public function createHttpClient()
    {
        $this->mockHandler = new MockHandler([]);
        $this->handlerStack = HandlerStack::create($this->mockHandler);
        $this->setHttpClient(new Client(['handler' => $this->handlerStack]));
    }

    public function mockResponse(Response $response): void
    {
        if (!isset($this->handlerStack)) {
            $this->createHttpClient();
        }

        $this->mockHandler->append($response);
    }
}
