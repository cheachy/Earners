<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FisherProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- LOGIN METHODS ---
    public function logout(Request $request) 
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showLogin() {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request) {
        // 1. Validate inputs
        $request->validate([
            'contact_number' => 'required',
            'password' => 'required',
        ]);

        // 2. Find the fisherman's profile
        $profile = FisherProfile::where('contact_number', $request->contact_number)->first();

        if (!$profile) {
            return back()->withErrors(['contact_number' => 'This number is not registered.']);
        }

        // 3. Use the contact number to "re-build" the fake email we made during registration
        $credentials = [
            'email' => $request->contact_number . '@earners.com',
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['contact_number' => 'The password you entered is incorrect.']);
    }

    // --- REGISTRATION METHODS (The missing ones) ---

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|string|unique:fisher_profiles',
            'password' => 'required|string|min:4',
        ]);

        // 1. Create the User with a "Generated" Email
        $user = User::create([
            'name' => $request->name,
            'email' => $request->contact_number . '@earners.com', // Auto-generated email
            'password' => Hash::make($request->password),
            'role' => 'fisherman',
        ]);

        // 2. Link the Phone Number to the Profile
        FisherProfile::create([
            'user_id' => $user->id,
            'contact_number' => $request->contact_number,
            'location_zone' => 'Philippines',
            'preferred_payment' => 'Cash',
        ]);

        Auth::login($user);
        return redirect()->route('dashboard');
    }
}