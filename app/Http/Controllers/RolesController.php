<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * RolesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:'.User::ROLE_EMPLOYEE]);
    }

    public function index()
    {
        $roles = Role::where('guard_name','web')
            ->select('id', 'name')
            ->get();

        return $roles;
    }
}
