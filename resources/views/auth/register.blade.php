<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - ARAH</title>
<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                },
            },
        }
    </script>

    <style>
        body {
            background: linear-gradient(180deg, #5AA7FF 0%, #A3CDFF 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            overflow: hidden;
            position: relative;
        }

        .register-card {
            width: 100%;
            max-width: 550px;
            padding: 2rem;
            text-align: center;
            position: relative;
            z-index: 10;
        }

        .input-field {
            background-color: white;
            border-radius: 12px;
            padding: 12px 20px;
            width: 100%;
            border: none;
            outline: none;
            margin-top: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            color: #1e293b;
        }

        .character-img {
            position: absolute;
            bottom: -50px;
            right: -150px;
            width: 350px;
            z-index: 1;
        }

        /* Tombol Back di Pojok Kiri Atas */
        .back-button {
            position: absolute;
            top: 30px;
            left: 30px;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(8px);
            padding: 12px;
            border-radius: 50%;
            color: white;
            transition: all 0.3s ease;
            z-index: 50;
            border: 1px solid rgba(255, 255, 255, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .back-button:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: translateX(-5px);
        }
    </style>
</head>
<body class="antialiased">

    <a href="{{ route('login') }}" class="back-button" title="Kembali ke Login">
        <i data-lucide="chevron-left" class="w-7 h-7 stroke-[3px]"></i>
    </a>

    <div class="register-card">
        <div class="flex justify-center mb-4">
            <img src="{{ asset('assets/img/arah-putih.png') }}" alt="Logo ARAH" class="w-32 md:w-40">
        </div>

        <h1 class="text-white text-3xl md:text-4xl font-extrabold mb-2">
            Selamat Datang, Teman!
        </h1>
        <p class="text-white/90 text-lg mb-8 font-medium">
            Daftar untuk memulai!
        </p>

        <form action="{{ route('register') }}" method="POST" class="text-left">
            @csrf
            
            <div class="mb-5">
                <label class="text-white font-bold text-lg ml-1">Alamat Email</label>
                <input type="email" name="email" class="input-field" placeholder="Masukkan email anda" required value="{{ old('email') }}">
                @error('email') 
                    <span class="text-red-600 text-sm ml-1 font-bold">{{ $message }}</span> 
                @enderror
            </div>

            <div class="mb-5">
                <label class="text-white font-bold text-lg ml-1">Kata Sandi</label>
                <input type="password" name="password" class="input-field" placeholder="Masukkan kata sandi" required>
            </div>

            <div class="mb-10">
                <label class="text-white font-bold text-lg ml-1">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" class="input-field" placeholder="Ulangi kata sandi" required>
                @error('password') 
                    <span class="text-red-600 text-sm ml-1 font-bold">{{ $message }}</span> 
                @enderror
            </div>

            <div class="flex flex-col items-center">
                <button type="submit" class="w-full bg-white text-[#5AA7FF] font-extrabold py-4 px-16 rounded-[2rem] shadow-lg transition duration-300 transform hover:scale-[1.02] active:scale-95 text-xl mb-4 tracking-wider uppercase">
                    Lanjut
                </button>
                
                <a href="{{ route('login') }}" class="text-white/90 text-sm font-medium hover:underline border-b border-white/40">
                    Sudah punya akun? Masuk di sini
                </a>
            </div>
        </form>
    </div>

    <img src="{{ asset('assets/img/karakter-buta.png') }}" class="character-img hidden lg:block" alt="Karakter ARAH">

    <script>
        // Inisialisasi icon
        lucide.createIcons();
    </script>
</body>
</html>