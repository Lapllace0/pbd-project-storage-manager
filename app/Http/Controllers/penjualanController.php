<?php

namespace App\Http\Controllers;

use App\Models\penjualan;
use Exception;
use Illuminate\Http\Request;

class penjualanController extends Controller
{
    public function getAll($id)
    {
        $data = [];
        $nextData = 0;
        $offset = ($id - 1) * 5;
        $page = $id;

        $data = penjualan::getDataAll($offset);
        $nextData = penjualan::getNextDataAll($offset);

        $barang = penjualan::getBarang();


        return view('superAdmin.penjualan', compact('data', 'nextData', 'page', 'barang'));
    }

    public function actionPenjualan(Request $request)
    {
        $dataArray = json_decode($request->dataArray, false);
        $idUser = (int) session('user_id');

        foreach ($dataArray as $d) {
            $data = penjualan::validateStok($d->idBarang);
            if ($d->jumlah > $data[0]->stock) {
                return redirect()->route('getPenjualan', 1)->with('failed', 'Jumlah Barang melebihi stok yang tersedia');
            }
        }

        try {
            penjualan::insertData($dataArray, $idUser);
            return redirect()->route('getPenjualan', [$request->filter, 1])->with('success', 'data berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->route('getPenjualan', [$request->filter, 1])->with('failed', $e->getMessage());
        }
    }
}
