<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Kantin Merah POS</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; background: #f8fafc; color: #1e293b; }
        .layout { display: flex; min-height: 100vh; }
        
        /* Sidebar */
        .sidebar { width: 250px; background: #881337; color: white; padding: 24px 18px; flex-shrink: 0; display: flex; flex-direction: column; }
        .brand { font-size: 20px; font-weight: 800; letter-spacing: 0.5px; }
        .brand-subtitle { font-size: 11px; color: #fecdd3; margin-bottom: 28px; }
        .nav-label { font-size: 11px; color: #fda4af; text-transform: uppercase; letter-spacing: 1px; margin: 18px 8px 8px; }
        .nav-link { display: block; color: #fff1f2; text-decoration: none; padding: 11px 12px; border-radius: 8px; font-size: 14px; font-weight: 500; margin-bottom: 4px; transition: 0.15s; }
        .nav-link:hover, .nav-link.active { background: #be123c; color: white; }
        .sidebar-bottom { margin-top: auto; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.15); }

        /* Main */
        .main { flex: 1; display: flex; flex-direction: column; min-width: 0; }
        .topbar { background: white; padding: 18px 28px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e2e8f0; }
        .topbar h1 { font-size: 20px; font-weight: 700; color: #0f172a; }
        .user-pill { background: #ffe4e6; color: #9f1239; padding: 6px 14px; border-radius: 9999px; font-size: 13px; font-weight: 600; }
        .content { padding: 26px 28px; }

        /* Period Switcher */
        .period-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; flex-wrap: wrap; gap: 12px; }
        .period-buttons { display: flex; gap: 8px; background: #e2e8f0; padding: 4px; border-radius: 10px; }
        .btn-period { border: none; background: transparent; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 600; color: #475569; cursor: pointer; transition: 0.15s; }
        .btn-period.active { background: white; color: #9f1239; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }

        /* KPI Cards */
        .kpi-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 26px; }
        @media (max-width: 1024px) { .kpi-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) { .kpi-grid { grid-template-columns: 1fr; } }

        .kpi-card { background: white; border-radius: 12px; padding: 20px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.03); }
        .kpi-title { font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase; margin-bottom: 8px; }
        .kpi-val { font-size: 24px; font-weight: 800; color: #0f172a; }
        .kpi-sub { font-size: 12px; color: #94a3b8; margin-top: 4px; }

        /* Content Grid */
        .content-grid { display: grid; grid-template-columns: 1.3fr 1fr; gap: 20px; margin-bottom: 26px; }
        @media (max-width: 900px) { .content-grid { grid-template-columns: 1fr; } }

        .card-panel { background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.03); }
        .panel-header { font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 16px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px; }

        /* Tables */
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        th { text-align: left; padding: 10px; color: #64748b; font-weight: 600; border-bottom: 1px solid #e2e8f0; font-size: 12px; }
        td { padding: 10px; border-bottom: 1px solid #f1f5f9; }
        tr:last-child td { border-bottom: none; }
        .rank-badge { display: inline-flex; width: 22px; height: 22px; background: #ffe4e6; color: #9f1239; border-radius: 50%; font-weight: 700; align-items: center; justify-content: center; font-size: 11px; }

        .card-panel { min-width: 0; }
        .table-wrap { width: 100%; overflow-x: auto; overscroll-behavior-x: contain; }
        .table-wrap table { min-width: 520px; }
        .table-wrap:focus-visible { outline: 2px solid #9f1239; outline-offset: 2px; }

        @media (max-width: 900px) {
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
            .topbar { padding: 14px 16px; gap: 10px; flex-wrap: wrap; }
            .topbar > div { min-width: 0; }
            .content { padding: 18px 16px; }
        }

        @media (max-width: 520px) {
            .topbar { align-items: flex-start; }
            .topbar h1 { font-size: 18px; }
            .topbar .user-pill { white-space: normal; }
            .content { padding: 14px 12px 28px; }
            .period-bar { align-items: flex-start; }
            .period-buttons { width: 100%; flex-wrap: wrap; }
            .btn-period { min-height: 44px; flex: 1 1 100px; padding: 8px 10px; }
            .kpi-card { min-width: 0; padding: 16px; }
            .kpi-val { overflow-wrap: anywhere; font-size: 21px; }
            .card-panel { padding: 15px; }
            .panel-header { align-items: flex-start; flex-wrap: wrap; gap: 8px; }
        }
    </style>
    <link rel="stylesheet" href="<?= base_url('assets/css/formal-ui.css') ?>">
    <script src="<?= base_url('assets/js/managerial-drawer.js') ?>" defer></script>
</head>
<body>
<div class="layout managerial-layout">
    <!-- Sidebar -->
    <aside class="sidebar managerial-sidebar" id="managerialSidebar" role="navigation" aria-label="Navigasi manajerial" aria-hidden="false">
        <button type="button" class="managerial-menu-close" aria-label="Tutup menu navigasi">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="brand">KANTIN MERAH</div>

        <div class="nav-label">Menu Manajerial</div>
        <a class="nav-link active" href="<?= site_url('manajerial') ?>">📊 Laporan Penjualan</a>
        <a class="nav-link" href="<?= site_url('menu') ?>">🍲 Kelola Menu & Kategori</a>

        <div class="sidebar-bottom">
            <div style="font-size: 12px; color: #fecdd3; margin-bottom: 8px;">
                Login: <strong><?= esc(session()->get('nama') ?? 'Manajerial') ?></strong>
            </div>
            <a class="nav-link" href="<?= site_url('logout') ?>" style="background: rgba(0,0,0,0.2);">🚪 Keluar</a>
        </div>
    </aside>
    <button type="button" class="managerial-nav-backdrop" aria-hidden="true" tabindex="-1"></button>

    <!-- Main -->
    <main class="main">
        <header class="topbar">
            <div class="managerial-heading">
                <button
                    type="button"
                    class="managerial-menu-toggle"
                    aria-label="Buka menu navigasi"
                    aria-controls="managerialSidebar"
                    aria-expanded="false"
                >
                    <span aria-hidden="true">☰</span>
                </button>
                <h1>Laporan Penjualan</h1>
            </div>
            <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                <a href="<?= site_url('menu') ?>" style="background: #9f1239; color: white; text-decoration: none; padding: 7px 13px; border-radius: 8px; font-size: 13px; font-weight: 600;">🍲 Kelola Menu</a>
                <div class="user-pill">Role: Manajerial / Owner</div>
            </div>
        </header>

        <div class="content">
            <!-- Period Selector (Sesuai PDF: Harian, Mingguan, Bulanan) -->
            <div class="period-bar">
                <div>
                    <span id="range-label" style="font-size: 13px; color: #64748b;">Memuat data...</span>
                </div>
                <div class="period-buttons">
                    <button class="btn-period active" onclick="loadLaporan('harian', this)">Harian</button>
                    <button class="btn-period" onclick="loadLaporan('mingguan', this)">Mingguan (7 Hari)</button>
                    <button class="btn-period" onclick="loadLaporan('bulanan', this)">Bulanan</button>
                </div>
            </div>

            <!-- KPI Cards -->
            <div class="kpi-grid">
                <div class="kpi-card">
                    <div class="kpi-title">Total Penjualan</div>
                    <div class="kpi-val" id="kpi-total">Rp 0</div>
                    <div class="kpi-sub">Omset kotor terbayar</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-title">Jumlah Transaksi</div>
                    <div class="kpi-val" id="kpi-transaksi">0</div>
                    <div class="kpi-sub">Pesanan berhasil</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-title">Transaksi Tunai</div>
                    <div class="kpi-val" id="kpi-tunai" style="color: #16a34a;">Rp 0</div>
                    <div class="kpi-sub" id="sub-tunai">0% dari total</div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-title">Transaksi QRIS</div>
                    <div class="kpi-val" id="kpi-qris" style="color: #2563eb;">Rp 0</div>
                    <div class="kpi-sub" id="sub-qris">0% dari total</div>
                </div>
            </div>

            <!-- Content Grid: Top Menu & Peak Hours (Sesuai PDF) -->
            <div class="content-grid">
                <!-- Menu Terlaris -->
                <div class="card-panel">
                    <div class="panel-header">
                        <span>🔥 Menu Paling Laris</span>
                        <small style="color: #64748b; font-weight: normal;">Berdasarkan kuantitas terjual</small>
                    </div>
                    <div class="table-wrap" role="region" aria-label="Menu paling laris" tabindex="0">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Menu</th>
                                <th style="text-align: center;">Terjual</th>
                                <th style="text-align: right;">Total Omset</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-top-menu">
                            <tr><td colspan="4" style="text-align: center; color: #94a3b8;">Memuat data menu...</td></tr>
                        </tbody>
                    </table>
                    </div>
                </div>

                <!-- Jam Paling Ramai -->
                <div class="card-panel">
                    <div class="panel-header">
                        <span>⏰ Jam Paling Ramai</span>
                        <small style="color: #64748b; font-weight: normal;">Untuk penjadwalan staf</small>
                    </div>
                    <div class="table-wrap" role="region" aria-label="Jam paling ramai" tabindex="0">
                    <table>
                        <thead>
                            <tr>
                                <th>Jam</th>
                                <th style="text-align: center;">Transaksi</th>
                                <th style="text-align: right;">Total Penjualan</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-peak-hours">
                            <tr><td colspan="3" style="text-align: center; color: #94a3b8;">Memuat data jam ramai...</td></tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

<script>
    async function loadLaporan(periode, btnEl) {
        if (btnEl) {
            document.querySelectorAll('.btn-period').forEach(b => b.classList.remove('active'));
            btnEl.classList.add('active');
        }

        document.getElementById('range-label').innerText = 'Memuat laporan periode ' + periode + '...';

        try {
            const res = await fetch('<?= site_url('manajerial/laporan') ?>?periode=' + periode);
            const resJson = await res.json();

            if (!resJson.status) {
                alert('Gagal memuat data laporan: ' + resJson.message);
                return;
            }

            const data = resJson.data;
            document.getElementById('range-label').innerText = 'Rentang: ' + data.tanggal_mulai + ' s/d ' + data.tanggal_selesai;

            // KPI
            const total = data.ringkasan.total_penjualan || 0;
            const tunai = data.ringkasan.total_tunai || 0;
            const qris = data.ringkasan.total_qris || 0;
            const trx = data.ringkasan.jumlah_transaksi || 0;

            document.getElementById('kpi-total').innerText = 'Rp ' + Number(total).toLocaleString('id-ID');
            document.getElementById('kpi-transaksi').innerText = Number(trx).toLocaleString('id-ID');
            document.getElementById('kpi-tunai').innerText = 'Rp ' + Number(tunai).toLocaleString('id-ID');
            document.getElementById('kpi-qris').innerText = 'Rp ' + Number(qris).toLocaleString('id-ID');

            const pctTunai = total > 0 ? Math.round((tunai / total) * 100) : 0;
            const pctQris = total > 0 ? Math.round((qris / total) * 100) : 0;
            document.getElementById('sub-tunai').innerText = pctTunai + '% dari total omset';
            document.getElementById('sub-qris').innerText = pctQris + '% dari total omset';

            // Top Menu
            const tbodyMenu = document.getElementById('tbody-top-menu');
            if (data.menu_terlaris && data.menu_terlaris.length > 0) {
                tbodyMenu.innerHTML = data.menu_terlaris.map((m, idx) => `
                    <tr>
                        <td><span class="rank-badge">${idx + 1}</span></td>
                        <td><strong>${m.nama_menu}</strong></td>
                        <td style="text-align: center;"><span style="font-weight: 700; color: #be123c;">${m.jumlah_terjual}</span> porsi</td>
                        <td style="text-align: right; font-weight: 600;">Rp ${Number(m.total_penjualan).toLocaleString('id-ID')}</td>
                    </tr>
                `).join('');
            } else {
                tbodyMenu.innerHTML = '<tr><td colspan="4" style="text-align: center; color: #94a3b8; padding: 20px;">Belum ada data penjualan pada periode ini.</td></tr>';
            }

            // Peak Hours
            const tbodyHours = document.getElementById('tbody-peak-hours');
            if (data.jam_ramai && data.jam_ramai.length > 0) {
                tbodyHours.innerHTML = data.jam_ramai.map(h => `
                    <tr>
                        <td><strong>${String(h.jam).padStart(2, '0')}:00 - ${String(h.jam).padStart(2, '0')}:59</strong></td>
                        <td style="text-align: center;"><span style="font-weight: 700; color: #2563eb;">${h.jumlah_transaksi}</span> transaksi</td>
                        <td style="text-align: right; font-weight: 600;">Rp ${Number(h.total_penjualan).toLocaleString('id-ID')}</td>
                    </tr>
                `).join('');
            } else {
                tbodyHours.innerHTML = '<tr><td colspan="3" style="text-align: center; color: #94a3b8; padding: 20px;">Belum ada transaksi pada periode ini.</td></tr>';
            }

        } catch (e) {
            document.getElementById('range-label').innerText = 'Gagal mengambil data dari server.';
        }
    }

    // Load initial
    document.addEventListener('DOMContentLoaded', () => {
        loadLaporan('harian', null);
    });
</script>
</body>
</html>

