<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class detailPengadaan extends Model
{
    public static function getDataAll(int $offset)
    {
        return DB::select('select * from lihat_detail_pengadaan limit 5 offset ?', [$offset]);
    }

    public static function getNextDataAll(int $offset)
    {
        return DB::select(
            'with dataA as (
            select * from lihat_detail_pengadaan limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5],
        );
    }

    public static function getBarang()
    {
        return DB::select('select idBarang, nama from barang');
    }

    public static function getVendor()
    {
        return DB::select('select idVendor, nama_vendor from vendor');
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
