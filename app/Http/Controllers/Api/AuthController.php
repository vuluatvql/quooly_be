<?php

namespace App\Http\Controllers\Api;

use App\Models\KonamiUser;
use App\Enums\StatusCode;
use App\Repositories\User\UserInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Routing\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;

/** @OA\Info(title="Quooli App API", version="1.0.0")
 * @OA\SecurityScheme(securityScheme="bearerAuth", type="http", scheme="bearer", bearerFormat="JWT")*/
class AuthController extends Controller
{
    private $user;
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     *  @OA\Post(
     *      path="/api/v1/login",
     *      tags={"Login"},
     *      summary="Login",
     *      security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              @OA\Property(
     *                  property="email",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string"
     *              ),
     *              example={"email": "admin@gmail.com", "password": "12345678"}
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
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|max:15|min:8|regex:/^[A-Za-z0-9]*$/'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => array_combine($validator->errors()->keys(), $validator->errors()->all()),
                'status_code' => StatusCode::BAD_REQUEST
            ], StatusCode::OK);
        }
        try {
            $credentials = $request->only('email', 'password');
            $token = JWTAuth::attempt($credentials);
            if (!$token) {
                return response()->json([
                    'message' => 'ユーザー名とパスワードが一致しません。',
                    'status_code' => StatusCode::BAD_REQUEST
                ], StatusCode::OK);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'message' => 'トークンの作成に失敗しました',
                'status_code' => StatusCode::BAD_REQUEST
            ], StatusCode::OK);
        }
        $this->user->updateLastLogin(JWTAuth::user()->id);
        return response()->json([
            'data' => [
                'token' => $token,
            ],
            'status_code' => StatusCode::OK
        ], StatusCode::OK);
    }

    /**
     *  @OA\Post(
     *      path="/api/v1/logout",
     *      tags={"Login"},
     *      summary="logout",
     *      security={{"bearerAuth":{}}},
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
    public function logout(Request $request)
    {
        auth()->logout(true);
        return response()->json(['message' => 'ユーザーが正常にログアウトしました', 'status_code' => StatusCode::OK], StatusCode::OK);
    }


    /**
     *  @OA\GET(
     *      path="/api/v1/user_info",
     *      tags={"Login"},
     *      summary="get current user info",
     *      security={{"bearerAuth":{}}},
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

    public function user()
    {
        return response()->json([
            'data' => JWTAuth::user(),
            'status_code' => StatusCode::OK
        ], StatusCode::OK);
    }


    public function refresh()
    {
        try {
            if (JWTAuth::getToken()) {
                JWTAuth::checkOrFail();
            }
            JWTAuth::authenticate();
            return response()->json([
                'status_code' => StatusCode::OK,
                'token' => JWTAuth::refresh(),
            ], StatusCode::OK);
        } catch (JWTException $e) {
            try {
                JWTAuth::setToken(JWTAuth::refresh(true, true));
                JWTAuth::authenticate();
                return response()->json([
                    'status_code' => StatusCode::OK,
                    'token' => JWTAuth::refresh(),
                ], StatusCode::OK);
            } catch (\Throwable $th) {
                return response()->json([
                    // 'user' => $user->profile(),
                    'status_code' => StatusCode::FORBIDDEN,
                    'message' => 'トークンの有効期限が切れており、ファイルで更新できなくなりました',
                ], StatusCode::FORBIDDEN);
            }
        }
    }


}
