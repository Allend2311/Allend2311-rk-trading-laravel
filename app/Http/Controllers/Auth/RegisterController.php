<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:50',
            'mname' => 'nullable|string|max:50',
            'email' => 'required|string|email|max:100|unique:users',
            'address' => 'required|string',
            'birthday' => 'required|date|before:today',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Generate verification code
        $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store signup data in session
        session([
            'signup_data' => [
                'fname' => $request->fname,
                'lname' => $request->lname,
                'mname' => $request->mname,
                'email' => $request->email,
                'address' => $request->address,
                'birthday' => $request->birthday,
                'password' => Hash::make($request->password),
                'user_type' => strpos($request->email, 'admin') !== false ? 'admin' : 'customer',
                'verification_code' => $verificationCode,
            ]
        ]);

        return redirect()->route('auth.verify');
    }

    public function showVerificationForm()
    {
        if (!session('signup_data')) {
            return redirect()->route('auth.register');
        }

        return view('auth.verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $signupData = session('signup_data');

        if (!$signupData || $request->code !== $signupData['verification_code']) {
            return back()->withErrors(['code' => 'Invalid verification code.']);
        }

        // Create user
        User::create($signupData);

        // Clear session data
        session()->forget('signup_data');

        return redirect()->route('auth.login')->with('success', 'Account created successfully! Please sign in.');
    }
}
