<?php

namespace App\Http\Controllers;

use App\Models\login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isEmpty;

class loginController extends Controller
{
    public function tryLogin(Request $request)
    {

        $userInData = login::getData(trim($request->username));
        if (!empty($userInData)) {

            if (Hash::check(trim($request->password), $userInData[0]->password)) {

                session([
                    'user_id' => $userInData[0]->idUser,
                    'username' => $userInData[0]->username,
                    'role' => $userInData[0]->idRole,
                    'isLogin' => true
                ]);

                return redirect('/dashboard');
            } else {
                return redirect('/')->with('error', 'username atau password salah');
            }
        } else {
            return redirect('/')->with('error','akun tidak ditemukan');
        }
    }

    public function toDashboard() {
        if(session('role') == 1) {
            return view('superAdmin.dashboard');
        } else if(session('role') == 2) {
            return view('dash_layout_manager');
        } else {
            return view('dash_layout_admin');
        }
    }
}
