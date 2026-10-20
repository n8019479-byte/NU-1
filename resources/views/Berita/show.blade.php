<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }} - Nahdlatul Ulama</title>
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
                        nu: '#008752',
                        'nu-dark': '#00663e',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased">
    
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div>
                <a href="/" class="block">
                    <h1 class="text-xl font-black text-nu tracking-tight leading-none">NAHDLATUL ULAMA</h1>
                    <span class="text-[10px] font-bold text-gray-400 tracking-widest uppercase block mt-0.5">PORTAL BERITA & INFORMASI</span>
                </a>
            </div>

            <!-- NAVIGATION LINKS -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-gray-600">
                <a href="/" class="hover:text-nu transition-colors">Beranda</a>
                <a href="#" class="hover:text-nu transition-colors">Organisasi</a>
                <a href="#" class="hover:text-nu transition-colors">Acara</a>
                <a href="#" class="hover:text-nu transition-colors">Kegiatan</a>
                <a href="#" class="hover:text-nu transition-colors">Anggota</a>
            </nav>

            <!-- TOMBOL KEMBALI -->
            <div>
                <a href="javascript:history.back()" class="inline-flex items-center gap-2 text-xs font-bold text-gray-600 hover:text-nu bg-gray-100 hover:bg-emerald-50 px-4 py-2 rounded-xl transition-all">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </header>

    <!-- CONTENT WRAPPER -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <article class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 sm:p-10 space-y-8">
            
            <!-- HEADER BERITA -->
            <div class="space-y-4">
                @if(isset($berita->kategori))
                    <span class="inline-block bg-nu text-white text-xs font-extrabold uppercase tracking-wider px-3.5 py-1.5 rounded-lg shadow-sm">
                        {{ $berita->kategori }}
                    </span>
                @endif

                <h1 class="text-2xl sm:text-4xl font-black text-gray-900 leading-tight tracking-tight">
                    {{ $berita->judul }}
                </h1>

                <div class="flex items-center gap-4 text-xs font-medium text-gray-500 pt-2 border-b border-gray-100 pb-6">
                    <span class="flex items-center gap-1.5">
                        <i class="fa-regular fa-user text-nu"></i>
                        {{ $berita->user->name ?? $berita->penulis ?? 'Admin' }}
                    </span>
                    <span>&bull;</span>
                    <span class="flex items-center gap-1.5">
                        <i class="fa-regular fa-calendar text-nu"></i>
                        {{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }}
                    </span>
                </div>
            </div>

            <!-- GAMBAR UTAMA -->
            <div class="rounded-2xl overflow-hidden bg-emerald-50 border border-gray-100 shadow-inner">
                @if($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full max-h-[480px] object-cover">
                @else
                    <div class="h-64 flex flex-col items-center justify-center text-emerald-300">
                        <i class="fa-regular fa-image text-5xl mb-2"></i>
                        <span class="text-xs font-medium text-gray-400">Tidak ada gambar</span>
                    </div>
                @endif
            </div>

            <!-- ISI KONTEN BERITA -->
            <div class="prose max-w-none space-y-6 text-gray-700 text-base sm:text-lg leading-relaxed pt-2">
                @php
                    $isiBerita = $berita->konten ?? $berita->isi ?? $berita->deskripsi ?? '';
                @endphp

                @if(!empty($isiBerita))
                    <div class="p-5 bg-emerald-50/60 border-l-4 border-nu rounded-r-2xl text-gray-800 text-sm sm:text-base font-medium leading-relaxed italic">
                        {!! nl2br(e(str(strip_tags($isiBerita))->limit(200))) !!}
                    </div>

                    <div class="space-y-4 text-justify font-normal text-gray-800 leading-8">
                        {!! nl2br(e($isiBerita)) !!}
                    </div>
                @else
                    <div class="p-5 bg-amber-50 border-l-4 border-amber-400 rounded-r-2xl text-amber-800 text-sm font-medium">
                        Belum ada teks atau isi berita yang dimasukkan untuk artikel ini.
                    </div>
                @endif
            </div>

            <!-- FOOTER ARTIKEL -->
            <div class="pt-8 border-t border-gray-100 flex items-center justify-between">
                <span class="text-xs text-gray-400 font-medium">Bagikan berita ini:</span>
                <div class="flex items-center gap-2">
                    <a href="https://api.whatsapp.com/send?text={{ urlencode(url()->current()) }}" target="_blank" class="w-9 h-9 rounded-full bg-emerald-50 text-nu hover:bg-nu hover:text-white flex items-center justify-center transition-colors text-sm" title="Bagikan ke WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-9 h-9 rounded-full bg-emerald-50 text-nu hover:bg-nu hover:text-white flex items-center justify-center transition-colors text-sm" title="Bagikan ke Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                </div>
            </div>

        </article>

        <!-- SECTION KOMENTAR & TANGGAPAN (FIXED STATE FORM BALAS & LOCALSTORAGE) -->
<div class="max-w-4xl mx-auto py-8 mt-12 pt-8 border-t border-gray-100" 
     x-data="{ 
        likesCount: {{ $berita->likes_count ?? 12 }}, 
        hasLiked: false, 
        showSuccess: false,
        newNama: '',
        newIsi: '',
        komentarList: JSON.parse(localStorage.getItem('komentar_berita_{{ $berita->id }}')) || [],
        
        toggleLike() {
            if (!this.hasLiked) {
                this.likesCount++;
                this.hasLiked = true;
            } else {
                this.likesCount--;
                this.hasLiked = false;
            }
        },

        simpanStorage() {
            // Sebelum disimpan ke localStorage, kita paksa semua showBalasForm menjadi false 
            // agar saat direfresh form input balas tidak terbuka otomatis.
            let cleanData = this.komentarList.map(item => ({
                ...item,
                showBalasForm: false 
            }));
            localStorage.setItem('komentar_berita_{{ $berita->id }}', JSON.stringify(cleanData));
        },

        kirimTanggapan() {
            if (this.newNama.trim() === '' || this.newIsi.trim() === '') {
                alert('Nama dan isi tanggapan wajib diisi!');
                return;
            }

            this.komentarList.unshift({
                id: Date.now(),
                nama: this.newNama,
                isi: this.newIsi,
                waktu: 'Baru saja',
                inisial: this.newNama.charAt(0).toUpperCase(),
                balasan: [],
                showBalasForm: false,
                namaBalas: '',
                isiBalas: ''
            });

            this.simpanStorage();
            this.newNama = '';
            this.newIsi = '';

            this.showSuccess = true;
            setTimeout(() => { this.showSuccess = false; }, 3000);
        },

        kirimBalasan(index) {
            if (!this.komentarList[index].namaBalas.trim() || !this.komentarList[index].isiBalas.trim()) {
                alert('Nama dan isi balasan wajib diisi!');
                return;
            }

            // Masukkan balasan baru
            this.komentarList[index].balasan.push({
                nama: this.komentarList[index].namaBalas,
                isi: this.komentarList[index].isiBalas,
                waktu: 'Baru saja',
                inisial: this.komentarList[index].namaBalas.charAt(0).toUpperCase()
            });

            // Reset input balasan & tutup form otomatis
            this.komentarList[index].namaBalas = '';
            this.komentarList[index].isiBalas = '';
            this.komentarList[index].showBalasForm = false;

            // Simpan ke localStorage (dengan state form tertutup bersih)
            this.simpanStorage();
        }
     }">
            <!-- TOMBOL APRESIASI REAL-TIME -->
<div class="flex items-center gap-3">
    <button id="btnApresiasi" 
            onclick="kirimApresiasi({{ $berita->id }})" 
            class="flex items-center gap-2 px-4 py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl font-bold text-xs shadow-sm transition-all border border-rose-200 active:scale-95">
        <i class="fa-solid fa-heart text-rose-500" id="iconHeart"></i>
        <span>Apresiasi</span>
        <span id="countApresiasi" class="bg-rose-500 text-white px-2 py-0.5 rounded-full text-[10px] font-extrabold ml-1">
            {{ $berita->apresiasi ?? 0 }}
        </span>
    </button>
    <span class="text-xs text-gray-500 font-medium">Dukung dan berikan tanggapan untuk kabar ini</span>
</div>
<!-- SCRIPT AJAX APRESIASI PERMANEN -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const beritaId = {{ $berita->id }};
        const hasLiked = localStorage.getItem('apresiasi_berita_' + beritaId);
        
        // Jika user sudah pernah memberi apresiasi
        if (hasLiked) {
            setLikedState();
        }
    });

    function kirimApresiasi(beritaId) {
        const hasLiked = localStorage.getItem('apresiasi_berita_' + beritaId);
        
        if (hasLiked) {
            alert('Anda sudah memberikan apresiasi untuk berita ini.');
            return;
        }

        fetch(`/berita/${beritaId}/apresiasi`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update angka apresiasi di tampilan
                document.getElementById('countApresiasi').innerText = data.total;
                
                // Simpan status di browser/HP user agar tidak bisa spam klik
                localStorage.setItem('apresiasi_berita_' + beritaId, 'true');
                
                setLikedState();
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function setLikedState() {
        const btn = document.getElementById('btnApresiasi');
        const icon = document.getElementById('iconHeart');
        
        btn.classList.remove('bg-rose-50', 'hover:bg-rose-100', 'text-rose-600');
        btn.classList.add('bg-rose-500', 'text-white');
        icon.classList.remove('text-rose-500');
        icon.classList.add('text-white');
    }
</script>

    </main>

</body>
</html>