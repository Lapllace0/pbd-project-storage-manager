<?php

namespace App\Http\Controllers;

use App\Models\detailPenerimaan;
use Illuminate\Http\Request;
use Throwable;

class detailPenerimaanController extends Controller
{
    public function getAll($filter, $id)
    {
        $data = [];
        $nextData = 0;
        $offset = ($id - 1) * 5;
        $page = $id;

        if ($filter == 'all') {
            $data = detailPenerimaan::getDataAll($offset);
            $nextData = detailPenerimaan::getNextDataAll($offset);
        } elseif ($filter == 'masuk') {
            $data = detailPenerimaan::getDataMasuk($offset);
            $nextData = detailPenerimaan::getNextDataMasuk($offset);
        } elseif ($filter == 'keluar') {
            $data = detailPenerimaan::getDataKeluar($offset);
            $nextData = detailPenerimaan::getNextDataKeluar($offset);
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

        $dataBarang = detailPenerimaan::getBarang();
        $dataVendor = detailPenerimaan::getVendor();

        return view('superAdmin.detail_penerimaan', compact('data', 'nextData', 'page', 'filter', 'dataBarang', 'dataVendor'));
    }

    public function actionDetailPengadaan(Request $request)
    {
        $dataArray = json_decode($request->dataArray, false);
        $idUser = (int) session('user_id');

        try {
            detailPenerimaan::insertData($dataArray, $idUser, $request->idVendor);
            return redirect()->route('getDetailPengadaan', [$request->filter, 1])->with('success', 'data berhasil ditambahkan');
        } catch (Throwable $e) {
            return redirect()->route('getDetailPengadaan', [$request->filter, 1])->with('failed', $e->getMessage());
        }
    }
}
