<?php

namespace App\Repositories\Request;

use Carbon\Carbon;
use App\Http\Controllers\BaseController;
use App\Models\Request;
use App\Models\RequestBukkenStructure;
use App\Models\RequestBukkenType;
use App\Repositories\Request\RequestInterface;
use Illuminate\Pagination\Paginator;
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

    public function store($request)
    {
        $requestModel = new $this->request();
        $requestModel->name = $request->name;
        $requestModel->user_id = $request->user_id;
        $requestModel->prefecture_id = $request->prefecture_id;
        $requestModel->city = $request->city;
        $requestModel->price_lower = $request->price_lower;
        $requestModel->price_upper = $request->price_upper;
        $requestModel->revenue_yield = $request->revenue_yield;
        $requestModel->construction_year = $request->construction_year;
        $requestModel->walkrange = $request->walkrange;
        $requestModel->comment = $request->comment;

        DB::beginTransaction();
        try {
            if (!$requestModel->save()) {
                throw new \Exception("Save request failed!");
            }
            $requestBukkenType = new RequestBukkenType();
            $requestBukkenTypeSave = [];
            foreach ($request->bukken_type as $key => $bukken_type) {
                $requestBukkenTypeSave[] = [
                    'request_id' => $requestModel->id,
                    'bukken_type' => $bukken_type,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            if (!$requestBukkenType::insert($requestBukkenTypeSave)) {
                throw new \Exception("Insert request_bukken_type failed!");
            }

            $requestBukkenStructure = new RequestBukkenStructure();
            $requestBukkenStructureSave = [];
            foreach ($request->bukken_structures as $key => $bukken_structures) {
                $requestBukkenStructureSave[] = [
                    'request_id' => $requestModel->id,
                    'building_structure' => $bukken_structures,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            if (!$requestBukkenStructure::insert($requestBukkenStructureSave)) {
                throw new \Exception("Insert request_bukken_structure failed!");
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
