<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GmrsHd extends Model
{
    protected $table = 'gmrs_hd';
    protected $fillable = [
        'usid',
        'callsign',
        'status',
        'expiration'
    ];
}
