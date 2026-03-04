<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ config('app.description') }}">
    <title>@yield('title') - {{ config('app.name') }}</title>

    <link rel="icon" href="{{ get_favicon_url() }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .logo-container {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid #fbbf24; /* Warna Amber/Emas */
            padding: 5px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-full bg-[#E9F7F2] flex items-center justify-center p-6">
    <div class="w-full max-w-[480px]">
        <!-- Card Putih Utama -->
        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-emerald-900/5 p-10 md:p-14 border border-white">
            
            <!-- LOGO TEMPLATE -->
            <div class="flex justify-center mb-8">
                <div class="logo-container">
                    {{-- 
                        Ganti 'URL_GAMBAR_LOGO_ANDA' dengan asset('path/ke/logo.png') 
                        Atau biarkan config('app.logo') jika sudah diatur di database
                    --}}
                    @if(config('app.logo'))
                        <img src="{{ asset('storage/' . config('app.logo')) }}" alt="Logo" class="w-full h-full object-contain">
                    @else
                        <!-- TEMPAT MELETAKKAN IMAGE LOGO MANUAL -->
                        <img src="https://cdn-icons-png.flaticon.com/512/3133/3133171.png" 
                             alt="Default Logo Umroh" 
                             class="w-full h-full object-contain p-2">
                    @endif
                </div>
            </div>

            <h2 class="text-3xl font-extrabold text-center text-slate-900 mb-8 tracking-tight">
                @yield('page-title', 'Selamat Datang')
            </h2>

            @yield('content')
        </div>
        
        <!-- Footer Kecil -->
        <p class="text-center mt-8 text-slate-400 text-xs font-bold uppercase tracking-widest">
            &copy; {{ date('Y') }} {{ config('app.name') }} | Internal System
        </p>
    </div>

    @stack('scripts')
</body>
</html>