<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wujudkan Impian Umrah Anda | {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Theme untuk Warna Hijau sesuai PDF -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#22c55e',
                            600: '#158A33', // Hijau utama
                            700: '#106c27',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { background-color: #fafaf9; }
        /* Animasi Modal Bawaan Anda */
        .modal-overlay { transition: opacity 0.3s ease; }
        .modal-content { transition: transform 0.3s ease; }
    </style>
</head>
<body class="text-slate-800 overflow-x-hidden antialiased">

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 bg-white border-b border-slate-100 px-6 py-4 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <div class="text-brand-600 text-2xl">
                    <i class="fas fa-kaaba"></i>
                </div>
                <span class="text-lg font-bold text-slate-800 tracking-tight">Al Madinah Haromain</span>
            </div>
            
            <!-- Menu Navigasi Desktop -->
            <div class="hidden md:flex items-center space-x-8 text-sm font-semibold text-slate-600">
                <a href="#" class="text-slate-900">Beranda</a>
                <a href="#paket" class="hover:text-brand-600 transition">Paket</a>
                <a href="#fasilitas" class="hover:text-brand-600 transition">Fasilitas</a>
                <a href="#testimoni" class="hover:text-brand-600 transition">Testimoni</a>
                <a href="#" class="hover:text-brand-600 transition">Kontak</a>
            </div>

            <!-- Tombol Action (Logic Asli Dipertahankan) -->
            <div class="flex items-center space-x-4">
                <button onclick="toggleModal(true)" class="text-sm font-bold text-slate-600 hover:text-brand-600 transition cursor-pointer hidden sm:block">
                    Masuk
                </button>
                <a href="{{ route('register') }}" class="bg-brand-600 text-white px-5 py-2.5 rounded-full text-sm font-bold shadow-md hover:bg-brand-700 transition">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-36 pb-16 px-6 bg-[#F8FDF9]">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 items-center">
            <div class="pr-0 md:pr-10">
                <div class="inline-flex items-center space-x-2 px-3 py-1.5 bg-green-100 text-brand-700 rounded-md text-xs font-semibold mb-6">
                    <i class="far fa-star"></i>
                    <span>PPIU Resmi & Terpercaya</span>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold text-slate-900 leading-tight mb-6">
                    Wujudkan Impian <br> <span class="text-brand-600">Umrah</span> Anda
                </h1>
                <p class="text-slate-500 text-base mb-8 leading-relaxed max-w-lg">
                    Nikmati perjalanan ibadah yang amanah, nyaman, dan sesuai Sunnah. Layanan terbaik dengan fasilitas bintang lima untuk kenyamanan Anda.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 max-w-lg">
                    <input type="email" placeholder="Masukkan Email Anda" class="px-6 py-4 bg-white border border-slate-200 rounded-full flex-1 focus:outline-none focus:border-brand-500 shadow-sm text-sm">
                    <button class="px-8 py-4 bg-brand-600 text-white font-semibold rounded-full shadow-md hover:bg-brand-700 transition whitespace-nowrap">
                        Konsultasi Gratis
                    </button>
                </div>
            </div>

            <!-- Hero Image dengan Badge -->
            <div class="relative mt-10 lg:mt-0">
                <img src="https://images.unsplash.com/photo-1565552645632-d725f8bfc19a?auto=format&fit=crop&w=1000&q=80" alt="Ibadah Umroh" class="rounded-[2rem] w-full h-auto object-cover shadow-lg aspect-[4/3]">
                
                <!-- Badge 1 -->
                <div class="absolute top-6 -left-8 bg-white p-3 rounded-2xl shadow-xl flex items-center gap-3 border border-slate-100">
                    <div class="w-10 h-10 bg-[#E8F5E9] text-brand-600 rounded-lg flex items-center justify-center"><i class="fas fa-plane-departure"></i></div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-semibold leading-none mb-1 uppercase">Keberangkatan</p>
                        <p class="text-sm font-bold text-slate-800">Kosong</p>
                    </div>
                </div>
                <!-- Badge 2 -->
                <div class="absolute bottom-10 -right-6 bg-white p-3 rounded-2xl shadow-xl flex items-center gap-3 border border-slate-100">
                    <div class="w-10 h-10 bg-[#E8F5E9] text-brand-600 rounded-lg flex items-center justify-center"><i class="fas fa-users"></i></div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-semibold leading-none mb-1 uppercase">Jamaah Aktif</p>
                        <p class="text-sm font-bold text-slate-800">Belum Ada</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Statistik -->
    <section class="py-12 bg-white border-b border-slate-100">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="w-14 h-14 bg-[#E8F5E9] text-brand-600 rounded-xl flex items-center justify-center mx-auto mb-4 text-2xl"><i class="fas fa-users"></i></div>
                <h4 class="text-3xl font-bold text-slate-900">5,000+</h4>
                <p class="text-sm text-slate-500 mt-1">Jumlah Terlayani</p>
            </div>
            <div>
                <div class="w-14 h-14 bg-[#E8F5E9] text-brand-600 rounded-xl flex items-center justify-center mx-auto mb-4 text-2xl"><i class="far fa-calendar-alt"></i></div>
                <h4 class="text-3xl font-bold text-slate-900">12</h4>
                <p class="text-sm text-slate-500 mt-1">Tahun Pengalaman</p>
            </div>
            <div>
                <div class="w-14 h-14 bg-[#E8F5E9] text-brand-600 rounded-xl flex items-center justify-center mx-auto mb-4 text-2xl"><i class="fas fa-star"></i></div>
                <h4 class="text-3xl font-bold text-slate-900">4,9</h4>
                <p class="text-sm text-slate-500 mt-1">Rating Kepuasan</p>
            </div>
            <div>
                <div class="w-14 h-14 bg-[#E8F5E9] text-brand-600 rounded-xl flex items-center justify-center mx-auto mb-4 text-2xl"><i class="fas fa-certificate"></i></div>
                <h4 class="text-3xl font-bold text-slate-900">100%</h4>
                <p class="text-sm text-slate-500 mt-1">Resmi & Legal</p>
            </div>
        </div>
    </section>

    <!-- Paket Umrah Section -->
    <section id="paket" class="py-20 bg-[#F8FDF9]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12 max-w-2xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Paket Perjalanan Umrah</h2>
                <p class="text-slate-500 text-sm">Pilih paket yang sesuai dengan kenyamanan dan kebutuhan Anda. Kami Menyediakan berbagai opsi kamar hotel untuk pengalaman ibadah yang lebih personal</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Paket 1 -->
                <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm flex flex-col">
                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=600&q=80" alt="Hotel" class="w-full h-48 object-cover">
                    <div class="p-8 flex-1 flex flex-col">
                        <span class="inline-block px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-[10px] font-bold uppercase tracking-widest mb-3 w-max">Reguler</span>
                        <p class="text-sm text-slate-500 mb-6 h-14">Solusi hemat dan kebersamaan. Hotel satu kamar untuk 4 orang jamaah, cocok untuk keluarga.</p>
                        <div class="mb-6 flex items-baseline gap-2">
                            <span class="text-sm text-slate-500">Mulai</span>
                            <span class="text-3xl font-bold text-brand-600">Rp 25jt</span>
                        </div>
                        <ul class="space-y-3 mb-8 text-sm text-slate-600 flex-1">
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Hotel Bintang 4 (Makkah & Madinah)</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Tiket Pesawat PP (Direct)</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Makan 3x Sehari (Menu Nusantara)</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Akomodasi ke Jakarta & Perlengkapan</li>
                        </ul>
                        <!-- Logic Asli Dipertahankan -->
                        <button onclick="toggleModal(true)" class="block w-full py-3 text-center bg-slate-900 text-white font-semibold rounded-full hover:bg-slate-800 transition">Pilih Paket</button>
                    </div>
                </div>

                <!-- Paket 2 -->
                <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-xl flex flex-col transform md:-translate-y-2 relative">
                    <div class="absolute top-4 right-4 bg-amber-400 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-md">Terpopuler</div>
                    <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=600&q=80" alt="Hotel" class="w-full h-48 object-cover">
                    <div class="p-8 flex-1 flex flex-col">
                        <span class="inline-block px-3 py-1 bg-brand-50 text-brand-600 rounded-full text-[10px] font-bold uppercase tracking-widest mb-3 w-max">Premium</span>
                        <p class="text-sm text-slate-500 mb-6 h-14">Keseimbangan antara kenyamanan dan biaya. Hotel satu kamar untuk 3 orang jamaah dengan ruang gerak lebih leluasa.</p>
                        <div class="mb-6 flex items-baseline gap-2">
                            <span class="text-sm text-slate-500">Mulai</span>
                            <span class="text-3xl font-bold text-brand-600">Rp 45jt</span>
                        </div>
                        <ul class="space-y-3 mb-8 text-sm text-slate-600 flex-1">
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Hotel Bintang 5 (Depan Masjid)</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Tiket Pesawat (Full Service)</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> City Tour Premium</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Bimbingan Ustadz / Mutawwif</li>
                        </ul>
                        <!-- Logic Asli Dipertahankan -->
                        <button onclick="toggleModal(true)" class="block w-full py-3 text-center bg-brand-600 text-white font-semibold rounded-full hover:bg-brand-700 transition">Pilih Paket</button>
                    </div>
                </div>

                <!-- Paket 3 -->
                <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm flex flex-col">
                    <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=600&q=80" alt="Hotel" class="w-full h-48 object-cover">
                    <div class="p-8 flex-1 flex flex-col">
                        <span class="inline-block px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-[10px] font-bold uppercase tracking-widest mb-3 w-max">Executive</span>
                        <p class="text-sm text-slate-500 mb-6 h-14">Solusi hemat dan privasi maksimal. Hotel satu kamar untuk 2 orang jamaah, cocok untuk keluarga.</p>
                        <div class="mb-6 flex items-baseline gap-2">
                            <span class="text-sm text-slate-500">Mulai</span>
                            <span class="text-3xl font-bold text-brand-600">Rp 35jt</span>
                        </div>
                        <ul class="space-y-3 mb-8 text-sm text-slate-600 flex-1">
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Hotel Bintang 4 (Dekat Haram)</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Tiket Pesawat PP (Direct)</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> City Tour & Wisata Religi</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Kamar Khusus Keluarga</li>
                        </ul>
                        <!-- Logic Asli Dipertahankan -->
                        <button onclick="toggleModal(true)" class="block w-full py-3 text-center bg-slate-900 text-white font-semibold rounded-full hover:bg-slate-800 transition">Pilih Paket</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fasilitas Section -->
    <section id="fasilitas" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Layanan Unggulan Kami</h2>
                <p class="text-slate-500 text-sm">Fasilitas terbaik yang kami siapkan untuk menunjang kelancaran ibadah di tanah suci</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Layanan 1 -->
                <div class="p-8 bg-[#F4FCF6] rounded-2xl flex flex-col border border-brand-50">
                    <div class="w-12 h-12 bg-brand-600 text-white rounded-lg flex items-center justify-center mb-5 text-xl"><i class="fas fa-hotel"></i></div>
                    <h5 class="text-xl font-bold text-slate-900 mb-3">Hotel Terbaik</h5>
                    <p class="text-sm text-slate-600 flex-1">Hotel ternama (Bintang 4 & 5) dengan jarak sangat dekat ke pelataran Masjidil Haram untuk kenyamanan optimal.</p>
                </div>
                <!-- Layanan 2 -->
                <div class="p-8 bg-[#F4FCF6] rounded-2xl flex flex-col border border-brand-50">
                    <div class="w-12 h-12 bg-brand-600 text-white rounded-lg flex items-center justify-center mb-5 text-xl"><i class="fas fa-utensils"></i></div>
                    <h5 class="text-xl font-bold text-slate-900 mb-3">Katering Halal</h5>
                    <p class="text-sm text-slate-600 flex-1">Masakan khas Indonesia 3x sehari yang dikelola secara higienis oleh chef ahli berpengalaman.</p>
                </div>
                <!-- Layanan 3 -->
                <div class="p-8 bg-[#F4FCF6] rounded-2xl flex flex-col border border-brand-50">
                    <div class="w-12 h-12 bg-brand-600 text-white rounded-lg flex items-center justify-center mb-5 text-xl"><i class="fas fa-bus"></i></div>
                    <h5 class="text-xl font-bold text-slate-900 mb-3">Transportasi AC</h5>
                    <p class="text-sm text-slate-600 flex-1">Bus eksekutif berfasilitas AC dan kenyamanan ekstra untuk perjalanan antar kota di Tanah Suci.</p>
                </div>
                <!-- Layanan 4 -->
                <div class="p-8 bg-[#F4FCF6] rounded-2xl flex flex-col border border-brand-50">
                    <div class="w-12 h-12 bg-brand-600 text-white rounded-lg flex items-center justify-center mb-5 text-xl"><i class="fas fa-user-tie"></i></div>
                    <h5 class="text-xl font-bold text-slate-900 mb-3">Pembimbing Ahli</h5>
                    <p class="text-sm text-slate-600 flex-1">Mutawwif profesional dan berpengalaman yang membimbing ibadah sesuai dengan tuntunan Sunnah Nabi.</p>
                </div>
                <!-- Layanan 5 -->
                <div class="p-8 bg-[#F4FCF6] rounded-2xl flex flex-col border border-brand-50">
                    <div class="w-12 h-12 bg-brand-600 text-white rounded-lg flex items-center justify-center mb-5 text-xl"><i class="fas fa-heart-pulse"></i></div>
                    <h5 class="text-xl font-bold text-slate-900 mb-3">Asuransi Perjalanan</h5>
                    <p class="text-sm text-slate-600 flex-1">Perlindungan kesehatan dan keselamatan jamaah secara menyeluruh selama beribadah di Arab Saudi.</p>
                </div>
                <!-- Layanan 6 -->
                <div class="p-8 bg-[#F4FCF6] rounded-2xl flex flex-col border border-brand-50">
                    <div class="w-12 h-12 bg-brand-600 text-white rounded-lg flex items-center justify-center mb-5 text-xl"><i class="fas fa-headset"></i></div>
                    <h5 class="text-xl font-bold text-slate-900 mb-3">Support 24/7</h5>
                    <p class="text-sm text-slate-600 flex-1">Layanan customer care yang responsif dan siap membantu segala kebutuhan operasional jamaah kapan saja.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Section -->
    <section id="testimoni" class="py-20 bg-[#F8FDF9]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Testimoni Jamaah</h2>
                <p class="text-slate-500 text-sm">Pengalaman nyata dari ribuan jamaah yang telah menunaikan ibadah umrah bersama kami</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testi 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 flex flex-col">
                    <div class="text-yellow-400 mb-4 text-sm flex gap-1"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="text-slate-600 text-sm leading-relaxed mb-8 flex-1 italic">"Alhamdulillah perjalanan umrah yang luar biasa. Pelayanan sangat memuaskan, hotel dekat dengan Masjidil Haram dan pembimbing sangat membantu."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Siti+Nurhaliza&background=f1f5f9&color=0f172a" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-bold text-slate-900 text-sm">Siti Nurhaliza</p>
                            <p class="text-xs text-slate-500">Jakarta</p>
                        </div>
                    </div>
                </div>
                <!-- Testi 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 flex flex-col">
                    <div class="text-yellow-400 mb-4 text-sm flex gap-1"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="text-slate-600 text-sm leading-relaxed mb-8 flex-1 italic">"Paket keluarga sangat recomended! Semua sudah diatur dengan baik, anak-anak juga merasa nyaman, tinggal berangkat dan ibadah."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Ahmad+Fauzi&background=f1f5f9&color=0f172a" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-bold text-slate-900 text-sm">Ahmad Fauzi</p>
                            <p class="text-xs text-slate-500">Bandung</p>
                        </div>
                    </div>
                </div>
                <!-- Testi 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 flex flex-col">
                    <div class="text-yellow-400 mb-4 text-sm flex gap-1"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="text-slate-600 text-sm leading-relaxed mb-8 flex-1 italic">"Harga terjangkau dengan fasilitas yang sangat baik. Tim sangat profesional dan responsif. Terima kasih Al Madinah Haromain."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Fatimah+Azzahra&background=f1f5f9&color=0f172a" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-bold text-slate-900 text-sm">Fatimah Azzahra</p>
                            <p class="text-xs text-slate-500">Surabaya</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Block Banner CTA Bawah -->
    <section class="bg-brand-600 py-16 px-6 text-center">
        <div class="max-w-4xl mx-auto">
            <h3 class="text-3xl md:text-4xl font-bold mb-4 text-white">Siap Berangkat Umrah?</h3>
            <p class="mb-10 text-[#E8F5E9] text-sm max-w-2xl mx-auto">Wujudkan impian ibadah umrah Anda bersama kami. Dapatkan konsultasi gratis dan penawaran harga terbaik hari ini!</p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-lg mx-auto mb-8">
                <input type="email" placeholder="nama@gmail.com" class="px-6 py-4 rounded-full text-slate-800 flex-1 focus:outline-none text-sm border-none">
                <button class="px-8 py-4 bg-white text-brand-600 font-bold rounded-full hover:bg-slate-100 transition shadow-md whitespace-nowrap text-sm">
                    Konsultasi Gratis
                </button>
            </div>
            <p class="text-sm text-white">Atau hubungi kami di WhatsApp <span class="font-bold">+62 821-3581-0672</span></p>
        </div>
    </section>

    <!-- Main Footer -->
    <footer class="bg-white py-16 px-6 border-t border-slate-100">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center space-x-2 mb-4">
                    <div class="text-brand-600 text-2xl">
                        <i class="fas fa-kaaba"></i>
                    </div>
                    <span class="text-lg font-bold text-slate-800">{{ config('app.name') }}</span>
                </div>
                <p class="text-sm text-slate-500 leading-relaxed max-w-xs">
                    Agen perjalanan umrah resmi dengan komitmen melayani sepenuh hati untuk perjalanan ibadah yang amanah, nyaman, dan sesuai Sunnah.
                </p>
            </div>
            
            <div>
                <h5 class="font-bold text-base mb-6 text-slate-900">Layanan</h5>
                <ul class="space-y-4 text-sm text-slate-500">
                    <li><a href="#" class="hover:text-brand-600 transition">Paket Reguler</a></li>
                    <li><a href="#" class="hover:text-brand-600 transition">Paket VIP Gold</a></li>
                    <li><a href="#" class="hover:text-brand-600 transition">Haji Furoda</a></li>
                </ul>
            </div>
            
            <div>
                <h5 class="font-bold text-base mb-6 text-slate-900">Kontak</h5>
                <ul class="space-y-4 text-sm text-slate-500">
                    <li class="flex items-start"><i class="fas fa-phone mt-1 mr-3 text-brand-600"></i> +62 821-3581-0672</li>
                    <li class="flex items-start"><i class="fas fa-map-marker-alt mt-1 mr-3 text-brand-600"></i> Jakarta Pusat, Indonesia</li>
                </ul>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto mt-16 pt-8 border-t border-slate-100 text-center text-xs font-semibold text-slate-400">
            &copy; {{ date('Y') }} {{ config('app.name') }} | Penyelenggara Umrah Resmi Terdaftar.
        </div>
    </footer>

    <!-- ==========================================
         MODAL LOGIN SELECTION (LOGIC ASLI DIPERTAHANKAN)
         ========================================== -->
    <div id="loginModal" class="fixed inset-0 z-[100] hidden">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm modal-overlay" onclick="toggleModal(false)"></div>
        
        <!-- Content -->
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white w-full max-w-md rounded-[2rem] p-8 shadow-2xl relative z-10 transform scale-95 modal-content">
                
                <!-- Tombol Close Modal -->
                <button onclick="toggleModal(false)" class="absolute top-5 right-5 w-8 h-8 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition">
                    <i class="fas fa-times"></i>
                </button>
                
                <div class="text-center mb-8 mt-2">
                    <div class="w-14 h-14 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-circle text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-1">Sudah punya akun?</h3>
                    <p class="text-slate-500 text-sm">Silakan pilih opsi sesuai status keanggotaan Anda</p>
                </div>

                <div class="space-y-4">
                    <!-- Link Route Login Asli -->
                    <a href="{{ route('login') }}" class="flex items-center justify-between w-full p-4 bg-brand-600 text-white rounded-xl hover:bg-brand-700 transition group shadow-md">
                        <div class="text-left">
                            <p class="font-bold text-sm">Ya, Sudah Punya</p>
                            <p class="text-xs text-brand-100 mt-0.5">Masuk ke Halaman Login</p>
                        </div>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition"></i>
                    </a>

                    <!-- Link Whatsapp Asli -->
                    <a href="https://wa.me/6282135810672?text=Halo%20Admin%2C%20saya%20ingin%20meminta%20akses%20akun%20untuk%20layanan%20Umrah." target="_blank" class="flex items-center justify-between w-full p-4 bg-white border border-slate-200 text-slate-800 rounded-xl hover:border-brand-600 hover:text-brand-600 transition group shadow-sm">
                        <div class="text-left">
                            <p class="font-bold text-sm">Belum Memiliki Akun</p>
                            <p class="text-xs text-slate-500 mt-0.5 group-hover:text-brand-600 transition">Hubungi Admin via WhatsApp</p>
                        </div>
                        <i class="fab fa-whatsapp text-2xl text-brand-500"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Animasi Modal Bawaan Anda -->
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