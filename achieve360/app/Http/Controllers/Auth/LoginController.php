<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate email and password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to login with provided credentials
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication successful
            $user = Auth::user();

            // Check if the user's status is 'inactive'
            if ($user->status !== 'active') {
                // If inactive, log out the user and return with an error message
                Auth::logout();
                return back()->withErrors(['loginError' => 'Your account is inactive. Please contact support.']);
            }

            // Prepare the data to be passed to the dashboard routes
            $data = [
                'full_name' => $user->full_name,
                'email' => $user->email
            ];

            // Redirect based on user role
            if ($user->role === 'super_admin') {
                return redirect()->route('superadmindashboard')->with($data);
            }

            if ($user->role === 'admin') {
                return redirect()->route('admindashboard')->with($data);
            }

            if ($user->role === 'manager') {
                return redirect()->route('managerdashboard')->with($data);
            }

            if ($user->role === 'teacher') {
                return redirect()->route('teacherdashboard')->with($data);
            }

            if ($user->role === 'student') {
                return redirect()->route('studentdashboard')->with($data);
            }

            return redirect()->route('user.dashboard')->with($data);
        }

        // Authentication failed
        return back()->withErrors(['loginError' => 'Invalid email or password.']);
    }
}
