<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daop extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'singkatan', 'nomenklatur', 'daop', 'id_region', 'bus_area'
    ];
    
}

