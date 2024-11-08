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

            // Check if user is a super_admin
            if ($user->role === 'super_admin') {
                // Redirect to Super Admin Dashboard
                return redirect()->route('superadmindashboard');
            }

            // Add additional roles if needed
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.dashboard'); // Default user route
        }

        // Authentication failed
        return back()->withErrors(['loginError' => 'Invalid email or password.']);
    }
}
