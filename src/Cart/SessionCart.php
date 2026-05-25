<?php

namespace App\Cart;

use App\Dto\CartItem;
use Symfony\Component\HttpFoundation\RequestStack;

class SessionCart implements CartInterface
{
    private const CART_KEY = 'cart';

    public function __construct(
        private RequestStack $requestStack
    ) {}

    public function add(CartItem $item): void
    {
        $session = $this->requestStack->getSession();
        $cart = $session->get(self::CART_KEY, []);

        $productId = $item->getProductId();

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $item->getQuantity();
        } else {
            $cart[$productId] = $item->toArray();
        }

        $session->set(self::CART_KEY, $cart);
    }

    public function remove(int $productId): void
    {
        $session = $this->requestStack->getSession();
        $cart = $session->get(self::CART_KEY, []);

        unset($cart[$productId]);

        $session->set(self::CART_KEY, $cart);
    }

    public function getItems(): array
    {
        return $this->requestStack->getSession()->get(self::CART_KEY, []);
    }

    public function clear(): void
    {
        $this->requestStack->getSession()->remove(self::CART_KEY);
    }

    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->getItems() as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }
}
