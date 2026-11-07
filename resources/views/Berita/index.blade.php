<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NU Ranting Kedungurang - Portal Berita & Informasi</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts: Outfit untuk Judul yang Menarik -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@700;800;900&display=swap" rel="stylesheet">
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
        /* CSS Font Heading Khusus */
        .font-heading {
            font-family: 'Outfit', sans-serif;
        }

        /* CSS Animasi Scroll Smooth */
        .reveal {
            opacity: 0;
            transform: translateY(25px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Animasi Per Kata Cepat & Rapi */
        .word-reveal {
            display: inline-block;
            opacity: 0;
            transform: translateY(12px);
            transition: opacity 0.35s cubic-bezier(0.16, 1, 0.3, 1), transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
            margin-right: 0.22em;
        }
        .reveal.active .word-reveal {
            opacity: 1;
            transform: translateY(0);
        }

        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
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

    <!-- NOTIFIKASI SUKSES -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 pt-4 w-full">
            <div class="bg-emerald-100 border-l-4 border-emerald-600 text-emerald-800 p-4 rounded-lg shadow-sm flex justify-between items-center">
                <span class="text-sm font-medium"><i class="fa-solid fa-circle-check mr-2"></i>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-emerald-800 font-bold text-sm">&times;</button>
            </div>
        </div>
    @endif

<!-- BANNER HERO BERANDA DENGAN ANEKA BENTUK GEOMETRIS & WATERMARK CSS -->
<section class="relative bg-[#FAF7F0] text-gray-800 py-12 sm:py-16 px-4 sm:px-6 rounded-3xl shadow-lg border border-amber-100/60 transition-all mt-28 max-w-7xl mx-auto w-full overflow-hidden">
    
    <!-- LAYER WATERMARK GEOMETRIS (FULL CSS/SVG KUSTOM) -->
    <div class="absolute inset-0 pointer-events-none opacity-50 select-none overflow-hidden">
        
        <!-- 1. Batang Kapsul Miring (Pill Shapes) Kiri Atas -->
        <div class="absolute -top-10 -left-10 w-44 h-12 bg-emerald-600/15 rounded-full transform -rotate-45"></div>
        <div class="absolute -top-4 left-10 w-32 h-8 bg-amber-400/20 rounded-full transform -rotate-45"></div>

        <!-- 2. Batang Kapsul Miring Kanan Bawah -->
        <div class="absolute -bottom-8 -right-8 w-56 h-14 bg-emerald-700/15 rounded-full transform -rotate-45"></div>
        <div class="absolute bottom-10 right-20 w-36 h-8 bg-emerald-500/10 rounded-full transform -rotate-45"></div>

        <!-- 3. Bintang Islami 8 Sudut (Rub el Hizb) Watermark -->
        <svg class="absolute top-8 right-1/3 w-32 h-32 text-emerald-800/10 transform rotate-12" viewBox="0 0 100 100" fill="currentColor">
            <path d="M50 0 L63 25 L90 10 L75 37 L100 50 L75 63 L90 90 L63 75 L50 100 L37 75 L10 90 L25 63 L0 50 L25 37 L10 10 L37 25 Z"/>
        </svg>

        <!-- 4. Lingkaran Ring Aksen -->
        <div class="absolute top-1/4 left-1/2 w-20 h-20 rounded-full border-2 border-emerald-600/20 border-dashed"></div>
        <div class="absolute bottom-6 right-1/3 w-8 h-8 rounded-full border border-amber-500/40"></div>

        <!-- 5. Pola Titik Grid (Dot Grid Matrix) Kiri Bawah & Kanan Atas -->
        <div class="absolute left-6 bottom-6 grid grid-cols-5 gap-2 opacity-40">
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
        </div>

        <!-- 6. Garis Aksentik Miring Gelombang -->
        <svg class="absolute left-1/3 bottom-4 w-40 h-16 text-emerald-600/20" viewBox="0 0 100 40" fill="none">
            <path d="M0 30 Q 25 5, 50 30 T 100 30" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
        </svg>
    </div>

    <!-- KONTEN UTAMA HERO (DI ATAS WATERMARK) -->
    <div class="relative z-10 max-w-6xl mx-auto">
        <div class="grid grid-cols-12 gap-4 sm:gap-6 items-center">
        
            <!-- SISI KIRI: KONTEN TEKS -->
            <div class="col-span-12 sm:col-span-7 space-y-3 sm:space-y-4 text-left">
                
                <!-- Judul Utama -->
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-black tracking-tight leading-tight text-gray-950 font-heading">
                    Mendayagunakan Jam'iyah & Jama'ah untuk Peradaban Bangsa
                </h1>

                <!-- Garis Pembatas -->
                <div class="flex items-center gap-1.5 py-0.5">
                    <div class="h-1 w-2 bg-emerald-600/50 rounded-full"></div>
                    <div class="h-1 w-10 sm:h-1 sm:w-16 bg-gradient-to-r from-emerald-600 via-emerald-800 to-emerald-600 rounded-full"></div>
                    <div class="h-1 w-2 bg-emerald-600/50 rounded-full"></div>
                </div>

                <!-- Deskripsi Sub-Judul -->
                <p class="text-[11px] sm:text-xs md:text-sm text-emerald-900 leading-relaxed font-semibold max-w-lg">
                    Media Publikasi Resmi Informasi Keagamaan, Kemasyarakatan, dan Keumatan Nahdlatul Ulama Ranting Kedungurang.
                </p>

                <!-- Tombol Aksi -->
                <div class="pt-1">
                    <a href="#berita" class="inline-flex items-center gap-2 px-4 sm:px-5 py-2 rounded-xl bg-amber-400 hover:bg-amber-500 text-gray-950 font-bold text-[11px] sm:text-xs shadow-md transition-all duration-300 hover:-translate-y-0.5">
                        <span>Jelajahi Berita</span>
                        <i class="fa-solid fa-arrow-down text-[10px]"></i>
                    </a>
                </div>

            </div>

            <!-- SISI KANAN: GAMBAR BANNER HERO -->
            <div class="col-span-12 sm:col-span-5 flex justify-center sm:justify-end mt-4 sm:mt-0">
                <div class="relative w-full max-w-md p-2 sm:p-3 bg-emerald-900/5 backdrop-blur-md rounded-2xl sm:rounded-3xl border border-emerald-900/10 shadow-xl transition-all">
                    <div class="relative w-full aspect-[4/3] rounded-xl sm:rounded-2xl overflow-hidden shadow-inner group">
                        <img src="{{ asset('images/backgroundNU.png') }}" alt="NU Ranting Kedungurang" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent pointer-events-none"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SECTION TENTANG KAMI -->
<section class="pt-10 pb-4 max-w-6xl mx-auto px-4 reveal">
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-3">
        <div class="flex items-center gap-3">
            <div class="w-2.5 h-7 bg-emerald-700 rounded-full shadow-sm"></div>
            <h2 class="text-xl sm:text-2xl font-extrabold text-gray-900 tracking-tight font-heading">
                Tentang Kami
            </h2>
        </div>
        <p class="text-xs sm:text-sm md:text-base text-slate-600 font-medium leading-relaxed text-justify">
            Nahdlatul Ulama Ranting Kedungurang bertujuan untuk menegakkan ajaran Islam Ahlussunnah wal Jama'ah An-Nahdliyah serta memperkuat tata kelola keorganisasian demi terwujudnya kemaslahatan umat. Melalui integrasi dakwah, pendataan warga, dan program keagamaan yang terstruktur, keberadaan NU di Ranting Kedungurang memberikan manfaat nyata bagi masyarakat seperti kemudahan akses bantuan sosial, penguatan ukhuwah islamiyah, pembinaan generasi muda, serta menjadi wadah aspirasi bersama dalam membangun tatanan bermasyarakat yang harmonis, mandiri, dan sejahtera.
        </p>
    </div>
</section>

<!-- PILAR ORGANISASI (GAYA DIGDAYA MODERN) -->
<section class="pt-6 pb-12 space-y-8">
    
    <!-- HEADER SECTION -->
    <div class="max-w-6xl mx-auto px-4 text-left space-y-2 reveal">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-900 tracking-tight font-heading">
            Layanan & Pilar Organisasi NU
        </h2>
        <p class="text-xs sm:text-sm md:text-base text-slate-600 font-medium leading-relaxed max-w-2xl">
            Akses informasi terstruktur, dokumentasi kegiatan, dan direktori keanggotaan Nahdlatul Ulama Ranting Kedungurang.
        </p>
    </div>

    <!-- GRID CARD LAYANAN -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto px-4">
        
        <!-- CARD 1: ORGANISASI -->
        <a href="{{ route('organisasi.index') }}" 
           class="reveal bg-white rounded-2xl p-6 sm:p-7 border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col justify-between space-y-6 cursor-pointer" 
           style="transition-delay: 100ms;">
            
            <div class="space-y-5">
                <div class="flex items-center gap-3.5 pb-5 border-b border-slate-100">
                    <div class="w-12 h-12 \ text-nu flex items-center justify-center text-xl shadow-xs group-hover:text-white  duration-300">
                        
                    </div>
                    <div>
                        <span class="text-base font-extrabold text-gray-900 group-hover:text-nu transition-colors font-heading">Organisasi</span>
                    </div>
                </div>

                <div class="space-y-2.5">
                    <h3 class="text-lg font-bold text-gray-900 leading-snug group-hover:text-nu transition-colors font-heading">
                        Struktur & Kepengurusan
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 font-medium leading-relaxed">
                        Mengenal jajaran kepengurusan Syuriah, Tanfidziyah, serta jaringan Badan Otonom Ranting Kedungurang.
                    </p>
                </div>
            </div>
        </a>

        <!-- CARD 2: KEGIATAN -->
        <a href="{{ route('kegiatan.index') }}" 
           class="reveal bg-white rounded-2xl p-6 sm:p-7 border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col justify-between space-y-6 cursor-pointer" 
           style="transition-delay: 200ms;">
            
            <div class="space-y-5">
                <div class="flex items-center gap-3.5 pb-5 border-b border-slate-100">
                    <div class="w-12 h-12 text-nu flex items-center justify-center text-xl shadow-xs group-hover:text-white transition-colors duration-300">
                        <i class="fa-solid "></i>
                    </div>
                    <div>
                      <span class="text-base font-extrabold text-gray-900 group-hover:text-nu transition-colors font-heading">Kegiatan</span>
                    </div>
                </div>

                <div class="space-y-2.5">
                    <h3 class="text-lg font-bold text-gray-900 leading-snug group-hover:text-nu transition-colors font-heading">
                        Dokumentasi & Program
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 font-medium leading-relaxed">
                        Dokumentasi dan agenda rutin program keagamaan, kajian, serta bakti sosial kemasyarakatan.
                    </p>
                </div>
            </div>
        </a>

        <!-- CARD 3: ANGGOTA -->
        <a href="{{ route('anggota.index') }}" 
           class="reveal bg-white rounded-2xl p-6 sm:p-7 border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col justify-between space-y-6 cursor-pointer" 
           style="transition-delay: 300ms;">
            
            <div class="space-y-5">
                <div class="flex items-center gap-3.5 pb-5 border-b border-slate-100">
                    <div class="w-12 h-12 text-nu flex items-center justify-center text-xl shadow-xs group-hover:text-white transition-colors duration-300">
                    </div>
                    <div>
                        <span class="text-base font-extrabold text-gray-900 group-hover:text-nu transition-colors font-heading">Anggota</span>
                    </div>
                </div>

                <div class="space-y-2.5">
                    <h3 class="text-lg font-bold text-gray-900 leading-snug group-hover:text-nu transition-colors font-heading">
                        Layanan KARTANU
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 font-medium leading-relaxed">
                        Pendataan Kartu Tanda Anggota NU (KARTANU), pendaftaran wawasan keanggotaan, dan pusat aspirasi.
                    </p>
                </div>
            </div>
        </a>

    </div>
</section>

    <!-- SECTION BERITA UTAMA -->
    <div id="berita" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full" 
         x-data="{ 
            searchQuery: '', 
            page: 1,
            perPage: 6, 
            
            get allBerita() {
                return @js($beritaTerbaru ?? $beritas ?? $berita ?? []);
            },

            get filteredBerita() {
                if (this.searchQuery.trim() === '') return this.allBerita;
                return this.allBerita.filter(item => 
                    (item.judul && item.judul.toLowerCase().includes(this.searchQuery.toLowerCase())) ||
                    (item.konten && item.konten.toLowerCase().includes(this.searchQuery.toLowerCase()))
                );
            },

            get paginatedBerita() {
                let start = (this.page - 1) * this.perPage;
                return this.filteredBerita.slice(start, start + this.perPage);
            },

            get maxPage() {
                return Math.ceil(this.filteredBerita.length / this.perPage) || 1;
            }
         }">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- KOLOM KIRI: LIPUTAN MEDIA / BERITA -->
            <div class="lg:col-span-6 space-y-6">
                
                <!-- HEADER SECTION & PENCARIAN -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-200/80 pb-4 reveal">
                    <div class="flex items-center gap-3">
                        <div class="w-2.5 h-7 bg-nu rounded-full shadow-sm"></div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-black text-gray-900 tracking-tight font-heading">Liputan Berita</h2>
                            <p class="text-[11px] text-gray-500 font-medium">Informasi dan warta terbaru Ranting NU Kedungurang</p>
                        </div>
                    </div>

                    <!-- INPUT PENCARIAN KECIL -->
                    <div class="relative w-full sm:w-56">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </div>
                        <input 
                            type="text" 
                            x-model="searchQuery" 
                            @input="page = 1" 
                            placeholder="Cari berita..." 
                            class="w-full pl-9 pr-8 py-1.5 bg-white border border-gray-200 rounded-xl text-xs font-medium focus:outline-none focus:border-nu shadow-sm">
                        
                        <button 
                            x-show="searchQuery.length > 0" 
                            @click="searchQuery = ''; page = 1;" 
                            type="button" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            <i class="fa-solid fa-xmark text-xs"></i>
                        </button>
                    </div>
                </div>

                <!-- LIST ITEM BERITA -->
                <div class="space-y-4">
                    <template x-for="(item, index) in paginatedBerita" :key="item.id">
                        <article 
                            x-transition:enter="transition ease-out duration-400 transform"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            :style="'transition-delay: ' + (index * 60) + 'ms'"
                            class="flex items-start gap-4 group bg-white p-4 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-emerald-200 transition-all">
                            
                            <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-xl overflow-hidden shrink-0 bg-gray-100 border border-gray-100">
                                <template x-if="item.gambar">
                                    <img :src="'/storage/' + item.gambar" :alt="item.judul" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </template>
                                <template x-if="!item.gambar">
                                    <div class="w-full h-full flex flex-col items-center justify-center text-emerald-500 bg-emerald-50">
                                        <i class="fa-regular fa-newspaper text-xl"></i>
                                    </div>
                                </template>
                            </div>

                            <div class="space-y-1.5 flex-1 min-w-0">
                                <div class="flex items-center gap-2 text-[10px] font-extrabold uppercase tracking-wider text-gray-400">
                                    <span class="text-nu" x-text="item.kategori || 'BERITA'"></span>
                                    <span>•</span>
                                    <span x-text="item.created_at ? new Date(item.created_at).toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'}) : 'Baru saja'"></span>
                                </div>
                                <h3 class="text-sm sm:text-base font-bold text-gray-900 group-hover:text-nu transition-colors leading-snug line-clamp-2" x-text="item.judul"></h3>
                                <div class="pt-1">
                                    <a :href="'/berita/' + item.id" class="inline-flex items-center gap-1 text-xs font-bold text-nu hover:underline">
                                        <span>Baca Selengkapnya</span>
                                        <i class="fa-solid fa-arrow-right text-[9px]"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </template>
                </div>

                <!-- PESAN JIKA KOSONG -->
                <div x-show="paginatedBerita.length === 0" class="bg-white p-8 rounded-2xl border border-gray-100 text-center shadow-sm">
                    <i class="fa-solid fa-magnifying-glass text-3xl text-emerald-200 mb-2 block"></i>
                    <h4 class="text-sm font-bold text-gray-800">Berita tidak ditemukan</h4>
                    <p class="text-xs text-gray-500 mt-0.5">Tidak ada berita yang cocok dengan kata kunci "<span x-text="searchQuery" class="font-bold text-nu"></span>".</p>
                    <button @click="searchQuery = ''; page = 1;" type="button" class="mt-3 bg-emerald-50 text-nu hover:bg-emerald-100 px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all">
                        Reset Pencarian
                    </button>
                </div>

                <!-- PAGINATION -->
                <div class="flex items-center justify-between pt-2 bg-white px-5 py-3 rounded-2xl border border-gray-100 shadow-sm" x-show="maxPage > 1">
                    <span class="text-xs font-medium text-gray-500">
                        Halaman <span class="font-bold text-gray-800" x-text="page"></span> dari <span class="font-bold text-gray-800" x-text="maxPage"></span>
                    </span>

                    <div class="flex items-center gap-2">
                        <button @click="if (page > 1) page--" :disabled="page === 1" :class="page === 1 ? 'opacity-40 cursor-not-allowed bg-gray-100 text-gray-400' : 'bg-white hover:bg-emerald-50 text-gray-700 hover:text-nu border border-gray-200 shadow-sm'" class="px-3 py-1 rounded-xl text-xs font-bold transition-all">
                            <i class="fa-solid fa-chevron-left text-[9px]"></i>
                        </button>
                        <button @click="if (page < maxPage) page++" :disabled="page === maxPage" :class="page === maxPage ? 'opacity-40 cursor-not-allowed bg-gray-100 text-gray-400' : 'bg-nu text-white hover:bg-nu-dark shadow-md'" class="px-3 py-1 rounded-xl text-xs font-bold transition-all">
                            <i class="fa-solid fa-chevron-right text-[9px]"></i>
                        </button>
                    </div>
                </div>

            </div>

            <!-- KOLOM KANAN KOSONG -->
            <div class="lg:col-span-6"></div>

        </div>
    </div>

    <!-- SCRIPT INTERSECTION OBSERVER -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, {
                threshold: 0.05,
                rootMargin: '0px 0px -20px 0px'
            });

            document.querySelectorAll('.reveal').forEach((el) => {
                observer.observe(el);
            });
        });
    </script>
@include('layouts.footer')

</body>
</html>