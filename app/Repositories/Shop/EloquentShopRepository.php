<?php

namespace App\Repositories\Shop;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Wine;

class EloquentShopRepository implements ShopRepositoryInterface
{

    public function __construct()
    {
        //
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Wine::with('category')->paginate($perPage);
    }

    public function find(int $id): Wine
    {
        return wine::findOrFail($id);
    }
}
