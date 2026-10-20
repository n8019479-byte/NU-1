<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kegiatan Bulanan - Nahdlatul Ulama Ranting Kedungurang</title>
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

<!-- OVERLAY MENU FULL SCREEN -->
<div id="mobile-menu" class="fixed inset-0 bg-[#FAF7F0] z-40 transform translate-x-full transition-transform duration-300 ease-in-out md:hidden flex flex-col justify-between px-6 py-24">
    <div class="space-y-6 flex flex-col">
        <a href="{{ route('berita.index') }}" class="text-2xl font-black text-gray-900 hover:text-nu transition-colors flex items-center justify-between border-b border-gray-200 pb-4">
            <span>Beranda</span>
            @if(request()->routeIs('berita.index')) <span class="w-3 h-3 rounded-full bg-nu"></span> @endif
        </a>
        <a href="{{ route('organisasi.index') }}" class="text-2xl font-black text-gray-900 hover:text-nu transition-colors flex items-center justify-between border-b border-gray-200 pb-4">
            <span>Struktur dan Organisasi</span>
            @if(request()->routeIs('organisasi.index')) <span class="w-3 h-3 rounded-full bg-nu"></span> @endif
        </a>
        <a href="{{ route('kegiatan.index') }}" class="text-2xl font-black text-gray-900 hover:text-nu transition-colors flex items-center justify-between border-b border-gray-200 pb-4">
            <span>Kegiatan</span>
            @if(request()->routeIs('kegiatan.index')) <span class="w-3 h-3 rounded-full bg-nu"></span> @endif
        </a>
        <a href="{{ route('anggota.index') }}" class="text-2xl font-black text-gray-900 hover:text-nu transition-colors flex items-center justify-between border-b border-gray-200 pb-4">
            <span>Anggota</span>
            @if(request()->routeIs('anggota.index')) <span class="w-3 h-3 rounded-full bg-nu"></span> @endif
        </a>
    </div>

    <div class="space-y-3 pb-6">
        @auth
            <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center gap-2 w-full bg-nu text-white py-3.5 rounded-2xl text-sm font-extrabold shadow-lg">
                <i class="fa-solid fa-gauge-high"></i> Dashboard Admin
            </a>
        @else
            <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full bg-amber-400 text-gray-950 py-3.5 rounded-2xl text-sm font-extrabold shadow-lg">
                <i class="fa-solid fa-right-to-bracket"></i> Login Admin
            </a>
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

   <!-- BANNER JADWAL KEGIATAN DENGAN VECTOR GEOMETRIC BACKGROUND (TANPA FOTO) -->
    <section class="relative bg-[#FAF7F0] text-gray-800 py-10 sm:py-14 px-6 sm:px-12 rounded-3xl shadow-lg border border-amber-100/60 overflow-hidden max-w-7xl mx-auto w-full my-6">
        
        <!-- ========================================================= -->
        <!-- ELEMEN GEOMETRIS VEKTOR ABSTRAK (PURE CSS & SVG)           -->
        <!-- ========================================================= -->
        <div class="absolute inset-0 pointer-events-none select-none overflow-hidden">
<!-- 1. POJOK KIRI ATAS -->
            <!-- Organic Blob Light Green -->
            <div class="absolute -top-10 -left-10 w-40 h-32 bg-[#bef264]/40 rounded-full blur-xl sm:blur-none transform -rotate-12"></div>
            <!-- Curve Wave Line -->
            <svg class="absolute top-4 left-6 w-32 h-16 stroke-[#65a30d]/40 fill-none" viewBox="0 0 100 50" stroke-width="2">
                <path d="M0,25 Q25,5 50,25 T100,25" />
            </svg>
            <!-- Dotted Grid Grid Kiri Atas -->
            <div class="absolute top-10 left-36 w-16 h-12 dot-pattern opacity-40"></div>
            <!-- Outline Circle -->
            <div class="absolute top-12 left-56 w-5 h-5 rounded-full border-2 border-[#65a30d]/50"></div>

            <!-- 2. POJOK KIRI BAWAH -->
            <!-- Outline Circle Mid-Left -->
            <div class="absolute top-28 left-6 w-5 h-5 rounded-full border-2 border-emerald-900/40"></div>
            <!-- Diagonal Accent Line -->
            <div class="absolute bottom-20 left-4 w-28 h-1.5 bg-emerald-800/60 rounded-full transform -rotate-[28deg]"></div>
            <!-- Small Solid Circle -->
            <div class="absolute bottom-28 left-28 w-3.5 h-3.5 bg-[#a3e635]/70 rounded-full"></div>
            <!-- Diagonal Pill Light Green -->
            <div class="absolute -bottom-10 -left-6 w-64 h-12 bg-[#bef264]/60 rounded-full transform -rotate-[28deg]"></div>
            <!-- Diagonal Pill Dark Green -->
            <div class="absolute -bottom-16 left-12 w-72 h-14 bg-[#4d7c0f]/40 rounded-full transform -rotate-[28deg]"></div>

            <!-- 3. POJOK KANAN ATAS -->
            <!-- Diagonal Pills Cluster Right Top -->
            <div class="absolute -top-6 -right-8 w-80 h-14 bg-[#4d7c0f]/35 rounded-full transform -rotate-[28deg]"></div>
            <div class="absolute top-6 -right-4 w-72 h-12 bg-[#bef264]/50 rounded-full transform -rotate-[28deg]"></div>
            <div class="absolute top-16 right-4 w-60 h-10 bg-[#a3e635]/40 rounded-full transform -rotate-[28deg]"></div>
            <!-- Outline Circle Top Right -->
            <div class="absolute top-6 right-72 w-6 h-6 rounded-full border-2 border-[#65a30d]/50"></div>

            <!-- 4. POJOK KANAN BAWAH -->
            <!-- Small Solid Circle -->
            <div class="absolute bottom-28 right-60 w-3 h-3 bg-[#65a30d]/50 rounded-full"></div>
            <!-- Diagonal Accent Line -->
            <div class="absolute bottom-20 right-16 w-32 h-1.5 bg-emerald-900/60 rounded-full transform -rotate-[28deg]"></div>
            <!-- Outline Circle Bottom Right -->
            <div class="absolute bottom-8 right-80 w-5 h-5 rounded-full border-2 border-[#65a30d]/50"></div>
            <!-- Dotted Grid Kanan Bawah -->
            <div class="absolute bottom-12 right-28 w-24 h-10 dot-pattern opacity-50"></div>
            <!-- Organic Wave Line Bottom Right -->
            <svg class="absolute -bottom-2 -right-4 w-40 h-20 stroke-emerald-900/50 fill-none" viewBox="0 0 100 50" stroke-width="2">
                <path d="M0,40 Q30,10 60,35 T100,10" />
            </svg>
            <!-- Blob Bottom Right -->
            <div class="absolute -bottom-12 -right-8 w-48 h-24 bg-[#a3e635]/30 rounded-full transform rotate-12 blur-sm"></div>

        </div>

        <!-- ========================================================= -->
        <!-- KONTEN UTAMA TEKS BANNER (BERADA DI ATAS VECTOR BG)        -->
        <!-- ========================================================= -->
        <div class="relative z-10 max-w-3xl space-y-3 sm:space-y-4">
            
            <!-- Judul Utama -->
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-black tracking-tight text-gray-950 font-heading uppercase leading-tight">
                JADWAL KEGIATAN BULAN INI
            </h1>

            <!-- Garis Pembatas Akses Hijau -->
            <div class="flex items-center gap-1.5 py-0.5">
                <div class="h-1 w-2 bg-emerald-600/50 rounded-full"></div>
                <div class="h-1 w-12 sm:w-16 bg-gradient-to-r from-emerald-600 via-emerald-800 to-emerald-600 rounded-full"></div>
                <div class="h-1 w-2 bg-emerald-600/50 rounded-full"></div>
            </div>

            <!-- Deskripsi Sub-Judul -->
            <p class="text-xs sm:text-sm md:text-base text-emerald-950 leading-relaxed font-semibold max-w-2xl">
                Informasi lengkap mengenai jadwal majelis taklim, pengajian selapanan, dan agenda kegiatan Nahdlatul Ulama Ranting Kedungurang bulan ini.
            </p>
            
        </div>

    </section>
    
    <!-- SECTION DAFTAR JADWAL KEGIATAN -->
    <section id="kegiatan" class="max-w-4xl mx-auto px-4 sm:px-6 py-10 w-full flex-grow reveal-on-scroll">

        @php
            $kegiatanList = $kegiatan ?? $kegiatans ?? $data ?? [];
        @endphp

        <!-- LIST JADWAL DENGAN BADGE KATEGORI DI DALAM KARTU -->
        <div class="space-y-4">
            
            @forelse ($kegiatanList as $item)
                @php
                    $tanggal = \Carbon\Carbon::parse($item->tanggal ?? $item->created_at);
                @endphp

                <div class="bg-white rounded-2xl p-5 sm:p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5 group">
                    
                    <!-- Kiri: Kotak Tanggal & Informasi Utama -->
                    <div class="flex items-center gap-4">
                        <!-- Kotak Tanggal Ala Kalender -->
                        <div class="w-16 h-16 rounded-2xl bg-emerald-50 border border-emerald-100 flex flex-col items-center justify-center text-nu shrink-0 shadow-inner">
                            <span class="text-xs font-bold uppercase tracking-wider">{{ $tanggal->format('M') }}</span>
                            <span class="text-xl font-black leading-tight">{{ $tanggal->format('d') }}</span>
                        </div>

                        <!-- Badge Jenis Kegiatan, Judul, Waktu, & Lokasi -->
                        <div class="space-y-1.5">
                            <!-- BADGE JENIS/KATEGORI KEGIATAN DIKEMBALIKAN -->
                            <div>
                                <span class="inline-block px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-emerald-100 text-emerald-800 uppercase tracking-wide">
                                    {{ $item->kategori ?? 'Kegiatan' }}
                                </span>
                            </div>

                            <h3 class="text-base sm:text-lg font-black text-gray-900 group-hover:text-nu transition-colors">
                                {{ $item->judul }}
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

                    <!-- Kanan: Tombol Aksi / Opsi Admin -->
                    <div class="w-full sm:w-auto flex items-center justify-end gap-2 pt-3 sm:pt-0 border-t sm:border-t-0 border-gray-100">
                        <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-gray-50 text-gray-700 font-bold text-xs border border-gray-200 group-hover:bg-nu group-hover:text-white group-hover:border-nu transition-all duration-300">
                            <span>Hadir</span>
                            <i class="fa-solid fa-check text-[10px]"></i>
                        </span>

                        @auth
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
                        @endauth
                    </div>

                </div>
            @empty
                <div class="bg-white p-12 rounded-3xl text-center border border-gray-100 shadow-sm">
                    <i class="fa-solid fa-calendar-xmark text-5xl text-emerald-200 mb-3"></i>
                    <p class="text-base font-semibold text-gray-500">Belum ada jadwal kegiatan untuk bulan ini.</p>
                </div>
            @endforelse

        </div>
    </section>

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