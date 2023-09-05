<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DataExport extends Model
{
    use HasFactory;

    protected $table = "demographics";

    public static function getData()
    {
        $records = DB::table('demographics')->select('id', 'sid', 'age', 'glasses', 'gender', 'deviceMobile', 'created_at', 'updated_at')->get()->toArray();
        return $records;
    }

}
