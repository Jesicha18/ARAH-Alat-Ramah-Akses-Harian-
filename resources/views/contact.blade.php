<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - ARAH</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #ffffff;
            color: #0f172a;
        }

        .contact-container {
            padding: 60px 20px;
            max-width: 1200px;
            margin: 0 auto;
            min-height: 100vh;
            position: relative;
        }

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
        }

        .btn-back-minimal:hover {
            background-color: #0369A1;
            color: white;
            border-color: #0369A1;
            transform: translateX(-3px);
        }

        .contact-header {
            text-align: center;
            margin-bottom: 70px;
            margin-top: 20px;
        }

        .contact-header h1 {
            font-size: 42px;
            font-weight: 800;
            letter-spacing: -1.5px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        .contact-header p {
            color: #64748b;
            font-size: 16px;
            max-width: 550px;
            margin: 0 auto;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .contact-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            padding: 40px;
            text-align: center;
            transition: all 0.4s ease;
            text-decoration: none;
            display: block;
        }

        .contact-card:hover {
            border-color: #0369A1;
            background: #ffffff;
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(3, 105, 161, 0.1);
        }

        .icon-box {
            width: 70px;
            height: 70px;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .bg-wa { background-color: #dcfce7; color: #16a34a; }
        .bg-ig { background-color: #fdf2f8; color: #db2777; }

        .contact-card:hover .icon-box.bg-wa { background-color: #16a34a; color: white; }
        .contact-card:hover .icon-box.bg-ig { background-color: #db2777; color: white; }

        .contact-card h3 {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 10px;
            color: #1e293b;
        }

        .contact-card p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        .operational-info {
            grid-column: span 2;
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            border-top: 1px solid #f1f5f9;
            color: #334865;
            font-size: 13px;
        }

        /* Styling Footer */
        .main-footer {
            margin-top: 100px;
            border-top: 1px solid #f1f5f9;
            padding-top: 50px;
            padding-bottom: 40px;
        }

        .footer-logo {
            font-weight: 900;
            font-size: 24px;
            letter-spacing: -1px;
            text-transform: uppercase;
            font-style: italic;
            color: #0f172a;
        }

        @media (max-width: 768px) {
            .contact-grid { grid-template-columns: 1fr; }
            .operational-info { grid-column: span 1; }
            .footer-flex { flex-direction: column; text-align: center; }
        }
    </style>
</head>
<body>

<div class="contact-container">
    <a href="{{ route('profile') }}" class="btn-back-minimal" title="Kembali">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
    </a>

    <div class="contact-header">
        <h1>Hubungi Kami</h1>
        <p>Punya kendala atau pertanyaan lebih lanjut? Tim ARAH siap membantu Anda melalui saluran di bawah ini.</p>
    </div>

    <div class="contact-grid">
        <a href="https://wa.me/6285285188448?text=Halo%20Admin%20ARAH%2C%20saya%20butuh%20bantuan%20terkait%20alat%20monitoring." target="_blank" class="contact-card">
            <div class="icon-box bg-wa">
                <i data-lucide="phone" class="w-8 h-8"></i>
            </div>
            <h3>WhatsApp Support</h3>
            <p>Respon cepat untuk kendala teknis dan bantuan darurat alat monitoring Anda.</p>
        </a>

        <a href="https://www.instagram.com/arah_smartcane" target="_blank" class="contact-card">
            <div class="icon-box bg-ig">
                <i data-lucide="instagram" class="w-8 h-8"></i>
            </div>
            <h3>Instagram Official</h3>
            <p>Ikuti update terbaru, tips penggunaan alat, dan informasi komunitas ARAH.</p>
        </a>

        <div class="operational-info">
            Jam Operasional: Senin - Sabtu (08.00 - 17.00 WIB). <br>
            Kami akan berusaha membalas pesan Anda secepat mungkin.
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
</script>
</body>
</html>