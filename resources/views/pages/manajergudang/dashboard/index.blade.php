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
                            600: '#158A33', 
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
    @endif

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 bg-white border-b border-slate-100 px-6 py-4 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <!-- LOGO DINAMIS NAVBAR (DIUBAH) -->
            <div class="flex items-center space-x-2">
                @if(config('app.logo'))
                    <img src="{{ asset('storage/' . config('app.logo')) }}" alt="Logo" class="h-10 w-auto object-contain">
                @else
                    <div class="text-brand-600 text-2xl">
                        <i class="fas fa-kaaba"></i>
                    </div>
                @endif
                <span class="text-lg font-bold text-slate-800 uppercase tracking-tighter">{{ config('app.name') }}</span>
            </div>
            
            <!-- Menu Navigasi -->
            <div class="hidden md:flex items-center space-x-8 text-sm font-semibold text-slate-600">
                <a href="#" class="text-slate-900">Beranda</a>
                <a href="#paket" class="hover:text-brand-600 transition">Paket</a>
                <a href="#fasilitas" class="hover:text-brand-600 transition">Fasilitas</a>
                <a href="#testimoni" class="hover:text-brand-600 transition">Testimoni</a>
                <a href="#kontak" class="hover:text-brand-600 transition">Kontak</a>
            </div>

            <!-- Bagian User & Logout -->
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
                    <span class="uppercase tracking-wider">Agent Terpercaya</span>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold text-slate-900 leading-tight mb-6">
                    Wujudkan Impian <br> <span class="text-brand-600">Umrah</span> Anda
                </h1>
                <p class="text-slate-500 text-base mb-8 leading-relaxed max-w-lg">
                    Nikmati pengalaman ibadah umrah yang nyaman dan khusyuk bersama kami. Paket lengkap dengan harga terjangkau dan pelayanan terbaik.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="https://wa.me/6287874184220?text=Halo%20Admin%20Al%20Madinah%2C%20saya%20ingin%20konsultasi%20mengenai%20rencana%20ibadah%20Umrah." 
                       target="_blank" 
                       class="inline-flex items-center justify-center px-10 py-5 bg-brand-600 text-white font-bold rounded-full shadow-xl shadow-green-100 hover:bg-brand-700 transition transform hover:scale-105 uppercase text-sm tracking-widest gap-3">
                        <i class="fab fa-whatsapp text-xl"></i> Konsultasi via WhatsApp
                    </a>
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
                        <p class="text-sm font-bold text-slate-800">Setiap 1-2 Bulan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-white border-b border-slate-100">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="w-14 h-14 bg-[#E8F5E9] text-brand-600 rounded-xl flex items-center justify-center mx-auto mb-4 text-2xl"><i class="fas fa-users"></i></div>
                <h4 class="text-3xl font-black text-slate-900">100+</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Jamaah Amanah</p>
            </div>
            <div>
                <div class="w-14 h-14 bg-[#E8F5E9] text-brand-600 rounded-xl flex items-center justify-center mx-auto mb-4 text-2xl"><i class="fas fa-plane-departure"></i></div>
                <h4 class="text-3xl font-black text-slate-900">100%</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Keberangkatan Sukses</p>
            </div>
            <div>
                <div class="w-14 h-14 bg-[#E8F5E9] text-brand-600 rounded-xl flex items-center justify-center mx-auto mb-4 text-2xl"><i class="fas fa-star"></i></div>
                <h4 class="text-3xl font-black text-slate-900">5.0</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Rating Kepuasan</p>
            </div>
            <div>
                <div class="w-14 h-14 bg-[#E8F5E9] text-brand-600 rounded-xl flex items-center justify-center mx-auto mb-4 text-2xl"><i class="fas fa-user-shield"></i></div>
                <h4 class="text-3xl font-black text-slate-900">PPIU</h4>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Resmi Terdaftar</p>
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
                <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm flex flex-col transition hover:shadow-lg">
                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=600&q=80" alt="Hotel" class="w-full h-48 object-cover">
                    <div class="p-8 flex-1 flex flex-col">
                        <p class="text-sm text-slate-500 mb-6 h-14">Solusi hemat dan kebersamaan. Hotel satu kamar untuk 4 orang jamaah, cocok untuk rombongan keluarga atau teman.</p>
                        <div class="mb-6 flex items-baseline gap-2">
                            <span class="text-sm text-slate-500">Mulai</span>
                            <span class="text-3xl font-bold text-brand-600">Rp 25jt</span>
                        </div>
                        <ul class="space-y-3 mb-8 text-sm text-slate-600 flex-1">
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Hotel Bintang 4</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Tiket Pesawat PP (Direct)</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Makan 3x Sehari (Menu Nusantara)</li>
                        </ul>
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
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Hotel Bintang 4/5</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Tiket Pesawat PP (Direct)</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Muthawif Profesional</li>
                        </ul>
                        <a href="{{ route('manajergudang.stock.in', ['package_id' => 2]) }}" class="block w-full py-3 text-center bg-brand-600 text-white font-semibold rounded-full hover:bg-brand-700 transition">Pilih Paket</a>
                    </div>
                </div>

                <!-- Paket 3 -->
                <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm flex flex-col transition hover:shadow-lg">
                    <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=600&q=80" alt="Hotel" class="w-full h-48 object-cover">
                    <div class="p-8 flex-1 flex flex-col">
                        <p class="text-sm text-slate-500 mb-6 h-14">Privasi maksimal untuk ibadah yang khusyuk. Hotel satu kamar untuk 2 orang jamaah, cocok untuk pasangan.</p>
                        <div class="mb-6 flex items-baseline gap-2">
                            <span class="text-sm text-slate-500">Mulai</span>
                            <span class="text-3xl font-bold text-brand-600">Rp 40jt</span>
                        </div>
                        <ul class="space-y-3 mb-8 text-sm text-slate-600 flex-1">
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Hotel Bintang 5</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> City Tour Mekkah & Madinah</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-brand-500 mt-1 mr-3"></i> Akomodasi Full Premium</li>
                        </ul>
                        <a href="{{ route('manajergudang.stock.in', ['package_id' => 3]) }}" class="block w-full py-3 text-center bg-slate-900 text-white font-semibold rounded-full hover:bg-slate-800 transition">Pilih Paket</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fasilitas Section -->
    <section id="fasilitas" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-4 tracking-tighter">Layanan Unggulan Kami</h2>
                <p class="text-slate-500 text-sm font-medium">Fasilitas terbaik untuk menunjang kelancaran ibadah Anda di Tanah Suci</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 bg-[#F4FCF6] rounded-[2rem] flex flex-col border border-emerald-50 transition hover:shadow-lg">
                    <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center mb-6 text-xl"><i class="fas fa-user-friends"></i></div>
                    <h5 class="text-xl font-black text-slate-900 mb-1">Pendamping Ibadah</h5>
                    <p class="text-sm text-slate-500 leading-relaxed mb-6">Bimbingan dari mentor profesional yang mendampingi jamaah sepanjang ibadah sesuai Sunnah.</p>
                    <a href="https://wa.me/6287874184220" target="_blank" class="flex items-center text-xs font-black text-emerald-600 uppercase tracking-widest mt-auto">Hubungi Kami <i class="fab fa-whatsapp ml-2 text-lg"></i></a>
                </div>
                <div class="p-8 bg-[#F4FCF6] rounded-[2rem] flex flex-col border border-emerald-50 transition hover:shadow-lg">
                    <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center mb-6 text-xl"><i class="fas fa-hotel"></i></div>
                    <h5 class="text-xl font-black text-slate-900 mb-1">Hotel Bintang</h5>
                    <p class="text-sm text-slate-500 leading-relaxed mb-6">Akomodasi hotel pilihan yang sangat dekat dengan Masjidil Haram dan Masjid Nabawi.</p>
                    <a href="https://wa.me/6287874184220" target="_blank" class="flex items-center text-xs font-black text-emerald-600 uppercase tracking-widest mt-auto">Hubungi Kami <i class="fab fa-whatsapp ml-2 text-lg"></i></a>
                </div>
                <div class="p-8 bg-[#F4FCF6] rounded-[2rem] flex flex-col border border-emerald-50 transition hover:shadow-lg">
                    <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center mb-6 text-xl"><i class="fas fa-file-alt"></i></div>
                    <h5 class="text-xl font-black text-slate-900 mb-1">Visa Umroh</h5>
                    <p class="text-sm text-slate-500 leading-relaxed mb-6">Pengurusan visa cepat dan terjamin legalitasnya melalui provider resmi Kemenag.</p>
                    <a href="https://wa.me/6287874184220" target="_blank" class="flex items-center text-xs font-black text-emerald-600 uppercase tracking-widest mt-auto">Hubungi Kami <i class="fab fa-whatsapp ml-2 text-lg"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Section -->
    <section id="testimoni" class="py-20 bg-[#F8FDF9]">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4 tracking-tighter">Testimoni Jamaah</h2>
            <p class="text-slate-500 text-sm mb-16 italic">Pengalaman nyata dari para tamu Allah yang telah berangkat bersama kami</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 text-left italic">
                    <div class="text-yellow-400 mb-4 text-xs flex gap-1"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="text-slate-600 text-sm leading-relaxed mb-8">"Alhamdulillah bimbingan manasik sangat detail dan sesuai Sunnah. Kamar hotel sangat dekat, memudahkan ibadah saya."</p>
                    <p class="text-sm font-black text-slate-800 uppercase tracking-tighter">- Hj. Siti Aminah, Jakarta</p>
                </div>
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 text-left italic">
                    <div class="text-yellow-400 mb-4 text-xs flex gap-1"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="text-slate-600 text-sm leading-relaxed mb-8">"Transparan dari awal daftar sampai pulang. Fasilitas VIP-nya benar-benar berkualitas dan muthawifnya sangat ramah."</p>
                    <p class="text-sm font-black text-slate-800 uppercase tracking-tighter">- Bpk. Ahmad Fauzi, Surabaya</p>
                </div>
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 text-left italic">
                    <div class="text-yellow-400 mb-4 text-xs flex gap-1"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="text-slate-600 text-sm leading-relaxed mb-8">"Proses cepat dan adminnya sangat responsif. Perlengkapan umrahnya premium dan eksklusif. Terima kasih Al Madinah."</p>
                    <p class="text-sm font-black text-slate-800 uppercase tracking-tighter">- Ibu Rahmawati, Bandung</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer CTA Block -->
    <section id="kontak" class="bg-brand-600 py-20 px-6 text-center">
        <div class="max-w-4xl mx-auto">
            <h3 class="text-4xl md:text-5xl font-black mb-6 text-white tracking-tighter uppercase">Siap Menuju Tanah Suci?</h3>
            <p class="mb-12 text-[#E8F5E9] text-base font-medium opacity-90 max-w-xl mx-auto">Wujudkan niat ibadah Anda bersama kami. Dapatkan penawaran harga terbaik hari ini!</p>
            
            <div class="flex justify-center">
                <a href="https://wa.me/6287874184220?text=Halo%20Admin%20Al%20Madinah%2C%20saya%20ingin%20tanya%20penawaran%20terbaik%20untuk%20Umrah." 
                   target="_blank" 
                   class="inline-flex items-center justify-center px-12 py-5 bg-white text-brand-600 font-black rounded-full hover:bg-slate-50 transition shadow-xl uppercase text-sm tracking-[0.2em] gap-3 transform hover:scale-105">
                    <i class="fab fa-whatsapp text-xl"></i> Tanya Penawaran via WA
                </a>
            </div>
            <p class="mt-12 text-[10px] font-black text-white/50 uppercase tracking-[0.4em]">Official WhatsApp: +62 878-7418-4220</p>
        </div>
    </section>

    <!-- Main Footer -->
    <footer class="bg-white py-16 px-6 border-t border-slate-50">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="md:col-span-1">
                
                <!-- LOGO DINAMIS FOOTER (DIUBAH) -->
                <div class="flex items-center space-x-2 mb-6">
                    @if(config('app.logo'))
                        <img src="{{ asset('storage/' . config('app.logo')) }}" alt="Logo" class="h-10 w-auto object-contain">
                    @else
                        <div class="text-brand-600 text-2xl">
                            <i class="fas fa-kaaba"></i>
                        </div>
                    @endif
                    <span class="text-lg font-bold text-slate-800 uppercase tracking-tighter">{{ config('app.name') }}</span>
                </div>
                
                <p class="text-sm text-slate-400 leading-relaxed italic">
                    Melayani perjalanan ibadah Anda dengan amanah dan kenyamanan nomor satu sesuai Sunnah.
                </p>
            </div>
            
            <div><h5 class="font-black text-xs uppercase tracking-widest mb-10 text-slate-800">Ikuti Kami</h5><div class="flex items-center gap-4"><a href="#" class="text-slate-300 hover:text-brand-600 transition text-xl"><i class="fab fa-instagram"></i></a><a href="https://wa.me/6287874184220" class="text-slate-300 hover:text-brand-600 transition text-xl"><i class="fab fa-whatsapp"></i></a><a href="#" class="text-slate-300 hover:text-brand-600 transition text-xl"><i class="fab fa-linkedin-in"></i></a></div></div>
            <div><h5 class="font-black text-xs uppercase tracking-widest mb-10 text-slate-800">Kontak</h5><ul class="space-y-4 text-sm font-bold text-slate-500"><li>+62 878-7418-4220</li><li>Jakarta Pusat, Indonesia</li></ul></div>
            <div><h5 class="font-black text-xs uppercase tracking-widest mb-10 text-slate-800">Layanan</h5><ul class="space-y-4 text-xs font-bold text-slate-400 uppercase tracking-widest"><li>Paket Reguler</li><li>Paket VIP</li><li>Haji Khusus</li></ul></div>
        </div>
        
        <div class="max-w-7xl mx-auto mt-16 pt-8 border-t border-slate-50 text-center text-[10px] font-black uppercase tracking-[0.4em] text-slate-300">
            &copy; {{ date('Y') }} {{ config('app.name') }} | Penyelenggara Umrah Resmi Terdaftar.
        </div>
    </footer>

</body>
</html>