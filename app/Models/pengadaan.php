<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
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

    public static function getBarang()
    {
        return DB::select('select idBarang, nama from barang where status = 1');
    }

    public static function getVendor()
    {
        return DB::select('select idVendor, nama_vendor from vendor where status = 1');
    }

    public static function getDataActive(int $offset)
    {
        return DB::select('select * from lihat_pengadaan where status = 0 order by timestamp desc limit 5 offset ?', [$offset]);
    }

    public static function getNextDataActive(int $offset)
    {
        return DB::select(
            'with dataA as (
            select * from lihat_pengadaan where status = 0 order by timestamp desc limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5],
        );
    }

    public static function getDataDone(int $offset)
    {
        return DB::select('select * from lihat_pengadaan where status = 1 order by timestamp desc limit 5 offset ?', [$offset]);
    }

    public static function getNextDataDone(int $offset)
    {
        return DB::select(
            'with dataA as (
            select * from lihat_pengadaan where status = 1 order by timestamp desc limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5],
        );
    }

    public static function insertData($dataArray, $idUser, $idVendor)
    {
        DB::beginTransaction();
        try {
            $idPengadaan = DB::select('select insertReturnDPengId(?, ?) as idPengadaan', [$idUser, $idVendor]);

            foreach ($dataArray as $d) {
                DB::select('CALL insertDetailPengadaan(?,?,?)', [$d->jumlah, $idPengadaan[0]->idPengadaan, $d->idBarang]);
            }

            DB::select('CALL updatePengadaan(?)', [$idPengadaan[0]->idPengadaan]);

            DB::commit();
        } catch (QueryException $message) {
            DB::rollBack();
            throw $message;
        }
    }
}
