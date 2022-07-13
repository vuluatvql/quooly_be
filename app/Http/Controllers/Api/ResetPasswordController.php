<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusCode;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   int $id
     * @return \Illuminate\Http\Response
     */

    /**
     *  @OA\Put(
     *      path="/api/v1/reset-password",
     *      tags={"reset-password"},
     *      summary="resert-password update",
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="token",
     *                  type="string",
     *                  example="ahgajhakdhuwdgghgca"
     *              ),
     *          ),
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  example="12345"
     *              ),
     *          ),
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="re_password",
     *                  type="string",
     *                  example="12345"
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
        $validator = Validator::make($request->all(), [
            'token' => 'required|max:255',
            'password' => 'required|max:16|min:8|regex:/^[A-Za-z0-9]*$/',
            're_password' => 'required_with:password|same:password|max:16|min:8|regex:/^[A-Za-z0-9]*$/'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                // 'message' => array_combine($validator->errors()->keys(), $validator->errors()->all()),
                'status_code' => StatusCode::BAD_REQUEST
            ], StatusCode::OK);
        };
        if ($this->user->updatePasswordByToken($request, $request->token)) {
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
