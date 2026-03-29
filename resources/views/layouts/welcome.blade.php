<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
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
                            100: '#dcfce7',
                            600: '#16a34a', 
                            700: '#15803d',
                            800: '#166534',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* Efek Melayang Otomatis */
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(1deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        /* Efek Goyang/Miring Saat Hover */
        .hover-tilt {
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }
        .hover-tilt:hover {
            transform: perspective(1000px) rotateX(4deg) rotateY(-8deg) scale(1.02) !important;
            box-shadow: 0 40px 80px -15px rgba(22, 163, 74, 0.2);
        }

        .modal-overlay { transition: opacity 0.3s ease; }
        .modal-content { transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
    </style>
</head>
<body class="text-slate-900 bg-white antialiased">

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 glass-nav border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-brand-600 rounded-xl flex items-center justify-center text-white">
                    <i class="fas fa-kaaba text-xl"></i>
                </div>
                <span class="text-xl font-extrabold tracking-tight text-brand-800 uppercase">Al Madinah</span>
            </div>
            
            <div class="hidden md:flex items-center space-x-10 text-sm font-semibold text-slate-600 uppercase tracking-wider">
                <a href="#beranda" class="hover:text-brand-600 transition">Beranda</a>
                <a href="#keunggulan" class="hover:text-brand-600 transition">Keunggulan</a>
                <a href="#paket" class="hover:text-brand-600 transition">Paket Umrah</a>
                <a href="#testimoni" class="hover:text-brand-600 transition">Testimoni</a>
            </div>

            <div class="flex items-center space-x-4">
                <button onclick="toggleModal(true)" class="bg-brand-600 text-white px-6 py-3 rounded-full text-sm font-bold shadow-lg shadow-green-200 hover:bg-brand-700 transition transform hover:-translate-y-1"">
                    Masuk
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="pt-44 pb-24 px-6 overflow-hidden bg-gradient-to-b from-brand-50 to-white relative">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-brand-100 rounded-full shadow-sm mb-6">
                    <span class="flex h-2 w-2 rounded-full bg-brand-600 animate-pulse"></span>
                    <span class="text-xs font-bold text-brand-700 uppercase tracking-widest">PPIU Resmi Kemenag RI</span>
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 leading-[1.1] mb-8 tracking-tighter">
                    Wujudkan Niat Suci Menuju <span class="text-brand-600">Baitullah</span>
                </h1>
                <p class="text-slate-500 text-lg mb-10 leading-relaxed max-w-lg italic">
                    Rasakan pengalaman ibadah Umrah yang tenang, nyaman, dan terbimbing sesuai Sunnah. Layanan sepenuh hati untuk tamu Allah.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 mb-12">
                    <button onclick="toggleModal(true)" class="px-8 py-4 bg-brand-600 text-white font-bold rounded-2xl shadow-xl shadow-green-200 hover:bg-brand-700 transition text-center uppercase text-xs tracking-widest transform hover:scale-105">
                        Lihat Paket Sekarang
                    </button>
                    <a href="https://wa.me/6287874184220" class="px-8 py-4 bg-white text-slate-700 font-bold rounded-2xl shadow-md border border-slate-100 hover:bg-slate-50 transition text-center flex items-center justify-center gap-2 uppercase text-xs tracking-widest">
                        <i class="fab fa-whatsapp text-green-500 text-xl"></i> Tanya Admin
                    </a>
                </div>

                <div class="flex items-center gap-8 grayscale opacity-70 text-slate-600">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-brand-600"></i>
                        <span class="text-sm font-bold uppercase tracking-tighter">Resmi PPIU</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-users text-brand-600"></i>
                        <span class="text-sm font-bold uppercase tracking-tighter">100+ Jamaah</span>
                    </div>
                </div>
            </div>

            <!-- Bagian Gambar dengan Efek Request (Goyang & Melayang) -->
            <div class="relative group">
                <div class="absolute -top-10 -right-10 w-72 h-72 bg-brand-200 rounded-full blur-3xl opacity-40 group-hover:opacity-60 transition duration-700"></div>
                
                <div class="relative z-10 animate-float hover-tilt rounded-[3.5rem] overflow-hidden shadow-2xl border-[12px] border-white cursor-pointer bg-white rotate-2 hover:rotate-0 transition duration-500">
                    <img src="https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?auto=format&fit=crop&w=1000&q=80" 
                         alt="Ibadah" 
                         class="w-full h-[500px] object-cover transform transition duration-700 group-hover:scale-105">
                </div>

                <!-- Floating Badge -->
                <div class="absolute -bottom-8 -left-8 bg-white p-5 rounded-3xl shadow-2xl flex items-center gap-4 border border-slate-50 z-20 transform group-hover:-translate-y-3 transition-transform duration-500">
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
    <section id="keunggulan" class="py-24 bg-slate-50/50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-brand-600 font-bold uppercase tracking-widest text-sm mb-4">Mengapa Memilih Kami</h2>
                <p class="text-3xl md:text-4xl font-extrabold tracking-tight">Pelayanan Terbaik untuk Ibadah yang Maksimal</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8 text-left">
                <div class="p-10 rounded-[2.5rem] bg-white border border-slate-100 hover:shadow-xl transition duration-300">
                    <i class="fas fa-user-shield text-brand-600 text-3xl mb-6"></i>
                    <h3 class="text-xl font-bold mb-4">Keamanan Terjamin</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Legalitas resmi PPIU memastikan keberangkatan Anda aman tanpa rasa khawatir.</p>
                </div>
                <div class="p-10 rounded-[2.5rem] bg-white border border-slate-100 hover:shadow-xl transition duration-300">
                    <i class="fas fa-mosque text-brand-600 text-3xl mb-6"></i>
                    <h3 class="text-xl font-bold mb-4">Sesuai Sunnah</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Bimbingan manasik dan pendampingan ibadah yang teliti sesuai tuntunan Nabi SAW.</p>
                </div>
                <div class="p-10 rounded-[2.5rem] bg-white border border-slate-100 hover:shadow-xl transition duration-300">
                    <i class="fas fa-shield-heart text-brand-600 text-3xl mb-6"></i>
                    <h3 class="text-xl font-bold mb-4">Uang Kembali</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Garansi keberangkatan 100% atau uang Anda kembali tanpa potongan jika gagal berangkat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Paket Umrah -->
    <section id="paket" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-black mb-4 tracking-tighter uppercase">Program Pilihan</h2>
                <p class="text-slate-500 italic">Harga All-In, Tanpa Biaya Tambahan di Belakang</p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Paket 1 -->
                <div class="bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 p-2 group hover:shadow-2xl transition duration-500">
                    <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=600&q=80" class="w-full h-64 object-cover rounded-[2.2rem] group-hover:scale-105 transition duration-500">
                    <div class="p-8">
                        <h4 class="text-2xl font-black mb-2">Paket Reguler</h4>
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest italic mb-6">Mulai 25jt-an</p>
                        <button onclick="toggleModal(true)" class="w-full py-4 bg-slate-900 text-white font-bold rounded-2xl hover:bg-brand-600 transition">Detail Paket</button>
                    </div>
                </div>

                <!-- Paket 2 -->
                <div class="bg-white rounded-[2.5rem] overflow-hidden border-2 border-brand-600 p-2 group hover:shadow-2xl transition duration-500 transform lg:-translate-y-4">
                    <img src="https://images.unsplash.com/photo-1565552645632-d725f8bfc19a?auto=format&fit=crop&w=600&q=80" class="w-full h-64 object-cover rounded-[2.2rem] group-hover:scale-105 transition duration-500">
                    <div class="p-8">
                        <h4 class="text-2xl font-black mb-2">Paket VIP Premium</h4>
                        <p class="text-sm font-bold text-brand-600 uppercase tracking-widest italic mb-6">Mulai 35jt-an</p>
                        <button onclick="toggleModal(true)" class="w-full py-4 bg-brand-600 text-white font-bold rounded-2xl hover:bg-brand-700 transition shadow-lg">Detail Paket</button>
                    </div>
                </div>

                <!-- Paket 3 -->
                <div class="bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 p-2 group hover:shadow-2xl transition duration-500">
                    <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=600&q=80" class="w-full h-64 object-cover rounded-[2.2rem] group-hover:scale-105 transition duration-500">
                    <div class="p-8">
                        <h4 class="text-2xl font-black mb-2">Paket Keluarga</h4>
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest italic mb-6">Mulai 40jt-an</p>
                        <button onclick="toggleModal(true)" class="w-full py-4 bg-slate-900 text-white font-bold rounded-2xl hover:bg-brand-600 transition">Detail Paket</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni -->
    <section id="testimoni" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4 tracking-tight uppercase">Apa Kata Jamaah?</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-8 text-left">
                <div class="p-8 rounded-[2rem] bg-white shadow-sm italic relative">
                    <i class="fas fa-quote-left text-brand-100 text-5xl absolute top-6 left-6"></i>
                    <p class="relative z-10 text-slate-600 mb-8 mt-4 leading-relaxed">"Alhamdulillah, bimbingan sesuai Sunnah. Kamar hotel dekat Masjidil Haram. Sangat direkomendasikan."</p>
                    <p class="text-sm font-bold text-slate-800 tracking-tighter uppercase">- Hj. Siti Aminah, Jakarta</p>
                </div>
                <div class="p-8 rounded-[2rem] bg-white shadow-sm italic relative">
                    <i class="fas fa-quote-left text-brand-100 text-5xl absolute top-6 left-6"></i>
                    <p class="relative z-10 text-slate-600 mb-8 mt-4 leading-relaxed">"Transparan dari awal pendaftaran. Fasilitas VIP-nya benar-benar berkualitas. Terima kasih Al Madinah."</p>
                    <p class="text-sm font-bold text-slate-800 tracking-tighter uppercase">- Bpk. Ahmad Fauzi, Surabaya</p>
                </div>
                <div class="p-8 rounded-[2rem] bg-white shadow-sm italic relative">
                    <i class="fas fa-quote-left text-brand-100 text-5xl absolute top-6 left-6"></i>
                    <p class="relative z-10 text-slate-600 mb-8 mt-4 leading-relaxed">"Proses cepat dan adminnya sangat responsif. Perlengkapan umrahnya premium dan eksklusif."</p>
                    <p class="text-sm font-bold text-slate-800 tracking-tighter uppercase">- Ibu Rahmawati, Bandung</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-20 px-6">
        <div class="max-w-6xl mx-auto rounded-[3rem] bg-brand-800 p-12 md:p-24 text-center shadow-2xl relative overflow-hidden">
            <div class="relative z-10">
                <h3 class="text-4xl md:text-5xl font-black text-white mb-6 tracking-tighter">Siap Menuju Tanah Suci?</h3>
                <p class="text-brand-100 mb-12 text-lg max-w-xl mx-auto italic">Daftarkan akun Anda hari ini untuk mendapatkan kemudahan pendaftaran dan informasi jadwal keberangkatan terupdate.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('register') }}" class="px-10 py-5 bg-white text-brand-800 font-bold rounded-full shadow-xl hover:bg-slate-50 transition uppercase text-xs tracking-widest">Daftar Akun Sekarang</a>
                    <button onclick="toggleModal(true)" class="px-10 py-5 bg-brand-700 text-white font-bold rounded-full border border-brand-600 hover:bg-brand-600 transition uppercase text-xs tracking-widest">Masuk Ke Member Area</button>
                </div>
            </div>
            <i class="fas fa-kaaba absolute -right-20 -bottom-20 text-[20rem] text-white/5 rotate-12"></i>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="flex justify-center items-center space-x-2 mb-6">
                <div class="text-brand-600 text-xl"><i class="fas fa-kaaba"></i></div>
                <span class="font-extrabold text-slate-800 tracking-tighter uppercase">Al Madinah Haromain</span>
            </div>
            <p class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.3em]">&copy; 2024 Al Madinah Haromain | Penyelenggara Umrah Resmi</p>
        </div>
    </footer>

    <!-- MODAL LOGIN (LOGIKA ASLI) -->
    <div id="loginModal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm modal-overlay" onclick="toggleModal(false)"></div>
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white w-full max-w-md rounded-[2.5rem] p-10 shadow-2xl relative z-10 transform scale-95 opacity-0 modal-content">
                <button onclick="toggleModal(false)" class="absolute top-8 right-8 text-slate-300 hover:text-slate-600 transition"><i class="fas fa-times text-xl"></i></button>
                <div class="text-center mb-10">
                    <div class="w-16 h-16 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center mx-auto mb-4"><i class="fas fa-user-circle text-3xl"></i></div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2 tracking-tight">Sudah punya akun?</h3>
                    <p class="text-slate-500 text-sm italic">Masuk untuk melihat paket & memesan</p>
                </div>
                <div class="space-y-4">
                    <a href="{{ route('login') }}" class="flex items-center justify-between w-full p-5 bg-brand-600 text-white rounded-2xl hover:bg-brand-700 transition group shadow-lg">
                        <span class="font-bold uppercase text-xs tracking-widest">Ya, Masuk Sekarang</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition"></i>
                    </a>
                    <a href="https://wa.me/6287874184220" target="_blank" class="flex items-center justify-between w-full p-5 bg-slate-50 border border-slate-100 text-slate-800 rounded-2xl hover:border-brand-600 transition group">
                        <span class="font-bold uppercase text-xs tracking-widest text-slate-500">Belum Memiliki Akun</span>
                        <i class="fab fa-whatsapp text-2xl text-emerald-500"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT MODAL (LOGIKA ASLI) -->
    <script>
        function toggleModal(show) {
            const modal = document.getElementById('loginModal');
            const content = modal.querySelector('.modal-content');
            if (show) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.querySelector('.modal-overlay').classList.add('opacity-100');
                    content.classList.remove('scale-95', 'opacity-0'); 
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);
            } else {
                modal.querySelector('.modal-overlay').classList.remove('opacity-100');
                content.classList.remove('scale-100', 'opacity-100'); 
                content.classList.add('scale-95', 'opacity-0');
                setTimeout(() => { modal.classList.add('hidden'); }, 300);
            }
        }
    </script>
</body>
</html>