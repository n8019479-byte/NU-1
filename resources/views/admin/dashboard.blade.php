<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - NU Ranting Kedungurang</title>
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
                        nu: { DEFAULT: '#006837', dark: '#004d28', light: '#008748', accent: '#10b981' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans text-gray-800 antialiased min-h-screen flex flex-col"
      x-data="{ activeTab: 'berita', showTambahBeritaModal: false, showTambahKegiatanModal: false }">

    <!-- NAVBAR ADMIN -->
    <header class="sticky top-4 z-50 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
        <nav class="bg-white/90 backdrop-blur-md border border-gray-200/80 shadow-lg rounded-full px-6 py-3 transition-all duration-300">
            <div class="flex items-center justify-between">
                <a href="{{ route('berita.index') }}" class="flex items-center gap-3 group shrink-0">
                    <img src="{{ asset('images/logo-nu.png') }}" alt="Logo NU" class="h-9 w-auto object-contain">
                    <div class="flex flex-col">
                        <span class="text-lg font-black text-gray-900 tracking-tight leading-none">Admin Panel</span>
                        <span class="text-[9px] font-extrabold text-nu tracking-wider uppercase mt-0.5">NU Ranting Kedungurang</span>
                    </div>
                </a>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('berita.index') }}" class="text-xs font-bold text-gray-600 hover:text-nu px-3 py-1.5 rounded-full bg-gray-50 hover:bg-emerald-50 transition-all flex items-center gap-1.5">
                        <i class="fa-solid fa-globe"></i>
                        <span class="hidden sm:inline">Lihat Web</span>
                    </a>
                    <form action="{{ route('logout') ?? '#' }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-rose-500 hover:bg-rose-600 text-white px-4 py-2 rounded-full text-xs font-bold shadow-sm flex items-center gap-2 transition-all">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span class="hidden sm:inline">Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- NOTIFIKASI -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 pt-4 w-full">
            <div class="bg-emerald-100 border-l-4 border-emerald-600 text-emerald-800 p-4 rounded-xl shadow-sm text-xs font-bold">
                <i class="fa-solid fa-circle-check mr-2"></i>{{ session('success') }}
            </div>
        </div>
    @endif

    <!-- KONTEN UTAMA -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full space-y-8 flex-grow">

        <!-- TAB NAVIGASI -->
        <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm overflow-hidden">
            <div class="flex border-b border-gray-200 bg-gray-50/70 p-2 gap-2 overflow-x-auto">
                <button @click="activeTab = 'berita'" :class="activeTab === 'berita' ? 'bg-nu text-white shadow-sm' : 'text-gray-600 hover:bg-gray-200/60'" class="px-5 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 shrink-0">
                    <i class="fa-regular fa-newspaper"></i> Kelola Berita
                </button>
                <button @click="activeTab = 'kegiatan'" :class="activeTab === 'kegiatan' ? 'bg-nu text-white shadow-sm' : 'text-gray-600 hover:bg-gray-200/60'" class="px-5 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 shrink-0">
                    <i class="fa-solid fa-calendar-days"></i> Kelola Kegiatan
                </button>
                <button @click="activeTab = 'kartanu'" :class="activeTab === 'kartanu' ? 'bg-nu text-white shadow-sm' : 'text-gray-600 hover:bg-gray-200/60'" class="px-5 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 shrink-0">
                    <i class="fa-solid fa-id-card"></i> Verifikasi KARTANU
                </button>
            </div>

            <!-- TAB 1: KELOLA BERITA -->
            <div x-show="activeTab === 'berita'" class="p-6 space-y-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-base font-black text-gray-900">Daftar Berita & Warta</h3>
                        <p class="text-xs text-gray-500">Berita yang ditambahkan akan langsung muncul di halaman Beranda web.</p>
                    </div>
                    <button @click="showTambahBeritaModal = true" class="bg-nu hover:bg-nu-dark text-white px-4 py-2 rounded-xl text-xs font-bold shadow-sm flex items-center gap-2 transition-all">
                        <i class="fa-solid fa-plus"></i> Tambah Berita Baru
                    </button>
                </div>

                <div class="overflow-x-auto border border-gray-100 rounded-xl">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-gray-50 text-gray-700 font-bold uppercase border-b border-gray-100">
                            <tr>
                                <th class="p-3.5">Judul Berita</th>
                                <th class="p-3.5">Kategori</th>
                                <th class="p-3.5">Tanggal</th>
                                <th class="p-3.5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($beritas ?? [] as $item)
                                <tr class="hover:bg-gray-50/50">
                                    <td class="p-3.5 font-bold text-gray-900">{{ $item->judul }}</td>
                                    <td class="p-3.5"><span class="bg-emerald-100 text-emerald-800 px-2.5 py-0.5 rounded-md font-extrabold text-[10px]">{{ $item->kategori }}</span></td>
                                    <td class="p-3.5 text-gray-500">{{ $item->created_at->format('d M Y') }}</td>
                                    <td class="p-3.5 text-right">
                                        <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1 bg-rose-100 text-rose-800 hover:bg-rose-200 rounded-lg font-bold">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-6 text-center text-gray-400">Belum ada data berita. Silakan tambahkan berita baru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 2: KELOLA KEGIATAN (JADWAL) -->
            <div x-show="activeTab === 'kegiatan'" style="display: none;" class="p-6 space-y-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-base font-black text-gray-900">Daftar Jadwal Kegiatan Bulanan</h3>
                        <p class="text-xs text-gray-500">Kelola jadwal pengajian, hadroh, dan agenda ranting NU Kedungurang.</p>
                    </div>
                    <button @click="showTambahKegiatanModal = true" class="bg-nu hover:bg-nu-dark text-white px-4 py-2 rounded-xl text-xs font-bold shadow-sm flex items-center gap-2 transition-all">
                        <i class="fa-solid fa-plus"></i> Tambah Jadwal Baru
                    </button>
                </div>

                <div class="overflow-x-auto border border-gray-100 rounded-xl">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-gray-50 text-gray-700 font-bold uppercase border-b border-gray-100">
                            <tr>
                                <th class="p-3.5">Nama Kegiatan</th>
                                <th class="p-3.5">Kategori</th>
                                <th class="p-3.5">Tanggal & Waktu</th>
                                <th class="p-3.5">Lokasi</th>
                                <th class="p-3.5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($kegiatans ?? [] as $item)
                                <tr class="hover:bg-gray-50/50">
                                    <td class="p-3.5 font-bold text-gray-900">{{ $item->judul }}</td>
                                    <td class="p-3.5"><span class="bg-emerald-100 text-emerald-800 px-2.5 py-0.5 rounded-md font-extrabold text-[10px]">{{ $item->kategori }}</span></td>
                                    <td class="p-3.5 text-gray-600">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}<br>
                                        <span class="text-[10px] text-gray-400 font-medium">{{ $item->waktu }}</span>
                                    </td>
                                    <td class="p-3.5 text-gray-600">{{ $item->lokasi }}</td>
                                    <td class="p-3.5 text-right space-x-1">
                                        <a href="{{ url('/kegiatan/' . $item->id . '/edit') }}" class="px-2.5 py-1 bg-amber-100 text-amber-800 hover:bg-amber-200 rounded-lg font-bold inline-block">Edit</a>
                                        <form action="{{ url('/kegiatan/' . $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1 bg-rose-100 text-rose-800 hover:bg-rose-200 rounded-lg font-bold">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-gray-400">Belum ada jadwal kegiatan yang ditambahkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 3: VERIFIKASI KARTANU -->
            <div x-show="activeTab === 'kartanu'" style="display: none;" class="p-6 space-y-6">
                <div>
                    <h3 class="text-base font-black text-gray-900">Verifikasi Pengajuan KARTANU</h3>
                    <p class="text-xs text-gray-500">Setujui permohonan agar status kartu digital jamaah berubah menjadi terverifikasi.</p>
                </div>

                <div class="overflow-x-auto border border-gray-100 rounded-xl">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-gray-50 text-gray-700 font-bold uppercase border-b border-gray-100">
                            <tr>
                                <th class="p-3.5">Nama Jamaah</th>
                                <th class="p-3.5">NIA</th>
                                <th class="p-3.5">Banom</th>
                                <th class="p-3.5">Status</th>
                                <th class="p-3.5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($anggota ?? [] as $item)
                                <tr class="hover:bg-gray-50/50">
                                    <td class="p-3.5 font-bold text-gray-900">{{ $item->nama }}</td>
                                    <td class="p-3.5 font-mono font-bold text-nu">{{ $item->nia }}</td>
                                    <td class="p-3.5"><span class="bg-emerald-100 text-emerald-900 px-2 py-0.5 rounded text-[10px] font-bold">{{ $item->banom }}</span></td>
                                    <td class="p-3.5">
                                        <span class="px-2.5 py-0.5 rounded text-[9px] font-bold {{ $item->statusKartanu === 'Terverifikasi' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                            {{ $item->statusKartanu }}
                                        </span>
                                    </td>
                                    <td class="p-3.5 text-right">
                                        @if($item->statusKartanu !== 'Terverifikasi')
                                            <form action="{{ route('admin.kartanu.verifikasi', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-3 py-1 bg-nu text-white hover:bg-nu-dark rounded-lg font-bold shadow-sm">Setujui</button>
                                            </form>
                                        @else
                                            <span class="text-emerald-600 font-bold">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-gray-400">Belum ada data pengajuan KARTANU.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </main>

    <!-- MODAL TAMBAH BERITA -->
    <div x-show="showTambahBeritaModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" x-transition>
        <div class="bg-white w-full max-w-lg rounded-3xl p-6 space-y-4 shadow-2xl relative max-h-[90vh] overflow-y-auto">
            <button @click="showTambahBeritaModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 font-bold text-lg">&times;</button>
            <h3 class="text-lg font-black text-gray-900">Tambah Berita Baru</h3>
            
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-gray-700 mb-1">Judul Berita</label>
                    <input type="text" name="judul" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-nu" placeholder="Masukkan judul berita...">
                </div>
                <div>
                    <label class="block font-bold text-gray-700 mb-1">Kategori</label>
                    <select name="kategori" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-nu">
                        <option value="BERITA">BERITA</option>
                        <option value="PENGUMUMAN">PENGUMUMAN</option>
                        <option value="KEGIATAN">KEGIATAN</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-gray-700 mb-1">Upload Gambar Cover</label>
                    <input type="file" name="gambar" class="w-full px-3 py-2 border border-gray-200 rounded-xl bg-gray-50">
                </div>
                <div>
                    <label class="block font-bold text-gray-700 mb-1">Isi Konten Berita</label>
                    <textarea name="isi" rows="4" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-nu" placeholder="Tuliskan isi berita di sini..."></textarea>
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="showTambahBeritaModal = false" class="px-4 py-2 bg-gray-100 rounded-xl font-bold text-gray-600">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-nu text-white rounded-xl font-bold shadow-sm">Simpan Berita</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL TAMBAH KEGIATAN (JADWAL) -->
    <div x-show="showTambahKegiatanModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" x-transition>
        <div class="bg-white w-full max-w-lg rounded-3xl p-6 space-y-4 shadow-2xl relative max-h-[90vh] overflow-y-auto">
            <button @click="showTambahKegiatanModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 font-bold text-lg">&times;</button>
            <h3 class="text-lg font-black text-gray-900">Tambah Jadwal Kegiatan Baru</h3>
            
            <form action="{{ route('kegiatan.store') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-gray-700 mb-1">Nama / Judul Kegiatan</label>
                    <input type="text" name="judul" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-nu" placeholder="Contoh: Pengajian Selapanan Malam Jumat Pahing">
                </div>
                <div>
                    <label class="block font-bold text-gray-700 mb-1">Kategori</label>
                    <select name="kategori" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-nu bg-white">
                        <option value="Pengajian">Pengajian</option>
                        <option value="Hadroh & Shalawat">Hadroh & Shalawat</option>
                        <option value="Peringatan Harlah">Peringatan Harlah</option>
                        <option value="Musyawarah">Musyawarah</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-nu">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700 mb-1">Waktu / Jam</label>
                        <input type="text" name="waktu" value="19:30 WIB - Selesai" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-nu">
                    </div>
                </div>
               <div>
    <label class="block font-bold text-gray-700 mb-1">Lokasi Tempat</label>
    <input type="text" name="lokasi" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-nu" placeholder="Masukkan lokasi kegiatan (misal: Masjid Al-Huda Kedungurang)">
</div>
                <div>
                    <label class="block font-bold text-gray-700 mb-1">Deskripsi Singkat (Opsional)</label>
                    <textarea name="deskripsi" rows="3" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-nu" placeholder="Keterangan tambahan..."></textarea>
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="showTambahKegiatanModal = false" class="px-4 py-2 bg-gray-100 rounded-xl font-bold text-gray-600">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-nu text-white rounded-xl font-bold shadow-sm">Simpan Jadwal</button>
                </div>
            </form>
        </div>
    </div>
    <!-- TABEL PENDAFTAR MENUNGGU PERSETUJUAN (PENDING) -->
<div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 mb-8">
    <h3 class="text-base font-black text-gray-900 mb-4 flex items-center gap-2">
        <i class="fa-solid fa-clock text-amber-500"></i> Pendaftaran Menunggu Persetujuan ({{ $pendingJamaah->count() }})
    </h3>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-900 p-3 rounded-xl text-xs font-bold mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-gray-700">
            <thead class="bg-gray-50 text-gray-900 uppercase font-extrabold border-b border-gray-200">
                <tr>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Banom</th>
                    <th class="p-3">RT/RW</th>
                    <th class="p-3">Nomor KARTANU</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($pendingJamaah as $j)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 font-bold text-gray-900">{{ $j->nama }}</td>
                        <td class="p-3">{{ $j->email }}</td>
                        <td class="p-3"><span class="bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded font-bold">{{ $j->banom }}</span></td>
                        <td class="p-3">{{ $j->rt_rw }}</td>
                        <td class="p-3 font-mono font-bold text-amber-600">{{ $j->nomor_kartanu }}</td>
                        <td class="p-3 text-center">
                            <form action="{{ route('admin.jamaah.approve', $j->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-xl font-bold transition-all shadow-sm flex items-center gap-1 mx-auto">
                                    <i class="fa-solid fa-check"></i> Setujui
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-400 italic">Tidak ada pendaftaran baru yang menunggu persetujuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

    <footer class="w-full bg-white border-t border-gray-200 py-4 text-center text-xs text-gray-500 mt-auto">
        <p>© 2026 Admin Panel - Pengurus Ranting Nahdlatul Ulama Kedungurang.</p>
    </footer>

</body>
</html>