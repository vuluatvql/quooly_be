<?php

namespace App\Repositories\Prefecture;

use App\Models\Prefecture;
use App\Http\Controllers\BaseController;
use App\Repositories\Prefecture\PrefectureInterface;
use JWTAuth;

class PrefectureRepository extends BaseController implements PrefectureInterface
{
    private Prefecture $prefectures;
    public function __construct(Prefecture $prefectures)
    {
        $this->prefectures = $prefectures;
    }

    public function getOption()
    {
        $prefectures = $this->prefectures->select('id as value', 'name as label')
            ->orderBy('order_num')
            ->get()
            ->toArray();

        return $prefectures;
    }
}
