<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdateViewHistoryRequest;
use App\Models\ViewHistory;
use App\Repositories\ViewHistory\ViewHistoryInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Enums\bukkenType;
use App\Enums\StatusCode;
use App\Http\Requests\ViewHistoryRequest;

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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ViewHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ViewHistoryRequest $request)
    {
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
