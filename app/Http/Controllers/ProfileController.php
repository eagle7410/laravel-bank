<?php

namespace App\Http\Controllers;

use App\Models\Profiles\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data = $request->validate([
            'name_first'  => 'required|string|max:100',
            'name_last' => 'required|string|max:100'
        ]);

        Profile::create($data);
    }
}
