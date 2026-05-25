<?php

namespace App\Cart;

use App\Dto\CartItem;

class ApiCart implements CartInterface
{
    public function add(CartItem $item): void
    {
        dd('API Cart: add product', $item);
    }

    public function remove(int $productId): void
    {
        dd('API Cart: remove product', $productId);
    }

    public function getItems(): array
    {
        dd('API Cart: get items');
    }

    public function clear(): void
    {
        dd('API Cart: clear cart');
    }

    public function getTotal(): float
    {
        dd('API Cart: get total');
    }
}
