# PHP TikTok SDK
## PHP SDK for TikTok REST API

This package provides an wrapper for TikTok REST API for PHP 8.3 and later

## Requirements

- PHP >= 8.3

## Installation

In your existing Laravel application you can install this package using [Composer](https://getcomposer.org).

```bash
composer require "komptip/php-tiktok-sdk:v1.0.0-alpha"
```

## Usage

```php
use Komptip\PhpTiktokSdk\PhpTiktokSdk;
use Komptip\PhpTiktokSdk\AuthorizationScope;
use Komptip\PhpTiktokSdk\UserField;

$tiktok = new PhpTiktokSdk('client_key', 'client_secret');

// Get auth url
$authUrl = $tiktok->createAuthUrl(
    scopes: [AuthorizationScope::UserInfoBasic, AuthorizationScope::UserInfoProfile],
    csrfState: $tiktok->createCsrfState(),
    redirectUri: 'https://example.com/callback'
);

// Get access token
$accessToken = $tiktok->getAccessToken($authorizationCode);

// Get user info
$userInfo = $tiktok->getUserInfo($accessToken['access_token'], [UserField::OpenID, UserField::Displayname]);
```


Check [wiki](https://github.com/Komptip/php-tiktok-sdk/wiki) for detailed documentation.