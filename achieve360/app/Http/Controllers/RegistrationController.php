<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        // Custom validation messages
        $customMessages = [
            'username.required' => 'The username is required.',
            'username.unique' => 'This username is already taken. Please choose another one.',
            'email.required' => 'The email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 6 characters.',
            'role.required' => 'The role is required.',
            'role.string' => 'The role must be a valid string.',
            'full_name.required' => 'The full name is required.',
            'full_name.max' => 'The full name cannot exceed 255 characters.',
        ];
    
        // Validate the incoming data with custom messages
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|string',
            'full_name' => 'required|string|max:255',
        ], $customMessages);
    
        // Create a new user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'full_name' => $request->full_name,
        ]);
    
        // Optionally, log the user in (if required)
        // Auth::login($user);
    
        // Redirect to the dashboard with a success message
        return redirect()->route('superadmindashboard')->with('success', 'User registered successfully!');
    }
    
}
