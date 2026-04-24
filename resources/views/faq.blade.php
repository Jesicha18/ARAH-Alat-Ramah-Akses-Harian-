<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - ARAH</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #ffffff;
            color: #0f172a;
        }

        .faq-main-container {
            padding: 60px 20px;
            max-width: 1200px;
            margin: 0 auto;
            min-height: 100vh;
            position: relative;
        }

        /* Tombol Back Bulat Minimalis (<) */
        .btn-back-minimal {
            position: absolute;
            top: 40px;
            left: 20px;
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
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        }

        .btn-back-minimal:hover {
            background-color: #0369A1;
            color: white;
            border-color: #0369A1;
            transform: translateX(-3px);
            box-shadow: 0 5px 15px rgba(3, 105, 161, 0.2);
        }

        /* Header Judul */
        .faq-header-center {
            text-align: center;
            margin-bottom: 70px;
            margin-top: 20px;
        }

        .faq-header-center h1 {
            font-size: 42px;
            font-weight: 800;
            letter-spacing: -1.5px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        .faq-header-center p {
            color: #64748b;
            font-size: 16px;
            max-width: 550px;
            margin: 0 auto;
        }

        /* Grid FAQ */
        .faq-grid-custom {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        .faq-card-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        summary::marker, summary::-webkit-details-marker { display: none; }

        .faq-trigger-btn {
            width: 100%;
            padding: 26px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            list-style: none;
            cursor: pointer;
            outline: none;
        }

        .faq-trigger-btn span {
            font-size: 17px;
            font-weight: 700;
            color: #1e293b;
        }

        .faq-circle-icon {
            width: 36px;
            height: 36px;
            background-color: #e2e8f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .faq-circle-icon svg {
            width: 18px;
            height: 18px;
            fill: #64748b;
            transition: transform 0.3s ease;
        }

        /* Smooth Animation */
        .faq-answer-wrapper {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-in-out, opacity 0.3s ease-in-out;
        }

        details[open] .faq-card-box {
            border-color: #0369A1;
            background-color: #ffffff;
            box-shadow: 0 15px 30px rgba(3, 105, 161, 0.1);
        }

        details[open] .faq-trigger-btn span { color: #0369A1; }
        details[open] .faq-circle-icon { background-color: #0369A1; }
        details[open] .faq-circle-icon svg { fill: #ffffff; transform: rotate(180deg); }

        details[open] .faq-answer-wrapper {
            max-height: 500px;
            opacity: 1;
            padding-bottom: 30px;
        }

        .faq-answer-text {
            padding: 0 30px;
            color: #475569;
            font-size: 15px;
            line-height: 1.8;
        }

        @media (max-width: 992px) {
            .faq-grid-custom { grid-template-columns: 1fr; }
            .btn-back-minimal { top: 20px; left: 20px; }
        }
    </style>
</head>
<body>

<div class="faq-main-container">
    <a href="{{ route('profile') }}" class="btn-back-minimal" title="Kembali">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
    </a>

    <div class="faq-header-center">
        <h1>Frequently Asked Questions</h1>
        <p>Temukan solusi cepat untuk kendala Anda pada platform ARAH.</p>
    </div>

    <div class="faq-grid-custom">
        @php
            $list_faq = [
                ['q' => 'Apa itu platform ARAH?', 'a' => 'ARAH adalah sistem monitoring real-time untuk pendamping tunanetra guna memantau lokasi (GPS) dan kesehatan jantung (BPM) pengguna alat.'],
                ['q' => 'Apakah lokasi GPS selalu akurat?', 'a' => 'Akurasi GPS sangat tinggi di area terbuka (outdoor). Di dalam gedung, akurasi mungkin sedikit berkurang karena keterbatasan sinyal satelit.'],
                ['q' => 'Bagaimana jika baterai alat habis?', 'a' => 'Dashboard akan menampilkan persentase baterai. Pendamping disarankan mengingatkan pengguna alat jika baterai sudah di bawah 20%.'],
                ['q' => 'Apa arti indikator warna pada BPM?', 'a' => 'Hijau berarti detak jantung normal, Kuning berarti rendah, dan Merah berarti detak jantung di atas normal (perlu perhatian).'],
                ['q' => 'Bagaimana cara menambah perangkat baru?', 'a' => 'Anda bisa masuk ke menu "Pilih Device" di dashboard utama, lalu masukkan ID unik perangkat ARAH yang ingin dihubungkan.'],
                ['q' => 'Apakah data monitoring aman?', 'a' => 'Sangat aman. Data dienkripsi secara end-to-end dan hanya akun pendamping resmi yang bisa melihat data real-time tersebut.'],
            ];
        @endphp

        @foreach($list_faq as $item)
        <div class="faq-card-box shadow-sm mb-3">
            <details>
                <summary class="faq-trigger-btn">
                    <span>{{ $item['q'] }}</span>
                    <div class="faq-circle-icon">
                        <svg viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                    </div>
                </summary>

                <div class="faq-answer-wrapper border-t border-slate-100 pt-4 mt-1">
                    <div class="faq-answer-text">
                        {{ $item['a'] }}
                    </div>
                </div>
            </details>
        </div>
        @endforeach
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