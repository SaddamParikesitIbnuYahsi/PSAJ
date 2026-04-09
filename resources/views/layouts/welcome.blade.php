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

        /* Animasi Melayang */
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(1deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }

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
            
            <!-- LOGO DINAMIS NAVBAR -->
            <div class="flex items-center space-x-3">
                @if(config('app.logo'))
                    <img src="{{ asset('storage/' . config('app.logo')) }}" alt="Logo" class="h-12 w-auto object-contain">
                @else
                    <div class="w-10 h-10 bg-brand-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-green-100">
                        <i class="fas fa-kaaba text-xl"></i>
                    </div>
                @endif
                <span class="text-xl font-extrabold tracking-tight text-brand-800 uppercase"></span>
            </div>
            
            <div class="hidden md:flex items-center space-x-10 text-sm font-semibold text-slate-600 uppercase tracking-wider">
                <a href="#beranda" class="hover:text-brand-600 transition">Beranda</a>
                <a href="#keunggulan" class="hover:text-brand-600 transition">Keunggulan</a>
                <a href="#paket" class="hover:text-brand-600 transition">Paket Umrah</a>
                <a href="#testimoni" class="hover:text-brand-600 transition">Testimoni</a>
            </div>

            <div class="flex items-center space-x-4">
                <button onclick="toggleModal(true)" class="bg-brand-600 text-white px-6 py-3 rounded-full text-sm font-bold shadow-lg shadow-green-200 hover:bg-brand-700 transition transform hover:-translate-y-1">
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
            </div>

            <div class="relative group">
                <div class="absolute -top-10 -right-10 w-72 h-72 bg-brand-200 rounded-full blur-3xl opacity-40"></div>
                <div class="relative z-10 animate-float hover-tilt rounded-[3.5rem] overflow-hidden shadow-2xl border-[12px] border-white cursor-pointer bg-white rotate-2 hover:rotate-0 transition duration-500">
                    <img src="https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?auto=format&fit=crop&w=1000&q=80" 
                         alt="Ibadah" 
                         class="w-full h-[500px] object-cover transition duration-700 group-hover:scale-105">
                </div>
            </div>
        </div>
    </section>

    <!-- Statistik -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-10 text-center">
            <div>
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
            <div class="text-center max-w-2xl mx-auto mb-20">
                <h2 class="text-brand-600 font-black uppercase tracking-[0.3em] text-xs mb-4">Mengapa Memilih Kami</h2>
                <p class="text-4xl font-black tracking-tight text-slate-900 leading-tight">Pelayanan Terbaik untuk Ibadah yang Maksimal</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-12 rounded-[3rem] bg-white border border-slate-100 hover:shadow-2xl transition duration-500 group text-left">
                    <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-brand-600 transition duration-500">
                        <i class="fas fa-user-shield text-brand-600 text-2xl group-hover:text-white"></i>
                    </div>
                    <h3 class="text-2xl font-black mb-4">Keamanan Terjamin</h3>
                    <p class="text-slate-500 text-sm leading-relaxed italic">Legalitas resmi PPIU memastikan keberangkatan Anda aman tanpa rasa khawatir dari awal hingga akhir.</p>
                </div>
                <div class="p-12 rounded-[3rem] bg-white border border-slate-100 hover:shadow-2xl transition duration-500 group text-left">
                    <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-brand-600 transition duration-500">
                        <i class="fas fa-mosque text-brand-600 text-2xl group-hover:text-white"></i>
                    </div>
                    <h3 class="text-2xl font-black mb-4">Sesuai Sunnah</h3>
                    <p class="text-slate-500 text-sm leading-relaxed italic">Bimbingan manasik dan pendampingan ibadah yang teliti sesuai dengan tuntunan Rasulullah SAW.</p>
                </div>
                <div class="p-12 rounded-[3rem] bg-white border border-slate-100 hover:shadow-2xl transition duration-500 group text-left">
                    <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-brand-600 transition duration-500">
                        <i class="fas fa-shield-heart text-brand-600 text-2xl group-hover:text-white"></i>
                    </div>
                    <h3 class="text-2xl font-black mb-4">Uang Kembali</h3>
                    <p class="text-slate-500 text-sm leading-relaxed italic">Garansi keberangkatan 100% atau uang Anda kembali tanpa potongan jika terjadi kegagalan sistem.</p>
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
                <div class="bg-slate-50 rounded-[2.5rem] p-4 group hover:bg-brand-50 transition duration-500 text-center">
                    <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=600&q=80" class="w-full h-64 object-cover rounded-[2.2rem] mb-6">
                    <div class="p-4">
                        <h4 class="text-2xl font-black mb-2 uppercase">Paket Reguler</h4>
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest italic mb-6">Mulai 25jt-an</p>
                        <button onclick="toggleModal(true)" class="w-full py-4 bg-slate-900 text-white font-bold rounded-2xl hover:bg-brand-600 transition uppercase text-xs tracking-widest">Detail Paket</button>
                    </div>
                </div>
                <div class="bg-slate-50 rounded-[2.5rem] p-4 group hover:bg-brand-50 transition duration-500 transform lg:-translate-y-4 shadow-2xl text-center">
                    <img src="https://images.unsplash.com/photo-1565552645632-d725f8bfc19a?auto=format&fit=crop&w=600&q=80" class="w-full h-64 object-cover rounded-[2.2rem] mb-6">
                    <div class="p-4">
                        <h4 class="text-2xl font-black mb-2 text-brand-700 uppercase">VIP Premium</h4>
                        <p class="text-sm font-bold text-brand-600 uppercase tracking-widest italic mb-6">Mulai 35jt-an</p>
                        <button onclick="toggleModal(true)" class="w-full py-4 bg-brand-600 text-white font-bold rounded-2xl hover:bg-brand-700 transition shadow-lg uppercase text-xs tracking-widest">Detail Paket</button>
                    </div>
                </div>
                <div class="bg-slate-50 rounded-[2.5rem] p-4 group hover:bg-brand-50 transition duration-500 text-center">
                    <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=600&q=80" class="w-full h-64 object-cover rounded-[2.2rem] mb-6">
                    <div class="p-4">
                        <h4 class="text-2xl font-black mb-2 uppercase">Paket Keluarga</h4>
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest italic mb-6">Mulai 40jt-an</p>
                        <button onclick="toggleModal(true)" class="w-full py-4 bg-slate-900 text-white font-bold rounded-2xl hover:bg-brand-600 transition uppercase text-xs tracking-widest">Detail Paket</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni -->
    <section id="testimoni" class="py-24 bg-slate-50/50">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-xs font-black uppercase tracking-[0.4em] text-brand-600 mb-4">Suara Hati Jamaah</h2>
            <p class="text-4xl font-black text-slate-900 tracking-tighter mb-20">Apa Kata Mereka?</p>
            <div class="grid md:grid-cols-3 gap-8 text-left">
                <div class="p-10 rounded-[2.5rem] bg-white border border-slate-100 hover:shadow-2xl transition duration-500 relative italic">
                    <i class="fas fa-quote-left text-brand-50 text-6xl absolute top-6 left-6 opacity-50"></i>
                    <p class="relative z-10 text-slate-600 mb-10 leading-relaxed font-medium">"Alhamdulillah, bimbingan manasiknya sangat detail dan sesuai Sunnah. Kamar hotel sangat dekat, sangat memudahkan ibadah saya."</p>
                    <p class="text-sm font-black text-slate-800 uppercase tracking-tighter">- Hj. Siti Aminah</p>
                </div>
                <div class="p-10 rounded-[2.5rem] bg-white border border-slate-100 hover:shadow-2xl transition duration-500 relative italic">
                    <i class="fas fa-quote-left text-brand-50 text-6xl absolute top-6 left-6 opacity-50"></i>
                    <p class="relative z-10 text-slate-600 mb-10 leading-relaxed font-medium">"Transparan dari awal daftar sampai pulang. Fasilitas VIP-nya benar-benar berkualitas dan muthawifnya sangat ramah."</p>
                    <p class="text-sm font-black text-slate-800 uppercase tracking-tighter">- Bpk. Ahmad Fauzi</p>
                </div>
                <div class="p-10 rounded-[2.5rem] bg-white border border-slate-100 hover:shadow-2xl transition duration-500 relative italic">
                    <i class="fas fa-quote-left text-brand-50 text-6xl absolute top-6 left-6 opacity-50"></i>
                    <p class="relative z-10 text-slate-600 mb-10 leading-relaxed font-medium">"Admin sangat responsif menjawab pertanyaan saya. Perlengkapan umrahnya premium dan eksklusif. Terima kasih Al Madinah."</p>
                    <p class="text-sm font-black text-slate-800 uppercase tracking-tighter">- Ibu Rahmawati</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER MEDSOS -->
    <footer class="bg-white border-t border-slate-100 pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-20 text-left">
                
                <!-- BRAND DENGAN LOGO DINAMIS -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-3">
                        @if(config('app.logo'))
                            <img src="{{ asset('storage/' . config('app.logo')) }}" alt="Logo" class="h-10 w-auto">
                        @else
                            <div class="w-10 h-10 bg-brand-600 rounded-xl flex items-center justify-center text-white">
                                <i class="fas fa-kaaba text-xl"></i>
                            </div>
                        @endif
                        <span class="text-xl font-black tracking-tighter text-slate-800 uppercase"></span>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed italic">
                        Biro perjalanan Umrah resmi yang mengedepankan keamanan dan bimbingan sesuai tuntunan Sunnah Rasulullah SAW.
                    </p>
                </div>

                <div>
                    <h5 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-800 mb-10 border-l-4 border-brand-600 pl-3">Navigasi</h5>
                    <ul class="space-y-4 text-xs font-bold text-slate-400 uppercase tracking-widest">
                        <li><a href="#beranda" class="hover:text-brand-600 transition">Beranda</a></li>
                        <li><a href="#keunggulan" class="hover:text-brand-600 transition">Keunggulan</a></li>
                        <li><a href="#paket" class="hover:text-brand-600 transition">Paket Program</a></li>
                        <li><a href="#testimoni" class="hover:text-brand-600 transition">Testimoni</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-800 mb-10 border-l-4 border-brand-600 pl-3">Hubungi Kami</h5>
                    <ul class="space-y-5 text-sm font-bold text-slate-500">
                        <li class="flex items-start gap-3 italic">
                            <i class="fas fa-map-marker-alt text-brand-600 mt-1"></i>
                            <span>Jakarta Pusat, DKI Jakarta, Indonesia</span>
                        </li>
                        <li class="flex items-center gap-3 font-black">
                            <i class="fas fa-phone-alt text-brand-600"></i>
                            <span>+62 878-7418-4220</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h5 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-800 mb-10 border-l-4 border-brand-600 pl-3">Ikuti Kami</h5>
                    <div class="flex items-center gap-4">
                        <a href="https://instagram.com" target="_blank" class="w-12 h-12 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center text-xl hover:bg-brand-600 hover:text-white transition shadow-sm">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://wa.me/6287874184220" target="_blank" class="w-12 h-12 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center text-xl hover:bg-brand-600 hover:text-white transition shadow-sm">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://linkedin.com" target="_blank" class="w-12 h-12 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center text-xl hover:bg-brand-600 hover:text-white transition shadow-sm">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-50 text-center">
                <p class="text-[10px] font-bold text-slate-300 uppercase tracking-[0.4em]">
                    &copy; {{ date('Y') }} Al Madinah Haromain | Penyelenggara Perjalanan Ibadah Umrah Resmi
                </p>
            </div>
        </div>
    </footer>

    <!-- MODAL LOGIN (Logic Asli) -->
    <div id="loginModal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm modal-overlay" onclick="toggleModal(false)"></div>
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white w-full max-w-md rounded-[2.5rem] p-10 shadow-2xl relative z-10 transform scale-95 opacity-0 modal-content">
                <button onclick="toggleModal(false)" class="absolute top-8 right-8 text-slate-300 hover:text-slate-600 transition"><i class="fas fa-times text-xl"></i></button>
                <div class="text-center mb-10">
                    <div class="w-16 h-16 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center mx-auto mb-4"><i class="fas fa-user-circle text-3xl"></i></div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2 tracking-tight uppercase">Sudah punya akun?</h3>
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