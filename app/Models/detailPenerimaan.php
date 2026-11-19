<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class detailPenerimaan extends Model
{
    public static function getDataAll($idPenerimaan,int $offset)
    {
        return DB::select('select * from lihat_detail_penerimaan where idPenerimaan = ? limit 5 offset ?', [$idPenerimaan,$offset]);
    }

    public static function getNextDataAll($idPenerimaan,int $offset)
    {
        return DB::select(
            'with dataA as (
            select * from lihat_detail_penerimaan where idPenerimaan = ? limit 5 offset ?)
            select count(*) as total from dataA',
            [$idPenerimaan,$offset + 5]
        );
    }

}
