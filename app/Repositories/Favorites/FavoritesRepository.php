<?php

namespace App\Repositories\Favorites;

use App\Models\Favorites;
use App\Http\Controllers\BaseController;
use App\Repositories\Favorites\FavoritesInterface;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class FavoritesRepository extends BaseController implements FavoritesInterface
{
    private $favorites;

    public function __construct(Favorites $favorites)
    {
        $this->favorites = $favorites;
    }

    public function get($request)
    {
        return Favorites::all();
    }

    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    public function store($request)
    {
        $favoriteInfo = $this->favorites->where([
            ['user_id',JWTAuth::user()->id],
            ['bukken_id', $request->bukken_id]
        ])->first();
        if ($favoriteInfo) {
            return $favoriteInfo->delete();
        }
        $favoriteInfo = new $this->favorites();
        $favoriteInfo->bukken_id = $request->bukken_id;
        $favoriteInfo->user_id = JWTAuth::user()->id;
        return $favoriteInfo->save();
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
