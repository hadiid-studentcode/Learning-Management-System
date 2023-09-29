<?php

namespace App\Http\Controllers\SuperUser;

use App\Http\Controllers\Controller;
use App\Models\User;

class SuperUserController extends Controller
{
    protected $title;

    protected $userName;

    protected $nbm;

    protected $role = 'Super User';

    protected $route = 'super-user';

    protected $folder = 'super-user';

    protected $img;

    public function imageHeader()
    {
        $id = Auth()->user()->id;

        $result = new User();
        $user_admin = $result->viewDataFirst(['foto'], $id);

        if ($user_admin->foto == null) {
            $foto = '';
        } else {
            $foto = $user_admin->foto;
        }

        $this->img = $foto;

        return $this->img;
    }
}
