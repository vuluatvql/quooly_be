<?php

namespace App\Repositories\ViewHistory;

use App\Http\Controllers\BaseController;
use App\Models\ViewHistory;
use Illuminate\Support\Facades\Auth;

class ViewHistoryRepository extends BaseController implements ViewHistoryInterface
{
    private $viewHistory;
    public function __construct(ViewHistory $viewHistory)
    {
        $this->viewHistory = $viewHistory;
    }

    public function get($request)
    {
        
    }

    public function destroy($id)
    {
       
    }
    
    public function store($request)
    {
        $history = $this->viewHistory->where('bukken_id', $request['bukken_id'])
            ->where('user_id', Auth::user()->id)
            ->first();
        if (empty($history)) {
            $this->viewHistory->bukken_id = $request['bukken_id'];
            $this->viewHistory->user_id = Auth::user()->id;
            $this->viewHistory->view_count = 1;
            return $this->viewHistory->save();
        }
        return $this->increaseCount($history);
    }
    public function getById($id)
    {
        
    }
    public function update($request, $id)
    {
        
    }
    public function increaseCount(ViewHistory $viewHistory)
    {
        if (empty($viewHistory)) {
            return null;
        }
        $viewHistory->view_count += 1;
        return $viewHistory->save();
    }
}
