<?php

namespace Komptip\PhpTiktokSdk\Tests;

use Komptip\PhpTiktokSdk\PhpTiktokSdk;
use Komptip\PhpTiktokSdk\AuthorizationScope;

use PHPUnit\Framework\TestCase;

class AuthURLTest extends TestCase
{
    public function testCreateAuthUrl()
    {
        $tiktok = new PhpTiktokSdk('client_key', 'client_secret');
        $authUrl = $tiktok->createAuthUrl(
            scopes: [AuthorizationScope::UserInfoBasic, AuthorizationScope::UserInfoProfile],
            csrfState: 'csrf_state',
            redirectUri: 'https://example.com/callback'
        );

        $this->assertEquals(
            'https://www.tiktok.com/v2/auth/authorize/?client_key=client_key&scope=user.info.basic,user.info.profile&response_type=code&redirect_uri=https://example.com/callback&state=csrf_state',
            $authUrl
        );
    }
}
