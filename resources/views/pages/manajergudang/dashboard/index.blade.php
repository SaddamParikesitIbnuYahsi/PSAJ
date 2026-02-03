<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wujudkan Impian Umrah Anda | {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #ffffff; }
        .emerald-gradient { background: linear-gradient(135deg, #059669 0%, #10b981 100%); }
    </style>
</head>
<body class="text-slate-900 overflow-x-hidden">

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 bg-white border-b border-slate-100 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="bg-emerald-600 p-1.5 rounded-lg text-white">
                    <i class="fas fa-kaaba"></i>
                </div>
                <span class="text-lg font-black tracking-tighter uppercase">{{ config('app.name') }}</span>
            </div>
            
            <div class="hidden md:flex items-center space-x-8 text-sm font-bold text-slate-500 uppercase tracking-widest">
                <a href="#" class="text-emerald-600">Beranda</a>
                <a href="#paket" class="hover:text-emerald-600 transition">Paket</a>
                <a href="#fasilitas" class="hover:text-emerald-600 transition">Fasilitas</a>
                <a href="#testimoni" class="hover:text-emerald-600 transition">Testimoni</a>
                <a href="#" class="hover:text-emerald-600 transition">Kontak</a>
            </div>

            <!-- Bagian User & Logout -->
            <div class="flex items-center space-x-5 border-l pl-5 border-slate-200">
                <div class="text-right hidden sm:block">
                    <p class="text-[10px] font-black text-slate-400 uppercase leading-none mb-1">Jamaah Terdaftar</p>
                    <p class="text-sm font-black text-emerald-600">{{ auth()->user()->name }}</p>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-50 text-red-600 px-5 py-2.5 rounded-full text-[10px] font-black uppercase tracking-widest hover:bg-red-600 hover:text-white transition shadow-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-44 pb-20 px-6 bg-slate-50/30">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-black uppercase tracking-widest mb-6">
                    ✅ Agensi Terpercaya
                </span>
                <h1 class="text-5xl md:text-7xl font-black text-slate-900 leading-tight mb-8">
                    Wujudkan Impian <br> <span class="text-emerald-600">Umrah</span> Anda
                </h1>
                <p class="text-slate-500 text-lg mb-10 leading-relaxed max-w-md">
                    Nikmati pengalaman ibadah umrah yang nyaman dan khusyuk bersama kami. Paket lengkap dengan harga terjangkau dan pelayanan terbaik.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 max-w-lg">
                    <input type="email" placeholder="nama@gmail.com" class="px-6 py-4 bg-white border border-slate-200 rounded-full flex-1 focus:ring-2 focus:ring-emerald-500 font-medium shadow-sm text-sm">
                    <button class="px-8 py-4 bg-emerald-600 text-white font-bold rounded-full shadow-lg shadow-emerald-100 hover:bg-emerald-700 transition">
                        Konsultasi Gratis
                    </button>
                </div>
            </div>

            <!-- Hero Image Right -->
            <div class="relative">
                <div class="rounded-[3rem] overflow-hidden shadow-2xl relative z-10 border-[10px] border-white">
                    <img src="https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Makkah" class="w-full h-auto">
                </div>
                <!-- Badges -->
                <div class="absolute top-10 -left-12 bg-white p-4 rounded-2xl shadow-2xl z-20 flex items-center gap-3 border border-slate-50">
                    <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center"><i class="fas fa-plane-up"></i></div>
                    <div><p class="text-[10px] font-black uppercase text-slate-400 leading-none">Pemberangkatan</p><p class="text-sm font-black">15 Hari Lagi</p></div>
                </div>
                <div class="absolute bottom-10 -right-5 bg-white p-4 rounded-2xl shadow-2xl z-20 flex items-center gap-3 border border-slate-50">
                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center"><i class="fas fa-users"></i></div>
                    <div><p class="text-[10px] font-black uppercase text-slate-400 leading-none">Jamaah Aktif</p><p class="text-sm font-black">2000+ Orang</p></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white border-b border-slate-50">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center group">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-600 group-hover:text-white transition shadow-sm"><i class="fas fa-users"></i></div>
                <h4 class="text-3xl font-black">5,000+</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Jumlah Jamaah</p>
            </div>
            <div class="text-center group">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-600 group-hover:text-white transition shadow-sm"><i class="fas fa-calendar-alt"></i></div>
                <h4 class="text-3xl font-black">12</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Tahun Pengalaman</p>
            </div>
            <div class="text-center group">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-600 group-hover:text-white transition shadow-sm"><i class="fas fa-star"></i></div>
                <h4 class="text-3xl font-black">4,9</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Rating Kepuasan</p>
            </div>
            <div class="text-center group">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-600 group-hover:text-white transition shadow-sm"><i class="fas fa-shield-halal"></i></div>
                <h4 class="text-3xl font-black">100%</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Resmi & Legal</p>
            </div>
        </div>
    </section>

    <!-- Paket Umrah Section -->
    <section id="paket" class="py-24 bg-slate-50/50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-black text-slate-900 mb-4">Paket Umrah Pilihan</h2>
                <p class="text-slate-500 font-medium">Pilih paket yang sesuai dengan kebutuhan dan budget Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                <!-- Paket 1 -->
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm transition hover:scale-105 duration-300">
                    <span class="px-3 py-1 bg-slate-100 text-slate-500 rounded-full text-[10px] font-black uppercase tracking-widest">Populer</span>
                    <h4 class="text-xl font-black mt-4">Paket Ekonomis</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase mb-6 italic">09 Hari - 12 Hari</p>
                    <div class="mb-8">
                        <span class="text-3xl font-black text-slate-900">Rp 25jt</span> <span class="text-sm font-bold text-slate-400 italic">/orang</span>
                    </div>
                    <ul class="space-y-4 mb-10 text-[11px] font-bold text-slate-500 uppercase tracking-tighter">
                        <li class="flex items-center"><i class="fas fa-check text-emerald-500 mr-3"></i> Hotel ⭐3 Dekat Haram</li>
                        <li class="flex items-center"><i class="fas fa-check text-emerald-500 mr-3"></i> Pesawat Ekonomi</li>
                        <li class="flex items-center"><i class="fas fa-check text-emerald-500 mr-3"></i> Makan 3x Sehari</li>
                        <li class="flex items-center"><i class="fas fa-check text-emerald-500 mr-3"></i> City Tour Makkah Madinah</li>
                        <li class="flex items-center"><i class="fas fa-check text-emerald-500 mr-3"></i> Perlengkapan Standar</li>
                    </ul>
                    <a href="{{ route('manajergudang.stock.in') }}" class="block w-full py-4 text-center bg-slate-100 text-slate-800 font-black rounded-full hover:bg-slate-200 transition">Pilih Paket</a>
                </div>

                <!-- Paket 2 (VIP HIGHLIGHT) -->
                <div class="emerald-gradient p-1 rounded-[3rem] shadow-2xl shadow-emerald-200 transform scale-110 z-10 relative">
                    <div class="bg-emerald-600 text-white p-8 rounded-[2.8rem]">
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-amber-400 text-white text-[10px] font-black px-6 py-1.5 rounded-full uppercase tracking-widest">Terpopuler</div>
                        <span class="px-3 py-1 bg-white/20 text-white rounded-full text-[10px] font-black uppercase tracking-widest">Premium</span>
                        <h4 class="text-2xl font-black mt-4 uppercase">Paket VIP</h4>
                        <p class="text-[10px] font-bold text-emerald-100 uppercase mb-6 italic opacity-80">12 Hari - 15 Hari</p>
                        <div class="mb-8">
                            <span class="text-4xl font-black text-white leading-none">Rp 45jt</span> <span class="text-sm font-bold text-emerald-100 italic">/orang</span>
                        </div>
                        <ul class="space-y-4 mb-10 text-[11px] font-bold text-emerald-50 tracking-tighter uppercase">
                            <li class="flex items-center"><i class="fas fa-check text-white mr-3"></i> Hotel Bintang 5 Depan Haram</li>
                            <li class="flex items-center"><i class="fas fa-check text-white mr-3"></i> Tiket Pesawat PP (Full Service)</li>
                            <li class="flex items-center"><i class="fas fa-check text-white mr-3"></i> Makan 4x Sehari + Snack</li>
                            <li class="flex items-center"><i class="fas fa-check text-white mr-3"></i> City Tour Premium</li>
                            <li class="flex items-center"><i class="fas fa-check text-white mr-3"></i> Perlengkapan Umrah Lengkap</li>
                            <li class="flex items-center"><i class="fas fa-check text-white mr-3"></i> Bimbingan Ustadz/Ustadzah</li>
                        </ul>
                        <a href="{{ route('manajergudang.stock.in') }}" class="block w-full py-4 text-center bg-white text-emerald-700 font-black rounded-full hover:bg-slate-50 transition">Pilih Paket</a>
                    </div>
                </div>

                <!-- Paket 3 -->
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm transition hover:scale-105 duration-300">
                    <span class="px-3 py-1 bg-slate-100 text-slate-500 rounded-full text-[10px] font-black uppercase tracking-widest">Exclusive</span>
                    <h4 class="text-xl font-black mt-4">Paket Keluarga</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase mb-6 italic">14 Hari - 15 Hari</p>
                    <div class="mb-8">
                        <span class="text-3xl font-black text-slate-900">Rp 35jt</span> <span class="text-sm font-bold text-slate-400 italic">/orang</span>
                    </div>
                    <ul class="space-y-4 mb-10 text-[11px] font-bold text-slate-500 uppercase tracking-tighter">
                        <li class="flex items-center"><i class="fas fa-check text-emerald-500 mr-3"></i> Hotel Bintang 4 Dekat Haram</li>
                        <li class="flex items-center"><i class="fas fa-check text-emerald-500 mr-3"></i> Tiket Pesawat PP Keluarga</li>
                        <li class="flex items-center"><i class="fas fa-check text-emerald-500 mr-3"></i> Makan 3x Sehari</li>
                        <li class="flex items-center"><i class="fas fa-check text-emerald-500 mr-3"></i> City Tour & Wisata Religi</li>
                        <li class="flex items-center"><i class="fas fa-check text-emerald-500 mr-3"></i> Kamar Keluarga</li>
                    </ul>
                    <a href="{{ route('manajergudang.stock.in') }}" class="block w-full py-4 text-center bg-slate-100 text-slate-800 font-black rounded-full hover:bg-slate-200 transition">Pilih Paket</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Fasilitas Section -->
    <section id="fasilitas" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-black mb-4">Fasilitas Terbaik</h2>
            <p class="text-slate-500 mb-16 font-medium">Kami menyediakan fasilitas lengkap untuk kenyamanan ibadah Anda</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                <div class="p-8 bg-emerald-50 rounded-3xl border border-emerald-100 group hover:bg-emerald-600 transition duration-500">
                    <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center mb-6 group-hover:bg-white group-hover:text-emerald-600 transition shadow-lg shadow-emerald-200"><i class="fas fa-hotel"></i></div>
                    <h5 class="text-lg font-black mb-2 group-hover:text-white transition">Hotel Terbaik</h5>
                    <p class="text-xs font-bold text-slate-500 leading-relaxed group-hover:text-emerald-50 transition">Penginapan bintang 4 & 5 terbaik dekat dengan Masjidil Haram & Masjid Nabawi untuk kenyamanan ibadah.</p>
                </div>
                <div class="p-8 bg-emerald-50 rounded-3xl border border-emerald-100 group hover:bg-emerald-600 transition duration-500">
                    <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center mb-6 group-hover:bg-white group-hover:text-emerald-600 transition shadow-lg shadow-emerald-200"><i class="fas fa-utensils"></i></div>
                    <h5 class="text-lg font-black mb-2 group-hover:text-white transition">Katering Halal</h5>
                    <p class="text-xs font-bold text-slate-500 leading-relaxed group-hover:text-emerald-50 transition">Menu masakan halal khas Indonesia dan Arab yang sehat, bergizi dan dikelola secara bersih (Hygienic).</p>
                </div>
                <div class="p-8 bg-emerald-50 rounded-3xl border border-emerald-100 group hover:bg-emerald-600 transition duration-500">
                    <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center mb-6 group-hover:bg-white group-hover:text-emerald-600 transition shadow-lg shadow-emerald-200"><i class="fas fa-bus"></i></div>
                    <h5 class="text-lg font-black mb-2 group-hover:text-white transition">Transportasi AC</h5>
                    <p class="text-xs font-bold text-slate-500 leading-relaxed group-hover:text-emerald-50 transition">Bus eksekutif modern dengan fasilitas AC dan reclining seat untuk kenyamanan jamaah selama perjalanan.</p>
                </div>
                <div class="p-8 bg-emerald-50 rounded-3xl border border-emerald-100 group hover:bg-emerald-600 transition duration-500">
                    <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center mb-6 group-hover:bg-white group-hover:text-emerald-600 transition shadow-lg shadow-emerald-200"><i class="fas fa-user-check"></i></div>
                    <h5 class="text-lg font-black mb-2 group-hover:text-white transition">Pembimbing Ahli</h5>
                    <p class="text-xs font-bold text-slate-500 leading-relaxed group-hover:text-emerald-50 transition">Ustadz dan Mutawwif berpengalaman yang akan membimbing ibadah jamaah sesuai dengan tuntunan Sunnah.</p>
                </div>
                <div class="p-8 bg-emerald-50 rounded-3xl border border-emerald-100 group hover:bg-emerald-600 transition duration-500">
                    <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center mb-6 group-hover:bg-white group-hover:text-emerald-600 transition shadow-lg shadow-emerald-200"><i class="fas fa-briefcase-medical"></i></div>
                    <h5 class="text-lg font-black mb-2 group-hover:text-white transition">Asuransi Perjalanan</h5>
                    <p class="text-xs font-bold text-slate-500 leading-relaxed group-hover:text-emerald-50 transition">Perlindungan asuransi kesehatan dan perjalanan menyeluruh selama jamaah berada di Arab Saudi.</p>
                </div>
                <div class="p-8 bg-emerald-50 rounded-3xl border border-emerald-100 group hover:bg-emerald-600 transition duration-500">
                    <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center mb-6 group-hover:bg-white group-hover:text-emerald-600 transition shadow-lg shadow-emerald-200"><i class="fas fa-headset"></i></div>
                    <h5 class="text-lg font-black mb-2 group-hover:text-white transition">Support 24/7</h5>
                    <p class="text-xs font-bold text-slate-500 leading-relaxed group-hover:text-emerald-50 transition">Layanan bantuan darurat dan informasi operasional yang siap melayani kebutuhan jamaah kapanpun.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Section -->
    <section id="testimoni" class="py-24 bg-slate-50/50">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-black mb-4 tracking-tighter uppercase">Testimoni Jamaah</h2>
            <p class="text-slate-400 font-bold uppercase text-[10px] tracking-[0.3em] mb-16">Pengalaman Nyata Dari Tamu-Tamu Allah</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testi 1 -->
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm text-left border border-slate-100">
                    <div class="text-amber-400 mb-6 text-xs flex gap-1"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="text-slate-500 text-sm font-bold leading-relaxed mb-8 italic">"Alhamdulillah perjalanan umroh yang luar biasa. Pelayanan memuaskan, hotel sangat dekat dengan Masjidil Haram, mutawwif membimbing dengan sabar."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Siti+Nurhaliza&background=10b981&color=fff" class="w-12 h-12 rounded-2xl shadow-lg shadow-emerald-100">
                        <div><p class="text-sm font-black italic">Siti Nurhaliza</p><p class="text-[9px] font-black text-emerald-600 uppercase tracking-widest">Jakarta</p></div>
                    </div>
                </div>
                <!-- Testi 2 -->
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm text-left border border-slate-100">
                    <div class="text-amber-400 mb-6 text-xs flex gap-1"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="text-slate-500 text-sm font-bold leading-relaxed mb-8 italic">"Paket keluarga sangat recommended! Fasilitas hotel bintang 4 sangat nyaman, makanan cocok di lidah, proses pendaftaran sangat mudah lewat website."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Ahmad+Fauzi&background=10b981&color=fff" class="w-12 h-12 rounded-2xl shadow-lg shadow-emerald-100">
                        <div><p class="text-sm font-black italic">Ahmad Fauzi</p><p class="text-[9px] font-black text-emerald-600 uppercase tracking-widest">Bandung</p></div>
                    </div>
                </div>
                <!-- Testi 3 -->
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm text-left border border-slate-100">
                    <div class="text-amber-400 mb-6 text-xs flex gap-1"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="text-slate-500 text-sm font-bold leading-relaxed mb-8 italic">"Sangat puas dengan fasilitas VIP-nya. Business class flight dan hotel bintang 5 persis di depan pelataran Masjid. Ibadah jadi tenang dan khusyuk."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Fatimah+Azahra&background=10b981&color=fff" class="w-12 h-12 rounded-2xl shadow-lg shadow-emerald-100">
                        <div><p class="text-sm font-black italic">Fatimah Azahra</p><p class="text-[9px] font-black text-emerald-600 uppercase tracking-widest">Surabaya</p></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer CTA -->
    <section class="p-8 md:p-16">
        <div class="max-w-7xl mx-auto rounded-[3rem] emerald-gradient p-10 md:p-20 text-white text-center shadow-2xl shadow-emerald-200">
            <h3 class="text-4xl font-black mb-4">Siap Berangkat Umrah?</h3>
            <p class="text-emerald-50 mb-12 text-lg font-medium max-w-2xl mx-auto opacity-90 italic">Wujudkan niat ibadah Anda bersama kami. Dapatkan penawaran harga dan konsultasi bimbingan gratis sekarang juga.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <input type="email" placeholder="Alamat Email Anda" class="px-8 py-5 bg-white/20 border-none rounded-full text-white placeholder-emerald-100 backdrop-blur-md focus:ring-2 focus:ring-white flex-1 max-w-md font-bold">
                <button class="px-10 py-5 bg-white text-emerald-700 font-black rounded-full hover:bg-slate-50 transition shadow-xl uppercase tracking-widest text-xs">Konsultasi Gratis</button>
            </div>
            <p class="mt-12 text-[10px] font-black uppercase tracking-[0.4em] opacity-60">Atau hubungi kami via WhatsApp: +62 821-3581-0672</p>
        </div>
    </section>

    <!-- Main Footer -->
    <footer class="py-20 bg-slate-900 text-white px-8">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-16">
            <div class="md:col-span-2">
                <div class="flex items-center space-x-3 mb-8">
                    <div class="bg-emerald-600 p-2 rounded-xl text-white"><i class="fas fa-kaaba text-2xl"></i></div>
                    <span class="text-2xl font-black uppercase tracking-tighter">Imadinah Hromain <br><span class="text-xs font-bold tracking-[0.2em] text-emerald-500">Tour & Travel</span></span>
                </div>
                <p class="text-slate-400 text-sm font-medium leading-relaxed max-w-sm">Melayani Perjalanan Ibadah Umrah & Haji Plus dengan pelayanan istimewa dan bimbingan sesuai Sunnah Rasulullah SAW.</p>
            </div>
            <div>
                <h5 class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-10">Layanan</h5>
                <ul class="space-y-4 text-xs font-black uppercase tracking-widest text-slate-300">
                    <li><a href="#paket" class="hover:text-emerald-400">Paket Reguler</a></li>
                    <li><a href="#paket" class="hover:text-emerald-400">Umroh VIP Gold</a></li>
                    <li><a href="#paket" class="hover:text-emerald-400">Haji Furoda</a></li>
                </ul>
            </div>
            <div>
                <h5 class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-10">Kontak</h5>
                <ul class="space-y-4 text-sm font-bold text-slate-300 leading-none">
                    <li><i class="fas fa-phone-alt mr-3 text-emerald-600"></i> +62 821-3581-0672</li>
                    <li><i class="fas fa-map-marker-alt mr-3 text-emerald-600"></i> Jakarta Pusat, Indonesia</li>
                    <li><i class="fas fa-envelope mr-3 text-emerald-600"></i> info@imadinah.com</li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto mt-20 pt-10 border-t border-white/5 text-center">
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.3em]">&copy; {{ date('Y') }} {{ config('app.name') }} | Penyelenggara Perjalanan Ibadah Umrah (PPIU) Resmi</p>
        </div>
    </footer>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>