<?php
$namaKasir = (string) (session()->get('nama') ?? 'Kasir');

$mejaShort = static function ($value): string {
    $value = trim((string) $value);
    if ($value === '') {
        return '—';
    }

    return preg_replace('/^meja\s+/i', '', $value) ?: $value;
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

$totalAntrean = count($pesananTunai) + count($pesananSiap);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Antrean Customer - Kantin Merah POS</title>
<link rel="stylesheet" href="<?= base_url('assets/css/kasir-dashboard.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/kasir-sidebar.css') ?>">
<?= view('layout/typography') ?>
<script src="<?= base_url('assets/js/kasir-sidebar.js') ?>" defer></script>
</head>
<body>
<div class="layout kasir-layout">
  <?= view('kasir/_sidebar', ['activeMenu' => 'antrean']) ?>

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

    <div class="content">
      <div class="greeting">
        <div>
          <h1>Antrean Customer</h1>
          <p>Halo, <?= esc($namaKasir) ?> — konfirmasi pembayaran tunai dan serahkan pesanan yang siap.</p>
        </div>
        <div class="greet-actions">
          <span class="date-pill"><?= date('d/m/Y') ?></span>
          <a class="btn btn-plain" href="<?= site_url('kasir') ?>">Ringkasan</a>
        </div>
      </div>

      <?php if (!$shiftAktif): ?>
        <div class="alert-shift">
          <svg class="i"><use href="#i-clock"/></svg>
          <span>Shift belum dibuka. Pembayaran tunai tidak bisa diproses sebelum shift aktif.</span>
          <a class="btn btn-brand" href="<?= site_url('kasir') ?>">Buka shift di dashboard</a>
        </div>
      <?php endif; ?>

      <section class="section">
        <div class="section-head">
          <div>
            <h2>Menunggu pembayaran tunai <span class="count-pill"><?= count($pesananTunai) ?></span></h2>
            <p>Konfirmasi uang yang diterima, lalu pesanan otomatis diteruskan ke dapur.</p>
          </div>
        </div>

        <?php if (empty($pesananTunai)): ?>
          <div class="empty-card">
            <svg class="i"><use href="#i-inbox"/></svg>
            Tidak ada pesanan yang menunggu pembayaran tunai.
          </div>
        <?php else: ?>
          <div class="order-grid">
            <?php foreach ($pesananTunai as $p): ?>
              <?php $id = (int) $p['id_pesanan']; ?>
              <article class="order-card" data-search="<?= esc($searchText($p)) ?>">
                <div class="order-head">
                  <span class="qbadge"><?= format_no_antrian($p['no_antrian'] ?? null) ?></span>
                  <div class="order-head-main">
                    <div class="cell-strong"><?= esc($p['kode_pesanan']) ?></div>
                    <?php if (!empty($p['pembayaran']['batas_waktu'])): ?>
                      <span class="deadline">Bayar sebelum <?= date('H:i', strtotime($p['pembayaran']['batas_waktu'])) ?> WIB</span>
                    <?php endif; ?>
                  </div>
                  <span class="order-time"><?= date('H:i', strtotime($p['waktu_pesan'])) ?> WIB</span>
                </div>

                <div class="dest">
                  <div>
                    <small><svg class="i"><use href="#i-table"/></svg>Meja</small>
                    <b><?= esc($mejaShort($p['nomor_meja'] ?? '')) ?></b>
                  </div>
                  <div>
                    <small><svg class="i"><use href="#i-user"/></svg>Pemesan</small>
                    <b><?= esc(!empty($p['nama_customer']) ? $p['nama_customer'] : 'Pelanggan') ?></b>
                  </div>
                </div>

                <ul class="items">
                  <?php foreach ($p['items'] as $item): ?>
                    <li>
                      <div>
                        <span class="qty"><?= esc($item['jumlah']) ?>x</span><?= esc($item['nama_menu']) ?>
                        <?php if (!empty($item['catatan_khusus'])): ?>
                          <span class="note">Catatan: <?= esc($item['catatan_khusus']) ?></span>
                        <?php endif; ?>
                      </div>
                      <span class="item-price">Rp <?= number_format((float) $item['subtotal'], 0, ',', '.') ?></span>
                    </li>
                  <?php endforeach; ?>
                </ul>

                <div class="total">
                  <span>Total tagihan</span>
                  <b id="total-val-<?= $id ?>" data-total="<?= $p['total_bayar'] ?>">Rp <?= number_format((float) $p['total_bayar'], 0, ',', '.') ?></b>
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
                  <button type="button" class="btn btn-ok" onclick="prosesBayar(<?= $id ?>, this)">
                    <svg class="i"><use href="#i-check"/></svg>Konfirmasi bayar
                  </button>
                  <button type="button" class="btn btn-ghost" onclick="batalkanPesanan(<?= $id ?>, this)">Batalkan</button>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </section>

      <section class="section">
        <div class="section-head">
          <div>
            <h2>Siap diantar ke pembeli <span class="count-pill"><?= count($pesananSiap) ?></span></h2>
            <p>Dapur sudah selesai memasak. Antar pesanan lalu tandai selesai.</p>
          </div>
        </div>

        <?php if (empty($pesananSiap)): ?>
          <div class="empty-card">
            <svg class="i"><use href="#i-bag"/></svg>
            Belum ada pesanan yang siap diantar.
          </div>
        <?php else: ?>
          <div class="order-grid">
            <?php foreach ($pesananSiap as $p): ?>
              <?php $mejaRaw = trim((string) ($p['nomor_meja'] ?? '')); ?>
              <article class="order-card ready" data-search="<?= esc($searchText($p)) ?>">
                <div class="order-head">
                  <span class="qbadge"><?= format_no_antrian($p['no_antrian'] ?? null) ?></span>
                  <div class="order-head-main">
                    <div class="cell-strong"><?= esc($p['kode_pesanan']) ?></div>
                    <span class="cell-sub"><?= date('H:i', strtotime($p['waktu_pesan'])) ?> WIB</span>
                  </div>
                  <span class="pill st-ready">Siap diantar</span>
                </div>

                <div class="dest">
                  <div>
                    <small><svg class="i"><use href="#i-table"/></svg>Antar ke</small>
                    <b><?= esc($mejaShort($mejaRaw)) ?></b>
                  </div>
                  <div>
                    <small><svg class="i"><use href="#i-user"/></svg>Pemesan</small>
                    <b><?= esc(!empty($p['nama_customer']) ? $p['nama_customer'] : 'Pelanggan') ?></b>
                  </div>
                </div>

                <ul class="items">
                  <?php foreach ($p['items'] as $item): ?>
                    <li>
                      <div>
                        <span class="qty"><?= esc($item['jumlah']) ?>x</span><?= esc($item['nama_menu']) ?>
                        <?php if (!empty($item['catatan_khusus'])): ?>
                          <span class="note">Catatan: <?= esc($item['catatan_khusus']) ?></span>
                        <?php endif; ?>
                      </div>
                    </li>
                  <?php endforeach; ?>
                </ul>

                <button type="button" class="btn btn-info btn-block" onclick="tandaiSelesai(<?= (int) $p['id_pesanan'] ?>, this)">
                  <svg class="i"><use href="#i-send"/></svg>
                  Antar ke <?= esc($mejaRaw !== '' ? $mejaRaw : 'customer') ?> &amp; selesai
                </button>
              </article>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </section>

      <p class="antrean-total">Total antrean aktif: <b><?= $totalAntrean ?></b> pesanan</p>
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

/* Jam, tema */
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
