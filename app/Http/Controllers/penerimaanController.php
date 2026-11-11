<?php

namespace App\Http\Controllers;

use App\Models\penerimaan;
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
        } else {
            $data = penerimaan::getDataActive($offset);
            $nextData = penerimaan::getNextDataActive($offset);
        }

        $dataPengadaan = penerimaan::getPengadaan();
        $dataUser = penerimaan::getUser();

        if ($filter == 'all') {
            $nextFilter = 'active';
        } else {
            $nextFilter = 'all';
        }

        return view('superAdmin.penerimaan', compact('data', 'nextData', 'page', 'filter', 'nextFilter', 'dataPengadaan', 'dataUser'));
    }

    public function actionPenerimaan(Request $request)
    {
        if ($request->action == 'update') {
            $status = penerimaan::updatePenerimaan($request->id, $request->status, $request->idPengadaan, $request->idUser);
            if ($status) {
                return redirect()->route('getPenerimaan', [$request->filter, 1])->with('success', 'update data berhasil');
            } else {
                return redirect()->route('getPenerimaan', [$request->filter, 1])->with('failed', 'update data gagal');
            }
        } elseif ($request->action == 'delete') {
            $status = penerimaan::deletePenerimaan($request->id);
            if ($status) {
                return redirect()->route('getPenerimaan', [$request->filter, 1])->with('success', 'hapus data berhasil');
            } else {
                return redirect()->route('getPenerimaan', [$request->filter, 1])->with('failed', 'hapus data gagal');
            }
        } elseif ($request->action == 'add') {
            $status = penerimaan::addPenerimaan($request->status, $request->idPengadaan, $request->idUser);
            if ($status) {
                return redirect()->route('getPenerimaan', [$request->filter, 1])->with('success', 'data berhasil ditambahkan');
            } else {
                return redirect()->route('getPenerimaan', [$request->filter, 1])->with('failed', 'data gagal ditambahkan');
            }
        }
    }
}
