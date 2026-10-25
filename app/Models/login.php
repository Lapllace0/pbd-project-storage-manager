<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class login extends Model
{
    public static function getData(string $username) {
        return DB::select('select * from user where username = ? limit 1', [$username]);
    }
}
