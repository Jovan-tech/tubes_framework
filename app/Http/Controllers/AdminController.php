<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin'); // Apply admin middleware
    }

    public function index()
    {
        return view('admin-dashboard'); // Create a view for admin dashboard
    }

    public function manageUsers()
    {
        // Your logic for managing users
        return view('dashboardbootstrap'); // Create a view for user management
    }
}
