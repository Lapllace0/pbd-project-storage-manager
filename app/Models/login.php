<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class login extends Model
{
    public static function getData(string $username) {
        return DB::select('select a.idUser, a.username, a.idRole, a.password, b.nama_role as namaRole from user a join role b on a.idRole = b.idRole where username = ? limit 1', [$username]);
    }
}
