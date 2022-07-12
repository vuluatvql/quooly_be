<?php

namespace App\Repositories\Admin;

use App\Models\Admin;
use App\Http\Controllers\BaseController;
use App\Repositories\Admin\AdminInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminRepository extends BaseController implements AdminInterface
{
    private Admin $admin;
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function get($request)
    {
        // TODO: Implement get() method.
    }

    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
    public function updateLastLogin($id)
    {
        $currentUser = $this->admin->where('id', $id)->first();
        if (!$currentUser) {
            return false;
        }
        $currentUser->last_login_at = Carbon::now();
        return $currentUser->save();
    }
}
