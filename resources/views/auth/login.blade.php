<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ARAH</title>
<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
        }

        .login-card {
            width: 100%;
            max-width: 500px;
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
        }

        .character-img {
            position: absolute;
            bottom: -50px;
            right: -150px;
            width: 350px;
            z-index: 1;
        }
    </style>
</head>
<body class="antialiased">

    <div class="login-card">
        <div class="flex justify-center mb-2">
            <img src="{{ asset('assets/img/arah-putih.png') }}" 
                alt="Logo ARAH" 
                class="w-30 md:w-40 drop-shadow-sm">
        </div>

        <h1 class="text-white text-3xl md:text-4xl font-extrabold mb-2">
            Selamat Datang, Teman!
        </h1>
        <p class="text-white/90 text-lg mb-6">
            Masuk untuk memulai!
        </p>

        @if (session('status'))
            <div class="bg-white/20 backdrop-blur-md border border-white/40 text-white p-4 rounded-xl mb-6 text-sm italic animate-pulse">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="text-left">
            @csrf
            
            <div class="mb-6">
                <label class="text-white font-bold text-lg ml-1">Alamat Email</label>
                <input type="email" name="email" class="input-field" value="{{ old('email') }}" required>
            </div>

            <div class="mb-2">
                <label class="text-white font-bold text-lg ml-1">Kata Sandi</label>
                <input type="password" name="password" class="input-field" required>
            </div>

            <div class="mb-8">
                <a href="{{ route('password.request') }}" class="text-white/80 text-sm hover:underline ml-1 italic">
                    Lupa Password?
                </a>
            </div>

            <div class="flex flex-col items-center">
                <button type="submit" class="w-full bg-white text-[#5AA7FF] font-extrabold py-4 px-16 rounded-[2rem] shadow-lg transition duration-300 transform hover:scale-[1.02] active:scale-95 text-xl mb-4 tracking-wider uppercase">
                    Masuk
                </button>
                
                <a href="{{ route('register') }}" class="text-white/90 text-sm font-medium hover:underline border-b border-white/40">
                    Belum punya akun?
                </a>
            </div>
        </form>
    </div>

    <img src="{{ asset('assets/img/karakter-arah.png') }}" class="character-img hidden lg:block" alt="">

    @if($errors->any() || session('error'))
    <div id="error-modal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 backdrop-blur-sm transition-opacity duration-300">
        <div class="bg-white rounded-[2rem] p-8 w-[90%] max-w-md shadow-2xl transform transition-all border border-blue-100 text-center animate-bounce-in">
            <div class="flex justify-center mb-4">
                <div class="bg-blue-50 p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-[#5AA7FF]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>

            <h2 class="text-[#5AA7FF] text-xl font-medium mb-2">
                Terjadi Kesalahan
            </h2>
            <p class="text-blue-600/80 font-bold text-lg mb-6">
                @if($errors->has('email'))
                    {{ $errors->first('email') }}
                @else
                    Silahkan coba kembali
                @endif
            </p>

            <button onclick="closeModal()" class="bg-[#5AA7FF] hover:bg-blue-600 text-white font-bold py-3 px-10 rounded-xl transition duration-300 shadow-md">
                Tutup
            </button>
        </div>
    </div>
    @endif

    <style>
        @keyframes bounceIn {
            0% { opacity: 0; transform: scale(0.3); }
            50% { opacity: 1; transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); }
        }
        .animate-bounce-in {
            animation: bounceIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
    </style>

    <script>
        function closeModal() {
            const modal = document.getElementById('error-modal');
            if(modal) {
                modal.classList.add('opacity-0');
                setTimeout(() => modal.remove(), 300);
            }
        }

        window.onclick = function(event) {
            const modal = document.getElementById('error-modal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>

</body>
</html>