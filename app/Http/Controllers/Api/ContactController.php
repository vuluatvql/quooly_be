<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusCode;
use App\Repositories\Contact\ContactInterface;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $contact;

    public function __construct(ContactInterface $contact)
    {
        $this->contact = $contact;
    }

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
     *      path="/api/v1/contact",
     *      tags={"Contact"},
     *      summary="Contact store",
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="first_name",
     *                  type="string",
     *                  example="nguyen"
     *              ),
     *              @OA\Property(
     *                  property="last_name",
     *                  type="string",
     *                  example="xxx"
     *              ),
     *              @OA\Property(
     *                  property="first_name_furigana",
     *                  type="string",
     *                  example="お"
     *              ),
     *              @OA\Property(
     *                  property="last_name_furigana",
     *                  type="string",
     *                  example="ス"
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *                  example="xxx@gmail.com"
     *              ),
     *              @OA\Property(
     *                  property="content",
     *                  type="string",
     *                  example="abc"
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
            'email' => 'required|max:255|email',
            'content' => 'required|max:10000',
            'contact_type' => [
                'required',
                Rule::in(array_map(function ($e) {
                    return (string)$e;
                }, Gender::getValues()))
            ]
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => array_combine($validator->errors()->keys(), $validator->errors()->all()),
                'status_code' => StatusCode::BAD_REQUEST
            ], StatusCode::OK);
        }

        if (!$this->contact->store($request)) {
            return response()->json([
                'message' => 'エラーが発生しました。',
                'status_code' => StatusCode::INTERNAL_ERR
            ], StatusCode::OK);
        }
        return response()->json([
            'message' => 'お問い合わせの送信が完了しました。',
            'status_code' => StatusCode::OK
        ], StatusCode::OK);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->contactInterface->getById($id);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $this->contactInterface->destroy();
    }
}
