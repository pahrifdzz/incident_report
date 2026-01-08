<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pelaporan Kejadian</title>
    <style>
        /* --- BAGIAN BACKGROUND (KUSTOMISASI DI SINI) --- */
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

            /* 👇 GANTI URL GAMBAR DI BAWAH INI DENGAN GAMBAR BACKGROUND ANDA SENDIRI 👇 */
            /* Contoh pakai gambar online bertema industri/safety */
            background-image: url('{{ asset('img/bgweb.jpg') }}');

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* Lapisan gelap transparan di atas background agar tulisan terbaca */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7); /* Sedikit lebih gelap (0.7) agar logo K3 menonjol */
            z-index: -1;
        }
        /* ---------------------------------------------- */


        /* KOTAK PUTIH TENGAH */
        .card-box {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            text-align: center;
            max-width: 420px;
            width: 85%;
            backdrop-filter: blur(5px);
        }

        /* AREA LOGO */
        .logo-container {
            margin-bottom: 25px;
        }
        .logo-img {
            /* 👇 Atur ukuran logo K3 di sini 👇 */
            width: 120px; /* Saya kecilkan sedikit dari 180px agar proporsional */
            height: auto;
            display: block;
            margin: 0 auto;
        }

        /* JUDUL */
        h1 {
            color: #1f2937;
            margin: 0 0 35px 0;
            font-size: 22px;
            font-weight: 700;
            line-height: 1.4;
        }

        /* TOMBOL */
        .btn {
            display: block;
            width: 100%;
            padding: 16px 0;
            margin-bottom: 15px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-sizing: border-box;
            border: none;
            cursor: pointer;
        }
        /* Tombol Pelaporan (Merah) */
        .btn-lapor {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);
        }
        .btn-lapor:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(239, 68, 68, 0.4);
        }

        /* Tombol Admin (Abu gelap) */
        .btn-admin {
            background-color: #374151;
            color: white;
        }
        .btn-admin:hover { background-color: #1f2937; transform: translateY(-2px); }

        .footer { font-size: 12px; color: #9ca3af; margin-top: 25px; }
    </style>
</head>
<body>

    <div class="overlay"></div>

    <div class="card-box">

        <div class="logo-container">
            <img src="{{ asset('img/dynaplast-logo.jpg') }}" alt="logo dp" class="logo-img">
        </div>

        <h1>HS Report</h1>

        <a href="{{ url('/lapor') }}" class="btn btn-lapor">
            <span style="margin-right: 8px;">📝</span> Buat Laporan Baru
        </a>

        <a href="{{ url('/login') }}" class="btn btn-admin">
            <span style="margin-right: 8px;">🔐</span> Masuk sebagai Admin
        </a>

        <div class="footer">PT Dynaplast DP02 Jatake | © 2026</div>
    </div>

</body>
</html>
