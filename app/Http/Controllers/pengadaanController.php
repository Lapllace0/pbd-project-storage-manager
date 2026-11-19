<?php

namespace App\Http\Controllers;

use App\Models\pengadaan;
use Illuminate\Http\Request;

class pengadaanController extends Controller
{
    public function getAll($filter, $id)
    {
        $data = [];
        $nextData = 0;
        $offset = ($id - 1) * 5;
        $page = $id;

        if ($filter == 'all') {
            $data = pengadaan::getDataAll($offset);
            $nextData = pengadaan::getNextDataAll($offset);
        } elseif ($filter == 'proses') {
            $data = pengadaan::getDataActive($offset);
            $nextData = pengadaan::getNextDataActive($offset);
            } else {
            $data = pengadaan::getDataDone($offset);
            $nextData = pengadaan::getNextDataDone($offset);
        }

        $barang = pengadaan::getBarang();
        $vendor = pengadaan::getVendor();

        if ($filter == 'all') {
            $nextFilter = 'proses';
        } elseif ($filter == 'proses') {
            $nextFilter = 'selesai';
        } else {
            $nextFilter = 'all';
        }

        return view('superAdmin.pengadaan', compact('data', 'nextData', 'page', 'filter', 'nextFilter', 'vendor', 'barang'));
    }

    public function actionPengadaan(Request $request)
    {
        $dataArray = json_decode($request->dataArray, false);
        $idUser = (int) session('user_id');

        try {
            pengadaan::insertData($dataArray, $idUser, $request->idVendor);
            return redirect()->route('getPengadaan', [$request->filter, 1])->with('success', 'data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('getPengadaan', [$request->filter, 1])->with('failed', $e->getMessage());
        }
    }
}
