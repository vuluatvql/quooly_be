<?php

namespace App\Repositories\Request;

use Carbon\Carbon;
use App\Http\Controllers\BaseController;
use App\Models\Request;
use App\Models\RequestBukkenStructure;
use App\Models\RequestBukkenType;
use App\Repositories\Request\RequestInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestRepository extends BaseController implements RequestInterface
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getRequests($request)
    {
        // $newSizeLimit = $this->newListLimit($request);
        // $requestBuilder = $this->request;
        // if (isset($request['search_input'])) {
        //     $requestBuilder = $requestBuilder->where(function ($q) use ($request) {
        //         $q->orWhere($this->escapeLikeSentence('name', $request['search_input']));
        //     });
        // }
        // $requests = $requestBuilder->sortable(['created_at' => 'desc', 'status' => 'desc'])->paginate($newSizeLimit);
        // if ($this->checkPaginatorList($requests)) {
        //     Paginator::currentPageResolver(function () {
        //         return 1;
        //     });
        //     $requests = $requestBuilder->paginate($newSizeLimit);
        // }
        // return $requests;
    }

    public function destroy($id)
    {
        $request = $this->request->where('id', $id)->first();
        if (!$request) {
            return false;
        }
        if ($request->delete()) {
            return true;
        }
        return false;
    }

    public function store($requestData)
    {
        $requestModel = new $this->request();
        $requestModel->name = $requestData->name;
        $requestModel->user_id = Auth::user()->id;
        $requestModel->prefecture_id = $requestData->prefecture_id;
        $requestModel->city = $requestData->city;
        $requestModel->price_lower = $requestData->price_lower;
        $requestModel->price_upper = $requestData->price_upper;
        $requestModel->revenue_yield = $requestData->revenue_yield;
        $requestModel->construction_year = $requestData->construction_year;
        $requestModel->walkrange = $requestData->walkrange;
        $requestModel->comment = $requestData->comment;

        DB::beginTransaction();
        try {
            if (!$requestModel->save()) {
                return false;
            }
            $requestBukkenTypeSave = [];
            foreach ($requestData->bukken_type as $key => $bukkenType) {
                $requestBukkenTypeSave[] = [
                    'bukken_type' => $bukkenType
                ];
            }
            if (!$requestModel->requestBukkenType()->createMany($requestBukkenTypeSave)) {
                return false;
            }

            $requestBukkenStructureSave = [];
            foreach ($requestData->bukken_structures as $key => $bukkenStructures) {
                $requestBukkenStructureSave[] = [
                    'building_structure' => $bukkenStructures
                ];
            }
            if (!$requestModel->requestBukkenStructure()->createMany($requestBukkenStructureSave)) {
                return false;
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }
        DB::rollBack();
        return false;
    }
    public function getById($id)
    {
        return $this->request->where('id', $id)->first();
    }
    public function update($request, $id)
    {
        // $requestInfo = $this->request->where('id', $id)->first();
        // if (!$requestInfo) {
        //     return false;
        // }
        // $requestInfo->name = $request->name;
        // // .....

        // return $requestInfo->save();
    }
}
