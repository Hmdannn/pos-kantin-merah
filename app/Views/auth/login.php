<?php
$error = session()->getFlashdata('error');
$success = session()->getFlashdata('success');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kantin Merah POS</title>
    
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: radial-gradient(circle at top right, #9f1239, #7a0f1d, #4c0519);
            color: #1f2937;
            font-family: var(--font-primary);
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            padding: 40px 36px;
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
        }

        /* Aksen garis atas kartu */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #9f1239, #f43f5e);
        }

        .login-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .logo {
            width: 72px;
            height: 72px;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            background: linear-gradient(135deg, #9f1239, #e11d48);
            color: #fff;
            font-size: 26px;
            font-weight: 800;
            box-shadow: 0 10px 20px rgba(159, 18, 57, 0.4);
            letter-spacing: -1px;
        }

        h1 {
            margin: 0 0 6px;
            font-size: 24px;
            color: #0f172a;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .subtitle {
            margin: 0;
            color: #64748b;
            font-size: 14px;
            font-weight: 400;
        }

        .badge-campus {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 12px;
            background: #fff1f2;
            color: #9f1239;
            font-size: 11px;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 9999px;
            letter-spacing: 0.3px;
            border: 1px solid #fecdd3;
        }

        .alert {
            margin-bottom: 20px;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-4px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-error {
            background: #fff5f5;
            color: #991b1b;
            border: 1px solid #f87171;
        }

        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #4ade80;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
        }

        .input-wrapper {
            position: relative;
        }

        input {
            width: 100%;
            padding: 13px 16px;
            border: 1.5px solid #cbd5e1;
            border-radius: 12px;
            outline: none;
            font-size: 14px;
            color: #0f172a;
            background: #f8fafc;
            transition: all 0.2s ease;
        }

        input:hover {
            border-color: #94a3b8;
        }

        input:focus {
            background: #ffffff;
            border-color: #9f1239;
            box-shadow: 0 0 0 4px rgba(159, 18, 57, 0.12);
        }

        .password-wrapper input {
            padding-right: 95px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            border: none;
            background: #f1f5f9;
            color: #64748b;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 10px;
            border-radius: 8px;
            transition: all 0.15s ease;
        }

        .toggle-password:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        .submit-button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #9f1239, #e11d48);
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(159, 18, 57, 0.35);
            transition: all 0.2s ease;
            margin-top: 4px;
        }

        .submit-button:hover {
            background: linear-gradient(135deg, #881337, #be123c);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(159, 18, 57, 0.45);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        .submit-button:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        /* Demo Account Quick Switcher */
        .demo-box {
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px dashed #e2e8f0;
        }

        .demo-title {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 12px;
            text-align: center;
        }

        .demo-buttons {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .btn-demo {
            padding: 10px 6px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            color: #334155;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s ease;
        }

        .btn-demo:hover {
            background: #fff1f2;
            border-color: #fecdd3;
            color: #9f1239;
            transform: translateY(-1px);
        }

        .btn-demo small {
            display: block;
            font-size: 10px;
            color: #64748b;
            font-weight: 500;
            margin-top: 3px;
        }

        .footer {
            margin-top: 26px;
            text-align: center;
            color: #64748b;
            font-size: 13px;
            border-top: 1px solid #f1f5f9;
            padding-top: 20px;
        }

        .footer a {
            color: #9f1239;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.15s ease;
        }

        .footer a:hover {
            color: #4c0519;
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 30px 20px;
                border-radius: 20px;
            }
            .demo-buttons {
                grid-template-columns: repeat(1, 1fr);
            }
        }
    </style>
    <link rel="stylesheet" href="<?= base_url('assets/css/formal-ui.css') ?>">
    <?= view('layout/typography') ?>
</head>

<body>
    <main class="login-card">

        <header class="login-header">
            <div class="logo">KM</div>
            <h1>Kantin Merah POS</h1>
            <p class="subtitle">Silakan masuk sesuai peran operasional Anda.</p>
            <div class="badge-campus">
                <span>📍</span> Studi Kasus: UNP Kampus 1
            </div>
        </header>

        <?php if ($error): ?>
            <div class="alert alert-error" role="alert">
                <span>⚠️</span> <div><?= esc($error) ?></div>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success" role="status">
                <span>✅</span> <div><?= esc($success) ?></div>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('login/attempt') ?>" method="post" id="loginForm">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= esc(old('email') ?? '') ?>"
                    placeholder="nama@kantinmerah.com"
                    autocomplete="username"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper password-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        required
                    >
                    <button
                        type="button"
                        class="toggle-password"
                        id="togglePassword"
                    >
                        Lihat
                    </button>
                </div>
            </div>

            <button type="submit" class="submit-button" id="submitButton">
                Masuk ke Sistem
            </button>
        </form>

        <!-- Quick Fill Role Selector -->
        <div class="demo-box">
            <div class="demo-title">Pilih Akun Demo (1-Klik Instan)</div>
            <div class="demo-buttons">
                <button type="button" class="btn-demo" onclick="fillRole('kasir@kantinmerah.com', 'password123', true)">
                    💰 Kasir
                    <small>Shift & Bayar</small>
                </button>
                <button type="button" class="btn-demo" onclick="fillRole('dapur@kantinmerah.com', 'password123', true)">
                    🍳 Dapur
                    <small>FIFO & Masak</small>
                </button>
                <button type="button" class="btn-demo" onclick="fillRole('manajerial@kantinmerah.com', 'password123', true)">
                    📊 Manajer
                    <small>Laporan & Menu</small>
                </button>
            </div>
        </div>

        <footer class="footer">
            <div style="margin-bottom: 8px;">
                Customer / Pembeli? <a href="<?= site_url('customer') ?>" target="_blank">Buka Menu Pesan Mandiri →</a>
            </div>
            <small style="color: #94a3b8;">
                Belum ada akun di database? <a href="<?= site_url('test/init-users') ?>" target="_blank" style="color: #64748b;">Inisialisasi User Demo</a>
            </small>
        </footer>

    </main>

    <script>
        const passwordInput = document.getElementById('password');
        const emailInput = document.getElementById('email');
        const togglePassword = document.getElementById('togglePassword');
        const loginForm = document.getElementById('loginForm');
        const submitButton = document.getElementById('submitButton');

        togglePassword.addEventListener('click', function () {
            const show = passwordInput.type === 'password';
            passwordInput.type = show ? 'text' : 'password';
            togglePassword.textContent = show ? 'Sembunyi' : 'Lihat';
        });

        loginForm.addEventListener('submit', function () {
            submitButton.disabled = true;
            submitButton.textContent = 'Memverifikasi...';
        });

        function fillRole(email, password, autoSubmit = false) {
            emailInput.value = email;
            passwordInput.value = password;
            if (autoSubmit) {
                submitButton.disabled = true;
                submitButton.textContent = 'Memverifikasi...';
                loginForm.submit();
            } else {
                emailInput.style.borderColor = '#9f1239';
                passwordInput.style.borderColor = '#9f1239';
                setTimeout(() => {
                    emailInput.style.borderColor = '';
                    passwordInput.style.borderColor = '';
                }, 600);
            }
        }
    </script>
</body>
</html>
