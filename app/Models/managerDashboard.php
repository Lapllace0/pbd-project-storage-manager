<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class managerDashboard extends Model
{
    public static function pengadaanBulan()
    {
        return DB::select('select count(*) as jumlah from pengadaan where concat(month(timestamp)," / ",year(timestamp)) = concat(month(now())," / ",year(now()))');
    }

    public static function pengadaanTahun()
    {
        return DB::select('select count(*) as jumlah from pengadaan where year(timestamp) = year(now())');
    }

    public static function penerimaanBulan()
    {
        return DB::select('select count(*) as jumlah from penerimaan where concat(month(created_at)," / ",year(created_at)) = concat(month(now())," / ",year(now()))');
    }

    public static function penerimaanTahun()
    {
        return DB::select('select count(*) as jumlah from penerimaan where year(created_at) = year(now())');
    }

    public static function penjualanBulan()
    {
        return DB::select('select count(*) as jumlah from penjualan where concat(month(created_at)," / ",year(created_at)) = concat(month(now())," / ",year(now()))');
    }

    public static function penjualanTahun()
    {
        return DB::select('select count(*) as jumlah from penjualan where year(created_at) = year(now())');
    }

    public static function keuntunganBulan() {
        return DB::select('select * from keuntunganBulan');
    }

    public static function keuntunganTahun() {
        return DB::select('select * from keuntunganTahun');
    }
}
