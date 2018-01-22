<?php

namespace App\Http\Controllers;

class AuthBaseController extends Controller
{
    protected $user;

    /**
     * RolesController constructor.
     */
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user= auth()->user();

            return $next($request);
        });
    }
}
