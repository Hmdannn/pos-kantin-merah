<?php
$namaKasir = (string) (session()->get('nama') ?? 'Kasir');

$mejaShort = static function ($value): string {
    $value = trim((string) $value);
    if ($value === '') {
        return '—';
    }

    return preg_replace('/^meja\s+/i', '', $value) ?: $value;
};

$kasTunai = (float) ($shiftAktif['total_kas_tunai'] ?? 0);
$kasQris  = (float) ($shiftAktif['total_kas_qris'] ?? 0);
$kasTotal = $kasTunai + $kasQris;
$pctTunai = $kasTotal > 0 ? (int) round(($kasTunai / $kasTotal) * 100) : 0;
$pctQris  = $kasTotal > 0 ? 100 - $pctTunai : 0;

$statusClass = static function (?string $status): string {
    return match ($status) {
        'Menunggu Pembayaran' => 'st-wait',
        'Dibayar'             => 'st-paid',
        'Diproses'            => 'st-proc',
        'Siap Diambil'        => 'st-ready',
        'Selesai'             => 'st-done',
        'Dibatalkan', 'Kadaluarsa' => 'st-cancel',
        default               => 'st-done',
    };
};

$searchText = static function (array $p): string {
    $parts = [
        (string) ($p['kode_pesanan'] ?? ''),
        (string) ($p['nama_customer'] ?? ''),
        (string) ($p['nomor_meja'] ?? ''),
        (string) ($p['id_customer'] ?? ''),
        (string) ($p['status'] ?? ''),
        (string) ($p['total_bayar'] ?? ''),
    ];

    foreach (($p['items'] ?? []) as $item) {
        $parts[] = (string) ($item['nama_menu'] ?? '');
        $parts[] = (string) ($item['catatan_khusus'] ?? '');
    }

    return mb_strtolower(implode(' ', $parts));
};
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Dashboard Kasir - Kantin Merah POS</title>
<link rel="stylesheet" href="<?= base_url('assets/css/kasir-dashboard.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/kasir-sidebar.css') ?>">
<?= view('layout/typography') ?>
<script src="<?= base_url('assets/js/kasir-sidebar.js') ?>" defer></script>
</head>
<body>
<div class="layout kasir-layout">
  <?= view('kasir/_sidebar', ['activeMenu' => 'dashboard']) ?>

  <main class="main">
    <div class="topbar">
      <button type="button" class="kasir-menu-toggle" aria-label="Buka menu" aria-controls="kasirSidebar" aria-expanded="false">&#9776;</button>

      <label class="searchbox">
        <svg class="i"><use href="#i-search"/></svg>
        <input id="orderSearch" type="search" placeholder="Cari pesanan, menu, meja, atau pemesan..." autocomplete="off">
      </label>

      <div class="sp"></div>

      <span class="clock-chip" id="clock">--:--:--</span>
      <button type="button" class="icon-btn" id="themeBtn" aria-label="Ganti tema gelap/terang">
        <svg class="i"><use href="#i-moon"/></svg>
      </button>

      <button type="button" class="icon-btn bell" aria-label="Notifikasi" onclick="toast('Tidak ada notifikasi baru saat ini.')">
        <svg class="i"><use href="#i-bell"/></svg>
        <span class="bell-dot" aria-hidden="true"></span>
      </button>

      <span class="online-pill <?= $shiftAktif ? '' : 'off' ?>">
        <span class="online-dot" aria-hidden="true"></span>
        <span><?= $shiftAktif ? 'Shift aktif' : 'Shift tutup' ?></span>
      </span>
    </div>

    <div class="content" id="dashboard">
      <div class="greeting">
        <div>
          <h1>Selamat datang, <?= esc($namaKasir) ?>!</h1>
          <p>Berikut ringkasan aktivitas kantin hari ini.</p>
        </div>
        <div class="greet-actions">
          <span class="date-pill"><?= date('d/m/Y') ?></span>
          <a class="btn btn-brand" href="<?= site_url('kasir/antrean') ?>">
            <svg class="i"><use href="#i-inbox"/></svg>
            Buka Antrean Customer
          </a>
        </div>
      </div>

      <!-- Kartu statistik -->
      <div class="stats">
        <article class="stat">
          <div class="stat-ic ic-pink"><svg class="i"><use href="#i-wallet"/></svg></div>
          <small>Menunggu bayar tunai</small>
          <b><?= count($pesananTunai) ?></b>
          <span class="trend <?= count($pesananTunai) > 0 ? 'trend-amber' : 'trend-gray' ?>">
            <?= count($pesananTunai) > 0 ? 'Perlu tindakan' : 'Tidak ada antrean' ?>
          </span>
        </article>

        <article class="stat">
          <div class="stat-ic ic-green"><svg class="i"><use href="#i-bag"/></svg></div>
          <small>Siap diserahkan</small>
          <b><?= count($pesananSiap) ?></b>
          <span class="trend <?= count($pesananSiap) > 0 ? 'trend-green' : 'trend-gray' ?>">
            <?= count($pesananSiap) > 0 ? 'Siap antar' : 'Belum ada' ?>
          </span>
        </article>

        <article class="stat">
          <div class="stat-ic ic-blue"><svg class="i"><use href="#i-fire"/></svg></div>
          <small>Pesanan di dapur</small>
          <b><?= (int) $jumlahDapurAktif ?></b>
          <span class="trend <?= $jumlahDapurAktif > 0 ? 'trend-blue' : 'trend-gray' ?>">
            <?= $jumlahDapurAktif > 0 ? 'Sedang diproses' : 'Dapur kosong' ?>
          </span>
        </article>

        <article class="stat">
          <div class="stat-ic ic-purple"><svg class="i"><use href="#i-coins"/></svg></div>
          <small>Kas shift ini</small>
          <b>Rp <?= number_format($kasTotal, 0, ',', '.') ?></b>
          <span class="trend <?= $shiftAktif ? 'trend-green' : 'trend-gray' ?>">
            <?= $shiftAktif ? 'Shift berjalan' : 'Belum buka shift' ?>
          </span>
        </article>
      </div>

      <!-- Pesanan terbaru + ringkasan shift -->
      <div class="dash-grid">
        <section class="panel">
          <div class="panel-head">
            <div>
              <h2>Pesanan Terbaru</h2>
              <p class="panel-sub">Transaksi yang sudah dibayar dan diteruskan ke dapur</p>
            </div>
            <a class="link" href="<?= site_url('kasir/riwayat') ?>">Lihat Semua <svg class="i"><use href="#i-chev"/></svg></a>
          </div>

          <div class="tbl-wrap">
            <table class="orders-table">
              <thead>
                <tr>
                  <th>Antrean</th>
                  <th>Pesanan</th>
                  <th>Pemesan</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Waktu</th>
                </tr>
              </thead>
              <tbody>
              <?php if (empty($pesananBaruMasuk)): ?>
                <tr>
                  <td colspan="6">
                    <div class="table-empty">
                      <svg class="i"><use href="#i-inbox"/></svg>
                      Belum ada transaksi yang masuk ke dapur.
                    </div>
                  </td>
                </tr>
              <?php else: ?>
                <?php foreach ($pesananBaruMasuk as $p): ?>
                  <tr data-search="<?= esc($searchText($p)) ?>">
                    <td><span class="qbadge"><?= format_no_antrian($p['no_antrian'] ?? null) ?></span></td>
                    <td>
                      <div class="cell-strong"><?= esc($p['kode_pesanan']) ?></div>
                      <div class="cell-sub">Meja <?= esc($mejaShort($p['nomor_meja'] ?? '')) ?></div>
                    </td>
                    <td>
                      <div class="cell-strong"><?= esc(!empty($p['nama_customer']) ? $p['nama_customer'] : 'Pelanggan') ?></div>
                    </td>
                    <td class="num">Rp <?= number_format((float) $p['total_bayar'], 0, ',', '.') ?></td>
                    <td><span class="pill <?= $statusClass($p['status'] ?? null) ?>"><?= esc($p['status']) ?></span></td>
                    <td class="muted nowrap"><?= date('H:i', strtotime($p['waktu_pesan'])) ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
              </tbody>
            </table>
          </div>
        </section>

        <section class="panel">
          <div class="panel-head">
            <div>
              <h2>Ringkasan Shift</h2>
              <p class="panel-sub">Kas masuk pada shift ini</p>
            </div>
            <span class="pill <?= $shiftAktif ? 'st-ready' : 'st-done' ?>"><?= $shiftAktif ? 'Berjalan' : 'Tutup' ?></span>
          </div>

          <div class="shift-total">
            <small>Total kas shift</small>
            <strong>Rp <?= number_format($kasTotal, 0, ',', '.') ?></strong>
            <span>
              <?php if ($shiftAktif): ?>
                Mulai <?= date('H:i', strtotime($shiftAktif['waktu_mulai'])) ?> WIB
              <?php else: ?>
                Buka shift untuk mulai menerima pembayaran tunai.
              <?php endif; ?>
            </span>
          </div>

          <div class="shift-rows">
            <div class="shift-row">
              <span class="dot dot-cash"></span>
              <span>Tunai</span>
              <b>Rp <?= number_format($kasTunai, 0, ',', '.') ?></b>
            </div>
            <div class="shift-row">
              <span class="dot dot-qris"></span>
              <span>QRIS</span>
              <b>Rp <?= number_format($kasQris, 0, ',', '.') ?></b>
            </div>
          </div>

          <div class="split-bar" aria-hidden="true">
            <span class="split-cash" style="width:<?= $pctTunai ?>%"></span>
            <span class="split-qris" style="width:<?= $pctQris ?>%"></span>
          </div>
          <div class="split-legend">
            <span>Tunai <?= $pctTunai ?>%</span>
            <span>QRIS <?= $pctQris ?>%</span>
          </div>

          <?php if ($shiftAktif): ?>
            <button type="button" class="btn btn-dark btn-block" onclick="tutupShift(<?= esc($shiftAktif['id_shift']) ?>, this)">
              Tutup shift
            </button>
          <?php else: ?>
            <button type="button" class="btn btn-brand btn-block" onclick="bukaShift(this)">
              Buka shift sekarang
            </button>
          <?php endif; ?>

          <a class="shift-manage" href="<?= site_url('kasir/shift') ?>">
            Kelola shift kasir <svg class="i"><use href="#i-chev"/></svg>
          </a>
        </section>
      </div>

    </div>

    <footer class="app-footer">
      Kantin Merah POS &middot; Point of Sale &amp; Kitchen Display System
    </footer>
  </main>
</div>

<dialog id="dlg">
  <h4 id="dlgTitle"></h4>
  <p id="dlgMsg"></p>
  <div class="row">
    <button type="button" class="btn btn-plain" id="dlgNo">Batal</button>
    <button type="button" class="btn btn-brand" id="dlgYes">Ya</button>
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
    if (!tema) tema = 'light';
    document.documentElement.dataset.theme = tema;
    document.getElementById('themeBtn').onclick = () => {
        const baru = document.documentElement.dataset.theme === 'dark' ? 'light' : 'dark';
        document.documentElement.dataset.theme = baru;
        try { localStorage.setItem('tema', baru); } catch (e) {}
    };
})();

/* ---------- Logika aksi kasir ---------- */
async function bacaJson(res) {
    let data = null;
    try { data = await res.json(); } catch (e) { data = null; }
    if (!res.ok) throw new Error((data && data.message) ? data.message : 'Server mengembalikan HTTP ' + res.status + '.');
    if (!data) throw new Error('Respons server tidak valid. Pastikan sesi login Anda masih aktif.');
    return data;
}

async function kirim(btn, fn) {
    if (btn) btn.disabled = true;
    try { await fn(); } catch (e) { toast(e.message, true); if (btn) btn.disabled = false; }
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

/* ---------- Pencarian tampilan ---------- */
(function () {
    const input = document.getElementById('orderSearch');
    if (!input) return;

    input.addEventListener('input', function () {
        const q = this.value.toLowerCase().trim();

        document.querySelectorAll('[data-search]').forEach(function (el) {
            const hay = (el.getAttribute('data-search') || '').toLowerCase();
            el.style.display = (!q || hay.includes(q)) ? '' : 'none';
        });
    });
})();
</script>
</body>
</html>
