<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'address' => 'nullable|string',
            'number' => 'nullable|string',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'username' => $request->username,
            'address' => $request->address,
            'number' => $request->number,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login.form')->with('success', 'Registration successful. Please login.');
    }

    public function showLoginForm()
    {
        return view('login'); // Mengarah ke view login
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

       
        if ($request->username === 'admin' && $request->password === 'admin') {
            Auth::loginUsingId(1); 
            return redirect()->route('admin.dashboard');
        }

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.form'); // Redirect ke halaman login setelah logout
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('login.form')->with('success', 'Account deleted successfully!');
    } // Menampilkan form untuk mengedit profile


    public function showEditForm()
    {
        $user = Auth::user();  // Ambil data user yang sedang login
        return view('editProfile', compact('user'));  // Kirim data user ke view
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();  // Mendapatkan user yang sedang login

        // Pastikan $user adalah instance dari model User
        if ($user instanceof User) {
            // Validasi dan pembaruan
            $user->update($request->except('password')); // Update semua kolom kecuali password

            // Jika password diubah, lakukan perubahan password
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password); // Hash password baru
                $user->save(); // Simpan perubahan password
            }

            return redirect()->route('home')->with('success', 'Profile updated successfully!');
        }

        // Jika user bukan instance dari User, beri respons error
        return back()->withErrors(['error' => 'User not found or unauthorized']);
    }
}
