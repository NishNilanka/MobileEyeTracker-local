<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuxValue extends Model
{
    use HasFactory;
    public $table = 'luxvalues';
    protected $fillable = [
        'sid',
		'videoid',
        'luxvalue'
    ];
}
