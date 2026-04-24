<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARAH - Alat Ramah Akses Harian</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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
            height: 100vh;
            margin: 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .fade-in {
            animation: fadeIn 1.2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="antialiased font-sans">

    <a href="{{ route('login') }}" class="absolute inset-0 flex items-center justify-center no-underline px-4">
        
        <div class="text-center fade-in flex flex-col items-center -mt-10 md:-mt-16 lg:-mt-20"> 
            
            <div class="relative">
                <img src="{{ asset('assets/img/arah-putih.png') }}" 
                     alt="Logo ARAH" 
                     class="w-[320px] md:w-[580px] lg:w-[820px] h-auto object-contain">
            </div>

<p class="text-white text-[11px] md:text-xl lg:text-2xl tracking-widest font-medium uppercase opacity-95 -mt-8 md:-mt-16 lg:-mt-24">
    Alat Ramah Akses Harian
</p>
        </div>

    </a>

</body>
</html>