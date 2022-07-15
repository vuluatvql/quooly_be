<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusCode;
use App\Enums\UserRole;
use Illuminate\Routing\Controller;
use App\Repositories\User\UserInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use JWTAuth;

class ChangePasswordController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    /**
     *  @OA\PUT(
     *      path="/api/v1/change-password",
     *      tags={"Login"},
     *      summary="change password",
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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|max:16|min:8|regex:/^[A-Za-z0-9]*$/',
            're_password' => 'required_with:password|same:password|max:16|min:8|regex:/^[A-Za-z0-9]*$/'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => array_combine($validator->errors()->keys(), $validator->errors()->all()),
                'status_code' => StatusCode::BAD_REQUEST
            ], StatusCode::OK);
        };
        if ($this->user->changePassword($request)) {
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
