<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Laravel\Sanctum\PersonalAccessToken;

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

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if (! $user || ! Hash::check($request->password, $user->password)) {
    //         return $request->expectsJson()
    //             ? response()->json(['message' => 'Invalid credentials.'], 401)
    //             : back()->withErrors(['email' => 'Invalid credentials.']);
    //     }

    //     if ($request->expectsJson()) {
    //         $token = $user->createToken('api-token', ['*'], now()->addDay())->plainTextToken;

    //         return response()->json([
    //             'user' => $user,
    //             'token' => $token,
    //         ]);
    //     }

    //     Auth::login($user);
    //     $request->session()->regenerate();

    //     return redirect('/books');
    // }

    public function login(Request $request): RedirectResponse | JsonResponse
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Invalid credentials',
                ], 401);
            }

            return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $existingToken = PersonalAccessToken::where('tokenable_id', $user->id)
            ->where('tokenable_type', get_class($user))
            ->where('name', 'api_token')
            ->latest('created_at')
            ->first();

        $token = null;

        if ($existingToken && $existingToken->expires_at && $existingToken->expires_at->isFuture()) {
            $existingToken->last_used_at = now();
            $existingToken->save();

            $token = $existingToken->id . '|' . $existingToken->token;
        } else {
            if ($existingToken) {
                $existingToken->delete();
            }

            $newToken = $user->createToken('api_token', ['*'], now()->addDay());
            $token = $newToken->plainTextToken;
        }

        if (!$request->expectsJson()) {
            $request->session()->regenerate();
            $request->session()->put('sanctum_token', $token);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Login successful',
                'user'    => $user,
                'token'   => $token,
            ]);
        }

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

    public function logout(Request $request): RedirectResponse|JsonResponse
{
    $user = $request->user();

    if ($user && $user->currentAccessToken() instanceof PersonalAccessToken) {
        try {
            $user->currentAccessToken()->delete();
        } catch (\Exception $e) {
            report($e);
        }
    }

    if (session()->has('sanctum_token')) {
        $sessionToken = session('sanctum_token');
        $tokenId = explode('|', $sessionToken)[0];

        PersonalAccessToken::where('id', $tokenId)->delete();
    }

    if (Auth::check()) {
        Auth::guard('web')->logout();
    }

    $request->session()->forget('sanctum_token');
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    if ($request->expectsJson()) {
        return response()->json(['message' => 'Logged out successfully']);
    }

    return redirect('/login');
}


}
