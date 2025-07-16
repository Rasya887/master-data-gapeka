<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jarak extends Model
{
    use HasFactory;

    protected $table = 'jarak';
    
    protected $fillable = [
        'id_daop',
        'id_stasiun',
        'id_stasiun_sebelah',
        'id_lintas',
        'id_tahun_gapeka',
        'jarak',
        'puncak_kecepatan',
        'taspat',
        'puncak_kecepatan_barang',
        'status',
        'created_by',
        'updated_by',
        'approved_by',
        'created_at',
        'updated_at',
        'approved_at',
    ];

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    public function daop()
    {
        return $this->belongsTo(Daop::class, 'id_daop');
    }

    public function stasiun()
    {
        return $this->belongsTo(Stasiun::class, 'id_stasiun');
    }

    public function stasiunSebelah()
    {
        return $this->belongsTo(Stasiun::class, 'id_stasiun_sebelah');
    }
}
