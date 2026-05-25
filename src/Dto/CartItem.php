<?php

namespace App\Dto;

class CartItem
{
    public function __construct(
        private int $productId,
        private string $name,
        private float $price,
        private int $quantity = 1,
        private ?string $image = null
    ) {}

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function toArray(): array
    {
        return [
            'productId' => $this->productId,
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'image' => $this->image,
        ];
    }
}
