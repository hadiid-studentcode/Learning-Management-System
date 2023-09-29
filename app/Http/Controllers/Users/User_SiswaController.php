<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User_SIswaController extends UserController
{
    public function index()
    {
        $this->route = 'siswa';
        $this->role = 'Siswa';

        return view('siswa.login')
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

            return redirect()->intended('/siswa/dashboard');
        }

        return back()->with('error', 'username dan password anda salah !');
    }

    public function logout(Request $request): RedirectResponse
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/siswa');
    }

    public function update(Request $r, $username)
    {

        $validatedData = $r->validate([
            'password' => ['required', 'min:6'],
        ]);

        if ($r->input('password') == $r->input('confirmPassword')) {
            // enscripsi password
            $password = bcrypt($validatedData['password']);

            $data =
                [
                    'password' => $password,
                ];

            $result = new User();
            $result->updateData($username, $data);

            return redirect('/wali-murid/setting')->with('success', 'Account Successfully Updated');
        } else {
            return redirect('/wali-murid/setting')->with('error', 'Password Failed To Save');
        }
    }
}
