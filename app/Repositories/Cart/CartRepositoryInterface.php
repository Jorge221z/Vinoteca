<?php

namespace App\Repositories\Cart;

use App\Models\Wine;
use Illuminate\Support\Collection;

interface CartRepositoryInterface
{

    public function add(Wine $wine, int $quantity): void;


    public function increment(Wine $wine):void;
    //le pasamos el modelo para comprobar si hay stock suficiente
    public function decrement(int $wineId): void;
    //aqui no haria falta porque siempre vamos a poder restar//

    public function remove(int $wineId): void;

    public function getTotalQuantityForWine(Wine $wine): int;
    //numero de productos en el carrito//

    public function getTotalCostForWine(Wine $wine, bool $formatted): float|string;

    public function getTotalQuantity(): int;

    public function getTotalCost(bool $formatted): float|string;

    public function hasProducts(Wine $wine): bool;
    //nos dice si un vino esta en el carrito o no//

    public function getCart(): Collection;
    //nos devuelve la coleccion con los productos del carrito//

    public function isEmpty(): bool;
    //comprueba si el carrito esta vacio o no//

    public function clear(): void;
    //vacia el carrito//
}
