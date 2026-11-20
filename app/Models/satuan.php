<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class satuan extends Model
{
    public static function getDataAll($offset)
    {
        return DB::select('select * from lihat_satuan order by idSatuan limit 5 offset ?', [$offset]);
    }

    public static function getNextDataAll($offset)
    {
        return DB::select(
            'with dataA as (
            select * from satuan order by idSatuan limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5]
        );
    }

    public static function getDataActive($offset)
    {
        return DB::select('select * from lihat_satuan where status = 1 order by idSatuan limit 5 offset ?', [$offset]);
    }

    public static function getNextDataActive($offset)
    {
        return DB::select(
            'with dataA as (
            select * from satuan where status = 1 order by idSatuan limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5]
        );
    }

    public static function addData($namaSatuan, $status)
    {
        return DB::insert('insert into satuan (nama_satuan, status) values (?,?)', [$namaSatuan, $status]);
    }

    public static function editData($namaSatuan, $status, $idSatuan)
    {
        return DB::update('update satuan set nama_satuan = ?, status = ? where idSatuan = ?', [$namaSatuan, $status, $idSatuan]);
    }
}
