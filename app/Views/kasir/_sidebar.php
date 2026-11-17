<?php
$activeMenu = $activeMenu ?? '';
$namaKasir = (string) (session()->get('nama') ?? 'Kasir');
$inisialKasir = strtoupper(function_exists('mb_substr')
    ? mb_substr($namaKasir, 0, 1)
    : substr($namaKasir, 0, 1));

$menuKasir = [
    [
        'key'   => 'dashboard',
        'label' => 'Dashboard',
        'href'  => site_url('kasir'),
        'icon'  => 'i-grid',
    ],
    [
        'key'   => 'antrean',
        'label' => 'Antrean Customer',
        'href'  => site_url('kasir/antrean'),
        'icon'  => 'i-inbox',
    ],
    [
        'key'   => 'riwayat',
        'label' => 'Riwayat Transaksi',
        'href'  => site_url('kasir/riwayat'),
        'icon'  => 'i-receipt',
    ],
];
?>
<?= view('kasir/_icons') ?>

<aside class="kasir-sidebar" id="kasirSidebar" aria-label="Navigasi kasir">
    <a class="kasir-brand" href="<?= site_url('kasir') ?>">
        <span class="kasir-brand-mark" aria-hidden="true">
            <svg class="i"><use href="#i-bowl"/></svg>
        </span>
        <span class="kasir-brand-text">
            <strong>Kantin Merah</strong>
            <small>Point of Sale</small>
        </span>
    </a>

    <div class="kasir-nav-label">Menu kasir</div>
    <nav class="kasir-nav" aria-label="Menu kasir">
        <?php foreach ($menuKasir as $item): ?>
            <?php $aktif = $activeMenu === $item['key']; ?>
            <a class="kasir-nav-link<?= $aktif ? ' active' : '' ?>"
               href="<?= $item['href'] ?>"
               <?= $aktif ? 'aria-current="page"' : '' ?>>
                <svg class="i" aria-hidden="true"><use href="#<?= $item['icon'] ?>"/></svg>
                <span><?= esc($item['label']) ?></span>
            </a>
        <?php endforeach; ?>
    </nav>

    <div class="kasir-sidebar-bottom">
        <div class="kasir-operator">
            <span class="kasir-avatar"><?= esc($inisialKasir !== '' ? $inisialKasir : 'K') ?></span>
            <span class="kasir-op-meta">
                <strong><?= esc($namaKasir) ?></strong>
                <small>Kasir</small>
            </span>
            <a class="kasir-logout" href="<?= site_url('logout') ?>" title="Keluar" aria-label="Keluar">
                <svg class="i" aria-hidden="true"><use href="#i-logout"/></svg>
            </a>
        </div>
        <div class="kasir-sidebar-note">Kantin Merah POS &middot; UNP Kampus 1</div>
    </div>
</aside>
<button type="button" class="kasir-nav-backdrop" id="kasirNavBackdrop" aria-label="Tutup menu"></button>
