<?php
namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    // Tampilan Publik Jadwal Kegiatan
    public function index()
    {
        $kegiatans = Kegiatan::orderBy('tanggal', 'asc')->get();
        return view('kegiatan.index', compact('kegiatans'));
    }

    // Form Tambah Jadwal (Admin)
    public function create()
    {
        return view('admin.kegiatan.create');
    }

    // Simpan Jadwal Baru (Admin)
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'tanggal' => 'required|date',
            'waktu' => 'required|string|max:100',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Kegiatan::create($request->all());

        return redirect()->route('kegiatan.index')->with('success', 'Jadwal kegiatan berhasil ditambahkan!');
    }

    // Form Edit Jadwal (Admin)
    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    // Proses Update Jadwal (Admin)
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'tanggal' => 'required|date',
            'waktu' => 'required|string|max:100',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->update($request->all());

        return redirect()->route('kegiatan.index')->with('success', 'Jadwal kegiatan berhasil diperbarui!');
    }

    // Hapus Jadwal (Admin)
    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success', 'Jadwal kegiatan berhasil dihapus!');
    }
}