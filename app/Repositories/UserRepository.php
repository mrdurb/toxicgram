<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository
{
    public function findNameById($id)
    {
        return User::select('id', 'name')->whereId($id)->first();
    }

    public function findBySearch($request)
    {
        return User::where('name', 'LIKE', '%'.$request['search'].'%')->get();
    }

    public function findAllById($id)
    {
        return User::whereIn('id', $id);
    }

}
