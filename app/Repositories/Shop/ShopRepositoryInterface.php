<?php

namespace App\Repositories\Shop;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Wine;

interface ShopRepositoryInterface
{
    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function find(int $id): Wine;
}
