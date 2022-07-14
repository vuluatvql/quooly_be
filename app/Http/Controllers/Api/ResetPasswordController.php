<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserRole;
use App\Enums\StatusCode;
use App\Repositories\User\UserInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ResetPasswordController extends Controller
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

    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserInterface  $user
     * @return \Illuminate\Http\Response
     */
    public function show(UserInterface $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserInterface  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(UserInterface $user)
    {
        //
    }

    /**
     *  @OA\Put(
     *      path="/api/v1/reset-password/{token}",
     *      tags={"Login"},
     *      summary="reset password",
     *      @OA\Parameter(
     *          name="token",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="cd7db2109832f426bac49b4838ffafd1"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  example="12345678"
     *              ),
     *              @OA\Property(
     *                  property="re_password",
     *                  type="string",
     *                  example="12345678"
     *              ),
     *          ),
     *      ),
     *  @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *  ),
     *  @OA\Response(
     *      response=400,
     *      description="Invalid request"
     *  ),
     * @OA\Response(
     *      response=401,
     *      description="Unauthorized"
     *  ),
     *  @OA\Response(
     *      response=500,
     *      description="Internal Server Error"
     *  ),
     *  )
     **/
    public function update(Request $request, $token)
    {
        $dataRequest = $request->all();
        $dataRequest['reset_password_token'] = $token;
        $validator = Validator::make($dataRequest, [
            'reset_password_token' => [
                'required',
                'max:255',
                Rule::exists('users')->where(function ($query) use ($request) {
                    return $query->whereIn('role_id', [UserRole::BESINESS, UserRole::USER])->whereNull('deleted_at')->where('reset_password_token_expire', '>', Carbon::now());
                })
            ],
            'password' => 'required|max:16|min:8|regex:/^[A-Za-z0-9]*$/',
            're_password' => 'required_with:password|same:password|max:16|min:8|regex:/^[A-Za-z0-9]*$/'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => array_combine($validator->errors()->keys(), $validator->errors()->all()),
                'status_code' => StatusCode::BAD_REQUEST
            ], StatusCode::OK);
        };
        if ($this->user->updatePasswordByToken($request, $token)) {
            return response()->json([
                'message' => 'パスワードのリセット成功',
                'status_code' => StatusCode::OK,
            ], StatusCode::OK);
        }
        return response()->json([
            'message' => "トークンが無効です",
            'status_code' => StatusCode::BAD_REQUEST
        ], StatusCode::OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserInterface  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserInterface $user)
    {
        //
    }
}
