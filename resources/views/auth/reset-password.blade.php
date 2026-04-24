<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Password - ARAH</title>
<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body { 
            background: linear-gradient(180deg, #5AA7FF 0%, #A3CDFF 100%); 
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
        }
        .input-field {
            background-color: white;
            border-radius: 12px;
            padding: 16px 20px;
            width: 100%;
            border: none;
            outline: none;
            margin-top: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            color: black;
        }
    </style>
</head>
<body class="antialiased">
    <div class="w-full max-w-md p-8 text-center">
        <h1 class="text-white text-4xl font-extrabold italic mb-6">ARAH</h1>
        <h2 class="text-white text-2xl font-bold mb-8">Atur Ulang Password</h2>

        <form action="{{ route('password.update') }}" method="POST" class="text-left">
            @csrf
            
            <div class="mb-4">
                <label class="text-white font-bold ml-1">Email Akun</label>
                <input type="email" name="email" class="input-field" placeholder="Masukkan email kamu" value="{{ old('email') }}" required>
                @error('email') <span class="text-red-100 text-xs mt-2 ml-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="text-white font-bold ml-1">Password Baru</label>
                <div class="relative">
                    <input type="password" id="password" name="password" class="input-field pr-12" placeholder="Minimal 8 karakter" required>
                    <button type="button" onclick="togglePassword('password', 'eye-1')" class="absolute right-4 top-1/2 mt-1 transform translate-y-[-10%] text-gray-400 hover:text-[#5AA7FF] transition">
                        <i id="eye-1" data-lucide="eye" class="w-5 h-5"></i>
                    </button>
                </div>
                @error('password') <span class="text-red-100 text-xs mt-2 ml-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="mb-8">
                <label class="text-white font-bold ml-1">Ulangi Password</label>
                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="input-field pr-12" placeholder="Ketik ulang password" required>
                    <button type="button" onclick="togglePassword('password_confirmation', 'eye-2')" class="absolute right-4 top-1/2 mt-1 transform translate-y-[-10%] text-gray-400 hover:text-[#5AA7FF] transition">
                        <i id="eye-2" data-lucide="eye" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full bg-white text-[#5AA7FF] font-extrabold py-4 rounded-[2rem] shadow-lg hover:scale-[1.02] transition text-xl uppercase tracking-widest">
                Ganti Password
            </button>
        </form>

        <a href="{{ route('login') }}" class="inline-block mt-8 text-white/80 hover:underline">Kembali ke Login</a>
    </div>

    <script>
        // Inisialisasi Lucide Icons
        lucide.createIcons();

        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                input.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            
            // Re-render icon setelah attribute diubah
            lucide.createIcons();
        }
    </script>
</body>
</html>