<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusCode;
use App\Http\Controllers\BaseController;
use App\Repositories\Request\RequestInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RequestController extends BaseController
{
    private $request;
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $breadcrumbs = [
            'リストリクエスト',
        ];
        $newSizeLimit = $this->newListLimit($request);

        return view('admin.request.index', [
            'title' => 'リストリクエスト',
            'breadcrumbs' => $breadcrumbs,
            'requests' => $this->request->getRequests($request),
            'request' => $request,
            'newSizeLimit' => $newSizeLimit
        ]);
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
        $breadcrumbs = [
            [
                'url' => route('admin.request.index'),
                'name' => 'リストリクエスト',
            ],
            '詳細をリクエストする'
        ];
        $request = $this->request->getById($id);
        if (!$request) {
            return redirect(route('admin.request.index'));
        }
        $createdAt = Carbon::parse($request->created_at)->format('Y年m月d日');
        $request = $request->toArray();
        $request['created_at'] = $createdAt;
        return view('admin.request.show', [
            'title' => '詳細をリクエストする',
            'breadcrumbs' => $breadcrumbs,
            'request' => $request,
        ]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->request->destroy($id)) {
            return response()->json([
                'message' => 'お知らせの削除が完了しました。',
                'status' => StatusCode::OK
            ], StatusCode::OK);
        }
        return response()->json([
            'message' => 'エラーが発生しました。',
            'status' => StatusCode::OK
        ], StatusCode::INTERNAL_ERR);
    }
}
