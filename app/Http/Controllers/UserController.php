<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user'); // Apply user middleware
    }

    public function index()
    {
        return view('dashboardbootstrap2'); // Create a view for user dashboard
    }
}
