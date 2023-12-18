<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GmrsEn extends Model
{
    protected $table = 'gmrs_en';
    protected $fillable = [
        'frn',
        'usid'
    ];
}
