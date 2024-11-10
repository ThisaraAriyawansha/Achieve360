<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;




class UserController extends Controller
{
    public function teachers()
{
    $teachers = User::where('role', 'teacher')->get(); // Assuming the 'role' column contains user roles
    return response()->json(['teachers' => $teachers]);
}

public function showUsersByRole()
{
    // Fetch users based on role
    $admins = User::where('role', 'admin')->get();
    $teachers = User::where('role', 'teacher')->get();
    $managers = User::where('role', 'manager')->get();
    $students = User::where('role', 'student')->get();

    // Return the view with the users data
    return view('super_admin_dashboard', compact('admins', 'teachers', 'managers', 'students'));
}





}
