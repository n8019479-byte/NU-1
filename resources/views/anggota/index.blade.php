<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Anggota & KARTANU - NU Ranting Kedungurang</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        nu: {
                            DEFAULT: '#006837',
                            dark: '#004d28',
                            light: '#008748',
                            accent: '#10b981'
                        }
                    }
                }
            }
        }
    </script>
    <style>
    .perspective-1000 {
        perspective: 1000px;
    }

    .transform-style-3d {
        transform-style: preserve-3d;
        transition: transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .backface-hidden {
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
    }

    .rotate-y-180 {
        transform: rotateY(180deg);
    }
</style>
    
</head>

<body class="bg-gray-50 font-sans text-gray-800 antialiased min-h-screen flex flex-col">

    <!-- NAVBAR UTAMA KAPSUL -->
    <header class="fixed top-4 left-0 right-0 z-50 px-4">
        <nav
            class="max-w-6xl mx-auto bg-nu backdrop-blur-md border border-emerald-800/80 shadow-lg rounded-full px-5 py-3 transition-all duration-300 relative z-50">
            <div class="flex items-center justify-between">

                <!-- Logo & Nama Ranting -->
                <a href="/" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo-nu.png') }}" id="secretLogo"
                        class="h-9 w-auto object-contain cursor-pointer select-none" alt="Logo NU">
                    <div>
                        <span
                            class="text-white font-extrabold text-sm sm:text-base tracking-tight block group-hover:text-amber-300 transition-colors font-heading">
                            NU Kedungurang
                        </span>
                        <span class="text-[10px] text-emerald-200/90 font-medium tracking-wider uppercase block">
                            Portal Resmi Ranting
                        </span>
                    </div>
                </a>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        let clickCount = 0;
                        let clickTimer;
                        const logo = document.getElementById('secretLogo');

                        if (logo) {
                            logo.addEventListener('click', function (e) {
                                e.preventDefault();
                                clickCount++;
                                clearTimeout(clickTimer);
                                clickTimer = setTimeout(() => {
                                    clickCount = 0;
                                }, 800);

                                if (clickCount === 3) {
                                    window.location.href = "{{ route('login') }}";
                                }
                            });
                        }
                    });
                </script>

                <!-- Menu Navigasi Desktop -->
                <div class="hidden md:flex items-center space-x-1 bg-black/20 p-1 rounded-full">
                    <a href="{{ route('berita.index') }}"
                        class="px-4 py-1.5 rounded-full text-xs font-bold transition-all duration-300 {{ request()->routeIs('berita.index') ? 'bg-white text-nu shadow-sm' : 'text-white hover:bg-white/20' }}">
                        Beranda
                    </a>
                    <a href="{{ route('organisasi.index') }}"
                        class="px-4 py-1.5 rounded-full text-xs font-bold transition-all duration-300 {{ request()->routeIs('organisasi.index') ? 'bg-white text-nu shadow-sm' : 'text-white hover:bg-white/20' }}">
                        Struktur dan Organisasi
                    </a>
                    <a href="{{ route('kegiatan.index') }}"
                        class="px-4 py-1.5 rounded-full text-xs font-bold transition-all duration-300 {{ request()->routeIs('kegiatan.index') ? 'bg-white text-nu shadow-sm' : 'text-white hover:bg-white/20' }}">
                        Kegiatan
                    </a>
                    <a href="{{ route('anggota.index') }}"
                        class="px-4 py-1.5 rounded-full text-xs font-bold transition-all duration-300 {{ request()->routeIs('anggota.index') ? 'bg-white text-nu shadow-sm' : 'text-white hover:bg-white/20' }}">
                        Anggota
                    </a>
                </div>

                <!-- Tombol Dashboard Admin & Hamburger -->
                <div class="flex items-center gap-2">
                    @auth
                        <a href="{{ route('admin.dashboard') }}"
                            class="hidden sm:inline-flex items-center gap-1.5 bg-amber-400 hover:bg-amber-300 text-gray-950 px-4 py-2 rounded-full text-xs font-extrabold shadow-md transition-all">
                            <i class="fa-solid fa-gauge-high"></i>
                            <span>Dashboard</span>
                        </a>
                    @endauth

                    <button id="hamburger-btn"
                        class="md:hidden w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors focus:outline-none relative z-50">
                        <i class="fa-solid fa-bars text-base" id="hamburger-icon"></i>
                    </button>
                </div>

            </div>
        </nav>
    </header>

<!-- OVERLAY MENU FULL SCREEN (MOBILE MENU) -->
<div id="mobile-menu" class="fixed inset-0 bg-[#FAF7F0] z-[60] transform translate-x-full transition-transform duration-300 ease-in-out md:hidden flex flex-col justify-between px-6 py-6">
    
    <!-- Header Kapsul Hijau (Menyesuaikan dengan Foto Kedua) -->
    <div class="bg-nu rounded-full px-4 py-2.5 flex items-center justify-between shadow-md">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo-nu.png') }}" class="h-8 w-auto object-contain" alt="Logo NU">
            <div>
                <span class="text-white font-extrabold text-sm tracking-tight block">NU Kedungurang</span>
                <span class="text-[9px] text-emerald-200/90 font-medium tracking-wider uppercase block">Portal Resmi Ranting</span>
            </div>
        </div>
        <!-- Tombol Tutup di dalam Kapsul Hijau -->
        <button id="close-menu-btn" class="w-8 h-8 rounded-full bg-emerald-900/60 hover:bg-emerald-900 text-white flex items-center justify-center transition-colors focus:outline-none">
            <i class="fa-solid fa-xmark text-sm"></i>
        </button>
    </div>

    <!-- Daftar Link Navigasi -->
    <div class="space-y-4 flex flex-col my-auto">
        <a href="{{ route('berita.index') }}" class="text-xl font-black text-gray-900 hover:text-nu transition-colors flex items-center justify-between border-b border-gray-200 pb-3">
            <span>Beranda</span>
            <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>
        </a>
        <a href="{{ route('organisasi.index') }}" class="text-xl font-black text-gray-900 hover:text-nu transition-colors flex items-center justify-between border-b border-gray-200 pb-3">
            <span>Struktur dan Organisasi</span>
            <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>
        </a>
        <a href="{{ route('kegiatan.index') }}" class="text-xl font-black text-gray-900 hover:text-nu transition-colors flex items-center justify-between border-b border-gray-200 pb-3">
            <span>Kegiatan</span>
            <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>
        </a>
        <a href="{{ route('anggota.index') }}" class="text-xl font-black text-gray-900 hover:text-nu transition-colors flex items-center justify-between border-b border-gray-200 pb-3">
            <span>Anggota</span>
            <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>
        </a>
    </div>

    <!-- Footer Menu Mobile -->
    <div class="text-center text-[10px] text-gray-500 pt-4 border-t border-gray-200">
        &copy; 2026 Nahdlatul Ulama Ranting Kedungurang
    </div>
</div>

    <script>
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');

        hamburgerBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('translate-x-full');
            if (mobileMenu.classList.contains('translate-x-full')) {
                hamburgerIcon.classList.remove('fa-xmark');
                hamburgerIcon.classList.add('fa-bars');
                document.body.style.overflow = 'auto';
            } else {
                hamburgerIcon.classList.remove('fa-bars');
                hamburgerIcon.classList.add('fa-xmark');
                document.body.style.overflow = 'hidden';
            }
        });
    </script>

    <!-- BANNER HERO -->
    <section
        class="bg-[#FAF7F0] text-gray-800 py-8 sm:py-14 px-4 sm:px-6 rounded-3xl shadow-lg border border-amber-100/60 transition-all mt-24 sm:mt-28 max-w-7xl mx-auto w-full relative overflow-hidden">
        <div class="max-w-6xl mx-auto relative z-10">
            <div class="grid grid-cols-12 gap-4 sm:gap-6 items-center">
                <div class="col-span-12 sm:col-span-7 space-y-3 text-left">
                    <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-gray-950 font-heading leading-tight">
                        Pendaftaran & Cek KTA NU Kedungurang
                    </h1>
                    <div class="flex items-center gap-1.5 py-0.5">
                        <div class="h-1 w-2 bg-emerald-600/50 rounded-full"></div>
                        <div class="h-1 w-12 sm:w-16 bg-gradient-to-r from-emerald-600 via-emerald-800 to-emerald-600 rounded-full"></div>
                        <div class="h-1 w-2 bg-emerald-600/50 rounded-full"></div>
                    </div>
                    <p class="text-xs sm:text-sm font-semibold text-emerald-900 max-w-xl leading-relaxed">
                        Daftarkan diri Anda sebagai warga resmi Nahdlatul Ulama Ranting Kedungurang dan dapatkan KARTANU digital secara instan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- MAIN CONTENT SECTION -->
    <section class="py-12 px-4 sm:px-6 max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- KOLOM 1: FORMULIR PENDAFTARAN ANGGOTA BARU -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-emerald-100 shadow-xl space-y-6">
            <div class="border-b border-gray-100 pb-4">
                <h2 class="text-lg font-black text-gray-950 flex items-center gap-2">
                    <i class="fa-solid fa-user-plus text-emerald-600"></i> Form Pendaftaran Anggota Baru
                </h2>
                <p class="text-xs text-gray-500 mt-1">Isi data diri dengan lengkap untuk pembuatan KARTANU otomatis.</p>
            </div>

            @if(session('success_register'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-900 p-4 rounded-2xl text-xs font-bold">
                    {{ session('success_register') }}
                </div>
            @endif

            <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Masukan nama lengkap anda" required
                        class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">NIK (16 Digit)</label>
                        <input type="text" name="nik" maxlength="16" placeholder="Masukan NIK anda" required
                            class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Email Aktif</label>
                        <input type="email" name="email" placeholder="Masukan email aktif anda" required
                            class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" placeholder="Masukan tenpat lahir anda" required
                            class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" required
                            class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" required
                            class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Pilih Banom / Lembaga</label>
                        <select name="banom" required
                            class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
                            <option value="Ranting NU Umum">Ranting NU Umum</option>
                            <option value="Muslimat NU">Muslimat NU</option>
                            <option value="GP Ansor & Banser">GP Ansor & Banser</option>
                            <option value="Fatayat NU">Fatayat NU</option>
                            <option value="IPNU">IPNU</option>
                            <option value="IPPNU">IPPNU</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">RT / RW & Alamat</label>
                        <input type="text" name="rt_rw" placeholder="Masukan alamat anda" required
                            class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Upload Pas Foto (Opsional)</label>
                    <input type="file" name="foto"
                        class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                </div>

                <button type="submit"
                    class="w-full py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-md transition-all">
                    Daftar & Generate KARTANU Otomatis
                </button>
            </form>
        </div>

        <!-- KOLOM 2: CEK KTA VIA KODE VERIFIKASI EMAIL -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-emerald-100 shadow-xl space-y-6 flex flex-col justify-between">
            <div>
                <div class="border-b border-gray-100 pb-4 mb-4">
                    <h2 class="text-lg font-black text-gray-950 flex items-center gap-2">
                        <i class="fa-solid fa-id-card text-emerald-600"></i> Cek KARTANU via Verifikasi Email
                    </h2>
                    <p class="text-xs text-gray-500 mt-1">Masukkan email terdaftar untuk menerima kode verifikasi akses KTA.</p>
                </div>

                @if(session('notice'))
                    <div class="bg-amber-50 border border-amber-200 text-amber-900 p-3 rounded-xl text-xs font-bold mb-4">
                        {{ session('notice') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-800 p-3 rounded-xl text-xs font-bold mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- TAHAP 1: KIRIM KODE KE EMAIL -->
                @if(!session('email_to_verify') && !session('kta_found'))
                    <form action="{{ route('anggota.request_code') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Email Terdaftar</label>
                            <input type="email" name="email" placeholder="nama@email.com" required
                                class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
                        </div>
                        <button type="submit"
                            class="w-full py-3 rounded-xl bg-amber-400 hover:bg-amber-500 text-gray-950 font-bold text-xs shadow-md transition-all">
                            Kirim Kode Verifikasi ke Email
                        </button>
                    </form>
                @endif

                <!-- TAHAP 2: MASUKKAN KODE VERIFIKASI -->
                @if(session('email_to_verify') && !session('kta_found'))
                    <form action="{{ route('anggota.verify_code') }}" method="POST"
                        class="space-y-4 bg-emerald-50 p-4 rounded-2xl border border-emerald-200">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('email_to_verify') }}">
                        <div>
                            <label class="block text-xs font-bold text-emerald-900 mb-1">Masukkan Kode Verifikasi (Kirim ke: {{ session('email_to_verify') }})</label>
                            <input type="text" name="code" placeholder="Masukkan 4 digit kode" required
                                class="w-full text-xs rounded-xl border-emerald-300 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-white">
                        </div>
                        <button type="submit"
                            class="w-full py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-md transition-all">
                            Verifikasi & Buka KTA
                        </button>
                    </form>
                @endif

@if(session('kta_found'))
    @php 
        $j = session('kta_found');
        $isArr = is_array($j);
        $nia = $isArr ? ($j['nia'] ?? '') : ($j->nia ?? '');
        $id = $isArr ? ($j['id'] ?? '') : ($j->id ?? '');
        $nama = strtoupper($isArr ? ($j['nama'] ?? '-') : ($j->nama ?? '-'));
        $banom = strtoupper($isArr ? ($j['banom'] ?? 'Ranting NU') : ($j->banom ?? 'Ranting NU'));
        $nomorKartanu = $isArr ? ($j['nomor_kartanu'] ?? ($j['nia'] ?? '-')) : ($j->nomor_kartanu ?? ($j['nia'] ?? '-'));
        $tempatLahir = strtoupper($isArr ? ($j['tempat_lahir'] ?? 'Banyumas') : ($j->tempat_lahir ?? 'Banyumas'));
        $tanggalLahir = $isArr ? ($j['tanggal_lahir'] ?? null) : ($j->tanggal_lahir ?? null);
        $tglFormatted = $tanggalLahir ? date('d-m-Y', strtotime($tanggalLahir)) : '01-01-1990';
        $jenisKelamin = strtoupper($isArr ? ($j['jenis_kelamin'] ?? 'Laki-laki') : ($j->jenis_kelamin ?? 'Laki-laki'));
        $rtRw = strtoupper($isArr ? ($j['rt_rw'] ?? ($j['alamat'] ?? '-')) : ($j->rt_rw ?? ($j->alamat ?? '-')));
        $foto = $isArr ? ($j['foto'] ?? null) : ($j->foto ?? null);
    @endphp

    <div class="mt-6 flex flex-col items-center space-y-4" x-data="{ flipped: false }">

        <!-- WRAPPER KARTU UTAMA -->
        <div class="perspective-1000 w-full max-w-[440px] cursor-pointer select-none"
            @click="flipped = !flipped">
            <div class="relative w-full h-[260px] rounded-2xl shadow-2xl transform-style-3d transition-transform duration-700"
                :class="{ 'rotate-y-180': flipped }">

                <!-- ================= SIDE DEPAN (FRONT) ================= -->
                <div class="card-front absolute inset-0 w-full h-full bg-gradient-to-br from-emerald-900 via-emerald-800 to-emerald-950 text-white rounded-2xl p-4 flex flex-col justify-between border border-emerald-700/60 backface-hidden shadow-2xl overflow-hidden">

                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-10">
                        <img src="{{ asset('images/logo-nu.png') }}" class="w-80 h-80 object-contain scale-125">
                    </div>

                    <div class="flex justify-between items-center border-b border-emerald-700/60 pb-2 relative z-10">
                        <div class="flex items-center gap-2.5">
                            <img src="{{ asset('images/logo-nu.png') }}" class="h-8 w-auto object-contain">
                            <div>
                                <h5 class="text-[11px] font-black tracking-tight leading-none text-white">
                                    KARTANU KEDUNGURANG</h5>
                                <p class="text-[8px] font-bold uppercase tracking-wider text-emerald-200">
                                    Kartu Tanda Anggota Nahdlatul Ulama</p>
                            </div>
                        </div>
                        <span class="text-[12px] bg-white text-gray-950 font-extrabold px-2 py-0.5 rounded uppercase">
                            {{ $banom }}
                        </span>
                    </div>

                    <div class="flex items-center gap-3 relative z-10 my-auto">
                        <div class="w-16 h-24 bg-white/10 rounded-lg overflow-hidden flex-shrink-0 shadow-md border border-amber-300/40">
                            @if($foto)
                                <img src="{{ asset('storage/' . $foto) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-white text-[10px] font-bold">
                                    FOTO</div>
                            @endif
                        </div>

                        <div class="space-y-1 text-[9.5px] text-white flex-1 font-medium">
                            <div class="grid grid-cols-[65px_8px_1fr] items-center">
                                <span>NAMA</span><span>:</span>
                                <span class="font-extrabold text-white text-[10px] truncate">{{ $nama }}</span>
                            </div>

                            <div class="grid grid-cols-[65px_8px_1fr] items-center">
                                <span>NIA</span><span>:</span>
                                <span class="font-bold text-white tracking-wider truncate">{{ $nomorKartanu }}</span>
                            </div>

                            <div class="grid grid-cols-[65px_8px_1fr] items-center">
                                <span>TTL</span><span>:</span>
                                <span class="truncate">{{ $tempatLahir }}, {{ $tglFormatted }}</span>
                            </div>

                            <div class="grid grid-cols-[65px_8px_1fr] items-center">
                                <span>KELAMIN</span><span>:</span>
                                <span>{{ $jenisKelamin }}</span>
                            </div>

                            <div class="grid grid-cols-[65px_8px_1fr] items-start">
                                <span>ALAMAT</span><span>:</span>
                                <span class="leading-tight text-[8.5px] truncate">{{ $rtRw }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-end text-[9px] border-t border-emerald-700/60 pt-1 relative z-10">
                        <span>MASA BERLAKU : SEUMUR HIDUP</span>
                        <span class="font-bold">RANTING KEDUNGURANG</span>
                    </div>
                </div>


                <!-- ================= SIDE BELAKANG (BACK) ================= -->
                <div class="card-back absolute inset-0 w-full h-full bg-gradient-to-br from-emerald-950 via-emerald-900 to-emerald-950 text-white rounded-2xl p-4 flex flex-col justify-between border border-emerald-700/60 backface-hidden shadow-2xl rotate-y-180 overflow-hidden">

                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-5">
                        <img src="{{ asset('images/logo-nu.png') }}" class="w-80 h-80 object-contain scale-125">
                    </div>

                    <div class="flex justify-between items-center border-b border-emerald-700/60 pb-1.5 relative z-10">
                        <span class="text-[10px] font-extrabold tracking-wider text-amber-300 uppercase">KETENTUAN & PANDUAN PEMEGANG KTA</span>
                        <span class="text-[8px] bg-white text-emerald-950 px-1.5 py-0.5 rounded font-bold uppercase">NU KEDUNGURANG</span>
                    </div>

                    <div class="my-auto space-y-1.5 text-[8.5px] text-emerald-100 leading-relaxed relative z-10 px-1">
                        <div class="flex items-start gap-1.5">
                            <span class="font-bold text-amber-400">1.</span>
                            <p>Kartu Tanda Anggota (KTA) ini merupakan bukti keanggotaan resmi warga Nahdlatul Ulama Ranting Kedungurang.</p>
                        </div>
                        <div class="flex items-start gap-1.5">
                            <span class="font-bold text-amber-400">2.</span>
                            <p>Pemegang kartu wajib menjaga nama baik organisasi serta menjunjung tinggi nilai-nilai Ahlussunnah wal Jama'ah An-Nahdliyah.</p>
                        </div>
                        <div class="flex items-start gap-1.5">
                            <span class="font-bold text-amber-400">3.</span>
                            <p>Kartu ini bersifat pribadi dan tidak dapat dipindahtangankan kepada pihak lain.</p>
                        </div>
                        <div class="flex items-start gap-1.5">
                            <span class="font-bold text-amber-400">4.</span>
                            <p>Apabila terdapat perubahan data diri atau kehilangan kartu, harap menghubungi pengurus Ranting NU Kedungurang.</p>
                        </div>
                    </div>

                    <div class="text-center border-t border-emerald-700/60 pt-1 relative z-10">
                        <span class="text-[8px] text-emerald-300 tracking-wider font-semibold">PENGURUS RANTING NAHDLATUL ULAMA KEDUNGURANG</span>
                    </div>

                </div>

            </div>
        </div>

        <!-- TOMBOL KONTROL -->
        <div class="flex flex-wrap justify-center gap-3">
            <button @click="flipped = !flipped" type="button" class="px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold rounded-lg shadow transition flex items-center gap-2">
                <i class="fa-solid fa-rotate"></i> Putar Kartu (Bolak-balik)
            </button>
            <button onclick="printKtaCard()" type="button" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-gray-950 text-xs font-bold rounded-lg shadow transition flex items-center gap-2">
                <i class="fa-solid fa-print"></i> Cetak / Simpan Kartu
            </button>
        </div>

    </div>

    <!-- SCRIPT CETAK KHUSUS KTA -->
    <script>
        function printKtaCard() {
            const frontCard = document.querySelector('.card-front');
            const backCard = document.querySelector('.card-back');

            if (!frontCard || !backCard) {
                alert('Data kartu tidak ditemukan!');
                return;
            }

            const printWindow = window.open('', '_blank', 'width=900,height=700');
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Cetak KARTANU - NU Ranting Kedungurang</title>
                    <script src="https://cdn.tailwindcss.com"><\/script>
                    <style>
                        body {
                            background: #f3f4f6;
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            justify-content: center;
                            padding: 30px;
                            margin: 0;
                            gap: 25px;
                            font-family: sans-serif;
                        }
                        .print-card-container {
                            width: 440px;
                            height: 260px;
                            border-radius: 16px;
                            padding: 16px;
                            display: flex;
                            flex-direction: column;
                            justify-content: space-between;
                            box-sizing: border-box;
                            -webkit-print-color-adjust: exact;
                            print-color-adjust: exact;
                            position: relative;
                            overflow: hidden;
                            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
                        }
                        .card-1 {
                            background: linear-gradient(to bottom right, #064e3b, #022c22);
                            color: white;
                            border: 1px solid rgba(16, 185, 129, 0.4);
                        }
                        .card-2 {
                            background: linear-gradient(to bottom right, #022c22, #064e3b);
                            color: white;
                            border: 1px solid rgba(16, 185, 129, 0.4);
                        }
                        @media print {
                            body {
                                background: white;
                                padding: 0;
                            }
                            .print-card-container {
                                box-shadow: none;
                                page-break-after: always;
                                margin: 0 auto;
                            }
                        }
                    </style>
                </head>
                <body>
                    <div style="font-weight: bold; font-size: 13px; color: #047857; text-transform: uppercase; margin-bottom: -10px;">Sisi Depan Kartu</div>
                    <div class="print-card-container card-1">
                        ${frontCard.innerHTML}
                    </div>

                    <div style="font-weight: bold; font-size: 13px; color: #047857; text-transform: uppercase; margin-top: 10px; margin-bottom: -10px;">Sisi Belakang Kartu</div>
                    <div class="print-card-container card-2">
                        ${backCard.innerHTML}
                    </div>

                    <script>
                        window.onload = function() {
                            setTimeout(() => {
                                window.print();
                                window.close();
                            }, 600);
                        }
                    <\/script>
                </body>
                </html>
            `);
            printWindow.document.close();
        }
    </script>
@endif
            </div>
        </div>

    </section>
@include('layouts.footer')

</body>
</html>