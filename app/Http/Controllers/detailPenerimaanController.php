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




        return view('superAdmin.detail_penerimaan', compact('data', 'nextData', 'page', 'idPenerimaan'));
    }

}
