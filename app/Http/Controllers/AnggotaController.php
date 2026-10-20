<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Menampilkan halaman direktori anggota dan KARTANU
     */
    public function index()
    {
        // Nantinya jika sudah ada tabel database 'anggotas', Anda bisa mengambilnya dengan:
        // $members = \App\Models\Anggota::latest()->paginate(6);
        
        return view('anggota.index');
    }
}