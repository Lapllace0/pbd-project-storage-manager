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

        return view('superAdmin.role', compact('data', 'nextData', 'page'));
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
