<?php

namespace App\Http\Controllers;

use App\Models\detailPengadaan;
use Illuminate\Http\Request;
use Throwable;

class detailPengadaanController extends Controller
{
    public function getAll($filter, $id)
    {
        $data = [];
        $nextData = 0;
        $offset = ($id - 1) * 5;
        $page = $id;

        if ($filter == 'all') {
            $data = detailPengadaan::getDataAll($offset);
            $nextData = detailPengadaan::getNextDataAll($offset);
        } elseif ($filter == 'masuk') {
            $data = detailPengadaan::getDataMasuk($offset);
            $nextData = detailPengadaan::getNextDataMasuk($offset);
        } elseif ($filter == 'keluar') {
            $data = detailPengadaan::getDataKeluar($offset);
            $nextData = detailPengadaan::getNextDataKeluar($offset);
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

        $dataBarang = detailPengadaan::getBarang();
        $dataVendor = detailPengadaan::getVendor();

        return view('superAdmin.detail_pengadaan', compact('data', 'nextData', 'page', 'filter', 'dataBarang', 'dataVendor'));
    }

    public function actionDetailPengadaan(Request $request)
    {
        $dataArray = json_decode($request->dataArray, false);
        $idUser = (int) session('user_id');

        try {
            detailPengadaan::insertData($dataArray, $idUser, $request->idVendor);
            return redirect()->route('getDetailPengadaan', [$request->filter, 1])->with('success', 'data berhasil ditambahkan');
        } catch (Throwable $e) {
            return redirect()->route('getDetailPengadaan', [$request->filter, 1])->with('failed', $e->getMessage());
        }
    }
}
