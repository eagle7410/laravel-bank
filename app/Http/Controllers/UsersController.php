<?php

namespace App\Http\Controllers;

use App\Events\HelloyEvent;
use App\User;

class UsersController extends EmployeeBaseController
{
    public function index()
    {
        return User::orderBy('created_at', 'desc')
            ->get()
            ->toArray();
    }
}
