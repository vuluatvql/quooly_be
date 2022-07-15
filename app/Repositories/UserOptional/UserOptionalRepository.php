<?php

namespace App\Repositories\UserOptional;

use App\Models\UserOptional;
use App\Http\Controllers\BaseController;
use App\Repositories\UserOptional\UserOptionalInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserOptionalRepository extends BaseController implements UserOptionalInterface
{
    private $userOptional;
    public function __construct(UserOptional $userOptional)
    {
        $this->userOptional = $userOptional;
    }

    public function index()
    {
        // todo
    }

    public function destroy($id)
    {
        $userInfo = $this->userOptional->where('id', $id)->where('user_id', JWTAuth::user()->id)->first();
        if (!$userInfo) {
            return false;
        }
        if ($userInfo->delete()) {
            return true;
        }
        return false;
    }

    public function store($request)
    {
        // todo
    }
    public function getById($id)
    {
        return $this->userOptional->where('id', $id)->first();
    }

    public function update($request, $id)
    {
        $userOptionInfo = $this->userOptional->where('user_id', JWTAuth::user()->id)->first();
        if (!$userOptionInfo) {
            return false;
        }
        $userOptionInfo->mail_magazine_flag = $request->mail_magazine_flag;
        $userOptionInfo->request_noti_flag = $request->request_noti_flag;
        $userOptionInfo->favorite_noti_flag = $request->favorite_noti_flag;
        $userOptionInfo->seminar_noti_flag = $request->seminar_noti_flag;
       
        return $userOptionInfo->save();
    }
}
