<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Anggota Resmi - NU Kedungurang</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans text-gray-800 min-h-screen flex flex-col justify-between">

    <!-- Header / Navbar Sederhana -->
    <header class="bg-emerald-900 text-white shadow-md py-4 px-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo-nu.png') }}" class="h-8 w-auto object-contain">
            <div>
                <h1 class="text-xs font-black tracking-wider uppercase">NU KEDUNGURANG</h1>
                <p class="text-[9px] text-emerald-200">PORTAL VERIFIKASI KEANGGOTAAN RESMI</p>
            </div>
        </div>
        <a href="{{ route('anggota.index') }}" class="bg-amber-400 text-gray-950 px-3 py-1.5 rounded-xl text-xs font-bold shadow hover:bg-amber-500 transition-all">
            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Portal
        </a>
    </header>

    <!-- Konten Utama Profil Anggota -->
    <main class="max-w-md mx-auto py-10 px-4 w-full">
        <div class="bg-white rounded-3xl shadow-xl border border-gray-200 overflow-hidden p-6 space-y-6">
            
            <!-- Badge Status Terverifikasi -->
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-2 rounded-2xl flex items-center justify-center gap-2 text-xs font-extrabold shadow-inner">
                <i class="fa-solid fa-shield-halved text-emerald-600 text-sm"></i>
                <span>ANGGOTA RESMI TERVERIFIKASI NU</span>
            </div>

            <!-- Foto & Nama Singkat -->
            <div class="flex flex-col items-center text-center space-y-3">
                <div class="w-28 h-36 rounded-2xl bg-gray-200 overflow-hidden shadow-md border-4 border-emerald-800">
                    @if($anggota->foto)
                        <img src="{{ asset('storage/' . $anggota->foto) }}" class="w-full h-full object-cover" alt="Foto Anggota">
                    @else
                        <div class="w-full h-full bg-emerald-900 flex items-center justify-center text-white text-xs font-bold">FOTO</div>
                    @endif
                </div>
                <div>
                    <h2 class="text-lg font-black text-gray-900 uppercase">{{ $anggota->nama }}</h2>
                    <span class="inline-block bg-amber-100 text-amber-800 text-[10px] font-extrabold px-2.5 py-0.5 rounded-full mt-1 uppercase">
                        {{ $anggota->banom ?? 'Ranting NU' }}
                    </span>
                </div>
            </div>

            <!-- Detail Informasi Lengkap -->
            <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100 space-y-3 text-xs">
                <div class="flex justify-between border-b border-gray-200 pb-2">
                    <span class="text-gray-500 font-bold">Nomor KARTANU / NIA</span>
                    <span class="font-extrabold text-emerald-900">{{ $anggota->nomor_kartanu ?? $anggota->nia }}</span>
                </div>
                <div class="flex justify-between border-b border-gray-200 pb-2">
                    <span class="text-gray-500 font-bold">Tempat, Tanggal Lahir</span>
                    <span class="font-semibold text-gray-800">{{ strtoupper($anggota->tempat_lahir) }}, {{ date('d-m-Y', strtotime($anggota->tanggal_lahir)) }}</span>
                </div>
                <div class="flex justify-between border-b border-gray-200 pb-2">
                    <span class="text-gray-500 font-bold">Jenis Kelamin</span>
                    <span class="font-semibold text-gray-800">{{ strtoupper($anggota->jenis_kelamin) }}</span>
                </div>
                <div class="flex justify-between border-b border-gray-200 pb-2">
                    <span class="text-gray-500 font-bold">Nomor WhatsApp</span>
                    <span class="font-semibold text-gray-800">{{ $anggota->nomor_whatsapp ?? '-' }}</span>
                </div>
                <div class="flex flex-col gap-1 pt-1">
                    <span class="text-gray-500 font-bold">Alamat Lengkap</span>
                    <span class="font-semibold text-gray-800 leading-tight">{{ $anggota->rt_rw ?? $anggota->alamat }}</span>
                </div>
            </div>

            <!-- Keterangan Sah -->
            <p class="text-[10px] text-center text-gray-500 leading-relaxed">
                Kartu Tanda Anggota ini sah dan tercatat secara resmi dalam database Pengurus Ranting Nahdlatul Ulama Kedungurang, Kec. Gumelar, Kab. Banyumas.
            </p>

        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center py-6 text-xs text-gray-500 border-t border-gray-200 bg-white">
        <p>© 2026 Pengurus Ranting Nahdlatul Ulama Kedungurang</p>
    </footer>

</body>
</html>