<?php


namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;

class barangController extends Controller
{

    public function getAll($filter, $id)
    {
        $data = [];
        $nextData = 0;
        $offset = ($id - 1) * 5;
        $page = $id;

        if ($filter == 'all') {
            $data = barang::getDataAll($offset);
            $nextData = barang::getNextDataAll($offset);
        } else {
            $data = barang::getDataActive($offset);
            $nextData = barang::getNextDataActive($offset);
        }

        if ($filter == 'all') {
            $nextFilter = 'active';
        } else {
            $nextFilter = 'all';
        }

        return view('superAdmin.barang', compact('data', 'nextData', 'page', 'filter', 'nextFilter'));
    }

    public function actionBarang(Request $request)
    {
        if ($request->action == 'update') {
            $status = barang::updateBarang($request->id, $request->jenis, $request->nama, $request->satuan, $request->harga, $request->status);
            if ($status) {
                return redirect()->route('getBarang', [$request->filter, 1])->with('success', 'update data berhasil');
            } else {
                return redirect()->route('getBarang', [$request->filter, 1])->with('failed', 'update data gagal');
            }
        } elseif ($request->action == 'delete') {
            $status = barang::deleteBarang($request->id);
            if ($status) {
                return redirect()->route('getBarang', [$request->filter, 1])->with('success', 'hapus data berhasil');
            } else {
                return redirect()->route('getBarang', [$request->filter, 1])->with('failed', 'hapus data gagal');
            }
        } elseif ($request->action == 'add') {
            $status = barang::addBarang($request->jenis, $request->nama, $request->satuan, $request->harga, $request->status);
            if ($status) {
                return redirect()->route('getBarang', [$request->filter, 1])->with('success', 'data berhasil ditambahkan');
            } else {
                return redirect()->route('getBarang', [$request->filter, 1])->with('failed', 'data gagal ditambahkan');
            }
        }

    }
}
