<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Al Madinah Haromain | Perjalanan Umrah Amanah & Sesuai Sunnah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            600: '#158A33', 
                            700: '#106c27',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #ffffff; }
        .modal-overlay { transition: opacity 0.3s ease; }
        .modal-content { transition: transform 0.3s ease; }
    </style>
</head>
<body class="text-slate-800 overflow-x-hidden antialiased">

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="text-brand-600 text-2xl"><i class="fas fa-kaaba"></i></div>
                <span class="text-xl font-extrabold text-slate-800 tracking-tighter uppercase">Al Madinah</span>
            </div>
            
            <div class="hidden md:flex items-center space-x-8 text-sm font-bold uppercase tracking-widest text-slate-500">
                <a href="#" class="text-brand-600">Beranda</a>
                <a href="#tentang" class="hover:text-brand-600 transition">Mengapa Kami</a>
                <a href="#paket" class="hover:text-brand-600 transition">Paket</a>
                <a href="#testimoni" class="hover:text-brand-600 transition">Testimoni</a>
            </div>

            <div class="flex items-center space-x-3">
                <button onclick="toggleModal(true)" class="text-sm font-bold text-slate-600 hover:text-brand-600 px-4">Masuk</button>
                <a href="{{ route('register') }}" class="bg-brand-600 text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-lg shadow-green-100 hover:bg-brand-700 transition">
                    Daftar Akun
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-44 pb-24 px-6 bg-gradient-to-b from-brand-50 to-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
            <div class="relative z-10">
                <span class="inline-block px-4 py-1.5 bg-white border border-brand-100 text-brand-700 rounded-full text-[10px] font-black uppercase tracking-[0.2em] mb-6 shadow-sm">
                    🕋 PPIU Resmi & Terpercaya
                </span>
                <h1 class="text-5xl md:text-7xl font-black text-slate-900 leading-[1.1] mb-8 tracking-tighter">
                    Wujudkan Niat Suci Menuju <span class="text-brand-600">Baitullah</span>
                </h1>
                <p class="text-slate-500 text-lg mb-10 leading-relaxed max-w-md">
                    Rasakan pengalaman ibadah Umrah yang tenang, nyaman, dan terbimbing sesuai Sunnah. Layanan sepenuh hati untuk tamu Allah.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <button onclick="toggleModal(true)" class="px-10 py-4 bg-brand-600 text-white font-bold rounded-full shadow-xl shadow-green-200 hover:bg-brand-700 transition transform hover:scale-105 uppercase text-xs tracking-widest">
                        Lihat Paket Sekarang
                    </button>
                    <a href="https://wa.me/6287874184220" class="px-10 py-4 bg-white text-slate-700 font-bold rounded-full shadow-md border border-slate-100 hover:bg-slate-50 transition uppercase text-xs tracking-widest text-center">
                        Tanya Admin
                    </a>
                </div>
            </div>

            <div class="relative">
                <div class="rounded-[3rem] overflow-hidden shadow-2xl border-[12px] border-white rotate-2 hover:rotate-0 transition duration-500">
                    <img src="https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?auto=format&fit=crop&w=1000&q=80" alt="Ibadah" class="w-full h-auto">
                </div>
                <!-- Badge Melayang -->
                <div class="absolute -bottom-6 -left-6 bg-white p-5 rounded-3xl shadow-2xl flex items-center gap-4 border border-slate-50">
                    <div class="w-12 h-12 bg-brand-600 text-white rounded-2xl flex items-center justify-center text-xl shadow-lg shadow-green-200">
                        <i class="fas fa-award"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase text-slate-400 leading-none mb-1">Akreditasi</p>
                        <p class="text-base font-bold text-slate-800 tracking-tight">Grade A Resmi Kemenag</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistik -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-10">
            <div class="text-center">
                <p class="text-4xl font-black text-brand-600 mb-2">100+</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jamaah Terlayani</p>
            </div>
            <div class="text-center border-l border-slate-100">
                <p class="text-4xl font-black text-brand-600 mb-2">100%</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Keberangkatan Sukses</p>
            </div>
            <div class="text-center border-l border-slate-100">
                <p class="text-4xl font-black text-brand-600 mb-2">5.0</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Rating Kepuasan</p>
            </div>
            <div class="text-center border-l border-slate-100">
                <p class="text-4xl font-black text-brand-600 mb-2">Resmi</p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Berizin Kemenag</p>
            </div>
        </div>
    </section>

    <!-- Mengapa Memilih Kami -->
    <section id="tentang" class="py-24 bg-slate-50/50">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-3 gap-12">
            <div class="lg:col-span-1">
                <h2 class="text-4xl font-black text-slate-900 tracking-tighter mb-6 leading-tight">Keutamaan Beribadah Bersama Kami</h2>
                <p class="text-slate-500 mb-8 leading-relaxed">Kami memastikan setiap langkah ibadah Anda bernilai pahala dengan fasilitas yang mendukung kekhusyukan.</p>
                <button onclick="toggleModal(true)" class="text-brand-600 font-bold flex items-center gap-2 hover:gap-4 transition-all">
                    Pelajari Keunggulan Kami <i class="fas fa-arrow-right"></i>
                </button>
            </div>
            <div class="lg:col-span-2 grid md:grid-cols-2 gap-6">
                <div class="p-8 bg-white rounded-3xl shadow-sm border border-slate-100">
                    <i class="fas fa-user-shield text-brand-600 text-2xl mb-6"></i>
                    <h5 class="text-lg font-black mb-3">Keamanan Terjamin</h5>
                    <p class="text-sm text-slate-500 leading-relaxed">Legalitas resmi PPIU memastikan keberangkatan Anda aman tanpa rasa khawatir.</p>
                </div>
                <div class="p-8 bg-white rounded-3xl shadow-sm border border-slate-100">
                    <i class="fas fa-mosque text-brand-600 text-2xl mb-6"></i>
                    <h5 class="text-lg font-black mb-3">Sesuai Sunnah</h5>
                    <p class="text-sm text-slate-500 leading-relaxed">Bimbingan manasik dan pendampingan ibadah yang teliti sesuai tuntunan Nabi SAW.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Teaser Paket -->
    <section id="paket" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-black text-slate-900 mb-4 tracking-tighter uppercase">Program Pilihan</h2>
                <p class="text-slate-500 text-sm italic">Silakan login untuk memesan dan melihat detail fasilitas lengkap</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Paket Simple -->
                <div class="group relative bg-white border border-slate-100 p-2 rounded-[2.5rem] shadow-sm hover:shadow-xl transition duration-500">
                    <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=600&q=80" class="w-full h-64 object-cover rounded-[2.2rem] mb-6">
                    <div class="p-6">
                        <h4 class="text-xl font-black mb-4">Paket Reguler Ekonomi</h4>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest italic">Mulai 25jt-an</p>
                            <button onclick="toggleModal(true)" class="w-12 h-12 bg-slate-900 text-white rounded-full flex items-center justify-center hover:bg-brand-600 transition"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
                <!-- Paket Simple 2 -->
                <div class="group relative bg-white border border-slate-100 p-2 rounded-[2.5rem] shadow-sm hover:shadow-xl transition duration-500 transform md:-translate-y-4">
                    <img src="https://images.unsplash.com/photo-1565552645632-d725f8bfc19a?auto=format&fit=crop&w=600&q=80" class="w-full h-64 object-cover rounded-[2.2rem] mb-6">
                    <div class="p-6">
                        <h4 class="text-xl font-black mb-4">Paket VIP Premium</h4>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest italic">Mulai 35jt-an</p>
                            <button onclick="toggleModal(true)" class="w-12 h-12 bg-brand-600 text-white rounded-full flex items-center justify-center hover:scale-110 transition shadow-lg"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
                <!-- Paket Simple 3 -->
                <div class="group relative bg-white border border-slate-100 p-2 rounded-[2.5rem] shadow-sm hover:shadow-xl transition duration-500">
                    <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=600&q=80" class="w-full h-64 object-cover rounded-[2.2rem] mb-6">
                    <div class="p-6">
                        <h4 class="text-xl font-black mb-4">Paket Keluarga Khusus</h4>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest italic">Mulai 40jt-an</p>
                            <button onclick="toggleModal(true)" class="w-12 h-12 bg-slate-900 text-white rounded-full flex items-center justify-center hover:bg-brand-600 transition"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer CTA -->
    <section class="p-6 md:p-12">
        <div class="max-w-6xl mx-auto rounded-[3rem] bg-brand-600 p-12 md:p-24 text-center shadow-2xl relative overflow-hidden">
            <div class="relative z-10">
                <h3 class="text-4xl md:text-5xl font-black text-white mb-6 tracking-tighter">Siap Menuju Tanah Suci?</h3>
                <p class="text-brand-50 mb-12 text-lg opacity-90 max-w-xl mx-auto italic">Daftarkan akun Anda hari ini untuk mendapatkan kemudahan pendaftaran dan informasi jadwal keberangkatan terupdate.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('register') }}" class="px-12 py-5 bg-white text-brand-700 font-black rounded-full shadow-xl hover:bg-slate-50 transition uppercase text-xs tracking-widest">Daftar Akun Sekarang</a>
                    <button onclick="toggleModal(true)" class="px-12 py-5 bg-brand-700 text-white font-black rounded-full hover:bg-brand-800 transition uppercase text-xs tracking-widest">Masuk ke Member Area</button>
                </div>
            </div>
            <i class="fas fa-kaaba absolute -right-20 -bottom-20 text-[25rem] text-white/5 rotate-12"></i>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 text-center text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">
        &copy; {{ date('Y') }} Al Madinah Haromain | Penyelenggara Umrah Resmi
    </footer>

    <!-- MODAL LOGIN (Logic Asli) -->
    <div id="loginModal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm modal-overlay" onclick="toggleModal(false)"></div>
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white w-full max-w-md rounded-[2.5rem] p-10 shadow-2xl relative z-10 transform scale-95 modal-content">
                <button onclick="toggleModal(false)" class="absolute top-6 right-6 text-slate-300 hover:text-slate-600"><i class="fas fa-times"></i></button>
                <div class="text-center mb-10">
                    <div class="w-16 h-16 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center mx-auto mb-4"><i class="fas fa-user-circle text-2xl"></i></div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2 tracking-tight">Sudah punya akun?</h3>
                    <p class="text-slate-500 text-sm">Masuk untuk melihat paket & memesan</p>
                </div>
                <div class="space-y-4">
                    <a href="{{ route('login') }}" class="flex items-center justify-between w-full p-5 bg-brand-600 text-white rounded-2xl hover:bg-brand-700 transition group shadow-lg">
                        <span class="font-bold">Ya, Masuk Sekarang</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition"></i>
                    </a>
                    <a href="https://wa.me/6287874184220" target="_blank" class="flex items-center justify-between w-full p-5 bg-slate-50 border border-slate-100 text-slate-800 rounded-2xl hover:border-brand-600 transition group">
                        <span class="font-bold">Belum Memiliki Akun</span>
                        <i class="fab fa-whatsapp text-2xl text-emerald-500"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleModal(show) {
            const modal = document.getElementById('loginModal');
            const content = modal.querySelector('.modal-content');
            if (show) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.querySelector('.modal-overlay').classList.add('opacity-100');
                    content.classList.remove('scale-95'); content.classList.add('scale-100');
                }, 10);
            } else {
                modal.querySelector('.modal-overlay').classList.remove('opacity-100');
                content.classList.remove('scale-100'); content.classList.add('scale-95');
                setTimeout(() => { modal.classList.add('hidden'); }, 300);
            }
        }
    </script>
</body>
</html>