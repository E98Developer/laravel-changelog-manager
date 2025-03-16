<?php

namespace E98Developer\LaravelChangelogManagerPackage;


use E98Developer\LaravelChangelogManagerPackage\Commands\ChangelogAddCommand;
use E98Developer\LaravelChangelogManagerPackage\Commands\ChangelogInitCommand;
use E98Developer\LaravelChangelogManagerPackage\Commands\ChangelogReleaseCommand;
use E98Developer\LaravelChangelogManagerPackage\Http\Controllers\ReleaseController;
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
                Route::get('release',[ReleaseController::class,'index'])->name('release');
            });
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'changelog-manager');

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
