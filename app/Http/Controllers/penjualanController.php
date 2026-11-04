<?php

namespace App\Http\Controllers;

use App\Models\penjualan;
use Illuminate\Http\Request;

class penjualanController extends Controller
{
    public function getAll($filter, $id)
    {
        $data = [];
        $nextData = 0;
        $offset = ($id - 1) * 5;
        $page = $id;

        if ($filter == 'all') {
            $data = penjualan::getDataAll($offset);
            $nextData = penjualan::getNextDataAll($offset);
        } elseif ($filter == 'masuk') {
            $data = penjualan::getDataMasuk($offset);
            $nextData = penjualan::getNextDataMasuk($offset);
        } elseif ($filter == 'keluar') {
            $data = penjualan::getDataKeluar($offset);
            $nextData = penjualan::getNextDataKeluar($offset);
        }

        // if ($filter == 'all') {
        //     $nextFilter = 'masuk';
        // } elseif ($filter == 'masuk') {
        //     $nextFilter = 'keluar';
        // } elseif ($filter == 'keluar') {
        //     $nextFilter = 'all';
        // }

        // $dataMargin = penjualan::getBarang();

        // yang di comment belum dimasukin di parameter return view

        return view('superAdmin.penjualan', compact('data', 'nextData', 'page', 'filter'));
    }
}
