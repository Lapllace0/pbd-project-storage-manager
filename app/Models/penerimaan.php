<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class penerimaan extends Model
{
        public static function getDataAll(int $offset)
    {
        return DB::select('select * from lihat_penerimaan limit 5 offset ?', [$offset]);
    }

    public static function getNextDataAll(int $offset)
    {
        return DB::select(
            'with dataA as (
            select * from lihat_penerimaan limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5],
        );
    }

    public static function getPengadaan()
    {
        return DB::select('select idPengadaan, timestamp from pengadaan where status = 0 order by timestamp desc');
    }

    public static function getUser()
    {
        return DB::select('select idUser, username from user');
    }

    public static function getDataActive(int $offset)
    {
        return DB::select('select * from lihat_penerimaan where status = 0 limit 5 offset ?', [$offset]);
    }

    public static function getNextDatActive(int $offset)
    {
        return DB::select(
            'with dataA as (
            select * from lihat_penerimaan where status = 0 limit 5 offset ?)
            select count(*) as total from dataA',
            [$offset + 5],
        );
    }

    public static function updatePenerimaan($idPenerimaan,$status, $idPengadaan, int $idUser)
    {
        return DB::update('update penerimaan set status = ?, idPengadaan = ?, idUser = ? where idPenerimaan = ?', [$status, $idPengadaan, $idUser, $idPenerimaan]);
    }

    public static function deletePenerimaan($id)
    {
        return DB::delete('delete from penerimaan where idPenerimaan = ?', [$id]);
    }

    public static function addPenerimaan($status, $idPengadaan, int $idUser)
    {
        return DB::insert('insert into penerimaan (created_at, status, idPengadaan, idUser) values (now(),?,?,?)', [$status, $idPengadaan, $idUser]);
    }

}
