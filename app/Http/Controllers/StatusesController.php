<?php

namespace App\Http\Controllers;

use App\Models\Deposits\DepositStatuses;
use Illuminate\Http\Request;

class StatusesController extends EmployeeController
{
    public function index()
    {
        return DepositStatuses::get();
    }
}
