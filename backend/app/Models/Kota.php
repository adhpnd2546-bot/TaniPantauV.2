<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kota extends Model
{
    protected $table = 'kota';

    protected $fillable = ['provinsi_id', 'nama'];

    public function provinsi(): BelongsTo
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kecamatan(): HasMany
    {
        return $this->hasMany(Kecamatan::class);
    }
}
