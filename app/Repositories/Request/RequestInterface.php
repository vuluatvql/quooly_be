<?php


namespace App\Repositories\Request;


interface RequestInterface
{
    public function getRequests($request);
    public function destroy($id);
    public function store($request);
    public function getById($id);
    public function update($request, $id);
}
