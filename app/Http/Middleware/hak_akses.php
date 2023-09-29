<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class hak_akses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$hak_akses): Response
    {

        if (in_array($request->user()->hak_akses, $hak_akses)) {
            return $next($request);

        }

        if ($request->user()->hak_akses == 'Super User') {
            return redirect('/super-user/dashboard');
        } elseif ($request->user()->hak_akses == 'Guru') {
            return redirect('/guru/dashboard');
        } elseif ($request->user()->hak_akses == 'Wali Murid') {
            return redirect('/wali-murid/dashboard');
        } elseif ($request->user()->hak_akses == 'Pegawai') {
            return redirect('/pegawai/dashboard');
        } elseif ($request->user()->hak_akses == 'Siswa') {
            return redirect('/siswa/dashboard');
        } elseif ($request->user()->hak_akses == 'Tata Usaha') {
            return redirect('/tata-usaha/dashboard');
        }

        dd('hak akses tidak ditemukan');

    }
}
