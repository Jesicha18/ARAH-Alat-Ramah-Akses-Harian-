<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keamanan Akun - ARAH</title>
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

        /* Animasi Toast */
        @keyframes slideDown {
            from { transform: translate(-50%, -100%); opacity: 0; }
            to { transform: translate(-50%, 20px); opacity: 1; }
        }
        .toast-animate { animation: slideDown 0.5s ease forwards; }
    </style>
</head>
<body class="bg-[#F8FAFC] antialiased">

    {{-- NOTIFIKASI MELAYANG (TOAST) --}}
    @if(session('toast_success'))
    <div id="toast" class="fixed top-0 left-1/2 -translate-x-1/2 z-[999] toast-animate">
        <div class="bg-white border-l-4 border-green-500 shadow-2xl rounded-xl p-4 flex items-center gap-4 min-w-[300px]">
            <div class="bg-green-100 p-2 rounded-full text-green-600">
                <i data-lucide="check-circle" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-slate-800">{{ session('toast_success') }}</p>
                <p class="text-[10px] text-slate-400 font-medium">Data database telah diperbarui.</p>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const t = document.getElementById('toast');
            t.style.transition = "all 0.5s";
            t.style.opacity = "0";
            t.style.transform = "translate(-50%, -20px)";
            setTimeout(() => t.remove(), 500);
        }, 4000);
    </script>
    @endif

    <div class="max-w-[1000px] mx-auto py-12 px-8">
        <div class="mb-12">
            <a href="{{ route('settings') }}" class="btn-back-minimal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            </a>
        </div>

        <div class="text-center mb-16">
            <h1 class="text-5xl font-black text-[#1E293B] mb-4 uppercase tracking-tighter ">KEAMANAN AKUN</h1>
            <p class="text-slate-400 font-medium tracking-wide">Kelola proteksi data privasi pada platform ARAH.</p>
        </div>

        <div class="max-w-[850px] mx-auto space-y-8">
            <div class="bg-white p-10 rounded-[30px] border border-slate-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)]">
                <h2 class="text-xl font-bold text-slate-800 mb-8">Ubah Kata Sandi</h2>
                
                {{-- PAKAI ROUTE SECURITY.UPDATE BIAR GAK ERROR --}}
                <form action="{{ route('security.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Kata Sandi Saat Ini</label>
                            <div class="relative">
                                <input type="password" id="current_password" name="current_password" 
                                    class="w-full bg-[#F8FAFC] border-2 border-transparent focus:border-blue-100 focus:bg-white rounded-2xl p-5 outline-none transition-all text-[#075985] font-medium"
                                    placeholder="Ketik password lama" required>
                                <button type="button" onclick="togglePass('current_password')" class="absolute right-5 top-5 text-slate-300 hover:text-[#0369A1]">
                                    <i data-lucide="eye" class="w-6 h-6" id="icon-current_password"></i>
                                </button>
                            </div>
                            @error('current_password') <p class="text-red-500 text-xs mt-2 font-bold italic">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Kata Sandi Baru</label>
                                <input type="password" id="new_password" name="new_password" class="w-full bg-[#F8FAFC] border-2 border-transparent focus:border-blue-100 focus:bg-white rounded-2xl p-5 outline-none text-[#075985] font-medium" placeholder="Min. 8 karakter" required>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Konfirmasi Password</label>
                                <input type="password" name="new_password_confirmation" class="w-full bg-[#F8FAFC] border-2 border-transparent focus:border-blue-100 focus:bg-white rounded-2xl p-5 outline-none text-[#075985] font-medium" placeholder="Ulangi password baru" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="mt-10 w-full bg-[#0369A1] text-white font-black py-5 rounded-2xl hover:bg-[#075985] transition-all shadow-lg shadow-blue-100 uppercase tracking-widest text-sm">
                        Simpan Perubahan
                    </button>
                </form>
            </div>

            {{-- Box Riwayat Perangkat tetep di sini --}}
            <div class="bg-white p-10 rounded-[30px] border border-slate-100 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)]">
                <h2 class="text-xl font-bold text-slate-800 mb-8">Riwayat Perangkat</h2>
                <div class="space-y-4">
                    @foreach($sessions as $session)
                    <div class="flex items-center justify-between p-5 bg-[#F8FAFC] rounded-2xl border border-slate-50">
                        <div class="flex items-center gap-5">
                            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-[#0369A1]">
                                <i data-lucide="{{ str_contains($session->user_agent, 'Mobile') ? 'smartphone' : 'monitor' }}" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <p class="font-bold text-slate-700 text-sm">{{ Str::contains($session->user_agent, 'Windows') ? 'Windows PC' : 'Perangkat ARAH' }}</p>
                                    @if($session->id === session()->getId()) <span class="text-[8px] bg-green-100 text-green-600 px-2 py-0.5 rounded-full font-black uppercase">Sesi Ini</span> @endif
                                </div>
                                <p class="text-[10px] text-slate-400 font-medium">{{ $session->ip_address }} • {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
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

    <script>
        lucide.createIcons();
        function togglePass(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById('icon-' + inputId);
            input.type = input.type === "password" ? "text" : "password";
            icon.setAttribute('data-lucide', input.type === "password" ? 'eye' : 'eye-off');
            lucide.createIcons();
        }
    </script>
</body>
</html>