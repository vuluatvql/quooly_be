<?php

namespace App\Http\Controllers\Api\User;


use App\Enums\MailNoti;
use App\Enums\IndustryType;
use App\Enums\JobType;
use App\Models\Prefecture;
use App\Repositories\User\UserInterface;
use App\Enums\StatusCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class ProfileController extends Controller
{
    private $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * @OA\Put(
     *      path="/api/v1/user/profile/{id}",
     *      tags={"User Profile"},
     *      summary="Update profile user",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="first_name",
     *                  type="string",
     *                  example="nguyen van"
     *              ),
     *              @OA\Property(
     *                  property="last_name",
     *                  type="string",
     *                  example="A"
     *              ),
     *              @OA\Property(
     *                  property="first_name_furigana",
     *                  type="string",
     *                  example="ル"
     *              ),
     *              @OA\Property(
     *                  property="last_name_furigana",
     *                  type="string",
     *                  example="ビ"
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *                  example="user@gmail.com"
     *              ),
     *              @OA\Property(
     *                  property="birthday",
     *                  type="date",
     *                  example="1993/01/01"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  example="12345678"
     *              ),
     *              @OA\Property(
     *                  property="phone_number",
     *                  type="string",
     *                  example="01-1234-5678"
     *              ),
     *              @OA\Property(
     *                  property="postcode",
     *                  type="string",
     *                  example="135-0064"
     *              ),
     *              @OA\Property(
     *                  property="prefecture_id",
     *                  type="integer",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="city",
     *                  type="string",
     *                  example="HANOI"
     *              ),
     *              @OA\Property(
     *                  property="address",
     *                  type="string",
     *                  example="UNG HOA"
     *              ),
     *              @OA\Property(
     *                  property="jobs_type",
     *                  type="integer",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="company_industry_type",
     *                  type="integer",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="rent_income",
     *                  type="integer",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="annual_income",
     *                  type="integer",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="user_income",
     *                  type="integer",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="property_building",
     *                  type="integer",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="property_division",
     *                  type="integer",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="property_kodate_chintai",
     *                  type="integer",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="favorite_noti_flag",
     *                  type="integer",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="seminar_noti_flag",
     *                  type="integer",
     *                  example="1"
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error"
     *      ),
     *  )
     **/
    public function update(Request $request, $id)
    {
        $currentUser = JWTAuth::toUser();
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'first_name_furigana' => 'required|max:255|regex:/^[ぁ-ん]+$/',
            'last_name_furigana' => 'required|max:255|regex:/^[ぁ-ん]+$/',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->whereNull('deleted_at')->ignore($currentUser->id)
            ],
            'birthday' => 'required|date_format:Y/m/d|before_or_equal:' . Carbon::now()->format('Y/m/d'),
            'password' => 'nullable|max:16|min:8|regex:/^[A-Za-z0-9]*$/',
            'phone_number' => 'required',
            'postcode' => 'required|max:10',
            'prefecture_id' => [
                'required',
                Rule::in(Prefecture::pluck('id'))
            ],
            'city' => 'required|max:255',
            'address' => 'required|max:255',
            'jobs_type' => [
                'required',
                'integer',
                Rule::in(JobType::getValues())
            ],
            'company_industry_type' => [
                'required',
                'integer',
                Rule::in(IndustryType::getValues())
            ],
            'rent_income' => 'required|integer',
            'annual_income' => 'required|integer',
            'user_income' => 'required|integer',
            'property_building' => 'required|integer',
            'property_division' => 'required|integer',
            'property_kodate_chintai' => 'required|integer',
            'favorite_noti_flag' => [
                'required',
                Rule::in(MailNoti::getValues())
            ],
            'seminar_noti_flag' => [
                'required',
                Rule::in(MailNoti::getValues())
            ],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'status_code' => StatusCode::BAD_REQUEST
            ], StatusCode::OK);
        }
        if ($request->phone_number && $request->phone_number != null) {
            $regexTelephone = "/^0(\d-\d{4}-\d{4})$/";
            $regexTelephone1 = "/^0(\d{3}-\d{2}-\d{4})$/";
            $regexTelephone2 = "/^0(\d{2}-\d{3}-\d{4})$/";
            $regexTelephone3 = "/^(070|080|090|050)(-\d{4}-\d{4})$/";
            if (!preg_match($regexTelephone, $request->phone_number) && !preg_match($regexTelephone1, $request->phone_number) && !preg_match($regexTelephone2, $request->phone_number) && !preg_match($regexTelephone3, $request->phone_number)) {
                return response()->json([
                    'message' => 'The last name phone_number format is invalid.',
                    'status_code' => StatusCode::BAD_REQUEST
                ], StatusCode::OK);
            }
        }

        if (!$this->user->update($request, $currentUser->id)) {
            return response()->json([
                'message' => 'エラーが発生しました。',
                'status_code' => StatusCode::INTERNAL_ERR
            ], StatusCode::OK);
        }
        return response()->json([
            'message' => 'ユーザーの変更が完了しました。',
            'status_code' => StatusCode::OK
        ], StatusCode::OK);

    }

}
