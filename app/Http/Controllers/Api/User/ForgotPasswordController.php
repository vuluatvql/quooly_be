<?php

namespace App\Http\Controllers\Api\User;

use App\Enums\StatusCode;
use App\Enums\UserRole;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ForgotPasswordController extends Controller
{

    private $user;
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     *  @OA\Post(
     *      path="/api/v1/user/forgot-password",
     *      tags={"User Login"},
     *      summary="Forgot password",
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *                  example="user@gmail.com"
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'max:255',
                'email',
                Rule::exists('users')->where(function ($query) use ($request) {
                    return $query->whereIn('role_id', [UserRole::BESINESS, UserRole::USER])->whereNull('deleted_at');
                })
            ]
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => array_combine($validator->errors()->keys(), $validator->errors()->all()),
                'status_code' => StatusCode::BAD_REQUEST
            ], StatusCode::OK);
        }
        if (!$this->user->generalResetPass($request)) {
            return response()->json([
                'status_code' => StatusCode::NOT_FOUND,
                'message' => 'メールでユーザーを見つけることができません。',
            ], StatusCode::OK);
        }
        return response()->json([
            'status_code' => StatusCode::OK,
            'message' => '入力されたメールアドレスに確認メールを送信いたしました。メールの手順に沿ってパスワードを変更してください'
        ], StatusCode::OK);
    }
}
