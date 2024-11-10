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

}
