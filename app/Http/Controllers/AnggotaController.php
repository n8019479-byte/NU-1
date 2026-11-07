<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota; // Pastikan Model di-import

class AnggotaController extends Controller
{
    // Fungsi untuk memproses pendaftaran anggota baru
  public function store(Request $request)
{
    // Validasi data
    $validated = $request->validate([
        'nama' => 'required',
        'nia' => 'required|unique:anggotas,nia',
        // field lainnya...
    ]);

    // Simpan ke database MySQL secara permanen
    $anggota = Anggota::create($validated);

    // Simpan ke session untuk menampilkan kartu
    session(['kta_found' => $anggota]);

    return redirect()->route('anggota.index')->with('success', 'KTA berhasil dibuat!');
}

    // Fungsi untuk menampilkan profil berdasarkan NIA (dari scan QR Code)
  public function showProfile($nia)
{
    // Cari data berdasarkan kolom 'nia'
    $anggota = Anggota::where('nia', trim($nia))->first();

    // Jika tidak ketemu di database, hentikan dengan pesan 404 yang jelas
    if (!$anggota) {
        abort(404, 'Data anggota dengan NIA tersebut tidak ditemukan di database.');
    }

    return view('anggota.profil', compact('anggota'));
}
}
