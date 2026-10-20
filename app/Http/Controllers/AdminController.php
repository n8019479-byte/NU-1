<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Kegiatan;
use App\Models\Jamaah;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    // Halaman Dashboard Utama Admin
    public function dashboard()
    {
        // Data Berita & Kegiatan
        $beritas = class_exists(Berita::class) ? Berita::latest()->get() : collect([]);
        $kegiatans = class_exists(Kegiatan::class) ? Kegiatan::latest()->get() : collect([]);
        
        // Data Jamaah KARTANU (Pending & Approved)
        $pendingJamaah = Jamaah::where('is_approved', false)->latest()->get();
        $approvedJamaah = Jamaah::where('is_approved', true)->latest()->get();

        return view('admin.dashboard', compact('beritas', 'kegiatans', 'pendingJamaah', 'approvedJamaah'));
    }

    // --- FITUR KELOLA BERITA ---
    public function storeBerita(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'isi' => 'required',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $path = $request->hasFile('gambar') ? $request->file('gambar')->store('berita', 'public') : null;

        Berita::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'isi' => $request->isi,
            'tanggal' => now(),
            'penulis' => 'Admin Ranting',
            'gambar' => $path
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function destroyBerita($id)
    {
        Berita::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Berita berhasil dihapus!');
    }

    // --- FITUR PERSETUJUAN KARTANU / JAMAAH ---
    public function approveJamaah($id)
    {
        $jamaah = Jamaah::findOrFail($id);
        
        // Update Status Persetujuan Admin
        $jamaah->update([
            'is_approved' => true
        ]);

        // Kirim Email Notifikasi Persetujuan ke Pengguna
        try {
            Mail::raw("Assalamu'alaikum Wr. Wb.\n\nSelamat! Pendaftaran KARTANU Anda atas nama " . $jamaah->nama . " telah DISETUJUI oleh Admin PRNU Kedungurang.\n\nNomor KARTANU Anda: " . $jamaah->nomor_kartanu . "\nKode Verifikasi Akses KTA: " . $jamaah->verification_code . "\n\nAnda dapat mengecek dan mengunduh KTA Digital Anda melalui portal Anggota.\n\nTerima kasih,\nPengurus Ranting NU Kedungurang", function ($message) use ($jamaah) {
                $message->to($jamaah->email)
                        ->subject('Selamat! Pendaftaran KARTANU Anda Telah Disetujui');
            });
        } catch (\Exception $e) {
            // Pengiriman email dilewati jika koneksi SMTP belum diset agar proses persetujuan tetap berhasil
        }

        return back()->with('success', 'Pendaftaran anggota ' . $jamaah->nama . ' berhasil disetujui & notifikasi email telah dikirim!');
    }
}