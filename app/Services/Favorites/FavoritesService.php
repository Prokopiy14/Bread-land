<?php

namespace App\Services\Favorites;

interface FavoritesService
{
    public function add(int $productId);

    public function destroy(int $productId);

    public function clear();

}
