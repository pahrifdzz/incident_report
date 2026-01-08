<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - Safety System</title>
    <style>
        /* --- 1. RESET & SETUP DASAR --- */
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
            background-image: url('{{ asset('img/bgweb.jpg') }}');
            background-size: cover;
            background-position: center;
        }

        /* Overlay Gelap Transparan */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(31, 41, 55, 0.85); /* Abu gelap transparan */
            z-index: -1;
        }

        /* --- 2. KOTAK LOGIN --- */
        .login-card {
            background-color: #ffffff;
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            text-align: center;
            box-sizing: border-box;
        }

        /* Header Teks */
        .login-header h2 { margin: 0 0 10px 0; color: #1f2937; font-size: 24px; }
        .login-header p { margin: 0 0 25px 0; color: #6b7280; font-size: 14px; }

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
            outline: none; border-color: #ef4444; /* Merah saat aktif */
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        /* Checkbox Remember Me */
        .checkbox-group {
            display: flex; align-items: center; justify-content: space-between;
            font-size: 13px; color: #4b5563; margin-bottom: 20px;
        }

        .checkbox-wrapper { display: flex; align-items: center; }
        .checkbox-wrapper input { margin-right: 8px; cursor: pointer; }

        /* Link Lupa Password */
        .forgot-link { color: #6b7280; text-decoration: none; }
        .forgot-link:hover { color: #ef4444; text-decoration: underline; }

        /* Tombol Login */
        .btn-login {
            width: 100%; padding: 14px;
            background-color: #1f2937; /* Hitam Admin */
            color: white; border: none; border-radius: 8px;
            font-size: 16px; font-weight: bold; cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-login:hover { background-color: #000000; }

        /* Pesan Error & Status */
        .error-msg { color: #dc2626; font-size: 12px; margin-top: 5px; display: block; }
        .status-msg {
            color: #047857; background: #d1fae5; padding: 10px;
            border-radius: 6px; font-size: 13px; margin-bottom: 15px;
        }

        /* Link Kembali */
        .back-link {
            display: block; margin-top: 25px; color: #9ca3af;
            text-decoration: none; font-size: 13px;
        }
        .back-link:hover { color: #fff; } /* Putih saat hover karena di atas overlay gelap (opsional, tapi di sini card putih jadi pakai warna gelap) */
        .back-link-in-card { color: #6b7280; text-decoration: none; font-size: 13px; display: block; margin-top: 20px; }
        .back-link-in-card:hover { color: #ef4444; }

    </style>
</head>
<body>

    <div class="overlay"></div>

    <div class="login-card">
        <img src="{{ asset('img/dynaplast-logo.jpg') }}" alt="logo dp" style="width: 30%; height: auto; margin-bottom: 15px;">
        <div class="login-header">
            <h2>Admin Portal</h2>
            <p>Masuk untuk mengelola data insiden</p>
        </div>

        @if (session('status'))
            <div class="status-msg">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-input"
                       value="{{ old('email') }}" required autofocus autocomplete="username"
                       placeholder="admin@perusahaan.com">

                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-input"
                       required autocomplete="current-password" placeholder="••••••••">

                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="checkbox-group">
                <label for="remember_me" class="checkbox-wrapper">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>Ingat saya</span>
                </label>
            </div>

            <button type="submit" class="btn-login">
                LOG IN
            </button>
        </form>

        <a href="{{ url('/') }}" class="back-link-in-card">
            ← Kembali ke Halaman Utama
        </a>
    </div>

</body>
</html>
