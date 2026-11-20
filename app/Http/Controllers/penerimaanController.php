<?php

namespace App\Http\Controllers;

use App\Models\penerimaan;
use Exception;
use Illuminate\Http\Request;

class penerimaanController extends Controller
{
    public function getAll($filter, $id)
    {
        $data = [];
        $nextData = 0;
        $offset = ($id - 1) * 5;
        $page = $id;

        if ($filter == 'all') {
            $data = penerimaan::getDataAll($offset);
            $nextData = penerimaan::getNextDataAll($offset);
        } elseif ($filter == 'proses') {
            $data = penerimaan::getDataActive($offset);
            $nextData = penerimaan::getNextDataActive($offset);
        } else {
            $data = penerimaan::getDataDone($offset);
            $nextData = penerimaan::getNextDataDone($offset);
        }

        $pengadaan = penerimaan::getPengadaanActive();

        if ($filter == 'all') {
            $nextFilter = 'proses';
        } elseif ($filter == 'proses') {
            $nextFilter = 'selesai';
        } elseif ($filter == 'selesai') {
            $nextFilter = 'all';
        }

        if (session('role') == 1) {
            return view('superAdmin.penerimaan', compact('data', 'nextData', 'page', 'filter', 'nextFilter', 'pengadaan'));
        } elseif (session('role') == 2) {
            return view('manager.penerimaan', compact('data', 'nextData', 'page', 'filter', 'nextFilter', 'pengadaan'));
        } elseif (session('role') == 3) {
            return redirect('/dashboard');
        } elseif (session('role') == 4) {
            return view('sGudang.penerimaan', compact('data', 'nextData', 'page', 'filter', 'nextFilter', 'pengadaan'));
        } elseif (session('role') == 5) {
            return redirect('/dashboard');
        }
    }

    public function actionPenerimaan(Request $request)
    {
        $dataArray = json_decode($request->dataArray, false);
        $idUser = (int) session('user_id');

        try {
            penerimaan::insertData($dataArray, $idUser, $request->idPengadaan);
            return redirect()->route('getPenerimaan', [$request->filter, 1])->with('success', 'data berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->route('getPenerimaan', [$request->filter, 1])->with('failed', $e->getMessage());
        }
    }

    public function getBarang(int $idPengadaan)
    {
        try {
            $data = penerimaan::getBarangPenerimaanActive($idPengadaan);
            return $data;
        } catch (Exception $e) {
            return [0];
        }
    }
}
