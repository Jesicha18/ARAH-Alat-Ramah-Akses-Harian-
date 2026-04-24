<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat & Ketentuan - ARAH</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('assets/img/arahh.jpeg') }}">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #ffffff;
            color: #0f172a;
            line-height: 1.7;
        }

        .terms-container {
            padding: 60px 20px;
            max-width: 800px; /* Lebih ramping supaya teks enak dibaca */
            margin: 0 auto;
            min-height: 100vh;
            position: relative;
        }

        /* Tombol Back Bulat Minimalis (<) - Konsisten */
        .btn-back-minimal {
            position: absolute;
            top: 40px;
            left: -60px; /* Di layar lebar dia agak keluar dari teks */
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 50%;
            color: #475569;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-back-minimal:hover {
            background-color: #0369A1;
            color: white;
            border-color: #0369A1;
            transform: translateX(-3px);
        }

        .terms-header {
            margin-bottom: 50px;
            margin-top: 20px;
        }

        .terms-header h1 {
            font-size: 36px;
            font-weight: 800;
            letter-spacing: -1px;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .last-update {
            font-size: 13px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .content-section {
            margin-bottom: 40px;
        }

        .content-section h2 {
            font-size: 20px;
            font-weight: 700;
            color: #0369A1; /* Biru ARAH */
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .content-section p, .content-section li {
            color: #475569;
            font-size: 16px;
        }

        .content-section ul {
            padding-left: 20px;
            list-style-type: disc;
        }

        .content-section li {
            margin-bottom: 10px;
        }

        @media (max-width: 1024px) {
            .btn-back-minimal { position: relative; left: 0; top: 0; margin-bottom: 30px; }
        }
    </style>
</head>
<body>

<div class="terms-container">
    <a href="{{ route('profile') }}" class="btn-back-minimal" title="Kembali">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
    </a>

    <div class="terms-header">
        <span class="last-update">Terakhir Diperbarui: 20 Maret 2026</span>
        <h1>Syarat & Ketentuan</h1>
    </div>

    <div class="content-section">
        <h2>1. Deskripsi Layanan</h2>
        <p>ARAH menyediakan platform monitoring real-time berbasis IoT untuk memantau lokasi (GPS) dan kesehatan (BPM) pengguna alat bantu tunanetra. Layanan ini dirancang sebagai alat pendukung, bukan pengganti pengawasan manusia sepenuhnya.</p>
    </div>

    <div class="content-section">
        <h2>2. Batasan Tanggung Jawab</h2>
        <p>Pengguna memahami dan menyetujui bahwa ARAH tidak bertanggung jawab atas:</p>
        <ul>
            <li>Ketidakakuratan data GPS yang disebabkan oleh gangguan sinyal satelit atau kondisi cuaca.</li>
            <li>Kegagalan pengiriman data akibat masalah koneksi internet pada perangkat keras (Hardware) atau smartphone pendamping.</li>
            <li>Kejadian darurat yang tidak terpantau akibat baterai alat yang habis atau kerusakan fisik pada perangkat keras.</li>
        </ul>
    </div>

    <div class="content-section">
        <h2>3. Privasi Data</h2>
        <p>Kami sangat menjaga privasi Anda. Data lokasi dan detak jantung pengguna hanya dapat diakses oleh akun pendamping yang terdaftar secara sah melalui sistem enkripsi kami. Kami tidak akan membagikan data ini kepada pihak ketiga tanpa izin pengguna.</p>
    </div>

    <div class="content-section">
        <h2>4. Kewajiban Pengguna</h2>
        <p>Sebagai pendamping, Anda berkewajiban untuk:</p>
        <ul>
            <li>Menjaga kerahasiaan informasi akun dan password Anda.</li>
            <li>Memastikan perangkat keras ARAH dalam kondisi daya yang cukup sebelum digunakan.</li>
            <li>Menggunakan data monitoring hanya untuk keperluan keselamatan pengguna tunanetra.</li>
        </ul>
    </div>

    <div class="content-section">
        <h2>5. Perubahan Layanan</h2>
        <p>ARAH berhak melakukan pembaruan fitur atau perubahan sistem sewaktu-waktu guna meningkatkan performa monitoring dan keamanan pengguna.</p>
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

</body>
</html>