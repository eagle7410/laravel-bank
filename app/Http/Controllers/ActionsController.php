<?php

namespace App\Http\Controllers;

use App\Models\Deposits\DepositActions;
use Illuminate\Http\Request;

class ActionsController extends EmployeeController
{
    public function index()
    {
        return DepositActions::get();
    }
}
