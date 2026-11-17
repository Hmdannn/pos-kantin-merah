<?php
$activeMenu = $activeMenu ?? 'dashboard';
$namaManager = (string) (session()->get('nama') ?? 'Manajerial');
$inisialManager = strtoupper(function_exists('mb_substr')
    ? mb_substr($namaManager, 0, 1)
    : substr($namaManager, 0, 1));

$menuManajerial = [
    [
        'key'   => 'dashboard',
        'label' => 'Dashboard',
        'href'  => site_url('manajerial'),
        'icon'  => 'i-grid',
    ],
    [
        'key'   => 'laporan',
        'label' => 'Laporan',
        'href'  => site_url('manajerial/laporan'),
        'icon'  => 'i-receipt',
    ],
    [
        'key'   => 'menu',
        'label' => 'Kelola Menu & Kategori',
        'href'  => site_url('menu'),
        'icon'  => 'i-bowl',
    ],
];
?>
<?= view('kasir/_icons') ?>

<aside class="kasir-sidebar managerial-sidebar" id="managerialSidebar" aria-label="Navigasi manajerial" aria-hidden="false">
    <button type="button" class="managerial-menu-close" aria-label="Tutup menu navigasi">
        <span aria-hidden="true">&times;</span>
    </button>

    <a class="kasir-brand" href="<?= site_url('manajerial') ?>">
        <span class="kasir-brand-mark" aria-hidden="true">
            <svg class="i"><use href="#i-bowl"/></svg>
        </span>
        <span class="kasir-brand-text">
            <strong>Kantin Merah</strong>
            <small>Point of Sale</small>
        </span>
    </a>

    <div class="kasir-nav-label">Menu manajerial</div>
    <nav class="kasir-nav" aria-label="Menu manajerial">
        <?php foreach ($menuManajerial as $item): ?>
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
            <span class="kasir-avatar"><?= esc($inisialManager !== '' ? $inisialManager : 'M') ?></span>
            <span class="kasir-op-meta">
                <strong><?= esc($namaManager) ?></strong>
                <small>Manajerial</small>
            </span>
            <a class="kasir-logout" href="<?= site_url('logout') ?>" title="Keluar" aria-label="Keluar">
                <svg class="i" aria-hidden="true"><use href="#i-logout"/></svg>
            </a>
        </div>
        <div class="kasir-sidebar-note">Kantin Merah POS &middot; UNP Kampus 1</div>
    </div>
</aside>
<button type="button" class="kasir-nav-backdrop managerial-nav-backdrop" aria-label="Tutup menu" aria-hidden="true" tabindex="-1"></button>
