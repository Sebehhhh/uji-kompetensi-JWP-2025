<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mobil extends Model
{
    protected $fillable = [
        'merek',
        'harga',
        'kapasitas_mesin',
        'jenis_mobil_id',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'kapasitas_mesin' => 'integer',
    ];

    public function jenisMobil(): BelongsTo
    {
        return $this->belongsTo(JenisMobil::class);
    }

    public function getKlasifikasiAttribute(): string
    {
        if ($this->kapasitas_mesin >= 2500) {
            return 'Kapasitas Mesin Besar';
        } elseif ($this->kapasitas_mesin >= 1500) {
            return 'Kapasitas Mesin Menengah';
        } else {
            return 'Kapasitas Mesin Kecil';
        }
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($mobil) {
            $klasifikasi = $mobil->getKlasifikasiAttribute();
            $jenisMobil = JenisMobil::firstOrCreate(['nama_jenis' => $klasifikasi]);
            $mobil->jenis_mobil_id = $jenisMobil->id;
        });

        static::updating(function ($mobil) {
            if ($mobil->isDirty('kapasitas_mesin')) {
                $klasifikasi = $mobil->getKlasifikasiAttribute();
                $jenisMobil = JenisMobil::firstOrCreate(['nama_jenis' => $klasifikasi]);
                $mobil->jenis_mobil_id = $jenisMobil->id;
            }
        });
    }
}
