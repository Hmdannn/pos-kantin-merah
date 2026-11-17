<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Kantin Merah POS</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-primary); background: #f8fafc; color: #1e293b; }
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

        /* Charts use values returned by the sales report endpoint. */
        .report-chart-grid { display: grid; grid-template-columns: minmax(0, 1.7fr) minmax(280px, 1fr); gap: 20px; margin: 0 0 26px; }
        .chart-panel { min-width: 0; background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,.03); }
        .chart-panel-header { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 16px; }
        .chart-panel-header h3 { font-size: 15px; color: #0f172a; }
        .chart-legend { display: flex; gap: 14px; color: #64748b; font-size: 11px; }
        .chart-legend span { display: inline-flex; align-items: center; gap: 6px; }
        .chart-key { width: 8px; height: 8px; border-radius: 50%; background: #e11d48; }
        .chart-key.previous { background: #fda4af; }
        .report-trend-svg { display: block; width: 100%; height: 210px; overflow: visible; }
        .category-chart-content { min-height: 210px; display: flex; align-items: center; justify-content: space-around; gap: 18px; flex-wrap: wrap; }
        .category-donut { width: 155px; height: 155px; flex: 0 0 155px; transform: rotate(-90deg); }
        .category-donut-bg, .category-donut-segment { fill: none; stroke-width: 16; }
        .category-donut-bg { stroke: #f1f5f9; }
        .category-legend { display: flex; flex-direction: column; gap: 11px; min-width: 130px; flex: 1; }
        .category-legend-row { display: flex; align-items: center; justify-content: space-between; gap: 12px; font-size: 12px; }
        .category-legend-name { display: flex; align-items: center; gap: 7px; color: #334155; min-width: 0; }
        .category-legend-dot { width: 9px; height: 9px; border-radius: 50%; flex: 0 0 9px; }
        .category-legend-value { font-weight: 700; color: #0f172a; white-space: nowrap; }

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
            .report-chart-grid { grid-template-columns: 1fr; }
            .chart-panel { padding: 16px; }
            .chart-panel-header { align-items: flex-start; flex-wrap: wrap; }
        }
    </style>
    <link rel="stylesheet" href="<?= base_url('assets/css/kasir-sidebar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/kasir-ui.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/managerial-ui.css') ?>">
    <?= view('layout/typography') ?>
    <script src="<?= base_url('assets/js/managerial-drawer.js') ?>" defer></script>
</head>
<body>
<div class="layout kasir-layout managerial-layout">
    <?= view('manajerial/_sidebar', ['activeMenu' => 'report']) ?>

    <!-- Main -->
    <main class="main">
        <header class="topbar">
            <div class="managerial-heading">
                <button
                    type="button"
                    class="managerial-menu-toggle kasir-menu-toggle"
                    aria-label="Buka menu navigasi"
                    aria-controls="managerialSidebar"
                    aria-expanded="false"
                >
                    <svg class="i" aria-hidden="true"><use href="#i-menu"/></svg>
                </button>
                <div class="managerial-heading-copy">
                    <h1>Laporan Penjualan</h1>
                    <p class="topbar-sub">Pantau ringkasan penjualan dan aktivitas kantin.</p>
                </div>
            </div>
            <div class="topbar-actions">
                <a href="<?= site_url('menu') ?>" class="btn btn-primary">
                    <svg class="managerial-action-icon" aria-hidden="true"><use href="#i-bowl"/></svg>
                    Kelola Menu
                </a>
                <div class="user-pill">Role: Manajerial / Owner</div>
            </div>
        </header>

        <div class="content">
            <!-- Period Selector (Sesuai PDF: Harian, Mingguan, Bulanan) -->
            <div class="period-bar">
                <div class="period-intro">
                    <span class="section-eyebrow">Rentang laporan</span>
                    <strong id="range-label" aria-live="polite">Memuat data...</strong>
                </div>
                <div class="period-buttons">
                    <button class="btn-period active" onclick="loadLaporan('harian', this)">Harian</button>
                    <button class="btn-period" onclick="loadLaporan('mingguan', this)">Mingguan (7 Hari)</button>
                    <button class="btn-period" onclick="loadLaporan('bulanan', this)">Bulanan</button>
                </div>
            </div>

            <!-- KPI Cards -->
            <div class="report-section-head">
                <div>
                    <span class="section-eyebrow">Ikhtisar</span>
                    <h2>Ringkasan penjualan</h2>
                </div>
                <p>Perbandingan kanal pembayaran dan volume transaksi untuk rentang terpilih.</p>
            </div>
            <div class="kpi-grid">
                <div class="kpi-card kpi-card-primary">
                    <div class="kpi-title">Total Pendapatan</div>
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

            <div class="report-chart-grid">
                <section class="chart-panel" aria-labelledby="sales-trend-title">
                    <div class="chart-panel-header">
                        <h3 id="sales-trend-title">Tren penjualan</h3>
                        <div class="chart-legend" aria-label="Legenda tren penjualan">
                            <span><i class="chart-key"></i><span id="trend-current-label">Periode ini</span></span>
                            <span><i class="chart-key previous"></i><span id="trend-previous-label">Periode sebelumnya</span></span>
                        </div>
                    </div>
                    <svg id="sales-trend-chart" class="report-trend-svg" viewBox="0 0 620 190" preserveAspectRatio="none" role="img" aria-label="Grafik omzet periode ini dibanding periode sebelumnya"></svg>
                </section>

                <section class="chart-panel" aria-labelledby="category-performance-title">
                    <div class="chart-panel-header"><h3 id="category-performance-title">Performa kategori</h3></div>
                    <div class="category-chart-content">
                        <svg id="category-donut-chart" class="category-donut" viewBox="0 0 100 100" role="img" aria-label="Grafik omzet menurut kategori">
                            <circle class="category-donut-bg" cx="50" cy="50" r="38"></circle>
                        </svg>
                        <div id="category-donut-legend" class="category-legend" aria-live="polite"></div>
                    </div>
                </section>
            </div>

            <!-- Content Grid: Top Menu & Peak Hours (Sesuai PDF) -->
            <div class="content-grid">
                <!-- Menu Terlaris -->
                <div class="card-panel">
                    <div class="panel-header">
                        <span>Menu terlaris</span>
                        <small>Berdasarkan kuantitas terjual</small>
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
                        <span>Jam tersibuk</span>
                        <small>Untuk penjadwalan staf</small>
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
    function formatMoney(value) {
        return 'Rp ' + Number(value || 0).toLocaleString('id-ID');
    }

    function renderSalesTrend(trend) {
        const svg = document.getElementById('sales-trend-chart');
        const namespace = 'http://www.w3.org/2000/svg';
        const points = trend && Array.isArray(trend.titik) ? trend.titik : [];
        const node = (tag, attrs = {}, text = '') => {
            const element = document.createElementNS(namespace, tag);
            Object.entries(attrs).forEach(([key, value]) => element.setAttribute(key, value));
            if (text) element.textContent = text;
            return element;
        };

        svg.replaceChildren();
        const left = 52, right = 610, top = 14, bottom = 150;
        const maximum = Math.max(0, ...points.flatMap(point => [Number(point.current) || 0, Number(point.previous) || 0]));
        const rawStep = Math.max(maximum / 3, 1);
        const magnitude = Math.pow(10, Math.floor(Math.log10(rawStep)));
        const step = Math.ceil(rawStep / magnitude) * magnitude;
        const ceiling = step * 3;

        const compactMoney = value => value >= 1000000
            ? `${(value / 1000000).toLocaleString('id-ID', { maximumFractionDigits: 1 })} jt`
            : value >= 1000
                ? `${(value / 1000).toLocaleString('id-ID', { maximumFractionDigits: 0 })} rb`
                : Math.round(value).toLocaleString('id-ID');

        for (let index = 0; index <= 3; index++) {
            const y = top + ((bottom - top) * index / 3);
            const amount = ceiling - step * index;
            svg.append(
                node('line', { x1: left, y1: y, x2: right, y2: y, stroke: '#f1f5f9' }),
                node('text', { x: left - 8, y: y + 4, fill: '#94a3b8', 'font-size': 10, 'text-anchor': 'end' }, compactMoney(amount))
            );
        }

        const currentLabel = trend && trend.granularitas === 'jam' ? 'Hari ini' : 'Periode ini';
        const previousLabel = trend && trend.granularitas === 'jam' ? 'Hari sebelumnya' : 'Periode sebelumnya';
        document.getElementById('trend-current-label').textContent = currentLabel;
        document.getElementById('trend-previous-label').textContent = previousLabel;
        if (!points.length) return;

        const coords = field => points.map((point, index) => ({
            x: points.length === 1 ? (left + right) / 2 : left + ((right - left) * index / (points.length - 1)),
            y: bottom - (((Number(point[field]) || 0) / ceiling) * (bottom - top)),
            value: Number(point[field]) || 0,
            source: point
        }));
        const current = coords('current');
        const previous = coords('previous');
        const path = series => series.map((point, index) => `${index ? 'L' : 'M'} ${point.x} ${point.y}`).join(' ');
        const defs = node('defs');
        const gradient = node('linearGradient', { id: 'salesTrendFill', x1: 0, y1: 0, x2: 0, y2: 1 });
        gradient.append(node('stop', { offset: '0%', 'stop-color': '#e11d48', 'stop-opacity': '.18' }), node('stop', { offset: '100%', 'stop-color': '#e11d48', 'stop-opacity': '0' }));
        defs.appendChild(gradient);
        svg.appendChild(defs);
        const area = `${path(current)} L ${current[current.length - 1].x} ${bottom} L ${current[0].x} ${bottom} Z`;
        svg.append(
            node('path', { d: area, fill: 'url(#salesTrendFill)' }),
            node('path', { d: path(previous), fill: 'none', stroke: '#fda4af', 'stroke-width': 2, 'stroke-dasharray': '4 3' }),
            node('path', { d: path(current), fill: 'none', stroke: '#e11d48', 'stroke-width': 2.6 })
        );

        current.forEach((point, index) => {
            const dateLabel = point.source.date || point.source.label;
            const dot = node('circle', { cx: point.x, cy: point.y, r: 3.5, fill: '#e11d48', stroke: '#fff', 'stroke-width': 2 });
            dot.appendChild(node('title', {}, `${dateLabel} | ${currentLabel}: ${formatMoney(point.value)} | ${previousLabel}: ${formatMoney(previous[index].value)}`));
            svg.appendChild(dot);
        });

        const labelEvery = points.length > 14 ? Math.ceil(points.length / 7) : 1;
        points.forEach((point, index) => {
            if (index % labelEvery !== 0 && index !== points.length - 1) return;
            const x = points.length === 1 ? (left + right) / 2 : left + ((right - left) * index / (points.length - 1));
            svg.appendChild(node('text', { x, y: 178, fill: '#64748b', 'font-size': 10, 'text-anchor': 'middle' }, point.label));
        });
    }

    function renderCategoryPerformance(categories) {
        const svg = document.getElementById('category-donut-chart');
        const legend = document.getElementById('category-donut-legend');
        const rows = Array.isArray(categories) ? categories : [];
        const colors = ['#8b5cf6', '#06b6d4', '#f97316', '#e11d48', '#22c55e', '#eab308', '#64748b'];
        const total = rows.reduce((sum, row) => sum + (Number(row.total_penjualan) || 0), 0);
        const circumference = 2 * Math.PI * 38;
        let offset = 0;

        svg.querySelectorAll('.category-donut-segment').forEach(segment => segment.remove());
        legend.replaceChildren();
        if (total <= 0) {
            const empty = document.createElement('div');
            empty.className = 'category-legend-row';
            empty.textContent = 'Belum ada penjualan pada periode ini';
            empty.style.color = '#64748b';
            legend.appendChild(empty);
            return;
        }

        rows.forEach((row, index) => {
            const value = Number(row.total_penjualan) || 0;
            if (value <= 0) return;
            const ratio = value / total;
            const color = colors[index % colors.length];
            const length = circumference * ratio;
            const segment = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
            segment.setAttribute('class', 'category-donut-segment');
            segment.setAttribute('cx', '50');
            segment.setAttribute('cy', '50');
            segment.setAttribute('r', '38');
            segment.setAttribute('stroke', color);
            segment.setAttribute('stroke-dasharray', `${length} ${circumference - length}`);
            segment.setAttribute('stroke-dashoffset', `${-offset}`);
            const title = document.createElementNS('http://www.w3.org/2000/svg', 'title');
            title.textContent = `${row.nama_kategori}: ${formatMoney(value)}`;
            segment.appendChild(title);
            svg.appendChild(segment);
            offset += length;

            const item = document.createElement('div');
            item.className = 'category-legend-row';
            const nameWrap = document.createElement('span');
            nameWrap.className = 'category-legend-name';
            const dot = document.createElement('i');
            dot.className = 'category-legend-dot';
            dot.style.backgroundColor = color;
            const name = document.createElement('span');
            name.textContent = row.nama_kategori || 'Kategori';
            nameWrap.append(dot, name);
            const amount = document.createElement('span');
            amount.className = 'category-legend-value';
            amount.textContent = `${Math.round(ratio * 100)}%`;
            amount.title = formatMoney(value);
            item.append(nameWrap, amount);
            legend.appendChild(item);
        });
    }

    async function loadLaporan(periode, btnEl) {
        if (btnEl) {
            document.querySelectorAll('.btn-period').forEach(b => b.classList.remove('active'));
            btnEl.classList.add('active');
        }

        document.getElementById('range-label').innerText = 'Memuat laporan periode ' + periode + '...';

        try {
            const res = await fetch('<?= site_url('manajerial/laporan') ?>?format=json&periode=' + periode);
            const resJson = await res.json();

            if (!resJson.status) {
                alert('Gagal memuat data laporan: ' + resJson.message);
                return;
            }

            const data = resJson.data;
            renderSalesTrend(data.tren_penjualan);
            renderCategoryPerformance(data.performa_kategori);
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
