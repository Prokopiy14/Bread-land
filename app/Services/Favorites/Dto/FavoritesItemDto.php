<?php

namespace App\Services\Favorites\Dto;

use App\Models\Product;

class FavoritesItemDto
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
