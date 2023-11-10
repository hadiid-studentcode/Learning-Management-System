<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_lengkap',
        'email',
        'userid',
        'password',
        'foto',
        'hak_akses',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function idKepalaSekolahUser()
    {
        $result = DB::table('users')
            ->select('id')
            ->where('hak_akses', '=', 'Super User')
            ->first();

        return $result;
    }

    public function getSuperUser($id)
    {
        $result = DB::table('users')
            ->select('id', 'userid')
            ->where('id', '=', $id)
            ->first();

        return $result;
    }

    public function updateUserName($id, $dataUsers)
    {

        $result = DB::table('users')
            ->where('id', '=', $id)
            ->update($dataUsers);

        return $result;
    }

    public function updateUserNameandfotoSiswa($nisn, $dataUsers)
    {

        $result = DB::table('users')
            ->where('userid', '=', $nisn)
            ->update($dataUsers);

        return $result;
    }

    public function updateData($id_user, $data)
    {
        $result = DB::table('users')
            ->where('id', '=', $id_user)
            ->update($data);

        return $result;
    }

    public function getUserWaliMurid($id)
    {
        $result = DB::table('users')
            ->select('id', 'userid')
            ->where('id', '=', $id)
            ->first();

        return $result;
    }

    public function getUserSiswa($id)
    {
        $result = DB::table('users')
            ->select('id', 'userid', 'nama_lengkap')
            ->where('id', '=', $id)
            ->first();

        return $result;
    }

    public function viewDataFirst($select, $id)
    {

        $result = DB::table('users')
            ->select($select)
            ->where('id', '=', $id)
            ->first();

        return $result;
    }

    public function saveUsers($data)
    {
        return User::create($data);
    }

    // public function getUsers()
    // {
    //     $result = DB::table('users')
    //         ->select('users.*', 'siswa.id_user as siswa_id_user', 'guru.id_user as guru_id_user', 'pegawai.id_user as pegawai_id_user', 'wali_murid.id_user as wali_murid_id_user')
    //         ->leftjoin('siswa', 'siswa.id_user', '=', 'users.id')
    //         ->leftJoin('guru', 'guru.id_user', '=', 'users.id')
    //         ->leftJoin('pegawai', 'pegawai.id_user', '=', 'users.id')
    //         ->leftJoin('wali_murid', 'wali_murid.id_user', '=', 'users.id')
    //         ->get();

    //     return $result;
    // }

    public function getUsers()
    {
        $result = DB::table('users')
            ->select('id', 'nama_lengkap', 'userid', 'hak_akses')
            ->WhereNot('users.hak_akses', '=', 'Super User')
            ->WhereNot('users.userid', '=', 'admintu')

            ->get();

        return $result;
    }

    public function getUsersAdmintu()
    {
        $result = DB::table('users')
            ->select('id', 'nama_lengkap', 'userid', 'hak_akses')
            ->get();

        return $result;
    }

    public function getLastIdUser()
    {
        $result = DB::table('users')
            ->select('id')
            ->orderBy('id', 'desc')
            ->first();

        return $result;
    }

    public function deleteUser($id)
    {
        $result = DB::table('users')
            ->where('id', '=', $id)
            ->delete();

        return $result;
    }

    public function lastIdUser()
    {
        // panggil ide user yang terakhir
        $result = new User();
        $id_user = $result->getLastIdUser();
        $id = $id_user->id;

        return $id;
    }

    public function updateUser($user_id, $data)
    {
        $result = DB::table('users')
            ->where('id', '=', $user_id)
            ->update($data);

        return $result;
    }
}
