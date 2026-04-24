<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Aplikasi - ARAH</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; }

        .btn-back-minimal {
            display: inline-flex; align-items: center; justify-content: center;
            width: 48px; height: 48px; background-color: white; color: #64748B;
            border-radius: 9999px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s; border: 1px solid #F1F5F9;
        }
        .btn-back-minimal:hover {
            background-color: #075985; color: white; transform: scale(1.1);
        }

        .stat-card {
            background: white;
            border: 1px solid #F1F5F9;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            border-color: #075985;
            transform: translateY(-4px);
        }
    </style>
</head>
<body class="bg-[#F8FAFC] antialiased">

<div class="max-w-[1100px] mx-auto py-12 px-8">
    
    {{-- Back Button --}}
    <div class="mb-16">
        <a href="{{ route('settings') }}" class="btn-back-minimal">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
        
        {{-- Left Side: Info --}}
        <div>
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 rounded-full mb-6">
                <span class="w-2 h-2 bg-[#075985] rounded-full"></span>
                <span class="text-[10px] font-black uppercase tracking-widest text-[#075985]">Project Information</span>
            </div>
            <h1 class="text-7xl font-black text-[#1E293B] mb-8 uppercase tracking-tighter leading-none">TENTANG<br><span class="text-[#075985]">ARAH.</span></h1>
            
            <p class="text-slate-500 text-lg leading-relaxed mb-10">
                ARAH (Alat Ramah Akses Harian) adalah ekosistem monitoring cerdas berbasis <b>Internet of Things</b>. Kami menggabungkan perangkat keras navigasi mandiri untuk tunanetra dengan dashboardr pemantauan kesehatan serta lokasi secara <i>real-time</i>.
            </p>

{{-- Tech Stack Mini --}}
<div class="grid grid-cols-2 gap-4">
    <div class="stat-card p-4 rounded-2xl flex items-center gap-3">
        <div class="w-10 h-10 bg-slate-900 rounded-xl flex items-center justify-center text-white">
            <i data-lucide="cpu" class="w-5 h-5"></i>
        </div>
        <div>
            <p class="text-[10px] font-black text-slate-400 uppercase">Hardware</p>
            <p class="text-xs font-bold text-slate-800">ESP32 IoT</p>
        </div>
    </div>

    <div class="stat-card p-4 rounded-2xl flex items-center gap-3">
        <div class="w-10 h-10 bg-[#075985] rounded-xl flex items-center justify-center text-white">
            <i data-lucide="database" class="w-5 h-5"></i>
        </div>
        <div>
            <p class="text-[10px] font-black text-slate-400 uppercase">Backend</p>
            <p class="text-xs font-bold text-slate-800">Laravel 11</p>
        </div>
    </div>

    <div class="stat-card p-4 rounded-2xl flex items-center gap-3">
        <div class="w-10 h-10 bg-sky-500 rounded-xl flex items-center justify-center text-white">
            <i data-lucide="layout" class="w-5 h-5"></i>
        </div>
        <div>
            <p class="text-[10px] font-black text-slate-400 uppercase">Frontend</p>
            <p class="text-xs font-bold text-slate-800">Tailwind CSS</p>
        </div>
    </div>

    <div class="stat-card p-4 rounded-2xl flex items-center gap-3">
        <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white">
            <i data-lucide="server" class="w-5 h-5"></i>
        </div>
        <div>
            <p class="text-[10px] font-black text-slate-400 uppercase">Database</p>
            <p class="text-xs font-bold text-slate-800">MySQL / Heidi</p>
        </div>
    </div>
</div>
        </div>

        {{-- Right Side: Team --}}
        <div class="bg-white p-10 rounded-[40px] shadow-[0_20px_50px_-20px_rgba(0,0,0,0.05)] border border-slate-50 relative overflow-hidden">

            <h3 class="text-xl font-black text-slate-800 mb-8 uppercase tracking-tight">Development Team</h3>
            
            <div class="space-y-4">
                @php
                    $teams = [
                        [
                            'name' => 'Elvira Rantela\'bi', 
                            'role' => 'System Architect',
                            'ig' => 'https://instagram.com/elvirantelabi', // Ganti usernamenya
                            'img' => 'elvira.jpeg' // Ganti sesuai nama file foto
                        ],
                        [
                            'name' => 'Eileen Mynami Gosal', 
                            'role' => 'UI/UX Designer',
                            'ig' => 'https://instagram.com/mynamiigosaal',
                            'img' => 'eileen.jpeg'
                        ],
                        [
                            'name' => 'Deshua Pricila Tania', 
                            'role' => 'Hardware Engineer',
                            'ig' => 'https://instagram.com/deshuatania',
                            'img' => 'deshua.jpeg'
                        ],
                        [
                            'name' => 'Jesicha Natasha Mashel', 
                            'role' => 'Fullstack Developer',
                            'ig' => 'https://instagram.com/tashaamashel',
                            'img' => 'jesicha.jpeg'
                        ]
                    ];
                @endphp

                @foreach($teams as $member)
                <a href="{{ $member['ig'] }}" target="_blank" class="group flex items-center justify-between p-5 rounded-3xl bg-[#F8FAFC] border border-transparent hover:border-blue-100 hover:bg-white transition-all">
                    <div class="flex items-center gap-4">
                        {{-- Team Photo --}}
                        <div class="w-12 h-12 rounded-2xl overflow-hidden border border-slate-100 bg-slate-50 flex-shrink-0 group-hover:border-blue-200 transition-all">
                            <img src="{{ asset('assets/img/team/' . $member['img']) }}" 
                                 alt="{{ $member['name'] }}" 
                                 class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($member['name']) }}&background=f1f5f9&color=64748b'">
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">{{ $member['name'] }}</h4>
                            <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wider">{{ $member['role'] }}</p>
                        </div>
                    </div>
                    <i data-lucide="instagram" class="w-4 h-4 text-slate-300 group-hover:text-[#E4405F] transition-all"></i>
                </a>
                @endforeach
            </div>
        </div>
    </div>
        {{-- FOOTER: Tetap di bawah berkat mt-auto --}}
    <footer class="max-w-6xl w-full mt-auto pb-4 relative z-10">
        <div class="flex flex-col items-center justify-center gap-1 border-t border-slate-100 pt-4">
            <p class="text-slate-400 text-[10px] font-bold tracking-widest uppercase text-center">
                &copy; 2026 <span class="text-[#0369A1]">ARAH</span> - Alat Ramah Akses Harian
            </p>
        </div>
    </footer>
</div>

<script>lucide.createIcons();</script>
</body>
</html>