<?php

namespace App\Http\Controllers;

use App\Models\role;
use Exception;
use Illuminate\Http\Request;

class roleController extends Controller
{
    public function getAll($id)
    {
        $data = [];
        $nextData = 0;
        $offset = ($id - 1) * 5;
        $page = $id;

        $data = role::getDataAll($offset);
        $nextData = role::getNextDataAll($offset);

        if (session('role') == 1) {
            return view('superAdmin.role', compact('data', 'nextData', 'page'));
        } elseif (session('role') == 2) {
            return view('manager.role', compact('data', 'nextData', 'page'));
        } elseif (session('role') == 3) {
            return redirect('/dashboard');
        } elseif (session('role') == 4) {
            return redirect('/dashboard');
        } elseif (session('role') == 5) {
            return redirect('/dashboard');
        }
    }

    public function actionRole(Request $request)
    {
        // dd($request);
        if ($request->action == 'add') {
            try {
                role::addData($request->namaRole);
                return redirect()->route('getRole', 1)->with('success', 'data berhasil ditambahkan');
            } catch (Exception $e) {
                return redirect()->route('getRole', 1)->with('failed', $e->getMessage());
            }
        } else {
            try {
                role::editData($request->idRole, $request->namaRole);
                return redirect()->route('getRole', 1)->with('success', 'data berhasil diperbarui');
            } catch (Exception $e) {
                return redirect()->route('getRole', 1)->with('failed', $e->getMessage());
            }
        }
    }
}
