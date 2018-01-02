<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class UsersController extends EmployeeController
{
    public function index()
    {
        return User::orderBy('created_at', 'desc')
            ->get()
            ->toArray();
    }
}
