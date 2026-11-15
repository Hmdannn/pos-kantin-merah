<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Kantin Merah</title>

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
            --success: var(--km-success);
            --success-soft: var(--km-success-bg);
            --warning: var(--km-warning);
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
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(166, 103, 92, 0.12), transparent 32%),
                linear-gradient(180deg, #faf7f4 0%, #f5f0eb 100%);
            color: var(--ink-1);
        }

        button {
            font-family: inherit;
            cursor: pointer;
        }

        .customer-header {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(122, 43, 34, 0.08);
            box-shadow: 0 8px 25px rgba(31, 41, 55, 0.04);
        }

        .header-inner {
            max-width: 1220px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 18px 24px;
        }

        .brand {
            font-size: 1.5rem;
            font-weight: 900;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--brand-1);
        }

        .cart-button {
            position: relative;
            border: none;
            background: linear-gradient(135deg, var(--brand-1) 0%, var(--brand-2) 100%);
            color: white;
            padding: 12px 20px;
            border-radius: 999px;
            font-weight: 700;
            letter-spacing: 0.02em;
            box-shadow: 0 12px 25px rgba(122, 43, 34, 0.22);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .cart-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 30px rgba(122, 43, 34, 0.28);
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            min-width: 22px;
            height: 22px;
            padding: 0 6px;
            border-radius: 50%;
            background: #101827;
            color: #fff;
            border: 2px solid #fff;
            font-size: 11px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        main {
            max-width: 1220px;
            margin: 0 auto;
            padding: 30px 24px 54px;
        }

        .hero {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #4d1f1a 0%, #7a2b22 44%, #a53f33 100%);
            border-radius: 28px;
            color: #fff;
            padding: 36px 32px;
            margin-bottom: 30px;
            box-shadow: var(--shadow-strong);
        }

        .hero::before {
            content: "";
            position: absolute;
            right: -60px;
            top: -45px;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.09);
        }

        .hero::after {
            content: "";
            position: absolute;
            left: 45%;
            bottom: -130px;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
        }

        .hero h1,
        .hero p {
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: clamp(2.2rem, 3vw, 3.1rem);
            line-height: 1.1;
            margin-bottom: 10px;
            letter-spacing: -0.05em;
            font-weight: 900;
        }

        .hero p {
            font-size: 1.02rem;
            max-width: 540px;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
        }

        section {
            margin-bottom: 28px;
        }

        .section-title {
            font-size: clamp(1.45rem, 2vw, 2rem);
            margin-bottom: 16px;
            color: var(--ink-1);
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .category-list {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            padding: 6px 2px 14px;
            margin-bottom: 8px;
            scrollbar-width: thin;
        }

        .category-button {
            flex-shrink: 0;
            border: 1px solid var(--line);
            background: rgba(255, 255, 255, 0.7);
            color: var(--ink-2);
            padding: 11px 18px;
            border-radius: 999px;
            font-weight: 700;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(31, 41, 55, 0.04);
        }

        .category-button.active {
            background: linear-gradient(135deg, var(--brand-1) 0%, var(--brand-2) 100%);
            border-color: transparent;
            color: #fff;
            box-shadow: 0 12px 22px rgba(122, 43, 34, 0.2);
        }

        .menu-header-row,
        .ready-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
        }

        .menu-header-row .section-title,
        .ready-header .section-title {
            margin-bottom: 0;
        }

        .ready-refresh {
            border: 1px solid rgba(122, 43, 34, 0.2);
            background: #fff;
            color: var(--brand-1);
            font-weight: 700;
            padding: 10px 16px;
            border-radius: 999px;
            transition: all 0.2s ease;
        }

        .ready-refresh:hover {
            background: var(--brand-4);
        }

        .ready-hint {
            color: var(--ink-3);
            font-size: 0.95rem;
            margin-bottom: 16px;
        }

        .menu-grid,
        .ready-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 18px;
        }

        .menu-card,
        .ready-card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 20px;
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .menu-card:hover,
        .ready-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 38px rgba(98, 62, 52, 0.08);
        }

        .menu-image {
            width: 100%;
            aspect-ratio: 4 / 3;
            object-fit: cover;
            display: block;
            background: #efeae6;
            border-bottom: 1px solid var(--line);
        }

        .menu-content {
            padding: 16px 16px 18px;
        }

        .menu-category {
            color: var(--ink-3);
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .menu-name {
            color: var(--ink-1);
            font-size: 1.15rem;
            font-weight: 800;
            margin-bottom: 8px;
            line-height: 1.35;
        }

        .menu-description {
            color: var(--ink-3);
            font-size: 0.78rem;
            line-height: 1.5;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .menu-price {
            color: var(--brand-1);
            font-weight: 800;
            font-size: 1.08rem;
            margin-bottom: 6px;
        }

        .menu-stock {
            color: var(--ink-3);
            font-size: 0.76rem;
            margin-bottom: 14px;
            font-weight: 600;
        }

        .menu-detail-button,
        .ready-detail-button {
            width: 100%;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--brand-1) 0%, var(--brand-2) 100%);
            color: #fff;
            padding: 11px 12px;
            font-weight: 800;
            letter-spacing: 0.01em;
            box-shadow: 0 10px 18px rgba(122, 43, 34, 0.18);
            transition: transform 0.2s ease, filter 0.2s ease;
        }

        .menu-detail-button:hover:not(:disabled),
        .ready-detail-button:hover {
            transform: translateY(-1px);
            filter: brightness(1.02);
        }

        .menu-detail-button:disabled {
            background: #dfe7ee;
            color: #8a98a9;
            box-shadow: none;
            cursor: not-allowed;
        }

        .menu-card-habis .menu-image {
            filter: grayscale(0.7) saturate(0.8);
            opacity: 0.7;
        }

        .menu-habis-badge {
            display: inline-block;
            margin-bottom: 8px;
            background: #fee2e2;
            color: #991b1b;
            padding: 4px 8px;
            border-radius: 999px;
            font-size: 0.66rem;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .ready-card {
            padding: 16px;
            border-left: 4px solid var(--brand-1);
        }

        .ready-card-mine {
            border-left-color: var(--success);
            box-shadow: 0 18px 36px rgba(32, 36, 43, 0.08);
        }

        .ready-card-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
        }

        .ready-code {
            color: var(--brand-1);
            font-weight: 900;
            letter-spacing: 0.05em;
            overflow-wrap: anywhere;
        }

        .ready-badge {
            background: var(--success-soft);
            color: var(--success);
            border-radius: 999px;
            padding: 4px 8px;
            font-size: 0.64rem;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .ready-total {
            font-size: 1.15rem;
            font-weight: 800;
            margin-bottom: 4px;
            color: var(--ink-1);
        }

        .ready-time {
            color: var(--ink-3);
            font-size: 0.74rem;
            margin-bottom: 12px;
        }

        .loading,
        .empty-state {
            border: 1px solid var(--line);
            background: rgba(255, 255, 255, 0.7);
            border-radius: 20px;
            padding: 42px 20px;
            text-align: center;
            color: var(--ink-3);
            font-weight: 600;
            box-shadow: var(--shadow-soft);
        }

        .error-message {
            background: #fff1f2;
            color: #9f1239;
            border: 1px solid #fecdd3;
            border-radius: 14px;
            padding: 14px 16px;
            margin-bottom: 18px;
            font-weight: 600;
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
            transition: all 0.2s ease;
        }

        .checkout-method-option input {
            width: auto;
            accent-color: var(--brand-1);
        }

        .checkout-method-option.active {
            border-color: var(--brand-1);
            background: var(--brand-4);
        }

        .checkout-method-info {
            margin-top: 10px;
            padding: 12px 14px;
            background: var(--panel-soft);
            border: 1px solid var(--line);
            border-radius: 10px;
            font-size: 13px;
            color: var(--ink-3);
            line-height: 1.5;
        }

        .ready-toast {
            display: none;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2700;
            width: min(460px, calc(100% - 24px));
            background: var(--km-success);
            color: white;
            box-shadow: var(--km-success-shadow);
            border-radius: 16px;
            padding: 14px 16px;
        }

        .ready-toast strong {
            display: block;
            font-size: 0.96rem;
            margin-bottom: 4px;
        }

        .ready-toast span {
            font-size: 0.8rem;
            opacity: 0.96;
        }

        @media (max-width: 720px) {
            .header-inner {
                padding: 14px 16px;
            }

            .brand {
                font-size: 1.1rem;
                letter-spacing: 0.08em;
            }

            main {
                padding: 20px 16px 36px;
            }

            .hero {
                border-radius: 22px;
                padding: 26px 20px;
            }

            .menu-grid,
            .ready-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .menu-content {
                padding: 12px;
            }

            .menu-name {
                font-size: 1rem;
            }

            .menu-price {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .menu-grid,
            .ready-grid {
                grid-template-columns: 1fr;
            }

            .header-inner {
                gap: 12px;
            }

            .cart-button {
                padding: 10px 16px;
                font-size: 0.85rem;
            }
        }

        .qris-demo-card {
            background: #ffffff;
            border: 1px solid var(--km-border);
            border-radius: 14px;
            padding: 14px;
            text-align: center;
            box-shadow: 0 4px 14px rgba(32, 36, 43, 0.06);
        }
        .qris-demo-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 6px;
        }
        .qris-demo-logo {
            color: var(--km-brand);
            font-size: 20px;
            font-weight: 900;
            letter-spacing: 1px;
            font-style: italic;
        }
        .qris-demo-badge {
            background: var(--km-brand-soft);
            border: 1px solid var(--km-border);
            border-radius: 9999px;
            color: var(--km-brand);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.5px;
            padding: 3px 8px;
        }
        .qris-demo-merchant {
            color: #111827;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 0.3px;
        }
        .qris-demo-sub {
            color: #6b7280;
            font-size: 11px;
            margin: 2px 0 8px;
        }
        .qris-demo-image-wrap {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            display: inline-block;
            margin-bottom: 8px;
            padding: 8px;
        }
        .qris-demo-image-wrap img {
            border-radius: 6px;
            display: block;
            height: auto;
            max-width: 100%;
            width: 160px;
        }
        .qris-demo-amount-label {
            color: #6b7280;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }
        .qris-demo-amount {
            color: #111827;
            font-size: 20px;
            font-weight: 900;
            margin-bottom: 4px;
        }
        .qris-demo-meta {
            color: #4b5563;
            font-size: 12px;
            margin-bottom: 8px;
        }
        .qris-demo-meta strong {
            color: #111827;
        }
        .qris-demo-divider {
            border-top: 1px dashed #d1d5db;
            margin: 8px 0;
        }
        .qris-demo-status {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 8px;
            color: #b45309;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 6px;
            padding: 6px 8px;
        }
        .qris-demo-status.paid {
            background: var(--km-success-bg);
            border-color: var(--km-success-border);
            color: var(--km-success);
        }
        .qris-demo-paid-note {
            color: #374151;
            font-size: 12px;
            margin-bottom: 6px;
        }
        .qris-demo-demo-note {
            color: #9ca3af;
            font-size: 9px;
            line-height: 1.4;
            margin-top: 6px;
        }

        body {
            background:
                radial-gradient(ellipse at 86% 6%, rgba(159, 18, 57, 0.04), transparent 34rem),
                var(--km-bg);
            color: var(--ink-1);
        }

        .customer-header {
            background: rgba(250, 250, 244, 0.96);
            border-bottom: 1px solid var(--km-border);
            box-shadow: 0 3px 14px rgba(32, 36, 43, 0.04);
            backdrop-filter: blur(12px);
        }

        .header-inner,
        main {
            max-width: 1280px;
        }

        .header-inner {
            min-height: 68px;
            padding: 12px 30px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--km-brand);
            font-size: 1.08rem;
            letter-spacing: 0.105em;
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

        .cart-button {
            border-radius: 10px;
            background: var(--km-brand);
            padding: 11px 18px;
            box-shadow: 0 5px 12px rgba(32, 36, 43, 0.12);
        }

        .cart-button:hover {
            box-shadow: 0 8px 18px rgba(32, 36, 43, 0.16);
        }

        .cart-count {
            background: var(--km-brand);
            color: #ffffff;
            border-color: var(--km-surface);
        }

        main {
            padding: 30px 30px 64px;
        }

        .hero {
            min-height: 210px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 32px;
            overflow: hidden;
            position: relative;
            padding: 36px 44px;
            margin-bottom: 28px;
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 18px 18px 18px 5px;
            background:
                linear-gradient(112deg, #881337 0%, #9f1239 62%, #b4234d 100%);
            box-shadow: 0 16px 34px rgba(32, 36, 43, .15);
        }

        .hero-copy {
            max-width: 620px;
            position: relative;
            z-index: 2;
        }

        .hero-kicker {
            display: block;
            margin-bottom: 14px;
            color: #ffe4e6;
            font-size: .72rem;
            font-weight: 800;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        .hero h1 {
            margin-bottom: 10px;
            font-size: clamp(2rem, 3.2vw, 2.8rem);
            line-height: 1.04;
            letter-spacing: -.045em;
        }

        .hero p {
            max-width: 440px;
            color: rgba(249, 249, 237, .83);
            font-size: .98rem;
            line-height: 1.55;
        }

        .hero-art {
            width: 250px;
            height: 150px;
            flex: 0 0 250px;
            position: relative;
            margin-right: 10px;
            border: 1px solid rgba(239, 238, 210, .23);
            border-radius: 48% 42% 14px 14px;
            background: rgba(239, 238, 210, .08);
            transform: rotate(-4deg);
        }

        .hero-art::before {
            content: "";
            position: absolute;
            inset: 20px 24px 24px;
            border: 7px solid #e6dfbb;
            border-radius: 50%;
            box-shadow: inset 0 0 0 2px rgba(159, 18, 57, .32), 0 10px 18px rgba(32, 36, 43, .2);
        }

        .hero-art::after {
            content: "";
            position: absolute;
            top: 45px;
            left: 91px;
            width: 55px;
            height: 40px;
            border-radius: 50%;
            background:
                radial-gradient(ellipse at 30% 35%, #e8c45b 0 7px, transparent 8px),
                radial-gradient(ellipse at 62% 40%, #9f1239 0 9px, transparent 10px),
                radial-gradient(ellipse at 52% 72%, #bd7554 0 8px, transparent 9px),
                #f5eacb;
            box-shadow: 0 0 0 5px rgba(159, 18, 57, .18);
        }

        section {
            margin-bottom: 28px;
        }

        .section-title {
            color: var(--km-text);
            font-size: clamp(1.25rem, 2vw, 1.65rem);
            letter-spacing: -.035em;
        }

        .ready-section {
            padding: 21px 23px 23px;
            border: 1px solid var(--km-border);
            border-radius: 14px 14px 14px 4px;
            background: var(--km-surface-muted);
        }

        .ready-section .section-title::before {
            content: "";
            display: inline-block;
            width: 9px;
            height: 9px;
            margin: 0 10px 3px 0;
            border-radius: 50%;
            background: var(--km-success);
            box-shadow: 0 0 0 4px var(--km-success-ring);
        }

        .ready-hint {
            max-width: 700px;
            margin-bottom: 15px;
            color: var(--km-muted);
            font-size: .89rem;
        }

        .ready-refresh {
            border: 1px solid var(--km-border);
            border-radius: 8px;
            background: var(--km-surface);
            color: var(--km-brand);
            padding: 9px 13px;
        }

        .ready-refresh:hover {
            background: var(--km-surface-muted);
        }

        .loading,
        .empty-state {
            border-color: var(--km-border);
            border-radius: 11px;
            background: var(--km-surface-muted);
            color: var(--km-muted);
            box-shadow: none;
        }

        .ready-section .loading,
        .ready-section .empty-state {
            padding: 22px 18px;
        }

        .catalog-layout {
            display: grid;
            grid-template-columns: 196px minmax(0, 1fr);
            align-items: start;
            gap: 34px;
        }

        .category-section {
            position: sticky;
            top: 94px;
            margin-bottom: 0;
        }

        .category-section .section-title {
            margin: 4px 0 13px;
            font-size: .8rem;
            color: var(--km-muted);
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .category-list {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 5px;
            overflow: visible;
            padding: 0;
            margin: 0;
        }

        .category-button {
            min-height: 42px;
            text-align: left;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 8px;
            background: transparent;
            color: #475467;
            box-shadow: none;
            font-size: .9rem;
        }

        .category-button:hover {
            background: var(--km-brand-soft);
            color: var(--km-brand);
        }

        .category-button.active {
            border-color: var(--km-brand-soft);
            background: var(--km-brand-soft);
            color: var(--km-brand);
            box-shadow: inset 3px 0 var(--km-brand);
        }

        .menu-section {
            min-width: 0;
            margin-bottom: 0;
        }

        .menu-header-row {
            margin-bottom: 18px;
        }

        .menu-header-row .section-title {
            margin: 0;
        }

        .menu-grid,
        .ready-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .menu-card,
        .ready-card {
            border: 1px solid var(--km-border);
            border-radius: 12px 12px 12px 4px;
            background: var(--km-surface);
            box-shadow: 0 5px 16px rgba(32, 36, 43, .045);
        }

        .menu-card:hover,
        .ready-card:hover {
            transform: translateY(-2px);
            border-color: var(--km-border);
            box-shadow: 0 10px 22px rgba(32, 36, 43, .09);
        }

        .menu-image {
            aspect-ratio: 1.38 / 1;
            border-bottom: 0;
            background: var(--km-surface-muted);
        }

        .menu-content {
            padding: 15px 16px 16px;
        }

        .menu-category {
            margin-bottom: 7px;
            color: var(--km-muted);
            font-size: .66rem;
            letter-spacing: .12em;
        }

        .menu-name {
            min-height: 2.6em;
            margin-bottom: 6px;
            color: var(--km-text);
            font-size: 1.05rem;
            line-height: 1.3;
        }

        .menu-description {
            min-height: 2.85em;
            margin-bottom: 12px;
            color: var(--km-muted);
            font-size: .81rem;
            line-height: 1.45;
        }

        .menu-price {
            margin-bottom: 5px;
            color: var(--km-brand);
            font-size: 1.02rem;
        }

        .menu-stock {
            margin-bottom: 12px;
            color: var(--km-muted);
            font-size: .73rem;
        }

        .menu-detail-button,
        .ready-detail-button {
            border-radius: 8px;
            background: var(--km-brand);
            padding: 10px 12px;
            box-shadow: none;
        }

        .menu-detail-button:hover:not(:disabled),
        .ready-detail-button:hover {
            background: var(--km-brand-hover);
            filter: none;
        }

        .menu-detail-button:disabled {
            background: #e5e7eb;
            color: var(--km-muted);
        }

        .menu-habis-badge {
            border-radius: 5px;
            background: #f7edda;
            color: #79550e;
            padding: 4px 7px;
            font-size: .62rem;
        }

        .menu-card-habis .menu-image {
            filter: grayscale(.45);
            opacity: .8;
        }

        .ready-card {
            padding: 15px;
            border-left: 3px solid var(--km-success);
        }

        .ready-card-mine {
            border-left-color: var(--km-brand);
            box-shadow: 0 5px 16px rgba(159, 18, 57, .12);
        }

        .ready-code {
            color: var(--km-brand);
        }

        .ready-badge {
            border-radius: 5px;
            background: var(--km-success-bg);
            color: var(--km-success);
        }

        .ready-total {
            color: var(--km-text);
        }

        .ready-time {
            color: var(--km-muted);
        }

        button:focus-visible {
            outline: 3px solid rgba(159, 18, 57, 0.35);
            outline-offset: 3px;
        }

        @media (max-width: 980px) {
            .catalog-layout {
                grid-template-columns: 164px minmax(0, 1fr);
                gap: 22px;
            }

            .menu-grid,
            .ready-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 14px;
            }
        }

        @media (max-width: 720px) {
            .header-inner {
                padding: 11px 18px;
            }

            main {
                padding: 22px 18px 44px;
            }

            .hero {
                min-height: 190px;
                padding: 27px 26px;
                border-radius: 15px 15px 15px 4px;
            }

            .hero-art {
                width: 180px;
                height: 130px;
                flex-basis: 180px;
                margin-right: -6px;
            }

            .hero-art::before {
                inset: 19px 16px 20px;
            }

            .hero-art::after {
                left: 63px;
            }

            .ready-section {
                padding: 18px;
            }

            .catalog-layout {
                display: block;
            }

            .category-section {
                position: static;
                margin: 0 0 22px;
            }

            .category-section .section-title {
                margin: 0 0 7px;
            }

            .category-list {
                flex-direction: row;
                align-items: center;
                gap: 8px;
                overflow-x: auto;
                padding: 3px 1px 9px;
                scrollbar-width: thin;
                -webkit-overflow-scrolling: touch;
            }

            .category-button {
                min-height: 38px;
                padding: 8px 13px;
                border-color: var(--km-border);
                background: var(--km-surface);
                text-align: center;
                white-space: nowrap;
            }

            .category-button.active {
                border-color: var(--km-brand);
                background: var(--km-brand);
                color: #fff;
                box-shadow: none;
            }
        }

        @media (max-width: 540px) {
            .header-inner {
                padding: 10px 16px;
            }

            .brand {
                font-size: .94rem;
                letter-spacing: .08em;
            }

            .brand::before {
                width: 32px;
                height: 32px;
            }

            .cart-button {
                padding: 10px 14px;
                font-size: .82rem;
            }

            main {
                padding: 18px 15px 38px;
            }

            .hero {
                min-height: 0;
                align-items: flex-start;
                padding: 24px 21px;
                margin-bottom: 20px;
            }

            .hero h1 {
                font-size: clamp(1.8rem, 8vw, 2.25rem);
            }

            .hero p {
                max-width: 255px;
                font-size: .88rem;
            }

            .hero-kicker {
                margin-bottom: 10px;
                font-size: .63rem;
            }

            .hero-art {
                position: absolute;
                width: 105px;
                height: 100px;
                right: -27px;
                bottom: -16px;
                flex: initial;
                opacity: .6;
            }

            .hero-art::before {
                inset: 13px 10px 15px;
                border-width: 5px;
            }

            .hero-art::after {
                top: 32px;
                left: 34px;
                width: 35px;
                height: 30px;
            }

            .ready-section {
                padding: 16px 14px;
                margin-bottom: 22px;
            }

            .ready-header,
            .menu-header-row {
                align-items: flex-start;
                gap: 8px;
            }

            .ready-header .section-title {
                max-width: 230px;
                font-size: 1.18rem;
            }

            .ready-refresh {
                padding: 8px 10px;
                font-size: .77rem;
            }

            .ready-hint {
                font-size: .81rem;
                line-height: 1.45;
            }

            .menu-grid,
            .ready-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 11px;
            }

            .menu-image {
                aspect-ratio: 1.15 / 1;
            }

            .menu-content {
                padding: 11px;
            }

            .menu-name {
                min-height: 0;
                font-size: .94rem;
            }

            .menu-description {
                min-height: 0;
                font-size: .74rem;
            }

            .menu-price {
                font-size: .94rem;
            }

            .menu-stock {
                font-size: .68rem;
            }

            .menu-detail-button {
                padding: 9px 7px;
                font-size: .79rem;
            }
        }

        @media (max-width: 360px) {
            .menu-grid,
            .ready-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 540px) {
            html,
            body {
                width: 100%;
                overflow-x: hidden;
            }

            .header-inner,
            main {
                width: 100%;
                min-width: 0;
            }

            .header-inner {
                gap: 10px;
            }

            .brand {
                min-width: 0;
                overflow-wrap: anywhere;
            }

            .cart-button,
            .ready-refresh,
            .category-button,
            .menu-detail-button,
            .ready-detail-button {
                min-height: 44px;
            }

            .category-list {
                max-width: 100%;
                -webkit-overflow-scrolling: touch;
                overscroll-behavior-x: contain;
            }

            .catalog-layout,
            .catalog-layout > * {
                min-width: 0;
            }

            .ready-header,
            .menu-header-row {
                flex-wrap: wrap;
            }
        }

        @media (max-width: 380px) {
            .header-inner {
                padding-right: 12px;
                padding-left: 12px;
            }

            main {
                padding-right: 12px;
                padding-left: 12px;
            }

            .brand {
                font-size: .82rem;
                letter-spacing: .05em;
            }

            .cart-button {
                padding-right: 10px;
                padding-left: 10px;
                white-space: nowrap;
            }
        }
    </style>
    <link rel="stylesheet" href="<?= base_url('assets/css/formal-ui.css') ?>">
</head>

<body>

<div
    id="readyToast"
    class="ready-toast"
    role="status"
    aria-live="polite"
>
    <strong>🔔 Makanan Siap Diambil!</strong>
    <span id="readyToastMessage">
        Silakan ambil makanan Anda di kasir.
    </span>
</div>

<header class="customer-header">

    <div class="header-inner">

        <div class="brand">
            Kantin Merah
        </div>

        <button
            type="button"
            id="cartButton"
            class="cart-button">

            Keranjang

            <span
                id="cartCount"
                class="cart-count">
                0
            </span>

        </button>

    </div>

</header>


<main>

    <section class="hero">

        <div class="hero-copy">
            <span class="hero-kicker">Santap Hari Ini · Kantin Kampus</span>
            <h1>Selamat Datang</h1>
        </div>
        <div class="hero-art" aria-hidden="true"></div>

    </section>


    <section class="ready-section">

        <div class="ready-header">

            <h2 class="section-title">
                Pesanan Siap Diambil
            </h2>

            <button
                type="button"
                id="refreshReadyOrders"
                class="ready-refresh">

                Muat Ulang

            </button>

        </div>

        <p class="ready-hint">
        Pesanan yang selesai dimasak siap diambil di kasir.
        </p>

        <div
            id="readyLoading"
            class="loading">

            Memuat pesanan siap diambil...

        </div>

        <div
            id="readyError"
            class="error-message"
            style="display: none;">

        </div>

        <div
            id="readyEmpty"
            class="empty-state"
            style="display: none;">

            Belum ada pesanan yang siap diambil.

        </div>

        <div
            id="readyGrid"
            class="ready-grid"
            style="display: none;">

        </div>

    </section>


    <div class="catalog-layout">

        <section class="category-section">

            <h2 class="section-title">
                Kategori
            </h2>

            <div
                id="categoryList"
                class="category-list">

                <button
                    type="button"
                    class="category-button active"
                    data-category-id="all">

                    Semua

                </button>

            </div>
        </section>


        <section class="menu-section">

        <div class="menu-header-row">

            <h2 class="section-title">
                Menu
            </h2>

            <button
                type="button"
                id="refreshMenu"
                class="ready-refresh">

                Muat Ulang

            </button>

        </div>

        <div
            id="menuLoading"
            class="loading">

            Memuat menu...

        </div>

        <div
            id="menuError"
            class="error-message"
            style="display: none;">

        </div>

        <div
            id="menuEmpty"
            class="empty-state"
            style="display: none;">

            Tidak ada menu tersedia.

        </div>

        <div
            id="menuGrid"
            class="menu-grid"
            style="display: none;">

        </div>

        </section>

    </div>

</main>


<script>

    const CUSTOMER_API =
        <?= json_encode(site_url('customer')) ?>;

    const MENU_API =
        <?= json_encode(site_url('customer/menu')) ?>;

    const CATEGORY_API =
        <?= json_encode(site_url('customer/kategori')) ?>;

    const READY_ORDERS_API =
        <?= json_encode(site_url('customer/pesanan-siap')) ?>;

    const CUSTOMER_ORDER_API =
        <?= json_encode(site_url('customer/pesanan')) ?>;

    const CART_STORAGE_KEY =
        'kantin_merah_cart';

    const LAST_ORDER_STORAGE_KEY =
        'kantin_merah_last_order';

    const READY_NOTIFIED_STORAGE_KEY =
        'kantin_merah_ready_notified';


    let customerData = {
        menu: [],
        kategori: []
    };


    const menuGrid =
        document.getElementById('menuGrid');

    const menuLoading =
        document.getElementById('menuLoading');

    const menuEmpty =
        document.getElementById('menuEmpty');

    const menuError =
        document.getElementById('menuError');

    const categoryList =
        document.getElementById('categoryList');


    function formatRupiah(value)
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


    function getCart()
    {
        try {

            const cart =
                localStorage.getItem(
                    CART_STORAGE_KEY
                );

            if (!cart) {
                return [];
            }

            const parsed =
                JSON.parse(cart);

            return Array.isArray(parsed)
                ? parsed
                : [];

        } catch (error) {

            return [];

        }
    }


    function updateCartCount()
    {
        const cart =
            getCart();

        const total =
            cart.reduce(
                function (sum, item) {

                    return sum +
                        Number(item.jumlah || 0);

                },
                0
            );

        const cartCount =
            document.getElementById(
                'cartCount'
            );

        if (cartCount) {

            cartCount.textContent =
                total;

        }
    }


    function showMenuLoading()
    {
        menuLoading.style.display =
            'block';

        menuGrid.style.display =
            'none';

        menuEmpty.style.display =
            'none';

        menuError.style.display =
            'none';
    }


    function showMenuError(message)
    {
        menuLoading.style.display =
            'none';

        menuGrid.style.display =
            'none';

        menuEmpty.style.display =
            'none';

        menuError.textContent =
            message;

        menuError.style.display =
            'block';
    }


    function renderCategories()
    {
        categoryList.innerHTML = '';

        const allButton =
            document.createElement('button');

        allButton.type = 'button';

        allButton.className =
            'category-button active';

        allButton.dataset.categoryId =
            'all';

        allButton.textContent =
            'Semua';

        categoryList.appendChild(
            allButton
        );


        customerData.kategori.forEach(
            function (kategori) {

                const button =
                    document.createElement(
                        'button'
                    );

                button.type = 'button';

                button.className =
                    'category-button';

                button.dataset.categoryId =
                    kategori.id_kategori;

                button.textContent =
                    kategori.nama_kategori;

                categoryList.appendChild(
                    button
                );

            }
        );
    }


    function renderMenu(menu)
    {
        menuLoading.style.display =
            'none';

        menuError.style.display =
            'none';


        if (!menu || menu.length === 0) {

            menuGrid.innerHTML = '';

            menuGrid.style.display =
                'none';

            menuEmpty.style.display =
                'block';

            return;
        }


        menuEmpty.style.display =
            'none';

        menuGrid.style.display =
            'grid';

        menuGrid.innerHTML = '';


        menu.forEach(
            function (item) {

                const habis =
                    item.status_stok !== 'Tersedia' ||
                    Number(item.jumlah_stok) <= 0;

                const card =
                    document.createElement(
                        'div'
                    );

                card.className = habis
                    ? 'menu-card menu-card-habis'
                    : 'menu-card';


                let imageHtml = '';

                if (item.foto) {

                    imageHtml = `
                        <img
                            src="${escapeHtml(
                                item.foto
                            )}"
                            alt="${escapeHtml(
                                item.nama_menu
                            )}"
                            class="menu-image"
                        >
                    `;

                } else {

                    imageHtml = `
                        <div
                            class="menu-image"
                            style="
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                color:#999;
                            "
                        >
                            Tidak ada foto
                        </div>
                    `;

                }


                card.innerHTML = `

                    ${imageHtml}

                    <div class="menu-content">

                        <div class="menu-category">
                            ${escapeHtml(
                                item.nama_kategori ||
                                ''
                            )}
                        </div>

                        <div class="menu-name">
                            ${escapeHtml(
                                item.nama_menu
                            )}
                        </div>

                        ${item.deskripsi ? `
                            <div class="menu-description">
                                ${escapeHtml(
                                    item.deskripsi
                                )}
                            </div>
                        ` : ''}

                        <div class="menu-price">
                            ${formatRupiah(
                                item.harga
                            )}
                        </div>

                        ${habis ? `
                            <div class="menu-habis-badge">
                                Stok Habis
                            </div>
                        ` : ''}

                        <div class="menu-stock">
                            ${habis
                                ? 'Menu sedang tidak tersedia.'
                                : `Stok: ${Number(item.jumlah_stok)}`}
                        </div>

                        <button
                            type="button"
                            class="menu-detail-button"
                            data-menu-id="${Number(
                                item.id_menu
                            )}"
                            ${habis ? 'disabled' : ''}
                        >
                            ${habis ? 'Stok Habis' : 'Lihat Detail'}
                        </button>

                    </div>

                `;


                menuGrid.appendChild(
                    card
                );

            }
        );
    }


    function escapeHtml(value)
    {
        const div =
            document.createElement('div');

        div.textContent =
            value ?? '';

        return div.innerHTML;
    }


    async function loadCustomerData()
    {
        showMenuLoading();

        try {

            const response =
                await fetch(
                    CUSTOMER_API,
                    {
                        method: 'GET',
                        headers: {
                            'Accept':
                                'application/json'
                        }
                    }
                );


            if (!response.ok) {
                throw new Error(
                    'Gagal mengambil data customer.'
                );
            }


            const result =
                await response.json();


            if (
                !result.status ||
                !result.data
            ) {

                throw new Error(
                    result.message ||
                    'Data customer tidak tersedia.'
                );

            }


            customerData =
                result.data;


            renderCategories();

            renderMenu(
                customerData.menu || []
            );


        } catch (error) {

            showMenuError(
                error.message ||
                'Terjadi kesalahan saat memuat menu.'
            );

        }
    }


    async function loadMenuByKategori(
        idKategori
    )
    {
        showMenuLoading();

        try {

            const response =
                await fetch(
                    `${CATEGORY_API}/${idKategori}`,
                    {
                        method: 'GET',
                        headers: {
                            'Accept':
                                'application/json'
                        }
                    }
                );


            if (!response.ok) {

                throw new Error(
                    'Gagal mengambil menu kategori.'
                );

            }


            const result =
                await response.json();


            if (
                !result.status ||
                !result.data
            ) {

                throw new Error(
                    result.message ||
                    'Menu kategori tidak tersedia.'
                );

            }


            renderMenu(
                result.data.menu || []
            );


        } catch (error) {

            showMenuError(
                error.message ||
                'Terjadi kesalahan saat memuat kategori.'
            );

        }
    }


    categoryList.addEventListener(
        'click',
        function (event) {

            const button =
                event.target.closest(
                    '[data-category-id]'
                );


            if (!button) {
                return;
            }


            document
                .querySelectorAll(
                    '.category-button'
                )
                .forEach(
                    function (item) {

                        item.classList.remove(
                            'active'
                        );

                    }
                );


            button.classList.add(
                'active'
            );


            const categoryId =
                button.dataset.categoryId;


            if (
                categoryId === 'all'
            ) {

                renderMenu(
                    customerData.menu || []
                );

                return;
            }


            loadMenuByKategori(
                categoryId
            );

        }
    );


    menuGrid.addEventListener(
        'click',
        function (event) {

            const button =
                event.target.closest(
                    '[data-menu-id]'
                );


            if (!button) {
                return;
            }


            const menuId =
                button.dataset.menuId;


            if (
                typeof window.openCustomerMenuDetail ===
                'function'
            ) {

                window.openCustomerMenuDetail(
                    menuId
                );

            }

        }
    );


    document
        .getElementById('cartButton')
        .addEventListener(
            'click',
            function () {

                if (
                    typeof window.openCustomerCart ===
                    'function'
                ) {

                    window.openCustomerCart();

                }

            }
        );


    const readyLoading =
        document.getElementById('readyLoading');

    const readyError =
        document.getElementById('readyError');

    const readyEmpty =
        document.getElementById('readyEmpty');

    const readyGrid =
        document.getElementById('readyGrid');


    function readyTime(value)
    {
        if (!value) {
            return '-';
        }

        const date =
            new Date(String(value).replace(' ', 'T'));

        if (Number.isNaN(date.getTime())) {
            return String(value);
        }

        return date.toLocaleTimeString(
            'id-ID',
            {
                hour: '2-digit',
                minute: '2-digit'
            }
        ) + ' WIB';
    }


    function showReadyLoading()
    {
        readyLoading.style.display =
            'block';

        readyGrid.style.display =
            'none';

        readyEmpty.style.display =
            'none';

        readyError.style.display =
            'none';
    }


    function showReadyError(message)
    {
        readyLoading.style.display =
            'none';

        readyGrid.style.display =
            'none';

        readyEmpty.style.display =
            'none';

        readyError.textContent =
            message;

        readyError.style.display =
            'block';
    }


    function getSavedOrderCodeForReady()
    {
        try {

            const saved =
                localStorage.getItem(
                    LAST_ORDER_STORAGE_KEY
                );

            if (!saved) {
                return null;
            }

            const order =
                JSON.parse(saved);

            return order && order.kode_pesanan
                ? order.kode_pesanan
                : null;

        } catch (error) {

            return null;

        }
    }


    function showReadyToast(message)
    {
        const toast =
            document.getElementById('readyToast');

        const messageEl =
            document.getElementById(
                'readyToastMessage'
            );

        if (!toast || !messageEl) {
            return;
        }

        messageEl.textContent =
            message;

        toast.style.display =
            'block';

        clearTimeout(showReadyToast.timer);

        showReadyToast.timer = setTimeout(
            function () {

                toast.style.display =
                    'none';

            },
            15000
        );
    }


    function notifyReadyOrders(orders)
    {
        const kode =
            getSavedOrderCodeForReady();

        if (!kode) {
            return;
        }

        const ditemukan =
            (orders || []).some(
                function (order) {

                    return order.kode_pesanan === kode;

                }
            );

        if (!ditemukan) {
            return;
        }

        if (
            sessionStorage.getItem(
                READY_NOTIFIED_STORAGE_KEY
            ) === kode
        ) {
            return;
        }

        sessionStorage.setItem(
            READY_NOTIFIED_STORAGE_KEY,
            kode
        );

        showReadyToast(
            'Pesanan ' +
            kode +
            ' sudah siap. Silakan ambil makanan Anda di kasir.'
        );

        if (
            'Notification' in window &&
            Notification.permission === 'granted'
        ) {
            try {

                new Notification(
                    '🔔 Makanan Siap Diambil!',
                    {
                        body:
                            'Pesanan ' +
                            kode +
                            ' silakan diambil di kasir.',
                        tag:
                            'kantin-ready-' + kode
                    }
                );

            } catch (error) {
                // Notifikasi browser tidak tersedia.
            }
        }
    }


    async function ambilPesananCustomer(kodePesanan)
    {
        if (!kodePesanan) {
            return;
        }

        if (
            !confirm(
                'Konfirmasi bahwa Anda sudah mengambil makanan ini?'
            )
        ) {
            return;
        }

        try {

            const response =
                await fetch(
                    `${CUSTOMER_ORDER_API}/${encodeURIComponent(
                        kodePesanan
                    )}/ambil`,
                    {
                        method: 'POST',
                        headers: {
                            'Accept':
                                'application/json'
                        }
                    }
                );

            const result =
                await response.json();

            if (!response.ok || !result.status) {
                throw new Error(
                    result.message ||
                    'Gagal menandai pesanan selesai.'
                );
            }

            alert(
                'Terima kasih! Pesanan sudah ditandai selesai.'
            );

            await loadReadyOrders(true);

        } catch (error) {

            alert(
                error.message ||
                'Gagal menandai pesanan selesai.'
            );

        }
    }


    function renderReadyOrders(orders)
    {
        readyLoading.style.display =
            'none';

        readyError.style.display =
            'none';


        if (!orders || orders.length === 0) {

            readyGrid.innerHTML = '';

            readyGrid.style.display =
                'none';

            readyEmpty.style.display =
                'block';

            return;

        }


        readyEmpty.style.display =
            'none';

        readyGrid.style.display =
            'grid';

        readyGrid.innerHTML = '';


        orders.forEach(
            function (order) {

                const card =
                    document.createElement('article');

                card.className =
                    'ready-card';


                const header =
                    document.createElement('div');

                header.className =
                    'ready-card-top';


                const code =
                    document.createElement('span');

                code.className =
                    'ready-code';

                code.textContent =
                    order.kode_pesanan || '-';


                const badge =
                    document.createElement('span');

                badge.className =
                    'ready-badge';

                badge.textContent =
                    'Siap Diambil';


                header.append(code, badge);


                const total =
                    document.createElement('div');

                total.className =
                    'ready-total';

                total.textContent =
                    formatRupiah(
                        Number(order.total_bayar || 0)
                    );


                const time =
                    document.createElement('div');

                time.className =
                    'ready-time';

                time.textContent =
                    'Siap sejak ' +
                    readyTime(
                        order.updated_at ||
                        order.waktu_pesan
                    );


                const payment =
                    document.createElement('div');

                payment.className =
                    'ready-time';

                payment.style.color =
                    'var(--km-success)';

                payment.style.fontWeight =
                    '700';

                payment.textContent =
                    (order.metode_bayar === 'QRIS')
                        ? 'Pembayaran: QRIS (lunas)'
                        : 'Pembayaran: Tunai (lunas)';


                const actionWrapper =
                    document.createElement('div');

                actionWrapper.style.cssText =
                    'display:flex; flex-direction:column; gap:8px;';


                const button =
                    document.createElement('button');

                button.type = 'button';

                button.className =
                    'ready-detail-button';

                button.textContent =
                    'Lihat Status Pesanan';

                button.addEventListener(
                    'click',
                    function () {

                        if (
                            typeof window.openCustomerStatus ===
                            'function'
                        ) {

                            window.openCustomerStatus(
                                order.kode_pesanan
                            );

                        }

                    }
                );

                actionWrapper.appendChild(button);


                if (
                    getSavedOrderCodeForReady() ===
                    order.kode_pesanan
                ) {

                    card.classList.add(
                        'ready-card-mine'
                    );

                    const ambilButton =
                        document.createElement('button');

                    ambilButton.type = 'button';

                    ambilButton.className =
                        'ready-detail-button';

                    ambilButton.style.background =
                        'var(--km-brand)';

                    ambilButton.textContent =
                        '✅ Ambil Makanan';

                    ambilButton.addEventListener(
                        'click',
                        function () {

                            ambilPesananCustomer(
                                order.kode_pesanan
                            );

                        }
                    );

                    actionWrapper.appendChild(
                        ambilButton
                    );
                }


                card.append(
                    header,
                    total,
                    time,
                    payment,
                    actionWrapper
                );

                const custInfo = document.createElement('div');
                custInfo.style.cssText = 'font-size:12px; color:#c2410c; background:#fff7ed; border:1px solid #fed7aa; padding:4px 8px; border-radius:6px; margin-bottom:8px; font-weight:700; display:flex; justify-content:space-between; align-items:center;';
                custInfo.innerHTML = `<span>🪑 ${order.nomor_meja || 'Meja -'}</span><span>👤 ${order.nama_customer || 'Pelanggan'}</span>`;
                card.insertBefore(custInfo, total);
                readyGrid.appendChild(card);

            }
        );
    }


    async function loadReadyOrders(silent = false)
    {
        if (!silent) {
            showReadyLoading();
        }

        try {

            const response =
                await fetch(
                    READY_ORDERS_API,
                    {
                        method: 'GET',
                        cache: 'no-store',
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
                !result.status
            ) {

                throw new Error(
                    result.message ||
                    'Gagal mengambil pesanan siap diambil.'
                );

            }


            renderReadyOrders(
                result.data || []
            );

            notifyReadyOrders(
                result.data || []
            );


        } catch (error) {

            if (!silent) {

                showReadyError(
                    error.message ||
                    'Gagal memuat pesanan siap diambil.'
                );

            }

        }
    }


    document
        .getElementById('refreshReadyOrders')
        .addEventListener(
            'click',
            function () {

                loadReadyOrders();

            }
        );


    document.addEventListener(
        'visibilitychange',
        function () {

            if (document.visibilityState === 'visible') {

                loadReadyOrders(true);

            }

        }
    );


    loadReadyOrders();

    setInterval(
        function () {

            loadReadyOrders(true);

        },
        15000
    );


    updateCartCount();

    const refreshMenuButton =
        document.getElementById('refreshMenu');

    if (refreshMenuButton) {

        refreshMenuButton.addEventListener(
            'click',
            function () {

                loadCustomerData();

            }
        );

    }

    loadCustomerData();

</script>


<?= view('customer/menu_detail') ?>
<?= view('customer/cart') ?>
<?= view('customer/checkout') ?>
<?= view('customer/status') ?>


</body>

</html>