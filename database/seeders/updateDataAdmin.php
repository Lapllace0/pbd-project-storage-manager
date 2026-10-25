<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class updateDataAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::update('update user set
        username = ?, password = ? where idUser = 1' , ['super', Hash::make('superadmin123')]);

        DB::update('update user set
        username = ?, password = ? where idUser = 2' , ['manager', Hash::make('manager123')]);

        DB::update('update user set
        username = ?, password = ? where idUser = 3' , ['admin', Hash::make('admin123')]);

        DB::update('update user set
        username = ?, password = ?, idRole = ? where idUser = 4' , ['sgudang', Hash::make('staffgudang123'), 4]);

        DB::update('update user set
        username = ?, password = ?, idRole = ? where idUser = 5' , ['spengadaan', Hash::make('staffpengadaan123'), 5]);
    }
}
