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
use App\Repositories\Request\RequestInterface;
use App\Repositories\Request\RequestRepository;
use App\Repositories\UserOptional\UserOptionalInterface;
use App\Repositories\UserOptional\UserOptionalRepository;
use App\Repositories\ViewHistory\ViewHistoryInterface;
use App\Repositories\ViewHistory\ViewHistoryRepository;
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
        $this->app->bind(ViewHistoryInterface::class, ViewHistoryRepository::class);
        $this->app->bind(FavoritesInterface::class, FavoritesRepository::class);
        $this->app->bind(RequestInterface::class, RequestRepository::class);
        $this->app->bind(UserOptionalInterface::class, UserOptionalRepository::class);
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
