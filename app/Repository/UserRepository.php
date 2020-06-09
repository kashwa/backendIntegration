<?php


namespace App\Repository;


use App\User;

class UserRepository
{
    function findAll()
    {
        return User::all();
    }

    function find($id)
    {
        return User::find($id);
    }

    function create($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    function update($id, $data)
    {
        $user = $this->find($id);

        return $user->update($data);
    }

    function delete($id)
    {
        if ($this->find($id)){
            return User::destroy($id);
        }
        return ['error' => 'User Not Found'];
    }
}