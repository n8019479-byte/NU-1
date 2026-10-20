<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggotas'; // atau nama tabel anggota di database Anda

    protected $fillable = [
        'nia',
        'nama',
        'nik',
        'gender',
        'dukuh',
        'banom',
        'statusKartanu',
        'foto',
    ];
}