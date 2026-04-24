<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Tunanetra - ARAH</title>
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
            background-color: #075985; color: white; transform: scale(1.1); border-color: #075985;
        }

        @keyframes slideDown {
            from { transform: translate(-50%, -100%); opacity: 0; }
            to { transform: translate(-50%, 20px); opacity: 1; }
        }
        .toast-animate { animation: slideDown 0.5s ease forwards; }

        /* Custom Input Style */
        .form-input-arah {
            width: 100%; background-color: #F8FAFC; border: 2px solid transparent;
            border-radius: 1rem; padding: 1.25rem; outline: none; color: #075985;
            font-weight: 600; transition: all 0.3s;
        }
        .form-input-arah:focus {
            border-color: #E0F2FE; background-color: white; box-shadow: 0 4px 20px -5px rgba(3, 105, 161, 0.05);
        }
    </style>
</head>
<body class="bg-[#F8FAFC] antialiased">

    {{-- TOAST NOTIFIKASI --}}
    @if(session('toast_success'))
    <div id="toast" class="fixed top-0 left-1/2 -translate-x-1/2 z-[999] toast-animate">
        <div class="bg-white border-l-4 border-[#075985] shadow-2xl rounded-xl p-4 flex items-center gap-4 min-w-[320px]">
            <div class="bg-blue-50 p-2 rounded-full text-[#075985]">
                <i data-lucide="check-circle" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-slate-800">{{ session('toast_success') }}</p>
                <p class="text-[10px] text-slate-400 font-medium">Data di sistem telah diperbarui.</p>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const t = document.getElementById('toast');
            if(t) {
                t.style.transition = "all 0.5s"; t.style.opacity = "0";
                t.style.transform = "translate(-50%, -20px)";
                setTimeout(() => t.remove(), 500);
            }
        }, 3000);
    </script>
    @endif

    <div class="max-w-[1000px] mx-auto py-12 px-8">
        {{-- Back Button --}}
        <div class="mb-12">
            <a href="{{ route('settings') }}" class="btn-back-minimal">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
        </div>

        <div class="text-center mb-16">
            <h1 class="text-5xl font-black text-[#1E293B] mb-4 uppercase tracking-tighter">PROFIL TUNANETRA</h1>
            <p class="text-slate-400 font-medium tracking-wide ">Informasi pengguna perangkat ARAH yang terdaftar.</p>
        </div>

        <div class="max-w-[850px] mx-auto">
            <div class="bg-white p-10 rounded-[40px] border border-slate-100 shadow-[0_20px_50px_-20px_rgba(0,0,0,0.05)]">
                <form action="{{ route('blind.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-10">
                        {{-- Nama --}}
                        <div>
                            <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.25em] mb-4 ml-1">Nama Tunanetra</label>
                            <input type="text" name="nama_tunanetra" value="{{ $blindUser->nama_tunanetra ?? '' }}" 
                                class="form-input-arah" placeholder="Masukkan nama lengkap..." required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            {{-- Hubungan --}}
                            <div>
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.25em] mb-4 ml-1">Status Hubungan</label>
                                <div class="relative">
                                    <select name="status_hubungan" class="form-input-arah appearance-none cursor-pointer" required>
                                        <option value="" disabled {{ !isset($blindUser->status_hubungan) ? 'selected' : '' }}>Pilih Hubungan</option>
                                        <option value="Teman" {{ ($blindUser->status_hubungan ?? '') == 'Teman' ? 'selected' : '' }}>Teman</option>
                                        <option value="Keluarga" {{ ($blindUser->status_hubungan ?? '') == 'Keluarga' ? 'selected' : '' }}>Keluarga</option>
                                        <option value="Kerabat" {{ ($blindUser->status_hubungan ?? '') == 'Kerabat' ? 'selected' : '' }}>Kerabat</option>
                                    </select>
                                    <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-[#0369A1]">
                                        <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                    </div>
                                </div>
                            </div>
                            {{-- Tanggal Lahir --}}
                            <div>
                                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.25em] mb-4 ml-1">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ $blindUser->tanggal_lahir ?? '' }}" class="form-input-arah" required>
                            </div>
                        </div>

                        {{-- Info Box Area --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                            {{-- Card Usia --}}
                            <div class="p-6 bg-slate-50/80 rounded-[2rem] border border-slate-100 flex items-center gap-5">
                                <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center text-slate-400">
                                    <i data-lucide="calendar-days" class="w-7 h-7"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Usia Saat Ini</p>
                                    <p class="text-2xl font-black text-slate-700 tracking-tight">{{ $age ?? '-' }} <span class="text-sm font-bold text-slate-400 ml-1">Tahun</span></p>
                                </div>
                            </div>
                            
                            {{-- Card ID Perangkat --}}
                            <div class="p-6 bg-blue-50/50 rounded-[2rem] border border-blue-100 flex items-center gap-5">
                                <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center text-[#0369A1]">
                                    <i data-lucide="fingerprint" class="w-7 h-7"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">ID Perangkat ARAH</p>
                                    <p class="text-2xl font-black text-[#075985] tracking-[0.05em] font-sans">
                                        {{ $blindUser->device_code ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="mt-12 w-full bg-[#0369A1] text-white font-black py-6 rounded-[2rem] hover:bg-[#075985] hover:-translate-y-1 active:scale-[0.98] transition-all shadow-xl shadow-blue-200/50 uppercase tracking-[0.2em] text-xs flex items-center justify-center gap-4">
                        <i data-lucide="refresh-cw" class="w-5 h-5"></i>
                        Perbaharui Profile & Sinkronisasi
                    </button>
                </form>
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