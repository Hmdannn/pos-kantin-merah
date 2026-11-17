<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kantin Merah - Pemesanan Mandiri & Pelacakan Real-Time</title>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --brand-1: #9f1239;
            --brand-2: #881337;
            --brand-3: #ffe4e6;
            --brand-4: #fff1f3;
            --ink-1: #20242b;
            --ink-2: #475467;
            --ink-3: #667085;
            --line: #e2e5e9;
            --panel: #ffffff;
            --panel-soft: #f8f9fb;
            --success: #15803d;
            --success-soft: #dcfce7;
            --success-bg: #dcfce7;
            --km-brand: #9f1239;
            --km-brand-hover: #881337;
            --km-brand-soft: #fff1f3;
            --km-bg: #faf7f4;
            --km-surface: #ffffff;
            --km-surface-muted: #f8f9fb;
            --km-border: #e2e5e9;
            --km-text: #20242b;
            --km-muted: #667085;
            --shadow-soft: 0 10px 28px rgba(32, 36, 43, 0.06);
            --shadow-strong: 0 20px 44px rgba(32, 36, 43, 0.12);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-primary);
            background: radial-gradient(ellipse at 86% 6%, rgba(159, 18, 57, 0.04), transparent 34rem), var(--km-bg);
            color: var(--ink-1);
        }

        button {
            font-family: inherit;
            cursor: pointer;
        }

        /* Header Style */
        .customer-header {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(250, 250, 244, 0.96);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--km-border);
            box-shadow: 0 3px 14px rgba(32, 36, 43, 0.04);
        }

        .header-inner {
            max-width: 1400px;
            margin: 0 auto;
            min-height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 12px 30px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--km-brand);
            font-size: 1.15rem;
            font-weight: 900;
            letter-spacing: 0.105em;
            text-transform: uppercase;
        }

        .brand::before {
            content: "K";
            display: grid;
            width: 36px;
            height: 36px;
            place-items: center;
            border-radius: 11px 11px 11px 4px;
            background: var(--km-brand);
            color: #ffffff;
            font-size: 1rem;
            letter-spacing: 0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .track-btn {
            background: var(--panel);
            border: 1px solid var(--line);
            color: var(--ink-2);
            padding: 10px 16px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.88rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .track-btn:hover {
            border-color: var(--brand-1);
            color: var(--brand-1);
        }

        .cart-button {
            position: relative;
            border: none;
            background: linear-gradient(135deg, var(--brand-1) 0%, var(--brand-2) 100%);
            color: white;
            padding: 11px 18px;
            border-radius: 10px;
            font-weight: 700;
            box-shadow: 0 5px 12px rgba(32, 36, 43, 0.12);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .cart-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(32, 36, 43, 0.16);
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            min-width: 22px;
            height: 22px;
            padding: 0 6px;
            border-radius: 50%;
            background: var(--km-brand);
            color: #fff;
            border: 2px solid var(--km-surface);
            font-size: 11px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Main Container: Split Grid ala Food Master */
        main {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 30px 64px;
        }

        .food-master-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 380px;
            gap: 28px;
            align-items: start;
        }

        /* Hero Banner */
        .hero {
            min-height: 180px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            overflow: hidden;
            position: relative;
            padding: 30px 36px;
            margin-bottom: 24px;
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 18px 18px 18px 5px;
            background: linear-gradient(112deg, #881337 0%, #9f1239 62%, #b4234d 100%);
            box-shadow: 0 16px 34px rgba(32, 36, 43, .15);
            color: #fff;
        }

        .hero-copy {
            max-width: 520px;
            position: relative;
            z-index: 2;
        }

        .hero-kicker {
            display: block;
            margin-bottom: 8px;
            color: #ffe4e6;
            font-size: .7rem;
            font-weight: 800;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        .hero h1 {
            margin-bottom: 8px;
            font-size: clamp(1.8rem, 2.6vw, 2.4rem);
            line-height: 1.1;
            letter-spacing: -.04em;
            font-weight: 900;
        }

        .hero p {
            color: rgba(249, 249, 237, .85);
            font-size: .9rem;
            line-height: 1.5;
        }

        /* Search & Filter Bar */
        .catalog-tools {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 24px;
        }

        .search-bar-wrap {
            position: relative;
            width: 100%;
        }

        .search-bar-wrap input {
            width: 100%;
            padding: 12px 16px 12px 42px;
            border: 1px solid var(--line);
            background: var(--panel);
            border-radius: 12px;
            font-size: 0.95rem;
            color: var(--ink-1);
            outline: none;
            box-shadow: var(--shadow-soft);
        }

        .search-bar-wrap svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            fill: var(--ink-3);
        }

        .category-list {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding: 4px 2px;
            scrollbar-width: thin;
        }

        .category-button {
            flex-shrink: 0;
            border: 1px solid var(--line);
            background: var(--panel);
            color: var(--ink-2);
            padding: 10px 18px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 0.88rem;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(31, 41, 55, 0.03);
        }

        .category-button:hover {
            border-color: var(--brand-1);
            color: var(--brand-1);
        }

        .category-button.active {
            background: linear-gradient(135deg, var(--brand-1) 0%, var(--brand-2) 100%);
            border-color: transparent;
            color: #fff;
            box-shadow: 0 8px 18px rgba(122, 43, 34, 0.2);
        }

        /* Menu Grid */
        .section-title {
            font-size: 1.25rem;
            font-weight: 800;
            margin-bottom: 16px;
            color: var(--ink-1);
            letter-spacing: -0.02em;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
            gap: 18px;
        }

        .menu-card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 16px;
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .menu-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 30px rgba(32, 36, 43, 0.08);
        }

        .menu-image-wrap {
            position: relative;
            width: 100%;
            aspect-ratio: 4 / 3;
            background: #efeae6;
            border-bottom: 1px solid var(--line);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-image {
            width: 100%;
            height: 100%;
            aspect-ratio: 4 / 3;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }

        .menu-card:hover .menu-image {
            transform: scale(1.05);
        }

        .menu-image-placeholder {
            width: 100%;
            height: 100%;
            aspect-ratio: 4 / 3;
            background: linear-gradient(135deg, #f8f9fb 0%, #efeae6 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: var(--ink-3);
            font-size: 0.78rem;
            font-weight: 600;
            padding: 10px;
            text-align: center;
            user-select: none;
        }

        .menu-image-placeholder i {
            font-size: 1.8rem;
            color: var(--brand-1);
            opacity: 0.45;
        }

        .menu-content {
            padding: 14px 14px 16px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .menu-category {
            color: var(--ink-3);
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .menu-name {
            color: var(--ink-1);
            font-size: 1.02rem;
            font-weight: 800;
            margin-bottom: 6px;
            line-height: 1.3;
        }

        .menu-description {
            color: var(--ink-3);
            font-size: 0.76rem;
            line-height: 1.45;
            margin-bottom: 12px;
            flex-grow: 1;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .menu-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-top: auto;
            padding-top: 8px;
            border-top: 1px solid var(--line);
        }

        .menu-price {
            color: var(--brand-1);
            font-weight: 800;
            font-size: 1rem;
        }

        .menu-add-btn {
            background: var(--brand-1);
            color: #fff;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            font-weight: 800;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(159, 18, 57, 0.2);
        }

        .menu-add-btn:hover {
            background: var(--brand-2);
        }

        .menu-add-btn:disabled {
            background: #e5e7eb;
            color: #9ca3af;
            box-shadow: none;
            cursor: not-allowed;
        }

        .menu-habis-badge {
            display: inline-block;
            margin-bottom: 6px;
            background: #fee2e2;
            color: #991b1b;
            padding: 3px 7px;
            border-radius: 999px;
            font-size: 0.62rem;
            font-weight: 800;
            text-transform: uppercase;
        }

        .menu-card-habis .menu-image {
            filter: grayscale(0.7);
            opacity: 0.7;
        }

        /* My Cart Sidebar */
        .cart-sidebar {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 20px;
            padding: 22px;
            box-shadow: var(--shadow-soft);
            position: sticky;
            top: 90px;
            display: flex;
            flex-direction: column;
            max-height: calc(100vh - 110px);
        }

        .cart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--line);
            margin-bottom: 14px;
        }

        .cart-header h2 {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--ink-1);
        }

        .cart-clear-btn {
            background: none;
            border: none;
            color: var(--brand-1);
            font-size: 0.78rem;
            font-weight: 700;
        }

        .cart-items-wrap {
            overflow-y: auto;
            flex-grow: 1;
            padding-right: 2px;
            max-height: 40vh;
        }

        .cart-item-row {
            display: flex;
            gap: 10px;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid var(--line);
        }

        .cart-item-img {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            object-fit: cover;
            background: #eee;
            flex-shrink: 0;
        }

        .cart-item-img-placeholder {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: #f1f5f9;
            color: var(--brand-1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
            opacity: 0.8;
        }

        .cart-item-details {
            flex-grow: 1;
            min-width: 0;
        }

        .cart-item-title {
            font-size: 0.88rem;
            font-weight: 800;
            color: var(--ink-1);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cart-item-price {
            font-size: 0.78rem;
            color: var(--ink-3);
            font-weight: 600;
        }

        .cart-item-note-input {
            width: 100%;
            margin-top: 4px;
            padding: 4px 8px;
            font-size: 0.72rem;
            border: 1px solid var(--line);
            border-radius: 6px;
            outline: none;
        }

        .cart-item-qty-control {
            display: flex;
            align-items: center;
            gap: 6px;
            background: var(--panel-soft);
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 2px 6px;
        }

        .cart-qty-btn {
            background: none;
            border: none;
            font-weight: 800;
            font-size: 0.85rem;
            color: var(--ink-1);
            width: 20px;
            height: 20px;
            display: grid;
            place-items: center;
        }

        .cart-qty-num {
            font-size: 0.82rem;
            font-weight: 800;
            color: var(--ink-1);
            min-width: 16px;
            text-align: center;
        }

        .cart-summary {
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px dashed var(--line);
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .cart-summary-line {
            display: flex;
            justify-content: space-between;
            font-size: 0.88rem;
            color: var(--ink-3);
        }

        .cart-summary-total {
            display: flex;
            justify-content: space-between;
            font-size: 1.05rem;
            font-weight: 900;
            color: var(--ink-1);
            padding-top: 4px;
        }

        .checkout-btn {
            width: 100%;
            margin-top: 16px;
            border: none;
            background: linear-gradient(135deg, var(--brand-1) 0%, var(--brand-2) 100%);
            color: white;
            padding: 13px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 0.95rem;
            box-shadow: 0 10px 20px rgba(122, 43, 34, 0.2);
        }

        .checkout-btn:disabled {
            background: #e5e7eb;
            color: #9ca3af;
            box-shadow: none;
            cursor: not-allowed;
        }

        /* Modal & Tracker Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(32, 36, 43, 0.6);
            backdrop-filter: blur(5px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .modal-card {
            background: var(--panel);
            border-radius: 20px;
            width: 100%;
            max-width: 440px;
            padding: 24px;
            box-shadow: var(--shadow-strong);
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 18px;
            right: 18px;
            background: none;
            border: none;
            font-size: 1.2rem;
            color: var(--ink-3);
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 700;
            margin-bottom: 6px;
            color: var(--ink-1);
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid var(--line);
            border-radius: 10px;
            font-size: 0.9rem;
            outline: none;
            background: var(--panel-soft);
        }

        .checkout-method-options {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .checkout-method-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            border: 1px solid var(--line);
            border-radius: 12px;
            background: var(--panel);
            cursor: pointer;
        }

        .checkout-method-option input {
            width: auto;
            accent-color: var(--brand-1);
        }

        .checkout-method-option.active {
            border-color: var(--brand-1);
            background: var(--brand-4);
        }

        /* Real-Time Stepper Progress */
        .stepper-container {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin: 20px 0;
        }
        .step-item {
            text-align: center;
            position: relative;
            z-index: 2;
            flex: 1;
        }
        .step-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #e5e7eb;
            color: #6b7280;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.8rem;
            margin: 0 auto 6px;
            transition: all 0.3s;
        }
        .step-item.active .step-circle {
            background: var(--brand-1);
            color: #fff;
            box-shadow: 0 0 0 4px var(--brand-3);
        }
        .step-item.completed .step-circle {
            background: var(--success);
            color: #fff;
        }
        .step-label {
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--ink-3);
        }
        .step-item.active .step-label {
            color: var(--brand-1);
        }

        html {
            -webkit-text-size-adjust: 100%;
            text-size-adjust: 100%;
        }

        body {
            overflow-x: hidden;
        }

        img {
            max-width: 100%;
        }

        @media (max-width: 1024px) {
            .food-master-layout {
                grid-template-columns: 1fr;
            }
            .cart-sidebar {
                position: static;
                max-height: none;
            }
        }

        @media (max-width: 768px) {
            .header-inner {
                padding: 10px 14px;
                gap: 10px;
                min-height: 60px;
            }

            .brand {
                font-size: 1rem;
                gap: 8px;
                letter-spacing: 0.08em;
            }

            .brand::before {
                width: 32px;
                height: 32px;
                font-size: 0.9rem;
            }

            .header-actions {
                gap: 8px;
                flex-wrap: wrap;
                justify-content: flex-end;
            }

            .track-btn,
            .cart-button {
                padding: 8px 12px;
                font-size: 0.82rem;
                min-height: 44px;
            }

            .hero {
                min-height: auto;
                padding: 18px 16px;
                margin-bottom: 16px;
                border-radius: 14px;
            }

            .hero h1 {
                font-size: 1.45rem;
            }

            .hero p {
                font-size: 0.85rem;
            }

            main {
                padding: 14px 14px 40px;
            }

            .food-master-layout {
                gap: 16px;
            }

            .catalog-tools {
                gap: 12px;
                margin-bottom: 16px;
            }

            .search-bar-wrap input {
                font-size: 16px;
                padding: 11px 14px 11px 40px;
            }

            .category-button {
                padding: 8px 14px;
                font-size: 0.84rem;
                min-height: 40px;
            }

            .section-title {
                font-size: 1.1rem;
                margin-bottom: 12px;
            }

            .menu-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .menu-content {
                padding: 10px 10px 12px;
            }

            .menu-name {
                font-size: 0.95rem;
            }

            .menu-price {
                font-size: 0.92rem;
            }

            .menu-add-btn {
                width: 40px;
                height: 40px;
            }

            .cart-sidebar {
                margin-top: 4px;
                padding: 16px;
                border-radius: 16px;
            }
        }

        @media (max-width: 480px) {
            .header-inner {
                padding: 8px 10px;
            }

            .brand {
                font-size: 0.92rem;
            }

            .track-btn span-text,
            .cart-button span-text {
                display: none;
            }

            .hero h1 {
                font-size: 1.3rem;
            }

            .menu-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .menu-card {
                border-radius: 14px;
            }

            .menu-footer {
                gap: 10px;
            }

            .category-list {
                gap: 8px;
            }
        }

        /* Customer storefront: visual treatment aligned with the POS mockup. */
        body {
            background: #f5f6fb;
            color: #171923;
        }

        .checkout-btn {
            background: #a40e36;
            box-shadow: 0 5px 12px rgba(164, 14, 54, .15);
        }

        main {
            max-width: 1400px;
            padding: 18px 24px 48px;
        }

        .hero {
            min-height: 156px;
            margin-bottom: 14px;
            padding: 25px 28px;
            border: 0;
            border-radius: 14px;
            background:
                linear-gradient(90deg, rgba(137, 10, 48, .98) 0%, rgba(159, 18, 57, .92) 37%, rgba(159, 18, 57, .12) 72%),
                url("<?= base_url('uploads/menu/ecf3c30eb6e1f68b8518fabea9f16ef4.jpg') ?>") center 48% / cover,
                #9f1239;
            box-shadow: 0 8px 22px rgba(31, 41, 55, .1);
        }

        .hero-copy {
            max-width: 420px;
        }

        .hero-kicker {
            display: none;
        }

        .hero-location {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 10px;
            padding: 5px 10px;
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 999px;
            background: rgba(80, 5, 29, .35);
            color: #fff;
            font-size: .73rem;
            font-weight: 700;
        }

        .hero h1 {
            margin-bottom: 7px;
            font-size: clamp(1.65rem, 2.3vw, 2rem);
            letter-spacing: -.025em;
        }

        .hero p {
            max-width: 340px;
            color: rgba(255, 255, 255, .88);
            font-size: .88rem;
        }

        .food-master-layout {
            grid-template-columns: minmax(0, 1fr) 330px;
            gap: 14px;
        }

        .catalog-section,
        .cart-sidebar {
            min-width: 0;
            padding: 14px;
            border: 1px solid #e7e8ef;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 5px 18px rgba(31, 41, 55, .045);
        }

        .catalog-tools {
            gap: 9px;
            margin-bottom: 12px;
        }

        .search-bar-wrap input {
            padding-top: 10px;
            padding-bottom: 10px;
            border-color: #e3e5ec;
            border-radius: 10px;
            box-shadow: none;
            font-size: .85rem;
        }

        .category-list {
            gap: 7px;
            padding: 0;
        }

        .category-button {
            padding: 7px 13px;
            border-color: #e8e9ef;
            font-size: .78rem;
            box-shadow: none;
        }

        .category-button.active {
            background: #a40e36;
        }

        .section-title {
            margin: 0 0 10px;
            font-size: 1rem;
        }

        .menu-grid {
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 9px;
        }

        .menu-card {
            border-color: #e9eaf0;
            border-radius: 11px;
            box-shadow: 0 2px 8px rgba(31, 41, 55, .045);
        }

        .menu-image-wrap {
            aspect-ratio: 1.75 / 1;
            border-bottom: 0;
        }

        .menu-content {
            padding: 8px 9px 9px;
        }

        .menu-category {
            align-self: flex-start;
            margin: 0 0 4px;
            padding: 3px 7px;
            border-radius: 999px;
            background: #dcfce7;
            color: #16803c;
            font-size: .58rem;
            letter-spacing: 0;
            text-transform: none;
        }

        .menu-name {
            margin-bottom: 3px;
            font-size: .81rem;
        }

        .menu-description {
            display: none;
        }

        .menu-footer {
            padding-top: 6px;
            border-top: 0;
        }

        .menu-price {
            color: #20242b;
            font-size: .79rem;
        }

        .menu-add-btn {
            width: auto;
            height: 29px;
            padding: 0 9px;
            border-radius: 7px;
            font-size: .72rem;
        }

        .menu-add-btn:not(:disabled) {
            width: auto;
        }

        .menu-add-btn:not(:disabled)::after {
            content: "Tambah";
            margin-left: 5px;
            font-weight: 700;
        }

        .cart-sidebar {
            position: sticky;
            top: 76px;
            max-height: calc(100vh - 90px);
            padding: 15px;
        }

        .cart-header h2 {
            font-size: .98rem;
        }

        .cart-clear-btn {
            font-size: .7rem;
        }

        .cart-items-wrap {
            max-height: 45vh;
        }

        @media (max-width: 1120px) {
            .food-master-layout {
                grid-template-columns: minmax(0, 1fr) 290px;
            }

            .menu-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {
            main {
                padding: 14px 14px 36px;
            }

            .food-master-layout {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .hero {
                min-height: 145px;
                padding: 20px 18px;
                background-position: center, 62% center, center;
            }

            .hero h1 {
                font-size: 1.5rem;
            }

            .catalog-section {
                padding: 11px;
            }

            .menu-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 9px;
            }

            .cart-sidebar {
                position: static;
                max-height: none;
            }
        }

        @media (max-width: 480px) {
            .hero {
                min-height: 135px;
                padding: 17px 14px;
            }

            .hero h1 {
                max-width: 230px;
                font-size: 1.35rem;
            }

            .hero p {
                max-width: 230px;
                font-size: .78rem;
            }

            .menu-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
    </style>
<?= view('layout/typography') ?>
</head>

<body>

    <!-- Header / Navbar -->
    <header class="customer-header">
        <div class="header-inner">
            <div class="brand">Kantin Merah</div>
            <div class="header-actions">
                <button class="track-btn" onclick="openCustomerStatus()">
                    <i class="fa-solid fa-receipt"></i> Pesanan
                </button>
                <button class="cart-button" onclick="scrollToCart()">
                    <i class="fa-solid fa-cart-shopping"></i> Keranjang
                    <span id="cartCountBadge" class="cart-count">0</span>
                </button>
            </div>
        </div>
    </header>

    <main>
        <!-- Hero Banner -->
        <div class="hero">
            <div class="hero-copy">
                <span class="hero-kicker">Self-Service Kantin Kampus</span>
                <h1>Kantin Merah POS</h1>
                <p>Pesan makanan favoritmu dengan lebih mudah!</p>
                <span class="hero-location"><i class="fa-solid fa-location-dot" aria-hidden="true"></i> UNP Kampus 1</span>
            </div>
        </div>

        <!-- Layout Utama -->
        <div class="food-master-layout">
            
            <!-- SISI KIRI: KATALOG MENU -->
            <section class="catalog-section">
                <div class="catalog-tools">
                    <div class="search-bar-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                        <input type="text" id="searchInput" onkeyup="filterSearch()" placeholder="Cari menu...">
                    </div>

                    <div class="category-list">
                        <button onclick="filterKategori('semua')" class="category-button active">Semua</button>
                        <?php if (!empty($kategori)): ?>
                            <?php foreach ($kategori as $kat): ?>
                                <button onclick="filterKategori('<?= $kat['id_kategori'] ?>')" class="category-button">
                                    <?= esc($kat['nama_kategori']) ?>
                                </button>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <h2 class="section-title">Menu Kantin</h2>
                <div class="menu-grid" id="menuGridContainer">
                    <?php if (!empty($menu)): ?>
                        <?php foreach ($menu as $item): ?>
                            <?php 
                                $fotoUrl = !empty($item['foto']) ? $item['foto'] : '';
                            ?>
                            <div class="menu-card <?= $item['status_stok'] === 'Habis' ? 'menu-card-habis' : '' ?>" 
                                 data-kategori="<?= $item['id_kategori'] ?>" 
                                 data-nama="<?= strtolower(esc($item['nama_menu'])) ?>">
                                <div class="menu-image-wrap">
                                    <?php if (!empty($fotoUrl)): ?>
                                        <img src="<?= esc($fotoUrl) ?>" 
                                             alt="<?= esc($item['nama_menu']) ?>" 
                                             class="menu-image"
                                             loading="lazy"
                                             onerror="this.style.display='none'; if(this.nextElementSibling) this.nextElementSibling.style.display='flex';">
                                        <div class="menu-image-placeholder" style="display: none;">
                                            <i class="fa-solid fa-utensils"></i>
                                            <span><?= esc($item['nama_menu']) ?></span>
                                        </div>
                                    <?php else: ?>
                                        <div class="menu-image-placeholder">
                                            <i class="fa-solid fa-utensils"></i>
                                            <span><?= esc($item['nama_menu']) ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="menu-content">
                                    <?php if ($item['status_stok'] === 'Habis'): ?>
                                        <span class="menu-habis-badge">Stok Habis</span>
                                    <?php else: ?>
                                        <div class="menu-category">Tersedia</div>
                                    <?php endif; ?>
                                    
                                    <h3 class="menu-name"><?= esc($item['nama_menu']) ?></h3>
                                    <p class="menu-description"><?= esc($item['deskripsi'] ?? 'Sajian khas Kantin Merah yang lezat dan higienis.') ?></p>
                                    
                                    <div class="menu-footer">
                                        <span class="menu-price">Rp <?= number_format($item['harga'], 0, ',', '.') ?></span>
                                        <?php if ($item['status_stok'] !== 'Habis'): ?>
                                            <button onclick="addToCart(<?= $item['id_menu'] ?>, '<?= esc($item['nama_menu'], 'js') ?>', <?= (float)$item['harga'] ?>, '<?= esc($fotoUrl, 'js') ?>')" class="menu-add-btn" title="Tambah ke Keranjang">+</button>
                                        <?php else: ?>
                                            <button disabled class="menu-add-btn" title="Stok Habis">×</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="empty-state" style="grid-column: span 3;">Belum ada menu tersedia saat ini.</div>
                    <?php endif; ?>
                </div>
            </section>

            <!-- SISI KANAN: MY CART SIDEBAR -->
            <aside class="cart-sidebar" id="cartSidebarAnchor">
                <div class="cart-header">
                    <h2>Keranjang Saya</h2>
                    <button class="cart-clear-btn" onclick="clearCart()">Hapus Semua</button>
                </div>

                <div class="cart-items-wrap" id="cartItemsContainer">
                    <div style="text-align: center; color: var(--ink-3); font-size: 0.85rem; padding: 30px 0;">
                        Keranjang masih kosong
                    </div>
                </div>

                <div class="cart-summary">
                    <div class="cart-summary-line">
                        <span>Subtotal</span>
                        <span id="subtotalText">Rp 0</span>
                    </div>
                    <div class="cart-summary-line">
                        <span>Biaya Layanan</span>
                        <span>Rp 0</span>
                    </div>
                    <div class="cart-summary-total">
                        <span>Total</span>
                        <span id="totalText" style="color: var(--brand-1);">Rp 0</span>
                    </div>

                    <button onclick="openCheckoutModal()" id="btnCheckout" disabled class="checkout-btn">
                        Lanjut ke Pembayaran
                    </button>
                </div>
            </aside>

        </div>
    </main>

    <!-- MODAL CHECKOUT -->
    <div id="checkoutModal" class="modal-overlay">
        <div class="modal-card">
            <button class="modal-close" onclick="closeCheckoutModal()">×</button>
            <h3 class="section-title" style="margin-bottom: 4px;">Konfirmasi Pesanan</h3>
            <p style="font-size: 0.82rem; color: var(--ink-3); margin-bottom: 18px;">Masukkan identitas pemesan dan pilih meja.</p>

            <form id="checkoutForm" onsubmit="submitOrder(event)">
                <div class="form-group">
                    <label>Nama Pemesan / Mahasiswa</label>
                    <input type="text" id="namaCustomer" required placeholder="Contoh: Rivaldo / Budi">
                </div>

                <div class="form-group">
                    <label>Nomor Meja</label>
                    <select id="nomorMeja" required>
                        <option value="">-- Pilih Meja --</option>
                        <option value="Meja 01">Meja 01</option>
                        <option value="Meja 02">Meja 02</option>
                        <option value="Meja 03">Meja 03</option>
                        <option value="Meja 04">Meja 04</option>
                        <option value="Meja 05">Meja 05</option>
                        <option value="Meja 06">Meja 06</option>
                        <option value="Meja 07">Meja 07</option>
                        <option value="Meja 08">Meja 08</option>
                        <option value="Bungkus">Bungkus (Take Away)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Metode Pembayaran</label>
                    <div class="checkout-method-options">
                        <label class="checkout-method-option active" onclick="selectMethod('Tunai')">
                            <input type="radio" name="metodeBayar" value="Tunai" checked>
                            <span style="font-size: 0.85rem; font-weight: 700;">Tunai (Kasir)</span>
                        </label>
                        <label class="checkout-method-option" onclick="selectMethod('QRIS')">
                            <input type="radio" name="metodeBayar" value="QRIS">
                            <span style="font-size: 0.85rem; font-weight: 700;">QRIS Instant</span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="checkout-btn" style="margin-top: 10px;">Buat Pesanan Sekarang</button>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT KONTROL & REAL-TIME POLLING -->
    <script>
        let cart = JSON.parse(localStorage.getItem('kantin_merah_cart')) || [];

        document.addEventListener('DOMContentLoaded', () => {
            renderCart();
        });

        function addToCart(id, nama, harga, foto) {
            const index = cart.findIndex(item => item.id_menu === id);
            if (index > -1) {
                cart[index].jumlah += 1;
            } else {
                cart.push({ id_menu: id, nama_menu: nama, harga: harga, foto: foto, jumlah: 1, catatan_khusus: '' });
            }
            saveCart();
        }

        function saveCart() {
            localStorage.setItem('kantin_merah_cart', JSON.stringify(cart));
            renderCart();
        }

        function updateQuantity(id, change) {
            const index = cart.findIndex(item => item.id_menu === id);
            if (index > -1) {
                cart[index].jumlah += change;
                if (cart[index].jumlah <= 0) cart.splice(index, 1);
            }
            saveCart();
        }

        function updateCatatan(id, text) {
            const index = cart.findIndex(item => item.id_menu === id);
            if (index > -1) {
                cart[index].catatan_khusus = text;
                localStorage.setItem('kantin_merah_cart', JSON.stringify(cart));
            }
        }

        function clearCart() {
            cart = [];
            saveCart();
        }

        function renderCart() {
            const container = document.getElementById('cartItemsContainer');
            const subtotalText = document.getElementById('subtotalText');
            const totalText = document.getElementById('totalText');
            const btnCheckout = document.getElementById('btnCheckout');
            const badgeCount = document.getElementById('cartCountBadge');

            badgeCount.innerText = cart.reduce((sum, item) => sum + item.jumlah, 0);

            if (cart.length === 0) {
                container.innerHTML = `<div style="text-align: center; color: var(--ink-3); font-size: 0.85rem; padding: 30px 0;">Keranjang masih kosong</div>`;
                subtotalText.innerText = 'Rp 0';
                totalText.innerText = 'Rp 0';
                btnCheckout.disabled = true;
                return;
            }

            let html = '';
            let total = 0;

            cart.forEach(item => {
                total += item.harga * item.jumlah;
                const fotoHtml = item.foto 
                    ? `<img src="${item.foto}" class="cart-item-img" alt="${item.nama_menu}" onerror="this.outerHTML='<div class=\\'cart-item-img-placeholder\\'><i class=\\'fa-solid fa-utensils\\'></i></div>'">`
                    : `<div class="cart-item-img-placeholder"><i class="fa-solid fa-utensils"></i></div>`;
                html += `
                    <div class="cart-item-row">
                        ${fotoHtml}
                        <div class="cart-item-details">
                            <div class="cart-item-title">${item.nama_menu}</div>
                            <div class="cart-item-price">Rp ${item.harga.toLocaleString('id-ID')}</div>
                            <input type="text" class="cart-item-note-input" placeholder="Catatan (mis: tidak pedas)" 
                                   value="${item.catatan_khusus || ''}" onchange="updateCatatan(${item.id_menu}, this.value)">
                        </div>
                        <div class="cart-item-qty-control">
                            <button class="cart-qty-btn" onclick="updateQuantity(${item.id_menu}, -1)">-</button>
                            <span class="cart-qty-num">${item.jumlah}</span>
                            <button class="cart-qty-btn" onclick="updateQuantity(${item.id_menu}, 1)">+</button>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
            subtotalText.innerText = `Rp ${total.toLocaleString('id-ID')}`;
            totalText.innerText = `Rp ${total.toLocaleString('id-ID')}`;
            btnCheckout.disabled = false;
        }

        function filterKategori(kat) {
            document.querySelectorAll('.category-button').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            document.querySelectorAll('.menu-card').forEach(card => {
                card.style.display = (kat === 'semua' || card.dataset.kategori === kat) ? 'flex' : 'none';
            });
        }

        function filterSearch() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('.menu-card').forEach(card => {
                card.style.display = (card.dataset.nama || '').includes(query) ? 'flex' : 'none';
            });
        }

        function scrollToCart() {
            document.getElementById('cartSidebarAnchor').scrollIntoView({ behavior: 'smooth' });
        }

        function openCheckoutModal() { document.getElementById('checkoutModal').style.display = 'flex'; }
        function closeCheckoutModal() { document.getElementById('checkoutModal').style.display = 'none'; }

        function selectMethod(method) {
            document.querySelectorAll('.checkout-method-option').forEach(el => el.classList.remove('active'));
            event.currentTarget.classList.add('active');
        }

        async function submitOrder(e) {
            e.preventDefault();
            const metodePilihan = document.querySelector('input[name="metodeBayar"]:checked').value;
            const payload = {
                nama_customer: document.getElementById('namaCustomer').value,
                nomor_meja: document.getElementById('nomorMeja').value,
                metode: metodePilihan,
                metode_bayar: metodePilihan,
                items: cart
            };

            try {
                const response = await fetch('<?= base_url('customer/checkout') ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });
                const result = await response.json();

                if (response.ok && result && result.status === true) {
                    cart = [];
                    saveCart();

                    const kode = result.kode_pesanan || (result.data ? result.data.kode_pesanan : null) || result.id_pesanan;
                    if (kode) {
                        // Simpan ke storage yang dibaca oleh status.php
                        localStorage.setItem('kantin_merah_last_order', JSON.stringify({ kode_pesanan: kode }));
                    }

                    // Tutup modal checkout dan buka modal status pesanan
                    closeCheckoutModal();
                    if (typeof openCustomerStatus === 'function') {
                        openCustomerStatus(kode);
                    }
                } else {
                    alert((result && result.message) ? result.message : 'Gagal membuat pesanan.');
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan koneksi jaringan.');
            }
        }

    </script>
<?= view('customer/status') ?>
</body>
</html>
