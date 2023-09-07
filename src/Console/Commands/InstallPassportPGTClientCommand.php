<?php

namespace Luchavez\PassportPgtClient\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class InstallPassportPGTClientCommand
 *
 * @author James Carlo Luchavez <jamescarloluchavez@gmail.com>
 */
class InstallPassportPGTClientCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'pgt:client:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute "luchavez/passport-pgt-client" package setup.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->call('vendor:publish', [
            '--tag' => 'passport-pgt-client.config',
        ]);

        return self::SUCCESS;
    }
}
