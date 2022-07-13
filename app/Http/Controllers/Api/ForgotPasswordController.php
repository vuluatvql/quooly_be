<?php
namespace App\Http\Controllers\Api;


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
     *      path="/api/v1/forgot_password",
     *      tags={"Forgot password"},
     *      summary="Forgot password for User + Busineess",
     *      security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              @OA\Property(
     *                  property="email",
     *                  type="string"
     *              ),
     *              example={"email": "user@gmail.com"}
     *          )
     *      )
     *  ),
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
        ], [
            'email.required' => 'メールフィールドは必須です。',
            'email.email' => 'メールは有効なメールアドレスである必要があります。',
            'email.max' => '電子メールは255文字を超えてはなりません。',
            'email.exists' => 'メールでユーザーを見つけることができません。'
        ]);
        if ($validator->fails()) {
            $message = array_combine($validator->errors()->keys(), $validator->errors()->all());
            return response()->json($message, StatusCode::NOT_FOUND);
        }
        if (!$this->user->generalResetPass($request)) {
            return response()->json([
                'status_code' => StatusCode::NOT_FOUND,
                'message' => 'メールでユーザーを見つけることができません。',
            ], StatusCode::NOT_FOUND);
        }
        return response()->json([
            'status_code' => StatusCode::OK,
        ], StatusCode::OK);

    }
}
