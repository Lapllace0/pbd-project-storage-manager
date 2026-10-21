<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\login;

use function PHPUnit\Framework\isEmpty;

class loginController extends Controller
{
    public function tryLogin(Request $request)
    {

        $userInData = login::getData($request->username);
        if (!isEmpty($userInData)) {

            if (password_verify($request->password, $userInData[0]->password)) {

                session([
                    'user_id' => $userInData[0]->idUser,
                    'username' => $userInData[0]->username,
                    'role' => $userInData[0]->idRole,
                    'isLogin' => true
                ]);

                return redirect('/dashboard');
            } else {
                return view('login', [
                    'error' => 'Username atau password salah'
                ]);
            }
        } else {
            return view('login', [
                'error' => 'Username atau password salah'
            ]);
        }
    }

    public function toDashboard() {
        if(session('role') == 1) {
            return view('dashboard_admin');
        } else if(session('role') == 2) {
            return view('dashboard_manager');
        } else {
            return view('dashboard_kasir');
        }
    }
}
