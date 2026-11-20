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

        if (session('role') == 1) {
            return view('superAdmin.detail_penjualan', compact('data', 'nextData', 'page', 'idPenjualan'));
        } elseif (session('role') == 2) {
            return view('manager.detail_penjualan', compact('data', 'nextData', 'page', 'idPenjualan'));
        } elseif (session('role') == 3) {
            return view('admin.detail_penjualan', compact('data', 'nextData', 'page', 'idPenjualan'));
        } elseif (session('role') == 4) {
            return redirect('/dashboard');
        } elseif (session('role') == 5) {
            return redirect('/dashboard');
        }
    }
}
