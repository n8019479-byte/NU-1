<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Foto Dokumentasi - Admin Panel NU Kedungurang</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased min-h-screen flex flex-col justify-between">

    <div class="max-w-xl mx-auto py-12 px-4 w-full mt-10">
        <div class="bg-white p-8 rounded-3xl shadow-md border border-gray-100 space-y-6">
            <div>
                <h1 class="text-xl font-black text-gray-900">Tambah Foto Dokumentasi Kegiatan</h1>
                <p class="text-xs text-gray-500 mt-0.5">Unggah dokumentasi foto kegiatan baru untuk ditampilkan di portal publik.</p>
            </div>

            <form action="{{ route('admin.dokumentasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Judul Kegiatan / Foto</label>
                    <input type="text" name="judul" required class="w-full text-xs px-4 py-2.5 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-600" placeholder="Contoh: Pengajian Rutin Selapanan Pahing">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Kategori</label>
                    <input type="text" name="kategori" class="w-full text-xs px-4 py-2.5 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-600" placeholder="Contoh: Pengajian Selapanan / Kerja Bakti">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">File Foto (Maks 2MB)</label>
                    <input type="file" name="foto" accept="image/*" required class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                </div>

                <div class="pt-2 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 text-xs font-bold hover:bg-gray-200">Batal</a>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-800 text-white text-xs font-bold shadow hover:bg-emerald-900">Simpan Foto</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer sederhana -->
    <footer class="text-center py-6 text-xs text-gray-500">
        <p>© Pengurus Ranting Nahdlatul Ulama Kedungurang</p>
    </footer>

</body>
</html>