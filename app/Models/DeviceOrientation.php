<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceOrientation extends Model
{
    use HasFactory;
    public $table = 'deviceorientations';
    protected $fillable = [
        'sid',
        'videoid',
        'frameNumber',
        'x',
        'y',
        'z'
    ];
}
