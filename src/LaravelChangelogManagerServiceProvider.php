<?php

namespace E98Developer\LaravelChangelogManagerPackage;


use E98Developer\LaravelChangelogManagerPackage\Commands\ChangelogAddCommand;
use E98Developer\LaravelChangelogManagerPackage\Commands\ChangelogInitCommand;
use E98Developer\LaravelChangelogManagerPackage\Commands\ChangelogReleaseCommand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
class LaravelChangelogManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::prefix('changelog-manager')
            ->as('changelog-manager.')
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            });

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
            $this->commands([
                ChangelogInitCommand::class,
                ChangelogReleaseCommand::class,
                ChangelogAddCommand::class
            ]);
        }
    }
}
