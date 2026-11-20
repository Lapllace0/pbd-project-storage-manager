<?php

namespace App\Http\Controllers;

use App\Models\login;
use App\Models\managerDashboard;
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
                    'isLogin' => true,
                    'namaRole' => $userInData[0]->namaRole
                ]);

                return redirect('/dashboard');
            } else {
                return redirect('/')->with('error', 'username atau password salah');
            }
        } else {
            return redirect('/')->with('error', 'akun tidak ditemukan');
        }
    }

    public function toDashboard()
    {
        if (session('role') == 1) {
            return view('superAdmin.dashboard');
        } else if (session('role') == 2) {
            $pengadaanBulan = managerDashboard::pengadaanBulan();
            $pengadaanTahun = managerDashboard::pengadaanTahun();
            $penerimaanBulan = managerDashboard::penerimaanBulan();
            $penerimaanTahun = managerDashboard::penerimaanTahun();
            $penjualanBulan = managerDashboard::penjualanBulan();
            $penjualanTahun = managerDashboard::penjualanTahun();
            $keuntunganBulan = managerDashboard::keuntunganBulan();
            $keuntunganTahun = managerDashboard::keuntunganBulan();
            return view('manager.dashboard', compact('pengadaanBulan','pengadaanTahun','penerimaanBulan','penerimaanTahun','penjualanBulan','penjualanTahun','keuntunganBulan','keuntunganTahun'));
        } else if (session('role') == 3) {
            return view('admin.dashboard');
        } else if (session('role') ==  4) {
            return view('sGudang.dashboard');
        } else if (session('role') == 5) {
            return view('sPengadaan.dashboard');
        }
    }
}
