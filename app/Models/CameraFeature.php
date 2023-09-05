<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CameraFeature extends Model
{
    use HasFactory;
	public $table = 'camerafeatures';
    protected $fillable = [
        'sid',
        'fps',
        'height',
        'width',
        'aspectratio'
    ];
}
