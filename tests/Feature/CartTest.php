<?php

use App\Models\Category;
use App\Services\Cart;
use App\Models\Wine;

test('a product can be added to the cart', function () {

    $cart = app(Cart::class);

    $category = Category::create([
        'name' => 'Category 1',
        'slug' => 'category-1',
        'description' => 'Description 1',
        'image' => 'image-1.jpg',
    ]);

    $wine1 = Wine::create([
        'name' => 'Wine 1',
        'category_id' => $category->id,
        'price' => 5,
        'year' => 2022,
        'description' => 'description 2',
        'stock' => 10,
        'image' => 'image-2.jpg',
    ]);

    $wine2 = Wine::create([
        'name' => 'Wine 2',
        'category_id' => $category->id,
        'price' => 10,
        'year' => 2022,
        'description' => 'description 1',
        'stock' => 10,
        'image' => 'image-2.jpg',
    ]);



    $user = (App\Models\User::factory())->create(); //crea un usuario de prueba//
    $this->actingAs($user); //loguea al usuario//



    $this->post(route('shop.addToCart'), [
        'wine_id' => $wine1->id,
        'quantity' => 2,
    ]);


    expect($cart->isEmpty())->toBe(false)
        ->and($cart->getTotalQuantity())->toBe(2)
        ->and($cart->getTotalCost())->toBe(10.00)
        ->and($cart->getTotalQuantityForWine($wine1))->toBe(2)
        ->and($cart->getTotalCostForWine($wine1))->toBe(10.00);


    $this->post(route('shop.addToCart'), [
        'wine_id' => $wine2->id,
        'quantity' => 3,
    ]);

    expect($cart->isEmpty())->toBe(false)
    ->and($cart->getTotalQuantity())->toBe(5)
    ->and($cart->getTotalCost())->toBe(40.00)
    ->and($cart->getTotalQuantityForWine($wine2))->toBe(3)
    ->and($cart->getTotalCostForWine($wine2))->toBe(30.00);

})->group('feature-cart');
