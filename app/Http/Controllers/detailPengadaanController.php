<?php

namespace App\Http\Controllers;

use App\Models\detailPengadaan;
use Illuminate\Http\Request;
use Throwable;

class detailPengadaanController extends Controller
{
    public function getAll($idPengadaan, $page)
    {
        $data = [];
        $nextData = 0;
        $offset = ($page - 1) * 5;
        $page = $page;


        $data = detailPengadaan::getDataAll($idPengadaan, $offset);
        $nextData = detailPengadaan::getNextDataAll($idPengadaan, $offset);



        // $dataMargin = penjualan::getBarang();

        // yang di comment belum dimasukin di parameter return view



        return view('superAdmin.detail_pengadaan', compact('data', 'nextData', 'page', 'idPengadaan'));
    }

}
