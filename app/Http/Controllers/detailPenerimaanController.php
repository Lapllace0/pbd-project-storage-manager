<?php

namespace App\Http\Controllers;

use App\Models\detailPenerimaan;
use Illuminate\Http\Request;
use Throwable;

class detailPenerimaanController extends Controller
{
    public function getAll($idPenerimaan, $page)
    {
        $data = [];
        $nextData = 0;
        $offset = ($page - 1) * 5;
        $page = $page;


        $data = detailPenerimaan::getDataAll($idPenerimaan, $offset);
        $nextData = detailPenerimaan::getNextDataAll($idPenerimaan, $offset);



        if (session('role') == 1) {
            return view('superAdmin.detail_penerimaan', compact('data', 'nextData', 'page', 'idPenerimaan'));
        } elseif (session('role') == 2) {
            return view('manager.detail_penerimaan', compact('data', 'nextData', 'page', 'idPenerimaan'));
        } elseif (session('role') == 3) {
            return redirect('/dashboard');
        } elseif (session('role') == 4) {
            return view('sGudang.detail_penerimaan', compact('data', 'nextData', 'page', 'idPenerimaan'));
        } elseif (session('role') == 5) {
            return redirect('/dashboard');
        }
    }
}
