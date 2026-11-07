<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal & Dokumentasi Kegiatan - Nahdlatul Ulama Ranting Kedungurang</title>
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
                        nu: { DEFAULT: '#006837', dark: '#004d28' } 
                    }
                }
            }
        }
    </script>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(25px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal-on-scroll.is-revealed {
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
            
            <!-- Logo & Nama Ranting -->
            <a href="/" class="flex items-center gap-3 group">
                <img src="{{ asset('images/logo-nu.png') }}" id="secretLogo" class="h-9 w-auto object-contain cursor-pointer select-none" alt="Logo NU">
                <div>
                    <span class="text-white font-extrabold text-sm sm:text-base tracking-tight block group-hover:text-amber-300 transition-colors">
                        NU Kedungurang
                    </span>
                    <span class="text-[10px] text-emerald-200/90 font-medium tracking-wider uppercase block">
                        Portal Resmi Ranting
                    </span>
                </div>
            </a>

            <!-- Menu Navigasi Desktop -->
            <div class="hidden md:flex items-center space-x-1 bg-black/20 p-1 rounded-full">
                <a href="{{ route('berita.index') }}" class="px-4 py-1.5 rounded-full text-xs font-bold transition-all duration-300 {{ request()->routeIs('berita.index') ? 'bg-white text-nu shadow-sm' : 'text-white hover:bg-white/20' }}">Beranda</a>
                <a href="{{ route('organisasi.index') }}" class="px-4 py-1.5 rounded-full text-xs font-bold transition-all duration-300 {{ request()->routeIs('organisasi.index') ? 'bg-white text-nu shadow-sm' : 'text-white hover:bg-white/20' }}">Struktur dan Organisasi</a>
                <a href="{{ route('kegiatan.index') }}" class="px-4 py-1.5 rounded-full text-xs font-bold transition-all duration-300 {{ request()->routeIs('kegiatan.index') ? 'bg-white text-nu shadow-sm' : 'text-white hover:bg-white/20' }}">Kegiatan</a>
                <a href="{{ route('anggota.index') }}" class="px-4 py-1.5 rounded-full text-xs font-bold transition-all duration-300 {{ request()->routeIs('anggota.index') ? 'bg-white text-nu shadow-sm' : 'text-white hover:bg-white/20' }}">Anggota</a>
            </div>

            <!-- Tombol Dashboard / Login & Hamburger -->
            <div class="flex items-center gap-2">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex items-center gap-1.5 bg-amber-400 hover:bg-amber-300 text-gray-950 px-4 py-2 rounded-full text-xs font-extrabold shadow-md transition-all">
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Dashboard</span>
                    </a>
                @endauth
                <!-- GUNAKAN z-[70] AGAR TOMBOL BERADA DI LAPISAN PALING ATAS -->
                <button id="hamburger-btn" class="md:hidden w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors focus:outline-none relative z-[70]">
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

<!-- SCRIPT KLIK RAHASIA & HAMBURGER -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Klik rahasia logo (3x klik)
        let clickCount = 0;
        let clickTimer;
        const logo = document.getElementById('secretLogo');

        if (logo) {
            logo.addEventListener('click', function(e) {
                e.preventDefault();
                clickCount++;
                clearTimeout(clickTimer);
                clickTimer = setTimeout(() => { clickCount = 0; }, 800);
                if (clickCount === 3) {
                    window.location.href = "{{ route('login') }}";
                }
            });
        }

        // Toggle Hamburger Menu Mobile
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');

        if(hamburgerBtn && mobileMenu && hamburgerIcon) {
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
        }
    });
</script>

<!-- KONTEN UTAMA HALAMAN -->
<main class="flex-grow">
    
    <!-- BANNER JADWAL & DOKUMENTASI KEGIATAN -->
    <section class="relative bg-[#FAF7F0] text-gray-800 py-10 sm:py-14 px-6 sm:px-10 rounded-3xl shadow-lg border border-amber-100/60 overflow-hidden max-w-7xl mx-auto w-full mt-28">
        <div class="absolute inset-0 pointer-events-none opacity-45 select-none overflow-hidden">
            <div class="absolute -top-10 -left-10 w-44 h-12 bg-emerald-600/15 rounded-full transform -rotate-45"></div>
            <div class="absolute -bottom-8 -right-8 w-56 h-14 bg-emerald-700/15 rounded-full transform -rotate-45"></div>
            <div class="absolute left-8 bottom-6 grid grid-cols-5 gap-2 opacity-40">
                <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
                <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
                <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
                <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
                <div class="w-1.5 h-1.5 rounded-full bg-emerald-800"></div>
            </div>
        </div>

        <div class="relative z-10 max-w-3xl space-y-3">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-black tracking-tight text-gray-950 uppercase">
                Jadwal & Dokumentasi Kegiatan
            </h1>

            <div class="flex items-center gap-1.5 py-0.5">
                <div class="h-1 w-2 bg-emerald-600/50 rounded-full"></div>
                <div class="h-1 w-12 sm:w-16 bg-gradient-to-r from-emerald-600 via-emerald-800 to-emerald-600 rounded-full"></div>
                <div class="h-1 w-2 bg-emerald-600/50 rounded-full"></div>
            </div>

            <p class="text-xs sm:text-sm text-emerald-900 leading-relaxed font-semibold">
                Informasi lengkap mengenai jadwal majelis taklim, pengajian selapanan, agenda kegiatan, serta arsip foto dokumentasi kegiatan Nahdlatul Ulama Ranting Kedungurang.
            </p>

            <div class="pt-2 flex flex-wrap gap-3">
                <a href="#jadwal" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs shadow-md transition-all">
                    <i class="fa-solid fa-calendar-days text-amber-400"></i>
                    <span>Jadwal Bulan Ini</span>
                </a>
                <a href="#dokumentasi" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-amber-400 hover:bg-amber-500 text-gray-950 font-bold text-xs shadow-md transition-all">
                    <i class="fa-solid fa-images"></i>
                    <span>Lihat Foto Dokumentasi</span>
                    <i class="fa-solid fa-arrow-down text-[10px]"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- SECTION 1: DAFTAR JADWAL KEGIATAN -->
    <section id="jadwal" class="max-w-7xl mx-auto w-full mt-8 px-4 sm:px-6 reveal-on-scroll">
        <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-sm border border-gray-100">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-black text-gray-900 font-heading">Jadwal Agenda Ranting</h2>
                    <p class="text-xs text-emerald-800 font-medium">Agenda kegiatan Nahdlatul Ulama Kedungurang terdekat</p>
                </div>
                
                @auth
                    @if(auth()->user()->role == 'admin' || auth()->user()->is_admin)
                        <a href="{{ route('admin.jadwal.create') }}" class="px-3 py-1.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl text-xs font-bold shadow">
                            + Tambah Jadwal
                        </a>
                    @endif
                @endauth
            </div>

            @php
                // Mengakomodasi variabel kegiatan dari berbagai penamaan controller ($jadwals, $kegiatans, dll)
                $kegiatanList = $jadwals ?? $kegiatans ?? $kegiatan ?? $data ?? [];
            @endphp

            @if(count($kegiatanList) > 0)
                <div class="space-y-4">
                    @foreach($kegiatanList as $item)
                        @php
                            $tanggal = \Carbon\Carbon::parse($item->tanggal ?? $item->created_at);
                        @endphp
                        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5 group">
                            
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-2xl bg-emerald-50 border border-emerald-100 flex flex-col items-center justify-center text-nu shrink-0 shadow-inner">
                                    <span class="text-xs font-bold uppercase tracking-wider">{{ $tanggal->format('M') }}</span>
                                    <span class="text-xl font-black leading-tight">{{ $tanggal->format('d') }}</span>
                                </div>

                                <div class="space-y-1.5">
                                    <div>
                                        <span class="inline-block px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-emerald-100 text-emerald-800 uppercase tracking-wide">
                                            {{ $item->kategori ?? 'Kegiatan' }}
                                        </span>
                                    </div>

                                    <h3 class="text-base sm:text-lg font-black text-gray-900 group-hover:text-nu transition-colors">
                                        {{ $item->nama_kegiatan ?? $item->judul }}
                                    </h3>

                                    <div class="flex flex-wrap items-center gap-4 text-xs font-semibold text-gray-500 pt-0.5">
                                        <span class="flex items-center gap-1.5 text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg">
                                            <i class="fa-regular fa-clock text-nu"></i>
                                            {{ $item->waktu ?? '09:00 WIB - Selesai' }}
                                        </span>
                                        <span class="flex items-center gap-1.5 text-gray-600">
                                            <i class="fa-solid fa-location-dot text-rose-500"></i>
                                            {{ $item->lokasi ?? 'Kantor Ranting NU Kedungurang' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full sm:w-auto flex items-center justify-end gap-2 pt-3 sm:pt-0 border-t sm:border-t-0 border-gray-100">
                                <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-gray-50 text-gray-700 font-bold text-xs border border-gray-200 group-hover:bg-nu group-hover:text-white group-hover:border-nu transition-all duration-300">
                                    <span>Hadir</span>
                                    <i class="fa-solid fa-check text-[10px]"></i>
                                </span>

                                @auth
                                    @if(auth()->user()->role == 'admin' || auth()->user()->is_admin)
                                        <div class="flex items-center gap-1.5">
                                            <a href="{{ url('/kegiatan/' . $item->id . '/edit') }}" class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white flex items-center justify-center transition-colors text-xs" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ url('/kegiatan/' . $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-8 h-8 rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white flex items-center justify-center transition-colors text-xs" title="Hapus">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10">
                    <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center mx-auto mb-3 text-emerald-600">
                        <i class="fa-solid fa-calendar-xmark text-2xl"></i>
                    </div>
                    <p class="text-xs sm:text-sm font-semibold text-gray-500">
                        Belum ada jadwal kegiatan untuk bulan ini.
                    </p>
                </div>
            @endif
        </div>
    </section>

    <!-- SECTION 2: DOKUMENTASI KEGIATAN (FOTO DITAMBAHKAN DARI ADMIN) -->
    <section id="dokumentasi" class="max-w-7xl mx-auto w-full mt-10 mb-16 px-4 sm:px-6 reveal-on-scroll">
        <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-sm border border-gray-100">
            
            <div class="flex flex-wrap items-center justify-between mb-6 pb-4 border-b border-gray-100 gap-4">
                <div>
                    <h2 class="text-xl sm:text-2xl font-black text-gray-900 font-heading">
                        Dokumentasi Kegiatan
                    </h2>
                    <p class="text-xs text-emerald-800 font-medium mt-1">
                        Galeri foto dan rekam jejak kegiatan NU Ranting Kedungurang
                    </p>
                </div>

                <!-- TOMBOL UPLOAD FOTO KHUSUS ADMIN -->
                @auth
                    @if(auth()->user()->role == 'admin' || auth()->user()->is_admin)
                        <a href="{{ route('admin.dokumentasi.create') }}" class="inline-flex items-center gap-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold px-4 py-2 rounded-xl shadow transition-all">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <span>Tambah Foto Dokumentasi</span>
                        </a>
                    @endif
                @endauth
            </div>

            <!-- GRID FOTO DOKUMENTASI DARI DATABASE -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @if(isset($dokumentasis) && $dokumentasis->count() > 0)
                    @foreach($dokumentasis as $dok)
                        <div class="group relative bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-all">
                            <div class="aspect-[4/3] overflow-hidden bg-gray-200">
                                <img src="{{ asset('storage/' . $dok->foto) }}" 
                                     alt="{{ $dok->judul }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                            <div class="p-4 bg-white">
                                <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md">
                                    {{ $dok->kategori ?? 'Dokumentasi' }}
                                </span>
                                <h3 class="text-sm font-bold text-gray-900 mt-2 line-clamp-1">
                                    {{ $dok->judul }}
                                </h3>
                                <p class="text-[11px] text-gray-500 mt-1 flex items-center gap-1">
                                    <i class="fa-regular fa-clock text-[10px]"></i> {{ $dok->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-full border-2 border-dashed border-gray-200 rounded-2xl p-8 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center mb-2">
                            <i class="fa-solid fa-camera"></i>
                        </div>
                        <p class="text-xs font-bold text-gray-700">Belum Ada Dokumentasi Foto</p>
                        <p class="text-[10px] text-gray-400 mt-0.5">Foto kegiatan terbaru akan diunggah melalui panel admin.</p>
                    </div>
                @endif
            </div>

        </div>
    </section>
</main>

<!-- SCRIPT INTERSECTION OBSERVER -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -50px 0px',
            threshold: 0.15
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-revealed');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal-on-scroll').forEach(el => {
            observer.observe(el);
        });
    });
</script>

@include('layouts.footer')

</body>
</html>