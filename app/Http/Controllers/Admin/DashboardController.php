<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user_all = User::all();

        return view('admin.dashboard')->with('user_all', $user_all);
    }
}
