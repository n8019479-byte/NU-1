<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumentasi;
use Illuminate\Support\Facades\Storage;

class AdminDokumentasiController extends Controller
{
    public function create()
    {
        return view('admin.dokumentasi.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'kategori' => 'nullable|string|max:100',
        'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    // Menyimpan ke storage/app/public/dokumentasi
    $path = $request->file('foto')->store('dokumentasi', 'public');

    Dokumentasi::create([
        'judul' => $request->judul,
        'kategori' => $request->kategori ?? 'Dokumentasi',
        'foto' => $path,
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Foto berhasil diunggah!');
}

    public function destroy($id)
    {
        $dok = Dokumentasi::findOrFail($id);
        if ($dok->foto) {
            Storage::disk('public')->delete($dok->foto);
        }
        $dok->delete();

        return redirect()->back()->with('success', 'Foto dokumentasi berhasil dihapus!');
    }
    
}