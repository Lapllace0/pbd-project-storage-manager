<?php

namespace App\Http\Controllers;

use App\Models\vendor;
use Illuminate\Http\Request;

class vendorController extends Controller
{
    public function getAll($filter, $id)
    {
        $data = [];
        $nextData = 0;
        $offset = ($id - 1) * 5;
        $page = $id;

        if ($filter == 'all') {
            $data = vendor::getDataAll($offset);
            $nextData = vendor::getNextDataAll($offset);
        } else {
            $data = vendor::getDataActive($offset);
            $nextData = vendor::getNextDataActive($offset);
        }

        if ($filter == 'all') {
            $nextFilter = 'active';
        } else {
            $nextFilter = 'all';
        }

        return view('superAdmin.vendor', compact('data', 'nextData', 'page', 'filter', 'nextFilter'));
    }

    public function actionVendor(Request $request)
    {
        if ($request->action == 'update') {
            $status = vendor::updateVendor($request->id, $request->namaVendor, $request->badanHukum, $request->status);
            if ($status) {
                return redirect()->route('getVendor', [$request->filter, 1])->with('success', 'update data berhasil');
            } else {
                return redirect()->route('getVendor', [$request->filter, 1])->with('failed', 'update data gagal');
            }
        } elseif ($request->action == 'delete') {
            $status = vendor::deleteVendor($request->id);
            if ($status) {
                return redirect()->route('getVendor', [$request->filter, 1])->with('success', 'hapus data berhasil');
            } else {
                return redirect()->route('getVendor', [$request->filter, 1])->with('failed', 'hapus data gagal');
            }
        } elseif ($request->action == 'add') {
            $status = vendor::addVendor($request->namaVendor, $request->badanHukum, $request->status);
            if ($status) {
                return redirect()->route('getVendor', [$request->filter, 1])->with('success', 'data berhasil ditambahkan');
            } else {
                return redirect()->route('getVendor', [$request->filter, 1])->with('failed', 'data gagal ditambahkan');
            }
        }
    }
}
