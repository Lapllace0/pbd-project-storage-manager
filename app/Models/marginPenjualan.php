<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class marginPenjualan extends Model
{
    public static function getDataAll($offset)
    {
        return DB::select('select * from lihat_margin order by des_status asc, updated_at desc limit 5 offset ?', [$offset]);
    }

    public static function getNextDataAll($offset)
    {
        return DB::select(
            'with dataA as (
            select * from lihat_margin order by des_status asc, updated_at desc limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5]
        );
    }

    public static function getDataActive($offset)
    {
        return DB::select('select * from lihat_margin where status = 1 order by updated_at desc limit 5 offset ?', [$offset]);
    }

    public static function getNextDataActive($offset)
    {
        return DB::select(
            'with dataA as (
            select * from lihat_margin where status = 1 order by updated_at desc limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5]
        );
    }

    public static function getSelectedMargin($persen)
    {
        return DB::select('select * from margin_penjualan where persen = ?', [$persen]);
    }

    public static function addData($persen, $status, $idUser)
    {
        if ($status == 1) {
            DB::update('update margin_penjualan set status = 0 where status = 1');
            return DB::insert('CALL insertMarginPenjualan(?,?,?)', [$persen, $status, $idUser]);
        } else {
            return DB::insert('CALL insertMarginPenjualan(?,?,?)', [$persen, $status, $idUser]);
        }
    }

    public static function editData($persen, $status, $idUser, $idMargin)
    {
        if ($status == 1) {
            DB::update('update margin_penjualan set status = 0 where status = 1');
            return DB::update('update margin_penjualan set persen = ?, status = ?, idUser = ? where idMargin_penjualan = ?', [$persen, $status, $idUser, $idMargin]);
            } else {
            return DB::update('update margin_penjualan set persen = ?, status = ?, idUser = ? where idMargin_penjualan = ?', [$persen, $status, $idUser, $idMargin]);
        }
    }
}
