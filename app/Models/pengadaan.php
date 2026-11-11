<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class pengadaan extends Model
{
    public static function getDataAll(int $offset)
    {
        return DB::select('select * from lihat_pengadaan order by timestamp desc limit 5 offset ?', [$offset]);
    }

    public static function getNextDataAll(int $offset)
    {
        return DB::select(
            'with dataA as (
            select * from lihat_pengadaan order by timestamp desc limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5],
        );
    }

    public static function getVendor()
    {
        return DB::select('select idVendor, nama_vendor from vendor');
    }

    public static function getDataActive(int $offset)
    {
        return DB::select('select * from lihat_pengadaan where status = 0 limit 5 offset ?', [$offset]);
    }

    public static function getNextDatActive(int $offset)
    {
        return DB::select(
            'with dataA as (
            select * from lihat_pengadaan where status = 0 limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5],
        );
    }

    public static function updatePengadaan($idPengadaan,$status, $idVendor, int $subTotal_nilai)
    {
        return DB::update('update pengadaan set status = ?, subTotal_nilai = ?, idVendor = ? where idPengadaan = ?', [$status, $subTotal_nilai, $idVendor, $idPengadaan]);
    }

    public static function deletePengadaan($id)
    {
        return DB::delete('delete from pengadaan where idPengadaan = ?', [$id]);
    }

    public static function addPengadaan($idUser, $status, $idVendor, $subTotal_nilai)
    {
        return DB::insert('insert into pengadaan (timestamp, idUser, status, idVendor, subTotal_nilai) values (now(),?,?,?,?)', [$idUser, $status, $idVendor, $subTotal_nilai]);
    }

}
