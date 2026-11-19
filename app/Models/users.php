<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class users extends Model
{
    public static function getDataAll($offset)
    {
        return DB::select('select idUser, username, idRole from user order by idUser limit 5 offset ?', [$offset]);
    }

    public static function getNextDataAll($offset)
    {
        return DB::select(
            'with dataA as (
            select idUser, username, idRole from user order by idUser limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5]
        );
    }

    public static function getRole()
    {
        return DB::select('select * from role');
    }

    public static function addData($username, $idRole, $password)
    {
        return DB::insert('insert into user (username, idRole, password) values (?,?,?)', [$username, $idRole, Hash::make($password)]);
    }

    public static function editData($idUser, $username, $idRole, $password)
    {
        if ($password == '') {
            return DB::update('update user set username = ?, idRole = ? where idUser = ? ', [$username, $idRole, $idUser]);
        } else {
            return DB::update('update user set username = ?, idRole = ?, password = ? where idUser = ?', [$username, $idRole, Hash::make($password), $idUser]);
        }
    }
}
