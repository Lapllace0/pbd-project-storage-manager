<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class penjualan extends Model
{
    public static function getDataAll(int $offset)
    {
        return DB::select('select * from lihat_penjualan limit 5 offset ?', [$offset]);
    }

    public static function getNextDataAll(int $offset)
    {
        return DB::select(
            'with dataA as (
            select * from lihat_penjualan limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5],
        );
    }
}
