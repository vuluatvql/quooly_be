<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Repositories\User\UserInterface;
use App\Repositories\Prefecture\PrefectureInterface;
use App\Http\Controllers\BaseController;
use App\Enums\StatusCode;
use Illuminate\Http\Request;
use App\Enums\IndustryType;
use App\Enums\JobType;
use App\Enums\PropertyBuilding;
use App\Enums\PropertyDivision;
use App\Enums\PropertyKodateChintai;
use App\Enums\MailNoti;

class UserController extends BaseController
{
    private $user;
    private $prefecture;
    public function __construct(
        UserInterface $user,
        PrefectureInterface $prefecture
    ) {
        $this->user = $user;
        $this->prefecture = $prefecture;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $breadcrumbs = [
            'ユーザー管理',
        ];
        $newSizeLimit = $this->newListLimit($request);
        return view('admin.user.index', [
            'title' => 'ユーザー管理',
            'breadcrumbs' => $breadcrumbs,
            'users' => $this->user->getUsers($request),
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
        $breadcrumbs = [
            [
                'url' => session()->get('admin.user.list')[0] ?? route('admin.user.index'),
                'name' => 'ユーザー一覧',
            ],
            'ユーザー作成'
        ];
        $industryTypes = IndustryType::parseArray();
        $jobTypes = JobType::parseArray();
        $propertyBuilding = PropertyBuilding::parseArray();
        $propertyDivision = PropertyDivision::parseArray();
        $propertyKodateChintai = PropertyKodateChintai::parseArray();
        $mailNoti = MailNoti::parseArray();
        $prefectures = $this->prefecture->getOption();
        
        return view('admin.user.create', [
            'title' => 'ユーザー作成',
            'breadcrumbs' => $breadcrumbs,
            'industryTypes' => $industryTypes,
            'jobTypes' => $jobTypes,
            'propertyBuilding' => $propertyBuilding,
            'propertyDivision' => $propertyDivision,
            'propertyKodateChintai' => $propertyKodateChintai,
            'prefectures' => $prefectures,
            'mailNoti' => $mailNoti,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if ($this->user->store($request)) {
            $this->setFlash(__('代理店の新規作成が完了しました。'));
            return redirect(session()->get('admin.user.list')[0] ?? route('admin.user.index'));
        }
        $this->setFlash(__('エラーが発生しました。'), 'error');
        return redirect()->route('admin.user.create');
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
        $breadcrumbs = [
            [
                'url' => session()->get('admin.user.list')[0] ?? route('admin.user.index'),
                'name' => 'ユーザー一覧',
            ],
            'ユーザー編集'
        ];
        $user = $this->user->getById($id);
        if (!$user) {
            return redirect(session()->get('admin.user.list')[0] ?? route('admin.user.index'));
        }
        return view('admin.user.edit', [
            'title' => 'ユーザー編集',
            'breadcrumbs' => $breadcrumbs,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        if ($this->user->update($request, $id)) {
            $this->setFlash(__('代理店の新規作成が完了しました。'));
            return redirect(session()->get('admin.user.list')[0] ?? route('admin.user.index'));
        }
        $this->setFlash(__('エラーが発生しました。'), 'error');
        return redirect()->route('admin.user.update', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->user->destroy($id)) {
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

    public function checkEmail(Request $request)
    {
        return response()->json([
            'valid' => $this->user->checkEmail($request),
        ], StatusCode::OK);
    }
}
