<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- PASTIKAN USE INI (FACADES), BUKAN CONTAINER ATTRIBUTES!

class BeritaController extends Controller
{
public function index()
{
    // Pastikan nama variabel $beritaTerbaru didefinisikan
    $beritaTerbaru = Berita::latest()->get();
    $beritaTerpopuler = Berita::latest()->take(4)->get(); // Atau disesuaikan

    return view('berita.index', compact('beritaTerbaru', 'beritaTerpopuler'));
}
    public function create()
    {
        return view('berita.create');
    }

    // SIMPAN BERITA BARU
    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required',
            'penulis' => 'required',
            'tanggal' => 'required|date',
            'isi'     => 'required',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['judul', 'penulis', 'tanggal', 'isi']);

        if ($request->hasFile('gambar')) {
            // Simpan gambar ke storage/app/public/berita
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil disimpan!');
    }
    public function show($id)
{
    $berita = Berita::findOrFail($id);
    
    // Ambil berita lainnya untuk rekomendasi/sidebar jika diperlukan
    $beritaLain = Berita::where('id', '!=', $id)->latest()->take(3)->get();

    return view('berita.show', compact('berita', 'beritaLain'));
}

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul'   => 'required',
            'penulis' => 'required',
            'tanggal' => 'required|date',
            'isi'     => 'required',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['judul', 'penulis', 'tanggal', 'isi']);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    // HAPUS BERITA (Sesuai error di gambar image_f63ac2.png)
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus file gambar dari disk public jika ada
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }
    public function apresiasi($id)
{
    $berita = Berita::findOrFail($id);
    $berita->increment('apresiasi'); // Menambah +1 nilai apresiasi di database secara permanen

    return response()->json([
        'success' => true,
        'total' => $berita->apresiasi
    ]);
}
}