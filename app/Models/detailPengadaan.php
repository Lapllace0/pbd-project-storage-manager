<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class detailPengadaan extends Model
{
    public static function getDataAll($idPengadaan, $offset)
    {
        return DB::select('select * from lihat_detail_pengadaan where idPengadaan = ? limit 5 offset ?', [$idPengadaan,$offset]);
    }

    public static function getNextDataAll($idPengadaan, $offset)
    {
        return DB::select(
            'with dataA as (
            select * from lihat_detail_pengadaan where idPengadaan = ? limit 5 offset ?)
            select count(*) as total from dataA',
            [$idPengadaan,$offset + 5]
        );
    }

    public static function deletePengadaan($idPengadaan) {
        return DB::delete('delete from pengadaan where idPengadaan = ?', [$idPengadaan]);
    }
}
