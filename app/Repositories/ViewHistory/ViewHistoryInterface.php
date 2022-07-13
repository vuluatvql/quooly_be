<?php


namespace App\Repositories\ViewHistory;


interface ViewHistoryInterface
{
    public function get($request);
    public function destroy($id);
    public function store($request);
    public function getById($id);
    public function update($request, $id);
}
