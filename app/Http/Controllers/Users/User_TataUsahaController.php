<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User_TataUsahaController extends UserController
{

    public function index()
    {

        $this->route = 'tata-usaha';
        $this->role = 'Tata Usaha';

        return view('tataUsaha.login')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route);
    }

    public function authenticate(Request $r)
    {

        try {
            $credentials = $r->validate([
                'userid' => ['required'],
                'password' => ['required'],
                'hak_akses' => ['required'],
            ], [
                'userid.required' => 'Mohon masukkan userid.',
                'password.required' => 'Mohon masukkan password.',
                'hak_akses.required' => 'Mohon masukkan hak akses.',
            ]);





            if (Auth::attempt($credentials)) {
                $r->session()->regenerate();

                return redirect()->intended('/tata-usaha/dashboard');
            }


            return back()->with('error', 'Username dan password anda salah !');
        } catch (\Throwable $th) {
            dd(1);
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        try {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/tata-usaha');
        } catch (\Throwable $th) {
            return back();
        }
    }

    public function update(Request $r, $nama, $userid)
    {

        $validatedData = $r->validate([
            'email' => ['required', 'email'],
            'username' => ['required'],
            'password' => ['required', 'min:6'],
        ]);

        if ($r->input('password') == $r->input('confirmPassword')) {

            // enscripsi password
            $password = bcrypt($validatedData['password']);

            $data =
                [
                    'email' => $validatedData['email'],
                    'userid' => $validatedData['username'],
                    'password' => $password,
                ];

            $result = new User();
            $result->updateData($userid, $data);

            return redirect('/tata-usaha/setting')->with('success', 'Account Successfully Updated');
        } else {
            return redirect('/tata-usaha/setting')->with('error', 'Password Failed To Save');
        }
    }
}
