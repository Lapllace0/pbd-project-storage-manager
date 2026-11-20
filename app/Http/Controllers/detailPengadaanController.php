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


        if (session('role') == 1) {
            return view('superAdmin.detail_pengadaan', compact('data', 'nextData', 'page', 'idPengadaan'));
        } elseif (session('role') == 2) {
            return view('manager.detail_pengadaan', compact('data', 'nextData', 'page', 'idPengadaan'));
        } elseif (session('role') == 3) {
            return redirect('/dashboard');
        } elseif (session('role') == 4) {
            return redirect('/dashboard');
        } elseif (session('role') == 5) {
            return view('sPengadaan.detail_pengadaan', compact('data', 'nextData', 'page', 'idPengadaan'));
        }
    }
}
