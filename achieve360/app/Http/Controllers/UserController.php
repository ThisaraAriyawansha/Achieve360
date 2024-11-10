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


public function updateStatus($id, Request $request)
{
    try {
        $user = User::findOrFail($id);
        $user->status = $request->input('status'); // assuming 'status' is passed in the request
        $user->save();

        // Return a JSON response
        return response()->json(['message' => 'Status updated successfully', 'status' => $user->status]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to update status'], 500);
    }
}



}
