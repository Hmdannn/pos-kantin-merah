<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Dashboard Kasir - Kantin Merah POS</title>
<style>
:root{
  --bg:#f4f5f7; --surface:#fff; --surface-2:#f8f9fb; --line:#e7e9ee; --text:#14161c; --muted:#6a7080;
  --brand:#b3122b; --brand-d:#8c0e22; --brand-soft:#fde8eb;
  --side:#1b0f13; --side-text:#d9c9cc; --side-active:#b3122b;
  --ok:#0e9f6e; --ok-soft:#dcf7ea; --warn:#c77700; --warn-soft:#fff1d6; --info:#2563eb; --info-soft:#e3ecff; --bad:#d92d20;
  --r-lg:20px; --r-md:12px; --r-sm:8px;
  --shadow:0 1px 2px rgba(20,22,28,.04),0 8px 24px -12px rgba(20,22,28,.12);
}
[data-theme="dark"]{
  --bg:#0e1014; --surface:#171a21; --surface-2:#1d212a; --line:#272c37; --text:#eef0f5; --muted:#8e95a6;
  --brand-soft:#3a1219; --side:#0a0608; --ok-soft:#0f3325; --warn-soft:#3a2a0b; --info-soft:#14284f;
  --shadow:0 1px 2px rgba(0,0,0,.4),0 8px 24px -12px rgba(0,0,0,.6);
}
*{box-sizing:border-box;margin:0;padding:0}
html{color-scheme:light dark}
body{font-family:"Plus Jakarta Sans",system-ui,-apple-system,"Segoe UI",Roboto,sans-serif;background:var(--bg);color:var(--text);font-size:14px;line-height:1.5;-webkit-font-smoothing:antialiased}
svg.i{width:18px;height:18px;flex-shrink:0;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
:focus-visible{outline:2px solid var(--brand);outline-offset:2px}
.layout{display:flex;min-height:100vh}

/* Sidebar */
.sidebar{width:248px;background:var(--side);color:var(--side-text);padding:22px 14px;display:flex;flex-direction:column;position:sticky;top:0;height:100vh;flex-shrink:0}
.brand{display:flex;gap:12px;align-items:center;padding:0 8px 22px}
.brand-mark{width:40px;height:40px;border-radius:12px;background:var(--brand);color:#fff;display:grid;place-items:center;font-weight:800;font-size:18px}
.brand-name{font-weight:800;color:#fff;font-size:16px;line-height:1.1}
.brand-sub{font-size:11px;opacity:.65}
.nav-label{font-size:12px;opacity:.5;margin:14px 10px 6px}
.nav-link{display:flex;gap:12px;align-items:center;color:var(--side-text);text-decoration:none;padding:11px 12px;border-radius:var(--r-md);font-weight:600;margin-bottom:2px;transition:background .15s,color .15s}
.nav-link:hover{background:rgba(255,255,255,.07);color:#fff}
.nav-link.active{background:var(--side-active);color:#fff}
.sidebar-bottom{margin-top:auto;border-top:1px solid rgba(255,255,255,.1);padding-top:14px}
.operator{display:flex;gap:10px;align-items:center;padding:6px 10px 12px}
.avatar{width:36px;height:36px;border-radius:50%;background:#3a2429;color:#fff;display:grid;place-items:center;font-weight:700}
.operator small{display:block;font-size:11px;opacity:.6}
.operator strong{color:#fff;font-weight:700}

/* Main */
.main{flex:1;min-width:0;display:flex;flex-direction:column}
.topbar{position:sticky;top:0;z-index:20;background:color-mix(in srgb,var(--bg) 82%,transparent);backdrop-filter:blur(14px);padding:16px 28px;display:flex;align-items:center;gap:14px;border-bottom:1px solid var(--line)}
.topbar h1{font-size:20px;font-weight:800;letter-spacing:-.01em}
.topbar .sp{flex:1}
.clock{font-weight:700;font-variant-numeric:tabular-nums;background:var(--surface);border:1px solid var(--line);padding:8px 14px;border-radius:99px}
.icon-btn{width:40px;height:40px;border-radius:50%;border:1px solid var(--line);background:var(--surface);color:var(--text);display:grid;place-items:center;cursor:pointer}
.icon-btn:hover{border-color:var(--brand);color:var(--brand)}
.menu-btn{display:none}
.content{padding:24px 28px 48px;max-width:1500px;width:100%}

/* Shift hero */
.shift{background:var(--surface);border:1px solid var(--line);border-radius:var(--r-lg);padding:22px 24px;display:flex;gap:20px;align-items:center;justify-content:space-between;flex-wrap:wrap;box-shadow:var(--shadow);margin-bottom:18px}
.shift-state{display:flex;gap:14px;align-items:center}
.pulse{width:12px;height:12px;border-radius:50%;background:var(--ok);box-shadow:0 0 0 0 rgba(14,159,110,.5);animation:pulse 2s infinite}
.pulse.off{background:var(--bad);animation:none}
@keyframes pulse{70%{box-shadow:0 0 0 10px rgba(14,159,110,0)}100%{box-shadow:0 0 0 0 rgba(14,159,110,0)}}
.shift h2{font-size:17px;font-weight:800}
.shift p{color:var(--muted);font-size:13px}
.btn{display:inline-flex;gap:8px;align-items:center;justify-content:center;border:0;border-radius:var(--r-md);padding:11px 18px;font:inherit;font-weight:700;cursor:pointer;transition:transform .1s,background .15s,opacity .15s;text-decoration:none}
.btn:active{transform:scale(.97)}
.btn:disabled{opacity:.55;cursor:wait}
.btn-brand{background:var(--brand);color:#fff}.btn-brand:hover{background:var(--brand-d)}
.btn-dark{background:var(--text);color:var(--bg)}
.btn-ok{background:var(--ok);color:#fff}.btn-ok:hover{filter:brightness(.92)}
.btn-info{background:var(--info);color:#fff;width:100%}.btn-info:hover{filter:brightness(.92)}
.btn-ghost{background:transparent;color:var(--bad);border:1px solid var(--line)}.btn-ghost:hover{background:var(--brand-soft)}

/* Stats */
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:30px}
.stat{background:var(--surface);border:1px solid var(--line);border-radius:var(--r-lg);padding:18px;display:flex;gap:14px;align-items:center}
.stat-ic{width:44px;height:44px;border-radius:14px;display:grid;place-items:center;flex-shrink:0}
.stat-ic.warn{background:var(--warn-soft);color:var(--warn)}
.stat-ic.info{background:var(--info-soft);color:var(--info)}
.stat-ic.ok{background:var(--ok-soft);color:var(--ok)}
.stat-ic.brand{background:var(--brand-soft);color:var(--brand)}
.stat small{color:var(--muted);font-weight:600;font-size:12px;display:block}
.stat b{font-size:21px;font-weight:800;letter-spacing:-.02em;font-variant-numeric:tabular-nums}

/* Section heads */
.sec{display:flex;align-items:center;justify-content:space-between;gap:12px;margin:0 0 14px}
.sec h3{font-size:17px;font-weight:800;display:flex;gap:10px;align-items:center}
.count{background:var(--brand-soft);color:var(--brand);border-radius:99px;font-size:12px;padding:2px 10px;font-weight:800}
.link{color:var(--brand);text-decoration:none;font-weight:700;font-size:13px;display:inline-flex;gap:6px;align-items:center;background:none;border:0;cursor:pointer;font-family:inherit}
.link:hover{text-decoration:underline}
section{margin-bottom:34px}

/* Incoming list */
.incoming{background:var(--surface);border:1px solid var(--line);border-radius:var(--r-lg);overflow:hidden;box-shadow:var(--shadow)}
.incoming-head{padding:12px 20px;border-bottom:1px solid var(--line);color:var(--muted);font-size:12.5px;display:flex;justify-content:space-between;gap:10px;flex-wrap:wrap;align-items:center}
.incoming-head b{color:var(--text)}
.tbl-wrap{overflow-x:auto}
table{width:100%;border-collapse:collapse}
th{text-align:left;font-size:12px;color:var(--muted);font-weight:600;padding:10px 20px;background:var(--surface-2);white-space:nowrap}
td{padding:14px 20px;border-top:1px solid var(--line);vertical-align:middle}
.q{display:inline-grid;place-items:center;min-width:56px;height:48px;padding:0 10px;border-radius:12px;background:var(--brand);color:#fff;font-weight:800;font-size:20px;font-variant-numeric:tabular-nums}
.sub{color:var(--muted);font-size:12px}
.code{font-weight:800}
.chip{display:inline-block;padding:4px 11px;border-radius:99px;font-size:12px;font-weight:700;background:var(--warn-soft);color:var(--warn);white-space:nowrap}
.empty{padding:34px 20px;text-align:center;color:var(--muted)}
.empty-card{background:var(--surface);border:1.5px dashed var(--line);border-radius:var(--r-lg);padding:40px 20px;text-align:center;color:var(--muted)}
.empty-card svg{width:30px;height:30px;margin-bottom:8px;opacity:.6}

/* Order cards */
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(330px,1fr));gap:16px}
.card{background:var(--surface);border:1px solid var(--line);border-radius:var(--r-lg);padding:18px;display:flex;flex-direction:column;gap:14px;box-shadow:var(--shadow)}
.card.ready{border-color:color-mix(in srgb,var(--info) 45%,var(--line))}
.card-head{display:flex;justify-content:space-between;gap:10px;align-items:flex-start}
.card-code{font-weight:800;font-size:16px}
.deadline{display:inline-block;margin-top:4px;font-size:12px;font-weight:700;color:var(--warn);background:var(--warn-soft);padding:2px 9px;border-radius:99px}
.badge{font-size:12px;font-weight:800;padding:4px 11px;border-radius:99px;background:var(--info-soft);color:var(--info);white-space:nowrap}
.dest{display:grid;grid-template-columns:1fr 1fr;gap:1px;background:var(--line);border-radius:var(--r-md);overflow:hidden}
.dest>div{background:var(--surface-2);padding:10px 14px}
.dest small{display:flex;gap:6px;align-items:center;color:var(--muted);font-size:12px;font-weight:600}
.dest small svg{width:14px;height:14px}
.dest b{font-size:16px;font-weight:800;word-break:break-word}
.card.ready .dest>div:first-child{background:var(--info-soft)}
.card.ready .dest>div:first-child b{color:var(--info)}
.items{list-style:none;display:flex;flex-direction:column;gap:8px;flex-grow:1}
.items li{display:flex;justify-content:space-between;gap:12px}
.qty{display:inline-block;min-width:28px;font-weight:800;color:var(--brand)}
.note{display:block;font-size:12px;color:var(--warn);margin-left:28px}
.total{display:flex;justify-content:space-between;align-items:baseline;border-top:1px dashed var(--line);padding-top:12px}
.total span{color:var(--muted);font-weight:600}
.total b{font-size:22px;font-weight:800;letter-spacing:-.02em}
.pay{background:var(--surface-2);border:1px solid var(--line);border-radius:var(--r-md);padding:12px}
.pay label{font-size:12px;font-weight:700;color:var(--muted);display:block;margin-bottom:6px}
.pay input{width:100%;padding:11px 12px;border:1.5px solid var(--line);border-radius:var(--r-sm);font:inherit;font-size:18px;font-weight:800;background:var(--surface);color:var(--text);font-variant-numeric:tabular-nums}
.pay input:focus{border-color:var(--brand);outline:0}
.quick{display:flex;gap:6px;flex-wrap:wrap;margin:8px 0}
.quick button{border:1px solid var(--line);background:var(--surface);color:var(--text);border-radius:99px;padding:5px 12px;font:inherit;font-size:12px;font-weight:700;cursor:pointer}
.quick button:hover{border-color:var(--brand);color:var(--brand)}
.change{font-weight:800;font-size:14px;color:var(--ok)}
.change.short{color:var(--bad)}
.actions{display:flex;gap:8px}
.actions .btn-ok{flex:1}

/* Modal & toast */
dialog{border:0;border-radius:var(--r-lg);padding:24px;width:min(400px,92vw);background:var(--surface);color:var(--text);box-shadow:0 30px 80px rgba(0,0,0,.35);margin:auto}
dialog::backdrop{background:rgba(10,6,8,.55);backdrop-filter:blur(3px)}
dialog h4{font-size:18px;font-weight:800;margin-bottom:6px}
dialog p{color:var(--muted);margin-bottom:20px}
dialog .row{display:flex;gap:10px;justify-content:flex-end}
dialog .btn-plain{background:var(--surface-2);color:var(--text);border:1px solid var(--line)}
#toasts{position:fixed;right:20px;bottom:20px;z-index:100;display:flex;flex-direction:column;gap:10px}
.toast{background:var(--text);color:var(--bg);padding:12px 16px;border-radius:var(--r-md);font-weight:600;max-width:340px;box-shadow:var(--shadow);border-left:5px solid var(--ok);animation:tin .25s ease-out}
.toast.err{border-left-color:var(--bad)}
@keyframes tin{from{transform:translateY(10px);opacity:0}}

/* Responsive */
@media(max-width:1100px){.stats{grid-template-columns:repeat(2,1fr)}}
@media(max-width:860px){
  .sidebar{position:fixed;z-index:50;left:0;top:0;transform:translateX(-100%);transition:transform .25s}
  .sidebar.open{transform:none}
  .scrim{position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:40;display:none}
  .sidebar.open+.scrim{display:block}
  .menu-btn{display:grid}
  .topbar,.content{padding-left:16px;padding-right:16px}
  .clock{display:none}
}
@media(max-width:520px){.stats{grid-template-columns:1fr}.grid{grid-template-columns:1fr}}
@media(max-width:600px){
  .topbar{padding:12px;gap:10px;flex-wrap:wrap}
  .topbar h1{font-size:18px}
  .topbar .sp{min-width:0}
  .content{padding:16px 12px 32px}
  .shift{padding:16px;gap:14px}
  .shift-state{align-items:flex-start}
  .shift-state>div{min-width:0}
  .shift p{overflow-wrap:anywhere}
  .stat{min-width:0;padding:14px}
  .stat b{overflow-wrap:anywhere;font-size:19px}
  .sec{align-items:flex-start;flex-wrap:wrap}
  .sec h3{min-width:0;flex-wrap:wrap}
  .card{min-width:0;padding:15px}
  .card-head,.total{min-width:0;overflow-wrap:anywhere}
  .card-head>div{min-width:0;overflow-wrap:anywhere}
  .dest{grid-template-columns:repeat(2,minmax(0,1fr))}
  .dest>div{min-width:0;padding:9px}
  .dest b{overflow-wrap:anywhere;font-size:14px}
  .items li{min-width:0}
  .items li>div{min-width:0;overflow-wrap:anywhere}
  .actions{flex-wrap:wrap}
  .actions .btn{min-height:44px}
  .quick button{min-height:40px}
  .tbl-wrap{max-width:100%;overscroll-behavior-x:contain}
  #toasts{right:12px;bottom:12px;left:12px}
  .toast{max-width:none}
}
@media(prefers-reduced-motion:reduce){*{animation:none!important;transition:none!important}}
</style>
<link rel="stylesheet" href="<?= base_url('assets/css/formal-ui.css') ?>">
</head>
<body>
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <symbol id="i-grid" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></symbol>
  <symbol id="i-receipt" viewBox="0 0 24 24"><path d="M5 3h14v18l-3-2-2 2-2-2-2 2-2-2-3 2z"/><path d="M9 8h6M9 12h6"/></symbol>
  <symbol id="i-clock" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></symbol>
  <symbol id="i-cart" viewBox="0 0 24 24"><path d="M3 4h2l2.5 11h10L20 7H6"/><circle cx="9" cy="19" r="1.5"/><circle cx="17" cy="19" r="1.5"/></symbol>
  <symbol id="i-out" viewBox="0 0 24 24"><path d="M9 4H5v16h4M16 8l4 4-4 4M20 12H9"/></symbol>
  <symbol id="i-wallet" viewBox="0 0 24 24"><path d="M3 7h16a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M3 7l12-3v3M17 14h2"/></symbol>
  <symbol id="i-bag" viewBox="0 0 24 24"><path d="M5 8h14l-1 12H6zM9 8V6a3 3 0 0 1 6 0v2"/></symbol>
  <symbol id="i-qr" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><path d="M14 14h3v3M21 14v1M14 21h1M18 18v3h3"/></symbol>
  <symbol id="i-table" viewBox="0 0 24 24"><path d="M4 9h16M6 9v10M18 9v10M3 9l1-4h16l1 4"/></symbol>
  <symbol id="i-user" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21c1-4 4-6 8-6s7 2 8 6"/></symbol>
  <symbol id="i-refresh" viewBox="0 0 24 24"><path d="M20 11a8 8 0 0 0-14-4L4 9M4 4v5h5M4 13a8 8 0 0 0 14 4l2-2M20 20v-5h-5"/></symbol>
  <symbol id="i-moon" viewBox="0 0 24 24"><path d="M20 14A8 8 0 0 1 10 4a8 8 0 1 0 10 10z"/></symbol>
  <symbol id="i-menu" viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h16"/></symbol>
  <symbol id="i-send" viewBox="0 0 24 24"><path d="M21 3L10 14M21 3l-7 18-4-7-7-4z"/></symbol>
  <symbol id="i-check" viewBox="0 0 24 24"><path d="M5 12l5 5 9-10"/></symbol>
  <symbol id="i-inbox" viewBox="0 0 24 24"><path d="M3 13l3-8h12l3 8v6H3zM3 13h5l1 3h6l1-3h5"/></symbol>
</svg>

<div class="layout">
  <aside class="sidebar" id="sidebar">
    <div class="brand">
      <div class="brand-mark">K</div>
      <div><div class="brand-name">Kantin Merah</div><div class="brand-sub">Point of Sale · UNP Kampus 1</div></div>
    </div>

    <div class="nav-label">Menu kasir</div>
    <a class="nav-link active" href="<?= site_url('kasir') ?>"><svg class="i"><use href="#i-grid"/></svg>Antrean pembayaran</a>
    <a class="nav-link" href="<?= site_url('kasir/riwayat') ?>"><svg class="i"><use href="#i-receipt"/></svg>Riwayat transaksi</a>
    <a class="nav-link" href="<?= site_url('kasir/shift') ?>"><svg class="i"><use href="#i-clock"/></svg>Kelola shift kasir</a>
    <a class="nav-link" href="<?= site_url('customer') ?>" target="_blank"><svg class="i"><use href="#i-cart"/></svg>Halaman customer</a>

    <div class="sidebar-bottom">
      <?php $namaKasir = (string) (session()->get('nama') ?? 'Kasir'); ?>
      <div class="operator">
        <div class="avatar"><?= esc(strtoupper(mb_substr($namaKasir, 0, 1))) ?></div>
        <div><small>Petugas</small><strong><?= esc($namaKasir) ?></strong></div>
      </div>
      <a class="nav-link" href="<?= site_url('logout') ?>"><svg class="i"><use href="#i-out"/></svg>Keluar</a>
    </div>
  </aside>
  <div class="scrim" onclick="document.getElementById('sidebar').classList.remove('open')"></div>

  <main class="main">
    <header class="topbar">
      <button class="icon-btn menu-btn" aria-label="Buka menu" onclick="document.getElementById('sidebar').classList.toggle('open')"><svg class="i"><use href="#i-menu"/></svg></button>
      <h1>Antrean kasir</h1>
      <div class="sp"></div>
      <div class="clock" id="clock">--:--:--</div>
      <button class="icon-btn" id="themeBtn" aria-label="Ganti tema gelap/terang"><svg class="i"><use href="#i-moon"/></svg></button>
    </header>

    <div class="content">

      <!-- Status shift -->
      <div class="shift">
        <div class="shift-state">
          <span class="pulse <?= $shiftAktif ? '' : 'off' ?>"></span>
          <div>
            <?php if ($shiftAktif): ?>
              <h2>Shift #<?= esc($shiftAktif['id_shift']) ?> sedang berjalan</h2>
              <p>Mulai <?= esc($shiftAktif['waktu_mulai']) ?> &middot; Tunai Rp <?= number_format($shiftAktif['total_kas_tunai'], 0, ',', '.') ?> &middot; QRIS Rp <?= number_format($shiftAktif['total_kas_qris'], 0, ',', '.') ?></p>
            <?php else: ?>
              <h2>Belum ada shift aktif</h2>
              <p>Buka shift dulu untuk memproses pembayaran tunai.</p>
            <?php endif; ?>
          </div>
        </div>
        <?php if ($shiftAktif): ?>
          <button class="btn btn-dark" onclick="tutupShift(<?= esc($shiftAktif['id_shift']) ?>, this)">Tutup shift</button>
        <?php else: ?>
          <button class="btn btn-brand" onclick="bukaShift(this)">Buka shift sekarang</button>
        <?php endif; ?>
      </div>

      <!-- Statistik -->
      <div class="stats">
        <div class="stat"><div class="stat-ic warn"><svg class="i"><use href="#i-wallet"/></svg></div>
          <div><small>Menunggu bayar tunai</small><b><?= count($pesananTunai) ?> pesanan</b></div></div>
        <div class="stat"><div class="stat-ic info"><svg class="i"><use href="#i-bag"/></svg></div>
          <div><small>Siap diserahkan</small><b><?= count($pesananSiap) ?> pesanan</b></div></div>
        <div class="stat"><div class="stat-ic ok"><svg class="i"><use href="#i-wallet"/></svg></div>
          <div><small>Kas tunai shift ini</small><b>Rp <?= number_format($shiftAktif['total_kas_tunai'] ?? 0, 0, ',', '.') ?></b></div></div>
        <div class="stat"><div class="stat-ic brand"><svg class="i"><use href="#i-qr"/></svg></div>
          <div><small>Kas QRIS shift ini</small><b>Rp <?= number_format($shiftAktif['total_kas_qris'] ?? 0, 0, ',', '.') ?></b></div></div>
      </div>

      <!-- Transaksi baru masuk -->
      <section>
        <div class="sec">
          <h3>Baru masuk ke dapur</h3>
          <a class="link" href="<?= site_url('kasir/riwayat') ?>">Lihat riwayat</a>
        </div>
        <div class="incoming">
          <div class="incoming-head">
            <span><b>5 transaksi terbaru</b> yang sudah dibayar, urut nomor antrean</span>
            <a class="link" href="<?= site_url('kasir') ?>"><svg class="i" style="width:15px;height:15px"><use href="#i-refresh"/></svg>Segarkan</a>
          </div>
          <div class="tbl-wrap">
            <table>
              <thead><tr><th>Antrean</th><th>Pesanan</th><th>Pemesan</th><th>Status</th><th>Masuk</th></tr></thead>
              <tbody>
              <?php if (empty($pesananBaruMasuk)): ?>
                <tr><td colspan="5" class="empty">Belum ada transaksi baru. Pesanan yang sudah dibayar muncul di sini.</td></tr>
              <?php else: ?>
                <?php foreach ($pesananBaruMasuk as $p): ?>
                  <?php
                    $idCustomer = trim((string) ($p['id_customer'] ?? ''));
                    if ($idCustomer === '') {
                        $mejaPemesan = trim((string) ($p['nomor_meja'] ?? ''));
                        $namaPemesan = trim((string) ($p['nama_customer'] ?? ''));
                        if ($mejaPemesan !== '' && $namaPemesan !== '') {
                            $idCustomer = $mejaPemesan . ' - ' . $namaPemesan;
                        } elseif ($mejaPemesan !== '') {
                            $idCustomer = $mejaPemesan;
                        } elseif ($namaPemesan !== '') {
                            $idCustomer = $namaPemesan;
                        } else {
                            $idCustomer = 'Pelanggan';
                        }
                    }
                  ?>
                  <tr>
                    <td><span class="q"><?= format_no_antrian($p['no_antrian'] ?? null) ?></span></td>
                    <td><div class="code"><?= esc($p['kode_pesanan']) ?></div><div class="sub">Rp <?= number_format($p['total_bayar'], 0, ',', '.') ?></div></td>
                    <td><b><?= esc($idCustomer) ?></b>
                      <div class="sub"><?= esc(!empty($p['nama_customer']) ? $p['nama_customer'] : 'Pelanggan') ?> &middot; <?= esc(!empty($p['nomor_meja']) ? $p['nomor_meja'] : 'Meja -') ?></div></td>
                    <td><span class="chip"><?= esc($p['status']) ?></span></td>
                    <td style="white-space:nowrap" class="sub"><?= date('H:i', strtotime($p['waktu_pesan'])) ?> WIB</td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- Antrean pembayaran tunai -->
      <section>
        <div class="sec">
          <h3>Menunggu pembayaran tunai <span class="count"><?= count($pesananTunai) ?></span></h3>
        </div>
        <?php if (empty($pesananTunai)): ?>
          <div class="empty-card"><svg class="i"><use href="#i-inbox"/></svg><div>Tidak ada pesanan yang menunggu pembayaran tunai.</div></div>
        <?php else: ?>
          <div class="grid">
            <?php foreach ($pesananTunai as $p): ?>
              <?php $id = (int) $p['id_pesanan']; ?>
              <article class="card" id="card-pesanan-<?= $id ?>">
                <div class="card-head">
                  <div>
                    <div class="card-code"><?= esc($p['kode_pesanan']) ?></div>
                    <?php if (!empty($p['pembayaran']['batas_waktu'])): ?>
                      <span class="deadline">Bayar sebelum <?= date('H:i', strtotime($p['pembayaran']['batas_waktu'])) ?> WIB</span>
                    <?php endif; ?>
                  </div>
                  <span class="sub"><?= date('H:i', strtotime($p['waktu_pesan'])) ?> WIB</span>
                </div>

                <div class="dest">
                  <div><small><svg class="i"><use href="#i-table"/></svg>Meja</small><b><?= esc(!empty($p['nomor_meja']) ? $p['nomor_meja'] : 'Meja -') ?></b></div>
                  <div><small><svg class="i"><use href="#i-user"/></svg>Pemesan</small><b><?= esc(!empty($p['nama_customer']) ? $p['nama_customer'] : 'Pelanggan') ?></b></div>
                </div>

                <ul class="items">
                  <?php foreach ($p['items'] as $item): ?>
                    <li>
                      <div>
                        <span class="qty"><?= esc($item['jumlah']) ?>x</span><?= esc($item['nama_menu']) ?>
                        <?php if (!empty($item['catatan_khusus'])): ?><span class="note">Catatan: <?= esc($item['catatan_khusus']) ?></span><?php endif; ?>
                      </div>
                      <span class="sub" style="white-space:nowrap">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></span>
                    </li>
                  <?php endforeach; ?>
                </ul>

                <div class="total">
                  <span>Total tagihan</span>
                  <b id="total-val-<?= $id ?>" data-total="<?= $p['total_bayar'] ?>">Rp <?= number_format($p['total_bayar'], 0, ',', '.') ?></b>
                </div>

                <div class="pay">
                  <label for="uang-<?= $id ?>">Uang diterima (Rp)</label>
                  <input type="number" inputmode="numeric" id="uang-<?= $id ?>" placeholder="0" oninput="hitungKembalian(<?= $id ?>)">
                  <div class="quick">
                    <button type="button" onclick="isiUang(<?= $id ?>,'pas')">Uang pas</button>
                    <button type="button" onclick="isiUang(<?= $id ?>,20000)">20rb</button>
                    <button type="button" onclick="isiUang(<?= $id ?>,50000)">50rb</button>
                    <button type="button" onclick="isiUang(<?= $id ?>,100000)">100rb</button>
                  </div>
                  <div class="change" id="kembalian-<?= $id ?>">Kembalian: Rp 0</div>
                </div>

                <div class="actions">
                  <button class="btn btn-ok" onclick="prosesBayar(<?= $id ?>, this)"><svg class="i"><use href="#i-check"/></svg>Konfirmasi bayar</button>
                  <button class="btn btn-ghost" onclick="batalkanPesanan(<?= $id ?>, this)">Batalkan</button>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </section>

      <!-- Pesanan siap diserahkan -->
      <section>
        <div class="sec">
          <h3>Siap diantar ke pembeli <span class="count"><?= count($pesananSiap) ?></span></h3>
          <span class="sub">Dapur sudah selesai memasak</span>
        </div>
        <?php if (empty($pesananSiap)): ?>
          <div class="empty-card"><svg class="i"><use href="#i-bag"/></svg><div>Belum ada pesanan yang siap diantar.</div></div>
        <?php else: ?>
          <div class="grid">
            <?php foreach ($pesananSiap as $p): ?>
              <?php $meja = !empty($p['nomor_meja']) ? $p['nomor_meja'] : 'Meja -'; ?>
              <article class="card ready">
                <div class="card-head">
                  <div class="card-code"><?= esc($p['kode_pesanan']) ?></div>
                  <span class="badge">Siap diantar</span>
                </div>
                <div class="dest">
                  <div><small><svg class="i"><use href="#i-table"/></svg>Antar ke</small><b><?= esc($meja) ?></b></div>
                  <div><small><svg class="i"><use href="#i-user"/></svg>Pemesan</small><b><?= esc(!empty($p['nama_customer']) ? $p['nama_customer'] : 'Pelanggan') ?></b></div>
                </div>
                <ul class="items">
                  <?php foreach ($p['items'] as $item): ?>
                    <li>
                      <div>
                        <span class="qty"><?= esc($item['jumlah']) ?>x</span><?= esc($item['nama_menu']) ?>
                        <?php if (!empty($item['catatan_khusus'])): ?><span class="note">Catatan: <?= esc($item['catatan_khusus']) ?></span><?php endif; ?>
                      </div>
                    </li>
                  <?php endforeach; ?>
                </ul>
                <button class="btn btn-info" onclick="tandaiSelesai(<?= (int) $p['id_pesanan'] ?>, this)">
                  <svg class="i"><use href="#i-send"/></svg>Antar ke <?= esc(!empty($p['nomor_meja']) ? $p['nomor_meja'] : 'customer') ?> &amp; selesai
                </button>
              </article>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </section>

    </div>
  </main>
</div>

<dialog id="dlg">
  <h4 id="dlgTitle"></h4>
  <p id="dlgMsg"></p>
  <div class="row">
    <button class="btn btn-plain" id="dlgNo">Batal</button>
    <button class="btn btn-brand" id="dlgYes">Ya</button>
  </div>
</dialog>
<div id="toasts" aria-live="polite"></div>

<script>
/* ---------- UI helpers ---------- */
const rp = n => 'Rp ' + Number(n).toLocaleString('id-ID');

function toast(msg, err) {
    const t = document.createElement('div');
    t.className = 'toast' + (err ? ' err' : '');
    t.textContent = msg;
    document.getElementById('toasts').appendChild(t);
    setTimeout(() => t.remove(), 4000);
}

function konfirmasi(judul, pesan, label) {
    return new Promise(resolve => {
        const d = document.getElementById('dlg');
        document.getElementById('dlgTitle').textContent = judul;
        document.getElementById('dlgMsg').textContent = pesan;
        document.getElementById('dlgYes').textContent = label || 'Ya';
        const done = v => { d.close(); resolve(v); };
        document.getElementById('dlgYes').onclick = () => done(true);
        document.getElementById('dlgNo').onclick = () => done(false);
        d.oncancel = () => resolve(false);
        d.showModal();
    });
}

function muatUlang() { setTimeout(() => location.reload(), 900); }

/* Jam, tema, menu */
setInterval(() => { document.getElementById('clock').textContent = new Date().toLocaleTimeString('id-ID', {hour12: false}); }, 1000);
(function () {
    let tema = null;
    try { tema = localStorage.getItem('tema'); } catch (e) {}
    if (!tema) tema = matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    document.documentElement.dataset.theme = tema;
    document.getElementById('themeBtn').onclick = () => {
        const baru = document.documentElement.dataset.theme === 'dark' ? 'light' : 'dark';
        document.documentElement.dataset.theme = baru;
        try { localStorage.setItem('tema', baru); } catch (e) {}
    };
})();

/* ---------- Logika asli ---------- */
async function bacaJson(res) {
    let data = null;
    try { data = await res.json(); } catch (e) { data = null; }
    if (!res.ok) throw new Error((data && data.message) ? data.message : 'Server mengembalikan HTTP ' + res.status + '.');
    if (!data) throw new Error('Respons server tidak valid. Pastikan sesi login Anda masih aktif.');
    return data;
}

function hitungKembalian(idPesanan) {
    const total = parseFloat(document.getElementById('total-val-' + idPesanan).dataset.total);
    const uang = parseFloat(document.getElementById('uang-' + idPesanan).value) || 0;
    const el = document.getElementById('kembalian-' + idPesanan);
    const selisih = uang - total;
    if (selisih >= 0) {
        el.textContent = 'Kembalian: ' + rp(selisih);
        el.classList.remove('short');
    } else {
        el.textContent = 'Kurang: ' + rp(Math.abs(selisih));
        el.classList.add('short');
    }
}

function isiUang(idPesanan, nominal) {
    const total = parseFloat(document.getElementById('total-val-' + idPesanan).dataset.total);
    document.getElementById('uang-' + idPesanan).value = nominal === 'pas' ? total : nominal;
    hitungKembalian(idPesanan);
}

async function kirim(btn, fn) {
    if (btn) btn.disabled = true;
    try { await fn(); } catch (e) { toast(e.message, true); if (btn) btn.disabled = false; }
}

async function prosesBayar(idPesanan, btn) {
    const total = parseFloat(document.getElementById('total-val-' + idPesanan).dataset.total);
    const uang = parseFloat(document.getElementById('uang-' + idPesanan).value);
    if (!uang || uang < total) { toast('Uang diterima kurang dari total tagihan.', true); return; }
    if (!await konfirmasi('Konfirmasi pembayaran', 'Terima uang tunai ' + rp(uang) + '?', 'Konfirmasi bayar')) return;
    kirim(btn, async () => {
        const fd = new FormData();
        fd.append('metode', 'Tunai');
        fd.append('jumlah_diterima', uang);
        const data = await bacaJson(await fetch('<?= site_url('pesanan') ?>/' + idPesanan + '/pembayaran', {method: 'POST', body: fd}));
        if (!data.status) throw new Error(data.message || 'Terjadi kesalahan');
        toast('Pembayaran dikonfirmasi. Pesanan diteruskan ke dapur.');
        muatUlang();
    });
}

async function batalkanPesanan(idPesanan, btn) {
    if (!await konfirmasi('Batalkan pesanan?', 'Pesanan ini akan dibatalkan dan tidak bisa dikembalikan.', 'Batalkan pesanan')) return;
    kirim(btn, async () => {
        const fd = new FormData();
        fd.append('status', 'Dibatalkan');
        const data = await bacaJson(await fetch('<?= site_url('pesanan') ?>/' + idPesanan + '/status', {method: 'POST', body: fd}));
        if (!data.status) throw new Error(data.message);
        toast('Pesanan dibatalkan.');
        muatUlang();
    });
}

async function tandaiSelesai(idPesanan, btn) {
    if (!await konfirmasi('Pesanan sudah diserahkan?', 'Pastikan pesanan sudah sampai ke pemesan sesuai meja dan nama.', 'Ya, sudah diserahkan')) return;
    kirim(btn, async () => {
        const data = await bacaJson(await fetch('<?= site_url('kasir/pesanan') ?>/' + idPesanan + '/selesai', {method: 'POST'}));
        if (!data.status) throw new Error(data.message);
        toast('Pesanan selesai diserahkan.');
        muatUlang();
    });
}

async function bukaShift(btn) {
    kirim(btn, async () => {
        const data = await bacaJson(await fetch('<?= site_url('shift/buka') ?>', {method: 'POST'}));
        if (!data.status) throw new Error(data.message);
        toast('Shift dibuka. Anda bisa mulai melayani transaksi.');
        muatUlang();
    });
}

async function tutupShift(idShift, btn) {
    if (!await konfirmasi('Tutup shift ini?', 'Total kas shift akan dihitung dan shift berakhir.', 'Tutup shift')) return;
    kirim(btn, async () => {
        const fd = new FormData();
        fd.append('id_shift', idShift);
        const data = await bacaJson(await fetch('<?= site_url('shift/tutup') ?>', {method: 'POST', body: fd}));
        if (!data.status) throw new Error(data.message);
        toast('Shift ditutup. Total tunai: ' + rp(data.data.total_kas_tunai));
        muatUlang();
    });
}
</script>
</body>
</html>
