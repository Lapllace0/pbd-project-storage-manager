<?php

namespace App\Http\Controllers;

use App\Models\detailPenjualan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Throwable;

class detailPenjualanController extends Controller
{
    public function getAll($idPenjualan, $page)
    {
        $data = [];
        $nextData = 0;
        $offset = ($page - 1) * 5;
        $page = $page;


        $data = detailPenjualan::getDataAll($idPenjualan, $offset);
        $nextData = detailPenjualan::getNextDataAll($idPenjualan, $offset);


        return view('superAdmin.detail_penjualan', compact('data', 'nextData', 'page', 'idPenjualan'));
    }

}
