<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Internal | {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.05) 0px, transparent 50%), 
                radial-gradient(at 100% 0%, rgba(245, 158, 11, 0.05) 0px, transparent 50%);
        }
        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        .text-gradient {
            background: linear-gradient(to r, #059669, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="min-h-screen text-slate-900 overflow-x-hidden">

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 px-6 py-4">
        <div class="max-w-7xl mx-auto glass rounded-2xl px-6 py-3 shadow-sm flex justify-between items-center border border-slate-200/50">
            <div class="flex items-center space-x-3">
                <div class="bg-gradient-to-br from-emerald-500 to-emerald-700 p-2 rounded-xl shadow-lg shadow-emerald-200">
                    <i class="fas fa-kaaba text-white text-xl"></i>
                </div>
                <div>
                    <span class="text-base font-extrabold text-slate-800 tracking-tight block leading-none">{{ config('app.name') }}</span>
                    <span class="text-[10px] text-emerald-600 font-bold uppercase tracking-[0.1em]">Biro Umroh & Haji</span>
                </div>
            </div>
            
            <div class="hidden md:flex items-center space-x-8 text-sm font-bold text-slate-600">
                <a href="#paket" class="hover:text-emerald-600 transition">Program Paket</a>
                <a href="#fitur" class="hover:text-emerald-600 transition">Fitur Sistem</a>
                <a href="#alur" class="hover:text-emerald-600 transition">Alur Kerja</a>
            </div>

            <div class="flex items-center space-x-3">
                <a href="{{ route('login') }}" class="px-5 py-2.5 text-sm font-bold text-white bg-slate-900 rounded-xl hover:bg-slate-800 transition shadow-lg shadow-slate-200">
                    Masuk Portal
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="pt-32 pb-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-16 items-center mb-32">
                <div>
                    <div class="inline-flex items-center space-x-2 px-3 py-1 bg-emerald-50 rounded-full mb-6 border border-emerald-100">
                        <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-[10px] font-black text-emerald-700 uppercase tracking-widest">Sistem Manajemen Terpadu</span>
                    </div>
                    <h1 class="text-5xl md:text-7xl font-black text-slate-900 leading-[1.1] mb-6">
                        Digitalkan Layanan <br>
                        <span class="text-gradient">Baitullah Anda.</span>
                    </h1>
                    <p class="text-lg text-slate-500 mb-10 leading-relaxed max-w-md">
                        Platform internal untuk pengelolaan jamaah, inventaris logistik, dan administrasi dokumen umroh secara real-time dan aman.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-black rounded-2xl shadow-xl shadow-emerald-100 transition transform hover:-translate-y-1">
                            Daftar Akun Staf
                        </a>
                        <a href="#paket" class="px-8 py-4 bg-white border border-slate-200 text-slate-700 font-bold rounded-2xl hover:bg-slate-50 transition shadow-sm">
                            Lihat Paket
                        </a>
                    </div>
                </div>

                <!-- Dashboard Preview -->
                <div class="relative">
                    <div class="absolute -inset-10 bg-emerald-400/10 blur-[100px] rounded-full"></div>
                    <div class="relative bg-white border border-slate-200 rounded-[2.5rem] shadow-2xl overflow-hidden p-3 transition-transform hover:scale-[1.02] duration-500">
                        <div class="bg-slate-50 rounded-[2rem] p-8 border border-slate-100">
                            <div class="flex justify-between items-center mb-10">
                                <div class="flex space-x-2">
                                    <div class="h-3 w-3 bg-red-400 rounded-full"></div>
                                    <div class="h-3 w-3 bg-amber-400 rounded-full"></div>
                                    <div class="h-3 w-3 bg-emerald-400 rounded-full"></div>
                                </div>
                                <div class="h-8 w-32 bg-slate-200 rounded-full"></div>
                            </div>
                            <div class="grid grid-cols-2 gap-6 mb-6">
                                <div class="h-24 bg-white rounded-3xl border border-slate-200 p-5 shadow-sm">
                                    <div class="h-2 w-16 bg-emerald-100 rounded mb-3"></div>
                                    <div class="h-6 w-10 bg-emerald-500 rounded-lg"></div>
                                </div>
                                <div class="h-24 bg-white rounded-3xl border border-slate-200 p-5 shadow-sm">
                                    <div class="h-2 w-16 bg-amber-100 rounded mb-3"></div>
                                    <div class="h-6 w-10 bg-amber-500 rounded-lg"></div>
                                </div>
                            </div>
                            <div class="h-40 bg-white rounded-3xl border border-slate-200 p-6 flex flex-col justify-end">
                                <div class="h-2 w-full bg-slate-100 rounded mb-2"></div>
                                <div class="h-2 w-2/3 bg-slate-100 rounded mb-2"></div>
                                <div class="h-2 w-1/2 bg-slate-100 rounded"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Program Paket Section -->
            <section id="paket" class="mb-32">
                <div class="text-center mb-16">
                    <h2 class="text-xs font-black text-emerald-600 uppercase tracking-[0.3em] mb-4">Pilihan Program</h2>
                    <h3 class="text-4xl font-black text-slate-900">Program Paket Umroh</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Paket 1 -->
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm transition hover:shadow-xl group">
                        <div class="w-full h-48 bg-slate-100 rounded-3xl mb-6 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1564769662533-4f00a87b4056?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Umroh Regular">
                        </div>
                        <h4 class="text-xl font-black mb-2">Umroh Regular 9 Hari</h4>
                        <p class="text-sm text-slate-500 mb-6">Hotel Bintang 4 | Pesawat Saudi Airlines | Full Ibadah</p>
                        <div class="flex items-center justify-between mb-8">
                            <span class="text-2xl font-black text-emerald-600">Rp 28.5jt</span>
                            <span class="text-[10px] font-bold px-2 py-1 bg-slate-100 rounded uppercase text-slate-400 font-mono">ID: REG-09</span>
                        </div>
                        <a href="{{ route('login') }}" class="block w-full py-4 text-center bg-slate-50 text-slate-600 font-bold rounded-2xl hover:bg-emerald-600 hover:text-white transition-all">
                            <i class="fas fa-lock mr-2 opacity-50 text-xs"></i> Pesan Sekarang
                        </a>
                    </div>

                    <!-- Paket 2 -->
                    <div class="bg-white p-8 rounded-[2.5rem] border-2 border-emerald-500 shadow-emerald-100 shadow-2xl relative group">
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-emerald-500 text-white text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest">Rekomendasi</div>
                        <div class="w-full h-48 bg-emerald-50 rounded-3xl mb-6 overflow-hidden text-emerald-500 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Umroh Plus">
                        </div>
                        <h4 class="text-xl font-black mb-2">Umroh Plus Turki</h4>
                        <p class="text-sm text-slate-500 mb-6">Hotel Bintang 5 | Wisata Istanbul | Makan 3x Sehari</p>
                        <div class="flex items-center justify-between mb-8">
                            <span class="text-2xl font-black text-emerald-600">Rp 36.9jt</span>
                            <span class="text-[10px] font-bold px-2 py-1 bg-emerald-50 rounded uppercase text-emerald-400 font-mono">ID: PLS-TR</span>
                        </div>
                        <a href="{{ route('login') }}" class="block w-full py-4 text-center bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 transition shadow-lg">
                             Pesan Sekarang
                        </a>
                    </div>

                    <!-- Paket 3 -->
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm transition hover:shadow-xl group">
                        <div class="w-full h-48 bg-slate-100 rounded-3xl mb-6 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Umroh Ramadhan">
                        </div>
                        <h4 class="text-xl font-black mb-2">Umroh Ramadhan</h4>
                        <p class="text-sm text-slate-500 mb-6">Iktikaf 10 Hari Akhir | Umroh Full Ramadhan</p>
                        <div class="flex items-center justify-between mb-8">
                            <span class="text-2xl font-black text-emerald-600">Rp 45.0jt</span>
                            <span class="text-[10px] font-bold px-2 py-1 bg-slate-100 rounded uppercase text-slate-400 font-mono">ID: RAM-30</span>
                        </div>
                        <a href="{{ route('login') }}" class="block w-full py-4 text-center bg-slate-50 text-slate-600 font-bold rounded-2xl hover:bg-emerald-600 hover:text-white transition-all">
                            <i class="fas fa-lock mr-2 opacity-50 text-xs"></i> Pesan Sekarang
                        </a>
                    </div>
                </div>
            </section>

            <!-- Fitur Section (Stockify Elements Adjusted) -->
            <section id="fitur" class="mb-32">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-10 bg-emerald-900 rounded-[2.5rem] text-white shadow-2xl relative overflow-hidden group">
                        <div class="relative z-10">
                            <div class="w-12 h-12 bg-emerald-500/20 rounded-2xl flex items-center justify-center mb-8 border border-emerald-500/30">
                                <i class="fas fa-box-open text-emerald-400"></i>
                            </div>
                            <h3 class="text-xl font-black mb-4 uppercase tracking-tighter">Logistik Perlengkapan</h3>
                            <p class="text-emerald-100 text-sm leading-relaxed mb-6 opacity-70">Kelola stok koper, kain ihram, seragam batik, dan atribut jamaah dengan sistem mutasi otomatis.</p>
                            <a href="{{ route('login') }}" class="text-xs font-black text-emerald-400 uppercase tracking-widest flex items-center group-hover:translate-x-2 transition">Akses Modul <i class="fas fa-arrow-right ml-2"></i></a>
                        </div>
                        <i class="fas fa-box-open absolute -right-4 -bottom-4 text-white/5 text-9xl"></i>
                    </div>

                    <div class="p-10 bg-white rounded-[2.5rem] border border-slate-200 shadow-sm relative overflow-hidden group">
                        <div class="relative z-10">
                            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mb-8 border border-blue-100">
                                <i class="fas fa-passport text-blue-600"></i>
                            </div>
                            <h3 class="text-xl font-black mb-4 uppercase tracking-tighter">Manajemen Berkas</h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-6">Database aman untuk arsip paspor, visa, dan sertifikat vaksin jamaah yang terintegrasi ke manifes grup.</p>
                            <a href="{{ route('login') }}" class="text-xs font-black text-blue-600 uppercase tracking-widest flex items-center group-hover:translate-x-2 transition">Akses Modul <i class="fas fa-arrow-right ml-2"></i></a>
                        </div>
                        <i class="fas fa-passport absolute -right-4 -bottom-4 text-slate-100/50 text-9xl"></i>
                    </div>

                    <div class="p-10 bg-white rounded-[2.5rem] border border-slate-200 shadow-sm relative overflow-hidden group">
                        <div class="relative z-10">
                            <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center mb-8 border border-amber-100">
                                <i class="fas fa-file-invoice text-amber-600"></i>
                            </div>
                            <h3 class="text-xl font-black mb-4 uppercase tracking-tighter">Laporan Mutasi</h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-6">Generate laporan pendaftaran jamaah masuk dan keluar per periode pemberangkatan dengan satu klik.</p>
                            <a href="{{ route('login') }}" class="text-xs font-black text-amber-600 uppercase tracking-widest flex items-center group-hover:translate-x-2 transition">Akses Modul <i class="fas fa-arrow-right ml-2"></i></a>
                        </div>
                        <i class="fas fa-file-invoice absolute -right-4 -bottom-4 text-slate-100/50 text-9xl"></i>
                    </div>
                </div>
            </section>

            <!-- Alur Kerja Section -->
            <section id="alur" class="mb-32">
                <div class="bg-white p-12 rounded-[3rem] shadow-sm border border-slate-100">
                    <div class="flex flex-col lg:flex-row gap-12">
                        <div class="lg:w-1/3">
                            <h2 class="text-xs font-black text-emerald-600 uppercase tracking-[0.3em] mb-4">Sistem Operasional</h2>
                            <h3 class="text-3xl font-black text-slate-900 mb-6">Bagaimana Kami <br> Bekerja Secara Efisien</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">Sistem kami memastikan setiap langkah pendaftaran hingga keberangkatan tercatat dan terpantau dengan standar akreditasi tinggi.</p>
                        </div>
                        <div class="lg:w-2/3 grid sm:grid-cols-2 gap-8">
                            <div class="flex space-x-4">
                                <span class="text-4xl font-black text-emerald-100">01</span>
                                <div>
                                    <h4 class="font-black text-slate-800 uppercase tracking-tighter">Pendaftaran</h4>
                                    <p class="text-xs text-slate-500 mt-1">Input data jamaah oleh agen melalui portal registrasi internal.</p>
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <span class="text-4xl font-black text-emerald-100">02</span>
                                <div>
                                    <h4 class="font-black text-slate-800 uppercase tracking-tighter">Verifikasi</h4>
                                    <p class="text-xs text-slate-500 mt-1">Audit dokumen dan kelengkapan administrasi oleh Manajer Operasional.</p>
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <span class="text-4xl font-black text-emerald-100">03</span>
                                <div>
                                    <h4 class="font-black text-slate-800 uppercase tracking-tighter">Distribusi</h4>
                                    <p class="text-xs text-slate-500 mt-1">Penyerahan perlengkapan umroh dan pencatatan inventaris keluar.</p>
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <span class="text-4xl font-black text-emerald-100">04</span>
                                <div>
                                    <h4 class="font-black text-slate-800 uppercase tracking-tighter">Keberangkatan</h4>
                                    <p class="text-xs text-slate-500 mt-1">Monitoring keberangkatan jamaah menuju Tanah Suci (Flight Manifest).</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </main>

    <!-- Footer -->
    <footer class="py-16 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-12 mb-16">
            <div class="col-span-2">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="bg-emerald-600 p-2 rounded-xl shadow-lg">
                        <i class="fas fa-kaaba text-white"></i>
                    </div>
                    <span class="text-xl font-black tracking-tighter">{{ config('app.name') }}</span>
                </div>
                <p class="text-sm text-slate-400 max-w-sm leading-relaxed">
                    Sistem Penyelenggara Perjalanan Ibadah Umroh (PPIU) Resmi. Berkomitmen dalam melayani sepenuh hati dengan dukungan teknologi terkini.
                </p>
            </div>
            <div>
                <h5 class="text-[10px] font-black text-slate-900 uppercase tracking-widest mb-6 italic">Navigasi Portal</h5>
                <ul class="space-y-4 text-sm font-bold text-slate-500">
                    <li><a href="{{ route('login') }}" class="hover:text-emerald-600">Manajemen Stok</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-emerald-600">Daftar Manifest</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-emerald-600">Laporan Transaksi</a></li>
                </ul>
            </div>
            <div>
                <h5 class="text-[10px] font-black text-slate-900 uppercase tracking-widest mb-6 italic">Akun Staf</h5>
                <ul class="space-y-4 text-sm font-bold text-slate-500">
                    <li><a href="{{ route('login') }}" class="hover:text-emerald-600 transition flex items-center"><i class="fas fa-user-circle mr-2 text-xs opacity-50"></i> Login Admin</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-emerald-600 transition flex items-center"><i class="fas fa-id-badge mr-2 text-xs opacity-50"></i> Registrasi Biro</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 pt-12 border-t border-slate-100 flex flex-col md:row items-center justify-between gap-4">
            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                &copy; {{ date('Y') }} {{ config('app.name') }} | Berizin Resmi Kemenag RI
            </div>
            <div class="flex space-x-6">
                <i class="fab fa-instagram text-slate-300 hover:text-emerald-600 cursor-pointer transition"></i>
                <i class="fab fa-facebook text-slate-300 hover:text-emerald-600 cursor-pointer transition"></i>
                <i class="fab fa-whatsapp text-slate-300 hover:text-emerald-600 cursor-pointer transition"></i>
            </div>
        </div>
    </footer>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>