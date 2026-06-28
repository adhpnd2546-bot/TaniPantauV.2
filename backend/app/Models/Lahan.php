<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lahan extends Model
{
    protected $table = 'lahan';

    protected $fillable = [
        'petani_id', 'petugas_id', 'nama_lahan', 'komoditas', 'luas_lahan',
        'latitude', 'longitude', 'tanggal_tanam', 'status_fase'
    ];

    public function petani(): BelongsTo
    {
        return $this->belongsTo(Petani::class);
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function kunjungan(): HasMany
    {
        return $this->hasMany(KunjunganLahan::class, 'lahan_id');
    }
}
