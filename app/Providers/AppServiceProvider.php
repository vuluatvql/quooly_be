<?php

namespace App\Providers;

use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\Contact\ContactInterface;
use App\Repositories\Contact\ContactRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(ContactInterface::class, ContactRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
