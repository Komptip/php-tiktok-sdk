<?php

namespace Komptip\PhpTiktokSdk;

use GuzzleHttp\Client;
use Komptip\PhpTiktokSdk\Exceptions\TikTokAPIException;

class PhpTiktokSdk
{
    private string $clientKey;
    private string $clientSecret;
    private ?string $redirectUri;
    
    private ?Client $httpClient;

    public function __construct(string $clientKey, string $clientSecret, ?string $redirectUri = null)
    {
        $this->clientKey = $clientKey;
        $this->clientSecret = $clientSecret;
        $this->redirectUri = $redirectUri;
    }

    private function getHttpClient(): Client
    {
        if (!isset($this->httpClient)) {
            $this->httpClient = new Client();
        }

        return $this->httpClient;
    }

    public function createAuthUrl(array $scopes, string $csrfState, ?string $redirectUri = null): string
    {
        $scopes = $this->formatScopes(...$scopes);
        return "https://www.tiktok.com/v2/auth/authorize/?client_key={$this->clientKey}&scope={$scopes}&response_type=code&redirect_uri={$this->getRedirectUri($redirectUri)}&state={$csrfState}";
    }

    public function formatScopes(AuthorizationScope ...$scopes): string
    {
        return implode(',', array_map(fn($scope) => $scope->value, $scopes));
    }

    public function formatUserFields(UserField ...$fields): string
    {
        return implode(',', array_map(fn($field) => $field->value, $fields));
    }

    public function setRedirectUri(string $redirectUri): void
    {
        $this->redirectUri = $redirectUri;
    }

    public function getRedirectUri(?string $redirectUri = null): string
    {
        $url = $redirectUri ?? $this->redirectUri;

        if(!$url) {
            throw new \Exception('Redirect URI is not set');
        }

        return $url;
    }

    public function createCsrfState(): string
    {
        return bin2hex(random_bytes(16));
    }

    public function handleHttpResponse(array $response): array
    {
        if (isset($response['error'])) {
            throw new TikTokAPIException("{$response['error']}: {$response['error_description']} | log_id: {$response['log_id']}");
        }

        return $response;
    }

    public function getAccessToken(string $authorizationCode, ?string $redirectUri = null): array
    {
        $response = $this->getHttpClient()->post(
            'https://open.tiktokapis.com/v2/oauth/token/',
            [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'client_key' => $this->clientKey,
                    'client_secret' => $this->clientSecret,
                    'code' => $authorizationCode,
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => $this->getRedirectUri($redirectUri),
                ]
            ]
        );

        return $this->handleHttpResponse(json_decode($response->getBody(), true));
    }

    public function getUserInfo(string $authorizationCode, array $fields): array
    {
        $response = $this->getHttpClient()->get(
            'https://open.tiktokapis.com/v2/user/info/',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $authorizationCode,
                ],
                'query' => [
                    'fields' => $this->formatUserFields(...$fields),
                ],  
            ]
        );
        
        return $this->handleHttpResponse(json_decode($response->getBody(), true));
    }
}