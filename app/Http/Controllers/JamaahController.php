<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jamaah;
use Illuminate\Support\Facades\Mail;

class JamaahController extends Controller
{
    public function index()
    {
        return view('anggota.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16|unique:jamaahs,nik',
            'email' => 'required|email|unique:jamaahs,email',
            'whatsapp' => 'required|string|max:15',
            'banom' => 'required|string',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'rt_rw' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('jamaah-foto', 'public');
        }

        $randomCode = mt_rand(1000, 9999);
        $nomorKartanu = '3302.04.1801.' . $randomCode;
        $verificationCode = rand(1000, 9999);

        Jamaah::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'banom' => $request->banom,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'rt_rw' => $request->rt_rw,
            'nomor_kartanu' => $nomorKartanu,
            'foto' => $fotoPath,
            'verification_code' => $verificationCode,
            'is_approved' => false // Belum disetujui secara default
        ]);

        return redirect()->route('anggota.index')->with('success_register', 'Pendaftaran Berhasil! Data Anda sedang ditinjau oleh Admin Ranting. Silakan cek email Anda setelah mendapatkan konfirmasi persetujuan.');
    }

    // Minta Kode Verifikasi via Email
    public function requestCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:jamaahs,email'
        ]);

        $jamaah = Jamaah::where('email', $request->email)->first();

        // CEK ATAU CEGAH JIKA BELUM DIAPPROVED ADMIN
        if (!$jamaah->is_approved) {
            return back()->withErrors(['email' => 'Pendaftaran Anda belum disetujui oleh Admin. Silakan tunggu konfirmasi email dari Admin PRNU Kedungurang.']);
        }

        // Generate kode baru & kirim email jika sudah disetujui
        $code = rand(1000, 9999);
        $jamaah->update(['verification_code' => $code]);

        try {
            Mail::raw("Assalamu'alaikum Wr. Wb.\n\nKode verifikasi akses KARTANU Digital Anda adalah: " . $code . "\n\nTerima kasih,\nPRNU Kedungurang", function ($message) use ($jamaah) {
                $message->to($jamaah->email)
                        ->subject('Kode Verifikasi KARTANU NU Kedungurang');
            });

            return back()->with([
                'email_to_verify' => $request->email,
                'notice' => 'Kode verifikasi telah dikirim ke email ' . $request->email
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Gagal mengirim email: ' . $e->getMessage()]);
        }
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|numeric'
        ]);

        $jamaah = Jamaah::where('email', $request->email)
                        ->where('verification_code', $request->code)
                        ->where('is_approved', true)
                        ->first();

        if (!$jamaah) {
            return back()->withErrors(['code' => 'Kode verifikasi salah atau pendaftaran belum disetujui!']);
        }

        return back()->with('kta_found', $jamaah);
    }
}