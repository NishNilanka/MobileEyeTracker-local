<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceModel extends Model
{
    use HasFactory;
	public $table = 'devicemodels';
    protected $fillable = [
        'sid',
        'brand',
        'model',
        'useragent',
		'dpr'
    ];
}
