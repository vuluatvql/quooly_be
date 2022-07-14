<?php

namespace App\Http\Controllers\Api\User;

use App\Enums\BukkenType;
use App\Repositories\ViewHistory\ViewHistoryInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Enums\StatusCode;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ViewHistoryController extends Controller
{
    private $viewHistory;

    public function __construct(ViewHistoryInterface $viewHistory)
    {
        $this->viewHistory = $viewHistory;
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
     *      path="/api/v1/user/view-history",
     *      tags={"User ViewHistory"},
     *      summary="ViewHistory store",
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="bukken_id",
     *                  type="int",
     *                  example=1
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
            'bukken_id' => [
                'required',
                Rule::in(BukkenType::getValues())
            ]
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => array_combine($validator->errors()->keys(), $validator->errors()->all()),
                'status_code' => StatusCode::BAD_REQUEST
            ], StatusCode::OK);
        }

        if($this->viewHistory->store($request)){
            return response()->json([
                'message' => 'より多くの成功の歴史',
                'status_code' => StatusCode::OK,
            ], StatusCode::OK);
        }
        return response()->json([
            'message' => 'より多くの成功の歴史',
            'status_code' => StatusCode::INTERNAL_ERR,
        ], StatusCode::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $viewHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
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
     * @param  Request  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
