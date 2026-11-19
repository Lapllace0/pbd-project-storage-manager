<?php

namespace App\Http\Controllers;

use App\Models\users;
use Exception;
use Illuminate\Http\Request;

class usersController extends Controller
{
    public function getAll($id)
    {
        $data = [];
        $nextData = 0;
        $offset = ($id - 1) * 5;
        $page = $id;

        $data = users::getDataAll($offset);
        $nextData = users::getNextDataAll($offset);
        $role = users::getRole();

        return view('superAdmin.users', compact('data', 'nextData', 'page', 'role'));
    }

    public function actionUsers(Request $request)
    {
        // dd($request);
        if ($request->action == 'add') {
            try {
                users::addData($request->username, $request->role, $request->password);
                return redirect()->route('getUser', 1)->with('success', 'data berhasil ditambahkan');
            } catch (Exception $e) {
                return redirect()->route('getUser', 1)->with('failed', $e->getMessage());
            }
        } else {
            try {
                users::editData($request->idUser, $request->username, $request->role, $request->password);
                return redirect()->route('getUser', 1)->with('success', 'data berhasil diperbarui');
            } catch (Exception $e) {
                return redirect()->route('getUser', 1)->with('failed', $e->getMessage());
            }
        }
    }
}
