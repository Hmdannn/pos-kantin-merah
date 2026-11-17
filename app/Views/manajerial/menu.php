<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu & Kategori - Kantin Merah POS</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/kasir-sidebar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/kasir-ui.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/managerial-ui.css') ?>">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-primary); background: #f8fafc; color: #1e293b; }
        .layout { display: flex; min-height: 100vh; }
        .main { flex: 1; display: flex; flex-direction: column; min-width: 0; }
        .topbar { background: white; padding: 18px 28px; display: flex; justify-content: space-between; align-items: center; gap: 16px; border-bottom: 1px solid #e2e8f0; flex-wrap: wrap; }
        .topbar h1 { font-size: 20px; font-weight: 700; color: #0f172a; }
        .topbar-sub { font-size: 13px; color: #64748b; margin-top: 3px; }
        .topbar-actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
        .user-pill { background: #ffe4e6; color: #9f1239; padding: 6px 14px; border-radius: 9999px; font-size: 13px; font-weight: 600; }
        .content { padding: 26px 28px 60px; }

        /* Buttons */
        .btn { border: none; border-radius: 8px; padding: 9px 14px; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px; transition: 0.15s; }
        .btn-primary { background: #9f1239; color: white; }
        .btn-primary:hover { background: #881337; }
        .btn-light { background: white; color: #334155; border: 1px solid #cbd5e1; }
        .btn-light:hover { background: #f8fafc; }
        .btn-mini { padding: 6px 9px; font-size: 12px; border-radius: 6px; }
        .btn-danger { background: #fee2e2; color: #b91c1c; }
        .btn-danger:hover { background: #fecaca; }
        .btn-success { background: #dcfce7; color: #166534; }
        .btn-success:hover { background: #bbf7d0; }
        .btn:disabled { opacity: 0.55; cursor: not-allowed; }
        .icon-btn { border: 1px solid #e2e8f0; background: white; border-radius: 7px; width: 30px; height: 30px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; font-size: 13px; }
        .icon-btn:hover { background: #f8fafc; border-color: #cbd5e1; }
        .icon-btn.danger:hover { background: #fef2f2; border-color: #fecaca; }

        /* Stats */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
        @media (max-width: 1024px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 560px) { .stats-grid { grid-template-columns: 1fr; } }
        .stat-card { background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 18px 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.03); }
        .stat-label { font-size: 11px; color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 7px; }
        .stat-value { font-size: 26px; font-weight: 800; color: #0f172a; }
        .stat-value.green { color: #15803d; }
        .stat-value.red { color: #b91c1c; }

        /* Panels */
        .panel { background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.03); margin-bottom: 22px; }
        .panel-head { display: flex; justify-content: space-between; align-items: flex-start; gap: 14px; margin-bottom: 16px; flex-wrap: wrap; }
        .panel-head h2 { font-size: 16px; font-weight: 700; color: #0f172a; }
        .panel-head p { font-size: 12px; color: #64748b; margin-top: 3px; }

        /* Categories */
        .kategori-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(210px, 1fr)); gap: 12px; }
        .kategori-card { border: 1px solid #e2e8f0; border-radius: 10px; padding: 13px 14px; display: flex; align-items: center; justify-content: space-between; gap: 10px; background: #fff; }
        .kategori-nama { font-size: 14px; font-weight: 700; color: #1e293b; overflow-wrap: anywhere; }
        .kategori-count { font-size: 12px; color: #64748b; margin-top: 3px; }
        .kategori-actions { display: flex; gap: 5px; flex-shrink: 0; }

        /* Toolbar */
        .toolbar { display: flex; gap: 10px; margin-bottom: 14px; flex-wrap: wrap; }
        .toolbar input, .toolbar select { border: 1px solid #cbd5e1; border-radius: 8px; padding: 9px 11px; font-size: 13px; font-family: inherit; color: #1e293b; background: white; }
        .toolbar input { flex: 1; min-width: 200px; }
        .toolbar input:focus, .toolbar select:focus { outline: 2px solid #fecdd3; border-color: #f43f5e; }

        /* Table */
        .table-wrap { overflow-x: auto; border: 1px solid #f1f5f9; border-radius: 10px; }
        table { width: 100%; border-collapse: collapse; font-size: 13px; min-width: 760px; }
        th { text-align: center !important; padding: 11px 12px; color: #64748b; font-weight: 700; border-bottom: 1px solid #e2e8f0; font-size: 11px; text-transform: uppercase; letter-spacing: 0.4px; background: #f8fafc; }
        td { padding: 11px 12px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; text-align: center !important; }
        tr:last-child td { border-bottom: none; }
        .menu-name-cell { justify-content: center; }
        .menu-pagination { display: none; margin-top: 14px; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
        .menu-pagination-meta { font-size: 13px; color: #64748b; }
        .menu-pagination-controls { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
        .menu-pagination-btn { border: 1px solid #cbd5e1; background: #fff; color: #334155; border-radius: 8px; padding: 7px 12px; font-size: 13px; font-weight: 600; cursor: pointer; }
        .menu-pagination-btn:disabled { opacity: 0.5; cursor: not-allowed; }
        .menu-page-jump { display: inline-flex; align-items: center; gap: 6px; font-size: 13px; color: #475569; }
        .menu-page-jump input { width: 72px; border: 1px solid #cbd5e1; border-radius: 8px; padding: 6px 8px; font-size: 13px; }
        .menu-thumb { width: 64px; aspect-ratio: 4 / 3; height: auto; object-fit: cover; border-radius: 7px; background: #f1f5f9; display: block; }
        .thumb-empty { width: 64px; aspect-ratio: 4 / 3; height: auto; border-radius: 7px; background: #f1f5f9; color: #94a3b8; display: flex; align-items: center; justify-content: center; font-size: 10px; text-align: center; }
        .menu-name-cell { font-weight: 700; color: #0f172a; margin-bottom: 4px; overflow-wrap: anywhere; }
        .status-badge { display: inline-block; font-size: 10px; font-weight: 800; padding: 3px 7px; border-radius: 999px; text-transform: uppercase; letter-spacing: 0.3px; }
        .status-badge.tersedia { background: #dcfce7; color: #166534; }
        .status-badge.habis { background: #fee2e2; color: #b91c1c; }
        .harga-cell { font-weight: 700; color: #9f1239; white-space: nowrap; text-align: center !important; }
        .stok-cell { font-weight: 700; text-align: center !important; }
        .stok-cell.habis { color: #b91c1c; }
        .row-actions { display: flex; gap: 5px; flex-wrap: wrap; justify-content: center; width: 100%; }
        .empty { text-align: center; padding: 34px 18px; color: #64748b; font-size: 13px; background: #f8fafc; border-radius: 10px; }

        /* Modal */
        .modal { display: none; position: fixed; inset: 0; z-index: 1200; background: rgba(15, 23, 42, 0.55); padding: 20px; overflow-y: auto; }
        .modal.open { display: block; }
        .modal-card { max-width: 620px; margin: 34px auto; background: white; border-radius: 14px; box-shadow: 0 24px 60px rgba(0,0,0,0.25); overflow: hidden; }
        .modal-head { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-bottom: 1px solid #e2e8f0; }
        .modal-head h3 { font-size: 17px; font-weight: 700; }
        .modal-close { border: none; background: none; font-size: 25px; line-height: 1; color: #64748b; cursor: pointer; }
        .modal-close:hover { color: #0f172a; }
        .modal-body { padding: 20px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .field { display: flex; flex-direction: column; gap: 6px; font-size: 12px; font-weight: 700; color: #475569; }
        .field.full { grid-column: 1 / -1; }
        .field input, .field select { border: 1px solid #cbd5e1; border-radius: 8px; padding: 10px 11px; font-size: 14px; font-family: inherit; color: #1e293b; font-weight: 400; background: white; }
        .field input:focus, .field select:focus { outline: 2px solid #fecdd3; border-color: #f43f5e; }
        .field-hint { font-size: 11px; color: #94a3b8; font-weight: 400; }
        .checkbox-field { display: flex; align-items: center; gap: 8px; font-size: 12px; color: #475569; font-weight: 600; }
        .checkbox-field input { width: auto; accent-color: #9f1239; }
        .foto-preview { margin-top: 14px; border: 1px dashed #cbd5e1; border-radius: 10px; padding: 10px; background: #f8fafc; }
        .foto-preview img { display: block; width: 100%; aspect-ratio: 4 / 3; height: auto; max-height: none; border-radius: 8px; margin: auto; object-fit: contain; background: #ffffff; }
        .form-error { margin-top: 14px; background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; border-radius: 8px; padding: 10px 12px; font-size: 13px; }
        .modal-actions { display: flex; justify-content: flex-end; gap: 9px; margin-top: 18px; padding-top: 14px; border-top: 1px solid #e2e8f0; }
        @media (max-width: 560px) { .form-grid { grid-template-columns: 1fr; } }

        /* Toast */
        .toast { display: none; position: fixed; right: 18px; bottom: 18px; z-index: 1500; max-width: 360px; background: #166534; color: white; border-radius: 10px; padding: 13px 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.22); font-size: 13px; font-weight: 600; }
        .toast.error { background: #b91c1c; }
        .toast.show { display: block; }

        @media (max-width: 560px) {
            .topbar { align-items: flex-start; padding: 16px; }
            .topbar-actions { width: 100%; align-items: stretch; }
            .topbar-actions .btn { flex: 1 1 100%; min-height: 44px; }
            .content { padding: 14px 12px 34px; }
            .panel { padding: 15px; }
            .toolbar input, .toolbar select { min-width: 0; width: 100%; min-height: 44px; }
            .modal { padding: 8px; }
            .toast { right: 12px; bottom: 12px; left: 12px; max-width: none; }
        }
    </style>
    <?= view('layout/typography') ?>
    <script src="<?= base_url('assets/js/managerial-drawer.js') ?>" defer></script>
</head>
<body>
<div class="layout kasir-layout managerial-layout">
    <?= view('manajerial/_sidebar', ['activeMenu' => 'menu']) ?>

    <main class="main">
        <header class="topbar">
            <div class="managerial-heading" style="display:flex;align-items:center;gap:12px;">
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
                    <h1>Kelola Menu & Kategori</h1>
                    <p class="topbar-sub">Tambah, ubah, atur harga, stok, foto, dan ketersediaan menu.</p>
                </div>
            </div>
            <div class="topbar-actions">
                <a href="<?= site_url('customer') ?>" target="_blank" rel="noopener" class="btn btn-light">Lihat Halaman Customer</a>
                <div class="user-pill">Role: Manajerial</div>
            </div>
        </header>

        <div class="content">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Menu</div>
                    <div class="stat-value" id="statTotalMenu">0</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Tersedia</div>
                    <div class="stat-value green" id="statTersedia">0</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Habis</div>
                    <div class="stat-value red" id="statHabis">0</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Kategori</div>
                    <div class="stat-value" id="statKategori">0</div>
                </div>
            </div>

            <section class="panel">
                <div class="panel-head">
                    <div>
                        <h2>Kategori Menu</h2>
                    </div>
                    <button type="button" class="btn btn-primary" id="btnTambahKategori">+ Tambah Kategori</button>
                </div>

                <div class="kategori-grid" id="kategoriGrid"></div>
                <div class="empty" id="kategoriEmpty" style="display: none;">Belum ada kategori. Tambahkan kategori terlebih dahulu.</div>
            </section>

            <section class="panel">
                <div class="panel-head">
                    <div>
                        <h2>Daftar Menu</h2>
                        <p>Menu yang berstatus Tersedia dan memiliki stok akan bisa dipesan customer.</p>
                    </div>
                    <button type="button" class="btn btn-primary" id="btnTambahMenu">+ Tambah Menu</button>
                </div>

                <div class="toolbar">
                    <input type="search" id="searchMenu" placeholder="Cari nama menu...">
                    <select id="filterKategori">
                        <option value="all">Semua kategori</option>
                    </select>
                    <select id="filterStatus">
                        <option value="all">Semua status</option>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Habis">Habis</option>
                    </select>
                </div>

                <div class="table-wrap" id="menuTableWrap">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 88px;">Foto</th>
                                <th>Menu</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="menuTbody"></tbody>
                    </table>
                </div>
                <div class="empty" id="menuEmpty" style="display: none;">Tidak ada menu yang cocok dengan pencarian.</div>
                <div class="menu-pagination" id="menuPagination" aria-label="Navigasi daftar menu">
                    <div class="menu-pagination-meta" id="menuPaginationMeta"></div>
                    <div class="menu-pagination-controls">
                        <button type="button" class="menu-pagination-btn" id="prevMenuPage">Previous</button>
                        <span id="menuPageInfo" style="font-size:13px;color:#334155;font-weight:600;">1 / 1</span>
                        <button type="button" class="menu-pagination-btn" id="nextMenuPage">Next</button>
                        <label class="menu-page-jump" for="menuPageInput">Go
                            <input type="number" id="menuPageInput" min="1" value="1">
                        </label>
                        <button type="button" class="menu-pagination-btn" id="goMenuPage">Go</button>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>

<div class="modal" id="menuModal">
    <div class="modal-card">
        <div class="modal-head">
            <h3 id="menuModalTitle">Tambah Menu</h3>
            <button type="button" class="modal-close" id="closeMenuModal" aria-label="Tutup">&times;</button>
        </div>
        <form id="menuForm">
            <div class="modal-body">
                <input type="hidden" id="menuId" name="id_menu" value="">

                <div class="form-grid">
                    <label class="field full">
                        Nama Menu
                        <input type="text" id="menuNama" name="nama_menu" maxlength="100" placeholder="Contoh: Nasi Goreng Spesial" required>
                    </label>

                    <label class="field">
                        Kategori
                        <select id="menuKategori" name="id_kategori" required></select>
                    </label>

                    <label class="field">
                        Harga (Rp)
                        <input type="number" id="menuHarga" name="harga" min="0" step="any" placeholder="15000" required>
                    </label>

                    <label class="field">
                        Jumlah Stok
                        <input type="number" id="menuStok" name="jumlah_stok" min="0" step="1" placeholder="20" required>
                    </label>

                    <label class="field">
                        Status Ketersediaan
                        <select id="menuStatus" name="status_stok">
                            <option value="Tersedia">Tersedia</option>
                            <option value="Habis">Habis</option>
                        </select>
                    </label>

                    <label class="field full">
                        Upload Foto <span class="field-hint">JPG, PNG, atau WEBP. Maksimal 2 MB.</span>
                        <input type="file" id="menuFotoFile" name="foto_file" accept="image/jpeg,image/png,image/webp">
                    </label>

                    <label class="field full">
                        Atau URL Foto <span class="field-hint">Kosongkan jika tidak ingin mengganti foto.</span>
                        <input type="url" id="menuFotoUrl" name="foto_url" placeholder="https://contoh.com/foto-menu.jpg">
                    </label>

                    <label class="checkbox-field full" id="hapusFotoWrap" style="display: none;">
                        <input type="checkbox" id="menuHapusFoto" name="hapus_foto" value="1">
                        Hapus foto saat ini
                    </label>
                </div>

                <div class="foto-preview" id="fotoPreviewWrap" style="display: none;">
                    <img id="fotoPreview" src="" alt="Pratinjau foto menu">
                </div>

                <div class="form-error" id="menuFormError" style="display: none;"></div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-light" id="batalMenu">Batal</button>
                    <button type="submit" class="btn btn-primary" id="simpanMenu">Simpan Menu</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="kategoriModal">
    <div class="modal-card" style="max-width: 430px;">
        <div class="modal-head">
            <h3 id="kategoriModalTitle">Tambah Kategori</h3>
            <button type="button" class="modal-close" id="closeKategoriModal" aria-label="Tutup">&times;</button>
        </div>
        <form id="kategoriForm">
            <div class="modal-body">
                <input type="hidden" id="kategoriId" name="id_kategori" value="">

                <label class="field">
                    Nama Kategori
                    <input type="text" id="kategoriNama" name="nama_kategori" maxlength="100" placeholder="Contoh: Makanan Berat" required>
                </label>

                <div class="form-error" id="kategoriFormError" style="display: none;"></div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-light" id="batalKategori">Batal</button>
                    <button type="submit" class="btn btn-primary" id="simpanKategori">Simpan Kategori</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="toast" id="toast" role="status" aria-live="polite"></div>

<script>
    const MENU_API = <?= json_encode(site_url('menu')) ?>;
    const KATEGORI_API = <?= json_encode(site_url('kategori')) ?>;

    let menuData = <?= json_encode($menu, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
    let kategoriData = <?= json_encode($kategori, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
    const MENU_PAGE_SIZE = 5;
    let menuPage = 1;

    const menuModal = document.getElementById('menuModal');
    const kategoriModal = document.getElementById('kategoriModal');
    const menuForm = document.getElementById('menuForm');
    const kategoriForm = document.getElementById('kategoriForm');
    const menuFormError = document.getElementById('menuFormError');
    const kategoriFormError = document.getElementById('kategoriFormError');
    const fotoPreview = document.getElementById('fotoPreview');
    const fotoPreviewWrap = document.getElementById('fotoPreviewWrap');
    const hapusFotoWrap = document.getElementById('hapusFotoWrap');

    let fotoObjectUrl = null;
    let fotoTersimpan = null;

    function formatRupiah(value) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(Number(value || 0));
    }

    function escapeHtml(value) {
        const div = document.createElement('div');
        div.textContent = value ?? '';
        return div.innerHTML;
    }

    function showToast(message, isError = false) {
        const toast = document.getElementById('toast');
        toast.textContent = message;
        toast.classList.toggle('error', isError);
        toast.classList.add('show');

        clearTimeout(showToast.timer);
        showToast.timer = setTimeout(function () {
            toast.classList.remove('show');
        }, 4200);
    }

    async function fetchJson(url, options = {}) {
        const response = await fetch(url, options);
        let result = null;

        try {
            result = await response.json();
        } catch (error) {
            result = null;
        }

        if (!response.ok || !result || result.status === false) {
            const pesan = (result && result.message)
                ? result.message
                : 'Terjadi kesalahan pada server (HTTP ' + response.status + ').';

            const err = new Error(pesan);
            err.payload = result;
            err.status = response.status;
            throw err;
        }

        return result;
    }

    function renderStats() {
        const total = menuData.length;
        const tersedia = menuData.filter(function (item) {
            return item.status_stok === 'Tersedia' && Number(item.jumlah_stok) > 0;
        }).length;
        const habis = total - tersedia;

        document.getElementById('statTotalMenu').textContent = total;
        document.getElementById('statTersedia').textContent = tersedia;
        document.getElementById('statHabis').textContent = habis;
        document.getElementById('statKategori').textContent = kategoriData.length;
    }

    function renderKategori() {
        const grid = document.getElementById('kategoriGrid');
        const empty = document.getElementById('kategoriEmpty');

        if (kategoriData.length === 0) {
            grid.innerHTML = '';
            grid.style.display = 'none';
            empty.style.display = 'block';
        } else {
            empty.style.display = 'none';
            grid.style.display = 'grid';

            grid.innerHTML = kategoriData.map(function (kategori) {
                const id = Number(kategori.id_kategori);
                const jumlah = Number(kategori.jumlah_menu || 0);

                return `
                    <div class="kategori-card">
                        <div>
                            <div class="kategori-nama">${escapeHtml(kategori.nama_kategori)}</div>
                            <div class="kategori-count">${jumlah} menu</div>
                        </div>
                        <div class="kategori-actions">
                            <button type="button" class="icon-btn" data-edit-kategori="${id}" title="Ubah kategori">✏️</button>
                            <button type="button" class="icon-btn danger" data-hapus-kategori="${id}" title="Hapus kategori">🗑️</button>
                        </div>
                    </div>
                `;
            }).join('');
        }

        isiPilihanKategori();
    }

    function isiPilihanKategori() {
        const filter = document.getElementById('filterKategori');
        const pilih = document.getElementById('menuKategori');
        const filterTerpilih = filter.value || 'all';
        const pilihTerpilih = pilih.value;

        filter.innerHTML = '<option value="all">Semua kategori</option>' + kategoriData.map(function (kategori) {
            return `<option value="${Number(kategori.id_kategori)}">${escapeHtml(kategori.nama_kategori)}</option>`;
        }).join('');

        pilih.innerHTML = kategoriData.map(function (kategori) {
            return `<option value="${Number(kategori.id_kategori)}">${escapeHtml(kategori.nama_kategori)}</option>`;
        }).join('');

        filter.value = filterTerpilih;
        if (filter.value !== filterTerpilih) {
            filter.value = 'all';
        }

        if (pilihTerpilih) {
            pilih.value = pilihTerpilih;
        }
    }

    function menuTersaring() {
        const kataKunci = document.getElementById('searchMenu').value.trim().toLowerCase();
        const kategori = document.getElementById('filterKategori').value;
        const status = document.getElementById('filterStatus').value;

        return menuData.filter(function (item) {
            const nama = String(item.nama_menu || '').toLowerCase();

            if (kataKunci !== '' && !nama.includes(kataKunci)) {
                return false;
            }

            if (kategori !== 'all' && String(item.id_kategori) !== String(kategori)) {
                return false;
            }

            if (status === 'Tersedia') {
                return item.status_stok === 'Tersedia' && Number(item.jumlah_stok) > 0;
            }

            if (status === 'Habis') {
                return item.status_stok !== 'Tersedia' || Number(item.jumlah_stok) <= 0;
            }

            return true;
        });
    }

    function renderMenu() {
        const tbody = document.getElementById('menuTbody');
        const wrap = document.getElementById('menuTableWrap');
        const empty = document.getElementById('menuEmpty');
        const pagination = document.getElementById('menuPagination');
        const daftar = menuTersaring();

        if (daftar.length === 0) {
            tbody.innerHTML = '';
            wrap.style.display = 'none';
            empty.style.display = 'block';
            pagination.style.display = 'none';
            menuPage = 1;
            renderStats();
            return;
        }

        const totalPages = Math.max(1, Math.ceil(daftar.length / MENU_PAGE_SIZE));
        menuPage = Math.max(1, Math.min(menuPage, totalPages));
        const startIndex = (menuPage - 1) * MENU_PAGE_SIZE;
        const daftarHalaman = daftar.slice(startIndex, startIndex + MENU_PAGE_SIZE);
        const endIndex = Math.min(startIndex + daftarHalaman.length, daftar.length);

        wrap.style.display = 'block';
        empty.style.display = 'none';
        pagination.style.display = 'flex';
        document.getElementById('menuPaginationMeta').textContent =
            'Menampilkan ' + (startIndex + 1) + '–' + endIndex + ' dari ' + daftar.length + ' menu';
        document.getElementById('menuPageInfo').textContent = menuPage + ' / ' + totalPages;
        document.getElementById('menuPageInput').min = 1;
        document.getElementById('menuPageInput').max = totalPages;
        document.getElementById('menuPageInput').value = menuPage;
        document.getElementById('prevMenuPage').disabled = menuPage <= 1;
        document.getElementById('nextMenuPage').disabled = menuPage >= totalPages;

        tbody.innerHTML = daftarHalaman.map(function (item) {
            const id = Number(item.id_menu);
            const stok = Number(item.jumlah_stok || 0);
            const tersedia = item.status_stok === 'Tersedia' && stok > 0;

            const foto = item.foto_url
                ? `<img src="${escapeHtml(item.foto_url)}" alt="${escapeHtml(item.nama_menu)}" class="menu-thumb" style="margin:0 auto;">`
                : '<div class="thumb-empty" style="margin:0 auto;">Tanpa foto</div>';

            const badge = tersedia
                ? '<span class="status-badge tersedia">Tersedia</span>'
                : '<span class="status-badge habis">Habis</span>';

            const tombolToggle = item.status_stok === 'Tersedia'
                ? `<button type="button" class="btn btn-mini btn-danger" data-toggle-menu="${id}">Set Habis</button>`
                : `<button type="button" class="btn btn-mini btn-success" data-toggle-menu="${id}">Set Tersedia</button>`;

            return `
                <tr>
                    <td>${foto}</td>
                    <td>
                        <div class="menu-name-cell" style="display:flex;flex-direction:column;align-items:center;gap:4px;">
                            <span>${escapeHtml(item.nama_menu)}</span>
                            ${badge}
                        </div>
                    </td>
                    <td>${escapeHtml(item.nama_kategori || 'Tanpa kategori')}</td>
                    <td class="harga-cell">${formatRupiah(item.harga)}</td>
                    <td class="stok-cell ${stok <= 0 ? 'habis' : ''}">${stok}</td>
                    <td>
                        <div class="row-actions" style="justify-content:center;">
                            <button type="button" class="btn btn-mini btn-light" data-edit-menu="${id}">Edit</button>
                            ${tombolToggle}
                            <button type="button" class="btn btn-mini btn-danger" data-hapus-menu="${id}">Hapus</button>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');

        renderStats();
    }

    function resetFotoPreview() {
        if (fotoObjectUrl) {
            URL.revokeObjectURL(fotoObjectUrl);
            fotoObjectUrl = null;
        }

        fotoPreview.removeAttribute('src');
        fotoPreviewWrap.style.display = 'none';
    }

    function tampilkanFoto(url) {
        if (!url) {
            resetFotoPreview();
            return;
        }

        fotoPreview.src = url;
        fotoPreviewWrap.style.display = 'block';
    }

    function bukaModalMenu(menu) {
        menuForm.reset();
        menuFormError.style.display = 'none';
        menuFormError.textContent = '';
        document.getElementById('menuId').value = menu ? menu.id_menu : '';
        document.getElementById('menuModalTitle').textContent = menu ? 'Edit Menu' : 'Tambah Menu';
        fotoTersimpan = menu ? (menu.foto_url || null) : null;

        if (kategoriData.length === 0) {
            showToast('Tambahkan kategori terlebih dahulu sebelum membuat menu.', true);
            bukaModalKategori(null);
            return;
        }

        isiPilihanKategori();

        if (menu) {
            document.getElementById('menuNama').value = menu.nama_menu || '';
            document.getElementById('menuKategori').value = String(menu.id_kategori || '');
            document.getElementById('menuHarga').value = Number(menu.harga || 0);
            document.getElementById('menuStok').value = Number(menu.jumlah_stok || 0);
            document.getElementById('menuStatus').value = menu.status_stok === 'Habis' ? 'Habis' : 'Tersedia';
            document.getElementById('menuFotoUrl').value = /^https?:\/\//i.test(menu.foto || '') ? menu.foto : '';
            document.getElementById('menuHapusFoto').checked = false;
            hapusFotoWrap.style.display = menu.foto ? 'flex' : 'none';
            tampilkanFoto(menu.foto_url || null);
        } else {
            document.getElementById('menuKategori').value = String(kategoriData[0].id_kategori);
            document.getElementById('menuStok').value = 0;
            document.getElementById('menuStatus').value = 'Habis';
            document.getElementById('menuFotoUrl').value = '';
            document.getElementById('menuHapusFoto').checked = false;
            hapusFotoWrap.style.display = 'none';
            resetFotoPreview();
        }

        menuModal.classList.add('open');
        document.body.style.overflow = 'hidden';
        document.getElementById('menuNama').focus();
    }

    function tutupModalMenu() {
        menuModal.classList.remove('open');
        document.body.style.overflow = '';
        fotoTersimpan = null;
        resetFotoPreview();
    }

    function bukaModalKategori(kategori) {
        kategoriForm.reset();
        kategoriFormError.style.display = 'none';
        kategoriFormError.textContent = '';
        document.getElementById('kategoriId').value = kategori ? kategori.id_kategori : '';
        document.getElementById('kategoriModalTitle').textContent = kategori ? 'Edit Kategori' : 'Tambah Kategori';
        document.getElementById('kategoriNama').value = kategori ? kategori.nama_kategori : '';
        kategoriModal.classList.add('open');
        document.body.style.overflow = 'hidden';
        document.getElementById('kategoriNama').focus();
    }

    function tutupModalKategori() {
        kategoriModal.classList.remove('open');
        document.body.style.overflow = '';
    }

    async function muatUlangData() {
        const hasil = await Promise.all([
            fetchJson(MENU_API + '?format=json'),
            fetchJson(KATEGORI_API)
        ]);

        menuData = hasil[0].data || [];
        kategoriData = hasil[1].data || [];

        renderKategori();
        renderMenu();
    }

    document.getElementById('btnTambahMenu').addEventListener('click', function () {
        bukaModalMenu(null);
    });

    document.getElementById('btnTambahKategori').addEventListener('click', function () {
        bukaModalKategori(null);
    });

    document.getElementById('closeMenuModal').addEventListener('click', tutupModalMenu);
    document.getElementById('batalMenu').addEventListener('click', tutupModalMenu);
    document.getElementById('closeKategoriModal').addEventListener('click', tutupModalKategori);
    document.getElementById('batalKategori').addEventListener('click', tutupModalKategori);

    menuModal.addEventListener('click', function (event) {
        if (event.target === menuModal) {
            tutupModalMenu();
        }
    });

    kategoriModal.addEventListener('click', function (event) {
        if (event.target === kategoriModal) {
            tutupModalKategori();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key !== 'Escape') {
            return;
        }

        if (menuModal.classList.contains('open')) {
            tutupModalMenu();
        }

        if (kategoriModal.classList.contains('open')) {
            tutupModalKategori();
        }
    });

    document.getElementById('menuFotoFile').addEventListener('change', function () {
        const file = this.files && this.files[0];
        const urlInput = document.getElementById('menuFotoUrl');
        const hapusFoto = document.getElementById('menuHapusFoto');

        if (!file) {
            if (urlInput.value.trim() !== '') {
                tampilkanFoto(urlInput.value.trim());
            } else if (fotoTersimpan && !hapusFoto.checked) {
                tampilkanFoto(fotoTersimpan);
            } else {
                resetFotoPreview();
            }

            return;
        }

        hapusFoto.checked = false;

        if (fotoObjectUrl) {
            URL.revokeObjectURL(fotoObjectUrl);
        }

        fotoObjectUrl = URL.createObjectURL(file);
        tampilkanFoto(fotoObjectUrl);
    });

    document.getElementById('menuFotoUrl').addEventListener('input', function () {
        const url = this.value.trim();
        const fileInput = document.getElementById('menuFotoFile');
        const file = fileInput.files && fileInput.files[0];
        const hapusFoto = document.getElementById('menuHapusFoto');

        if (url !== '') {
            hapusFoto.checked = false;
            tampilkanFoto(url);
        } else if (file && fotoObjectUrl) {
            tampilkanFoto(fotoObjectUrl);
        } else if (fotoTersimpan && !hapusFoto.checked) {
            tampilkanFoto(fotoTersimpan);
        } else {
            resetFotoPreview();
        }
    });

    document.getElementById('menuHapusFoto').addEventListener('change', function () {
        const fileInput = document.getElementById('menuFotoFile');
        const file = fileInput.files && fileInput.files[0];

        if (file) {
            return;
        }

        if (this.checked) {
            resetFotoPreview();
        } else if (fotoTersimpan) {
            tampilkanFoto(fotoTersimpan);
        }
    });

    function resetMenuPage() {
        menuPage = 1;
        renderMenu();
    }

    function goToMenuPage(pageNumber) {
        const totalPages = Math.max(1, Math.ceil(menuTersaring().length / MENU_PAGE_SIZE));
        const requested = Number(pageNumber);
        menuPage = Number.isFinite(requested) ? Math.max(1, Math.min(Math.trunc(requested), totalPages)) : 1;
        renderMenu();
    }

    document.getElementById('searchMenu').addEventListener('input', resetMenuPage);
    document.getElementById('filterKategori').addEventListener('change', resetMenuPage);
    document.getElementById('filterStatus').addEventListener('change', resetMenuPage);
    document.getElementById('prevMenuPage').addEventListener('click', function () { goToMenuPage(menuPage - 1); });
    document.getElementById('nextMenuPage').addEventListener('click', function () { goToMenuPage(menuPage + 1); });
    document.getElementById('goMenuPage').addEventListener('click', function () {
        goToMenuPage(document.getElementById('menuPageInput').value);
    });
    document.getElementById('menuPageInput').addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            goToMenuPage(this.value);
        }
    });

    document.getElementById('menuTbody').addEventListener('click', async function (event) {
        const editButton = event.target.closest('[data-edit-menu]');
        const hapusButton = event.target.closest('[data-hapus-menu]');
        const toggleButton = event.target.closest('[data-toggle-menu]');

        if (editButton) {
            const id = Number(editButton.dataset.editMenu);
            const menu = menuData.find(function (item) {
                return Number(item.id_menu) === id;
            });

            if (menu) {
                bukaModalMenu(menu);
            }

            return;
        }

        if (toggleButton) {
            const id = Number(toggleButton.dataset.toggleMenu);
            toggleButton.disabled = true;

            try {
                const result = await fetchJson(MENU_API + '/' + id + '/toggle', {
                    method: 'POST',
                    headers: { 'Accept': 'application/json' }
                });

                showToast(result.message || 'Status menu diperbarui.');
                await muatUlangData();
            } catch (error) {
                showToast(error.message, true);
                toggleButton.disabled = false;
            }

            return;
        }

        if (hapusButton) {
            const id = Number(hapusButton.dataset.hapusMenu);
            const menu = menuData.find(function (item) {
                return Number(item.id_menu) === id;
            });

            if (!menu) {
                return;
            }

            if (!confirm('Hapus menu "' + menu.nama_menu + '"? Tindakan ini tidak bisa dibatalkan.')) {
                return;
            }

            hapusButton.disabled = true;

            try {
                const result = await fetchJson(MENU_API + '/' + id, {
                    method: 'DELETE',
                    headers: { 'Accept': 'application/json' }
                });

                showToast(result.message || 'Menu dihapus.');
                await muatUlangData();
            } catch (error) {
                showToast(error.message, true);
                hapusButton.disabled = false;
            }
        }
    });

    document.getElementById('kategoriGrid').addEventListener('click', async function (event) {
        const editButton = event.target.closest('[data-edit-kategori]');
        const hapusButton = event.target.closest('[data-hapus-kategori]');

        if (editButton) {
            const id = Number(editButton.dataset.editKategori);
            const kategori = kategoriData.find(function (item) {
                return Number(item.id_kategori) === id;
            });

            if (kategori) {
                bukaModalKategori(kategori);
            }

            return;
        }

        if (hapusButton) {
            const id = Number(hapusButton.dataset.hapusKategori);
            const kategori = kategoriData.find(function (item) {
                return Number(item.id_kategori) === id;
            });

            if (!kategori) {
                return;
            }

            if (!confirm('Hapus kategori "' + kategori.nama_kategori + '"?')) {
                return;
            }

            hapusButton.disabled = true;

            try {
                const result = await fetchJson(KATEGORI_API + '/' + id, {
                    method: 'DELETE',
                    headers: { 'Accept': 'application/json' }
                });

                showToast(result.message || 'Kategori dihapus.');
                await muatUlangData();
            } catch (error) {
                showToast(error.message, true);
                hapusButton.disabled = false;
            }
        }
    });

    menuForm.addEventListener('submit', async function (event) {
        event.preventDefault();

        const id = document.getElementById('menuId').value;
        const tombol = document.getElementById('simpanMenu');
        const formData = new FormData(menuForm);
        const url = id ? (MENU_API + '/' + id) : MENU_API;

        menuFormError.style.display = 'none';
        menuFormError.textContent = '';
        tombol.disabled = true;
        tombol.textContent = 'Menyimpan...';

        try {
            const result = await fetchJson(url, {
                method: 'POST',
                body: formData,
                headers: { 'Accept': 'application/json' }
            });

            tutupModalMenu();
            showToast(result.message || 'Menu berhasil disimpan.');
            await muatUlangData();
        } catch (error) {
            menuFormError.textContent = error.message;
            menuFormError.style.display = 'block';
        } finally {
            tombol.disabled = false;
            tombol.textContent = 'Simpan Menu';
        }
    });

    kategoriForm.addEventListener('submit', async function (event) {
        event.preventDefault();

        const id = document.getElementById('kategoriId').value;
        const tombol = document.getElementById('simpanKategori');
        const formData = new FormData(kategoriForm);
        const url = id ? (KATEGORI_API + '/' + id) : KATEGORI_API;

        kategoriFormError.style.display = 'none';
        kategoriFormError.textContent = '';
        tombol.disabled = true;
        tombol.textContent = 'Menyimpan...';

        try {
            const result = await fetchJson(url, {
                method: 'POST',
                body: formData,
                headers: { 'Accept': 'application/json' }
            });

            tutupModalKategori();
            showToast(result.message || 'Kategori berhasil disimpan.');
            await muatUlangData();
        } catch (error) {
            kategoriFormError.textContent = error.message;
            kategoriFormError.style.display = 'block';
        } finally {
            tombol.disabled = false;
            tombol.textContent = 'Simpan Kategori';
        }
    });

    renderKategori();
    renderMenu();
</script>
</body>
</html>
