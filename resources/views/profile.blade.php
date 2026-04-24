@extends('layouts.sidebar')

@section('title', 'Profile Saya - ARAH')

@section('content')
{{-- PERBAIKAN: Pakai justify-start dan pt-4 biar konten nempel ke atas --}}
<div class="h-screen w-full flex flex-col items-center justify-start p-6 pt-4 pb-4 relative overflow-hidden bg-slate-50/30">
    
    {{-- ELEMEN DEKORASI BACKGROUND --}}
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-400/10 rounded-full blur-[100px] -z-10"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-teal-300/5 rounded-full blur-[120px] -z-10"></div>
    <div class="absolute -bottom-32 -right-32 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[100px] -z-10 animate-pulse"></div>

    {{-- Grid Container: mt-4 biar ga terlalu nempel banget sama langit-langit --}}
    <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-2 gap-16 items-start relative z-10 mt-4">
        
        {{-- Kolom Kiri: Informasi Profile --}}
        <div class="space-y-10"> 
            <header class="flex items-center gap-6 mb-10">
                <div class="w-24 h-24 rounded-full overflow-hidden shadow-2xl border-4 border-white ring-4 ring-blue-50 shrink-0">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $user->name ?? 'Jesicha' }}" alt="User Avatar" class="bg-blue-50">
                </div>
                <div>
                    <h1 class="text-4xl font-bold text-slate-800 tracking-tight leading-none">Profile Saya</h1>
                    <p class="text-lg text-[#0369A1] font-semibold opacity-80 uppercase tracking-widest text-sm mt-2">Detail Informasi Akun</p>
                </div>
            </header>

            <div class="space-y-10"> 
                <section>
                    <h2 class="text-slate-400 font-bold text-xs uppercase tracking-[0.3em] mb-6 flex items-center gap-2">
                        <div class="w-8 h-[2px] bg-blue-500"></div>
                        Informasi Personal
                    </h2>
                    
                    <div class="space-y-4"> 
                        <div class="flex items-center border-b border-blue-50 pb-4 group transition-all">
                            <span class="w-40 font-bold text-slate-400 text-xs uppercase tracking-wider">Nama</span>
                            <span class="text-xl font-semibold text-slate-800">{{ $user->name ?? 'Jesicha Natasha Mashel' }}</span>
                        </div>
                        
                        <div class="flex items-center border-b border-blue-50 pb-4 group transition-all">
                            <span class="w-40 font-bold text-slate-400 text-xs uppercase tracking-wider">Status</span>
                            <span class="text-xl font-semibold text-slate-800 px-3 py-1 bg-blue-50 text-[#0369A1] rounded-lg">{{ $user->relation ?? 'Pendamping' }}</span>
                        </div>
                        
                        <div class="flex items-center border-b border-blue-50 pb-4 group transition-all">
                            <span class="w-40 font-bold text-slate-400 text-xs uppercase tracking-wider">Usia</span>
                            <span class="text-xl font-semibold text-slate-800">{{ $user->age ?? '21' }} Tahun</span>
                        </div>
                        
                        <div class="flex items-center border-b border-blue-50 pb-4 group transition-all">
                            <span class="w-40 font-bold text-slate-400 text-xs uppercase tracking-wider">Email</span>
                            <span class="text-xl font-semibold text-slate-800">{{ $user->email ?? 'jesicha@example.com' }}</span>
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-slate-400 font-bold text-xs uppercase tracking-[0.3em] mb-6 flex items-center gap-2">
                        <div class="w-8 h-[2px] bg-blue-500"></div>
                        Dukungan
                    </h2>
                    <div class="flex flex-wrap gap-x-8 gap-y-4">
                        <a href="{{ route('bantuan') }}" class="text-base font-bold text-slate-700 hover:text-[#0369A1] underline underline-offset-8 decoration-blue-100 transition-all text-sm">FAQ</a>                        
                        <a href="{{ route('contact.us') }}" class="text-base font-bold text-slate-700 hover:text-[#0369A1] underline underline-offset-8 decoration-blue-100 transition-all text-sm">Hubungi Kami</a>
                        <a href="{{ route('terms.conditions') }}" class="text-base font-bold text-slate-700 hover:text-[#0369A1] underline underline-offset-8 decoration-blue-100 transition-all text-sm">Syarat & Ketentuan</a>
                    </div>
                </section>
            </div>
        </div>

        {{-- Kolom Kanan: Gambar ditarik ke atas juga --}}
        <div class="hidden md:flex items-start justify-center relative pt-8">
            <div class="absolute w-[450px] h-[450px] bg-blue-400/20 rounded-full blur-[80px] -z-10 animate-pulse"></div>
            <img src="{{ asset('assets/img/gallery-orang.png') }}" 
                 alt="Character" 
                 class="w-full max-w-[480px] h-auto drop-shadow-2xl">
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
@endsection