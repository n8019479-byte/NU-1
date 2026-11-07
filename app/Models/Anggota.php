<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggotas'; // Pastikan nama tabel benar

    // Tambahkan baris ini agar data bisa disimpan ke database
    protected $guarded = ['id']; 
}