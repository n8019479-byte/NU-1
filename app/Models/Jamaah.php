<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jamaah extends Model
{
    use HasFactory;

   protected $fillable = [
    'nama', 'nik', 'email', 'banom',
    'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
    'rt_rw', 'nomor_kartanu', 'foto', 'verification_code',
    'is_approved', 'verified_at'
];
}