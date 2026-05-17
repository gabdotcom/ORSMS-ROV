<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended($this->getDashboardRoute());
        }

        throw ValidationException::withMessages([
            'email' => 'Invalid email or password.',
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'extension_name' => 'nullable|string|max:10',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'] ?? null,
            'last_name' => $data['last_name'],
            'extension_name' => $data['extension_name'] ?? null,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'applicant',
            'status' => 'pending',
        ]);

        Auth::login($user);

        return redirect($this->getDashboardRoute());
    }

    private function getDashboardRoute(): string
    {
        $role = Auth::user()->role;
        return match($role) {
            'hr' => '/hr/dashboard',
            'board' => '/board/dashboard',
            'admin' => '/admin/dashboard',
            default => '/applicant/dashboard',
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}