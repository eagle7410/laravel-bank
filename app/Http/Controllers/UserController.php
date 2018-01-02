<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends EmployeeController
{
    public function save(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'role'     => 'required|string|min:1',
            'password' => 'required|string|min:6',
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        $user->save();
        $user->assignRole($data['role']);

        return $user;
    }
}
