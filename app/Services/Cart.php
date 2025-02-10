<?php

namespace App\Services;

use App\Repositories\Cart\CartRepositoryInterface;
use App\Models\Wine;
use Illuminate\Support\Collection;

//Desde esta clase vamos a encapsular el acceso al SessionCartRepository //
final readonly class Cart
{

    public function __construct(private readonly CartRepositoryInterface $repository)
    {}


    public function add(Wine $wine, int $quantity = 1): void
    {
        $this->repository->add($wine, $quantity);
    }

    /**
     * @throws \Exception
     */

    public function increment(Wine $wine): void
    {
        $this->repository->increment($wine);
    }


    public function decrement(int $wineId): void
    {
        $this->repository->decrement($wineId);
    }

    public function remove(int $wineId): void
    {
        $this->repository->remove($wineId);
    }


    public function clear(): void
    {
        $this->repository->clear();
    }

    public function getTotalQuantityForWine(Wine $wine): int
    {
        return $this->repository->getTotalQuantityForWine($wine);
    }

    public function getTotalCostForWine(Wine $wine, bool $formatted = false): float|string
    {
        return $this->repository->getTotalCostForWine($wine, $formatted);
    }

    public function getTotalQuantity(): int
    {
        return $this->repository->getTotalQuantity();
    }

    public function getTotalCost(bool $formatted = false): float|string
    {
        return $this->repository->getTotalCost($formatted);
    }

    public function hasProduct(Wine $wine): bool
    {
        return $this->repository->hasProducts($wine);
    }

    public function getCart(): Collection
    {
        return $this->repository->getCart();
    }


    //de esta forma abstraemos la logica del repositorio//
}
