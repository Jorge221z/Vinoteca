<?php

namespace App\Providers;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\EloquentCategoryRepository;
use App\Repositories\Wine\WineRepositoryInterface;
use App\Repositories\Wine\EloquentWineRepository;
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
    }


    public function boot(): void
    {
        //
    }
}
