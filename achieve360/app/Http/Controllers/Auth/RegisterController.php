<?php

// app/Http/Controllers/Auth/RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username', // Ensure the username is unique
            'password' => 'required|min:8|confirmed', // Confirm the password matches
        ]);
    
        // Create the user with hashed password
        $user = new User();
        $user->email = $request->email;
        $user->username = $request->username; // Save the username
        $user->password = Hash::make($request->password); // Hash the password before saving
        $user->save();
    
        // Redirect or respond with success message
        return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');
    }
    
}

