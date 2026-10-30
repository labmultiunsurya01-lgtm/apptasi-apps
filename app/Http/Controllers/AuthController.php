<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login admin.
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Proses login dengan keamanan:
     * - Rate limiting (mencegah brute force) via route 'throttle:5,1'
     * - Regenerate session setelah login sukses (mencegah session fixation)
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return back()
                ->withErrors(['email' => 'Email atau password salah.'])
                ->onlyInput('email');
        }

        $user = Auth::user();

        // Hanya admin yang boleh masuk ke area admin
        if (!$user->isAdmin()) {
            Auth::logout();
            return back()->withErrors(['email' => 'Akun Anda tidak memiliki izin akses admin.']);
        }

        // Regenerate session untuk mencegah session fixation
        $request->session()->regenerate();

        return redirect()->intended(route('admin.index'));
    }

    /**
     * Proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Anda telah keluar dari sistem.');
    }

    /**
     * Proses ganti password admin.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password'     => ['required', 'string'],
            'new_password'         => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'new_password.required'     => 'Password baru wajib diisi.',
            'new_password.min'          => 'Password baru minimal 8 karakter.',
            'new_password.confirmed'    => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = Auth::user();

        // Verifikasi password lama
        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai. Silakan cek kembali.']);
        }

        // Cegah password baru sama dengan yang lama
        if ($request->new_password === $request->current_password) {
            return back()->withErrors(['new_password' => 'Password baru tidak boleh sama dengan password lama.']);
        }

        $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}
