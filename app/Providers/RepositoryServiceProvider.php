<?php

namespace App\Providers;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\EloquentCategoryRepository;
use App\Repositories\Wine\WineRepositoryInterface;
use App\Repositories\Wine\EloquentWineRepository;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Cart\SessionCartRepository;
use App\Repositories\Shop\EloquentShopRepository;
use App\Repositories\Shop\ShopRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            CategoryRepositoryInterface::class,
            EloquentCategoryRepository::class,
        );

        $this->app->bind(
            WineRepositoryInterface::class,
            EloquentWineRepository::class,
        );

        $this->app->bind(
            CartRepositoryInterface::class,
            SessionCartRepository::class,
        );

        $this->app->bind(
            ShopRepositoryInterface::class,
            EloquentShopRepository::class,
        );
    }


    public function boot(): void
    {
        //
    }
}
