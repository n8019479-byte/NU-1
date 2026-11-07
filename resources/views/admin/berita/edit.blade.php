<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita - Admin Panel NU Kedungurang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased min-h-screen flex flex-col">

    <!-- NAVBAR ADMIN -->
    <header class="bg-emerald-900 text-white py-4 px-6 shadow-md">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <h1 class="font-black text-lg">Edit Berita & Warta</h1>
            <a href="{{ route('admin.dashboard') }}" class="text-xs bg-white/10 hover:bg-white/20 px-3 py-1.5 rounded-lg transition font-bold">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </header>

    <!-- KONTEN UTAMA -->
    <main class="max-w-3xl mx-auto w-full p-6 my-8">
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-emerald-100 shadow-xl space-y-6">
            
            <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Judul Berita</label>
                    <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" required
                        class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-3 bg-gray-50">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Kategori</label>
                        <select name="kategori" required
                            class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-3 bg-gray-50">
                            <option value="BERITA" {{ $berita->kategori == 'BERITA' ? 'selected' : '' }}>BERITA</option>
                            <option value="PENGUMUMAN" {{ $berita->kategori == 'PENGUMUMAN' ? 'selected' : '' }}>PENGUMUMAN</option>
                            <option value="KEGIATAN" {{ $berita->kategori == 'KEGIATAN' ? 'selected' : '' }}>KEGIATAN</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Ganti Gambar (Opsional)</label>
                        <input type="file" name="gambar"
                            class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    </div>
                </div>

                @if($berita->gambar)
                    <div>
                        <span class="block text-xs font-bold text-gray-700 mb-1">Gambar Saat Ini:</span>
                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-32 h-20 object-cover rounded-xl border shadow-sm">
                    </div>
                @endif

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Konten / Isi Berita</label>
                    <textarea name="konten" rows="6" required
                        class="w-full text-xs rounded-xl border-gray-200 focus:border-emerald-600 focus:ring-emerald-600 p-3 bg-gray-50">{{ old('konten', $berita->konten) }}</textarea>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="flex-1 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-md transition-all">
                        Simpan Perubahan Berita
                    </button>
                    <a href="{{ route('admin.dashboard') }}"
                        class="px-5 py-3 rounded-xl bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold text-xs text-center transition-all">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </main>

</body>
</html>