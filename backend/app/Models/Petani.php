<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Petani extends Model
{
    protected $table = 'petani';

    protected $fillable = [
        'nama_petani', 'nik', 'alamat', 'kecamatan_id', 'desa_id', 'no_hp', 'petugas_id'
    ];

    public function lahan(): HasMany
    {
        return $this->hasMany(Lahan::class);
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
