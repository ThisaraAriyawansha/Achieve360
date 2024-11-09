<?php

// app/Http/Controllers/Auth/LoginController.php

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

            // Redirect based on user role and pass the user's full name
            if ($user->role === 'super_admin') {
                return redirect()->route('superadmindashboard')->with('full_name', $user->full_name);
            }

            if ($user->role === 'admin') {
                return redirect()->route('admindashboard')->with('full_name', $user->full_name);
            }

            if ($user->role === 'manager') {
                return redirect()->route('managerdashboard')->with('full_name', $user->full_name);
            }

            if ($user->role === 'teacher') {
                return redirect()->route('teacherdashboard')->with('full_name', $user->full_name);
            }
            return redirect()->route('user.dashboard')->with('full_name', $user->full_name);
        }

        // Authentication failed
        return back()->withErrors(['loginError' => 'Invalid email or password.']);
    }
}
