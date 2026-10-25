<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class barang extends Model
{
    public static function getData() {
        return DB::select('select * from barang limit 10');
    }
}
