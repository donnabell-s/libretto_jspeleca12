<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function showLogin()
    {
        if (Auth::check()) return redirect('/books');
        return view('auth.login');
    }

    public function showRegister()
    {
        if (Auth::check()) return redirect('/books');
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $request->expectsJson()
                ? response()->json(['message' => 'Invalid credentials.'], 401)
                : back()->withErrors(['email' => 'Invalid credentials.']);
        }

        if ($request->expectsJson()) {
            $token = $user->createToken('api-token', ['*'], now()->addDay())->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/books');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $request->expectsJson()
            ? response()->json(['message' => 'User registered successfully.'], 201)
            : redirect()->route('login')->with('success', 'Registration successful. You may now log in.');
    }

    public function logout(Request $request)
    {
        if ($request->expectsJson()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Logged out']);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
