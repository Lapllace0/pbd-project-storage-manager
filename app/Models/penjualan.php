<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;



class penjualan extends Model
{
    public static function getDataAll(int $offset)
    {
        return DB::select('select * from lihat_penjualan order by idPenjualan desc limit 5 offset ?', [$offset]);
    }

    public static function getNextDataAll(int $offset)
    {
        return DB::select(
            'with dataA as (
            select * from lihat_penjualan order by idPenjualan desc limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5],
        );
    }


    public static function getBarang()
    {
        return DB::select('select * from getBarang where stock is not null and stock > 0');
    }

    public static function validateStok($idBarang) {
        return DB::select('select * from validateStockAfterInsert where idBarang = ? order by created_at desc limit 1', [$idBarang]);
    }

    public static function insertData($dataArray, $idUser) {
        DB::beginTransaction();
        try {
            $idPenjualan = DB::select('select insertReturnDPId(?) as idPenjualan', [$idUser]);
            foreach ($dataArray as $d) {
                DB::select('CALL insertDetailPenjualan(?,?,?)', [$d->jumlah, $idPenjualan[0]->idPenjualan, $d->idBarang]);
            }

            DB::select('CALL updatePenjualan(?)', [$idPenjualan[0]->idPenjualan]);

            DB::commit();

        } catch (QueryException $message) {
            DB::rollBack();
            throw $message;
        }
    }
}
