<?php

namespace App\Http\Controllers;

use App\Models\kartuStok;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class kartuStokController extends Controller
{
    public function getAll($filter, $id)
    {
        $data = [];
        $nextData = 0;
        $offset = ($id - 1) * 5;
        $page = $id;

        if ($filter == 'all') {
            $data = kartuStok::getDataAll($offset);
            $nextData = kartuStok::getNextDataAll($offset);
        } elseif ($filter == 'masuk') {
            $data = kartuStok::getDataMasuk($offset);
            $nextData = kartuStok::getNextDataMasuk($offset);
        } elseif ($filter == 'keluar') {
            $data = kartuStok::getDataKeluar($offset);
            $nextData = kartuStok::getNextDataKeluar($offset);
        }

        if ($filter == 'all') {
            $nextFilter = 'masuk';
        } elseif ($filter == 'masuk') {
            $nextFilter = 'keluar';
        } elseif ($filter == 'keluar') {
            $nextFilter = 'all';
        }

        $dataBarang = kartuStok::getBarang();

        return view('superAdmin.kartu_stok', compact('data', 'nextData', 'page', 'filter', 'nextFilter', 'dataBarang'));
    }

    public function actionStock(Request $request)
    {
        if ($request->action == 'update') {
            try {
                $status = kartuStok::updateKartuStok($request->jenisTransaksi, $request->masuk, $request->keluar, $request->idTransaksi, $request->idBarang, $request->id);
                return redirect()->route('getKartuStok', [$request->filter, 1])->with('success', 'update data berhasil');
            } catch (QueryException $e) {
                return redirect()->route('getKartuStok', [$request->filter, 1])->with('failed', $e->errorInfo[2]);
            }
        } elseif ($request->action == 'delete') {
            $status = kartuStok::deleteKartuStok($request->id);
            if ($status) {
                return redirect()->route('getKartuStok', [$request->filter, 1])->with('success', 'hapus data berhasil');
            } else {
                return redirect()->route('getKartuStok', [$request->filter, 1])->with('failed', 'hapus data gagal');
            }
        } elseif ($request->action == 'add') {
            try {
                $status = kartuStok::addKartuStok($request->jenisTransaksi, $request->masuk, $request->keluar, $request->idTransaksi, $request->idBarang);
                return redirect()->route('getKartuStok', [$request->filter, 1])->with('success', 'data berhasil ditambahkan');
            } catch (QueryException $e) {
                return redirect()->route('getKartuStok', [$request->filter, 1])->with('failed', $e->errorInfo[2]);
            }
        }
    }
}
