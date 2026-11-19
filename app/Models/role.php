<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class role extends Model
{
    public static function getDataAll($offset)
    {
        return DB::select('select * from role order by idRole limit 5 offset ?', [$offset]);
    }

    public static function getNextDataAll($offset)
    {
        return DB::select(
            'with dataA as (
            select * from role order by idRole limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5]
        );
    }

    public static function addData($namaRole)
    {
        return DB::insert('insert into role (nama_role) values (?)', [$namaRole]);
    }

    public static function editData($idRole, $namaRole)
    {
        return DB::update('update role set nama_role = ? where idRole = ?', [$namaRole, $idRole]);
    }
}
