<?php

namespace App\Http\Controllers;

use App\Models\marginPenjualan;
use Exception;
use Illuminate\Http\Request;

class marginPenjualanController extends Controller
{
    public function getAll($filter, $id)
    {
        $data = [];
        $nextData = 0;
        $offset = ($id - 1) * 5;
        $page = $id;
        if ($filter == 'all') {
            $data = marginPenjualan::getDataAll($offset);
            $nextData = marginPenjualan::getNextDataAll($offset);
        } else {
            $data = marginPenjualan::getDataActive($offset);
            $nextData = marginPenjualan::getNextDataActive($offset);
        }

        if ($filter == 'all') {
            $nextFilter = 'active';
        } else {
            $nextFilter = 'all';
        }

        if (session('role') == 1) {
            return view('superAdmin.margin_penjualan', compact('data', 'nextData', 'page', 'filter', 'nextFilter'));
        } elseif (session('role') == 2) {
            return view('manager.margin_penjualan', compact('data', 'nextData', 'page', 'filter', 'nextFilter'));
            } elseif (session('role') == 3) {
            return view('admin.margin_penjualan', compact('data', 'nextData', 'page', 'filter', 'nextFilter'));
            } elseif (session('role') == 4) {
            return view('sGudang.margin_penjualan', compact('data', 'nextData', 'page', 'filter', 'nextFilter'));
            } elseif (session('role') == 5) {
            return view('sPengadaan.margin_penjualan', compact('data', 'nextData', 'page', 'filter', 'nextFilter'));
        }
    }

    public function actionMarginPenjualan(Request $request)
    {
        // dd($request);
        if ($request->action == 'add') {
            try {
                $exist = marginPenjualan::getSelectedMargin($request->persen);
                if (!empty($exist)) {
                    throw new Exception('Margin penjualan sudah ada');
                }
                marginPenjualan::addData($request->persen, $request->status, session('user_id'));
                return redirect()->route('getMarginPenjualan', ['all', 1])->with('success', 'data berhasil ditambahkan');
            } catch (Exception $e) {
                return redirect()->route('getMarginPenjualan', ['all', 1])->with('failed', $e->getMessage());
            }
        } else {
            try {
                $idMarginActive = marginPenjualan::getDataActive(0);
                $exist = marginPenjualan::getSelectedMargin($request->persen);

                if ($request->persen != $request->oldPersen && !empty($exist)) {
                    throw new Exception('Margin penjualan sudah ada');
                }

                if (!empty($idMarginActive)) {
                    if ((int) $idMarginActive[0]->idMargin_penjualan == (int) $request->idMargin && (int) $request->status == 0) {
                        throw new Exception('Tabel minimal memiliki 1 data aktif');
                    }
                }

                marginPenjualan::editData($request->status, session('user_id'), $request->idMargin);
                return redirect()->route('getMarginPenjualan', ['all', 1])->with('success', 'data berhasil diperbarui');
            } catch (Exception $e) {
                return redirect()->route('getMarginPenjualan', ['all', 1])->with('failed', $e->getMessage());
            }
        }
    }
}
