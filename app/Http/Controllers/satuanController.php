<?php

namespace App\Http\Controllers;

use App\Models\satuan;
use Exception;
use Illuminate\Http\Request;

class satuanController extends Controller
{
    public function getAll($filter, $id)
    {
        $data = [];
        $nextData = 0;
        $offset = ($id - 1) * 5;
        $page = $id;


        if ($filter == 'all') {
            $data = satuan::getDataAll($offset);
            $nextData = satuan::getNextDataAll($offset);
        } else {
            $data = satuan::getDataActive($offset);
            $nextData = satuan::getNextDataActive($offset);
        }

        if ($filter == 'all') {
            $nextFilter = 'aktif';
        } else {
            $nextFilter = 'all';
        }

        return view('superAdmin.satuan', compact('data', 'nextData', 'page', 'filter', 'nextFilter'));
    }

    public function actionSatuan(Request $request)
    {
        // dd($request);
        if ($request->action == 'add') {
            try {
                satuan::addData($request->namaSatuan, $request->status);
                return redirect()->route('getSatuan', ['all', 1])->with('success', 'data berhasil ditambahkan');
            } catch (Exception $e) {
                return redirect()->route('getSatuan', ['all', 1])->with('failed', $e->getMessage());
            }
        } else {
            try {
                satuan::editData($request->namaSatuan, $request->status, $request->idSatuan);
                return redirect()->route('getSatuan', ['all', 1])->with('success', 'data berhasil diperbarui');
            } catch (Exception $e) {
                return redirect()->route('getSatuan', ['all', 1])->with('failed', $e->getMessage());
            }
        }
    }
}
