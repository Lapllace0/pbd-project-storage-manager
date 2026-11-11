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
        } else {
            $data = pengadaan::getDataActive($offset);
            $nextData = pengadaan::getNextDataActive($offset);
        }

        $vendor = pengadaan::getVendor();

        if ($filter == 'all') {
            $nextFilter = 'active';
        } else {
            $nextFilter = 'all';
        }

        return view('superAdmin.pengadaan', compact('data', 'nextData', 'page', 'filter', 'nextFilter', 'vendor'));
    }

    public function actionPengadaan(Request $request)
    {
        if ($request->action == 'update') {
            $status = pengadaan::updatePengadaan($request->id,$request->status, $request->vendor, $request->subTotal_nilai);
            if ($status) {
                return redirect()->route('getPengadaan', [$request->filter, 1])->with('success', 'update data berhasil');
            } else {
                return redirect()->route('getPengadaan', [$request->filter, 1])->with('failed', 'update data gagal');
            }
        } elseif ($request->action == 'delete') {
            $status = pengadaan::deletePengadaan($request->id);
            if ($status) {
                return redirect()->route('getPengadaan', [$request->filter, 1])->with('success', 'hapus data berhasil');
            } else {
                return redirect()->route('getPengadaan', [$request->filter, 1])->with('failed', 'hapus data gagal');
            }
        } elseif ($request->action == 'add') {
            $status = pengadaan::addPengadaan(session('user_id'), $request->status, $request->vendor, $request->subTotal_nilai);
            if ($status) {
                return redirect()->route('getPengadaan', [$request->filter, 1])->with('success', 'data berhasil ditambahkan');
            } else {
                return redirect()->route('getPengadaan', [$request->filter, 1])->with('failed', 'data gagal ditambahkan');
            }
        }
    }
}
