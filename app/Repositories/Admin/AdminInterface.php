<?php

namespace App\Repositories\Admin;

interface AdminInterface
{
    public function get($request);
    public function getById($id);
    public function store($request);
    public function update($request, $id);
    public function destroy($id);
    public function updateLastLogin($id);
}
