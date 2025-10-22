<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_perusahaan',
        'logo',
        'latitude',
        'longitude',
        'radius_meter',
        'masuk_start',
        'masuk_end',
        'pulang_start',
        'pulang_end',
    ];

    // Pastikan hanya ada satu konfigurasi
    public static function getConfig()
    {
        return self::first();
    }
}
