<?php
$idPesanan = $idPesanan ?? ($_GET['id_pesanan'] ?? '');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Pembayaran - Kantin Merah POS</title>
    <style>
        :root{
            --bg:#faf7f4; --surface:#fff; --surface-2:#f8f9fb; --line:#e2e5e9; --text:#20242b; --muted:#667085;
            --brand:#9f1239; --brand-d:#881337; --brand-soft:#fff1f3;
            --ok:#0e9f6e; --ok-soft:#dcf7ea; --warn:#c77700; --warn-soft:#fff1d6; --bad:#d92d20;
            --r-lg:20px; --r-md:12px; --r-sm:8px;
            --shadow:0 1px 2px rgba(20,22,28,.04),0 8px 24px -12px rgba(20,22,28,.12);
        }
        [data-theme="dark"]{
            --bg:#0e1014; --surface:#171a21; --surface-2:#1d212a; --line:#272c37; --text:#eef0f5; --muted:#8e95a6;
            --brand-soft:#3a1219; --ok-soft:#0f3325; --warn-soft:#3a2a0b;
            --shadow:0 1px 2px rgba(0,0,0,.4),0 8px 24px -12px rgba(0,0,0,.6);
        }
        *{box-sizing:border-box;margin:0;padding:0}
        html{color-scheme:light dark}
        body{font-family:var(--font-primary);background:var(--bg);color:var(--text);font-size:14px;line-height:1.5;-webkit-font-smoothing:antialiased}
        
        .layout { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: #8f1726; color: white; padding: 24px 18px; flex-shrink: 0; display: flex; flex-direction: column; }
        .brand { font-size: 20px; font-weight: 800; letter-spacing: .5px; }
        .brand-subtitle { font-size: 11px; color: #fecaca; margin-bottom: 28px; }
        .nav-label { font-size: 11px; color: #fca5a5; text-transform: uppercase; letter-spacing: 1px; margin: 18px 8px 8px; }
        .nav-link { display: block; color: #fef2f2; text-decoration: none; padding: 11px 12px; border-radius: 8px; font-size: 14px; font-weight: 500; margin-bottom: 4px; transition: .15s; }
        .nav-link:hover, .nav-link.active { background: #b91c1c; color: white; }
        .sidebar-bottom { margin-top: auto; padding-top: 20px; border-top: 1px solid rgba(255,255,255,.15); }
        .main { flex: 1; min-width: 0; }
        .container { max-width: 900px; margin: auto; padding: 28px; }
        
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }

        h1 { font-size: 22px; font-weight: 800; letter-spacing: -.01em; }
        .muted { color: var(--muted); font-size: 13px; font-weight: 600; }

        .back-link {
            color: var(--brand);
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .back-link:hover { text-decoration: underline; }

        .card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: var(--r-lg);
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
        }

        .card h2 { margin: 0 0 18px; font-size: 17px; font-weight: 800; }

        .form-group { margin-bottom: 16px; }

        label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: var(--muted);
            margin-bottom: 6px;
        }

        input, select {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid var(--line);
            border-radius: var(--r-sm);
            font-size: 15px;
            font-weight: 700;
            background: var(--surface);
            color: var(--text);
            font-family: inherit;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--brand);
            box-shadow: 0 0 0 3px var(--brand-soft);
        }

        .summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 14px 0;
            border-bottom: 1px solid var(--line);
        }

        .summary:last-child { border-bottom: 0; }

        .total {
            color: var(--brand);
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -.02em;
        }

        .change {
            background: var(--ok-soft);
            border: 1px solid color-mix(in srgb, var(--ok) 30%, var(--line));
            border-radius: var(--r-md);
            padding: 16px;
            margin-top: 16px;
        }

        .change strong {
            display: block;
            margin-top: 4px;
            font-size: 22px;
            color: var(--ok);
            font-weight: 800;
        }

        .method-options {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .method-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            border: 1.5px solid var(--line);
            border-radius: var(--r-md);
            background: var(--surface);
            cursor: pointer;
            transition: all .15s;
        }

        .method-option input {
            width: auto;
            accent-color: var(--brand);
        }

        .method-option:has(input:checked) {
            border-color: var(--brand);
            background: var(--brand-soft);
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: var(--r-md);
            padding: 12px 20px;
            background: var(--brand);
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            font-family: inherit;
            transition: background .15s;
        }

        .button:hover { background: var(--brand-d); }
        .button:disabled { background: var(--muted); opacity: .6; cursor: not-allowed; }

        .button-secondary {
            background: var(--surface-2);
            color: var(--text);
            border: 1px solid var(--line);
        }

        .button-secondary:hover { background: var(--line); }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 24px;
        }

        .alert {
            padding: 14px 16px;
            margin-bottom: 20px;
            border-radius: var(--r-md);
            font-size: 13.5px;
            font-weight: 600;
            line-height: 1.4;
        }

        .alert-error {
            background: color-mix(in srgb, var(--bad) 12%, var(--surface));
            color: var(--bad);
            border: 1px solid color-mix(in srgb, var(--bad) 30%, var(--line));
        }

        .alert-success {
            background: var(--ok-soft);
            color: var(--ok);
            border: 1px solid color-mix(in srgb, var(--ok) 30%, var(--line));
        }

        .hidden { display: none !important; }

        @media (max-width: 860px) {
            .layout { flex-direction: column; }
            .sidebar {
                width: 100%;
                padding: 14px;
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 4px;
            }
            .brand, .brand-subtitle, .nav-label, .sidebar-bottom { grid-column: 1 / -1; }
            .brand-subtitle { margin-bottom: 8px; }
            .nav-label { margin: 8px 4px 4px; }
            .nav-link { min-width: 0; min-height: 44px; margin: 0; }
            .sidebar-bottom { margin-top: 8px; padding-top: 10px; }
            .main { width: 100%; }
            .container { padding: 18px 16px; }
        }

        @media (max-width: 600px) {
            .container { padding: 14px 12px; }
            .card { padding: 18px; }
            .method-options { grid-template-columns: 1fr; }
            .total { font-size: 22px; }
        }
    </style>
    <link rel="stylesheet" href="<?= base_url('assets/css/formal-ui.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/kasir-sidebar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/kasir-ui.css') ?>">
    <?= view('layout/typography') ?>
    <script src="<?= base_url('assets/js/kasir-sidebar.js') ?>" defer></script>
</head>

<body>
<div class="layout kasir-layout">
    <?= view('kasir/_sidebar', ['activeMenu' => 'dashboard']) ?>
    <main class="main">
      <div class="container">
    <div class="topbar">
        <button type="button" class="kasir-menu-toggle" aria-label="Buka menu" aria-controls="kasirSidebar" aria-expanded="false">☰</button>
        <div>
            <h1>Form Pembayaran Kasir</h1>
        </div>
        <a class="back-link" href="<?= site_url('kasir') ?>">← Kembali ke Kasir</a>
    </div>

    <div id="alertBox" class="alert hidden" role="alert"></div>

    <section class="card">
        <h2>Informasi Pesanan</h2>

        <div class="form-group">
            <label for="orderId">ID Pesanan</label>
            <input
                type="number"
                id="orderId"
                min="1"
                value="<?= esc((string) $idPesanan) ?>"
                placeholder="Masukkan ID pesanan"
            >
        </div>

        <div class="summary">
            <span class="muted">Status pesanan</span>
            <strong id="orderStatus" style="font-size: 15px;">-</strong>
        </div>

        <div class="summary">
            <span class="muted">Total pembayaran</span>
            <span class="total" id="totalBayar">Rp0</span>
        </div>

        <div class="actions">
            <button type="button" class="button button-secondary" id="loadOrderBtn">
                Muat Data Pesanan
            </button>
        </div>
    </section>

    <section class="card">
        <h2>Pilih Metode Pembayaran</h2>

        <form id="paymentForm">
            <?= csrf_field() ?>

            <div class="method-options">
                <label class="method-option">
                    <input type="radio" name="metode" value="Tunai" checked>
                    <div>
                        <strong style="font-size: 15px;">Tunai</strong><br>
                        <span class="muted">Bayar langsung di kasir</span>
                    </div>
                </label>

                <label class="method-option">
                    <input type="radio" name="metode" value="QRIS">
                    <div>
                        <strong style="font-size: 15px;">QRIS</strong><br>
                        <span class="muted">Status menunggu konfirmasi</span>
                    </div>
                </label>
            </div>

            <div class="form-group" id="cashGroup" style="margin-top:20px">
                <label for="jumlahDiterima">Uang Tunai Diterima (Rp)</label>
                <input
                    type="number"
                    id="jumlahDiterima"
                    min="1"
                    step="1"
                    placeholder="Contoh: 50000"
                >

                <div class="change">
                    <span class="muted" style="color:var(--ok)">Estimasi Kembalian</span>
                    <strong id="kembalian">Rp0</strong>
                </div>
            </div>

            <div id="qrisInfo" class="alert hidden" style="margin-top:20px; background:var(--surface-2); color:var(--text); border:1px solid var(--line);">
                Pembayaran QRIS akan dibuat dengan status menunggu. Setelah pelanggan menyelesaikan konfirmasi, pesanan otomatis diteruskan ke dapur.
            </div>

            <div class="actions">
                <button type="submit" class="button" id="payButton">
                    Proses Pembayaran
                </button>
                <button type="button" class="button button-secondary" id="resetButton">
                    Reset Form
                </button>
            </div>
        </form>
    </section>

    <section class="card hidden" id="resultCard">
        <h2>Hasil Transaksi Pembayaran</h2>
        <div id="resultContent"></div>
    </section>
      </div>
    </main>
</div>

<script>
(() => {
    const orderIdInput = document.getElementById('orderId');
    const totalElement = document.getElementById('totalBayar');
    const statusElement = document.getElementById('orderStatus');
    const cashGroup = document.getElementById('cashGroup');
    const qrisInfo = document.getElementById('qrisInfo');
    const cashInput = document.getElementById('jumlahDiterima');
    const changeElement = document.getElementById('kembalian');
    const alertBox = document.getElementById('alertBox');
    const payButton = document.getElementById('payButton');
    const resultCard = document.getElementById('resultCard');
    const resultContent = document.getElementById('resultContent');

    let currentOrder = null;
    let currentPayment = null;

    const rupiah = value => new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0
    }).format(Number(value) || 0);

    function showAlert(message, type = 'error') {
        alertBox.textContent = message;
        alertBox.className = `alert alert-${type}`;
    }

    function clearAlert() {
        alertBox.textContent = '';
        alertBox.className = 'alert hidden';
    }

    function getOrderId() {
        return String(orderIdInput.value).trim();
    }

    function getMethod() {
        return document.querySelector('input[name="metode"]:checked').value;
    }

    function syncMethod() {
        const isCash = getMethod() === 'Tunai';
        cashGroup.classList.toggle('hidden', !isCash);
        qrisInfo.classList.toggle('hidden', isCash);
        cashInput.required = isCash;
        updateChange();
    }

    function updateChange() {
        const total = Number(currentOrder?.total_bayar || 0);
        const received = Number(cashInput.value || 0);
        changeElement.textContent = rupiah(Math.max(0, received - total));
    }

    async function requestJson(url, options = {}) {
        const response = await fetch(url, {
            ...options,
            headers: {
                Accept: 'application/json',
                ...(options.headers || {})
            }
        });

        let data;
        try {
            data = await response.json();
        } catch {
            throw new Error('Respons server bukan JSON yang valid.');
        }

        if (!response.ok || data.status === false) {
            throw new Error(data.message || 'Permintaan gagal diproses.');
        }

        return data;
    }

    async function loadOrder() {
        clearAlert();
        resultCard.classList.add('hidden');
        currentOrder = null;
        currentPayment = null;
        totalElement.textContent = rupiah(0);
        statusElement.textContent = '-';
        updateChange();

        const id = getOrderId();

        if (!id || !/^\d+$/.test(id) || Number(id) < 1) {
            showAlert('Masukkan ID pesanan yang valid.');
            return;
        }

        try {
            const response = await requestJson(
                `<?= site_url('pesanan') ?>/${encodeURIComponent(id)}`
            );

            currentOrder = response.data;

            if (!currentOrder) {
                throw new Error('Data pesanan tidak ditemukan.');
            }

            totalElement.textContent = rupiah(currentOrder.total_bayar);
            statusElement.textContent = currentOrder.status || '-';
            updateChange();

            try {
                const paymentResponse = await requestJson(
                    `<?= site_url('pesanan') ?>/${encodeURIComponent(id)}/pembayaran`
                );
                currentPayment = paymentResponse.data || null;
            } catch (error) {
                console.warn('Pemeriksaan pembayaran gagal:', error.message);
            }

            if (currentPayment && currentPayment.status_bayar === 'Berhasil') {
                showAlert(
                    `Pembayaran untuk pesanan ini sudah berhasil (${currentPayment.metode || '-'}).`,
                    'error'
                );
                payButton.disabled = true;
            } else if (currentPayment) {
                showAlert(
                    `Data pembayaran awal ditemukan dengan status: ${currentPayment.status_bayar || 'Menunggu'}. Silakan pilih metode dan proses pembayaran.`,
                    'success'
                );
                payButton.disabled = false;
            } else {
                payButton.disabled = false;
                clearAlert();
            }
        } catch (error) {
            showAlert(error.message);
        }
    }

    document.querySelectorAll('input[name="metode"]').forEach(input => {
        input.addEventListener('change', syncMethod);
    });

    cashInput.addEventListener('input', updateChange);
    document.getElementById('loadOrderBtn').addEventListener('click', loadOrder);

    orderIdInput.addEventListener('keydown', event => {
        if (event.key === 'Enter') {
            event.preventDefault();
            loadOrder();
        }
    });

    document.getElementById('paymentForm').addEventListener('submit', async event => {
        event.preventDefault();
        clearAlert();

        if (!currentOrder) {
            showAlert('Muat pesanan terlebih dahulu.');
            return;
        }

        if (currentPayment && currentPayment.status_bayar === 'Berhasil') {
            showAlert('Pembayaran untuk pesanan ini sudah tercatat berhasil.');
            return;
        }

        const total = Number(currentOrder.total_bayar || 0);

        if (total <= 0) {
            showAlert('Total pembayaran belum tersedia.');
            return;
        }

        const method = getMethod();
        const received = Number(cashInput.value || 0);

        if (method === 'Tunai') {
            if (!cashInput.value || !Number.isFinite(received) || received <= 0) {
                showAlert('Masukkan jumlah uang yang diterima dengan benar.');
                return;
            }

            if (received < total) {
                showAlert('Uang yang diterima kurang dari total pembayaran.');
                return;
            }
        }

        const id = getOrderId();
        const formData = new FormData();
        formData.append('metode', method);

        if (method === 'Tunai') {
            formData.append('jumlah_diterima', String(received));
        }

        const csrfInput = document.querySelector(
            '#paymentForm input[type="hidden"]'
        );

        if (csrfInput && csrfInput.name) {
            formData.append(csrfInput.name, csrfInput.value);
        }

        payButton.disabled = true;
        payButton.textContent = 'Memproses...';

        try {
            const result = await requestJson(
                `<?= site_url('pesanan') ?>/${encodeURIComponent(id)}/pembayaran`,
                {
                    method: 'POST',
                    body: formData
                }
            );

            const data = result.data || {};

            resultCard.classList.remove('hidden');
            resultContent.replaceChildren();

            const details = [
                ['Metode', data.metode || method],
                ['Status pembayaran', data.status_bayar || '-'],
                ['Total pembayaran', rupiah(data.total_bayar ?? total)]
            ];

            if (method === 'Tunai') {
                details.push(
                    ['Uang diterima', rupiah(data.jumlah_diterima ?? received)],
                    ['Kembalian', rupiah(data.kembalian ?? (received - total))]
                );
            } else {
                details.push(['Batas waktu', data.batas_waktu || '-']);
            }

            details.forEach(([label, value]) => {
                const row = document.createElement('div');
                row.className = 'summary';

                const labelElement = document.createElement('span');
                labelElement.className = 'muted';
                labelElement.textContent = label;

                const valueElement = document.createElement('strong');
                valueElement.textContent = value;

                row.append(labelElement, valueElement);
                resultContent.appendChild(row);
            });

            showAlert(result.message || 'Permintaan pembayaran berhasil diproses.', 'success');

            currentPayment = data;
            payButton.disabled = true;
        } catch (error) {
            showAlert(error.message);
            payButton.disabled = false;
        } finally {
            payButton.textContent = 'Proses Pembayaran';
        }
    });

    document.getElementById('resetButton').addEventListener('click', () => {
        document.getElementById('paymentForm').reset();
        resultCard.classList.add('hidden');
        clearAlert();
        syncMethod();
    });

    syncMethod();

    if (getOrderId()) {
        loadOrder();
    }
})();
</script>
</body>
</html>
