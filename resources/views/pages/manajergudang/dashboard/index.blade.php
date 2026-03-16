<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wujudkan Impian Umrah Anda | {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                            600: '#158A33', // Hijau yang lebih pekat sesuai PDF
                            700: '#106c27',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #fafaf9; }
    </style>
</head>
<body class="text-slate-800 overflow-x-hidden antialiased">

    @if(session('success'))
    <!-- Popup Berhasil setelah Confirm -->
    <div id="successPopup" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 text-center border border-green-100">
            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-green-100 flex items-center justify-center">
                <i class="fas fa-check-circle text-3xl text-brand-600"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2">Berhasil</h3>
            <p class="text-slate-600 text-sm mb-6">Transaksi selesai dan telah dibuat. Data jamaah sudah masuk ke admin.</p>
            <button type="button" onclick="document.getElementById('successPopup').remove()" class="px-8 py-3 bg-brand-600 text-white font-semibold rounded-full hover:bg-brand-700 transition">
                OK
            </button>
        </div>
    </div>
    <script>
        (function(){
            var el = document.getElementById('successPopup');
            if (el && window.location.hash === '#paket') {
                document.getElementById('paket') && document.getElementById('paket').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        })();
    </script>
    @endif

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 bg-white border-b border-slate-100 px-6 py-4 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <div class="text-brand-600 text-2xl">
                    <i class="fas fa-kaaba"></i>
                </div>
                <span class="text-lg font-bold text-slate-800">{{ config('app.name') }}</span>
            </div>
            
            <!-- Menu Navigasi -->
            <div class="hidden md:flex items-center space-x-8 text-sm font-semibold text-slate-600">
                <a href="#" class="text-slate-900">Beranda</a>
                <a href="#paket" class="hover:text-brand-600 transition">Paket</a>
                <a href="#fasilitas" class="hover:text-brand-600 transition">Fasilitas</a>
                <a href="#testimoni" class="hover:text-brand-600 transition">Testimoni</a>
                <a href="#kontak" class="hover:text-brand-600 transition">Kontak</a>
            </div>

            <!-- Bagian User & Logout (LOGIC ASLI DIPERTAHANKAN 100%) -->
            <div class="flex items-center space-x-5 border-l pl-5 border-slate-200">
                <div class="text-right hidden sm:block">
                    <p class="text-[10px] font-black text-slate-400 uppercase leading-none mb-1">Jamaah Terdaftar</p>
                    <p class="text-sm font-black text-brand-600">{{ auth()->user()->name }}</p>
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
    <section class="pt-36 pb-16 px-6 bg-[#F8FDF9]">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 items-center">
            <div class="pr-0 md:pr-10">
                <div class="inline-flex items-center space-x-2 px-3 py-1.5 bg-green-100 text-brand-700 rounded-md text-xs font-semibold mb-6">
                    <i class="far fa-star"></i>
                    <span>Agent Terpercaya</span>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold text-slate-900 leading-tight mb-6">
                    Wujudkan Impian <br> <span class="text-brand-600">Umrah</span> Anda
                </h1>
                <p class="text-slate-500 text-base mb-8 leading-relaxed max-w-lg">
                    Nikmati pengalaman ibadah umrah yang nyaman dan khusyuk bersama kami. Paket lengkap dengan harga terjangkau dan pelayanan terbaik.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 max-w-lg">
                    <input type="email" placeholder="nama@gmail.com" class="px-6 py-4 bg-white border border-slate-200 rounded-full flex-1 focus:outline-none focus:border-brand-500 shadow-sm text-sm">
                    <button class="px-8 py-4 bg-brand-600 text-white font-semibold rounded-full shadow-md hover:bg-brand-700 transition whitespace-nowrap">
                        Konsultasi Gratis
                    </button>
                </div>
            </div>

            <!-- Hero Image Right -->
            <div class="relative mt-10 lg:mt-0">
                <img src="https://images.unsplash.com/photo-1565552645632-d725f8bfc19a?auto=format&fit=crop&w=1000&q=80" alt="Makkah" class="rounded-[2rem] w-full h-auto object-cover shadow-lg aspect-[4/3]">
                
                <!-- Floating Badges -->
                <div class="absolute top-6 -left-8 bg-white p-3 rounded-2xl shadow-xl flex items-center gap-3 border border-slate-100">
                    <div class="w-10 h-10 bg-[#E8F5E9] text-brand-600 rounded-lg flex items-center justify-center"><i class="fas fa-plane-departure"></i></div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-semibold leading-none mb-1">Keberangkatan</p>
                        <p class="text-sm font-bold text-slate-800">15 Hari Lagi</p>
                    </div>
                </div>
                <div class="absolute bottom-10 -right-6 bg-white p-3 rounded-2xl shadow-xl flex items-center gap-3 border border-slate-100">
                    <div class="w-10 h-10 bg-[#E8F5E9] text-brand-600 rounded-lg flex items-center justify-center"><i class="fas fa-users"></i></div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-semibold leading-none mb-1">Jamaah Aktif</p>
                        <p class="text-sm font-bold text-slate-800">2000+ Orang</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-white">
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

    <!-- Paket Umrah Section (LOGIC ROUTING ASLI DIPERTAHANKAN) -->
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
                        <p class="text-sm text-slate-500 mb-6 h-14">Solusi hemat dan kebersamaan. Hotel satu kamar untuk 4 orang jamaah, cocok untuk rombongan keluarga atau teman.</p>
                        <div class="mb-6 flex items-baseline gap-2">
                            <span class="text-sm text-slate-500">Mulai</span>
                            <span class="text-3xl font-bold text-brand-600">Rp 25jt</span>
                        </div>
                        <ul class="space-y-3 mb-8 text-sm text-slate-600 flex-1">
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Hotel Bintang 4 (Makkah & Madinah)</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Tiket Pesawat PP (Direct)</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Makan 3x Sehari (Menu Nusantara)</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Akomondasi ke Jakarta & Perlengkapan</li>
                        </ul>
                        <!-- Paket Ekonomis Rp 25jt → category_id 1 -->
                        <a href="{{ route('manajergudang.stock.in', ['package_id' => 1]) }}" class="block w-full py-3 text-center bg-slate-900 text-white font-semibold rounded-full hover:bg-slate-800 transition">Pilih Paket</a>
                    </div>
                </div>

                <!-- Paket 2 -->
                <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-xl flex flex-col transform md:-translate-y-2">
                    <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=600&q=80" alt="Hotel" class="w-full h-48 object-cover">
                    <div class="p-8 flex-1 flex flex-col">
                        <p class="text-sm text-slate-500 mb-6 h-14">Keseimbangan antara kenyamanan dan biaya. Hotel satu kamar untuk 3 orang jamaah dengan ruang gerak lebih leluasa.</p>
                        <div class="mb-6 flex items-baseline gap-2">
                            <span class="text-sm text-slate-500">Mulai</span>
                            <span class="text-3xl font-bold text-brand-600">Rp 35jt</span>
                        </div>
                        <ul class="space-y-3 mb-8 text-sm text-slate-600 flex-1">
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Hotel Bintang 4/5 (Dekat Masjid)</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Tiket Pesawat PP (Direct)</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Handling & Muthawif Profesional</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Akomondasi ke Jakarta & Perlengkapan</li>
                        </ul>
                        <!-- Paket VIP Rp 35jt → category_id 2 -->
                        <a href="{{ route('manajergudang.stock.in', ['package_id' => 2]) }}" class="block w-full py-3 text-center bg-brand-600 text-white font-semibold rounded-full hover:bg-brand-700 transition">Pilih Paket</a>
                    </div>
                </div>

                <!-- Paket 3 -->
                <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm flex flex-col">
                    <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=600&q=80" alt="Hotel" class="w-full h-48 object-cover">
                    <div class="p-8 flex-1 flex flex-col">
                        <p class="text-sm text-slate-500 mb-6 h-14">Solusi hemat dan kebersamaan. Hotel satu kamar untuk 4 orang jamaah, cocok untuk rombongan keluarga atau teman.</p>
                        <div class="mb-6 flex items-baseline gap-2">
                            <span class="text-sm text-slate-500">Mulai</span>
                            <span class="text-3xl font-bold text-brand-600">Rp 40jt</span>
                        </div>
                        <ul class="space-y-3 mb-8 text-sm text-slate-600 flex-1">
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Hotel Bintang 5 (Depan Masjid)</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Tiket Pesawat PP (Direct)</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> City Tour Mekkah & Madinah</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Akomondasi ke Jakarta & Perlengkapan</li>
                        </ul>
                        <!-- Paket Keluarga Rp 40jt → category_id 3 -->
                        <a href="{{ route('manajergudang.stock.in', ['package_id' => 3]) }}" class="block w-full py-3 text-center bg-slate-900 text-white font-semibold rounded-full hover:bg-slate-800 transition">Pilih Paket</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Unggulan Section -->
    <section id="fasilitas" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Layanan Unggulan Kami</h2>
                <p class="text-slate-500 text-sm">Fasilitas terbaik yang kami siapkan untuk menunjang kelancaran ibadah di tanah</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Layanan 1 -->
                <div class="p-8 bg-[#F4FCF6] rounded-2xl flex flex-col">
                    <div class="w-12 h-12 bg-brand-600 text-white rounded-lg flex items-center justify-center mb-5 text-xl"><i class="fas fa-user-friends"></i></div>
                    <h5 class="text-xl font-bold text-slate-900 mb-1">Pendamping Ibadah</h5>
                    <p class="text-[11px] text-slate-400 mb-4">(Muthowif & Muthowifah)</p>
                    <p class="text-sm text-slate-600 mb-6 flex-1">Bimbingan dari mentor agama profesional yang menadampingi jamaah sepanajng ibadah Umrah dengan penuh perhatian.</p>
                    <ul class="space-y-2 mb-8 text-xs text-slate-600 font-medium">
                        <li><i class="fas fa-check text-brand-600 mr-2"></i> Penjelasan tata cara manasik & doa</li>
                        <li><i class="fas fa-check text-brand-600 mr-2"></i> Pendampingan Ibadah di Makkah & Madinah</li>
                        <li><i class="fas fa-check text-brand-600 mr-2"></i> Pembimbong Pria & Wanita tersedia</li>
                    </ul>
                    <a href="#" class="text-xs font-bold text-slate-900 hover:text-brand-600">Pelajari Selengkapnya</a>
                </div>

                <!-- Layanan 2 -->
                <div class="p-8 bg-[#F4FCF6] rounded-2xl flex flex-col">
                    <div class="w-12 h-12 bg-brand-600 text-white rounded-lg flex items-center justify-center mb-5 text-xl"><i class="fas fa-plane"></i></div>
                    <h5 class="text-xl font-bold text-slate-900 mb-1">Airport Handling</h5>
                    <p class="text-sm text-slate-600 mb-6 flex-1 mt-6">Layanan pengurusan bagasi dan chek-in di bandara untuk memastikan keberangkatan dan kedatangan yang bebas repot.</p>
                    <ul class="space-y-2 mb-8 text-xs text-slate-600 font-medium">
                        <li><i class="fas fa-check text-brand-600 mr-2"></i> Bantuan Chek-in & Bagasi</li>
                        <li><i class="fas fa-check text-brand-600 mr-2"></i> Lounge Bandara Ekslusif</li>
                    </ul>
                    <a href="#" class="text-xs font-bold text-slate-900 hover:text-brand-600 mt-auto">Pelajari Selengkapnya</a>
                </div>

                <!-- Layanan 3 -->
                <div class="p-8 bg-[#F4FCF6] rounded-2xl flex flex-col">
                    <div class="w-12 h-12 bg-brand-600 text-white rounded-lg flex items-center justify-center mb-5 text-xl"><i class="fas fa-bus"></i></div>
                    <h5 class="text-xl font-bold text-slate-900 mb-1">Transportasi AC</h5>
                    <p class="text-sm text-slate-600 mb-6 flex-1 mt-6">Armada bus terbaru dengan fasilitas AC dan toilet yang nyaman untuk perjalanan antar kota di Arab Saudi.</p>
                    <ul class="space-y-2 mb-8 text-xs text-slate-600 font-medium">
                        <li><i class="fas fa-check text-brand-600 mr-2"></i> Bus VIP Terbaru</li>
                        <li><i class="fas fa-check text-brand-600 mr-2"></i> Driver Berpengalaman</li>
                    </ul>
                    <a href="#" class="text-xs font-bold text-slate-900 hover:text-brand-600 mt-auto">Pelajari Selengkapnya</a>
                </div>

                <!-- Layanan 4 -->
                <div class="p-8 bg-[#F4FCF6] rounded-2xl flex flex-col">
                    <div class="w-12 h-12 bg-brand-600 text-white rounded-lg flex items-center justify-center mb-5 text-xl"><i class="fas fa-utensils"></i></div>
                    <h5 class="text-xl font-bold text-slate-900 mb-1">Catering Services</h5>
                    <p class="text-sm text-slate-600 mb-6 flex-1 mt-6">Sajian menu makanan Indonesia yang lezat dan bergizi untuk menjaga stamina jamaah selama beribadah.</p>
                    <ul class="space-y-2 mb-8 text-xs text-slate-600 font-medium">
                        <li><i class="fas fa-check text-brand-600 mr-2"></i> Menu Cita Rasa Nusantara</li>
                        <li><i class="fas fa-check text-brand-600 mr-2"></i> Prasmanan 3x Sehari</li>
                    </ul>
                    <a href="#" class="text-xs font-bold text-slate-900 hover:text-brand-600 mt-auto">Pelajari Selengkapnya</a>
                </div>

                <!-- Layanan 5 -->
                <div class="p-8 bg-[#F4FCF6] rounded-2xl flex flex-col">
                    <div class="w-12 h-12 bg-brand-600 text-white rounded-lg flex items-center justify-center mb-5 text-xl"><i class="fas fa-hotel"></i></div>
                    <h5 class="text-xl font-bold text-slate-900 mb-1">Hotel Reservation</h5>
                    <p class="text-sm text-slate-600 mb-6 flex-1 mt-6">Akomondasi hotel berbintang yang dekat dengan Masjidil Haram dan Masjid Nabawi untuk kenyamanan istirahat Anda.</p>
                    <ul class="space-y-2 mb-8 text-xs text-slate-600 font-medium">
                        <li><i class="fas fa-check text-brand-600 mr-2"></i> Hotel Bintang 4 & 5</li>
                        <li><i class="fas fa-check text-brand-600 mr-2"></i> Jarak Dekat Dengan Masjid</li>
                    </ul>
                    <a href="#" class="text-xs font-bold text-slate-900 hover:text-brand-600 mt-auto">Pelajari Selengkapnya</a>
                </div>

                <!-- Layanan 6 -->
                <div class="p-8 bg-[#F4FCF6] rounded-2xl flex flex-col">
                    <div class="w-12 h-12 bg-brand-600 text-white rounded-lg flex items-center justify-center mb-5 text-xl"><i class="fas fa-file-alt"></i></div>
                    <h5 class="text-xl font-bold text-slate-900 mb-1">Visa Handling</h5>
                    <p class="text-sm text-slate-600 mb-6 flex-1 mt-6">Pengurusan visa Umrah yang cepat dan terjamin legalitasnya melalui provider resmi terpercaya</p>
                    <ul class="space-y-2 mb-8 text-xs text-slate-600 font-medium">
                        <li><i class="fas fa-check text-brand-600 mr-2"></i> Proses Cepat & Mudah</li>
                        <li><i class="fas fa-check text-brand-600 mr-2"></i> Jaminan Visa Approved</li>
                    </ul>
                    <a href="#" class="text-xs font-bold text-slate-900 hover:text-brand-600 mt-auto">Pelajari Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Section -->
    <section id="testimoni" class="py-20 bg-[#F8FDF9]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Testimoni Jamaah</h2>
                <p class="text-slate-500 text-sm">Pengalaman nyata dari ribuan jamaah yang telah menunaikan ibadah <br>umrah bersama kami</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testi 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 flex flex-col">
                    <div class="text-yellow-400 mb-4 text-sm flex gap-1"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="text-slate-600 text-sm leading-relaxed mb-8 flex-1">"Alhamdulillah pengalaman umrah yang luar biasa. Pelayanan sangat memuaskan, hotel dekat dengan Masjidil Haram dan pembimbing sangat membantu."</p>
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
                    <p class="text-slate-600 text-sm leading-relaxed mb-8 flex-1">"Paket keluarga sangat recomended! Anak-anak juga merasa nyaman. Semua sudah diatur dengan baik, tinggal berangkat dan ibadah."</p>
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
                    <p class="text-slate-600 text-sm leading-relaxed mb-8 flex-1">"Harga terjangkau dengan fasilitas yang sangat baik. Tim sangat profesional dan responsif. Terima kasih Imadinah Haromain."</p>
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

    <!-- Footer CTA Block -->
    <section class="bg-brand-600 py-16 px-6 text-center">
        <div class="max-w-4xl mx-auto">
            <h3 class="text-3xl md:text-4xl font-bold mb-4 text-white">Siap Berangkat Umrah?</h3>
            <p class="mb-10 text-[#E8F5E9] text-sm">Wujudkan impian ibadah umrah Anda bersama kami. Dapatkan konsultasi gratis dan penawara terbaik!</p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-lg mx-auto mb-8">
                <input type="email" placeholder="nama@gmail.com" class="px-6 py-4 rounded-full text-slate-800 flex-1 focus:outline-none text-sm">
                <button class="px-8 py-4 bg-white text-brand-600 font-bold rounded-full hover:bg-slate-100 transition shadow-md whitespace-nowrap text-sm">
                    Konsultasi Gratis
                </button>
            </div>
            <p class="text-sm text-white">Atau hubingi kami di WhatsApp <span class="font-bold">+62 821-3581-0572</span></p>
        </div>
    </section>

    <!-- Main Footer (LOGIC ASLI DIPERTAHANKAN) -->
    <footer class="bg-[#1A1A1A] text-white py-16 px-6 border-t border-slate-800">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <div>
                <div class="flex items-center space-x-2 mb-6">
                    <div class="text-yellow-500 text-2xl">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div class="leading-tight">
                        <span class="text-lg font-bold block text-white">Imadinah Hromain</span>
                        <span class="text-[10px] font-semibold tracking-widest text-slate-400 uppercase">Tour & Travel</span>
                    </div>
                </div>
            </div>
            
            <div>
                <h5 class="font-bold text-lg mb-6 text-white">Perusahaan</h5>
                <ul class="space-y-4 text-sm text-slate-400">
                    <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-white transition">Legalitas</a></li>
                    <li><a href="#" class="hover:text-white transition">Tim Kami</a></li>
                </ul>
            </div>
            
            <div>
                <h5 class="font-bold text-lg mb-6 text-white">Layanan</h5>
                <ul class="space-y-4 text-sm text-slate-400">
                    <li><a href="#" class="hover:text-white transition">Umrah Reguler</a></li>
                    <li><a href="#" class="hover:text-white transition">Umrah Plus</a></li>
                    <li><a href="#" class="hover:text-white transition">Haji Khusus</a></li>
                </ul>
            </div>
            
            <div>
                <h5 class="font-bold text-lg mb-6 text-white">Kontak</h5>
                <ul class="space-y-4 text-sm text-slate-400">
                    <li><a href="#" class="hover:text-white transition">Bantuan Layanan</a></li>
                    <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                    <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                </ul>
            </div>
        </div>
        
        <!-- LOGIC TAHUN & NAMA APP -->
        <div class="max-w-7xl mx-auto mt-16 pt-8 border-t border-slate-800 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </footer>

</body>
</html>