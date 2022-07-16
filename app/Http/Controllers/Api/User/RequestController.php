<?php

namespace App\Http\Controllers\Api\User;

use App\Enums\BukkenStructure;
use App\Enums\BukkenType;
use App\Enums\StatusCode;
use App\Models\Prefecture;
use App\Repositories\Request\RequestInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RequestController extends Controller
{
    private $requestInf;
    public function __construct(RequestInterface $requestInf)
    {
        $this->requestInf = $requestInf;
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
     *      path="/api/v1/user/request",
     *      tags={"User Request"},
     *      summary="store request",
     *      security={{"BearerAuth":{}}},
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="aaaaaaaaaa"
     *              ),
     *              @OA\Property(
     *                  property="prefecture_id",
     *                  type="integer",
     *                  example=1
     *              ),
     *              @OA\Property(
     *                  property="city",
     *                  type="string",
     *                  example="Ha Noi"
     *              ),
     *              @OA\Property(
     *                  property="price_lower",
     *                  type="integer",
     *                  example=111111
     *              ),
     *              @OA\Property(
     *                  property="price_upper",
     *                  type="integer",
     *                  example=1111111
     *              ),
     *              @OA\Property(
     *                  property="revenue_yield",
     *                  type="integer",
     *                  example=111
     *              ),
     *              @OA\Property(
     *                  property="construction_year",
     *                  type="integer",
     *                  example=1999
     *              ),
     *              @OA\Property(
     *                  property="walkrange",
     *                  type="integer",
     *                  example=111
     *              ),
     *              @OA\Property(
     *                  property="comment",
     *                  type="string",
     *                  example="comment"
     *              ),
     *              @OA\Property(
     *                  property="bukkent_type[0]",
     *                  type="int",
     *                  example=1
     *              ),
     *              @OA\Property(
     *                  property="bukkent_type[1]",
     *                  type="int",
     *                  example=3
     *              ),
     *              @OA\Property(
     *                  property="bukkent_structures[0]",
     *                  type="int",
     *                  example=1
     *              ),
     *              @OA\Property(
     *                  property="bukkent_structures[1]",
     *                  type="int",
     *                  example=2
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
     *         response=400,
     *         description="Bad Request"
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     **/
    public function store(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData, [
            'name' => 'required|max:255',
            'prefecture_id' => [
                'required',
                'integer',
                Rule::in(Prefecture::pluck('id'))
            ],
            'city' => 'required|max:255|string',
            'price_lower' => 'required|integer',
            'price_upper' => 'required|integer',
            'revenue_yield' => 'required|integer',
            'construction_year' => 'required|integer',
            'walkrange' => 'required|integer',
            'comment' => 'required|string|max:5000',
            'bukken_type' => 'array',
            'bukken_type.*' => [
                'required',
                'integer',
                Rule::in(BukkenType::getValues())
            ],
            'bukken_structures' => [
                'present',
                'array',
                'min:1'
            ],
            'bukken_structures.*' => [
                'required',
                'integer',
                Rule::in(BukkenStructure::getValues())
            ],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => array_combine($validator->errors()->keys(), $validator->errors()->all()),
                'status_code' => StatusCode::BAD_REQUEST
            ], StatusCode::OK);
        }
        if($this->requestInf->store($request)){
            return response()->json([
                "message" => "成功",
                "status_code" => StatusCode::OK
            ], StatusCode::OK);
        }
        return response()->json([
            "message" => "エラーがあります",
            "status_code" => StatusCode::INTERNAL_ERR
        ], StatusCode::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
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
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
