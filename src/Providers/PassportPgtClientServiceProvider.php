<?php

namespace Luchavez\PassportPgtClient\Providers;

use Luchavez\PassportPgtClient\Console\Commands\InstallPassportPGTClientCommand;
use Luchavez\PassportPgtClient\Services\PassportPgtClient;
use Luchavez\StarterKit\Abstracts\BaseStarterKitServiceProvider as ServiceProvider;

/**
 * Class PassportPgtClientServiceProvider
 *
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 */
class PassportPgtClientServiceProvider extends ServiceProvider
{
    protected array $commands = [
        InstallPassportPGTClientCommand::class,
    ];

    /**
     * Publishable Environment Variables
     *
     * @example [ 'HELLO_WORLD' => true ]
     *
     * @var array
     */
    protected array $env_vars = [
        'PASSPORT_PASSWORD_GRANT_CLIENT_ID' => null,
        'PASSPORT_PASSWORD_GRANT_CLIENT_SECRET' => null,
    ];

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        // Register the service the package provides.
        $this->app->singleton('passport-pgt-client', fn ($app) => new PassportPgtClient($app));
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
            __DIR__.'/../../config/passport-pgt-client.php' => config_path('passport-pgt-client.php'),
        ], 'passport-pgt-client.config');

        // Registering package commands.
        $this->commands($this->commands);
    }
}
