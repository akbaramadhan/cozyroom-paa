<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login_proses(Request $request)
    {

        $customMessages = [
            'email.email'               => 'Format email tidak valid',
            'email.required'            => 'Semua data wajib diisi',
            'password.required'         => 'Semua data wajib diisi',
        ];

        $rules = [
            'email'     => 'required|email|',
            'password'  => 'required',
        ];

        // Validasi data request
        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Jika validasi gagal, redirect kembali dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator)->withInput();
        }
        $infologin = [
            'email'        => $request->email,
            'password'     => $request->password,
        ];

        if (Auth::attempt($infologin)) {

            return redirect()->route('beranda');
            // dd(auth()->user()->getRoleNames());
        } else {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if (!Hash::check($request->password, $user->password)) {
                    return redirect()->route('login')->withErrors('Maaf password anda salah')->withInput();
                } else {
                    return redirect()->route('login')->withErrors('Maaf terjadi kesalahan!')->withInput();
                }
            } else {
                return redirect()->route('login')->withErrors('Maaf email anda tidak ditemukan!')->withInput();
            }
        }
    }
    public function registerForm()
    {
        return view('register');
    }

    public function register_proses(Request $request)
    {
        $customMessages = [
            'name.regex'                => 'Nama tidak valid',
            'email.unique'              => 'Maaf email sudah terdaftar',
            'email.email'               => 'Format email tidak valid',
            'name.required'                  => 'Semua data wajib diisi',
            'email.required'                  => 'Semua data wajib diisi',
            'password.required'                  => 'Semua data wajib diisi',
            'password.confirmed'        => 'Konfirmasi password tidak cocok',
        ];

        $rules = [
            'name'      => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|confirmed',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $customMessages);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->route('register')->withErrors($validator)->withInput();
        }

        // Check if email already exists
        $checkEmail = User::where('email', $request->email)->first();
        if ($checkEmail) {
            return redirect()->route('register')->withErrors('Akun anda telah Terdaftar!')->withInput();
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign the role to the user
        // $user->assignRole('owner');

        // Redirect to login route
        return redirect()->route('login');
    }

    public function keluar()
    {
        Auth::logout();
        return redirect('/');
    }
}
