<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class kartuStok extends Model
{

    public static function getDataAll(int $offset)
    {
        return DB::select('select * from lihat_kartu_stok limit 5 offset ?', [$offset]);
    }

    public static function getNextDataAll(int $offset)
    {
        return DB::select(
            'with dataA as (
            select * from lihat_kartu_stok limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5],
        );
    }

    public static function getDataMasuk(int $offset)
    {
        return DB::select('select * from lihat_kartu_stok where keluar = ? limit 5 offset ?', ['tidak ada',$offset]);
    }

    public static function getNextDataMasuk(int $offset)
    {

        return DB::select(
            'with dataA as (
            select * from lihat_kartu_stok where keluar = ?  limit 5 offset ?)
            select count(*) as total from dataA',
            ['tidak ada',$offset + 5],
        );
    }

    public static function getDataKeluar(int $offset)
    {
        return DB::select('select * from lihat_kartu_stok where masuk = ? limit 5 offset ?', ['tidak ada',$offset]);
    }

    public static function getNextDataKeluar(int $offset)
    {

        return DB::select(
            'with dataA as (
            select * from lihat_kartu_stok where masuk = ? limit 5 offset ?)
            select count(*) as total from dataA',
            ['tidak ada',$offset + 5],
        );
    }


    public static function updateKartuStok($jenisTransaksi, $masuk, $keluar, $idTransaksi, $idBarang , $idStok)
    {
        return DB::update('update kartu_stok set jenis_transaksi = ?, masuk = ?, keluar = ?, idTransaksi = ?, idBarang = ? where idKartu_stok = ?', [$jenisTransaksi, $masuk, $keluar, $idTransaksi, $idBarang, $idStok]);
    }

    public static function deleteKartuStok($id)
    {
        return DB::delete('delete from kartu_stok where idKartu_stok = ?', [$id]);
    }

    public static function addKartuStok($jenisTransaksi, $masuk, $keluar, $idTransaksi, $idBarang)
    {
        return DB::insert('insert into kartu_stok (jenis_transaksi,masuk,keluar,created_at,idTransaksi,idBarang) values (?,?,?,now(),?,?)', [$jenisTransaksi, $masuk, $keluar, $idTransaksi, $idBarang]);
    }

    public static function getBarang() {
        return DB::select('select idBarang, nama from barang');
    }
}
