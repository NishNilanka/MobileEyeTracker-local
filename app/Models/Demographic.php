<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demographic extends Model
{
    use HasFactory;
    public $table = 'demographics';
    protected $fillable = [
        'sid',
        'age',
        'glasses',
        'gender',
        'deviceMobile'
    ];
}
