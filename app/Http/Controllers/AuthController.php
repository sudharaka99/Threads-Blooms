<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            
            // Merge guest cart with user cart
            $this->mergeGuestCart();

            // Check if user is admin
            if (Auth::user()->is_admin == 1) {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            
            // Merge guest cart with user cart
            $this->mergeGuestCart();

            // Check if user is admin
            if (Auth::user()->is_admin == 1) {
                return response()->json([
                    'message' => 'Login successful',
                    'is_admin' => true,
                    'redirect' => route('admin.dashboard')
                ], 200);
            }

            return response()->json([
                'message' => 'Login successful',
                'is_admin' => false,
                'redirect' => '/'
            ], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 0, // Default to regular user
        ]);

        Auth::login($user);

        // Merge guest cart with user cart
        $this->mergeGuestCart();

        return redirect('/')->with('success', 'Registration successful!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    private function mergeGuestCart()
    {
        $sessionId = session()->get('cart_session_id');
        if ($sessionId) {
            $guestCart = \App\Models\Cart::where('session_id', $sessionId)->first();
            if ($guestCart) {
                $userCart = \App\Models\Cart::firstOrCreate(['user_id' => Auth::id()]);
                
                foreach ($guestCart->items as $item) {
                    $existingItem = $userCart->items()
                        ->where('product_id', $item->product_id)
                        ->where('variant_id', $item->variant_id)
                        ->first();

                    if ($existingItem) {
                        $existingItem->quantity += $item->quantity;
                        $existingItem->save();
                    } else {
                        $userCart->items()->create([
                            'product_id' => $item->product_id,
                            'variant_id' => $item->variant_id,
                            'quantity' => $item->quantity,
                            'price' => $item->price,
                        ]);
                    }
                }

                $guestCart->items()->delete();
                $guestCart->delete();
                
                session(['cart_count' => $userCart->items()->sum('quantity')]);
            }
            session()->forget('cart_session_id');
        }
    }
}