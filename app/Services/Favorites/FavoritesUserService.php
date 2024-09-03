<?php

namespace App\Services\Favorites;

use App\Models\Favorites;
use App\Services\Favorites\Dto\FavoritesItemDto;
use App\Services\Favorites\FavoritesService;
use Illuminate\Http\Request;

class FavoritesUserService implements FavoritesService
{

    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function add(int $productId)
    {
        $favorites =  $this->getFavoriteItem($productId);

        if ($favorites === null)
        {
            Favorites::create([
                'product_id' =>  $productId,
                'user_id' =>  $this->getUserId(),
            ]);
        }
        else {
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(int $productId)
    {
        $favorite =  $this->getFavoriteItem($productId);

        $favorite?->delete();

        return response()->json(['success' => true]);
    }

    public function clear()
    {
        $favoriteItems = $this->getFavoritesItems();

        if ($favoriteItems != null) {
            Favorites::where('user_id', $this->getUserId())->delete();
        }

        return response()->json(['success' => true]);
    }

    private function getUserId() : int
    {
        return $this->request->user()->id;
    }

    private function getFavoriteItem(int $productId) : ?Favorites
    {
        return Favorites::where('product_id', $productId)->where( 'user_id',  $this->getUserId())->first();
    }

    public function getFavoritesItems() : array
    {
        $favorites = Favorites::with('product')->where( 'user_id',  $this->getUserId())->get();

        $favoritesItemDtoList = [];

        foreach ($favorites as $favorite)
        {
            $favoritesItemDtoList[] = new FavoritesItemDto($favorite->product);
        }

        return $favoritesItemDtoList;
    }

}
