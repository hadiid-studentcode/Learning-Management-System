@extends('layouts.login.main')

@section('main')
    <form action="{{ asset('/' . $route . '/auth') }}" class="mt-6" method="POST">
        @csrf
        <input type="text" name="hak_akses" value="Pegawai" hidden>

        <div>
            <label class="block text-gray-700">Username</label>
            <input type="text" name="userid"
                class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none"
                autofocus autocomplete required>
        </div>

        <div class="mt-4">
            <label class="block text-gray-700">Password</label>
            <input type="password" minlength="" name="password"
                class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                  focus:bg-white focus:outline-none"
                required>
        </div>

        <button type="submit"
        class="w-full block bg-green-700 hover:bg-green-600 focus:bg-green-600 text-white font-semibold rounded-lg
            px-4 py-3 mt-6" style="font-size: 20px">Login</button>

    </form>
@endsection
