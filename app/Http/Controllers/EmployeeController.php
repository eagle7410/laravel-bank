<?php

namespace App\Http\Controllers;

use App\User;

class EmployeeController extends Controller
{
    /**
     * RolesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:'.User::ROLE_EMPLOYEE]);
    }
}
