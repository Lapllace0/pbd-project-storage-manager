<?php

namespace App\Http\Controllers;

use App\Models\detailPenjualan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Throwable;

class detailPenjualanController extends Controller
{
        public function getAll($filter, $id)
    {
        $data = [];
        $nextData = 0;
        $offset = ($id - 1) * 5;
        $page = $id;

        if ($filter == 'all') {
            $data = detailPenjualan::getDataAll($offset);
            $nextData = detailPenjualan::getNextDataAll($offset);
        } elseif ($filter == 'masuk') {
            $data = detailPenjualan::getDataMasuk($offset);
            $nextData = detailPenjualan::getNextDataMasuk($offset);
        } elseif ($filter == 'keluar') {
            $data = detailPenjualan::getDataKeluar($offset);
            $nextData = detailPenjualan::getNextDataKeluar($offset);
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

        $dataBarang = detailPenjualan::getBarang();

        return view('superAdmin.detail_penjualan', compact('data', 'nextData', 'page', 'filter', 'dataBarang'));
    }

    public function actionDetailPenjualan(Request $request) {
        $dataArray = json_decode($request->dataArray, false);
        $idUser = (int) session('user_id');

        try {
            detailPenjualan::insertData($dataArray, $idUser);
            return redirect()->route('getDetailPenjualan', [$request->filter, 1])->with('success', 'data berhasil ditambahkan');
        } catch (Throwable $e) {
            return redirect()->route('getDetailPenjualan', [$request->filter, 1])->with('failed', $e->errorInfo[2]);
        }

    }
}
