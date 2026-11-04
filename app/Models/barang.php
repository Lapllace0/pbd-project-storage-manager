<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class barang extends Model
{
    public static function getDataAll(int $offset)
    {
        return DB::select('select * from lihat_barang limit 5 offset ?', [$offset]);
    }

    public static function getNextDataAll(int $offset) {
        return DB::select(
            'with dataA as (
            select * from lihat_barang limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5],
        );
    }

    public static function getDataActive(int $offset)
    {
        return DB::select('select * from lihat_barang where status = 1 limit 5 offset ?', [$offset]);
    }

    public static function getNextDataActive(int $offset) {
        return DB::select(
            'with dataA as (
            select * from lihat_barang where status = 1 limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5],
        );
    }

    public static function updateBarang($id, $jenis, $nama, $satuan, $harga, $status) {
        return DB::update('update barang set jenis = ?, nama = ?, idSatuan = ?, status = ?, harga = ? where idBarang = ?', [$jenis, $nama, $satuan, $status, $harga, $id]);
    }

    public static function deleteBarang($id) {
        return DB::delete('delete from barang where idBarang = ?', [$id]);
    }

    public static function addBarang($jenis, $nama, $satuan, $harga, $status) {
        return DB::insert('insert into barang (jenis,nama,idSatuan,harga,status) values (?,?,?,?,?)', [$jenis, $nama, $satuan, $harga, $status]);
    }
}
