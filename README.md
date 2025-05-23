# PHP TikTok SDK

This package provides an wrapper for TikTok REST API for PHP 8.3 and later

## Requirements

- PHP >= 8.3

## Installation

In your exist PHP application you can install this package using [Composer](https://getcomposer.org).

```bash
composer require komptip/php-tiktok-sdk
```

## Usage

Check [documentation](https://github.com/Komptip/php-tiktok-sdk/wiki/Configuration-and-basic-usage) for basic understanding of configuration and usage, and [user authentication](https://github.com/Komptip/php-tiktok-sdk/wiki/User-authorization) for user authentication

Here is a basic example of how to use this package:

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

## State of the project

This package is in early development stage. Not all endpoints are implemented yet.

- [x] [Login kit](https://developers.tiktok.com/doc/login-kit-overview?enter_method=left_navigation)
    User authorization 
    **Ready to use**
- [ ] [Content posting API](https://developers.tiktok.com/doc/content-posting-api-get-started?enter_method=left_navigation)
    Posting videos and images to user profile
    **Not implemented yet**
- [ ] [Data Portability API](https://developers.tiktok.com/doc/data-portability-api-get-started?enter_method=left_navigation)
    Getting user data such as activity, comments, etc.
    **Not implemented yet**
- [ ] [Display API](https://developers.tiktok.com/doc/display-api-overview?enter_method=left_navigation)
    User profile information
    **Partially implemented. See [/v2/user/info/](https://github.com/Komptip/php-tiktok-sdk/wiki/User-authorization)**. /v2/video/list/ and /v2/video/query/ are not implemented yet

## License

This package is licensed under the MIT License.