<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewFile extends Model
{
    use HasFactory;
    public $table = 'filesystem';
    protected $fillable = [
        'sid',
        'filename',
        'fileLocation',
        'filesize',
        'fileDownloaded',
        'timeCreated'
    ];
}
