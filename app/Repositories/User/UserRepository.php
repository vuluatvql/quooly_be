<?php

namespace App\Repositories\User;

use App\Enums\UserRole;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserOptional;
use App\Http\Controllers\BaseController;
use App\Mail\ForgotPassword;
use App\Mail\ForgotPassComplete;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseController implements UserInterface
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUsers($request)
    {
        $newSizeLimit = $this->newListLimit($request);
        $userBuilder = $this->user;
        if (isset($request['search_input'])) {
            $userBuilder = $userBuilder->where(function ($q) use ($request) {
                $q->orWhere($this->escapeLikeSentence('name', $request['search_input']));
                $q->orWhere($this->escapeLikeSentence('email', $request['search_input']));
            });
        }
        $users = $userBuilder->sortable(['created_at' => 'desc', 'status' => 'desc'])->paginate($newSizeLimit);
        if ($this->checkPaginatorList($users)) {
            Paginator::currentPageResolver(function () {
                return 1;
            });
            $users = $userBuilder->paginate($newSizeLimit);
        }
        return $users;
    }

    public function destroy($id)
    {
        $userInfo = $this->user->where('id', $id)->first();
        if (!$userInfo) {
            return false;
        }
        if ($userInfo->delete()) {
            return true;
        }
        return false;
    }
    public function checkEmail($request)
    {
        return !$this->user->where(function ($query) use ($request) {
            if (isset($request['id'])) {
                $query->where('id', '!=', $request["id"]);
            }
            $query->where(['email' => $request["value"]]);
        })->exists();
    }
    public function store($request)
    {
        $user = new $this->user();
        $user->role_id = UserRole::USER;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->first_name_furigana = $request->first_name_furigana;
        $user->last_name_furigana = $request->last_name_furigana;
        $user->email = $request->email;
        $user->birthday = $request->birthday;
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        $user->postcode = $request->postcode;
        $user->prefecture_id = $request->prefecture_id;
        $user->city = $request->city;
        $user->address = $request->address;
        $userOptional = new UserOptional();
        $userOptional->jobs_type = $request->jobs_type;
        $userOptional->company_industry_type = $request->company_industry_type;
        $userOptional->rent_income = $request->rent_income;
        $userOptional->annual_income = $request->annual_income;
        $userOptional->user_income = $request->user_income;
        $userOptional->property_building = $request->property_building;
        $userOptional->property_kodate_chintai = $request->property_kodate_chintai;
        $userOptional->favorite_noti_flag = $request->favorite_noti_flag;
        $userOptional->seminar_noti_flag = $request->seminar_noti_flag;
        try {
            if (!$user->save()) {
                return false;
            }
            $userOptional->user_id = $user->id;
            if (!$userOptional->save()) {
                return false;
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
        }
        DB::rollBack();
        return false;
    }
    public function getById($id)
    {
        return $this->user->where('id', $id)->first();
    }
    public function update($request, $id)
    {
        $userInfo = $this->user->where('id', $id)->first();
        if (!$userInfo) {
            return false;
        }
        $userInfo->name = $request->name;
        $userInfo->email = $request->email;
        if ($request->password) {
            $userInfo->password = Hash::make($request->password);
        }
        return $userInfo->save();
    }

    public function updateLastLogin($id)
    {
        $currentUser = $this->user->where('id', $id)->first();
        if (!$currentUser) {
            return false;
        }
        $currentUser->last_login_at = Carbon::now();
        return $currentUser->save();
    }
    public function getByEmail($request)
    {
        return $this->user->where('email', $request->email)->first();
    }
    public function generalResetPass($request)
    {
        $account = $this->user->where('email', $request->email)->first();
        if (!$account) {
            return false;
        }
        $account->reset_password_token = md5($request->email . random_bytes(25) . Carbon::now());
        $account->reset_password_token_expire = Carbon::now()->addMinutes(env('EXPIRE_TOKEN_RESET_PASSWORD', 30));
        if (!$account->save()) {
            return false;
        }
        switch ($account->role_id)
        {
            case UserRole::USER:
                $link = env('SITE_USER_URL') . '/password-reset/' . $account->reset_password_token;
                break;

            case UserRole::BESINESS:
                $link = env('SITE_BUSINESS_URL') . '/password-reset/' . $account->reset_password_token;
                break;

            default:
                $link = route('password_reset.show', $account->reset_password_token);
                break;
        }
        $mailContents = [
            'data' => [
                'name' => $account->name,
                'link' => $link
            ]
        ];
        Mail::to($account->email)->send(new ForgotPassword($mailContents));
        return true;
    }
    public function getUserByEmail($email)
    {
        return $this->user->where('email', $email)->first();
    }

    public function getUserByToken($token)
    {
        return $this->user->where([
            ['reset_password_token', $token],
            ['reset_password_token_expire', '>=', Carbon::now()]
        ])->first();
    }
    public function updatePasswordByToken($request, $token)
    {
        $account = $this->getUserByToken($token);
        if (!$account) {
            return false;
        }
        $account->password = Hash::make($request->password);
        $account->reset_password_token = null;
        $account->reset_password_token_expire = null;
        if (!$account->save()) {
            return false;
        }
        $mailContents = [
            'name' => $account->name,
            'mail' => $account->email,
        ];
        Mail::to($account->email)->send(new ForgotPassComplete($mailContents));
        return true;
    }
}
