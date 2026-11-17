<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Kantin Merah POS</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/kasir-sidebar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/kasir-ui.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/managerial-ui.css') ?>">
    <style>
        :root {
            --km-primary: #9f1239;
            --km-primary-dark: #881337;
            --km-primary-light: #fff1f2;
            --km-text: #0f172a;
            --km-muted: #64748b;
            --km-border: #e2e8f0;
            --km-bg: #f8fafc;
            --km-card: #ffffff;
            --km-green: #16a34a;
            --km-blue: #2563eb;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: var(--font-primary);
            background: var(--km-bg);
            color: var(--km-text);
            min-height: 100vh;
        }
        .layout { display: flex; min-height: 100vh; }
        .main { flex: 1; display: flex; flex-direction: column; min-width: 0; }
        .topbar {
            background: #fff;
            padding: 18px 28px;
            border-bottom: 1px solid var(--km-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }
        .heading-wrap { display: flex; align-items: center; gap: 12px; }
        .heading-copy h1 { font-size: 22px; font-weight: 700; letter-spacing: -0.3px; }
        .heading-copy p { font-size: 13px; color: var(--km-muted); margin-top: 3px; }
        .actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
        .period-group { display: inline-flex; background: #fff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 4px; gap: 4px; }
        .period-btn {
            border: none; background: transparent; color: #334155; font-size: 13px; font-weight: 600;
            padding: 7px 12px; border-radius: 7px; cursor: pointer; transition: 0.15s;
        }
        .period-btn:hover { background: #f1f5f9; }
        .period-btn.active { background: var(--km-primary-light); color: var(--km-primary); }
        .btn-export {
            display: inline-flex; align-items: center; gap: 6px; background: #be123c; color: #fff;
            border: none; padding: 9px 15px; border-radius: 9px; font-size: 13px; font-weight: 600; cursor: pointer;
        }
        .btn-export:hover { background: var(--km-primary-dark); }
        .btn-export svg { width: 15px; height: 15px; }
        .print-title, .print-sub { display: none; }
        .content { padding: 24px 28px 40px; display: flex; flex-direction: column; gap: 20px; max-width: 1400px; width: 100%; }
        .meta-bar {
            display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;
            font-size: 13px; color: var(--km-muted);
        }
        .meta-bar strong { color: var(--km-text); }
        .status-pill {
            display: inline-flex; align-items: center; gap: 6px; padding: 5px 10px; border-radius: 999px;
            background: #ecfdf3; color: #166534; font-weight: 600; font-size: 12px;
        }
        .kpi-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
        @media (max-width: 1100px) { .kpi-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 560px) { .kpi-grid { grid-template-columns: 1fr; } }
        .card {
            background: var(--km-card); border: 1px solid var(--km-border); border-radius: 14px;
            padding: 18px 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }
        .kpi-label { font-size: 12.5px; color: var(--km-muted); font-weight: 600; margin-bottom: 6px; }
        .kpi-value { font-size: 24px; font-weight: 800; color: var(--km-text); line-height: 1.2; }
        .kpi-sub { font-size: 12px; color: var(--km-muted); margin-top: 4px; }
        .grid-2 { display: grid; grid-template-columns: 1.2fr 1fr; gap: 16px; }
        @media (max-width: 980px) { .grid-2 { grid-template-columns: 1fr; } }
        .card-title { font-size: 15px; font-weight: 700; margin-bottom: 14px; color: var(--km-text); }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        th {
            text-align: left; padding: 10px 10px; color: var(--km-muted); font-size: 12px; font-weight: 700;
            border-bottom: 1px solid #f1f5f9; text-transform: uppercase; letter-spacing: 0.3px; white-space: nowrap;
        }
        td { padding: 12px 10px; border-bottom: 1px solid #f8fafc; color: #334155; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .fw-700 { font-weight: 700; color: var(--km-text); }
        .rank { width: 28px; color: #64748b; font-weight: 700; }
        .empty-state { padding: 22px 12px; text-align: center; color: var(--km-muted); font-size: 13px; }
        .pay-row { display: flex; flex-direction: column; gap: 10px; }
        .pay-item { display: grid; grid-template-columns: 1fr auto auto; gap: 10px; align-items: center; font-size: 13px; }
        .pay-name { font-weight: 600; color: var(--km-text); }
        .pay-amount { font-weight: 700; }
        .pay-pct { font-weight: 700; min-width: 42px; text-align: right; }
        .bar-wrap { grid-column: 1 / -1; height: 8px; background: #e2e8f0; border-radius: 999px; overflow: hidden; }
        .bar { height: 100%; border-radius: 999px; }
        .bar.tunai { background: var(--km-green); }
        .bar.qris { background: var(--km-blue); }
        .loading-note { font-size: 12px; color: var(--km-muted); }
        @media print {
            .actions, .kasir-sidebar, .managerial-menu-toggle, .managerial-nav-backdrop, .status-pill { display: none !important; }
            body { background: #fff; color: #000; }
            .content { padding: 0; max-width: 100%; gap: 14px; }
            .print-title { display: block; margin: 0 0 4px; font-size: 20px; font-weight: 700; color: #111; }
            .print-sub { display: block; margin-bottom: 12px; font-size: 12px; color: #333; }
            .card { box-shadow: none; border: 1px solid #bbb; break-inside: avoid; }
            table th, table td { border-color: #ddd !important; }
        }
    </style>
    <?= view('layout/typography') ?>
    <script src="<?= base_url('assets/js/managerial-drawer.js') ?>" defer></script>
</head>
<body>
<div class="layout kasir-layout managerial-layout">
    <?= view('manajerial/_sidebar', ['activeMenu' => 'laporan']) ?>

    <main class="main">
        <header class="topbar">
            <div class="heading-wrap">
                <button
                    type="button"
                    class="managerial-menu-toggle kasir-menu-toggle"
                    aria-label="Buka menu navigasi"
                    aria-controls="managerialSidebar"
                    aria-expanded="false"
                >
                    <svg class="i" aria-hidden="true"><use href="#i-menu"/></svg>
                </button>
                <div class="heading-copy">
                    <h1>Laporan Penjualan</h1>
                    <p>Ringkasan performa penjualan berdasarkan periode yang dipilih.</p>
                </div>
            </div>

            <div class="actions">
                <div class="period-group" role="group" aria-label="Pilih periode laporan">
                    <button type="button" class="period-btn" data-periode="harian">Harian</button>
                    <button type="button" class="period-btn active" data-periode="mingguan">Mingguan</button>
                    <button type="button" class="period-btn" data-periode="bulanan">Bulanan</button>
                </div>
                <button type="button" class="btn-export" id="btnExport">
                    <svg class="i" aria-hidden="true"><use href="#i-export"/></svg>
                    <span>Export PDF</span>
                </button>
            </div>
        </header>

        <div class="content">
            <div class="print-title">Laporan Penjualan Kantin Merah</div>
            <div class="print-sub">Dibuat: <?= date('d/m/Y H:i') ?></div>
            <div class="meta-bar">
                <div>Periode: <strong id="labelPeriode">-</strong> <span id="labelRentang"></span></div>
                <div class="status-pill" id="statusPill">Memuat data...</div>
            </div>

            <section class="kpi-grid" aria-label="Ringkasan laporan">
                <div class="card">
                    <div class="kpi-label">Total Penjualan</div>
                    <div class="kpi-value" id="kpiTotal">Rp 0</div>
                    <div class="kpi-sub">Omzet dari transaksi valid</div>
                </div>
                <div class="card">
                    <div class="kpi-label">Jumlah Transaksi</div>
                    <div class="kpi-value" id="kpiTransaksi">0</div>
                    <div class="kpi-sub">Pesanan dibayar/diproses/selesai</div>
                </div>
                <div class="card">
                    <div class="kpi-label">Total Tunai</div>
                    <div class="kpi-value" id="kpiTunai">Rp 0</div>
                    <div class="kpi-sub">Pembayaran tunai berhasil</div>
                </div>
                <div class="card">
                    <div class="kpi-label">Total QRIS</div>
                    <div class="kpi-value" id="kpiQris">Rp 0</div>
                    <div class="kpi-sub">Pembayaran QRIS berhasil</div>
                </div>
            </section>

            <section class="grid-2">
                <div class="card">
                    <h2 class="card-title">Menu Terlaris</h2>
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:48px;">#</th>
                                    <th>Nama Menu</th>
                                    <th class="text-center">Terjual</th>
                                    <th class="text-right">Total Penjualan</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyMenu">
                                <tr><td colspan="4" class="empty-state">Memuat data menu terlaris...</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <h2 class="card-title">Metode Pembayaran</h2>
                    <div class="pay-row" id="paymentBreakdown">
                        <div class="empty-state">Memuat data pembayaran...</div>
                    </div>
                    <p class="loading-note" style="margin-top:12px;">Persentase dihitung dari total penjualan periode.</p>
                </div>
            </section>

            <section class="card">
                <h2 class="card-title">Jam Paling Ramai</h2>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Jam</th>
                                <th class="text-center">Jumlah Transaksi</th>
                                <th class="text-right">Total Penjualan</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyJam">
                            <tr><td colspan="3" class="empty-state">Memuat data jam ramai...</td></tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>
</div>

<script>
    let activePeriode = 'mingguan';
    let reportData = null;

    function formatRupiah(value) {
        return 'Rp ' + Number(value || 0).toLocaleString('id-ID');
    }

    function formatPeriodeLabel(periode) {
        if (periode === 'harian') return 'Harian';
        if (periode === 'mingguan') return 'Mingguan';
        if (periode === 'bulanan') return 'Bulanan';
        return periode || '-';
    }

    function formatJam(jam) {
        const h = String(Number(jam || 0)).padStart(2, '0');
        return h + ':00 - ' + h + ':59';
    }

    function setStatus(text, isError) {
        const el = document.getElementById('statusPill');
        el.textContent = text;
        el.style.background = isError ? '#fef2f2' : '#ecfdf3';
        el.style.color = isError ? '#b91c1c' : '#166534';
    }

    function renderMenuTerlaris(items) {
        const tbody = document.getElementById('tbodyMenu');
        if (!items || items.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="empty-state">Belum ada data penjualan menu pada periode ini.</td></tr>';
            return;
        }

        tbody.innerHTML = items.slice(0, 10).map((item, index) => `
            <tr>
                <td class="text-center rank">${index + 1}</td>
                <td class="fw-700">${escapeHtml(item.nama_menu || '-')}</td>
                <td class="text-center">${Number(item.jumlah_terjual || 0).toLocaleString('id-ID')}</td>
                <td class="text-right">${formatRupiah(item.total_penjualan || 0)}</td>
            </tr>
        `).join('');
    }

    function renderJamRamai(items) {
        const tbody = document.getElementById('tbodyJam');
        if (!items || items.length === 0) {
            tbody.innerHTML = '<tr><td colspan="3" class="empty-state">Belum ada data transaksi pada periode ini.</td></tr>';
            return;
        }

        tbody.innerHTML = items.map(item => `
            <tr>
                <td class="fw-700">${formatJam(item.jam)}</td>
                <td class="text-center">${Number(item.jumlah_transaksi || 0).toLocaleString('id-ID')}</td>
                <td class="text-right">${formatRupiah(item.total_penjualan || 0)}</td>
            </tr>
        `).join('');
    }

    function renderPembayaran(total, tunai, qris) {
        const wrap = document.getElementById('paymentBreakdown');
        const basis = Math.max(Number(total || 0), Number(tunai || 0) + Number(qris || 0), 0);
        const pctTunai = basis > 0 ? Math.round((Number(tunai || 0) / basis) * 100) : 0;
        const pctQris = basis > 0 ? (100 - pctTunai) : 0;

        wrap.innerHTML = `
            <div class="pay-item">
                <span class="pay-name">Tunai</span>
                <span class="pay-amount">${formatRupiah(tunai)}</span>
                <span class="pay-pct" style="color:#16a34a;">${basis > 0 ? pctTunai : 0}%</span>
                <div class="bar-wrap"><div class="bar tunai" style="width:${basis > 0 ? pctTunai : 0}%"></div></div>
            </div>
            <div class="pay-item">
                <span class="pay-name">QRIS</span>
                <span class="pay-amount">${formatRupiah(qris)}</span>
                <span class="pay-pct" style="color:#2563eb;">${basis > 0 ? pctQris : 0}%</span>
                <div class="bar-wrap"><div class="bar qris" style="width:${basis > 0 ? pctQris : 0}%"></div></div>
            </div>
        `;
    }

    function escapeHtml(value) {
        const div = document.createElement('div');
        div.textContent = value ?? '';
        return div.innerHTML;
    }

    async function loadLaporan(periode) {
        activePeriode = periode;
        setStatus('Memuat data...', false);

        document.querySelectorAll('.period-btn').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.periode === periode);
        });

        try {
            const res = await fetch('<?= site_url('manajerial/laporan') ?>?format=json&periode=' + encodeURIComponent(periode), {
                headers: { 'Accept': 'application/json' }
            });
            const json = await res.json();

            if (!json.status) {
                throw new Error(json.message || 'Gagal memuat laporan.');
            }

            const data = json.data || {};
            reportData = data;
            const ringkasan = data.ringkasan || {};
            const total = Number(ringkasan.total_penjualan || 0);
            const transaksi = Number(ringkasan.jumlah_transaksi || 0);
            const tunai = Number(ringkasan.total_tunai || 0);
            const qris = Number(ringkasan.total_qris || 0);

            document.getElementById('labelPeriode').textContent = formatPeriodeLabel(data.periode || periode);
            document.getElementById('labelRentang').textContent =
                data.tanggal_mulai && data.tanggal_selesai
                    ? '(' + data.tanggal_mulai + ' s/d ' + data.tanggal_selesai + ')'
                    : '';

            document.getElementById('kpiTotal').textContent = formatRupiah(total);
            document.getElementById('kpiTransaksi').textContent = transaksi.toLocaleString('id-ID');
            document.getElementById('kpiTunai').textContent = formatRupiah(tunai);
            document.getElementById('kpiQris').textContent = formatRupiah(qris);

            renderMenuTerlaris(data.menu_terlaris || []);
            renderJamRamai(data.jam_ramai || []);
            renderPembayaran(total, tunai, qris);

            setStatus('Data diperbarui', false);
        } catch (error) {
            console.error(error);
            setStatus('Gagal memuat data', true);
            document.getElementById('tbodyMenu').innerHTML = '<tr><td colspan="4" class="empty-state">Gagal memuat data laporan.</td></tr>';
            document.getElementById('tbodyJam').innerHTML = '<tr><td colspan="3" class="empty-state">Gagal memuat data laporan.</td></tr>';
            document.getElementById('paymentBreakdown').innerHTML = '<div class="empty-state">Gagal memuat data laporan.</div>';
        }
    }

    function exportLaporan() {
        window.print();
    }

    document.querySelectorAll('.period-btn').forEach(btn => {
        btn.addEventListener('click', () => loadLaporan(btn.dataset.periode));
    });
    document.getElementById('btnExport').addEventListener('click', exportLaporan);

    document.addEventListener('DOMContentLoaded', () => loadLaporan('mingguan'));
</script>
</body>
</html>
