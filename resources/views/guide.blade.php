<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Guide - ARAH</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; }

        .btn-back-minimal {
            display: inline-flex; align-items: center; justify-content: center;
            width: 48px; height: 48px; background-color: white; color: #64748B;
            border-radius: 9999px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease; border: 1px solid #F1F5F9;
        }
        .btn-back-minimal:hover {
            background-color: #075985; color: white; transform: scale(1.05);
        }

        .glass-card {
            background: white;
            border: 1px solid #E2E8F0;
            border-bottom: 4px solid transparent;
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
            border-bottom: 4px solid #075985;
        }
    </style>
</head>
<body class="bg-[#F8FAFC] antialiased">

<div class="max-w-[1100px] mx-auto py-12 px-8">
    
    {{-- Tombol Kembali --}}
    <div class="mb-12 text-left">
        <a href="{{ route('settings') }}" class="btn-back-minimal">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
    </div>

    {{-- Header --}}
    <div class="text-center mb-20">
        <h1 class="text-6xl font-black text-[#1E293B] mb-4 uppercase tracking-tighter">USER GUIDE</h1>
        <p class="text-slate-500 font-medium text-lg mx-auto max-w-2xl">Panduan operasional perangkat dan sistem monitoring ARAH.</p>
    </div>

    {{-- Bagian 1: Perangkat Fisik --}}
    <div class="mb-8 flex items-center gap-4">
        <h2 class="text-sm font-black text-[#075985] uppercase tracking-[0.2em]">1. Penggunaan Tongkat</h2>
        <div class="h-px flex-grow bg-slate-200"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
        
        <div class="glass-card p-10 rounded-[32px]">
            <div class="w-14 h-14 bg-blue-50 text-[#075985] rounded-2xl flex items-center justify-center mb-8">
                <i data-lucide="power" class="w-7 h-7"></i>
            </div>
            <h3 class="text-xl font-black text-slate-800 mb-4 uppercase">Aktivasi</h3>
            <p class="text-slate-500 text-sm leading-relaxed">Geser saklar daya ke posisi <b>ON</b>. Tunggu 20 detik untuk inisialisasi sensor dan koneksi jaringan WiFi.</p>
        </div>

        <div class="glass-card p-10 rounded-[32px]">
            <div class="w-14 h-14 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center mb-8">
                <i data-lucide="heart" class="w-7 h-7"></i>
            </div>
            <h3 class="text-xl font-black text-slate-800 mb-4 uppercase">Cek BPM</h3>
            <p class="text-slate-500 text-sm leading-relaxed">Tempelkan jari pada sensor di gagang tongkat secara stabil agar data detak jantung terkirim akurat.</p>
        </div>

        <div class="glass-card p-10 rounded-[32px]">
            <div class="w-14 h-14 bg-slate-900 text-white rounded-2xl flex items-center justify-center mb-8">
                <i data-lucide="navigation" class="w-7 h-7"></i>
            </div>
            <h3 class="text-xl font-black text-slate-800 mb-4 uppercase">Navigasi</h3>
            <p class="text-slate-500 text-sm leading-relaxed">Tongkat bergetar otomatis jika mendeteksi rintangan (atas/bawah) dalam radius jarak <b>< 50cm</b>.</p>
        </div>

    </div>

    {{-- Bagian 2: Dashboard --}}
    <div class="mb-8 flex items-center gap-4">
        <h2 class="text-sm font-black text-[#075985] uppercase tracking-[0.2em]">2. Monitoring Dashboard</h2>
        <div class="h-px flex-grow bg-slate-200"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center bg-white p-12 rounded-[40px] border border-slate-100 shadow-sm">
        
        <div class="space-y-10">
            <div class="flex gap-6 items-start">
                <div class="w-10 h-10 bg-slate-900 text-white rounded-xl flex-shrink-0 flex items-center justify-center font-bold text-lg">1</div>
                <div>
                    <h4 class="font-black text-slate-800 mb-1 uppercase text-sm tracking-tight">Akses Sistem</h4>
                    <p class="text-slate-500 text-sm">Buka URL dashboard dan masukkan <b>ID Perangkat</b> (Cth: AT260420001) untuk mulai memantau.</p>
                </div>
            </div>

            <div class="flex gap-6 items-start">
                <div class="w-10 h-10 bg-slate-900 text-white rounded-xl flex-shrink-0 flex items-center justify-center font-bold text-lg">2</div>
                <div>
                    <h4 class="font-black text-slate-800 mb-1 uppercase text-sm tracking-tight">Pantau BPM</h4>
                    <p class="text-slate-500 text-sm">Cek angka BPM real-time. Hubungi pengguna jika detak jantung berada di luar rentang <b>60-100 BPM</b>.</p>
                </div>
            </div>

            <div class="flex gap-6 items-start">
                <div class="w-10 h-10 bg-slate-900 text-white rounded-xl flex-shrink-0 flex items-center justify-center font-bold text-lg">3</div>
                <div>
                    <h4 class="font-black text-slate-800 mb-1 uppercase text-sm tracking-tight">Peta & Baterai</h4>
                    <p class="text-slate-500 text-sm">Pastikan posisi GPS terlihat di peta dan daya baterai perangkat berada di atas angka <b>20%</b>.</p>
                </div>
            </div>
        </div>

        <div class="relative flex justify-center py-10 bg-slate-50 rounded-[32px]">
            <img src="{{ asset('assets/img/gallery-orang.png') }}" class="w-full max-w-[280px] drop-shadow-xl" alt="ARAH Illustration">
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

<script>
    lucide.createIcons();
</script>
</body>
</html>