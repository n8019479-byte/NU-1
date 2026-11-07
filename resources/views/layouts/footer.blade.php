<!-- FOOTER PORTAL NU RANTING KEDUNGURANG -->
<footer class="w-full bg-gradient-to-b from-[#004d28] to-[#00381d] text-white relative overflow-hidden mt-16 pt-12 pb-6 border-t border-emerald-800/40">
    
    <!-- AKSEN DEKORATIF ELEGAN -->
    <div class="absolute -top-12 -right-12 w-48 h-48 bg-emerald-500/10 rounded-full blur-2xl pointer-events-none"></div>
    <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-amber-400/10 rounded-full blur-2xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 pb-10 border-b border-emerald-800/60">
            
            <!-- KOLOM 1: BRANDING & DESKRIPSI UTAMA -->
            <div class="md:col-span-5 space-y-4">
                <div class="flex items-center gap-3">
                    <div class=" backdrop-blur-md flex items-center justify-center  text-amber-300 shadow-sm">
                    </div>
                    <div>
                        <span class="text-xl font-black tracking-wide block leading-none text-white">NU Kedungurang</span>
                        <span class="text-[10px] font-bold text-emerald-200 tracking-widest uppercase mt-1 block">PORTAL BERITA & INFORMASI</span>
                    </div>
                </div>

                <p class="text-xs sm:text-sm text-emerald-100/80 leading-relaxed max-w-md font-normal">
                    <strong>Portal Resmi NU Ranting Kedungurang</strong> adalah platform digitalisasi informasi keagamaan, kemasyarakatan, dan keumatan Nahdlatul Ulama yang berperan sebagai pusat integrasi warta, agenda kegiatan, serta direktori keanggotaan warga Nahdliyin.
                </p>
            </div>

            <!-- KOLOM 2: NAVIGASI UTAMA -->
            <div class="md:col-span-2 space-y-3">
                <h4 class="text-sm font-black text-white tracking-wide uppercase">Navigasi</h4>
                <ul class="space-y-2 text-xs font-medium text-emerald-100/80">
                    <li><a href="{{ route('berita.index') }}" class="hover:text-amber-300 transition-colors">Beranda</a></li>
                    <li><a href="{{ route('organisasi.index') }}" class="hover:text-amber-300 transition-colors">Organisasi</a></li>
                    <li><a href="{{ route('kegiatan.index') }}" class="hover:text-amber-300 transition-colors">Kegiatan</a></li>
                    <li><a href="{{ route('anggota.index') }}" class="hover:text-amber-300 transition-colors">Anggota & KARTANU</a></li>
                </ul>
            </div>

            <!-- KOLOM 3: EKO-BANOM & BANOM -->
            <div class="md:col-span-2 space-y-3">
                <h4 class="text-sm font-black text-white tracking-wide uppercase">Badan Otonom</h4>
                <ul class="space-y-2 text-xs font-medium text-emerald-100/80">
                    <li><a href="#" class="hover:text-amber-300 transition-colors">Syuriah & Tanfidziyah</a></li>
                    <li><a href="#" class="hover:text-amber-300 transition-colors">Muslimat NU</a></li>
                    <li><a href="#" class="hover:text-amber-300 transition-colors">GP Ansor</a></li>
                    <li><a href="#" class="hover:text-amber-300 transition-colors">Fatayat NU</a></li>
                    <li><a href="#" class="hover:text-amber-300 transition-colors">IPNU & IPPNU</a></li>
                </ul>
            </div>

            <!-- KOLOM 4: SEKRETARIAT & KONTAK -->
            <div class="md:col-span-3 space-y-3">
                <h4 class="text-sm font-black text-white tracking-wide uppercase">Sekretariat Ranting</h4>
                
                <div class="space-y-2.5 text-xs text-emerald-100/80 leading-relaxed">
                    <p class="flex items-start gap-2">
                        <i class="fa-solid fa-location-dot text-amber-300 mt-0.5 shrink-0"></i>
                        <span>Gedung MWC / Secretariat PRNU Kedungurang, Kec. Gumelar, Kab. Banyumas, Jawa Tengah 53155</span>
                    </p>
                    
                    <p class="flex items-center gap-2">
                        <i class="fa-solid fa-phone text-amber-300 shrink-0"></i>
                        <span>+62 812-1560-6726</span>
                    </p>
                    
                    <p class="flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-amber-300 shrink-0"></i>
                        <span>ranting.kedungurang@nu.or.id</span>
                    </p>

                    <div class="pt-1 flex items-center gap-3 text-sm text-emerald-100">
                        <a href="#" class="w-8 h-8 rounded-xl bg-white/10 hover:bg-amber-400 hover:text-gray-950 flex items-center justify-center transition-all shadow-sm" title="Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-xl bg-white/10 hover:bg-amber-400 hover:text-gray-950 flex items-center justify-center transition-all shadow-sm" title="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-xl bg-white/10 hover:bg-amber-400 hover:text-gray-950 flex items-center justify-center transition-all shadow-sm" title="YouTube">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- BOTTOM BAR (COPYRIGHT & DOKUMEN) -->
        <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-medium text-emerald-200/70">
            <p>© Pengurus Ranting Nahdlatul Ulama Kedungurang {{ date('Y') }}. All rights reserved.</p>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-amber-300 transition-colors">Kebijakan Privasi</a>
                <span>•</span>
                <a href="#" class="hover:text-amber-300 transition-colors">Pemberitahuan PDP</a>
            </div>
        </div>
    </div>
</footer>