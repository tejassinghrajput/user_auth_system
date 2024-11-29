<?php namespace App\Services\Login;

use League\OAuth2\Client\Provider\Google;

class GoogleLoginService extends BaseLoginService {

    private $provider;

    public function __construct() {
        $this->provider = new Google([
            'clientId'     => getenv('GOOGLE_CLIENT_ID'),
            'clientSecret' => getenv('GOOGLE_CLIENT_SECRET'),
            'redirectUri'  => getenv('GOOGLE_REDIRECT_URI'),
        ]);
    }

    public function authenticate(array $credentials = []) {
        if (empty($credentials)) {
            return $this->getAuthUrl();
        }

        if (isset($credentials['code'])) {
            return $this->handleGoogleCallback($credentials['code']);
        }
    }

    private function getAuthUrl() {
        return $this->provider->getAuthorizationUrl();
    }

    private function handleGoogleCallback($code) {
        $accessToken = $this->provider->getAccessToken('authorization_code', [
            'code' => $code
        ]);
        $user = $this->provider->getResourceOwner($accessToken);
        return $user->toArray();
    }
}
