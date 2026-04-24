<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ARAH - Monitoring Alat')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-32x.png') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: -0.02em; }
        #map { height: 180px; width: 100%; border-radius: 12px; z-index: 1; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">

    <div class="flex min-h-screen">
        <aside class="w-24 bg-slate-50 border-r border-slate-100 flex flex-col items-center py-12 sticky top-0 h-screen z-50">
            <div class="mb-20">
                <img src="{{ asset('assets/img/arah-warna-hitam.png') }}" alt="Logo ARAH" class="w-66 h-auto object-contain">
            </div>

            <nav class="flex flex-col gap-12 items-center flex-1"> 
                <a href="{{ isset($tunanetra) ? route('dashboard', $tunanetra->id) : '#' }}" 
                   class="p-2 transition-all {{ request()->routeIs('dashboard') ? 'text-slate-900 scale-110' : 'text-slate-400 hover:text-slate-900' }}"
                   title="Dashboard">
                    <i data-lucide="layout-grid" class="w-7 h-7 {{ request()->routeIs('dashboard') ? 'stroke-[3]' : 'stroke-[2.5]' }}"></i>
                </a>

                <a href="{{ route('profile') }}" 
                   class="p-2 transition-all {{ request()->routeIs('profile') ? 'text-slate-900 scale-110' : 'text-slate-400 hover:text-slate-900' }}"
                   title="Profile Saya">
                    <i data-lucide="user" class="w-7 h-7 {{ request()->routeIs('profile') ? 'stroke-[3]' : 'stroke-[2.5]' }}"></i>
                </a>

                <a href="{{ route('settings') }}" 
                   class="p-2 transition-all {{ request()->routeIs('settings') ? 'text-slate-900 scale-110' : 'text-slate-400 hover:text-slate-900' }}"
                   title="Pengaturan">
                    <i data-lucide="settings" class="w-7 h-7 {{ request()->routeIs('settings') ? 'stroke-[3]' : 'stroke-[2.5]' }}"></i>
                </a>

                <a href="{{ route('select.device') }}" 
                   class="p-2 transition-all {{ request()->routeIs('select.device') ? 'text-slate-900 scale-110' : 'text-slate-400 hover:text-slate-900' }}"
                   title="Pilih Alat">
                    <i data-lucide="plus" class="w-7 h-7 {{ request()->routeIs('select.device') ? 'stroke-[3]' : 'stroke-[2.5]' }}"></i>
                </a>
            </nav>

            <div class="mt-auto">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors" title="Keluar">
                        <i data-lucide="log-out" class="w-7 h-7 stroke-[2.5]"></i>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto bg-white">
            <div class="p-10">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
    
    @stack('scripts')
</body>
</html>