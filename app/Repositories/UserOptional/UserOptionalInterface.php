<?php


namespace App\Repositories\UserOptional;


interface UserOptionalInterface
{
    public function index();
    public function destroy($id);
    public function store($request);
    public function getById($id);
    public function update($request, $id);
}
