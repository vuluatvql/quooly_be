<?php

namespace App\Http\Controllers\Api;

use App\Enums\bukkenType;
use App\Enums\StatusCode;
use App\Repositories\Favorites\FavoritesInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FavoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $favories;

    public function __construct(FavoritesInterface $favories)
    {
        $this->favories = $favories;
    }

    public function index(Request $request)
    {
        return $this->favories->get($request);
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
        $validator = Validator::make($request->all(), [
            'bukken_id' =>[
                'required',
                Rule::in(array_map(function ($e) {
                    return (string)$e;
                }, bukkenType::getValues()))
                ]
            ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => array_combine($validator->errors()->keys(), $validator->errors()->all()),
                'status_code' => StatusCode::BAD_REQUEST
            ], StatusCode::OK);
        }
        if (!$this->favories->store($request)) {
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
    public function destroy($id)
    {
        //
    }
}
