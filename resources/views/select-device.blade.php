<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARAH - Pilih Perangkat</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: linear-gradient(180deg, #5AA7FF 0%, #A3CDFF 100%);
            margin: 0;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* TOMBOL BACK ALA REGISTER */
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

        .user-card:hover .icon-box {
            transform: scale(1.05);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
        }

        .icon-box {
            transition: all 0.3s ease;
        }

        .modal-input {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 12px 20px;
            width: 100%;
            border: 1px solid #e2e8f0;
            outline: none;
        }

        .swal2-popup {
            border-radius: 40px !important;
            padding: 2rem !important;
        }
        .swal2-title {
            font-weight: 800 !important;
            color: #1e293b !important;
        }
    </style>
</head>
<body class="flex flex-col items-center pt-24 pb-20 px-6 relative antialiased">

    <a href="{{ route('login') }}" class="back-button" title="Kembali ke Login">
        <i data-lucide="chevron-left" class="w-7 h-7 stroke-[3px]"></i>
    </a>

    <div class="w-full max-w-4xl flex flex-col items-center relative z-10">
        
        <header class="w-full flex flex-col items-center mb-20 text-center"> 
            <div class="flex flex-col items-center gap-4 mb-4">
                <img src="{{ asset('assets/img/arah-putih.png') }}" 
                     class="w-32 md:w-40 h-auto object-contain drop-shadow-md" 
                     alt="Logo ARAH">
                <h2 class="text-3xl md:text-4xl font-medium text-white">
                    Halo, <span class="font-extrabold">{{ Auth::user()->name ?? 'Jesicha' }}</span> 👋
                </h2>
            </div>
            <p class="text-xl text-white/90 font-medium">
                Siapakah teman tunanetra yang mau kamu pantau hari ini?
            </p>
        </header>

        <main class="w-full">
            <div class="flex flex-wrap justify-center gap-12">
                
                @foreach($daftar_tunanetra as $tuna)
                    <div onclick="showOptions('{{ $tuna->id }}', '{{ $tuna->nama_tunanetra }}')" 
                         class="user-card flex flex-col items-center group cursor-pointer">
                        
                        <div class="icon-box w-44 h-44 rounded-[2.5rem] bg-white flex items-center justify-center mb-6 shadow-lg group-hover:bg-blue-50">
                            <i data-lucide="user" class="w-20 h-20 text-[#5AA7FF] stroke-[2]"></i>
                        </div>
                        <span class="text-xl font-bold text-white uppercase tracking-widest drop-shadow-sm">
                            {{ $tuna->nama_tunanetra }}
                        </span>

                        <form id="delete-form-{{ $tuna->id }}" action="{{ route('delete.device', $tuna->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                @endforeach

                <button onclick="openModal()" class="flex flex-col items-center group">
                    <div class="w-44 h-44 border-4 border-dashed border-white/60 rounded-[2.5rem] flex items-center justify-center mb-6 transition-all group-hover:border-white group-hover:bg-white/10">
                        <i data-lucide="plus" class="w-16 h-16 text-white/60 group-hover:text-white stroke-[3]"></i>
                    </div>
                    <span class="text-xl font-bold text-white/60 group-hover:text-white uppercase tracking-widest">Tambah</span>
                </button>
            </div>
        </main>
    </div>

    {{-- MODAL TAMBAH --}}
    <div id="modalAddFriend" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/40 backdrop-blur-sm">
        <div class="bg-white w-full max-w-2xl rounded-[40px] p-10 relative shadow-2xl">
            <div class="flex justify-between items-start mb-8">
                <h2 class="text-2xl font-medium text-gray-800">
                    Tambah <span class="font-bold text-[#5AA7FF]">Teman Tunanetra</span>
                </h2>
                <button onclick="closeModal()" class="text-slate-400 hover:text-red-500 transition-colors">
                    <i data-lucide="x"></i>
                </button>
            </div>

            <form action="{{ route('add.device') }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-1">
                    <label class="text-slate-600 font-semibold ml-1">Nama Lengkap</label>
                    <input type="text" name="nama_tunanetra" placeholder="Masukkan nama tunanetra" required
                           class="modal-input focus:ring-2 focus:ring-[#5AA7FF] border-slate-200">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-slate-600 font-semibold ml-1">Status Hubungan</label>
                        <select name="status_hubungan" required class="modal-input border-slate-200">
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="Keluarga">Keluarga</option>
                            <option value="Teman">Teman</option>
                            <option value="Kerabat">Kerabat</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-slate-600 font-semibold ml-1">Jenis Kebutaan</label>
                        <select name="jenis_kebutaan" required class="modal-input border-slate-200">
                            <option value="" disabled selected>Pilih Jenis</option>
                            <option value="Total">Buta Total</option>
                            <option value="Low Vision">Low Vision</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-slate-600 font-semibold ml-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" required class="modal-input border-slate-200">
                    </div>
                    <div class="space-y-1">
                        <label class="text-slate-600 font-semibold ml-1">Kode Alat</label>
                        {{-- DISINI PERUBAHANNYA: Tambah oninput toUpperCase --}}
                        <input type="text" name="device_code" placeholder="Contoh: ARAH-01" required 
                               oninput="this.value = this.value.toUpperCase()"
                               class="modal-input border-slate-200">
                    </div>
                </div>

                <div class="pt-8 flex gap-4">
                    <button type="button" onclick="closeModal()" class="flex-1 py-4 font-bold text-slate-400 bg-slate-100 rounded-2xl hover:bg-slate-200 transition-all">
                        BATAL
                    </button>
                    <button type="submit" class="flex-[2] py-4 font-extrabold text-white bg-[#5AA7FF] rounded-2xl shadow-lg hover:bg-[#4a96ee] transition-all uppercase tracking-wider">
                        SIMPAN PERANGKAT
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function showOptions(id, nama) {
            Swal.fire({
                title: 'Pilih Tindakan',
                text: "Apa yang ingin Anda lakukan untuk profil " + nama + "?",
                icon: 'question',
                showCancelButton: true,
                showDenyButton: true,
                confirmButtonText: 'Pantau Sekarang',
                denyButtonText: 'Hapus Profil',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#5AA7FF',
                denyButtonColor: '#ef4444',
                cancelButtonColor: '#cbd5e1',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/dashboard/" + id;
                } else if (result.isDenied) {
                    confirmDelete(id, nama);
                }
            });
        }

        function confirmDelete(id, nama) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data " + nama + " akan hilang permanen dari database!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#cbd5e1',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        function openModal() { 
            const modal = document.getElementById('modalAddFriend');
            modal.classList.remove('hidden'); 
            modal.classList.add('flex'); 
        }
        function closeModal() { 
            const modal = document.getElementById('modalAddFriend');
            modal.classList.add('hidden'); 
            modal.classList.remove('flex'); 
        }
        window.onclick = function(event) {
            const modal = document.getElementById('modalAddFriend');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>