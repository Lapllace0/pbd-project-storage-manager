<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class detailPenjualan extends Model
{
    public static function getDataAll($idPenjualan, $offset)
    {
        return DB::select('select * from lihat_detail_penjualan where idPenjualan = ? limit 5 offset ?', [$idPenjualan,$offset]);
    }

    public static function getNextDataAll($idPenjualan, $offset)
    {
        return DB::select(
            'with dataA as (
            select * from lihat_detail_penjualan where idPenjualan = ? limit 5 offset ?)
            select count(*) as total from dataA',
            [$idPenjualan,$offset + 5]
        );
    }

}
