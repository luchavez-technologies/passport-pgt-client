<?php

namespace Luchavez\PassportPgtClient\Providers;

use Luchavez\PassportPgtClient\Services\PassportPgtClient;
use Luchavez\StarterKit\Abstracts\BaseStarterKitServiceProvider as ServiceProvider;

/**
 * Class PassportPgtClientServiceProvider
 *
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 */
class PassportPgtClientServiceProvider extends ServiceProvider
{
    /**
     * Publishable Environment Variables
     *
     * @example [ 'HELLO_WORLD' => true ]
     *
     * @var array
     */
    protected array $env_vars = [
        'PPC_PGC_ID' => null,
        'PPC_PGC_SECRET' => null,
        'PPC_PASSPORT_URL' => '${APP_URL}',
    ];

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        // Register the service the package provides.
        $this->app->singleton('passport-pgt-client', function ($app, $params) {
            return new PassportPgtClient(collect($params)->get('auth_client_controller'));
        });

        parent::register();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['passport-pgt-client'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/passport-pgt-client.php' => config_path('passport-pgt-client.php'),
        ], 'passport-pgt-client.config');

        // Registering package commands.
        // $this->commands([]);
    }

    /**
     * @param  bool  $is_api
     * @return array
     */
    public function getDefaultRouteMiddleware(bool $is_api): array
    {
        return []; // Must be blank since middleware should be setup on Passport PGT Server.
    }
}
