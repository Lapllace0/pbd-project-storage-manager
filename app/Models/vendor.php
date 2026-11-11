<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class vendor extends Model
{
    public static function getDataAll(int $offset)
    {
        return DB::select('select * from lihat_vendor limit 5 offset ?', [$offset]);
    }

    public static function getNextDataAll(int $offset)
    {
        return DB::select(
            'with dataA as (
            select * from lihat_vendor limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5],
        );
    }

    public static function getDataActive(int $offset)
    {
        return DB::select('select * from lihat_vendor where status_code = 1 limit 5 offset ?', [$offset]);
    }

    public static function getNextDataActive(int $offset)
    {
        return DB::select(
            'with dataA as (
            select * from lihat_vendor where status_code = 1 limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5],
        );
    }

     public static function updateVendor($id, $nama, $badan_hukum, $status) {
        return DB::update('update vendor set nama_vendor = ?, badan_hukum = ?, status = ? where idVendor = ?', [$nama, $badan_hukum, $status, $id]);
    }

    public static function deleteVendor($id) {
        return DB::delete('delete from vendor where idVendor = ?', [$id]);
    }

    public static function addVendor($nama, $badan_hukum, $status) {
        return DB::insert('insert into vendor (nama_vendor,badan_hukum,status) values (?,?,?)', [$nama, $badan_hukum, $status]);
    }
}
