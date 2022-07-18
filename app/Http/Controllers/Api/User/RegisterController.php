<?php

namespace App\Http\Controllers\Api\User;

use App\Enums\UserRole;
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

class RegisterController extends Controller
{
    private $user;
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     *  @OA\Post(
     *      path="/api/v1/user/register",
     *      tags={"User Register"},
     *      summary="Register User",
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
     *                  property="re_email",
     *                  type="string",
     *                  example="user@gmail.com"
     *              ),
     *              @OA\Property(
     *                  property="phone_number",
     *                  type="string",
     *                  example="01-1234-5678"
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'first_name_furigana' => 'required|max:255|regex:/^[ぁ-ん]+$/',
            'last_name_furigana' => 'required|max:255|regex:/^[ぁ-ん]+$/',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->whereNull('deleted_at')
            ],
            're_email' => 'required|email|max:255|same:email',
            'phone_number' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'status_code' => StatusCode::BAD_REQUEST
            ], StatusCode::OK);
        }
        $request->role_id = UserRole::USER;
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
        if (!$this->user->register($request)) {
            return response()->json([
                'message' => 'エラーが発生しました。',
                'status_code' => StatusCode::INTERNAL_ERR
            ], StatusCode::OK);
        }
        return response()->json([
            'message' => 'ユーザーの新規作成が完了しました。',
            'status_code' => StatusCode::OK
        ], StatusCode::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
