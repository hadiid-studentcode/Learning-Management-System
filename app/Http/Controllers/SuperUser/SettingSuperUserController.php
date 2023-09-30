<?php

namespace App\Http\Controllers\SuperUser;

use App\Models\User;
use Illuminate\Http\Request;

class SettingSuperUserController extends SuperUserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = auth()->user()->id;
        // panggil super user
        $result = new User();
        $getSuperUser = $result->getSuperUser($id);

        return view('superUser.setting.index')
            ->with('title', 'Setting')
            ->with('userName', $this->userName)
            ->with('role', $this->role)
            ->with('route', $this->route)
            ->with('folder', $this->folder)
            ->with('img', $this->img)
            ->with('SuperUser', $getSuperUser);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
