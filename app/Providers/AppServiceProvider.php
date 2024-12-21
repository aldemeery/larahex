<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerBindings();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    private function registerBindings(): void
    {
        $this->app->bind(
            \Larahex\Contracts\TodoService::class,
            \Larahex\Services\TodoService::class,
        );

        $this->app->bind(
            \Larahex\Contracts\UserRepository::class,
            \App\Repositories\UserRepository::class,
        );

        $this->app->bind(
            \Larahex\Contracts\TodoRepository::class,
            \App\Repositories\TodoRepository::class,
        );
    }
}
