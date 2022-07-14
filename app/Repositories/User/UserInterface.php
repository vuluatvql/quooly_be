<?php


namespace App\Repositories\User;


interface UserInterface
{
    public function getUsers($request);
    public function destroy($id);
    public function checkEmail($request);
    public function store($request);
    public function register($request);
    public function getById($id);
    public function update($request, $id);
    public function updateLastLogin($id);
    public function getByEmail($request);
    public function generalResetPass($request);
    public function getUserByToken($token);
    public function updatePasswordByToken($request, $token);
}
