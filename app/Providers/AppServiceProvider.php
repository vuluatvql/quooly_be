<?php

namespace App\Providers;

use App\Repositories\Favorites\FavoritesInterface;
use App\Repositories\Favorites\FavoritesRepository;
use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\Contact\ContactInterface;
use App\Repositories\Contact\ContactRepository;
use App\Repositories\Admin\AdminInterface;
use App\Repositories\Admin\AdminRepository;
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
        $this->app->bind(AdminInterface::class, AdminRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(ContactInterface::class, ContactRepository::class);
        $this->app->bind(FavoritesInterface::class, FavoritesRepository::class);
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
