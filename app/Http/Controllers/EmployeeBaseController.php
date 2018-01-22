<?php

namespace App\Http\Controllers;

use App\User;

class EmployeeBaseController extends AuthBaseController
{
    /**
     * RolesController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['role:'.User::ROLE_EMPLOYEE]);
    }
}
