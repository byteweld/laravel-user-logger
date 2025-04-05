<?php

declare(strict_types=1);

namespace Byteweld\LaravelUserLogger\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallCommand extends Command
{
    protected $signature = 'user-logger:install';

    protected $description = 'Install the Byteweld User Logger package';

    public function handle(): int
    {
        $this->info('Installing Byteweld User Logger package...');

        $this->call('vendor:publish', [
            '--tag' => 'user-logger-config',
            '--force' => true,
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'user-logger-migrations',
            '--force' => true,
        ]);

        $this->info('Byteweld User Logger package installed successfully.');

        return self::SUCCESS;
    }
}