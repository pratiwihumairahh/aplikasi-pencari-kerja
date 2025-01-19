<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencariKerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'alamat',
        'telepon',
        'email',
        'pendidikan_terakhir',
        'keahlian',
        'pengalaman_kerja',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}
