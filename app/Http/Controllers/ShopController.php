<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Shop\ShopRepositoryInterface;
use App\Services\Cart;
use App\Traits\CartActions;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class ShopController extends Controller
{
    use CartActions;
    public function __construct(private readonly ShopRepositoryInterface $repository, private readonly Cart $cart)
    {}

    public function index(): View
    {
        $wines = $this->repository->paginate();

        return view('shop.index', compact('wines'));
    }

    public function addToCart(): RedirectResponse
    {
        $this->addProductToCart(); //lamada a la accion del trait CartActions//

        return redirect()->route('shop.index');
    }

    public function increment(): RedirectResponse
    {
        $this->incrementProductQuantity();

        return redirect()->route('shop.index');
    }

    public function decrement(): RedirectResponse
    {
        $this->decrementProductQuantity();

        return redirect()->route('shop.index');
    }

    public function remove(): RedirectResponse
    {
        $this->removeProduct();

        return redirect()->route('shop.index');
    }

}
