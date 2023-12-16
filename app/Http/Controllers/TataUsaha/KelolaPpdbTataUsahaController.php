<?php

namespace App\Http\Controllers\TataUsaha;

use Illuminate\Http\Request;

class KelolaPpdbTataUsahaController extends TataUsahaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tatausaha.ppdb.index')
            ->with('title', 'Dashboard')
            ->with('role', $this->role)
            ->with('img', $this->img)
            ->with('route', $this->route)
            ->with('folder', $this->folder)
        
        ;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
