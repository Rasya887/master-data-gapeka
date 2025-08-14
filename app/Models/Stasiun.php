<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stasiun extends Model
{
    use HasFactory;

    protected $table = 'stasiuns';

    // Kalau memang tidak semua tabel punya auto-updated timestamps
    public $timestamps = false;

    protected $fillable = [
        'id_daop',
        'singkatan',
        'nama',
        'dpl',
        'kode',
        'aktif', // periksa apakah ini memang kolom "status" yang kamu maksud
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

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Relasi ke tabel Daop
     */
    public function daop()
    {
        return $this->belongsTo(Daop::class, 'id_daop');
    }
}
