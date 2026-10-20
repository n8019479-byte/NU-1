<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - NU Ranting Kedungurang</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: { extend: { colors: { nu: { DEFAULT: '#006837', dark: '#004d28' } } } }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans text-gray-800 antialiased min-h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-md rounded-3xl p-8 shadow-xl border border-gray-100 space-y-6">
        
        <div class="text-center space-y-2">
            <div class="w-12 h-12 bg-nu rounded-2xl mx-auto flex items-center justify-center text-white shadow-md">
                <img src="{{ asset('images/logo-nu.png') }}" alt="Logo NU" class="w-8 h-8 object-contain">
            </div>
            <h1 class="text-xl font-black text-gray-900 tracking-tight">Login Admin NU</h1>
            <p class="text-xs text-gray-500">Masukkan kredensial yang valid untuk mengelola portal.</p>
        </div>

        <!-- PESAN ERROR GAGAL LOGIN -->
        @if($errors->any())
            <div class="bg-rose-50 border-l-4 border-rose-500 text-rose-700 p-3.5 rounded-xl text-xs font-bold">
                <i class="fa-solid fa-circle-exclamation mr-1.5"></i> Email atau password salah.
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4 text-xs" autocomplete="off">
            @csrf

            <!-- EMAIL (DIKOSONGKAN & NONAKTIFKAN AUTOFILL) -->
            <div class="space-y-1">
                <label class="block font-bold text-gray-700">Email Admin</label>
                <input type="email" name="email" value="" required autocomplete="off" readonly onfocus="this.removeAttribute('readonly');"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-nu text-sm bg-gray-50/50" 
                       placeholder="Masukan Email Anda">
            </div>

            <!-- PASSWORD (DIKOSONGKAN & NONAKTIFKAN AUTOFILL) -->
            <div class="space-y-1">
                <label class="block font-bold text-gray-700">Password</label>
                <input type="password" name="password" value="" required autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly');"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-nu text-sm bg-gray-50/50" 
                       placeholder="••••••••">
            </div>

            <button type="submit" class="w-full py-3.5 bg-nu hover:bg-nu-dark text-white rounded-xl font-bold text-sm shadow-md transition-all mt-2">
                Masuk Sistem
            </button>
        </form>

        <div class="text-center pt-2">
            <a href="{{ route('berita.index') }}" class="text-xs text-gray-500 hover:text-nu font-bold transition-all">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Beranda Utama
            </a>
        </div>

    </div>

</body>
</html>