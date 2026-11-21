<style>
    @media (max-width: 600px) {
        #customerStatusModal {
            padding: 8px !important;
            overscroll-behavior: contain;
        }

        #customerStatusModal > div {
            width: 100%;
            max-height: calc(100vh - 16px);
            max-height: calc(100dvh - 16px);
            margin: 0 auto !important;
            overflow-y: auto !important;
            overscroll-behavior: contain;
        }

        #customerStatusModal > div > div:first-child {
            position: sticky;
            top: 0;
            z-index: 1;
            background: #fff;
        }

        #customerStatusModal button {
            min-height: 44px;
        }

        #closeCustomerStatus {
            width: 44px;
            min-width: 44px;
            height: 44px;
            flex: 0 0 44px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        #customerStatusModal strong,
        #customerStatusModal span {
            overflow-wrap: anywhere;
        }

        .qris-demo-image-wrap img {
            width: 170px;
        }
    }

    .qris-demo-card {
        background: linear-gradient(180deg, #ffffff 0%, #fff8f9 100%);
        border: 1px solid #f1d6dc;
        border-radius: 16px;
        padding: 16px;
        text-align: center;
        box-shadow: 0 8px 20px rgba(159, 18, 57, 0.08);
    }

    .qris-demo-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 10px;
    }

    .qris-demo-logo {
        font-weight: 900;
        font-size: 14px;
        letter-spacing: 0.08em;
        color: #9f1239;
    }

    .qris-demo-badge {
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.04em;
        padding: 4px 8px;
        border-radius: 999px;
        background: #fff1f3;
        color: #9f1239;
        border: 1px solid #f3c7d1;
    }

    .qris-demo-merchant {
        font-size: 15px;
        font-weight: 800;
        color: #111827;
    }

    .qris-demo-sub {
        font-size: 12px;
        color: #6b7280;
        margin-top: 2px;
    }

    .qris-demo-image-wrap {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        margin: 12px auto;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
    }

    .qris-demo-image-wrap img {
        display: block;
        width: 190px;
        max-width: 100%;
        height: auto;
    }

    .qris-demo-amount-label {
        font-size: 11px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .qris-demo-amount {
        font-size: 22px;
        font-weight: 800;
        color: #9f1239;
        margin: 2px 0 6px;
    }

    .qris-demo-meta {
        font-size: 12px;
        color: #374151;
        overflow-wrap: anywhere;
    }

    .qris-demo-divider {
        height: 1px;
        background: #f1d6dc;
        margin: 12px 0;
    }

    .qris-demo-status {
        font-size: 13px;
        font-weight: 700;
        color: #b45309;
        margin-bottom: 6px;
    }

    .qris-demo-status.paid {
        color: #15803d;
    }

    .qris-demo-paid-note {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 6px;
    }

    .qris-demo-demo-note {
        font-size: 11px;
        color: #9ca3af;
        line-height: 1.45;
        margin-top: 8px;
    }

    .status-guide {
        border: 1px solid #eee;
        border-radius: 12px;
        padding: 16px;
        background: #fafafa;
    }

    .status-guide-title {
        font-size: 13px;
        font-weight: 800;
        color: #374151;
        margin-bottom: 10px;
    }

    .status-next {
        border-radius: 10px;
        padding: 12px 14px;
        margin-bottom: 12px;
        font-size: 13px;
        line-height: 1.5;
        border: 1px solid #e5e7eb;
        background: #fff;
        color: #374151;
    }

    .status-next strong {
        display: block;
        margin-bottom: 2px;
        font-size: 14px;
        color: #111827;
    }

    .status-next.wait-pay { border-color: #fde68a; background: #fffbeb; }
    .status-next.wait-pay strong { color: #92400e; }
    .status-next.wait-kitchen { border-color: #bfdbfe; background: #eff6ff; }
    .status-next.wait-kitchen strong { color: #1e40af; }
    .status-next.ready { border-color: #86efac; background: #f0fdf4; }
    .status-next.ready strong { color: #166534; }
    .status-next.done { border-color: #d1d5db; background: #f9fafb; }
    .status-next.done strong { color: #374151; }
    .status-next.expired { border-color: #fecaca; background: #fef2f2; }
    .status-next.expired strong { color: #991b1b; }

    .status-steps {
        list-style: none;
        margin: 0;
        padding: 0;
        display: grid;
        gap: 8px;
    }

    .status-step {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 12.5px;
        color: #6b7280;
    }

    .status-step-dot {
        width: 22px;
        height: 22px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 800;
        flex: 0 0 22px;
        margin-top: 1px;
        background: #e5e7eb;
        color: #6b7280;
    }

    .status-step-body { flex: 1; min-width: 0; }
    .status-step-title { font-weight: 700; color: #374151; display: block; }
    .status-step-desc { color: #6b7280; display: block; margin-top: 1px; line-height: 1.4; }

    .status-step.done { color: #374151; }
    .status-step.done .status-step-dot { background: #dcfce7; color: #166534; }
    .status-step.active .status-step-dot { background: #9f1239; color: #fff; }
    .status-step.active .status-step-title { color: #111827; }
    .status-step.todo .status-step-dot { background: #e5e7eb; color: #9ca3af; }
    .status-step.todo .status-step-title { color: #6b7280; }

    .status-auto-note {
        margin-top: 10px;
        font-size: 11px;
        color: #9ca3af;
        text-align: center;
    }

    /* === NOTIFIKASI MAKANAN SIAP DIAMBIL === */
    .status-ready-notice-card {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        border: 2px solid #86efac;
        border-radius: 14px;
        padding: 16px;
        margin-bottom: 16px;
        box-shadow: 0 8px 24px rgba(22, 101, 52, 0.12);
        animation: readyGlowPulse 2.5s infinite ease-in-out;
    }

    @keyframes readyGlowPulse {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4), 0 8px 24px rgba(22, 101, 52, 0.12);
        }
        50% {
            box-shadow: 0 0 0 8px rgba(34, 197, 94, 0), 0 10px 28px rgba(22, 101, 52, 0.2);
        }
    }

    .ready-notice-body {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .ready-notice-badge-icon {
        position: relative;
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(22, 101, 52, 0.2);
    }

    .ready-pulse-ring {
        position: absolute;
        inset: -4px;
        border-radius: 16px;
        border: 2px solid #22c55e;
        animation: ringPulse 1.8s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    @keyframes ringPulse {
        75%, 100% {
            transform: scale(1.3);
            opacity: 0;
        }
    }

    /* Floating Alert Banner di Halaman Customer Storefront */
    .customer-ready-floating {
        position: fixed;
        bottom: 24px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1250;
        width: calc(100% - 32px);
        max-width: 540px;
        animation: slideUpFloating 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes slideUpFloating {
        from {
            opacity: 0;
            transform: translate(-50%, 40px);
        }
        to {
            opacity: 1;
            transform: translate(-50%, 0);
        }
    }

    .ready-floating-card {
        background: #ffffff;
        border: 2px solid #22c55e;
        border-radius: 16px;
        padding: 10px 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 16px 36px rgba(22, 101, 52, 0.22), 0 0 0 4px rgba(34, 197, 94, 0.15);
    }

    .ready-floating-icon {
        position: relative;
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
        color: #fff;
    }

    .ready-floating-content {
        flex: 1;
        min-width: 0;
        cursor: pointer;
    }

    .ready-floating-top {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .ready-floating-title {
        font-size: 14px;
        font-weight: 800;
        color: #15803d;
    }

    .ready-floating-badge {
        font-size: 11px;
        font-weight: 800;
        padding: 2px 7px;
        background: #dcfce7;
        color: #166534;
        border-radius: 6px;
        border: 1px solid #bbf7d0;
    }

    .ready-floating-actions {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-shrink: 0;
    }

    .ready-floating-btn {
        background: #16a34a;
        color: #ffffff;
        border: none;
        border-radius: 10px;
        padding: 9px 14px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s, transform 0.2s;
        white-space: nowrap;
    }

    .ready-floating-btn:hover {
        background: #15803d;
        transform: translateY(-1px);
    }

    .ready-floating-close {
        background: none;
        border: none;
        font-size: 20px;
        color: #9ca3af;
        cursor: pointer;
        padding: 4px 6px;
        line-height: 1;
        border-radius: 6px;
    }

    .ready-floating-close:hover {
        color: #4b5563;
        background: #f3f4f6;
    }

    @media (max-width: 600px) {
        .customer-ready-floating {
            bottom: 16px;
            width: calc(100% - 20px);
        }
        .ready-floating-card {
            padding: 10px 12px;
            gap: 10px;
        }
        .ready-floating-icon {
            width: 38px;
            height: 38px;
            font-size: 18px;
        }
        .ready-floating-title {
            font-size: 13.5px;
        }
        .ready-floating-btn {
            padding: 7px 11px;
            font-size: 11.5px;
        }
    }
</style>

<!-- FLOATING ALERT BANNER (PESANAN SIAP DIAMBIL) -->
<div id="customerReadyFloatingBar" class="customer-ready-floating" style="display: none;">
    <div class="ready-floating-card">
        <div class="ready-floating-icon">
            <span class="ready-ping"></span>
            <i class="fa-solid fa-bell"></i>
        </div>
        <div class="ready-floating-content" onclick="openCustomerStatus()">
            <div class="ready-floating-top">
                <span class="ready-floating-title">Pesanan Siap Diambil</span>
                <span id="floatingOrderMejaBadge" class="ready-floating-badge">Meja -</span>
            </div>
        </div>
        <div class="ready-floating-actions">
            <button type="button" class="ready-floating-btn" onclick="openCustomerStatus()">
                Lihat Pesanan
            </button>
            <button type="button" class="ready-floating-close" onclick="dismissReadyFloating(event)" title="Tutup pemberitahuan">
                &times;
            </button>
        </div>
    </div>
</div>

<div
    id="customerStatusModal"
    style="
        display:none;
        position:fixed;
        inset:0;
        z-index:1300;
        background:rgba(0,0,0,.55);
        padding:20px;
        overflow-y:auto;
    "
>

    <div
        style="
            max-width:600px;
            margin:30px auto;
            background:#fff;
            border-radius:14px;
            overflow:hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        "
    >

        <div
            style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                padding:18px 20px;
                border-bottom:1px solid #eee;
            "
        >

            <h2 style="margin:0; font-size:20px; color:#111827;">
                Pesanan
            </h2>

            <button
                type="button"
                id="closeCustomerStatus"
                style="
                    border:none;
                    background:none;
                    font-size:26px;
                    color:#666;
                    cursor:pointer;
                "
            >
                &times;
            </button>

        </div>


        <div
            id="customerStatusLoading"
            style="
                display:none;
                padding:40px 20px;
                text-align:center;
                color:#777;
            "
        >
            Memuat status pesanan...
        </div>


        <div
            id="customerStatusError"
            style="
                display:none;
                margin:20px;
                padding:14px;
                border-radius:8px;
                background:#fee2e2;
                color:#991b1b;
            "
        >
        </div>


        <div
            id="customerStatusEmpty"
            style="
                display:none;
                padding:50px 20px;
                text-align:center;
                color:#777;
            "
        >
            Tidak ada pesanan yang dapat ditampilkan.
        </div>


        <div
            id="customerStatusContent"
            style="
                display:none;
                padding:20px;
            "
        >

            <!-- 1. IDENTITAS PENGAMBILAN -->
            <div
                style="
                    background:#fff7ed;
                    border:1px solid #fed7aa;
                    border-radius:10px;
                    padding:14px 16px;
                    margin-bottom:16px;
                "
            >
                <div style="font-size:11px; font-weight:800; color:#c2410c; text-transform:uppercase; letter-spacing:0.5px;">
                    Informasi Pengambilan Pesanan
                </div>
                <div style="display:flex; justify-content:space-between; align-items:center; margin-top:4px;">
                    <div>
                        <strong id="statusOrderTable" style="font-size:17px; color:#111827;">
                            Meja -
                        </strong>
                        <div id="statusOrderCustomer" style="font-size:13px; color:#4b5563; margin-top:2px;">
                            Pemesan: Pelanggan
                        </div>
                    </div>
                    <span style="background:var(--km-brand-soft); color:var(--km-brand); font-size:11px; font-weight:700; padding:4px 8px; border-radius:6px;">
                        AMBIL DI KASIR
                    </span>
                </div>
            </div>

            <!-- BANNER NOTIFIKASI MAKANAN SIAP -->
            <div
                id="statusReadyNotice"
                class="status-ready-notice-card"
                style="display:none;"
            >
                <div class="ready-notice-body">
                    <div class="ready-notice-badge-icon">
                        <span class="ready-pulse-ring"></span>
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div style="flex: 1; min-width: 0;">
                        <div style="font-size:15px; font-weight:800; color:#15803d;">
                            Pesanan Siap Diambil
                        </div>
                        <div id="statusReadyMessage" style="font-size:13px; color:#166534; margin-top:2px; line-height:1.45;">
                            Pesanan Anda telah selesai disiapkan. Silakan ambil pesanan di meja kasir.
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. KODE PESANAN -->
            <div
                style="
                    background:#f7f7f7;
                    border-radius:10px;
                    padding:16px;
                    margin-bottom:16px;
                "
            >

                <div
                    style="
                        font-size:13px;
                        color:#777;
                        margin-bottom:5px;
                    "
                >
                    Kode Pesanan
                </div>

                <strong
                    id="statusOrderCode"
                    style="
                        display:block;
                        font-size:20px;
                        color:#b91c1c;
                        letter-spacing:0.5px;
                    "
                >
                </strong>

                <div
                    style="
                        margin-top:8px;
                        padding-top:8px;
                        border-top:1px dashed #e5e7eb;
                        display:flex;
                        justify-content:space-between;
                        align-items:center;
                        gap:12px;
                    "
                >
                    <span style="font-size:13px; color:#777;">
                        Nomor Antrian
                    </span>
                    <strong
                        id="statusOrderQueue"
                        style="
                            font-size:20px;
                            color:#991b1b;
                        "
                    >
                        #-
                    </strong>
                </div>

            </div>


            <!-- Progres & panduan -->
            <div id="statusGuideBox" class="status-guide" style="display:none; margin-bottom:16px;">
                <div class="status-guide-title">Progres Pesanan</div>
                <div id="statusNextAction" class="status-next"></div>
                <ol id="statusSteps" class="status-steps"></ol>
                <div class="status-auto-note">Pembaruan status pesanan berlangsung secara otomatis.</div>
            </div>

            <!-- 3. STATUS PESANAN -->
            <div
                style="
                    border:1px solid #eee;
                    border-radius:10px;
                    padding:16px;
                    margin-bottom:16px;
                "
            >

                <div
                    style="
                        font-size:13px;
                        color:#777;
                        margin-bottom:6px;
                    "
                >
                    Status saat ini
                </div>

                <strong
                    id="statusOrderStatus"
                    style="
                        font-size:20px;
                    "
                >
                </strong>

            </div>


            <!-- 3B. METODE & STATUS PEMBAYARAN -->
            <div
                style="
                    border:1px solid #eee;
                    border-radius:10px;
                    padding:16px;
                    margin-bottom:16px;
                "
            >

                <div
                    style="
                        display:flex;
                        justify-content:space-between;
                        gap:12px;
                        margin-bottom:8px;
                    "
                >
                    <span style="font-size:13px; color:#777;">
                        Metode Pembayaran
                    </span>
                    <strong
                        id="statusPaymentMethod"
                        style="font-size:14px;"
                    >
                        -
                    </strong>
                </div>

                <div
                    style="
                        display:flex;
                        justify-content:space-between;
                        gap:12px;
                    "
                >
                    <span style="font-size:13px; color:#777;">
                        Status Pembayaran
                    </span>
                    <strong
                        id="statusPaymentState"
                        style="font-size:14px;"
                    >
                        -
                    </strong>
                </div>

                <div
                    id="statusPaymentCountdownRow"
                    style="
                        display:none;
                        justify-content:space-between;
                        gap:12px;
                        margin-top:10px;
                        padding-top:10px;
                        border-top:1px dashed #e5e7eb;
                    "
                >
                    <span style="font-size:13px; color:#777;">
                        Sisa Waktu Pembayaran
                    </span>
                    <strong
                        id="statusPaymentCountdown"
                        style="font-size:14px; color:#b45309;"
                    >
                        05:00
                    </strong>
                </div>

            </div>


            <!-- 3C. QRIS CONTOH / DEMO -->
            <div
                id="statusQrisBox"
                class="qris-demo-card"
                style="
                    display:none;
                    margin-bottom:16px;
                "
            >
                <div class="qris-demo-head">
                    <div class="qris-demo-logo">QRIS</div>
                    <div class="qris-demo-badge">CONTOH / DEMO</div>
                </div>

                <div class="qris-demo-merchant">KANTIN MERAH</div>
                <div class="qris-demo-sub">Scan QRIS untuk menyelesaikan pembayaran</div>

                <div class="qris-demo-image-wrap">
                    <img
                        src="<?= base_url('assets/qris/contoh-qris.png') ?>"
                        alt="Contoh QRIS Kantin Merah"
                    >
                </div>

                <div class="qris-demo-amount-label">Total Pembayaran</div>
                <div class="qris-demo-amount" id="statusQrisTotal">Rp 0</div>

                <div class="qris-demo-meta">
                    Kode Pesanan: <strong id="statusQrisOrderCode">-</strong>
                </div>

                <div class="qris-demo-divider"></div>

                <div class="qris-demo-status" id="statusQrisStatus">
                    Menunggu pembayaran
                </div>

                <div class="qris-demo-paid-note">
                    Sudah membayar? Tekan tombol di bawah ini.
                </div>

                <div class="qris-demo-demo-note">
                    *QRIS contoh untuk demonstrasi. Tidak ada transaksi uang nyata.
                    Setelah menekan tombol, pembayaran langsung valid dan pesanan diteruskan ke dapur.
                </div>
            </div>


            <button
                type="button"
                id="statusQrisConfirm"
                style="
                    display:none;
                    width:100%;
                    border:none;
                    background:var(--km-brand);
                    color:#fff;
                    padding:12px;
                    border-radius:8px;
                    font-weight:700;
                    font-size:14px;
                    cursor:pointer;
                    margin-bottom:16px;
                "
            >
                Saya Sudah Membayar QRIS
            </button>


            <button
                type="button"
                id="statusAmbilButton"
                style="
                    display:none;
                    width:100%;
                    border:none;
                    background:var(--km-brand);
                    color:#fff;
                    padding:13px;
                    border-radius:8px;
                    font-weight:800;
                    font-size:15px;
                    cursor:pointer;
                    margin-bottom:16px;
                "
            >
                Konfirmasi Pesanan Diterima
            </button>


            <!-- 4. DETAIL PESANAN -->
            <div
                style="
                    margin-bottom:20px;
                "
            >

                <h3
                    style="
                        font-size:17px;
                        margin-bottom:12px;
                    "
                >
                    Detail Pesanan
                </h3>


                <div
                    id="statusOrderDetails"
                    style="
                        border:1px solid #eee;
                        border-radius:10px;
                        overflow:hidden;
                    "
                >
                </div>

            </div>


            <div
                style="
                    display:flex;
                    justify-content:space-between;
                    align-items:center;
                    padding-top:16px;
                    border-top:1px solid #eee;
                    margin-bottom:20px;
                "
            >

                <span
                    style="
                        color:#666;
                    "
                >
                    Total Pembayaran
                </span>

                <strong
                    id="statusOrderTotal"
                    style="
                        font-size:21px;
                        color:#b91c1c;
                    "
                >
                    Rp0
                </strong>

            </div>


            <!-- Status diperbarui otomatis -->

        </div>

    </div>

</div>


<script>

    const CUSTOMER_STATUS_API =
        <?= json_encode(
            site_url('customer/pesanan')
        ) ?>;

    const CUSTOMER_STATUS_STORAGE =
        'kantin_merah_last_order';


    let currentCustomerOrderCode =
        null;


    const customerStatusModal =
        document.getElementById(
            'customerStatusModal'
        );

    const customerStatusLoading =
        document.getElementById(
            'customerStatusLoading'
        );

    const customerStatusError =
        document.getElementById(
            'customerStatusError'
        );

    const customerStatusEmpty =
        document.getElementById(
            'customerStatusEmpty'
        );

    const customerStatusContent =
        document.getElementById(
            'customerStatusContent'
        );

    const statusOrderCode =
        document.getElementById(
            'statusOrderCode'
        );

    const statusOrderStatus =
        document.getElementById(
            'statusOrderStatus'
        );

    const statusOrderDetails =
        document.getElementById(
            'statusOrderDetails'
        );

    const statusOrderTotal =
        document.getElementById(
            'statusOrderTotal'
        );

    const statusOrderTable =
        document.getElementById(
            'statusOrderTable'
        );

    const statusOrderCustomer =
        document.getElementById(
            'statusOrderCustomer'
        );

    const statusPaymentMethod =
        document.getElementById(
            'statusPaymentMethod'
        );

    const statusPaymentState =
        document.getElementById(
            'statusPaymentState'
        );

    const statusQrisConfirm =
        document.getElementById(
            'statusQrisConfirm'
        );

    const statusQrisBox =
        document.getElementById(
            'statusQrisBox'
        );

    const statusQrisTotal =
        document.getElementById(
            'statusQrisTotal'
        );

    const statusQrisOrderCode =
        document.getElementById(
            'statusQrisOrderCode'
        );

    const statusQrisStatus =
        document.getElementById(
            'statusQrisStatus'
        );

    const statusReadyNotice =
        document.getElementById(
            'statusReadyNotice'
        );

    const statusReadyMessage =
        document.getElementById(
            'statusReadyMessage'
        );

    const statusAmbilButton =
        document.getElementById(
            'statusAmbilButton'
        );

    const statusOrderQueue =
        document.getElementById(
            'statusOrderQueue'
        );

    const statusPaymentCountdownRow =
        document.getElementById(
            'statusPaymentCountdownRow'
        );

    const statusPaymentCountdown =
        document.getElementById(
            'statusPaymentCountdown'
        );

    const statusGuideBox =
        document.getElementById('statusGuideBox');

    const statusNextAction =
        document.getElementById('statusNextAction');

    const statusSteps =
        document.getElementById('statusSteps');

    // Elemen notifikasi makanan siap diambil
    const customerReadyFloatingBar =
        document.getElementById('customerReadyFloatingBar');

    const floatingOrderMejaBadge =
        document.getElementById('floatingOrderMejaBadge');

    const navOrderReadyDot =
        document.getElementById('navOrderReadyDot');

    let customerBgWatcherTimer =
        null;

    let dismissedReadyOrders =
        new Set();

    let statusQrisConfirming =
        false;

    let statusAmbilProcessing =
        false;

    let statusPollTimer =
        null;

    let statusCountdownTimer =
        null;

    let statusCountdownDeadline =
        0;

    let statusCountdownExpired =
        false;

    /**
     * Memainkan suara bel lonceng merdu (2-tone chime)
     * Menggunakan Web Audio API sintetis (tanpa file mp3 eksternal).
     */
    function playReadyChime()
    {
        try {
            const AudioCtx = window.AudioContext || window.webkitAudioContext;
            if (!AudioCtx) return;

            const ctx = new AudioCtx();
            if (ctx.state === 'suspended') {
                ctx.resume();
            }

            const now = ctx.currentTime;

            // Nada 1: D5 (~587 Hz)
            const osc1 = ctx.createOscillator();
            const gain1 = ctx.createGain();
            osc1.type = 'sine';
            osc1.frequency.setValueAtTime(587.33, now);
            gain1.gain.setValueAtTime(0.001, now);
            gain1.gain.linearRampToValueAtTime(0.35, now + 0.04);
            gain1.gain.exponentialRampToValueAtTime(0.0001, now + 0.7);
            osc1.connect(gain1);
            gain1.connect(ctx.destination);
            osc1.start(now);
            osc1.stop(now + 0.7);

            // Nada 2: A5 (~880 Hz) - nada kedua lebih tinggi & ceria
            const osc2 = ctx.createOscillator();
            const gain2 = ctx.createGain();
            osc2.type = 'sine';
            osc2.frequency.setValueAtTime(880, now + 0.22);
            gain2.gain.setValueAtTime(0.001, now + 0.22);
            gain2.gain.linearRampToValueAtTime(0.45, now + 0.26);
            gain2.gain.exponentialRampToValueAtTime(0.0001, now + 1.2);
            osc2.connect(gain2);
            gain2.connect(ctx.destination);
            osc2.start(now + 0.22);
            osc2.stop(now + 1.2);
        } catch (e) {
            console.warn('Audio playback notice:', e);
        }

        // Efek getar untuk perangkat HP
        if ('vibrate' in navigator) {
            try {
                navigator.vibrate([200, 100, 250, 100, 350]);
            } catch (e) {}
        }
    }

    /**
     * Memicu notifikasi suara & push web notification untuk order yang siap
     */
    function triggerReadyNotification(pesanan)
    {
        if (!pesanan || !pesanan.kode_pesanan) return;

        const sessionKey = 'km_ready_notified_' + pesanan.kode_pesanan;
        if (sessionStorage.getItem(sessionKey)) {
            return; // Sudah pernah dibunyikan pada sesi tab ini
        }
        sessionStorage.setItem(sessionKey, '1');

        playReadyChime();

        // Browser HTML5 Notification
        if ('Notification' in window && Notification.permission === 'granted') {
            try {
                const meja = pesanan.nomor_meja ? ' (Meja ' + pesanan.nomor_meja + ')' : '';
                const noAntrian = pesanan.no_antrian ? 'Antrean #' + pesanan.no_antrian + ' • ' : '';
                new Notification('Pesanan Siap Diambil - Kantin Merah', {
                    body: noAntrian + 'Pesanan ' + pesanan.kode_pesanan + meja + ' telah siap diambil di meja kasir.',
                    icon: '<?= base_url('uploads/menu/ecf3c30eb6e1f68b8518fabea9f16ef4.jpg') ?>'
                });
            } catch (err) {}
        }
    }

    /**
     * Memperbarui UI floating banner dan dot indikator navbar
     */
    function updateCustomerReadyNotification(pesanan)
    {
        if (!pesanan || !pesanan.status) return;

        const isReady = pesanan.status === 'Siap Diambil';
        const isDoneOrCancelled = ['Selesai', 'Dibatalkan', 'Kadaluarsa'].includes(pesanan.status);

        if (navOrderReadyDot) {
            navOrderReadyDot.style.display = isReady ? 'inline-block' : 'none';
        }

        if (customerReadyFloatingBar) {
            if (isReady && !dismissedReadyOrders.has(pesanan.kode_pesanan)) {
                if (floatingOrderMejaBadge) {
                    floatingOrderMejaBadge.textContent = pesanan.nomor_meja ? 'Meja ' + pesanan.nomor_meja : 'Meja -';
                }
                customerReadyFloatingBar.style.display = 'block';
            } else {
                customerReadyFloatingBar.style.display = 'none';
            }
        }

        if (isReady) {
            triggerReadyNotification(pesanan);
        }

        if (isDoneOrCancelled) {
            stopCustomerBackgroundWatcher();
        }
    }

    /**
     * Menutup / menyembunyikan floating alert sementara
     */
    function dismissReadyFloating(event)
    {
        if (event) {
            event.stopPropagation();
        }
        if (customerReadyFloatingBar) {
            customerReadyFloatingBar.style.display = 'none';
        }
        const kode = currentCustomerOrderCode || getSavedOrderCode();
        if (kode) {
            dismissedReadyOrders.add(kode);
        }
    }


    function statusFormatRupiah(
        value
    )
    {
        return new Intl.NumberFormat(
            'id-ID',
            {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }
        ).format(value);
    }


    function statusFormatNoAntrian(
        value
    )
    {
        const nomor =
            parseInt(value, 10);

        if (!nomor || nomor < 1) {
            return '#-';
        }

        return '#' + String(nomor).padStart(2, '0');
    }


    function statusFormatCountdown(
        totalSeconds
    )
    {
        const seconds =
            Math.max(0, Math.floor(totalSeconds));

        const minutes =
            Math.floor(seconds / 60);

        const rest =
            seconds % 60;

        return String(minutes).padStart(2, '0') +
            ':' +
            String(rest).padStart(2, '0');
    }


    function stopStatusPaymentCountdown()
    {
        if (statusCountdownTimer) {
            clearInterval(statusCountdownTimer);
            statusCountdownTimer = null;
        }
    }


    function startStatusPaymentCountdown(
        batasWaktu
    )
    {
        let deadline =
            Date.parse(
                String(batasWaktu || '').replace(' ', 'T')
            );

        if (Number.isNaN(deadline)) {
            return;
        }

        if (
            statusCountdownTimer &&
            statusCountdownDeadline === deadline
        ) {
            return;
        }

        stopStatusPaymentCountdown();

        statusCountdownDeadline =
            deadline;

        statusCountdownExpired =
            false;

        if (statusPaymentCountdownRow) {
            statusPaymentCountdownRow.style.display =
                'flex';
        }

        if (statusPaymentCountdown) {
            statusPaymentCountdown.style.color =
                '#b45309';
        }

        const tick =
            function () {
                const remaining =
                    Math.max(
                        0,
                        Math.ceil(
                            (statusCountdownDeadline - Date.now()) / 1000
                        )
                    );

                if (statusPaymentCountdown) {
                    statusPaymentCountdown.textContent =
                        statusFormatCountdown(remaining);

                    if (remaining <= 60) {
                        statusPaymentCountdown.style.color =
                            '#dc2626';
                    }
                }

                if (remaining > 0) {
                    return;
                }

                stopStatusPaymentCountdown();

                if (statusCountdownExpired) {
                    return;
                }

                statusCountdownExpired =
                    true;

                if (statusPaymentCountdown) {
                    statusPaymentCountdown.textContent =
                        '00:00';
                    statusPaymentCountdown.style.color =
                        '#dc2626';
                }

                if (statusQrisConfirm) {
                    statusQrisConfirm.disabled =
                        true;

                    statusQrisConfirm.style.opacity =
                        '0.6';

                    statusQrisConfirm.textContent =
                        'Waktu Pembayaran Habis';
                }

                if (statusQrisStatus) {
                    statusQrisStatus.textContent =
                        '❌ Waktu pembayaran habis — pesanan dibatalkan otomatis';
                    statusQrisStatus.style.color =
                        '#dc2626';
                    statusQrisStatus.classList.remove(
                        'paid'
                    );
                }

                loadCustomerStatus(
                    currentCustomerOrderCode,
                    true
                );
            };

        tick();

        if (!statusCountdownExpired) {
            statusCountdownTimer =
                setInterval(tick, 1000);
        }
    }


    function statusEscapeHtml(
        value
    )
    {
        const div =
            document.createElement('div');

        div.textContent =
            value ?? '';

        return div.innerHTML;
    }


    function showStatusLoading()
    {
        customerStatusLoading.style.display =
            'block';

        customerStatusError.style.display =
            'none';

        customerStatusEmpty.style.display =
            'none';

        customerStatusContent.style.display =
            'none';

        if (statusGuideBox) {
            statusGuideBox.style.display = 'none';
        }
    }


    function showStatusError(
        message
    )
    {
        customerStatusLoading.style.display =
            'none';

        customerStatusEmpty.style.display =
            'none';

        customerStatusContent.style.display =
            'none';

        if (statusGuideBox) {
            statusGuideBox.style.display = 'none';
        }

        customerStatusError.textContent =
            message;

        customerStatusError.style.display =
            'block';
    }


    function showStatusEmpty()
    {
        customerStatusLoading.style.display =
            'none';

        customerStatusError.style.display =
            'none';

        customerStatusContent.style.display =
            'none';

        if (statusGuideBox) {
            statusGuideBox.style.display = 'none';
        }

        customerStatusEmpty.style.display =
            'block';
    }


    function getSavedOrderCode()
    {
        try {

            const saved =
                localStorage.getItem(
                    CUSTOMER_STATUS_STORAGE
                );


            if (!saved) {
                return null;
            }


            const order =
                JSON.parse(saved);


            if (
                !order ||
                !order.kode_pesanan
            ) {

                return null;

            }


            return order.kode_pesanan;

        } catch (error) {

            return null;

        }
    }


    function renderStatusGuide(pesanan, pembayaran) {
        if (!statusGuideBox || !statusNextAction || !statusSteps) {
            return;
        }

        const statusPesanan = (pesanan && pesanan.status) ? pesanan.status : '';
        const metodeBayar = (pesanan && pesanan.metode_bayar)
            ? pesanan.metode_bayar
            : (pembayaran && pembayaran.metode ? pembayaran.metode : 'Tunai');
        const statusBayar = pembayaran ? pembayaran.status_bayar : null;
        const expired = statusPesanan === 'Kadaluarsa' || statusBayar === 'Kadaluarsa';
        const cancelled = statusPesanan === 'Dibatalkan';
        const paid = statusBayar === 'Berhasil' || ['Dibayar', 'Diproses', 'Siap Diambil', 'Selesai'].includes(statusPesanan);
        const waitingPay = statusPesanan === 'Menunggu Pembayaran' && !expired && !cancelled;

        let nextClass = '';
        let nextTitle = 'Status Pesanan';
        let nextText = 'Informasi status pesanan Anda.';

        if (statusPesanan === 'Selesai') {
            nextClass = 'done';
            nextTitle = 'Pesanan Selesai';
            nextText = 'Pesanan telah diterima. Terima kasih atas kunjungan Anda di Kantin Merah.';
        } else if (expired) {
            nextClass = 'expired';
            nextTitle = 'Batas Waktu Pembayaran Berakhir';
            nextText = 'Batas waktu pembayaran telah habis. Pesanan dibatalkan secara otomatis oleh sistem.';
        } else if (cancelled) {
            nextClass = 'expired';
            nextTitle = 'Pesanan Dibatalkan';
            nextText = 'Pesanan ini telah dibatalkan.';
        } else if (statusPesanan === 'Siap Diambil') {
            nextClass = 'ready';
            nextTitle = 'Pesanan Siap Diambil';
            nextText = 'Pesanan telah siap. Silakan ambil pesanan di kasir dan konfirmasi penerimaan di bawah.';
        } else if (statusPesanan === 'Dibayar' || statusPesanan === 'Diproses') {
            nextClass = 'wait-kitchen';
            nextTitle = 'Pesanan Sedang Diproses';
            nextText = 'Pembayaran telah diterima. Bagian dapur sedang menyiapkan pesanan Anda.';
        } else if (waitingPay && metodeBayar === 'QRIS') {
            nextClass = 'wait-pay';
            nextTitle = 'Menunggu Pembayaran QRIS';
            nextText = 'Silakan pindai kode QRIS dan selesaikan pembayaran, kemudian lakukan konfirmasi.';
        } else if (waitingPay) {
            nextClass = 'wait-pay';
            nextTitle = 'Menunggu Pembayaran di Kasir';
            nextText = 'Silakan menuju meja kasir untuk melakukan pembayaran tunai sesuai kode pesanan.';
        }

        statusNextAction.className = 'status-next ' + nextClass;
        statusNextAction.innerHTML =
            '<strong>' + statusEscapeHtml(nextTitle) + '</strong>' +
            '<span>' + statusEscapeHtml(nextText) + '</span>';

        const steps = [
            { key: 'buat', title: 'Pesanan Diterima', desc: 'Pesanan dan nomor antrean tercatat di sistem.' },
            { key: 'bayar', title: 'Pembayaran', desc: metodeBayar === 'QRIS' ? 'Verifikasi pembayaran QRIS.' : 'Pembayaran tunai di meja kasir.' },
            { key: 'dapur', title: 'Proses Dapur', desc: 'Pesanan disiapkan oleh dapur.' },
            { key: 'siap', title: 'Siap Diambil', desc: 'Pesanan siap diambil di meja kasir.' },
            { key: 'selesai', title: 'Selesai', desc: 'Pesanan telah diserahkan.' }
        ];

        function stepState(key) {
            if (expired || cancelled) {
                if (key === 'buat') return 'done';
                if (key === 'bayar') return 'active';
                return 'todo';
            }
            if (key === 'buat') return 'done';
            if (key === 'bayar') {
                if (paid) return 'done';
                if (waitingPay) return 'active';
                return 'todo';
            }
            if (key === 'dapur') {
                if (['Siap Diambil', 'Selesai'].includes(statusPesanan)) return 'done';
                if (['Dibayar', 'Diproses'].includes(statusPesanan)) return 'active';
                return 'todo';
            }
            if (key === 'siap') {
                if (statusPesanan === 'Selesai') return 'done';
                if (statusPesanan === 'Siap Diambil') return 'active';
                return 'todo';
            }
            if (key === 'selesai') {
                return statusPesanan === 'Selesai' ? 'done' : 'todo';
            }
            return 'todo';
        }

        statusSteps.innerHTML = steps.map(function (step, index) {
            const state = stepState(step.key);
            const mark = state === 'done' ? '✓' : String(index + 1);
            return '' +
                '<li class="status-step ' + state + '">' +
                    '<span class="status-step-dot">' + mark + '</span>' +
                    '<span class="status-step-body">' +
                        '<span class="status-step-title">' + statusEscapeHtml(step.title) + '</span>' +
                        '<span class="status-step-desc">' + statusEscapeHtml(step.desc) + '</span>' +
                    '</span>' +
                '</li>';
        }).join('');

        statusGuideBox.style.display = 'block';
    }

    function renderCustomerStatus(
        result
    )
    {
        const pesanan =
            result.pesanan;

        const detail =
            result.detail || [];


        statusOrderCode.textContent =
            pesanan.kode_pesanan || '-';

        if (statusOrderQueue) {
            statusOrderQueue.textContent =
                statusFormatNoAntrian(
                    pesanan.no_antrian
                );
        }


        const pembayaran =
            result.pembayaran || null;

        const metodeBayar =
            pesanan.metode_bayar ||
            (pembayaran ? pembayaran.metode : null) ||
            'Tunai';

        const statusBayar =
            pembayaran
                ? pembayaran.status_bayar
                : '-';

        statusOrderStatus.textContent =
            pesanan.status === 'Kadaluarsa'
                ? 'Kadaluarsa — Dibatalkan Otomatis'
                : (pesanan.status || '-');

        if (statusPaymentMethod) {
            statusPaymentMethod.textContent = metodeBayar;
        }

        if (statusPaymentState) {

            let labelStatus = statusBayar || '-';
            let warnaStatus = '#111827';

            if (statusBayar === 'Berhasil') {
                labelStatus = 'Berhasil';
                warnaStatus = 'var(--km-success)';
            } else if (statusBayar === 'Menunggu') {
                labelStatus = 'Belum dibayar';
                warnaStatus = '#b45309';
            } else if (
                statusBayar === 'Kadaluarsa' ||
                statusBayar === 'Gagal'
            ) {
                warnaStatus = '#b91c1c';
            }

            statusPaymentState.textContent = labelStatus;
            statusPaymentState.style.color = warnaStatus;
        }

        const tampilkanCountdown =
            pesanan.status === 'Menunggu Pembayaran' &&
            statusBayar === 'Menunggu' &&
            pembayaran &&
            pembayaran.batas_waktu;

        if (tampilkanCountdown) {
            if (statusPaymentCountdownRow) {
                statusPaymentCountdownRow.style.display =
                    'flex';
            }

            startStatusPaymentCountdown(
                pembayaran.batas_waktu
            );
        } else {
            stopStatusPaymentCountdown();

            if (statusPaymentCountdownRow) {
                statusPaymentCountdownRow.style.display =
                    'none';
            }
        }

        const pembayaranQrisDiterima =
            statusBayar === 'Berhasil';

        const bisaKonfirmasiQris =
            metodeBayar === 'QRIS' &&
            pesanan.status === 'Menunggu Pembayaran' &&
            statusBayar !== 'Gagal' &&
            statusBayar !== 'Kadaluarsa';

        if (statusQrisConfirm) {
            statusQrisConfirm.style.display =
                bisaKonfirmasiQris ? 'block' : 'none';

            statusQrisConfirm.disabled = !bisaKonfirmasiQris;
            statusQrisConfirm.style.opacity =
                bisaKonfirmasiQris ? '1' : '0.75';

            statusQrisConfirm.textContent = pembayaranQrisDiterima
                ? 'Pembayaran Sudah Diterima — Teruskan ke Dapur'
                : 'Saya Sudah Membayar QRIS';
        }

        if (statusQrisBox) {

            const tampilkanQris =
                metodeBayar === 'QRIS' &&
                pesanan.status === 'Menunggu Pembayaran' &&
                statusBayar !== 'Gagal' &&
                statusBayar !== 'Kadaluarsa';

            statusQrisBox.style.display =
                tampilkanQris ? 'block' : 'none';

            if (tampilkanQris) {

                if (statusQrisTotal) {
                    statusQrisTotal.textContent =
                        'Rp ' +
                        Number(
                            pesanan.total_bayar || 0
                        ).toLocaleString('id-ID');
                }

                if (statusQrisOrderCode) {
                    statusQrisOrderCode.textContent =
                        pesanan.kode_pesanan || '-';
                }

                if (statusQrisStatus) {
                    const sudahBayar =
                        statusBayar === 'Berhasil';

                    statusQrisStatus.textContent = sudahBayar
                        ? '✅ Pembayaran diterima — klik tombol untuk meneruskan ke dapur'
                        : 'Menunggu pembayaran';

                    statusQrisStatus.classList.toggle(
                        'paid',
                        sudahBayar
                    );
                }
            }
        }

        const notifikasi =
            result.notifikasi || null;

        // Perbarui notifikasi floating & audio di sisi customer
        updateCustomerReadyNotification(pesanan);

        if (statusReadyNotice) {

            const siapDiambil =
                pesanan.status === 'Siap Diambil';

            statusReadyNotice.style.display =
                siapDiambil ? 'block' : 'none';

            if (siapDiambil && statusReadyMessage) {

                const pesanNotif =
                    notifikasi && notifikasi.pesan
                        ? notifikasi.pesan
                        : 'Pesanan Anda telah selesai disiapkan. Silakan ambil pesanan di meja kasir.';

                statusReadyMessage.textContent =
                    pesanNotif;
            }
        }

        if (statusAmbilButton) {

            const bisaAmbil =
                pesanan.status === 'Siap Diambil';

            statusAmbilButton.style.display =
                bisaAmbil ? 'block' : 'none';

            if (bisaAmbil) {
                statusAmbilButton.disabled =
                    statusAmbilProcessing;
                statusAmbilButton.style.opacity =
                    statusAmbilProcessing ? '0.6' : '1';
                statusAmbilButton.textContent =
                    'Konfirmasi Pesanan Diterima';
            }
        }

        if (
            ['Selesai', 'Dibatalkan', 'Kadaluarsa'].includes(
                pesanan.status
            )
        ) {
            stopStatusPolling();
        }

        // Tampilkan info meja & pemesan
        if (statusOrderTable) {
            statusOrderTable.textContent = pesanan.nomor_meja || 'Meja -';
        }
        if (statusOrderCustomer) {
            statusOrderCustomer.textContent = 'Pemesan: ' + (pesanan.nama_customer || 'Pelanggan');
        }


        statusOrderTotal.textContent =
            statusFormatRupiah(
                Number(
                    pesanan.total_bayar || 0
                )
            );


        statusOrderDetails.innerHTML =
            '';


        if (detail.length === 0) {

            statusOrderDetails.innerHTML = `
                <div
                    style="
                        padding:18px;
                        text-align:center;
                        color:#777;
                    "
                >
                    Tidak ada detail pesanan.
                </div>
            `;

        } else {

            detail.forEach(
                function (item) {

                    const jumlah =
                        Number(
                            item.jumlah || 0
                        );


                    const harga =
                        Number(
                            item.harga_satuan ||
                            item.harga ||
                            0
                        );


                    const subtotal =
                        Number(
                            item.subtotal ||
                            harga * jumlah
                        );


                    const element =
                        document.createElement(
                            'div'
                        );


                    element.style.cssText = `
                        padding:14px;
                        border-bottom:1px solid #eee;
                    `;


                    element.innerHTML = `

                        <div
                            style="
                                display:flex;
                                justify-content:space-between;
                                gap:15px;
                            "
                        >

                            <div>

                                <div
                                    style="
                                        font-weight:600;
                                        margin-bottom:4px;
                                    "
                                >
                                    ${statusEscapeHtml(
                                        item.nama_menu ||
                                        'Menu'
                                    )}
                                </div>

                                <div
                                    style="
                                        font-size:13px;
                                        color:#777;
                                    "
                                >
                                    ${jumlah} x
                                    ${statusFormatRupiah(
                                        harga
                                    )}
                                </div>

                                ${
                                    item.catatan_khusus
                                        ? `
                                            <div
                                                style="
                                                    margin-top:6px;
                                                    font-size:12px;
                                                    color:#666;
                                                "
                                            >
                                                Catatan:
                                                ${statusEscapeHtml(
                                                    item.catatan_khusus
                                                )}
                                            </div>
                                        `
                                        : ''
                                }

                            </div>


                            <strong>
                                ${statusFormatRupiah(
                                    subtotal
                                )}
                            </strong>

                        </div>

                    `;


                    statusOrderDetails.appendChild(
                        element
                    );

                }
            );

        }


        renderStatusGuide(pesanan, pembayaran);

        customerStatusLoading.style.display =
            'none';

        customerStatusError.style.display =
            'none';

        customerStatusEmpty.style.display =
            'none';

        customerStatusContent.style.display =
            'block';
    }


    async function loadCustomerStatus(
        kodePesanan = null,
        silent = false
    )
    {
        const kode =
            kodePesanan ||
            currentCustomerOrderCode ||
            getSavedOrderCode();


        if (!kode) {

            showStatusEmpty();

            return;

        }


        currentCustomerOrderCode =
            kode;


        if (!silent) {
            showStatusLoading();
        }


        try {

            const response =
                await fetch(
                    `${CUSTOMER_STATUS_API}/${encodeURIComponent(
                        kode
                    )}`,
                    {
                        method: 'GET',
                        headers: {
                            'Accept':
                                'application/json'
                        }
                    }
                );


            const result =
                await response.json();


            if (
                !response.ok ||
                !result.status ||
                !result.data
            ) {

                throw new Error(
                    result.message ||
                    'Pesanan tidak ditemukan.'
                );

            }


            renderCustomerStatus(
                result.data
            );


        } catch (error) {

            if (!silent) {
                showStatusError(
                    error.message ||
                    'Gagal mengambil status pesanan.'
                );
            }

        }
    }


    function startStatusPolling()
    {
        stopStatusPolling();

        statusPollTimer = setInterval(
            function () {

                if (
                    customerStatusModal.style.display ===
                        'block' &&
                    currentCustomerOrderCode
                ) {
                    loadCustomerStatus(
                        currentCustomerOrderCode,
                        true
                    );
                }

            },
            15000
        );
    }


    function stopStatusPolling()
    {
        if (statusPollTimer) {
            clearInterval(statusPollTimer);
            statusPollTimer = null;
        }
    }


    function openCustomerStatus(
        kodePesanan = null
    )
    {
        customerStatusModal.style.display =
            'block';

        document.body.style.overflow =
            'hidden';

        // Minta izin notifikasi browser sekali saja
        // (dipicu oleh klik pengguna).
        if (
            'Notification' in window &&
            Notification.permission === 'default'
        ) {
            Notification
                .requestPermission()
                .catch(function () {});
        }


        currentCustomerOrderCode =
            kodePesanan ||
            getSavedOrderCode();


        loadCustomerStatus(
            currentCustomerOrderCode
        );

        startStatusPolling();
    }


    function closeCustomerStatus()
    {
        stopStatusPolling();

        stopStatusPaymentCountdown();

        if (statusPaymentCountdownRow) {
            statusPaymentCountdownRow.style.display =
                'none';
        }

        customerStatusModal.style.display =
            'none';

        document.body.style.overflow =
            '';
    }


    document
        .getElementById(
            'closeCustomerStatus'
        )
        .addEventListener(
            'click',
            closeCustomerStatus
        );


    customerStatusModal.addEventListener(
        'click',
        function (event) {

            if (
                event.target ===
                customerStatusModal
            ) {

                closeCustomerStatus();

            }

        }
    );


    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                customerStatusModal.style.display ===
                    'block'
            ) {

                closeCustomerStatus();

            }

        }
    );


    const refreshCustomerStatusBtn = document.getElementById('refreshCustomerStatus');
    if (refreshCustomerStatusBtn) {
        refreshCustomerStatusBtn.addEventListener('click', function () {
            loadCustomerStatus(currentCustomerOrderCode);
        });
    }


    async function konfirmasiQrisStatus()
    {
        if (
            statusQrisConfirming ||
            !currentCustomerOrderCode
        ) {
            return;
        }

        statusQrisConfirming = true;

        if (statusQrisConfirm) {
            statusQrisConfirm.disabled = true;
            statusQrisConfirm.style.opacity = '0.6';
            statusQrisConfirm.textContent = 'Memproses...';
        }

        try {

            const response = await fetch(
                `${CUSTOMER_STATUS_API}/${encodeURIComponent(
                    currentCustomerOrderCode
                )}/bayar-qris`,
                {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json'
                    }
                }
            );

            const result = await response.json();

            if (!response.ok || !result.status) {
                throw new Error(
                    result.message ||
                    'Konfirmasi pembayaran QRIS gagal.'
                );
            }

            await loadCustomerStatus(
                currentCustomerOrderCode
            );

        } catch (error) {

            alert(
                error.message ||
                'Konfirmasi pembayaran QRIS gagal.'
            );

            if (statusQrisConfirm) {
                statusQrisConfirm.disabled = false;
                statusQrisConfirm.style.opacity = '1';
                statusQrisConfirm.textContent =
                    'Saya Sudah Membayar QRIS';
            }

        } finally {

            statusQrisConfirming = false;

        }
    }


    if (statusQrisConfirm) {
        statusQrisConfirm.addEventListener(
            'click',
            konfirmasiQrisStatus
        );
    }


    async function ambilPesananStatus()
    {
        if (
            statusAmbilProcessing ||
            !currentCustomerOrderCode
        ) {
            return;
        }

        if (
            !confirm(
                'Konfirmasi bahwa Anda telah mengambil pesanan ini?'
            )
        ) {
            return;
        }

        statusAmbilProcessing = true;

        if (statusAmbilButton) {
            statusAmbilButton.disabled = true;
            statusAmbilButton.style.opacity = '0.6';
            statusAmbilButton.textContent = 'Memproses...';
        }

        try {

            const response = await fetch(
                `${CUSTOMER_STATUS_API}/${encodeURIComponent(
                    currentCustomerOrderCode
                )}/ambil`,
                {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json'
                    }
                }
            );

            const result = await response.json();

            if (!response.ok || !result.status) {
                throw new Error(
                    result.message ||
                    'Gagal mengonfirmasi penerimaan pesanan.'
                );
            }

            alert(
                'Pesanan telah selesai. Terima kasih atas kunjungan Anda.'
            );

            await loadCustomerStatus(
                currentCustomerOrderCode
            );

        } catch (error) {

            alert(
                error.message ||
                'Gagal mengonfirmasi penerimaan pesanan.'
            );

            if (statusAmbilButton) {
                statusAmbilButton.disabled = false;
                statusAmbilButton.style.opacity = '1';
                statusAmbilButton.textContent =
                    'Konfirmasi Pesanan Diterima';
            }

        } finally {

            statusAmbilProcessing = false;

        }
    }


    if (statusAmbilButton) {
        statusAmbilButton.addEventListener(
            'click',
            ambilPesananStatus
        );
    }

    /**
     * Background Watcher untuk mendeteksi status "Siap Diambil"
     * secara otomatis bahkan ketika modal ditutup.
     */
    function startCustomerBackgroundWatcher()
    {
        stopCustomerBackgroundWatcher();
        const kode = currentCustomerOrderCode || getSavedOrderCode();
        if (!kode) return;

        // Pengecekan pertama langsung
        checkBackgroundOrderStatus(kode);

        // Polling setiap 7 detik
        customerBgWatcherTimer = setInterval(function () {
            const activeKode = currentCustomerOrderCode || getSavedOrderCode();
            if (activeKode) {
                checkBackgroundOrderStatus(activeKode);
            } else {
                stopCustomerBackgroundWatcher();
            }
        }, 7000);
    }

    function stopCustomerBackgroundWatcher()
    {
        if (customerBgWatcherTimer) {
            clearInterval(customerBgWatcherTimer);
            customerBgWatcherTimer = null;
        }
    }

    async function checkBackgroundOrderStatus(kode)
    {
        if (!kode) return;
        try {
            const response = await fetch(`${CUSTOMER_STATUS_API}/${encodeURIComponent(kode)}`, {
                method: 'GET',
                headers: { 'Accept': 'application/json' }
            });
            const result = await response.json();
            if (response.ok && result && result.status && result.data && result.data.pesanan) {
                const pesanan = result.data.pesanan;
                updateCustomerReadyNotification(pesanan);
                // Jika modal sedang terbuka, perbarui isinya
                if (customerStatusModal && customerStatusModal.style.display === 'block') {
                    renderCustomerStatus(result.data);
                }
            }
        } catch (err) {
            // Polling background senyap
        }
    }

    // Inisialisasi background watcher otomatis saat halaman siap
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', startCustomerBackgroundWatcher);
    } else {
        startCustomerBackgroundWatcher();
    }

    window.openCustomerStatus =
        openCustomerStatus;

    window.closeCustomerStatus =
        closeCustomerStatus;

    window.playReadyChime =
        playReadyChime;

    window.dismissReadyFloating =
        dismissReadyFloating;

    window.startCustomerBackgroundWatcher =
        startCustomerBackgroundWatcher;

    window.stopCustomerBackgroundWatcher =
        stopCustomerBackgroundWatcher;

</script>
