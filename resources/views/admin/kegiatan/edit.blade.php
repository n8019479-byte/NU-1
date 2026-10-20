<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Kegiatan - Admin NU</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { nu: { DEFAULT: '#006837', dark: '#004d28' } }
                }
            }
        }
    </script>
</head>
<body class="bg-[#FAF7F0] font-sans text-gray-800 antialiased min-h-screen flex flex-col justify-between">

    <!-- NAVBAR SEDERHANA ADMIN -->
    <header class="bg-nu text-white shadow-md py-4 px-6">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <span class="font-extrabold text-sm sm:text-base tracking-tight">Panel Admin - Edit Jadwal Kegiatan</span>
            <a href="{{ route('kegiatan.index') }}" class="text-xs bg-white/10 hover:bg-white/20 px-4 py-2 rounded-xl transition-all font-bold">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>
    </header>

    <!-- KONTEN FORM EDIT -->
    <main class="max-w-2xl mx-auto px-4 py-10 w-full">
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-gray-100 space-y-6">
            
            <div class="border-b border-gray-100 pb-4">
                <h1 class="text-xl font-black text-gray-900">Form Edit Jadwal Kegiatan</h1>
                <p class="text-xs text-gray-500 mt-0.5">Perbarui informasi tanggal, waktu, atau lokasi kegiatan di bawah ini.</p>
            </div>

            <form action="{{ url('/kegiatan/' . $kegiatan->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Judul Kegiatan -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Nama / Judul Kegiatan</label>
                    <input type="text" name="judul" value="{{ old('judul', $kegiatan->judul) }}" required 
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-nu">
                </div>

                <!-- Kategori Kegiatan -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Kategori</label>
                    <select name="kategori" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-nu bg-white">
                        <option value="Pengajian" {{ $kegiatan->kategori == 'Pengajian' ? 'selected' : '' }}>Pengajian</option>
                        <option value="Hadroh & Shalawat" {{ $kegiatan->kategori == 'Hadroh & Shalawat' ? 'selected' : '' }}>Hadroh & Shalawat</option>
                        <option value="Peringatan Harlah" {{ $kegiatan->kategori == 'Peringatan Harlah' ? 'selected' : '' }}>Peringatan Harlah</option>
                        <option value="Musyawarah" {{ $kegiatan->kategori == 'Musyawarah' ? 'selected' : '' }}>Musyawarah</option>
                    </select>
                </div>

                <!-- Tanggal & Waktu -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', $kegiatan->tanggal) }}" required 
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-nu">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Waktu / Jam</label>
                        <input type="text" name="waktu" value="{{ old('waktu', $kegiatan->waktu) }}" placeholder="Contoh: 19:30 WIB - Selesai" required 
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-nu">
                    </div>
                </div>

                <!-- Lokasi -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Lokasi Tempat</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $kegiatan->lokasi) }}" required 
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-nu">
                </div>

                <!-- Deskripsi (Opsional) -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Keterangan / Deskripsi Singkat</label>
                    <textarea name="deskripsi" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-nu">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                </div>

                <!-- Tombol Aksi -->
                <div class="pt-4 flex items-center justify-end gap-3">
                    <a href="{{ route('kegiatan.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-gray-100 hover:bg-gray-200 text-gray-700 transition-all">Batal</a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold bg-nu hover:bg-nu-dark text-white shadow-md transition-all">Simpan Perubahan</button>
                </div>

            </form>
        </div>
    </main>

    @include('layouts.footer')
</body>
</html>