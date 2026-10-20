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
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased min-h-screen flex flex-col">

<!-- NAVBAR UTAMA KAPSUL -->
<header class="fixed top-4 left-0 right-0 z-50 px-4">
    <nav class="max-w-6xl mx-auto bg-nu backdrop-blur-md border border-emerald-800/80 shadow-lg rounded-full px-5 py-3 transition-all duration-300 relative z-50">
        <div class="flex items-center justify-between">
            
<!-- Logo & Nama Ranting (Dikelompokkan Rapi dalam 1 Flex Container) -->
<a href="/" class="flex items-center gap-3 group">
    <!-- Gambar Logo NU -->
    <img src="{{ asset('images/logo-nu.png') }}" 
         id="secretLogo" 
         class="h-9 w-auto object-contain cursor-pointer select-none" 
         alt="Logo NU">

    <!-- Teks Judul Portal -->
    <div>
        <span class="text-white font-extrabold text-sm sm:text-base tracking-tight block group-hover:text-amber-300 transition-colors font-heading">
            NU Kedungurang
        </span>
        <span class="text-[10px] text-emerald-200/90 font-medium tracking-wider uppercase block">
            Portal Resmi Ranting
        </span>
    </div>
</a>

<!-- Taruh Script Klik Rahasia di Paling Bawah File Blade Anda -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let clickCount = 0;
        let clickTimer;
        const logo = document.getElementById('secretLogo');

        if (logo) {
            logo.addEventListener('click', function(e) {
                // Mencegah halaman reload/pindah jika logo berada di dalam tag <a>
                e.preventDefault();
                
                clickCount++;
                clearTimeout(clickTimer);
                
                clickTimer = setTimeout(() => {
                    clickCount = 0;
                }, 800); // Reset dalam 0.8 detik

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

            <!-- Tombol Dashboard Admin / Login & Hamburger -->
            <div class="flex items-center gap-2">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex items-center gap-1.5 bg-amber-400 hover:bg-amber-300 text-gray-950 px-4 py-2 rounded-full text-xs font-extrabold shadow-md transition-all">
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Dashboard</span>
                    </a>
                @else
                @endauth

                <!-- Tombol Hamburger -->
                <button id="hamburger-btn" class="md:hidden w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors focus:outline-none relative z-50">
                    <i class="fa-solid fa-bars text-base" id="hamburger-icon"></i>
                </button>
            </div>

        </div>
    </nav>
</header>

<!-- OVERLAY MENU FULL SCREEN (GESER DARI KANAN) -->
<div id="mobile-menu" class="fixed inset-0 bg-[#FAF7F0] z-40 transform translate-x-full transition-transform duration-300 ease-in-out md:hidden flex flex-col justify-between px-6 py-24">
    <div class="space-y-6 flex flex-col">
        <a href="{{ route('berita.index') }}" class="text-2xl font-black text-gray-900 hover:text-nu transition-colors flex items-center justify-between border-b border-gray-200 pb-4 font-heading">
            <span>Beranda</span>
            @if(request()->routeIs('berita.index'))
                <span class="w-3 h-3 rounded-full bg-nu"></span>
            @endif
        </a>
        <a href="{{ route('organisasi.index') }}" class="text-2xl font-black text-gray-900 hover:text-nu transition-colors flex items-center justify-between border-b border-gray-200 pb-4 font-heading">
            <span>Struktur dan Organisasi</span>
            @if(request()->routeIs('organisasi.index'))
                <span class="w-3 h-3 rounded-full bg-nu"></span>
            @endif
        </a>
        <a href="{{ route('kegiatan.index') }}" class="text-2xl font-black text-gray-900 hover:text-nu transition-colors flex items-center justify-between border-b border-gray-200 pb-4 font-heading">
            <span>Kegiatan</span>
            @if(request()->routeIs('kegiatan.index'))
                <span class="w-3 h-3 rounded-full bg-nu"></span>
            @endif
        </a>
        <a href="{{ route('anggota.index') }}" class="text-2xl font-black text-gray-900 hover:text-nu transition-colors flex items-center justify-between border-b border-gray-200 pb-4 font-heading">
            <span>Anggota</span>
            @if(request()->routeIs('anggota.index'))
                <span class="w-3 h-3 rounded-full bg-nu"></span>
            @endif
        </a>
    </div>

    <div class="space-y-3 pb-6">
        @auth
            <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center gap-2 w-full bg-nu text-white py-3.5 rounded-2xl text-sm font-extrabold shadow-lg">
                <i class="fa-solid fa-gauge-high"></i> Dashboard Admin
            </a>
        @else
        @endauth
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


<!-- BANNER HERO ANGGOTA & KTA (Nuansa Islami Ke-NU-an & Kartu KTA) -->
<section class="bg-[#FAF7F0] text-gray-800 py-8 sm:py-14 px-4 sm:px-6 rounded-3xl shadow-lg border border-amber-100/60 transition-all mt-24 sm:mt-28 max-w-7xl mx-auto w-full relative overflow-hidden">
    
    <!-- LAYER WATERMARK KE-NU-AN (KUBAH, BINTANG 9, & GEOMETRI) -->
    <div class="absolute inset-0 pointer-events-none opacity-45 select-none overflow-hidden">
        
        <!-- 1. Vektor Siluet Kubah Masjid di Latar Belakang -->
        <svg class="absolute -bottom-2 right-1/4 w-64 h-32 text-emerald-800/10" viewBox="0 0 200 100" fill="currentColor">
            <path d="M 100 10 C 80 35, 60 40, 40 50 L 40 100 L 160 100 L 160 50 C 140 40, 120 35, 100 10 Z"/>
        </svg>

        <!-- 2. Motif Bintang 9 NU (9 Stars Accents) Kiri Atas -->
        <div class="absolute top-4 left-6 flex gap-1 opacity-30">
            <i class="fa-solid fa-star text-[10px] text-amber-500"></i>
            <i class="fa-solid fa-star text-xs text-emerald-700"></i>
            <i class="fa-solid fa-star text-[10px] text-amber-500"></i>
        </div>

        <!-- 3. Batang Kapsul Miring Kiri Atas & Kanan Bawah -->
        <div class="absolute -top-8 -left-6 w-36 h-10 bg-emerald-600/15 rounded-full transform -rotate-45"></div>
        <div class="absolute -bottom-8 -right-6 w-48 h-12 bg-amber-400/20 rounded-full transform -rotate-45"></div>

        <!-- 4. Pola Titik Grid (Dot Grid Matrix) -->
        <div class="absolute left-8 bottom-4 grid grid-cols-4 gap-1.5 opacity-35">
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
        </div>

        <!-- 5. Lingkaran Ring Aksen -->
        <div class="absolute top-1/3 left-1/2 w-14 h-14 rounded-full border-2 border-emerald-600/20 border-dashed"></div>
    </div>

    <!-- KONTEN UTAMA BANNER HERO -->
    <div class="max-w-6xl mx-auto relative z-10">
        <div class="grid grid-cols-12 gap-4 sm:gap-6 items-center">
            
            <!-- SISI KIRI: TEKS JUDUL & DESKRIPSI -->
            <div class="col-span-12 sm:col-span-7 space-y-3 text-left">
                <!-- Judul Utama -->
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black text-gray-950 font-heading leading-tight">
                    Pendaftaran & Cek KTA NU Kedungurang
                </h1>

                <!-- Garis Pembatas Akses Hijau -->
                <div class="flex items-center gap-1.5 py-0.5">
                    <div class="h-1 w-2 bg-emerald-600/50 rounded-full"></div>
                    <div class="h-1 w-12 sm:w-16 bg-gradient-to-r from-emerald-600 via-emerald-800 to-emerald-600 rounded-full"></div>
                    <div class="h-1 w-2 bg-emerald-600/50 rounded-full"></div>
                </div>

                <!-- Deskripsi Sub-Judul -->
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
                <label class="block text-xs font-bold text-gray-700 mb-1">Nama Lengkap & Gelar</label>
                <input type="text" name="nama" required class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">NIK (16 Digit)</label>
                    <input type="text" name="nik" maxlength="16" required class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Email Aktif</label>
                    <input type="email" name="email" required class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" placeholder="Contoh: Banyumas" required class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" required class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" required class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nomor WhatsApp</label>
                    <input type="text" name="whatsapp" required class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Pilih Banom / Lembaga</label>
                    <select name="banom" required class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
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
                    <input type="text" name="rt_rw" placeholder="Contoh: RT 01 / RW 02 Kedungurang" required class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Upload Pas Foto (Opsional)</label>
                <input type="file" name="foto" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-md transition-all">
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
                        <input type="email" name="email" placeholder="nama@email.com" required class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-gray-50">
                    </div>
                    <button type="submit" class="w-full py-3 rounded-xl bg-amber-400 hover:bg-amber-500 text-gray-950 font-bold text-xs shadow-md transition-all">
                        Kirim Kode Verifikasi ke Email
                    </button>
                </form>
            @endif

            <!-- TAHAP 2: MASUKKAN KODE VERIFIKASI -->
            @if(session('email_to_verify') && !session('kta_found'))
                <form action="{{ route('anggota.verify_code') }}" method="POST" class="space-y-4 bg-emerald-50 p-4 rounded-2xl border border-emerald-200">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('email_to_verify') }}">
                    <div>
                        <label class="block text-xs font-bold text-emerald-900 mb-1">Masukkan Kode Verifikasi (Kirim ke: {{ session('email_to_verify') }})</label>
                        <input type="text" name="code" placeholder="Masukkan 4 digit kode" required class="w-full text-xs rounded-xl border-emerald-300 focus:border-emerald-600 focus:ring-emerald-600 p-2.5 bg-white">
                    </div>
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-md transition-all">
                        Verifikasi & Buka KTA
                    </button>
                </form>
            @endif

<!-- TAMPILAN KTA UKURAN KARTU STANDAR (ID CARD) -->
@if(session('kta_found'))
    @php 
        $j = session('kta_found'); 
        $isArr = is_array($j);

        $nama = strtoupper($isArr ? ($j['nama'] ?? '-') : ($j->nama ?? '-'));
        $banom = strtoupper($isArr ? ($j['banom'] ?? 'Ranting NU') : ($j->banom ?? 'Ranting NU'));
        $nomorKartanu = $isArr ? ($j['nomor_kartanu'] ?? '-') : ($j->nomor_kartanu ?? '-');
        $tempatLahir = strtoupper($isArr ? ($j['tempat_lahir'] ?? 'Banyumas') : ($j->tempat_lahir ?? 'Banyumas'));
        $tanggalLahir = $isArr ? ($j['tanggal_lahir'] ?? null) : ($j->tanggal_lahir ?? null);
        $tglFormatted = $tanggalLahir ? date('d-m-Y', strtotime($tanggalLahir)) : '01-01-1990';
        $jenisKelamin = strtoupper($isArr ? ($j['jenis_kelamin'] ?? 'Laki-laki') : ($j->jenis_kelamin ?? 'Laki-laki'));
        $rtRw = strtoupper($isArr ? ($j['rt_rw'] ?? '-') : ($j->rt_rw ?? '-'));
        $foto = $isArr ? ($j['foto'] ?? null) : ($j->foto ?? null);
    @endphp

    <div class="mt-6 flex flex-col items-center space-y-4">
        <!-- ID CARD CONTAINER -->
        <div class="w-full max-w-[440px] h-[260px] bg-gradient-to-br from-emerald-900 via-emerald-800 to-emerald-950 text-white rounded-2xl p-4 shadow-2xl relative overflow-hidden flex flex-col justify-between">
            
            <!-- WATERMARK LOGO NU -->
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-10">
                <img src="{{ asset('images/logo-nu.png') }}" class="w-80 h-80 object-contain scale-125">
            </div>

            <!-- Header KTA (Logo NU Diperbesar) -->
            <div class="flex justify-between items-center border-b border-emerald-700/60 pb-2 relative z-10">
                <div class="flex items-center gap-2.5">
                    <img src="{{ asset('images/logo-nu.png') }}" class="h-8 w-auto object-contain">
                    <div>
                        <h5 class="text-[11px] font-black tracking-tight leading-none text-white">KARTANU KEDUNGURANG</h5>
                        <p class="text-[8px] font-bold uppercase tracking-wider text-white">Kartu Tanda Anggota Nahdlatul Ulama</p>
                    </div>
                </div>
                <span class="text-[9px] bg-amber-400 text-gray-950 font-extrabold px-2 py-0.5 rounded uppercase">
                    {{ $banom }}
                </span>
            </div>

            <!-- Body KTA (Foto & Identitas Lengkap Tanpa Terpotong) -->
            <div class="flex items-center gap-3 relative z-10 my-auto">
                <!-- Pas Foto Anggota -->
                <div class="w-20 h-28 bg-white/10 rounded-lg overflow-hidden flex-shrink-0 shadow-md">
                    @if($foto)
                        <img src="{{ asset('storage/' . $foto) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-white text-[10px] font-bold">FOTO</div>
                    @endif
                </div>

                <!-- Identitas dengan Alamat Utuh -->
                <div class="space-y-1 text-[10px] text-white flex-1 font-medium">
                    <!-- Nama -->
                    <div class="grid grid-cols-[75px_10px_1fr] items-center">
                        <span>NAMA</span>
                        <span>:</span>
                        <span class="font-extrabold text-white text-xs truncate">{{ $nama }}</span>
                    </div>

                    <!-- NIA -->
                    <div class="grid grid-cols-[75px_10px_1fr] items-center">
                        <span>NIA</span>
                        <span>:</span>
                        <span class="font-bold text-white tracking-wider truncate">{{ $nomorKartanu }}</span>
                    </div>

                    <!-- TTL -->
                    <div class="grid grid-cols-[75px_10px_1fr] items-center">
                        <span>TTL</span>
                        <span>:</span>
                        <span class="truncate">{{ $tempatLahir }}, {{ $tglFormatted }}</span>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="grid grid-cols-[75px_10px_1fr] items-center">
                        <span>KELAMIN</span>
                        <span>:</span>
                        <span>{{ $jenisKelamin }}</span>
                    </div>

                    <!-- Alamat Lengkap (Tanpa Truncate / Ditampilkan Utuh) -->
                    <div class="grid grid-cols-[75px_10px_1fr] items-start">
                        <span>ALAMAT</span>
                        <span>:</span>
                        <span class="leading-tight text-[9px]">{{ $rtRw }}</span>
                    </div>
                </div>
            </div>

            <!-- Footer KTA (Masa Berlaku) -->
            <div class="border-t border-emerald-700/60 pt-1.5 flex justify-center items-center relative z-10 text-[9px] text-white">
                <span class="text-[9px] font-bold tracking-wider text-center text-white uppercase">
                    MASA BERLAKU : SEUMUR HIDUP
                </span>
            </div>

        </div>

        <a href="{{ route('anggota.index') }}" class="text-xs font-bold text-emerald-700 hover:underline">
            <i class="fa-solid fa-rotate-right mr-1"></i> Cek Email Lain
        </a>
    </div>
@endif
        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 text-[11px] text-gray-600 space-y-1">
            <p class="font-bold text-gray-800"><i class="fa-solid fa-circle-info text-emerald-600 mr-1"></i> Informasi:</p>
            <p>Masukkan email yang valid untuk menerima kode verifikasi demi keamanan akses KARTANU Anda.</p>
        </div>
    </div>

</section>

<!-- FOOTER PORTAL NU RANTING KEDUNGURANG -->
<footer class="w-full bg-gradient-to-b from-[#004d28] to-[#00381d] text-white relative overflow-hidden mt-16 pt-12 pb-6 border-t border-emerald-800/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="pt-6 text-center text-xs text-emerald-200/70">
            <p>© Pengurus Ranting Nahdlatul Ulama Kedungurang. All rights reserved.</p>
        </div>
    </div>
</footer>

</body>
</html>