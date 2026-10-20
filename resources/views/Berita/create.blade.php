<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita - Fatayat NU</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        fatayat: {
                            DEFAULT: '#006837',
                            dark: '#004d28',
                            light: '#008748'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased min-h-screen flex flex-col">

    <!-- Header / Navbar -->
    <nav class="bg-fatayat text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-3">
                    <div class="bg-white text-fatayat p-2 rounded-full w-10 h-10 flex items-center justify-center font-bold shadow">
                        <i class="fa-solid fa-star text-amber-500"></i>
                    </div>
                    <span class="text-xl font-bold tracking-wide">PORTAL BERITA FATAYAT</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow max-w-3xl w-full mx-auto px-4 py-8">
        
        <!-- Card Container -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-emerald-50/60 border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                <h1 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-file-circle-plus text-fatayat"></i> Form Tambah Berita Fatayat
                </h1>
                <a href="{{ route('berita.index') }}" class="text-xs font-semibold text-gray-600 hover:text-fatayat flex items-center gap-1 transition-colors">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="p-6">
                <!-- Notifikasi Error Validasi -->
                @if ($errors->any())
                    <div class="mb-5 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm">
                        <p class="font-bold text-sm">Gagal Menyimpan Berita:</p>
                        <ul class="mt-1 list-disc list-inside text-xs">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Satu-satunya Tag Form yang Benar -->
                <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <!-- Judul Berita -->
                    <div>
                        <label for="judul" class="block text-sm font-semibold text-gray-700 mb-1">Judul Berita</label>
                        <input type="text" id="judul" name="judul" required value="{{ old('judul') }}" placeholder="Masukkan judul berita (contoh: Pengajian Rutin Fatayat NU Cabang...)"
                            class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-300 focus:ring-2 focus:ring-fatayat/20 focus:border-fatayat transition-all outline-none">
                    </div>

                    <!-- Grid 2 Kolom untuk Penulis dan Tanggal -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Penulis -->
                        <div>
                            <label for="penulis" class="block text-sm font-semibold text-gray-700 mb-1">Penulis / Redaksi</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <i class="fa-solid fa-user text-xs"></i>
                                </span>
                                <input type="text" id="penulis" name="penulis" required value="{{ old('penulis') }}" placeholder="Nama penulis"
                                    class="w-full pl-9 pr-4 py-2.5 text-sm rounded-lg border border-gray-300 focus:ring-2 focus:ring-fatayat/20 focus:border-fatayat transition-all outline-none">
                            </div>
                        </div>

                        <!-- Tanggal -->
                        <div>
                            <label for="tanggal" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Terbit</label>
                            <input type="date" id="tanggal" name="tanggal" required value="{{ old('tanggal', date('Y-m-d')) }}"
                                class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-300 focus:ring-2 focus:ring-fatayat/20 focus:border-fatayat transition-all outline-none">
                        </div>
                    </div>

                    <!-- Field Upload Gambar -->
                    <div>
                        <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-1">Gambar Berita</label>
                        <input type="file" id="gambar" name="gambar" accept="image/*" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                        <p class="text-xs text-gray-500 mt-1">*Format: JPG, PNG, WEBP. Maksimal 5MB.</p>
                    </div>

                    <!-- Isi Berita -->
                    <div>
                        <label for="isi" class="block text-sm font-semibold text-gray-700 mb-1">Isi Berita</label>
                        <textarea id="isi" name="isi" rows="6" required placeholder="Tuliskan berita secara lengkap di sini..."
                            class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-300 focus:ring-2 focus:ring-fatayat/20 focus:border-fatayat transition-all outline-none">{{ old('isi') }}</textarea>
                    </div>

                    <!-- Form Action Buttons -->
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                        <a href="{{ route('berita.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-fatayat hover:bg-fatayat-dark rounded-lg shadow-sm hover:shadow transition-all duration-200 flex items-center gap-2">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Berita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-4 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} Pimpinan Fatayat Nahdlatul Ulama.
        </div>
    </footer>

</body>
</html>