<!DOCTYPE html>
<html lang="id" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'Biro Umroh') }}</title>
    
    <link id="favicon" rel="icon" href="{{ get_favicon_url() }}" type="image/x-icon">

    <script>
        if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          darkMode: 'class',
          theme: {
            extend: {
              colors: {
                'dark-primary': '#1e293b',
                'dark-secondary': '#0f172a',
                'emerald-primary': '#059669', // Emerald 600
                'emerald-secondary': '#047857', // Emerald 700
              }
            }
          }
        }
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .emerald-gradient {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-dark-secondary">
    
    <div x-data="{ 
            sidebarOpen: false, 
            sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
            toggleSidebarCollapse() {
                this.sidebarCollapsed = !this.sidebarCollapsed;
                localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);
            },
            darkMode: localStorage.getItem('darkMode') === 'true',
            toggleDarkMode() {
                this.darkMode = !this.darkMode;
                localStorage.setItem('darkMode', this.darkMode);
                document.documentElement.classList.toggle('dark', this.darkMode);
            }
         }" 
         class="flex h-screen overflow-x-hidden text-slate-800 dark:text-slate-200">

        <x-navbar-dashboard />

        @auth
            <!-- Sidebar Backdrop untuk mobile -->
            <div x-show="sidebarOpen" x-cloak class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false"></div>

            <aside 
                class="fixed inset-y-0 left-0 z-50 flex flex-col pt-16 transition-[width] duration-300 ease-in-out transform bg-white shadow-2xl dark:bg-dark-primary lg:translate-x-0 border-r border-slate-100 dark:border-gray-800"
                :class="{
                    'translate-x-0 w-72': sidebarOpen, 
                    '-translate-x-full': !sidebarOpen,
                    'lg:w-72': !sidebarCollapsed,
                    'lg:w-20': sidebarCollapsed
                }">
                
                <div class="flex flex-col flex-1 h-full px-4 pb-4 overflow-y-auto custom-scrollbar mt-4">
                    <!-- User Info Card -->
                    <div class="mb-6 p-4 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-100 dark:border-gray-700" :class="{ 'lg:px-1': sidebarCollapsed }">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-11 h-11 rounded-xl emerald-gradient flex items-center justify-center text-white font-black shadow-lg shadow-emerald-200">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            </div>
                            <div class="ml-4 transition-opacity duration-300" :class="{ 'lg:opacity-0 lg:invisible lg:hidden': sidebarCollapsed }">
                                <p class="text-sm font-black text-slate-800 dark:text-white truncate">{{ auth()->user()->name }}</p>
                                <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">{{ auth()->user()->role }}</p>
                            </div>
                        </div>
                    </div>
    
                    <!-- Navigation (LOGIKA ROLE DIPERBAIKI) -->
                    <nav class="flex-1 px-1 space-y-1">
                        @if (auth()->user()->role === 'Admin')
                            <x-sidebar.admin-sidebar />
                        @elseif (auth()->user()->role === 'Manajer Operasional')
                            <x-sidebar.manajergudang-sidebar />
                        @elseif (auth()->user()->role === 'Staf Registrasi')
                            <x-sidebar.staffgudang-sidebar />
                        @endif
                    </nav>
                </div>
                
                <!-- Toggle Collapse Button -->
                <div class="flex-shrink-0 p-4 border-t border-slate-100 dark:border-slate-800">
                    <button @click="toggleSidebarCollapse" class="flex items-center justify-center w-full p-3 text-slate-400 rounded-xl hover:bg-emerald-50 hover:text-emerald-600 dark:hover:bg-slate-800 transition-all">
                        <i class="transition-transform duration-300 fas" :class="{ 'fa-chevron-left': !sidebarCollapsed, 'fa-chevron-right': sidebarCollapsed }"></i>
                        <span class="ml-3 text-xs font-black uppercase tracking-widest" :class="{ 'lg:hidden': sidebarCollapsed }">Sembunyikan</span>
                    </button>
                </div>
            </aside>
        @endauth

        <!-- Konten Utama -->
        <main class="flex-1 pt-16 overflow-y-auto transition-[margin-left] duration-300 ease-in-out bg-slate-50 dark:bg-dark-secondary"
              :class="{ 'lg:ml-72': !sidebarCollapsed && {{ auth()->check() ? 'true' : 'false' }}, 'lg:ml-20': sidebarCollapsed && {{ auth()->check() ? 'true' : 'false' }} }">
            <div class="p-8">
                @yield('content')
            </div>
            <x-footer-dashboard />
        </main>
    </div>

    @stack('scripts')

    <!-- Toast Notifications -->
    <div id="toast-container" class="fixed top-4 right-4 z-[100] space-y-3"></div>

    <script>
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `p-4 rounded-2xl shadow-2xl text-white font-bold text-sm transform transition-all duration-500 translate-x-full border-b-4`;
            
            const colors = {
                'success': 'bg-emerald-600 border-emerald-800',
                'error': 'bg-red-600 border-red-800',
                'warning': 'bg-amber-500 border-amber-700',
                'info': 'bg-blue-600 border-blue-800'
            };
            toast.classList.add(...(colors[type] || colors.info).split(' '));

            toast.innerHTML = `
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-info-circle"></i>
                        <span>${message}</span>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-white/50 hover:text-white"><i class="fas fa-times"></i></button>
                </div>
            `;

            document.getElementById('toast-container').appendChild(toast);
            setTimeout(() => toast.classList.remove('translate-x-full'), 100);
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => toast.remove(), 500);
            }, 5000);
        }
    </script>
</body>
</html>