<?php
$error = session()->getFlashdata('error');
$success = session()->getFlashdata('success');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kantin Merah POS - Login</title>
    
    <style>
        :root {
            --brand-red: #e11d48;
            --brand-red-dark: #be123c;
            --brand-red-light: #fff1f2;
            --brand-red-soft: #ffe4e6;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-light: #e2e8f0;
            --bg-page: #f8fafc;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            background: var(--bg-page);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: var(--text-dark);
            -webkit-font-smoothing: antialiased;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: #ffffff;
            border-radius: 28px;
            padding: 38px 26px 30px;
            box-shadow: 0 20px 45px -12px rgba(15, 23, 42, 0.08), 0 4px 16px -2px rgba(15, 23, 42, 0.03);
            text-align: center;
        }

        /* App Logo (KM in red squircle) */
        .app-logo {
            width: 84px;
            height: 84px;
            margin: 0 auto 16px;
            background: linear-gradient(145deg, #ff334b 0%, #e11438 55%, #b91030 100%);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 16px 30px -4px rgba(225, 29, 72, 0.4);
        }

        .app-logo span {
            font-family: "Times New Roman", Times, "Playfair Display", Georgia, serif;
            font-style: italic;
            font-weight: 900;
            font-size: 42px;
            color: #ffffff;
            letter-spacing: -2px;
            line-height: 1;
            margin-right: 2px;
            user-select: none;
        }

        /* Heading */
        .app-title {
            font-size: 24px;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.02em;
            margin-bottom: 6px;
        }

        .app-subtitle {
            font-size: 13.5px;
            color: var(--text-muted);
            margin-bottom: 14px;
        }

        /* Location Badge */
        .location-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--brand-red-light);
            color: var(--brand-red);
            font-size: 11.5px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 999px;
            margin-bottom: 22px;
            border: 1px solid var(--brand-red-soft);
        }

        .location-badge svg {
            flex-shrink: 0;
        }

        /* Alert Messages */
        .alert {
            margin-bottom: 16px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 12.5px;
            font-weight: 600;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-error {
            background: #fff5f5;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .alert-success {
            background: #f0fdf4;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        /* Form Controls */
        .form-group {
            text-align: left;
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 7px;
        }

        .input-control {
            width: 100%;
            height: 46px;
            padding: 0 14px;
            border: 1.5px solid var(--border-light);
            border-radius: 12px;
            font-size: 14px;
            color: var(--text-dark);
            background: #ffffff;
            outline: none;
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .input-control:focus {
            border-color: var(--brand-red);
            box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.12);
        }

        .password-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-wrap .input-control {
            padding-right: 76px;
        }

        .toggle-btn {
            position: absolute;
            right: 8px;
            background: var(--brand-red-light);
            color: var(--brand-red);
            border: none;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s ease;
        }

        .toggle-btn:hover {
            background: var(--brand-red-soft);
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            height: 48px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #f43f5e 0%, #e11d48 50%, #be123c 100%);
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 8px 20px -3px rgba(225, 29, 72, 0.38);
            transition: all 0.2s ease;
            margin-top: 4px;
            font-family: inherit;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
            transform: translateY(-1px);
            box-shadow: 0 10px 24px -2px rgba(225, 29, 72, 0.45);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        /* Demo Divider */
        .demo-divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            margin: 24px 0 14px;
        }

        .demo-divider::before,
        .demo-divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--border-light);
        }

        .demo-divider:not(:empty)::before {
            margin-right: 10px;
        }

        .demo-divider:not(:empty)::after {
            margin-left: 10px;
        }

        /* Demo Account Cards (3 columns) */
        .demo-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .demo-card {
            background: #ffffff;
            border: 1px solid var(--border-light);
            border-radius: 14px;
            padding: 14px 6px 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
            position: relative;
        }

        .demo-card:hover {
            border-color: #fecdd3;
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(225, 29, 72, 0.08);
            background: #fffafa;
        }

        .demo-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: var(--brand-red-light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }

        .demo-role-name {
            font-size: 13px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 3px;
            text-align: center;
            padding: 0;
        }

        .demo-role-bottom {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            padding: 0;
        }

        .demo-role-desc {
            font-size: 10px;
            color: var(--text-muted);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
        }

        .demo-role-arrow {
            color: var(--brand-red);
            font-size: 11px;
            font-weight: 800;
            margin-left: 0;
            flex-shrink: 0;
            display: flex;
            align-items: center;
        }

        /* Footer link */
        .footer-link {
            margin-top: 20px;
            font-size: 12px;
            color: var(--text-muted);
        }

        .footer-link a {
            color: var(--brand-red);
            text-decoration: none;
            font-weight: 700;
        }

        .footer-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <main class="login-card">

        <!-- App Logo -->
        <div class="app-logo">
            <span>KM</span>
        </div>

        <!-- Heading -->
        <h1 class="app-title">Kantin Merah POS</h1>
        <p class="app-subtitle">Silakan masuk sesuai peran operasional Anda.</p>

        <!-- Location Badge -->
        <div class="location-badge">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="#e11d48">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z"/>
            </svg>
            <span>Studi Kasus: UNP Kampus 1</span>
        </div>

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

        <!-- Form Login -->
        <form action="<?= site_url('login/attempt') ?>" method="post" id="loginForm">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="email" class="form-label">Alamat Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="input-control"
                    value="<?= esc(old('email') ?? 'dapur@kantinmerah.com') ?>"
                    placeholder="nama@kantinmerah.com"
                    autocomplete="username"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="password-wrap">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="input-control"
                        value="password123"
                        placeholder="••••••••••••"
                        autocomplete="current-password"
                        required
                    >
                    <button
                        type="button"
                        class="toggle-btn"
                        id="togglePassword"
                    >
                        Lihat
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-submit" id="submitButton">
                Masuk
            </button>
        </form>

        <!-- Demo Divider -->
        <div class="demo-divider">Pilih Akun Demo (1-Klik Instan)</div>

        <!-- 3 Demo Account Cards -->
        <div class="demo-grid">
            <!-- Kasir -->
            <div class="demo-card" onclick="fillRole('kasir@kantinmerah.com', 'password123', true)" title="Login sebagai Kasir">
                <div class="demo-icon-wrap">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="#e11d48">
                        <path d="M5 4a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v2H5V4zm-2 4h18a1 1 0 0 1 .98 1.2l-1.5 7.5A2 2 0 0 1 18.52 18H5.48a2 2 0 0 1-1.96-1.3L2.02 9.2A1 1 0 0 1 3 8zm3 2v1.5h2V10H6zm4 0v1.5h2V10h-2zm4 0v1.5h2V10h-2zm-8 3v1.5h2V13H6zm4 0v1.5h2V13h-2zm4 0v1.5h2V13h-2zm-7 6h14a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1a1 1 0 0 1 1-1zm6 1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5z"/>
                    </svg>
                </div>
                <div class="demo-role-name">Kasir</div>
                <div class="demo-role-bottom">
                    <span class="demo-role-desc">Shift & Bayar</span>
                    <span class="demo-role-arrow">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#e11d48" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Dapur -->
            <div class="demo-card" onclick="fillRole('dapur@kantinmerah.com', 'password123', true)" title="Login sebagai Dapur">
                <div class="demo-icon-wrap">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="#e11d48">
                        <path d="M12 2c-2.4 0-4.4 1.7-4.9 4a4.5 4.5 0 0 0-3.6 4.5c0 2 1.3 3.7 3.1 4.2l.4 3.3h5.2c.4-.7 1-1.3 1.7-1.7V15a1 1 0 0 1 2 0v.3c.7.4 1.3 1 1.7 1.7H20l.4-3.3c1.8-.5 3.1-2.2 3.1-4.2a4.5 4.5 0 0 0-3.6-4.5c-.5-2.3-2.5-4-4.9-4z"/>
                        <path d="M17 14c-.6 1.5-1.8 2.5-2.2 3.5-.4 1-.2 2.2.8 2.8.9.5 2 .2 2.6-.5.2.8.9 1.4 1.8 1.4 1.1 0 2-.9 2-2 0-2.2-2.2-3.8-5-5.2z"/>
                    </svg>
                </div>
                <div class="demo-role-name">Dapur</div>
                <div class="demo-role-bottom">
                    <span class="demo-role-desc">FIFO & Masak</span>
                    <span class="demo-role-arrow">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#e11d48" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Manajer -->
            <div class="demo-card" onclick="fillRole('manajerial@kantinmerah.com', 'password123', true)" title="Login sebagai Manajer">
                <div class="demo-icon-wrap">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="#e11d48">
                        <rect x="2" y="13" width="5.5" height="9" rx="1.5"/>
                        <rect x="9.25" y="7" width="5.5" height="15" rx="1.5"/>
                        <rect x="16.5" y="2" width="5.5" height="20" rx="1.5"/>
                    </svg>
                </div>
                <div class="demo-role-name">Manajer</div>
                <div class="demo-role-bottom">
                    <span class="demo-role-desc">Laporan & Menu</span>
                    <span class="demo-role-arrow">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#e11d48" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </span>
                </div>
            </div>
        </div>

        <div class="footer-link">
            Customer / Mahasiswa? <a href="<?= site_url('customer') ?>" target="_blank">Pesan Mandiri &rarr;</a>
        </div>

    </main>

    <script>
        const passwordInput = document.getElementById('password');
        const emailInput = document.getElementById('email');
        const togglePassword = document.getElementById('togglePassword');
        const loginForm = document.getElementById('loginForm');
        const submitButton = document.getElementById('submitButton');

        togglePassword.addEventListener('click', function () {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            togglePassword.textContent = isPassword ? 'Sembunyi' : 'Lihat';
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
            }
        }
    </script>
</body>
</html>
