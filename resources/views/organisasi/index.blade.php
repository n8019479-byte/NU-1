<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi - NU Ranting Kedungurang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        /* CSS Animasi Pop-up Diperlambat (1.2 detik) */
        .reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 1.2s cubic-bezier(0.16, 1, 0.3, 1), transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        /* Class active ditambahkan via JS saat berada di layar */
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
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

<!-- OVERLAY MENU FULL SCREEN (GESER DARI KANAN) -->
<div id="mobile-menu" class="fixed inset-0 bg-[#FAF7F0] z-40 transform translate-x-full transition-transform duration-300 ease-in-out md:hidden flex flex-col justify-between px-6 py-24">
    
    <!-- Bagian Link Menu Utama -->
    <div class="space-y-6 flex flex-col">
        <a href="{{ route('berita.index') }}" class="text-2xl font-black text-gray-900 hover:text-nu transition-colors flex items-center justify-between border-b border-gray-200 pb-4">
            <span>Beranda</span>
            @if(request()->routeIs('berita.index'))
                <span class="w-3 h-3 rounded-full bg-nu"></span>
            @endif
        </a>
        <a href="{{ route('organisasi.index') }}" class="text-2xl font-black text-gray-900 hover:text-nu transition-colors flex items-center justify-between border-b border-gray-200 pb-4">
            <span>Struktur Organisasi</span>
            @if(request()->routeIs('organisasi.index'))
                <span class="w-3 h-3 rounded-full bg-nu"></span>
            @endif
        </a>
        <a href="{{ route('kegiatan.index') }}" class="text-2xl font-black text-gray-900 hover:text-nu transition-colors flex items-center justify-between border-b border-gray-200 pb-4">
            <span>Kegiatan</span>
            @if(request()->routeIs('kegiatan.index'))
                <span class="w-3 h-3 rounded-full bg-nu"></span>
            @endif
        </a>
        <a href="{{ route('anggota.index') }}" class="text-2xl font-black text-gray-900 hover:text-nu transition-colors flex items-center justify-between border-b border-gray-200 pb-4">
            <span>Anggota</span>
            @if(request()->routeIs('anggota.index'))
                <span class="w-3 h-3 rounded-full bg-nu"></span>
            @endif
        </a>
    </div>

    <!-- Bagian Bawah: Tombol Dashboard / Login Admin -->
    <div class="space-y-3 pb-6">
        @auth
            <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center gap-2 w-full bg-nu text-white py-3.5 rounded-2xl text-sm font-extrabold shadow-lg">
                <i class="fa-solid fa-gauge-high"></i> Dashboard Admin
            </a>
        @else
        @endauth
    </div>

</div>

<!-- Script untuk Toggle Animasi Geser dari Kanan & Icon Close -->
<script>
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburgerIcon = document.getElementById('hamburger-icon');

    hamburgerBtn.addEventListener('click', () => {
        // Toggle posisi menu (geser masuk/keluar layar)
        mobileMenu.classList.toggle('translate-x-full');
        
        // Ubah icon hamburger (fa-bars) menjadi silang (fa-xmark)
        if (mobileMenu.classList.contains('translate-x-full')) {
            hamburgerIcon.classList.remove('fa-xmark');
            hamburgerIcon.classList.add('fa-bars');
            document.body.style.overflow = 'auto'; // Aktifkan kembali scroll halaman
        } else {
            hamburgerIcon.classList.remove('fa-bars');
            hamburgerIcon.classList.add('fa-xmark');
            document.body.style.overflow = 'hidden'; // Kunci scroll halaman saat menu terbuka penuh
        }
    });
</script>

<!-- BANNER HERO ORGANISASI (Lengkap dengan Ornamen Geometris CSS/SVG & Watermark) -->
<section class="bg-[#FAF7F0] text-gray-800 py-6 sm:py-12 px-4 sm:px-6 rounded-3xl shadow-lg border border-amber-100/60 transition-all mt-24 sm:mt-28 max-w-7xl mx-auto w-full relative overflow-hidden">
    
    <!-- LAYER WATERMARK GEOMETRIS (CSS & SVG MURNI) -->
    <div class="absolute inset-0 pointer-events-none opacity-45 select-none overflow-hidden">
        
        <!-- 1. Batang Kapsul Miring (Pill Shapes) Kiri Atas -->
        <div class="absolute -top-8 -left-8 w-40 h-10 bg-emerald-600/15 rounded-full transform -rotate-45"></div>
        <div class="absolute top-2 left-12 w-28 h-6 bg-amber-400/20 rounded-full transform -rotate-45"></div>

        <!-- 2. Batang Kapsul Miring Kanan Bawah -->
        <div class="absolute -bottom-10 -right-6 w-52 h-12 bg-emerald-700/15 rounded-full transform -rotate-45"></div>
        <div class="absolute bottom-8 right-24 w-32 h-7 bg-emerald-500/10 rounded-full transform -rotate-45"></div>

        <!-- 3. Lingkaran Ring Aksen -->
        <div class="absolute top-1/3 left-1/2 w-16 h-16 rounded-full border-2 border-emerald-600/20 border-dashed"></div>
        <div class="absolute bottom-4 left-1/3 w-6 h-6 rounded-full border border-amber-500/40"></div>

        <!-- 4. Pola Titik Grid (Dot Grid Matrix) Kiri Bawah -->
        <div class="absolute left-6 bottom-4 grid grid-cols-5 gap-1.5 opacity-35">
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

        <!-- 5. Garis Lengkung Dekoratif SVG -->
        <svg class="absolute right-1/3 bottom-2 w-36 h-14 text-emerald-700/15" viewBox="0 0 100 40" fill="none">
            <path d="M0 30 Q 25 5, 50 30 T 100 30" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"/>
        </svg>
    </div>

    <!-- KONTEN UTAMA BANNER HERO -->
    <div class="max-w-6xl mx-auto relative z-10">
        <!-- Menggunakan Grid 12 Kolom dengan Dukungan Tampilan Samping di HP -->
        <div class="grid grid-cols-12 gap-2 sm:gap-6 items-center">
        
            <!-- SISI KIRI: KONTEN TEKS (Diatur 8 kolom di HP agar muat berdampingan) -->
            <div class="col-span-8 sm:col-span-7 space-y-2 sm:space-y-4 text-left">
                
                <!-- Judul Utama -->
                <h1 class="text-sm sm:text-2xl md:text-3xl lg:text-4xl font-black tracking-tight leading-tight text-gray-950 font-heading">
                    Struktur & Keorganisasian NU Kedungurang
                </h1>

                <!-- Garis Pembatas Akses Hijau -->
                <div class="flex items-center gap-1.5 py-0.5">
                    <div class="h-0.5 sm:h-1 w-2 bg-emerald-600/50 rounded-full"></div>
                    <div class="h-0.5 sm:h-1 w-8 sm:w-16 bg-gradient-to-r from-emerald-600 via-emerald-800 to-emerald-600 rounded-full"></div>
                    <div class="h-0.5 sm:h-1 w-2 bg-emerald-600/50 rounded-full"></div>
                </div>

                <!-- Deskripsi Sub-Judul -->
                <p class="text-[10px] sm:text-xs md:text-sm text-emerald-900 leading-relaxed font-semibold max-w-lg">
                    Mengenal jajaran kepengurusan Syuriah, Tanfidziyah, pilar-pilar gerakan, serta jaringan Badan Otonom Nahdlatul Ulama Ranting Kedungurang.
                </p>

                <!-- Tombol Aksi -->
                <div class="pt-1">
                    <a href="#struktur" class="inline-flex items-center gap-1.5 px-3 sm:px-5 py-1.5 sm:py-2 rounded-xl bg-amber-400 hover:bg-amber-500 text-gray-950 font-bold text-[10px] sm:text-xs shadow-md transition-all duration-300 hover:-translate-y-0.5">
                        <span>Lihat Kepengurusan</span>
                        <i class="fa-solid fa-arrow-down text-[9px] sm:text-[10px]"></i>
                    </a>
                </div>

            </div>

            <!-- SISI KANAN: LOGO NU (Diatur 4 kolom di HP agar tetap berada di samping kanan) -->
            <div class="col-span-4 sm:col-span-5 flex justify-center sm:justify-end items-center">
                <img src="{{ asset('images/watermarknu.png') }}" 
                     alt="Watermark NU Kedungurang" 
                     class="w-24 sm:w-64 md:w-80 lg:w-96 max-w-full object-contain opacity-90 transition-all duration-300 pointer-events-none select-none">
            </div>

        </div>
    </div>
</section>

<!-- SECTION STRUKTUR PENGURUS (Fit Otomatis di Layar HP Tanpa Scroll Samping) -->
<section id="struktur" class="max-w-7xl mx-auto w-full mt-8 px-2 sm:px-6">
    <div class="bg-white p-4 sm:p-8 rounded-3xl shadow-md border border-gray-100">
        <div class="mb-4 sm:mb-6 text-center sm:text-left">
            <h2 class="text-base sm:text-2xl font-extrabold text-gray-900">
                Struktur Pengurus Ranting NU Kedungurang
            </h2>
            <p class="text-xs sm:text-sm text-emerald-700 font-semibold">
                Masa Khidmat 2024 – 2029
            </p>
        </div>

        <!-- Pembungkus Diagram dengan Auto Scaling khusus perangkat seluler -->
        <div class="w-full overflow-hidden flex justify-center py-1">
            <div class="transform scale-[0.82] xs:scale-[0.9] sm:scale-100 origin-top flex flex-col items-center min-w-[390px] sm:min-w-full -my-4 sm:my-0">
                
                    <!-- CONTAINER BAGAN STRUKTUR (MENDUKUNG SCROLL HORIZON PADA HP JIKA LAYAR SANGAT KECIL) -->
    <div class="bg-white/90 backdrop-blur-md rounded-3xl p-4 sm:p-8 md:p-10 border border-emerald-100 shadow-xl space-y-8 overflow-x-auto">
        
        <div class="min-w-[640px] sm:min-w-0">
            
            <!-- ================= 1. LEVEL SYURIAH & MUSTASYAR ================= -->
            <div class="relative">
                <!-- HEADER LEVEL: SYURIAH -->
                <div class="flex items-center justify-center mb-6">
                    <span class="bg-emerald-900 text-emerald-100 font-extrabold text-[11px] sm:text-xs px-4 py-1.5 rounded-full border border-emerald-700 shadow-sm uppercase tracking-wider">
                        <i class="fa-solid mr-1.5 text-amber-300"></i> Jajaran Syuriah
                    </span>
                </div>

                <!-- ROIS SYURIAH (PUNCAK) -->
                <div class="flex flex-col items-center relative">
                    <div class="w-full max-w-xs sm:max-w-sm text-center bg-emerald-800 text-white rounded-2xl shadow-md border-2 border-emerald-600 p-2.5 sm:p-3.5 relative z-10">
                        <span class="absolute -top-2.5 left-1/2 -translate-x-1/2 bg-gray-200 text-gray-800 font-extrabold text-[9px] sm:text-[10px] px-3 py-0.5 rounded-full uppercase tracking-wider shadow-sm border border-gray-300 whitespace-nowrap">
                            Rais Syuriah
                        </span>
                        <h3 class="text-xs sm:text-sm md:text-base font-extrabold mt-1 text-white">KH. Ahmad Ridwan</h3>
                    </div>

                    <!-- GARIS TURUNAN DARI RAIS SYURIAH -->
                    <div class="h-6 sm:h-8 w-0.5 bg-emerald-700"></div>
                </div>

                <!-- GARIS HORIZONTAL HUBUNGAN SYURIAH (SELALU MUNCUL) -->
                <div class="relative max-w-3xl sm:max-w-4xl mx-auto h-0.5 bg-emerald-700 -mt-0.5">
                    <div class="absolute left-[16.66%] top-0 h-4 sm:h-6 w-0.5 bg-emerald-700"></div>
                    <div class="absolute left-1/2 -translate-x-1/2 top-0 h-4 sm:h-6 w-0.5 bg-emerald-700"></div>
                    <div class="absolute right-[16.66%] top-0 h-4 sm:h-6 w-0.5 bg-emerald-700"></div>
                </div>

                <!-- SYURIAH JAJARAN (SELAU 3 KOLOM DI SEMUA LAYAR) -->
                <div class="grid grid-cols-3 gap-3 sm:gap-6 items-start max-w-4xl sm:max-w-5xl mx-auto pt-4 sm:pt-6">
                    
                    <!-- A'wan -->
                    <div class="flex flex-col items-center">
                        <div class="w-full bg-emerald-800/95 text-white rounded-2xl p-2.5 sm:p-4 border border-emerald-700 shadow-sm text-center relative z-10">
                            <span class="inline-block bg-gray-200 text-gray-800 font-extrabold text-[9px] sm:text-[10px] px-2.5 sm:px-3.5 py-0.5 rounded-full uppercase tracking-wider mb-1.5 border border-gray-300">
                                A'wan
                            </span>
                            <ul class="text-[10px] sm:text-xs font-semibold space-y-1 text-emerald-50">
                                <li>Kyai H. Musthofa</li>
                                <li>Bpk. Ahmad Subagyo</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Wakil Rais & Katib (Tengah) -->
                    <div class="space-y-3 sm:space-y-4 flex flex-col items-center">
                        <div class="w-full bg-emerald-800 text-white rounded-2xl p-2.5 sm:p-3.5 border border-emerald-700 shadow-sm text-center relative z-10">
                            <span class="inline-block bg-gray-200 text-gray-800 font-extrabold text-[9px] sm:text-[10px] px-2.5 sm:px-3.5 py-0.5 rounded-full uppercase tracking-wider mb-1 border border-gray-300">
                                Wakil Rais
                            </span>
                            <p class="text-[10px] sm:text-xs font-extrabold text-white">Kyai Solihin</p>
                        </div>

                        <!-- Garis Penghubung Vertikal -->
                        <div class="h-3 sm:h-4 w-0.5 bg-emerald-700 my-0"></div>

                        <div class="w-full bg-emerald-800 text-white rounded-2xl p-2.5 sm:p-3.5 border border-emerald-700 shadow-sm text-center relative z-10">
                            <span class="inline-block bg-gray-200 text-gray-800 font-extrabold text-[9px] sm:text-[10px] px-2.5 sm:px-3.5 py-0.5 rounded-full uppercase tracking-wider mb-1 border border-gray-300">
                                Katib
                            </span>
                            <p class="text-[10px] sm:text-xs font-extrabold text-white">Ust. H. Fauzi</p>
                        </div>
                    </div>

                    <!-- Mustasyar -->
                    <div class="flex flex-col items-center">
                        <div class="w-full bg-emerald-800/95 text-white rounded-2xl p-2.5 sm:p-4 border border-emerald-700 shadow-sm text-center relative z-10">
                            <span class="inline-block bg-gray-200 text-gray-800 font-extrabold text-[9px] sm:text-[10px] px-2.5 sm:px-3.5 py-0.5 rounded-full uppercase tracking-wider mb-1.5 border border-gray-300">
                                Mustasyar
                            </span>
                            <ul class="text-[10px] sm:text-xs font-semibold space-y-1 text-emerald-50">
                                <li>KH. Hasan Bisri</li>
                                <li>Kyai M. Dahlan</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <!-- GARIS UTAMA TEGAS HUBUNGAN SYURIAH KE TANFIDZIYAH -->
            <div class="flex flex-col items-center py-2 relative">
                <div class="h-10 sm:h-12 w-0.5 bg-emerald-700"></div>
                <div class="w-2.5 h-2.5 border-r-2 border-b-2 border-emerald-700 rotate-45 -mt-2"></div>
            </div>

            <!-- ================= 2. LEVEL TANFIDZIYAH (PELAKSANA) ================= -->
            <div class="relative pt-1">
                <!-- HEADER LEVEL: TANFIDZIYAH -->
                <div class="flex items-center justify-center mb-6">
                    <span class="bg-nu text-white font-extrabold text-[11px] sm:text-xs px-4 py-1.5 rounded-full border border-emerald-600 shadow-sm uppercase tracking-wider">
                        <i class="fa-solid mr-1.5"></i> Jajaran Tanfidziyah                     </span>
                </div>

                <!-- KETUA TANFIDZIYAH -->
                <div class="flex flex-col items-center relative">
                    <div class="w-full max-w-xs sm:max-w-md text-center bg-nu text-white rounded-2xl shadow-md border-2 border-emerald-500 p-2.5 sm:p-3.5 relative z-10">
                        <span class="absolute -top-2.5 left-1/2 -translate-x-1/2 bg-gray-200 text-gray-800 font-extrabold text-[9px] sm:text-[10px] px-3 py-0.5 rounded-full uppercase tracking-wider shadow-sm border border-gray-300 whitespace-nowrap">
                            Ketua Tanfidziyah
                        </span>
                        <h3 class="text-xs sm:text-sm md:text-base font-black text-white mt-1">H. Muhammad Abdullah</h3>
                    </div>

                    <!-- GARIS TURUNAN DARI KETUA TANFIDZIYAH -->
                    <div class="h-6 sm:h-8 w-0.5 bg-emerald-700"></div>
                </div>

                <!-- GARIS HORIZONTAL HUBUNGAN PENGURUS HARIAN (SELALU MUNCUL) -->
                <div class="relative max-w-3xl sm:max-w-4xl mx-auto h-0.5 bg-emerald-700 -mt-0.5">
                    <div class="absolute left-[16.66%] top-0 h-4 sm:h-6 w-0.5 bg-emerald-700"></div>
                    <div class="absolute left-1/2 -translate-x-1/2 top-0 h-4 sm:h-6 w-0.5 bg-emerald-700"></div>
                    <div class="absolute right-[16.66%] top-0 h-4 sm:h-6 w-0.5 bg-emerald-700"></div>
                </div>

                <!-- PENGURUS HARIAN (SELALU 3 KOLOM DI SEMUA LAYAR) -->
                <div class="grid grid-cols-3 gap-3 sm:gap-6 max-w-4xl sm:max-w-5xl mx-auto pt-4 sm:pt-6">
                    
                    <!-- Wakil Ketua -->
                    <div class="bg-emerald-50/90 border border-emerald-200 rounded-2xl p-2.5 sm:p-4 text-center shadow-sm relative z-10">
                        <span class="inline-block bg-gray-200 text-gray-800 font-extrabold text-[9px] sm:text-[10px] px-2.5 sm:px-3.5 py-0.5 rounded-full uppercase tracking-wider mb-1.5 border border-gray-300">
                            Wakil Ketua
                        </span>
                        <p class="text-[10px] sm:text-xs font-bold text-gray-900">Bpk. Ahmad Sobari, S.Pd</p>
                    </div>

                    <!-- Sekretaris -->
                    <div class="bg-emerald-50/90 border border-emerald-200 rounded-2xl p-2.5 sm:p-4 text-center shadow-sm relative z-10">
                        <span class="inline-block bg-gray-200 text-gray-800 font-extrabold text-[9px] sm:text-[10px] px-2.5 sm:px-3.5 py-0.5 rounded-full uppercase tracking-wider mb-1.5 border border-gray-300">
                            Sekretaris
                        </span>
                        <p class="text-[10px] sm:text-xs font-bold text-gray-900">Bpk. Nur Hidayat</p>
                    </div>

                    <!-- Bendahara -->
                    <div class="bg-emerald-50/90 border border-emerald-200 rounded-2xl p-4 text-center shadow-sm relative z-10">
                        <span class="inline-block bg-gray-200 text-gray-800 font-extrabold text-[9px] sm:text-[10px] px-2.5 sm:px-3.5 py-0.5 rounded-full uppercase tracking-wider mb-1.5 border border-gray-300">
                            Bendahara
                        </span>
                        <p class="text-[10px] sm:text-xs font-bold text-gray-900">H. Zaenal Arifin</p>
                    </div>

                </div>
            </div>
        </div>

    </div>

                
            </div>
        </div>
    </div>
</section>

<!-- SECTION BADAN OTONOM (BANOM) -->
<section class="py-12 sm:py-16 px-4 sm:px-6 max-w-7xl mx-auto w-full space-y-10">

    <!-- HEADER SECTION (RATA KIRI) -->
    <div class="text-left space-y-2">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-black text-gray-950 tracking-tight font-heading">
            Badan Otonom (Banom)
        </h2>
        <div class="flex items-center gap-1.5 py-0.5">
            <div class="h-1 w-2 bg-emerald-600/50 rounded-full"></div>
            <div class="h-1 w-12 bg-emerald-600 rounded-full"></div>
            <div class="h-1 w-2 bg-emerald-600/50 rounded-full"></div>
        </div>
        <p class="text-xs sm:text-sm font-bold text-emerald-800">Lembaga basis kaderisasi & pengabdian masyarakat Nahdlatul Ulama</p>
    </div>

    <!-- GRID KARTU BANOM (5 KARTU UKURAN SERAGAM DENGAN GRID 3 KOLOM SIMETRIS) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- 1. MUSLIMAT NU -->
        <div class="bg-white rounded-3xl p-6 border border-emerald-100/80 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between h-full relative overflow-hidden group">
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-600 via-emerald-700 to-emerald-900"></div>
            <div class="space-y-4">
                <!-- LOGO BANOM -->
                <div class="w-16 h-16 mx-auto bg-emerald-50/80 rounded-2xl flex items-center justify-center p-2.5 border border-emerald-100 shadow-inner group-hover:scale-105 transition-transform">
                    <img src="{{ asset('images/logo-muslimat.png') }}" alt="Logo Muslimat NU" class="w-full h-full object-contain">
                </div>
                <div class="text-center space-y-1.5">
                    <h3 class="text-base font-extrabold text-gray-950">Muslimat NU</h3>
                    <p class="text-[11px] text-gray-600 leading-relaxed px-1">
                        Wadah pembinaan dan pemberdayaan perempuan NU dewasa dalam bidang keagamaan, sosial, kesehatan, serta pendidikan keluarga.
                    </p>
                </div>
            </div>
            <div class="pt-6 text-center">
                <span class="inline-block bg-emerald-50 text-emerald-800 font-extrabold text-[10px] px-3.5 py-1 rounded-full border border-emerald-200">
                    Kader Perempuan
                </span>
            </div>
        </div>

        <!-- 2. GP ANSOR & BANSER -->
        <div class="bg-white rounded-3xl p-6 border border-emerald-100/80 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between h-full relative overflow-hidden group">
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-600 via-emerald-700 to-emerald-900"></div>
            <div class="space-y-4">
                <!-- LOGO BANOM -->
                <div class="w-16 h-16 mx-auto bg-emerald-50/80 rounded-2xl flex items-center justify-center p-2.5 border border-emerald-100 shadow-inner group-hover:scale-105 transition-transform">
                    <img src="{{ asset('images/logo-ansor.png') }}" alt="Logo GP Ansor" class="w-full h-full object-contain">
                </div>
                <div class="text-center space-y-1.5">
                    <h3 class="text-base font-extrabold text-gray-950">GP Ansor & Banser</h3>
                    <p class="text-[11px] text-gray-600 leading-relaxed px-1">
                        Garda terdepan pemuda NU yang bergerak di bidang kepemudaan, gerakan sosial, kebangsaan, serta pengamanan ulama dan NKRI.
                    </p>
                </div>
            </div>
            <div class="pt-6 text-center">
                <span class="inline-block bg-emerald-50 text-emerald-800 font-extrabold text-[10px] px-3.5 py-1 rounded-full border border-emerald-200">
                    Kader Pemuda
                </span>
            </div>
        </div>

        <!-- 3. FATAYAT NU -->
        <div class="bg-white rounded-3xl p-6 border border-emerald-100/80 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between h-full relative overflow-hidden group">
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-600 via-emerald-700 to-emerald-900"></div>
            <div class="space-y-4">
                <!-- LOGO BANOM -->
                <div class="w-16 h-16 mx-auto bg-emerald-50/80 rounded-2xl flex items-center justify-center p-2.5 border border-emerald-100 shadow-inner group-hover:scale-105 transition-transform">
                    <img src="{{ asset('images/logo-fatayat.png') }}" alt="Logo Fatayat NU" class="w-full h-full object-contain">
                </div>
                <div class="text-center space-y-1.5">
                    <h3 class="text-base font-extrabold text-gray-950">Fatayat NU</h3>
                    <p class="text-[11px] text-gray-600 leading-relaxed px-1">
                        Organisasi pemudi dan perempuan muda NU yang fokus pada isu hak perempuan, penguatan ekonomi keluarga, dan pengkaderan.
                    </p>
                </div>
            </div>
            <div class="pt-6 text-center">
                <span class="inline-block bg-emerald-50 text-emerald-800 font-extrabold text-[10px] px-3.5 py-1 rounded-full border border-emerald-200">
                    Pemudi NU
                </span>
            </div>
        </div>

        <!-- 4. IPNU (IKATAN PELAJAR NAHDLATUL ULAMA) -->
        <div class="bg-white rounded-3xl p-6 border border-emerald-100/80 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between h-full relative overflow-hidden group">
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-600 via-emerald-700 to-emerald-900"></div>
            <div class="space-y-4">
                <!-- LOGO IPNU -->
                <div class="w-16 h-16 mx-auto bg-emerald-50/80 rounded-2xl flex items-center justify-center p-2.5 border border-emerald-100 shadow-inner group-hover:scale-105 transition-transform">
                    <img src="{{ asset('images/logo-ipnu.png') }}" alt="Logo IPNU" class="w-full h-full object-contain">
                </div>
                <div class="text-center space-y-1.5">
                    <h3 class="text-base font-extrabold text-gray-950">IPNU</h3>
                    <p class="text-[11px] text-gray-600 leading-relaxed px-1">
                        Ikatan Pelajar Nahdlatul Ulama, wadah kaderisasi awal bagi pelajar dan santri putra untuk membentuk generasi yang berakhlak mulia.
                    </p>
                </div>
            </div>
            <div class="pt-6 text-center">
                <span class="inline-block bg-emerald-50 text-emerald-800 font-extrabold text-[10px] px-3.5 py-1 rounded-full border border-emerald-200">
                    Pelajar Putra
                </span>
            </div>
        </div>

        <!-- 5. IPPNU (IKATAN PELAJAR PUTRI NAHDLATUL ULAMA) -->
        <div class="bg-white rounded-3xl p-6 border border-emerald-100/80 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between h-full relative overflow-hidden group">
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-emerald-600 via-emerald-700 to-emerald-900"></div>
            <div class="space-y-4">
                <!-- LOGO IPPNU -->
                <div class="w-16 h-16 mx-auto bg-emerald-50/80 rounded-2xl flex items-center justify-center p-2.5 border border-emerald-100 shadow-inner group-hover:scale-105 transition-transform">
                    <img src="{{ asset('images/logo-ippnu.png') }}" alt="Logo IPPNU" class="w-full h-full object-contain">
                </div>
                <div class="text-center space-y-1.5">
                    <h3 class="text-base font-extrabold text-gray-950">IPPNU</h3>
                    <p class="text-[11px] text-gray-600 leading-relaxed px-1">
                        Ikatan Pelajar Putri Nahdlatul Ulama, wadah kaderisasi awal bagi pelajar dan santri putri dalam bingkai Ahlussunnah wal Jamaah.
                    </p>
                </div>
            </div>
            <div class="pt-6 text-center">
                <span class="inline-block bg-emerald-50 text-emerald-800 font-extrabold text-[10px] px-3.5 py-1 rounded-full border border-emerald-200">
                    Pelajar Putri
                </span>
            </div>
        </div>

    </div>

</section>
    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-200 py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} Pengurus Nahdlatul Ulama Ranting Kedungurang. All Rights Reserved.
        </div>
    </footer>

    <!-- SCRIPT ANIMASI REPEAT SCROLL -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        // Munculkan saat berada di layar
                        entry.target.classList.add('active');
                    } else {
                        // Reset sembunyi kembali saat keluar dari layar agar bisa berulang
                        entry.target.classList.remove('active');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            document.querySelectorAll('.reveal').forEach((el) => {
                observer.observe(el);
            });
        });
    </script>
@include('layouts.footer')

</body>
</html>