<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stasiun extends Model
{
    use HasFactory;

    protected $table = 'stasiuns';

    public $timestamps = false;

    protected $fillable = [
        'id_daop',
        'singkatan',
        'nama',
        'dpl',
        'kode',
        'aktif',
        'kotak',
        'garis_tipis',
        'garis_tebal',
        'perhentian',
        'batas_daop',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'track',
        'ppkt',
    ];

    // 🧠 Tambahkan ini:
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function daop()
    {
        return $this->belongsTo(Daop::class, 'id_daop');
    }
}


