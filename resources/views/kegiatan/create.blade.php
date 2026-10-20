<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan - Admin NU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { nu: { DEFAULT: '#006837', dark: '#004d28' } } } }
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen py-10 flex items-center justify-center">

    <div class="max-w-xl w-full bg-white p-8 rounded-2xl shadow-md border border-gray-200">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Tambah Kegiatan Baru</h2>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 border-l-4 border-red-500 text-red-700 text-xs rounded">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Judul Kegiatan</label>
                <input type="text" name="judul" required placeholder="Contoh: Pengajian Akbar & Hadroh" class="w-full px-4 py-2 text-sm rounded-lg border border-gray-300 outline-none focus:ring-2 focus:ring-nu">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Kategori</label>
                <select name="kategori" required class="w-full px-4 py-2 text-sm rounded-lg border border-gray-300 outline-none focus:ring-2 focus:ring-nu">
                    <option value="Pengajian">Pengajian</option>
                    <option value="Hadroh & Seni">Hadroh & Seni</option>
                    <option value="Sosial Kemasyarakatan">Sosial Kemasyarakatan</option>
                    <option value="Kaderisasi">Kaderisasi</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Tanggal Pelaksanaan</label>
                <input type="date" name="tanggal" required class="w-full px-4 py-2 text-sm rounded-lg border border-gray-300 outline-none focus:ring-2 focus:ring-nu">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Foto Kegiatan</label>
                <input type="file" name="gambar" accept="image/*" required class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-nu file:text-white hover:file:bg-nu-dark">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="4" required placeholder="Jelaskan mengenai kegiatan ini..." class="w-full px-4 py-2 text-sm rounded-lg border border-gray-300 outline-none focus:ring-2 focus:ring-nu"></textarea>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('kegiatan.index') }}" class="px-4 py-2 rounded-lg text-xs font-bold text-gray-600 bg-gray-200 hover:bg-gray-300">Batal</a>
                <button type="submit" class="px-5 py-2 rounded-lg text-xs font-bold text-white bg-nu hover:bg-nu-dark">Simpan Kegiatan</button>
            </div>
        </form>
    </div>

</body>
</html>