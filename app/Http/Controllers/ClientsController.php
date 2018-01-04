<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ClientsController extends EmployeeController
{
    public function index()
    {
        $clients = User::role(User::ROLE_CLIENT)
            ->select('id', 'name', 'email')
            ->get()
            ->toArray();

        return $clients;
    }

}
