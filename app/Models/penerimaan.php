<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class penerimaan extends Model
{
    public static function getDataAll(int $offset)
    {
        return DB::select('select * from lihat_penerimaan order by created_at desc limit 5 offset ?', [$offset]);
    }

    public static function getNextDataAll(int $offset)
    {
        return DB::select(
            'with dataA as (
            select * from lihat_penerimaan order by created_at desc limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5],
        );
    }

    public static function getDataActive($offset)
    {
        return DB::select('select * from getPenerimaanAktif order by created_at desc limit 5 offset ?', [$offset]);
    }


    public static function getNextDataActive($offset)
    {
        return DB::select(
            'with dataA as (
            select * from getPenerimaanAktif order by created_at desc limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5],
        );
    }

    public static function getDataDone(int $offset)
    {
        return DB::select('select * from getPenerimaanSelesai order by created_at desc limit 5 offset ?', [$offset]);
    }

    public static function getNextDataDone(int $offset)
    {
        return DB::select(
            'with dataA as (
            select * from getPenerimaanSelesai order by created_at desc limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5],
        );
    }

    public static function getPengadaanActive()
    {
        return DB::select('select * from pengadaan where status = 0');
    }

    public static function getBarangPenerimaanActive($idPengadaan) {
        return DB::select('select * from lihat_barang_penerimaan_active where idPengadaan = ?', [$idPengadaan]);
    }


    public static function insertData($dataArray, $idUser, $idPengadaan)
    {
        DB::beginTransaction();
        try {
            $idPenerimaan = DB::select('select insertReturnPenId(?, ?) as idPenerimaan', [$idPengadaan, $idUser]);

            foreach ($dataArray as $d) {
                DB::select('CALL insertDetailPenerimaan(?,?,?,?)', [$idPenerimaan[0]->idPenerimaan, $d->idBarang, $d->jumlah, $d->harga]);
            }
            DB::commit();
        } catch (QueryException $message) {
            DB::rollBack();
            throw $message;
        }
    }
}
