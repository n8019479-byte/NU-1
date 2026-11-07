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
    // Validasi data input (whatsapp dihapus dari validasi)
    $request->validate([
        'nama' => 'required|string|max:255',
        'nik' => 'required|string|max:16|unique:jamaahs,nik',
        'email' => 'required|email|max:255',
        'tempat_lahir' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|string',
        // 'whatsapp' => 'required|string|max:20', <-- Baris ini dihapus
        'banom' => 'required|string',
        'rt_rw' => 'required|string|max:255',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    $fotoPath = null;
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('jamaah_foto', 'public');
    }

    $nia = '3302.' . date('y') . '.' . rand(1000, 9999);

    // Simpan ke database (whatsapp dihapus dari array create)
   \App\Models\Jamaah::create([
    'nama' => $request->nama,
    'nik' => $request->nik,
    'email' => $request->email,
    'tempat_lahir' => $request->tempat_lahir,
    'tanggal_lahir' => $request->tanggal_lahir,
    'jenis_kelamin' => $request->jenis_kelamin,
    'banom' => $request->banom,
    'rt_rw' => $request->rt_rw,
    'nomor_kartanu' => $nia,
    'foto' => $fotoPath,
    'is_approved' => 0, // 0 artinya menunggu verifikasi admin
]);

    return redirect()->back()->with('success_register', 'Pendaftaran berhasil! KARTANU Anda telah digenerate.');
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