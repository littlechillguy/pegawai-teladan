<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'nip' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = User::whereHas('employee', function ($query) use ($credentials) {
            $query->where('nip', $credentials['nip'])
                  ->where('status', 'active');
        })->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'nip' => 'NIP atau password salah.',
            ])->onlyInput('nip');
        }

        Auth::login($user);

        $request->session()->regenerate();

        /*
        |--------------------------------------------------------------------------
        | Password Default
        |--------------------------------------------------------------------------
        | Jika user/employee masih menggunakan password default,
        | arahkan langsung ke halaman ubah password.
        |
        | Admin tidak terkena aturan ini.
        |--------------------------------------------------------------------------
        */

        if (
            $user->role !== 'admin' &&
            $credentials['password'] === 'password123'
        ) {
            return redirect()
                ->route('password.edit')
                ->with(
                    'warning',
                    'Password Anda masih menggunakan password default. Silakan ganti password terlebih dahulu demi keamanan akun.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Redirect Berdasarkan Role
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->intended('/dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}