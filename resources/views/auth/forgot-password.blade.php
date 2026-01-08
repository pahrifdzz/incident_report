<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Safety System</title>
    <style>
        /* --- 1. RESET & SETUP DASAR (Sama dengan Login) --- */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f3f4f6;

            /* Background Image (Tema Industri) */
            background-image: url('https://source.unsplash.com/1920x1080/?industry,building,safety');
            background-size: cover;
            background-position: center;
        }

        /* Overlay Gelap */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(31, 41, 55, 0.85);
            z-index: -1;
        }

        /* --- 2. KOTAK RESET --- */
        .card-box {
            background-color: #ffffff;
            width: 100%;
            max-width: 450px; /* Sedikit lebih lebar untuk teks penjelasan */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            text-align: center;
            box-sizing: border-box;
        }

        /* Header Teks */
        .header-title { margin: 0 0 15px 0; color: #1f2937; font-size: 22px; }
        .header-desc {
            margin: 0 0 25px 0;
            color: #4b5563;
            font-size: 14px;
            line-height: 1.5;
            text-align: left; /* Teks penjelasan rata kiri agar enak dibaca */
        }

        /* --- 3. ELEMEN FORM --- */
        .form-group { margin-bottom: 20px; text-align: left; }

        .form-label {
            display: block; margin-bottom: 8px; font-weight: 600;
            color: #374151; font-size: 14px;
        }

        .form-input {
            width: 100%; padding: 12px 15px;
            border: 1px solid #d1d5db; border-radius: 8px;
            font-size: 15px; transition: border-color 0.3s;
            box-sizing: border-box;
        }

        .form-input:focus {
            outline: none; border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        /* Tombol Kirim */
        .btn-submit {
            width: 100%; padding: 14px;
            background-color: #ef4444; /* Merah (Action Button) */
            color: white; border: none; border-radius: 8px;
            font-size: 15px; font-weight: bold; cursor: pointer;
            transition: background-color 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .btn-submit:hover { background-color: #dc2626; }

        /* Pesan Status Sukses */
        .alert-success {
            color: #065f46; background-color: #d1fae5;
            padding: 12px; border-radius: 6px;
            font-size: 13px; margin-bottom: 20px;
            text-align: left; border: 1px solid #a7f3d0;
        }

        /* Pesan Error */
        .error-msg { color: #dc2626; font-size: 12px; margin-top: 5px; display: block; }

        /* Link Kembali */
        .back-link {
            display: block; margin-top: 20px; color: #6b7280;
            text-decoration: none; font-size: 13px;
        }
        .back-link:hover { color: #1f2937; text-decoration: underline; }

    </style>
</head>
<body>

    <div class="overlay"></div>

    <div class="card-box">
        <div style="font-size: 40px; margin-bottom: 15px;">🔑</div>

        <h2 class="header-title">Lupa Password?</h2>

        <p class="header-desc">
            Jangan khawatir. Masukkan alamat email yang terdaftar, dan kami akan mengirimkan tautan untuk mereset password Anda.
        </p>

        @if (session('status'))
            <div class="alert-success">
                ✅ {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-input"
                       value="{{ old('email') }}" required autofocus
                       placeholder="nama@perusahaan.com">

                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn-submit">
                    Kirim Link Reset Password
                </button>
            </div>
        </form>

        <a href="{{ route('login') }}" class="back-link">
            ← Batal, kembali ke halaman Login
        </a>
    </div>

</body>
</html>
