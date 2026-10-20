<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal Kegiatan - Admin NU</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: { extend: { colors: { nu: { DEFAULT: '#006837', dark: '#004d28' } } } }
        }
    </script>
</head>
<body class="bg-[#FAF7F0] font-sans text-gray-800 antialiased min-h-screen flex flex-col justify-between">

    <header class="bg-nu text-white shadow-md py-4 px-6">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <span class="font-extrabold text-sm sm:text-base tracking-tight">Panel Admin - Tambah Jadwal Kegiatan</span>
            <a href="{{ route('admin.dashboard') }}" class="text-xs bg-white/10 hover:bg-white/20 px-4 py-2 rounded-xl transition-all font-bold">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </header>

    <main class="max-w-2xl mx-auto px-4 py-10 w-full">
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-gray-100 space-y-6">
            
            <div class="border-b border-gray-100 pb-4">
                <h1 class="text-xl font-black text-gray-900">Form Tambah Jadwal Kegiatan</h1>
                <p class="text-xs text-gray-500 mt-0.5">Masukkan detail kegiatan bulanan agar dapat dilihat oleh para jamaah.</p>
            </div>

            <form action="{{ route('kegiatan.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Nama / Judul Kegiatan</label>
                    <input type="text" name="judul" required placeholder="Contoh: Pengajian Selapanan Malam Jumat Pahing" 
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-nu">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Kategori</label>
                    <select name="kategori" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-nu bg-white">
                        <option value="Pengajian">Pengajian</option>
                        <option value="Hadroh & Shalawat">Hadroh & Shalawat</option>
                        <option value="Peringatan Harlah">Peringatan Harlah</option>
                        <option value="Musyawarah">Musyawarah</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal</label>
                        <input type="date" name="tanggal" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-nu">
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Waktu / Jam</label>
                        <input type="text" name="waktu" value="19:30 WIB - Selesai" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-nu">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Lokasi Tempat</label>
                    <input type="text" name="lokasi" value="Masjid / Kantor Ranting NU Kedungurang" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-nu">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Keterangan / Deskripsi Singkat</label>
                    <textarea name="deskripsi" rows="3" placeholder="Keterangan tambahan (opsional)..." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-nu"></textarea>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-gray-100 hover:bg-gray-200 text-gray-700 transition-all">Batal</a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold bg-nu hover:bg-nu-dark text-white shadow-md transition-all">Simpan Jadwal</button>
                </div>

            </form>
        </div>
    </main>

    @include('layouts.footer')
</body>
</html>