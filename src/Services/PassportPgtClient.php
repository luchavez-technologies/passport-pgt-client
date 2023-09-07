<?php

namespace Luchavez\PassportPgtClient\Services;

use Illuminate\Foundation\Application;
use Luchavez\ApiSdkKit\Services\SimpleHttp;
use Luchavez\ApiSdkKit\Abstracts\BaseApiSdkService;
use Illuminate\Support\Str;

/**
 * Class PassportPgtClient
 *
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 */
class PassportPgtClient extends BaseApiSdkService
{
    /**
     * @param Application $application
     */
    public function __construct(protected Application $application)
    {
        //
    }

    /***** CONFIG-RELATED *****/

    /**
     * @return string
     */
    public function getPassportUrl(): string
    {
        return config('passport-pgt-client.passport_server.url');
    }

    /**
     * @return string|int|null
     */
    public function getPasswordGrantClientId(): int|string|null
    {
        return config('passport-pgt-client.passport_server.password_grant_client.id');
    }

    /**
     * @return string|null
     */
    public function getPasswordGrantClientSecret(): ?string
    {
        return config('passport-pgt-client.passport_server.password_grant_client.secret');
    }

    /***** BASE API SERVICE METHODS  *****/

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->getPassportUrl();
    }

    /**
     * Since tokens are very sensitive information, they should not be logged.
     *
     * @param bool $return_as_model
     * @return SimpleHttp
     */
    public function getHttp(bool $return_as_model = true): SimpleHttp
    {
        return parent::getHttp()->returnAsResponse();
    }

    /***** AUTH-RELATED FUNCTIONS *****/

    /**
     * @param  array  $data
     * @return SimpleHttp
     */
    public function register(array $data): SimpleHttp
    {
        ['uri' => $uri, 'http_method' => $method] = config('passport-pgt-client.passport_server.routes.register');

        return tap($this->getHttp()->asJson()->data($data))->$method($uri);
    }

    /**
     * @param  string  $username
     * @param  string  $password
     * @param  array  $scopes
     * @return SimpleHttp
     */
    public function login(string $username, string $password, array $scopes = []): SimpleHttp
    {
        ['uri' => $uri, 'http_method' => $method] = config('passport-pgt-client.passport_server.routes.login');

        $data = [
            'grant_type' => 'password',
            'client_id' => $this->getPasswordGrantClientId(),
            'client_secret' => $this->getPasswordGrantClientSecret(),
            'username' => $username,
            'password' => $password,
            'scope' => $this->getSluggedScopes($scopes),
        ];

        return tap($this->getHttp()->asJson()->data($data))->$method($uri);
    }

    /**
     * @param  string  $refresh_token
     * @param  array  $scopes
     * @return SimpleHttp
     */
    public function refreshToken(string $refresh_token, array $scopes = []): SimpleHttp
    {
        ['uri' => $uri, 'http_method' => $method] = config('passport-pgt-client.passport_server.routes.refresh-token');

        $data = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refresh_token,
            'client_id' => $this->getPasswordGrantClientId(),
            'client_secret' => $this->getPasswordGrantClientSecret(),
            'scope' => $this->getSluggedScopes($scopes),
        ];

        return tap($this->getHttp()->asJson()->data($data))->$method($uri);
    }

    /**
     * @param  string|null  $token
     * @return SimpleHttp
     */
    public function logout(string|null $token): SimpleHttp
    {
        ['uri' => $uri, 'http_method' => $method] = config('passport-pgt-client.passport_server.routes.logout');

        $headers = [
            'Authorization' => 'Bearer '.$token,
        ];

        return tap($this->getHttp()->asJson()->headers($headers))->$method($uri);
    }

    /**
     * @param  string|null  $token
     * @return SimpleHttp
     */
    public function getSelf(string|null $token): SimpleHttp
    {
        ['uri' => $uri, 'http_method' => $method] = config('passport-pgt-client.passport_server.routes.me');

        $headers = [
            'Authorization' => 'Bearer '.$token,
        ];

        return tap($this->getHttp()->asJson()->headers($headers))->$method($uri);
    }

    /**
     * @param  array  $scopes
     * @return string
     */
    protected function getSluggedScopes(array $scopes = []): string
    {
        return collect($scopes)->map(fn (string $scope) => Str::slug($scope))->filter()->implode(' ');
    }
}
