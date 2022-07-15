<?php

namespace App\Http\Controllers\Api\User;

use App\Enums\MailNoti;
use App\Enums\StatusCode;
use App\Repositories\UserOptional\UserOptionalInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MailSettingController extends Controller
{
    private $userOptional;

    public function __construct(UserOptionalInterface $userOptional)
    {
        $this->userOptional = $userOptional;
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
     *  @OA\Put(
     *      path="/api/v1/user/mail-setting/id",
     *      tags={"Mail-Setting"},
     *      summary="Setting email notifications",
     *      
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="mail_magazine_flag",
     *                  type="int",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="request_noti_flag",
     *                  type="int",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="favorite_noti_flag",
     *                  type="int",
     *                  example="1"
     *              ),
     *              @OA\Property(
     *                  property="seminar_noti_flag",
     *                  type="int",
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
     * 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    **/
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'mail_magazine_flag' => [
                'required',
                'integer',
                Rule::in(MailNoti::getValues())
            ],
            'request_noti_flag' => [
                'required',
                'integer',
                Rule::in(MailNoti::getValues())
            ],
            'favorite_noti_flag' => [
                'required',
                'integer',
                Rule::in(MailNoti::getValues())
            ],
            'seminar_noti_flag' => [
                'required',
                'integer',
                Rule::in(MailNoti::getValues())
            ],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'status_code' => StatusCode::BAD_REQUEST
            ], StatusCode::OK);
        }
        $userOption = $this->userOptional->getById($id);
        if(empty($userOption)){
            return response()->json([
                'message' => "This user_option not exist!",
                'status_code' => StatusCode::BAD_REQUEST
            ], StatusCode::OK);
        }
        if($this->userOptional->update($request, $id)){
            return response()->json([
                'message' => "Success",
                'status_code' => StatusCode::OK
            ], StatusCode::OK);
        }
        return response()->json([
            'message' => "Internal Server Error",
            'status_code' => StatusCode::INTERNAL_ERR
        ], StatusCode::OK);
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
