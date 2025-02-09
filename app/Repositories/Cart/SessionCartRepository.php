<?php
namespace App\Repositories\Cart;

use App\Models\Wine;
use App\Traits\WithCurrencyFormatter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class SessionCartRepository implements CartRepositoryInterface
{
    use WithCurrencyFormatter;
    const SESSION = 'cart';

    public function __construct()
    {
        if (!session::has(self::SESSION))
        {
            session::put(self::SESSION, collect());
        }
    }

    public function add(Wine $wine, int $quantity): void
    {
        $cart = $this->getCart();

        if ($cart->has($wine->id))
        {
            $cart->get($wine->id)['quantity'] += $quantity;
        } else {
            $cart->put($wine->id, [
                'product' => $wine,
                'quantity' => $quantity]);
        }

        $this->updateCart($cart);
    }

    public function increment(Wine $wine): void
    {
        $cart = $this->getCart();

        if (data_get($cart->get($wine->id), 'quantity') >= $wine->stock)
        {
            throw new \Exception('No hay stock suficiente para incrementar la cantidad de ' . $wine->name);
        }


        $wineInCart = $cart->get($wine->id);
        $wineInCart['quantity']++;
        $cart->put($wine->id, $wineInCart);
        $this->updateCart($cart);
    }

    public function decrement(int $wineId): void
    {
        $cart = $this->getCart();

        if ($cart->has($wineId))
        {
            $wineInCart = $cart->get($wineId);
            $wineInCart['quantity']--;
            $cart->put($wineId, $wineInCart);
        }

        if (data_get($cart->get($wineId), 'quantity') <= 0)
        {
            $cart->forget($wineId);
        }

            $this->updateCart($cart);
        }


    public function remove(int $wineId): void
    {
        $cart = $this->getCart();

        $cart->forget($wineId);

        $this->updateCart($cart);
    }

    public function getTotalQuantityForWine(Wine $wine): int
    {
        $cart = $this->getCart();

        if ($cart->has($wine->id))
        {
            return data_get($cart->get($wine->id), 'quantity');
        }

        return 0;
    }

    public function getTotalCostForWine(Wine $wine, bool $formatted): float|string
    {
        $cart = $this->getCart();

        $total = 0;

        if ($cart->has($wine->id))
        {
            $total = data_get($cart->get($wine->id), 'quantity') * $wine->price;
        }

        return $formatted ? $this->formatCurrency($total) : $total;
    }

    public function getTotalQuantity(): int
    {
        $cart = $this->getCart();

        return $cart->sum('quantity');//suma todos los productos en el carrito(la cantidad)//
    }

    public function getTotalCost(bool $formatted): float|string
    {
        $cart = $this->getCart();

        $total = $cart->sum(function ($item)
        {
            return data_get($item, 'quantity') * data_get($item, 'product.price'); //accede a la columna del precio//
        });

        return $formatted? $this->formatCurrency($total) : $total;
    }

    public function hasProducts(Wine $wine): bool
    {
        $cart = $this->getCart();

        return $cart->has($wine->id);
    }

    public function getCart(): Collection
    {
        return session::get(self::SESSION);
    }

    public function isEmpty(): bool
    {
        return $this->getTotalQuantity() == 0; //comprueba si el carrito esta vacio//
    }

    public function clear(): void
    {
        session::forget(self::SESSION); //elimina el carrito//
    }




    //metodo privado para actualizar el carrito en la sesion e ir pudiendo ver actualizaciones en la propia vista carritos//
    private function updateCart(Collection $cart): void
    {
        session::put(self::SESSION, $cart);
    }
    //se llama cada vez que se necesita actualizar el carrito(funcion de añadir, incrementar ...) //
}
