<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User_PegawaiController extends UserController
{
    public function index()
    {

        $this->route = 'pegawai';
        $this->role = 'Pegawai';

        return view('pegawai.login')
            ->with('title', $this->title)
            ->with('role', $this->role)
            ->with('route', $this->route);
    }

    public function authenticate(Request $r)
    {

        $credentials = $r->validate([
            'userid' => ['required'],
            'password' => ['required'],
            'hak_akses' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $r->session()->regenerate();

            return redirect()->intended('/pegawai/dashboard');
        }

        return back()->with('error', 'username dan password anda salah !');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/pegawai');
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

            return redirect('/pegawai/setting')->with('success', 'Account Successfully Updated');

        } else {
            return redirect('/pegawai/setting')->with('error', 'Password Failed To Save');
        }
    }
}
