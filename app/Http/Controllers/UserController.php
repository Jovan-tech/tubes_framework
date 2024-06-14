<?php   

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users
        return view('manajemen', compact('users'));
    }
    public function switchRole($id)
    {
        $user = User::findOrFail($id);

        // Toggle the role
        if ($user->role == 'admin') {
            $user->role = 'user';
        } else {
            $user->role = 'admin';
        }

        $user->save();

        return redirect()->back()->with('status', 'User role updated successfully.');
    }
}
