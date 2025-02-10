<?php

namespace App\Traits;

trait CartActions
{
    public function addProductToCart(): void
    {      //mandamos el id del vino al carrito//
        $wineId = request()->input('wine_id');
        $quantity = request()->input('quantity', 1);

        $wine = $this->repository->find($wineId);
        $this->cart->add($wine, $quantity);
        session()->flash('success', 'El vino '. $wine->name.' ha sido añadido al carrito.');
    }

    public function incrementProductQuantity(): void
    {
        $wine = $this->repository->find(request('wine_id'));

        try {
            $this->cart->increment($wine);
            session()->flash('success', 'La cantidad de '. $wine->name.' ha sido incrementada en 1.');
        } catch (\Exception $e) {  //caso en que no quede mas stock que añadir del vino//
            session()->flash('error', $e->getMessage());
        }
    }

    public function decrementProductQuantity(): void
    {
        $this->cart->decrement(request('wine_id'));
        session()->flash('success', 'La cantidad ha sido decrementada en 1.');
    }

    public function removeProduct(): void
    {
        $this->cart->remove(request('wine_id'));
        session()->flash('success', 'El vino ha sido eliminado del carrito.');
    }

    public function clearCart(): void
    {
        $this->cart->clear();
        session()->flash('success', 'El carrito ha sido vaciado.');
    }
}
