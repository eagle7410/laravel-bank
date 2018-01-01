<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class UsersController extends Controller
{
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:'.User::ROLE_EMPLOYEE]);
    }

    public function index()
    {
        return User::orderBy('created_at', 'desc')
            ->get()
            ->toArray();
    }
}
