<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends EmployeeBaseController
{
    public function index()
    {
        $roles = Role::where('guard_name','web')
            ->select('id', 'name')
            ->get();

        return $roles;
    }
}
