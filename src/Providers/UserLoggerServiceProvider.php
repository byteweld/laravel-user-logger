<?php

declare(strict_types=1);

namespace Byteweld\LaravelUserLogger\Providers;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Byteweld\LaravelUserLogger\Console\InstallCommand;
use Byteweld\LaravelUserLogger\Facades\UserLogger;
use Byteweld\LaravelUserLogger\Http\Middleware\LogUserActivity;

class UserLoggerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerMiddleware();
        $this->registerPublishables();
        $this->registerCommands();
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/user-logger.php',
            'user-logger'
        );

        $this->app->singleton('user-logger', function ($app) {
            return new \Byteweld\LaravelUserLogger\UserLogger();
        });
    }

    protected function registerMiddleware(): void
    {
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(LogUserActivity::class);
    }

    protected function registerPublishables(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/user-logger.php' => config_path('user-logger.php'),
            ], 'user-logger-config');

            $this->publishes([
                __DIR__.'/../../database/migrations' => database_path('migrations'),
            ], 'user-logger-migrations');
        }
    }

    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }
    }
}