<?php

namespace Komptip\PhpTiktokSdk\Tests;

use Komptip\PhpTiktokSdk\PhpTiktokSdk;

use PHPUnit\Framework\TestCase;

class RedirectURLTest extends TestCase
{
    public function testGetRedirectUri()
    {
        $service = new PhpTiktokSdk('client_key', 'client_secret');
        $service->setRedirectUri('https://example.com/callback');

        $this->assertEquals('https://example.com/callback', $service->getRedirectUri());
    }

    public function testRedictUriException()
    {
        $service = new PhpTiktokSdk('client_key', 'client_secret');

        $this->expectException(\Exception::class);
        $service->getRedirectUri();
    }

    public function testGetRedirectUriFromMethod()
    {
        $service = new PhpTiktokSdk('client_key', 'client_secret');
        $this->assertEquals('https://example.com/callback', $service->getRedirectUri('https://example.com/callback'));
    }

    public function testGetRedirectUriFromConstructor()
    {
        $service = new PhpTiktokSdk('client_key', 'client_secret', 'https://example.com/callback');
        $this->assertEquals('https://example.com/callback', $service->getRedirectUri());
    }

    public function testGetRedirectUriFromMethodOverridesConstructor()
    {
        $service = new PhpTiktokSdk('client_key', 'client_secret', 'https://example.com/callback');
        $this->assertEquals('https://example.com/callback2', $service->getRedirectUri('https://example.com/callback2'));
    }
}
