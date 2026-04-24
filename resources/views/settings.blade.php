@extends('layouts.sidebar')

@section('title', 'Pengaturan - ARAH')

@section('content')
{{-- PERBAIKAN 1: Tambah flex-col supaya footer jatuh ke bawah, bukan ke samping --}}
<div class="min-h-[85vh] w-full flex flex-col items-center justify-start p-6 pt-24 relative overflow-hidden">
    
    {{-- ELEMEN DEKORASI BACKGROUND --}}
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-400/10 rounded-full blur-[100px] -z-10"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-teal-400/10 rounded-full blur-[100px] -z-10"></div>

    {{-- Grid Container --}}
    <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-2 gap-16 items-start relative z-10">
        
        {{-- Kolom Kiri: Menu --}}
        <div class="space-y-12">
            <header class="flex items-center gap-6 mb-16">
                <div class="w-24 h-24 rounded-full overflow-hidden shadow-2xl border-4 border-white ring-4 ring-blue-50">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ auth()->user()->name ?? 'Jesicha' }}" alt="User">
                </div>
                <div>
                    <h1 class="text-4xl font-bold text-slate-800 tracking-tight">{{ auth()->user()->name ?? 'Jesicha Natasha Mashel' }}</h1>
                    <p class="text-lg text-[#0369A1] font-semibold opacity-70 uppercase tracking-widest text-sm mt-1">{{ auth()->user()->relation ?? 'Pendamping' }}</p>
                </div>
            </header>

            <div class="space-y-10">
                <section>
                    <h2 class="text-slate-400 font-bold text-xs uppercase tracking-[0.3em] mb-12 flex items-center gap-2">
                        <div class="w-8 h-[2px] bg-blue-500"></div>
                        Pengaturan Aplikasi
                    </h2>
                    
                    <div class="space-y-10">
                        <a href="{{ route('security.index') }}" class="flex items-center justify-between w-full group">
                            <span class="text-2xl text-slate-800 group-hover:text-[#0369A1] transition-colors">Kata Sandi & Keamanan</span>
                            <i data-lucide="chevron-right" class="w-6 h-6 text-slate-300 group-hover:text-[#0369A1] transition-all translate-x-0 group-hover:translate-x-2"></i>
                        </a>

                        <a href="{{ route('blind.profile') }}" class="flex items-center justify-between w-full group">
                            <span class="text-2xl text-slate-800 group-hover:text-[#0369A1] transition-colors">Profil Tunanetra</span>
                            <i data-lucide="chevron-right" class="w-6 h-6 text-slate-300 group-hover:text-[#0369A1] transition-all translate-x-0 group-hover:translate-x-2"></i>
                        </a>

                        <a href="{{ route('guide.index') }}" class="flex items-center justify-between w-full group">
                            <span class="text-2xl text-slate-800 group-hover:text-[#0369A1] transition-colors">Panduan Penggunaan</span>
                            <i data-lucide="chevron-right" class="w-6 h-6 text-slate-300 group-hover:text-[#0369A1] transition-all translate-x-0 group-hover:translate-x-2"></i>
                        </a>

                        <a href="{{ route('about.index') }}" class="flex items-center justify-between w-full group">
                            <span class="text-2xl text-slate-800 group-hover:text-[#0369A1] transition-colors">Tentang Aplikasi</span>
                            <i data-lucide="chevron-right" class="w-6 h-6 text-slate-300 group-hover:text-[#0369A1] transition-all translate-x-0 group-hover:translate-x-2"></i>
                        </a>
                    </div>
                </section>
            </div>
        </div> 

        {{-- Kolom Kanan --}}
        <div class="hidden md:flex items-center justify-center relative">
            <div class="absolute w-[400px] h-[400px] bg-blue-400/10 rounded-full blur-[80px] -z-10"></div>
            <img src="{{ asset('assets/img/gallery-orang.png') }}" alt="Character" class="w-full max-w-[480px] h-auto drop-shadow-2xl translate-y-5">
        </div>
    </div> {{-- Penutup Grid --}}

    {{-- PERBAIKAN 2: Footer sekarang pasti di bawah karena pembungkus utamanya sudah flex-col --}}
<footer class="mt-4 pb-2 relative z-10 shrink-0">
        <div class="flex flex-col items-center justify-center border-t border-slate-100 pt-3">
            <p class="text-slate-400 text-[10px] font-bold tracking-widest uppercase">
                &copy; 2026 <span class="text-[#0369A1]">ARAH</span> - Alat Ramah Akses Harian
            </p>
        </div>
    </footer>
</div>
@endsection