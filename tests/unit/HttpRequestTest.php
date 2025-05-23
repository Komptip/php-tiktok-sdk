<?php

namespace Komptip\PhpTiktokSdk\Tests;

use Komptip\PhpTiktokSdk\MockablePhpTiktokSdk;
use Komptip\PhpTiktokSdk\UserField;
use GuzzleHttp\Psr7\Response;

use PHPUnit\Framework\TestCase;

class HttpRequestTest extends TestCase
{
    public function testMakeGetRequest()
    {
        $service = new MockablePhpTiktokSdk('client_key', 'client_secret');
        $service->mockResponse(new Response(200, [], json_encode([
            'foo' => 'bar'
        ])));

        $response = $service->getAccessToken('authorization_code', 'https://example.com/callback');

        $this->assertEquals(['foo' => 'bar'], $response);
    }

    public function testMakePostRequest()
    {
        $service = new MockablePhpTiktokSdk('client_key', 'client_secret');
        $service->mockResponse(new Response(200, [], json_encode([
            'foo' => 'bar'
        ])));

        $response = $service->getUserInfo('authorization_code', [UserField::OpenID]);

        $this->assertEquals(['foo' => 'bar'], $response);
    }
}

