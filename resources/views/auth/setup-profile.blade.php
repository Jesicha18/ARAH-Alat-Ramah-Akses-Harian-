<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Profil - ARAH</title>
<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                },
            },
        }
    </script>

    <style>
        body {
            background: linear-gradient(180deg, #5AA7FF 0%, #A3CDFF 100%);
            min-height: 100vh;
            margin: 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .input-field {
            background-color: white;
            border-radius: 12px;
            padding: 12px 20px;
            width: 100%;
            border: 2px solid transparent;
            outline: none;
            margin-top: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            color: #1e293b;
            transition: all 0.3s ease;
        }
        .input-field:focus { 
            border-color: #5AA7FF;
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.3);
        }
        /* Style khusus untuk menu pilihan dropdown */
        .dropdown-animate {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .character-img {
            position: absolute;
            bottom: -20px;
            right: -100px;
            width: 400px;
            z-index: 1;
            pointer-events: none;
        }
        .back-button {
            position: absolute;
            top: 25px;
            left: 25px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 10px;
            border-radius: 50%;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            z-index: 100;
        }
    </style>
</head>
<body class="antialiased font-sans">

    <a href="{{ route('register') }}" class="back-button">
        <i data-lucide="chevron-left" class="w-6 h-6 stroke-[3px]"></i>
    </a>

    <div class="w-full max-w-[450px] px-6 z-10">
        <div class="text-center mb-6">
            <img src="{{ asset('assets/img/arah-putih.png') }}" alt="Logo ARAH" class="w-32 md:w-40 mx-auto drop-shadow-md mb-4">
            <h1 class="text-white text-3xl font-extrabold tracking-tight">Halo, Teman!</h1>
        </div>

        @if ($errors->any())
            <div class="bg-red-500/90 backdrop-blur-md text-white p-4 rounded-2xl mb-6 text-sm shadow-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('setup.profile') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="text-white font-bold ml-1">Nama Lengkap</label>
                <input type="text" name="name" class="input-field" required placeholder="Masukkan Nama Anda" value="{{ old('name') }}">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-white font-bold ml-1">Usia</label>
                    <input type="number" name="age" class="input-field" required placeholder="Contoh: 20" value="{{ old('age') }}">
                </div>
                
                <div class="relative" id="custom-select-container">
                    <label class="text-white font-bold ml-1 block">Hubungan</label>
                    
                    <div onclick="toggleDropdown()" id="select-trigger" 
                        class="input-field cursor-pointer flex justify-between items-center pr-3 transition-all active:scale-95">
                        <span id="selected-text" class="text-slate-400 truncate">Pilih...</span>
                        <i data-lucide="chevron-down" id="arrow-icon" class="w-5 h-5 text-[#5AA7FF] transition-transform duration-300 stroke-[3px]"></i>
                    </div>

                    <div id="dropdown-menu" 
                        class="hidden absolute left-0 w-full mt-2 bg-white rounded-2xl shadow-2xl z-[100] border border-blue-50 overflow-hidden opacity-0 scale-95 dropdown-animate origin-top">
                        <div onclick="selectOption('Keluarga')" class="px-5 py-3 hover:bg-blue-50 cursor-pointer text-slate-700 font-semibold border-b border-slate-50 transition-colors">Keluarga</div>
                        <div onclick="selectOption('Kerabat')" class="px-5 py-3 hover:bg-blue-50 cursor-pointer text-slate-700 font-semibold border-b border-slate-50 transition-colors">Kerabat</div>
                        <div onclick="selectOption('Teman')" class="px-5 py-3 hover:bg-blue-50 cursor-pointer text-slate-700 font-semibold transition-colors">Teman</div>
                    </div>

                    <input type="hidden" name="relation" id="relation-input" required>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full bg-white text-[#5AA7FF] font-extrabold py-4 rounded-[2rem] shadow-xl transition duration-300 transform hover:scale-[1.02] active:scale-95 text-xl tracking-wider uppercase">
                    Lanjut
                </button>
            </div>
        </form>
    </div>

    <img src="{{ asset('assets/img/karakter-arah.png') }}" class="character-img hidden lg:block" alt="Karakter ARAH">

    <script>
        lucide.createIcons();

        function toggleDropdown() {
            const menu = document.getElementById('dropdown-menu');
            const arrow = document.getElementById('arrow-icon');
            const isHidden = menu.classList.contains('hidden');

            if (isHidden) {
                menu.classList.remove('hidden');
                setTimeout(() => {
                    menu.classList.remove('opacity-0', 'scale-95');
                    menu.classList.add('opacity-100', 'scale-100');
                }, 10);
                arrow.style.transform = 'rotate(180deg)';
            } else {
                closeDropdown();
            }
        }

        function selectOption(val) {
            const textDisplay = document.getElementById('selected-text');
            textDisplay.innerText = val;
            textDisplay.classList.replace('text-slate-400', 'text-slate-800');
            document.getElementById('relation-input').value = val;
            closeDropdown();
        }

        function closeDropdown() {
            const menu = document.getElementById('dropdown-menu');
            const arrow = document.getElementById('arrow-icon');
            menu.classList.replace('opacity-100', 'opacity-0');
            menu.classList.replace('scale-100', 'scale-95');
            arrow.style.transform = 'rotate(0deg)';
            setTimeout(() => menu.classList.add('hidden'), 200);
        }

        // Tutup otomatis jika klik di luar
        window.onclick = function(e) {
            if (!document.getElementById('custom-select-container').contains(e.target)) {
                closeDropdown();
            }
        }
    </script>
</body>
</html>