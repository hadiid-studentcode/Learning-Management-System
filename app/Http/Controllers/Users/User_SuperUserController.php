<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User_SuperUserController extends UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->role = 'Super User';
        $this->route = 'super-user';

        return view('superuser.login')
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

            return redirect()->intended('/super-user/dashboard');
        }

        return back()->with('error', 'username dan password anda salah !');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/super-user');
    }

    public function update(Request $r, $id)
    {

        $validatedData = $r->validate([
            'username' => ['required'],
            'password' => ['required', 'min:6'],
        ]);

        if ($r->input('password') == $r->input('confirmPassword')) {

            // enscripsi password
            $password = bcrypt($validatedData['password']);

            $data =
                [
                    'userid' => $validatedData['username'],
                    'password' => $password,
                ];

            $result = new User();
            $result->updateData($id, $data);

            return back()->with('success', 'Account Successfully Updated');
        } else {
            return back()->with('error', 'Password Failed To Save');
        }
    }
}
