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
        .glass-nav { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); }
        /* Animasi Modal */
        .modal-overlay { transition: opacity 0.3s ease; }
        .modal-content { transition: transform 0.3s ease; }
    </style>
</head>
<body class="text-slate-900 overflow-x-hidden">

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 glass-nav border-b border-slate-100 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="bg-emerald-600 p-1.5 rounded-lg text-white">
                    <i class="fas fa-kaaba text-lg"></i>
                </div>
                <span class="text-lg font-black tracking-tighter uppercase">Al Madinah Haromain</span>
            </div>
            
            <div class="hidden md:flex items-center space-x-8 text-sm font-bold text-slate-500 uppercase tracking-widest">
                <a href="#" class="text-emerald-600">Beranda</a>
                <a href="#paket" class="hover:text-emerald-600 transition">Paket</a>
                <a href="#fasilitas" class="hover:text-emerald-600 transition">Fasilitas</a>
                <a href="#testimoni" class="hover:text-emerald-600 transition">Testimoni</a>
                <a href="#" class="hover:text-emerald-600 transition">Kontak</a>
            </div>

            <div class="flex items-center space-x-5">
                <!-- MODIFIED: Mengubah link menjadi button untuk trigger modal -->
                <button onclick="toggleModal(true)" class="text-sm font-bold text-slate-600 hover:text-emerald-600 transition cursor-pointer">Masuk</button>
                <a href="{{ route('register') }}" class="bg-emerald-600 text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-lg shadow-emerald-200 hover:bg-emerald-700 transition transform hover:scale-105">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-44 pb-20 px-6 bg-slate-50/30 relative">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-black uppercase tracking-widest mb-6">
                    🕋 PPIU Resmi & Terpercaya
                </span>
                <h1 class="text-5xl md:text-7xl font-black text-slate-900 leading-tight mb-8">
                    Wujudkan Impian <br> <span class="text-emerald-600">Umrah</span> Anda
                </h1>
                <p class="text-slate-500 text-lg mb-10 leading-relaxed max-w-md">
                    Nikmati perjalanan ibadah yang amanah, nyaman, dan sesuai Sunnah. Layanan terbaik dengan fasilitas bintang lima untuk kenyamanan Anda.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 max-w-lg">
                    <input type="email" placeholder="Masukkan Email Anda" class="px-6 py-4 bg-white border border-slate-200 rounded-full flex-1 focus:ring-2 focus:ring-emerald-500 font-medium shadow-sm text-sm outline-none">
                    <button class="px-8 py-4 bg-emerald-600 text-white font-bold rounded-full shadow-lg shadow-emerald-100 hover:bg-emerald-700 transition">
                        Konsultasi Gratis
                    </button>
                </div>
            </div>

            <!-- Hero Image dengan Badge Melayang -->
            <div class="relative">
                <div class="rounded-[3rem] overflow-hidden shadow-2xl relative z-10 border-[10px] border-white">
                    <img src="https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Ibadah Umroh" class="w-full h-auto">
                </div>
                <!-- Badge 1 -->
                <div class="absolute top-10 -left-12 bg-white p-4 rounded-2xl shadow-2xl z-20 flex items-center gap-3 border border-slate-50">
                    <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shadow-inner"><i class="fas fa-plane-departure text-xs"></i></div>
                    <div><p class="text-[10px] font-black uppercase text-slate-400 leading-none">Keberangkatan</p><p class="text-sm font-black italic text-emerald-600 leading-none mt-1">Kosong</p></div>
                </div>
                <!-- Badge 2 -->
                <div class="absolute bottom-10 -right-5 bg-white p-4 rounded-2xl shadow-2xl z-20 flex items-center gap-3 border border-slate-50">
                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center shadow-inner"><i class="fas fa-users text-xs"></i></div>
                    <div><p class="text-[10px] font-black uppercase text-slate-400 leading-none">Jamaah Aktif</p><p class="text-sm font-black italic text-blue-600 leading-none mt-1">Belom Ada</p></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Statistik -->
    <section class="py-16 bg-white border-b border-slate-50">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center group transition">
                <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-600 group-hover:text-white transition shadow-sm"><i class="fas fa-users text-xl"></i></div>
                <h4 class="text-3xl font-black text-slate-800 tracking-tight">5,000+</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Jumlah Terlayani</p>
            </div>
            <div class="text-center group transition">
                <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-600 group-hover:text-white transition shadow-sm"><i class="fas fa-calendar-check text-xl"></i></div>
                <h4 class="text-3xl font-black text-slate-800 tracking-tight">12</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Tahun Pengalaman</p>
            </div>
            <div class="text-center group transition">
                <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-600 group-hover:text-white transition shadow-sm"><i class="fas fa-star text-xl"></i></div>
                <h4 class="text-3xl font-black text-slate-800 tracking-tight">4,9</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Rating Kepuasan</p>
            </div>
            <div class="text-center group transition">
                <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-600 group-hover:text-white transition shadow-sm"><i class="fas fa-check-circle text-xl"></i></div>
                <h4 class="text-3xl font-black text-slate-800 tracking-tight">100%</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Resmi & Legal</p>
            </div>
        </div>
    </section>

    <!-- Paket Umrah Section -->
    <section id="paket" class="py-24 bg-slate-50/50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-black text-slate-900 mb-4 tracking-tight">Paket Umrah Pilihan</h2>
                <p class="text-slate-500 font-medium">Pilih paket yang sesuai dengan kebutuhan dan budget Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 items-center">
                <!-- Paket 1 -->
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm transition hover:scale-105 duration-300">
                    <span class="px-4 py-1.5 bg-slate-100 text-slate-500 rounded-full text-[10px] font-black uppercase tracking-widest">Reguler</span>
                    <h4 class="text-2xl font-black mt-6">Paket Ekonomis</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase mb-8 italic leading-none">9 Hari - 12 Hari</p>
                    <div class="mb-10">
                        <span class="text-4xl font-black text-slate-900 tracking-tighter">Rp 25jt</span> <span class="text-sm font-bold text-slate-400 italic">/orang</span>
                    </div>
                    <ul class="space-y-4 mb-12 text-[11px] font-bold text-slate-500 uppercase">
                        <li><i class="fas fa-check text-emerald-500 mr-2"></i> Hotel ⭐3 Dekat Haram</li>
                        <li><i class="fas fa-check text-emerald-500 mr-2"></i> Tiket Pesawat PP</li>
                        <li><i class="fas fa-check text-emerald-500 mr-2"></i> Makan 3x Sehari</li>
                        <li><i class="fas fa-check text-emerald-500 mr-2"></i> City Tour Makkah & Madinah</li>
                        <li><i class="fas fa-check text-emerald-500 mr-2"></i> Perlengkapan Umrah</li>
                    </ul>
                    <button onclick="toggleModal(true)" class="block w-full py-4 text-center bg-slate-100 text-slate-800 font-black rounded-full hover:bg-slate-200 transition uppercase tracking-widest text-xs shadow-sm">Pilih Paket</button>
                </div>

                <!-- Paket 2 (VIP HIGHLIGHT) -->
                <div class="emerald-gradient p-1.5 rounded-[3rem] shadow-2xl shadow-emerald-100 transform scale-110 z-10 relative">
                    <div class="bg-emerald-600 text-white p-10 rounded-[2.8rem]">
                        <div class="absolute -top-5 left-1/2 -translate-x-1/2 bg-amber-400 text-white text-[10px] font-black px-8 py-2 rounded-full uppercase tracking-[0.3em] shadow-lg">Terpopuler</div>
                        <span class="px-4 py-1.5 bg-white/20 text-white rounded-full text-[10px] font-black uppercase tracking-widest">Premium</span>
                        <h4 class="text-3xl font-black mt-6 uppercase tracking-tighter">Paket VIP</h4>
                        <p class="text-[10px] font-bold text-emerald-100 uppercase mb-8 italic opacity-80 leading-none">12 Hari - 15 Hari</p>
                        <div class="mb-10">
                            <span class="text-5xl font-black text-white tracking-tighter">Rp 45jt</span> <span class="text-sm font-bold text-emerald-100 italic">/orang</span>
                        </div>
                        <ul class="space-y-4 mb-12 text-[11px] font-bold text-emerald-50 uppercase">
                            <li><i class="fas fa-check text-white mr-2"></i> Hotel ⭐5 Depan Masjid</li>
                            <li><i class="fas fa-check text-white mr-2"></i> Tiket Pesawat (Full Service)</li>
                            <li><i class="fas fa-check text-white mr-2"></i> Makan 4x Sehari + Snack</li>
                            <li><i class="fas fa-check text-white mr-2"></i> City Tour Premium</li>
                            <li><i class="fas fa-check text-white mr-2"></i> Perlengkapan Umrah Lengkap</li>
                            <li><i class="fas fa-check text-white mr-2"></i> Bimbingan Ustadz / Mutawwif</li>
                        </ul>
                        <button onclick="toggleModal(true)" class="block w-full py-4 text-center bg-white text-emerald-700 font-black rounded-full hover:bg-slate-100 transition uppercase tracking-widest text-xs shadow-xl shadow-emerald-900/20">Pilih Paket</button>
                    </div>
                </div>

                <!-- Paket 3 -->
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-sm transition hover:scale-105 duration-300">
                    <span class="px-4 py-1.5 bg-slate-100 text-slate-500 rounded-full text-[10px] font-black uppercase tracking-widest">Executive</span>
                    <h4 class="text-2xl font-black mt-6">Paket Keluarga</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase mb-8 italic leading-none">14 Hari - 15 Hari</p>
                    <div class="mb-10">
                        <span class="text-4xl font-black text-slate-900 tracking-tighter">Rp 35jt</span> <span class="text-sm font-bold text-slate-400 italic">/orang</span>
                    </div>
                    <ul class="space-y-4 mb-12 text-[11px] font-bold text-slate-50 uppercase">
                        <li><i class="fas fa-check text-emerald-500 mr-2"></i> Hotel ⭐4 Dekat Haram</li>
                        <li><i class="fas fa-check text-emerald-500 mr-2"></i> Tiket Pesawat PP</li>
                        <li><i class="fas fa-check text-emerald-500 mr-2"></i> Makan 3x Sehari</li>
                        <li><i class="fas fa-check text-emerald-500 mr-2"></i> City Tour & Wisata Religi</li>
                        <li><i class="fas fa-check text-emerald-500 mr-2"></i> Kamar Khusus Keluarga</li>
                    </ul>
                    <button onclick="toggleModal(true)" class="block w-full py-4 text-center bg-slate-100 text-slate-800 font-black rounded-full hover:bg-slate-200 transition uppercase tracking-widest text-xs shadow-sm">Pilih Paket</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Fasilitas Section -->
    <section id="fasilitas" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-black mb-4">Fasilitas Terbaik</h2>
            <p class="text-slate-500 mb-20 font-medium">Kami menyediakan fasilitas lengkap untuk kenyamanan ibadah Anda</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-10 bg-emerald-50/50 rounded-[2.5rem] border border-emerald-100 text-left group hover:bg-emerald-600 transition duration-500 shadow-sm">
                    <div class="w-14 h-14 bg-emerald-600 text-white rounded-2xl flex items-center justify-center mb-8 group-hover:bg-white group-hover:text-emerald-600 transition shadow-lg"><i class="fas fa-hotel text-xl"></i></div>
                    <h5 class="text-xl font-black mb-4 group-hover:text-white transition">Hotel Terbaik</h5>
                    <p class="text-sm font-bold text-slate-500 leading-relaxed group-hover:text-emerald-50 transition">Hotel ternama (⭐4 & ⭐5) dengan jarak sangat dekat ke pelataran Masjidil Haram.</p>
                </div>
                <div class="p-10 bg-emerald-50/50 rounded-[2.5rem] border border-emerald-100 text-left group hover:bg-emerald-600 transition duration-500 shadow-sm">
                    <div class="w-14 h-14 bg-emerald-600 text-white rounded-2xl flex items-center justify-center mb-8 group-hover:bg-white group-hover:text-emerald-600 transition shadow-lg"><i class="fas fa-utensils text-xl"></i></div>
                    <h5 class="text-xl font-black mb-4 group-hover:text-white transition">Katering Halal</h5>
                    <p class="text-sm font-bold text-slate-500 leading-relaxed group-hover:text-emerald-50 transition">Masakan khas Indonesia 3x sehari yang dikelola secara higienis oleh chef ahli.</p>
                </div>
                <div class="p-10 bg-emerald-50/50 rounded-[2.5rem] border border-emerald-100 text-left group hover:bg-emerald-600 transition duration-500 shadow-sm">
                    <div class="w-14 h-14 bg-emerald-600 text-white rounded-2xl flex items-center justify-center mb-8 group-hover:bg-white group-hover:text-emerald-600 transition shadow-lg"><i class="fas fa-bus text-xl"></i></div>
                    <h5 class="text-xl font-black mb-4 group-hover:text-white transition">Transportasi AC</h5>
                    <p class="text-sm font-bold text-slate-500 leading-relaxed group-hover:text-emerald-50 transition">Bus eksekutif berfasilitas AC dan kenyamanan ekstra untuk perjalanan di Tanah Suci.</p>
                </div>
                <div class="p-10 bg-emerald-50/50 rounded-[2.5rem] border border-emerald-100 text-left group hover:bg-emerald-600 transition duration-500 shadow-sm">
                    <div class="w-14 h-14 bg-emerald-600 text-white rounded-2xl flex items-center justify-center mb-8 group-hover:bg-white group-hover:text-emerald-600 transition shadow-lg"><i class="fas fa-user-tie text-xl"></i></div>
                    <h5 class="text-xl font-black mb-4 group-hover:text-white transition">Pembimbing Ahli</h5>
                    <p class="text-sm font-bold text-slate-500 leading-relaxed group-hover:text-emerald-50 transition">Mutawwif berpengalaman yang membimbing ibadah sesuai tuntunan Sunnah Nabi.</p>
                </div>
                <div class="p-10 bg-emerald-50/50 rounded-[2.5rem] border border-emerald-100 text-left group hover:bg-emerald-600 transition duration-500 shadow-sm">
                    <div class="w-14 h-14 bg-emerald-600 text-white rounded-2xl flex items-center justify-center mb-8 group-hover:bg-white group-hover:text-emerald-600 transition shadow-lg"><i class="fas fa-heart-pulse text-xl"></i></div>
                    <h5 class="text-xl font-black mb-4 group-hover:text-white transition">Asuransi Perjalanan</h5>
                    <p class="text-sm font-bold text-slate-500 leading-relaxed group-hover:text-emerald-50 transition">Perlindungan kesehatan dan keselamatan jamaah secara menyeluruh selama beribadah.</p>
                </div>
                <div class="p-10 bg-emerald-50/50 rounded-[2.5rem] border border-emerald-100 text-left group hover:bg-emerald-600 transition duration-500 shadow-sm">
                    <div class="w-14 h-14 bg-emerald-600 text-white rounded-2xl flex items-center justify-center mb-8 group-hover:bg-white group-hover:text-emerald-600 transition shadow-lg"><i class="fas fa-headset text-xl"></i></div>
                    <h5 class="text-xl font-black mb-4 group-hover:text-white transition">Support 24/7</h5>
                    <p class="text-sm font-bold text-slate-500 leading-relaxed group-hover:text-emerald-50 transition">Layanan customer care yang responsif membantu kebutuhan jamaah kapan saja.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Jamaah -->
    <section id="testimoni" class="py-24 bg-slate-50/50">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-black mb-4 uppercase tracking-tighter">Testimoni Jamaah</h2>
            <p class="text-slate-400 font-bold uppercase text-[10px] tracking-[0.4em] mb-20 italic">Kisah Nyata Dari Para Tamu Allah</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm text-left border border-slate-100 transition hover:shadow-xl group">
                    <div class="text-amber-400 mb-6 text-[10px] flex gap-1"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="text-slate-500 text-sm font-bold leading-relaxed mb-10 italic group-hover:text-slate-700 transition">"Alhamdulillah perjalanan umroh yang luar biasa. Pelayanan sangat memuaskan, hotel sangat dekat, muthawwif sangat membimbing."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Siti+Nura&background=10b981&color=fff" class="w-12 h-12 rounded-2xl shadow-lg shadow-emerald-100">
                        <div><p class="text-sm font-black italic">Siti Nurhaliza</p><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Jakarta</p></div>
                    </div>
                </div>
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm text-left border border-slate-100 transition hover:shadow-xl group">
                    <div class="text-amber-400 mb-6 text-[10px] flex gap-1"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="text-slate-500 text-sm font-bold leading-relaxed mb-10 italic group-hover:text-slate-700 transition">"Paket keluarga sangat recommended! Semuanya sudah diatur dengan sangat baik, tinggal beribadah dengan tenang."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Ahmad+F&background=10b981&color=fff" class="w-12 h-12 rounded-2xl shadow-lg shadow-emerald-100">
                        <div><p class="text-sm font-black italic">Ahmad Fauzi</p><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Bandung</p></div>
                    </div>
                </div>
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm text-left border border-slate-100 transition hover:shadow-xl group">
                    <div class="text-amber-400 mb-6 text-[10px] flex gap-1"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="text-slate-500 text-sm font-bold leading-relaxed mb-10 italic group-hover:text-slate-700 transition">"Harga sangat sebanding dengan fasilitas yang sangat baik. Tim sangat profesional dan responsif. Terima kasih!"</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Fatimah+A&background=10b981&color=fff" class="w-12 h-12 rounded-2xl shadow-lg shadow-emerald-100">
                        <div><p class="text-sm font-black italic">Fatimah Az-Zahra</p><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Surabaya</p></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer CTA -->
    <section class="p-8 md:p-20">
        <div class="max-w-7xl mx-auto rounded-[3rem] emerald-gradient p-12 md:p-24 text-white text-center shadow-2xl shadow-emerald-100">
            <h3 class="text-4xl md:text-5xl font-black mb-6">Siap Berangkat Umrah?</h3>
            <p class="text-emerald-50 mb-12 text-lg font-medium opacity-90 italic">Wujudkan niat ibadah Anda bersama kami. Dapatkan konsultasi gratis dan penawaran harga terbaik hari ini!</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <input type="email" placeholder="nama@gmail.com" class="px-8 py-5 bg-white/20 border-none rounded-full text-white placeholder-emerald-100 backdrop-blur-md focus:ring-2 focus:ring-white w-full max-w-md font-bold">
                <button class="px-12 py-5 bg-white text-emerald-700 font-black rounded-full hover:bg-slate-50 transition shadow-xl uppercase tracking-widest text-xs">Konsultasi Gratis</button>
            </div>
            <p class="mt-12 text-[10px] font-black uppercase tracking-[0.4em] opacity-60 italic">Atau hubungi kami di WhatsApp: +62 821-3581-0672</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-20 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-20">
            <div class="space-y-8">
                <div class="flex items-center space-x-3">
                    <div class="bg-emerald-600 p-2 rounded-xl text-white"><i class="fas fa-kaaba"></i></div>
                    <span class="text-xl font-black uppercase tracking-tighter">{{ config('app.name') }}</span>
                </div>
                <p class="text-slate-400 text-sm font-medium leading-relaxed italic">Agen perjalanan umrah resmi dengan komitmen melayani sepenuh hati.</p>
            </div>
            <div>
                <h5 class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-10">Layanan</h5>
                <ul class="space-y-4 text-xs font-black uppercase tracking-widest text-slate-400">
                    <li><a href="#" class="hover:text-emerald-600 transition">Paket Reguler</a></li>
                    <li><a href="#" class="hover:text-emerald-600 transition">Paket VIP Gold</a></li>
                    <li><a href="#" class="hover:text-emerald-600 transition">Haji Furoda</a></li>
                </ul>
            </div>
            <div>
                <h5 class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-10">Kontak</h5>
                <ul class="space-y-4 text-sm font-bold text-slate-400">
                    <li class="flex items-center"><i class="fas fa-phone mr-3 text-emerald-600"></i> +62 821-3581-0672</li>
                    <li class="flex items-center"><i class="fas fa-map-marker-alt mr-3 text-emerald-600"></i> Jakarta Pusat, Indonesia</li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto mt-20 pt-10 border-t border-slate-50 text-center">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest italic leading-none">&copy; {{ date('Y') }} {{ config('app.name') }} | Penyelenggara Umrah Resmi Terdaftar</p>
        </div>
    </footer>

    <!-- ==========================================
         MODAL LOGIN SELECTION (TAMBAHAN BARU)
         ========================================== -->
    <div id="loginModal" class="fixed inset-0 z-[100] hidden">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm modal-overlay" onclick="toggleModal(false)"></div>
        
        <!-- Content -->
        <div class="flex items-center justify-center min-h-screen px-6">
            <div class="bg-white w-full max-w-md rounded-[2.5rem] p-10 shadow-2xl relative z-10 transform scale-95 modal-content border border-slate-100">
                <button onclick="toggleModal(false)" class="absolute top-6 right-6 text-slate-300 hover:text-slate-600 transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
                
                <div class="text-center mb-10">
                    <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-user-check text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2">Sudah punya akun?</h3>
                    <p class="text-slate-500 text-sm font-medium leading-relaxed italic">Silakan pilih opsi sesuai status keanggotaan Anda</p>
                </div>

                <div class="space-y-4">
                    <!-- Jika Sudah Punya Akun -->
                    <a href="{{ route('login') }}" class="flex items-center justify-between w-full p-5 bg-emerald-600 text-white rounded-2xl hover:bg-emerald-700 transition group shadow-lg shadow-emerald-100">
                        <div class="text-left">
                            <p class="font-black text-sm uppercase tracking-wider">Ya, Sudah Punya</p>
                            <p class="text-[10px] text-emerald-100 font-medium">Masuk Hal Login</p>
                        </div>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition"></i>
                    </a>

                    <!-- Jika Belum Punya Akun (Link WA) -->
                    <a href="https://wa.me/6282135810672?text=Halo%20Admin%2C%20saya%20ingin%20meminta%20akses%20akun%20untuk%20layanan%20Umrah." target="_blank" class="flex items-center justify-between w-full p-5 bg-white border-2 border-slate-100 text-slate-800 rounded-2xl hover:border-emerald-600 hover:text-emerald-600 transition group">
                        <div class="text-left">
                            <p class="font-black text-sm uppercase tracking-wider">Belum Memiliki Akun</p>
                            <p class="text-[10px] text-slate-400 font-medium italic">Hubungi Admin via WhatsApp</p>
                        </div>
                        <i class="fab fa-whatsapp text-xl text-emerald-500"></i>
                    </a>
                </div>

                <p class="mt-8 text-center text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Layanan Support 24/7</p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
        function toggleModal(show) {
            const modal = document.getElementById('loginModal');
            const content = modal.querySelector('.modal-content');
            
            if (show) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.querySelector('.modal-overlay').classList.add('opacity-100');
                    content.classList.remove('scale-95');
                    content.classList.add('scale-100');
                }, 10);
            } else {
                modal.querySelector('.modal-overlay').classList.remove('opacity-100');
                content.classList.remove('scale-100');
                content.classList.add('scale-95');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
        }
    </script>
</body>
</html>