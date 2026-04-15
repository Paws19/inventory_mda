<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --navy: #1d3577;
            --navy-dark: #142550;
            --navy-deeper: #0d1c3d;
            --accent: #4a90e2;
            --accent-bright: #5ba3f5;
            --gold: #f0b429;
            --gold-light: #fde68a;
            --surface: #f0f4ff;
            --surface-card: #ffffff;
            --text-primary: #0d1c3d;
            --text-secondary: #4a5680;
            --text-muted: #8a94b0;
            --border: #d6e0ff;
            --shadow-sm: 0 2px 8px rgba(29, 53, 119, .08);
            --shadow-md: 0 8px 32px rgba(29, 53, 119, .13);
            --shadow-lg: 0 20px 60px rgba(29, 53, 119, .18);
            --radius: 16px;
            --radius-sm: 10px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--surface);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 10% 0%, rgba(29, 53, 119, .12) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 90% 100%, rgba(74, 144, 226, .10) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        /* ── HEADER ── */
        .header {
            background: linear-gradient(135deg, var(--navy-deeper) 0%, var(--navy) 60%, #264a9e 100%);
            padding: 0 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 72px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 24px rgba(13, 28, 61, .35);
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), var(--accent-bright), transparent);
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .header-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            backdrop-filter: blur(8px);
        }

        .header h1 {
            font-family: 'Syne', sans-serif;
            font-size: 22px;
            font-weight: 800;
            color: white;
            letter-spacing: -.3px;
        }

        .header h1 span {
            color: var(--gold);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .badge-count {
            background: rgba(255, 255, 255, .15);
            color: rgba(255, 255, 255, .85);
            font-size: 12px;
            font-weight: 500;
            padding: 4px 12px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, .2);
        }

        .btn-add {
            background: var(--gold);
            color: var(--navy-deeper);
            border: none;
            padding: 10px 22px;
            border-radius: 50px;
            font-family: 'Syne', sans-serif;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all .2s ease;
            box-shadow: 0 4px 16px rgba(240, 180, 41, .35);
            letter-spacing: .2px;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(240, 180, 41, .5);
            background: #f7c54d;
        }

        /* ── CONTAINER ── */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 36px 24px 60px;
            position: relative;
            z-index: 1;
        }

        /* ── TOOLBAR ── */
        .toolbar {
            display: flex;
            gap: 14px;
            margin-bottom: 32px;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-wrap {
            flex: 1;
            min-width: 240px;
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 16px;
            pointer-events: none;
        }

        .search-wrap input {
            width: 100%;
            padding: 13px 16px 13px 44px;
            border-radius: 50px;
            border: 1.5px solid var(--border);
            background: white;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--text-primary);
            box-shadow: var(--shadow-sm);
            transition: all .2s ease;
            outline: none;
        }

        .search-wrap input::placeholder {
            color: var(--text-muted);
        }

        .search-wrap input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(74, 144, 226, .15), var(--shadow-sm);
        }

        .view-toggle {
            display: flex;
            background: white;
            border: 1.5px solid var(--border);
            border-radius: 50px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .view-btn {
            padding: 10px 16px;
            border: none;
            background: transparent;
            cursor: pointer;
            font-size: 16px;
            color: var(--text-muted);
            transition: all .2s;
        }

        .view-btn.active {
            background: var(--navy);
            color: white;
        }

        /* ── SECTION LABEL ── */
        .section-label {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .section-label h2 {
            font-family: 'Syne', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: var(--text-secondary);
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* ── GRID ── */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .grid.list-view {
            grid-template-columns: 1fr;
        }

        /* ── CARD ── */
        .card {
            background: var(--surface-card);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1.5px solid var(--border);
            overflow: hidden;
            transition: all .3s cubic-bezier(.34, 1.56, .64, 1);
            animation: cardIn .4s ease both;
            position: relative;
        }

        @keyframes cardIn {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(74, 144, 226, .35);
        }

        .card:nth-child(1) {
            animation-delay: .03s;
        }

        .card:nth-child(2) {
            animation-delay: .07s;
        }

        .card:nth-child(3) {
            animation-delay: .11s;
        }

        .card:nth-child(4) {
            animation-delay: .15s;
        }

        .card:nth-child(5) {
            animation-delay: .19s;
        }

        .card:nth-child(6) {
            animation-delay: .23s;
        }

        .card-img-wrap {
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, #e8eeff 0%, #d6e0ff 100%);
            position: relative;
            overflow: hidden;
        }

        .card-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s ease;
        }

        .card:hover .card-img-wrap img {
            transform: scale(1.05);
        }

        .card-img-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: var(--text-muted);
            font-size: 13px;
        }

        .card-img-placeholder .icon {
            font-size: 36px;
            opacity: .4;
        }

        .card-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            font-family: 'Syne', sans-serif;
            letter-spacing: .5px;
            backdrop-filter: blur(8px);
        }

        .badge-active {
            background: rgba(46, 204, 113, .2);
            color: #1a9955;
            border: 1px solid rgba(46, 204, 113, .3);
        }

        .badge-inactive {
            background: rgba(231, 76, 60, .15);
            color: #c0392b;
            border: 1px solid rgba(231, 76, 60, .25);
        }

        .badge-default {
            background: rgba(255, 255, 255, .75);
            color: var(--text-secondary);
            border: 1px solid rgba(0, 0, 0, .1);
        }

        .card-body {
            padding: 18px 20px 20px;
        }

        .card-header-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 14px;
        }

        .card-title {
            font-family: 'Syne', sans-serif;
            font-size: 17px;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1.3;
            flex: 1;
        }

        .card-qty {
            background: var(--navy);
            color: white;
            font-family: 'Syne', sans-serif;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 8px;
            white-space: nowrap;
            margin-left: 10px;
        }

        .card-divider {
            height: 1px;
            background: var(--border);
            margin: 12px 0;
        }

        .card-fields {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px 16px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .field.full-width {
            grid-column: 1/-1;
        }

        .field-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: .8px;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .field-value {
            font-size: 13px;
            color: var(--text-secondary);
            font-weight: 400;
        }

        .field-value.highlight {
            color: var(--navy);
            font-weight: 600;
        }

        .card-footer {
            padding: 12px 20px;
            background: var(--surface);
            border-top: 1.5px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .category-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(29, 53, 119, .08);
            color: var(--navy);
            font-size: 11px;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 20px;
            font-family: 'Syne', sans-serif;
            letter-spacing: .3px;
        }

        .card-actions {
            display: flex;
            gap: 6px;
        }

        .action-btn {
            width: 30px;
            height: 30px;
            border: 1.5px solid var(--border);
            background: white;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            transition: all .2s;
            color: var(--text-muted);
        }

        .action-btn:hover {
            background: var(--navy);
            border-color: var(--navy);
            color: white;
            transform: scale(1.1);
        }

        /* ── EMPTY STATE ── */
        .empty-state {
            grid-column: 1/-1;
            text-align: center;
            padding: 80px 20px;
            color: var(--text-muted);
        }

        .empty-state .empty-icon {
            font-size: 56px;
            margin-bottom: 16px;
            opacity: .35;
        }

        .empty-state h3 {
            font-family: 'Syne', sans-serif;
            font-size: 20px;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
        }

        /* ── LIST VIEW ── */
        .grid.list-view .card {
            display: flex;
            flex-direction: row;
        }

        .grid.list-view .card-img-wrap {
            width: 160px;
            height: auto;
            flex-shrink: 0;
        }

        .grid.list-view .card-body {
            flex: 1;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 99px;
        }

        /* ════════════════════════════════
           REDESIGNED MODALS
        ════════════════════════════════ */

        /* OVERLAY */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 999;
            background: rgba(13, 28, 61, .55);
            backdrop-filter: blur(6px);
            align-items: center;
            justify-content: center;
            animation: fadeIn .2s ease;
        }

        .modal-overlay.open {
            display: flex;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* MODAL SHELL */
        .modal-shell {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 32px 80px rgba(13, 28, 61, .28);
            width: min(560px, 94vw);
            max-height: 90vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            animation: slideUp .3s cubic-bezier(.34, 1.56, .64, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(32px) scale(.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* MODAL HEADER */
        .modal-header {
            background: linear-gradient(135deg, var(--navy-deeper) 0%, var(--navy) 60%, #264a9e 100%);
            padding: 22px 28px 20px;
            position: relative;
            flex-shrink: 0;
        }

        .modal-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), var(--accent-bright), transparent);
        }

        .modal-header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .modal-title {
            font-family: 'Syne', sans-serif;
            font-size: 20px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -.2px;
        }

        .modal-title span {
            color: var(--gold);
        }

        .modal-subtitle {
            font-size: 13px;
            color: rgba(255, 255, 255, .55);
            margin-top: 2px;
        }

        .modal-close {
            width: 34px;
            height: 34px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: rgba(255, 255, 255, .8);
            line-height: 1;
            transition: all .2s;
            flex-shrink: 0;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, .25);
            color: #fff;
        }

        /* MODAL BODY */
        .modal-body {
            padding: 28px;
            overflow-y: auto;
            flex: 1;
        }

        .modal-body::-webkit-scrollbar {
            width: 4px;
        }

        .modal-body::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 99px;
        }

        /* VIEW MODAL — IMAGE */
        .view-img-wrap {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #e8eeff, #d6e0ff);
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 22px;
            position: relative;
        }

        .view-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .view-img-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: var(--text-muted);
            font-size: 13px;
        }

        .view-img-placeholder span.icon {
            font-size: 40px;
            opacity: .35;
        }

        /* STATUS BADGE in view */
        .view-status-badge {
            position: absolute;
            bottom: 12px;
            right: 12px;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            font-family: 'Syne', sans-serif;
            letter-spacing: .5px;
            backdrop-filter: blur(8px);
        }

        /* VIEW TITLE ROW */
        .view-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .view-item-name {
            font-family: 'Syne', sans-serif;
            font-size: 22px;
            font-weight: 800;
            color: var(--text-primary);
            flex: 1;
            line-height: 1.2;
        }

        .view-qty-badge {
            background: var(--navy);
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-size: 13px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 10px;
            margin-left: 12px;
            white-space: nowrap;
        }

        /* DIVIDER */
        .modal-divider {
            height: 1px;
            background: var(--border);
            margin: 18px 0;
        }

        /* FIELD GRID */
        .modal-fields {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .modal-field {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .modal-field.full {
            grid-column: 1/-1;
        }

        .modal-field-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .modal-field-value {
            font-size: 14px;
            color: var(--text-secondary);
        }

        .modal-field-value.hl {
            color: var(--navy);
            font-weight: 600;
        }

        /* CATEGORY ROW */
        .modal-cat-row {
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1.5px solid var(--border);
        }

        .modal-cat-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(29, 53, 119, .08);
            color: var(--navy);
            font-size: 12px;
            font-weight: 700;
            padding: 7px 16px;
            border-radius: 20px;
            font-family: 'Syne', sans-serif;
        }

        /* ── EDIT FORM ── */
        .edit-form {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 16px;
        }

        .form-group.full {
            grid-column: 1/-1;
        }

        .form-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .8px;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .form-control {
            padding: 11px 15px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--text-primary);
            background: #fff;
            transition: all .2s;
            outline: none;
            width: 100%;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(74, 144, 226, .15);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 80px;
            line-height: 1.5;
        }

        /* MODAL FOOTER */
        .modal-footer {
            padding: 18px 28px;
            border-top: 1.5px solid var(--border);
            background: var(--surface);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            flex-shrink: 0;
        }

        .btn-cancel {
            padding: 10px 22px;
            border-radius: 50px;
            border: 1.5px solid var(--border);
            background: #fff;
            font-family: 'Syne', sans-serif;
            font-size: 14px;
            font-weight: 700;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all .2s;
        }

        .btn-cancel:hover {
            background: var(--surface);
            border-color: var(--accent);
            color: var(--navy);
        }

        .btn-save {
            padding: 10px 28px;
            border-radius: 50px;
            border: none;
            background: linear-gradient(135deg, var(--navy) 0%, var(--accent) 100%);
            font-family: 'Syne', sans-serif;
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            cursor: pointer;
            transition: all .2s;
            box-shadow: 0 4px 16px rgba(29, 53, 119, .25);
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(29, 53, 119, .35);
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header class="header">
        <div class="header-brand">
            <div class="header-icon">📦</div>
            <h1>Inven<span>tory</span></h1>
        </div>
        <div class="header-actions">
            <span class="badge-count" id="itemCount">0 items</span>
            <button class="btn-add" onclick="addItem()">
                <span>＋</span> Add Item
            </button>
        </div>
    </header>

    <div class="container">

        <!-- TOOLBAR -->
        <div class="toolbar">
            <div class="search-wrap">
                <span class="search-icon">🔍</span>
                <input type="text" id="searchInput" placeholder="Search by name, location, status…"
                    oninput="searchItems()">
            </div>
            <div class="view-toggle">
                <button class="view-btn active" id="gridBtn" onclick="setView('grid')" title="Grid View">⊞</button>
                <button class="view-btn" id="listBtn" onclick="setView('list')" title="List View">☰</button>
            </div>
        </div>

        <div class="section-label">
            <h2>All Items</h2>
        </div>

        <!-- ITEMS GRID -->
        <div class="grid" id="itemGrid">

            @forelse ($items as $item)
                <div class="card item-card">

                    <div class="card-img-wrap">
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->item_name }}">
                        @else
                            <div class="card-img-placeholder">
                                <span class="icon">🖼️</span>
                                <span>No Image</span>
                            </div>
                        @endif
                        @php
                            $statusClass = match (strtolower($item->status ?? '')) {
                                'active', 'available', 'good' => 'badge-active',
                                'inactive', 'damaged', 'lost' => 'badge-inactive',
                                default => 'badge-default',
                            };
                        @endphp
                        <span class="card-badge {{ $statusClass }}">{{ $item->status ?? '—' }}</span>
                    </div>

                    <div class="card-body">
                        <div class="card-header-row">
                            <div class="card-title">{{ $item->item_name }}</div>
                            <div class="card-qty">× {{ $item->quantity ?? 0 }}</div>
                        </div>
                        <div class="card-fields">
                            <div class="field">
                                <span class="field-label">Condition</span>
                                <span class="field-value highlight">{{ $item->condition ?? '—' }}</span>
                            </div>
                            <div class="field">
                                <span class="field-label">Location</span>
                                <span class="field-value">{{ $item->location ?? '—' }}</span>
                            </div>
                            <div class="field">
                                <span class="field-label">Assigned To</span>
                                <span class="field-value">{{ $item->assigned_to ?? '—' }}</span>
                            </div>
                            <div class="field">
                                <span class="field-label">Purchase Date</span>
                                <span class="field-value">{{ $item->purchase_date ?? '—' }}</span>
                            </div>
                            <div class="field full-width">
                                <span class="field-label">Warranty Expiration</span>
                                <span class="field-value">{{ $item->warranty_expiration_date ?? '—' }}</span>
                            </div>
                            @if ($item->remarks)
                                <div class="field full-width">
                                    <span class="field-label">Remarks</span>
                                    <span class="field-value">{{ $item->remarks }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer">
                        <span class="category-pill">
                            🏷️
                            @foreach ($category as $cat)
                                @if ($item->category_id == $cat->id)
                                    {{ $cat->category_name }}
                                @endif
                            @endforeach
                        </span>
                        <div class="card-actions">
                            <button class="action-btn" title="View"
                                onclick='openView(@json($item))'>👁</button>
                            <button class="action-btn" title="Edit"
                                onclick='openEdit(@json($item))'>✏️</button>
                        </div>
                    </div>

                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">📭</div>
                    <h3>No items found</h3>
                    <p>Click <strong>+ Add Item</strong> to get started.</p>
                </div>
            @endforelse

        </div><!-- /#itemGrid -->
    </div><!-- /.container -->


    <!-- ══════════════════════════════════════
     VIEW MODAL
══════════════════════════════════════ -->
    <div class="modal-overlay" id="viewOverlay" onclick="overlayClose('viewOverlay')">
        <div class="modal-shell" onclick="event.stopPropagation()">

            <div class="modal-header">
                <div class="modal-header-top">
                    <div>
                        <div class="modal-title">Item <span>Details</span></div>
                        <div class="modal-subtitle">Read-only overview of this inventory item</div>
                    </div>
                    <button class="modal-close" onclick="closeOverlay('viewOverlay')">✕</button>
                </div>
            </div>

            <div class="modal-body">

                <div class="view-img-wrap" id="view_image_wrap">
                    <div class="view-img-placeholder">
                        <span class="icon">🖼️</span>
                        <span>No Image</span>
                    </div>
                </div>

                <div class="view-title-row">
                    <div class="view-item-name" id="view_item_name">—</div>
                    <div class="view-qty-badge" id="view_quantity">× 0</div>
                </div>

                <div class="modal-fields">
                    <div class="modal-field">
                        <span class="modal-field-label">Condition</span>
                        <span class="modal-field-value hl" id="view_condition">—</span>
                    </div>
                    <div class="modal-field">
                        <span class="modal-field-label">Status</span>
                        <span class="modal-field-value" id="view_status">—</span>
                    </div>
                    <div class="modal-field">
                        <span class="modal-field-label">Location</span>
                        <span class="modal-field-value" id="view_location">—</span>
                    </div>
                    <div class="modal-field">
                        <span class="modal-field-label">Assigned To</span>
                        <span class="modal-field-value" id="view_assigned">—</span>
                    </div>
                    <div class="modal-field">
                        <span class="modal-field-label">Purchase Date</span>
                        <span class="modal-field-value" id="view_purchase">—</span>
                    </div>
                    <div class="modal-field">
                        <span class="modal-field-label">Warranty Expiration</span>
                        <span class="modal-field-value" id="view_warranty">—</span>
                    </div>
                    <div class="modal-field full">
                        <span class="modal-field-label">Remarks</span>
                        <span class="modal-field-value" id="view_remarks">—</span>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeOverlay('viewOverlay')">Close</button>
            </div>
        </div>
    </div>


    <!-- ══════════════════════════════════════
     EDIT MODAL
══════════════════════════════════════ -->
    <div class="modal-overlay" id="editOverlay" onclick="overlayClose('editOverlay')">
        <div class="modal-shell" onclick="event.stopPropagation()">

            <div class="modal-header">
                <div class="modal-header-top">
                    <div>
                        <div class="modal-title">Edit <span>Item</span></div>
                        <div class="modal-subtitle">Update the details for this inventory item</div>
                    </div>
                    <button class="modal-close" onclick="closeOverlay('editOverlay')">✕</button>
                </div>
            </div>

            <div class="modal-body">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id">

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Item Name</label>
                            <input class="form-control" type="text" name="item_name" id="edit_item_name"
                                placeholder="e.g. MacBook Pro">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Quantity</label>
                            <input class="form-control" type="number" name="quantity" id="edit_quantity"
                                placeholder="0" min="0">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Condition</label>
                            <input class="form-control" type="text" name="condition" id="edit_condition"
                                placeholder="e.g. Good">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <input class="form-control" type="text" name="status" id="edit_status"
                                placeholder="e.g. Active">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Location</label>
                            <input class="form-control" type="text" name="location" id="edit_location"
                                placeholder="e.g. Storage Room A">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Assigned To</label>
                            <input class="form-control" type="text" name="assigned_to" id="edit_assigned"
                                placeholder="e.g. Juan Dela Cruz">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Purchase Date</label>
                            <input class="form-control" type="date" name="purchase_date" id="edit_purchase">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Warranty Expiration</label>
                            <input class="form-control" type="date" name="warranty_expiration_date"
                                id="edit_warranty">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Remarks</label>
                        <textarea class="form-control" name="remarks" id="edit_remarks" placeholder="Additional notes…"></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeOverlay('editOverlay')">Cancel</button>
                <button class="btn-save" onclick="submitEdit()">Save Changes</button>
            </div>
        </div>
    </div>


    <script>
        /* ── MODAL HELPERS ── */
        function openOverlay(id) {
            document.getElementById(id).classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeOverlay(id) {
            document.getElementById(id).classList.remove('open');
            document.body.style.overflow = '';
        }

        function overlayClose(id) {
            // only close if click was directly on overlay (not shell)
            closeOverlay(id);
        }

        /* ── VIEW MODAL ── */
        function openView(item) {
            // image
            const wrap = document.getElementById('view_image_wrap');
            if (item.image) {
                wrap.innerHTML = `<img src="/storage/${item.image}" alt="${item.item_name}">`;
            } else {
                wrap.innerHTML =
                    `<div class="view-img-placeholder"><span class="icon">🖼️</span><span>No Image</span></div>`;
            }

            document.getElementById('view_item_name').innerText = item.item_name ?? '—';
            document.getElementById('view_quantity').innerText = '× ' + (item.quantity ?? 0);
            document.getElementById('view_condition').innerText = item.condition ?? '—';
            document.getElementById('view_status').innerText = item.status ?? '—';
            document.getElementById('view_location').innerText = item.location ?? '—';
            document.getElementById('view_assigned').innerText = item.assigned_to ?? '—';
            document.getElementById('view_purchase').innerText = item.purchase_date ?? '—';
            document.getElementById('view_warranty').innerText = item.warranty_expiration_date ?? '—';
            document.getElementById('view_remarks').innerText = item.remarks ?? '—';

            openOverlay('viewOverlay');
        }

        /* ── EDIT MODAL ── */
        function openEdit(item) {
            document.getElementById('edit_id').value = item.id;
            document.getElementById('edit_item_name').value = item.item_name ?? '';
            document.getElementById('edit_quantity').value = item.quantity ?? 0;
            document.getElementById('edit_condition').value = item.condition ?? '';
            document.getElementById('edit_status').value = item.status ?? '';
            document.getElementById('edit_location').value = item.location ?? '';
            document.getElementById('edit_assigned').value = item.assigned_to ?? '';
            document.getElementById('edit_purchase').value = item.purchase_date ?? '';
            document.getElementById('edit_warranty').value = item.warranty_expiration_date ?? '';
            document.getElementById('edit_remarks').value = item.remarks ?? '';
            document.getElementById('editForm').action = `/items/${item.id}`;
            openOverlay('editOverlay');
        }

        function submitEdit() {
            document.getElementById('editForm').submit();
        }

        /* ── COUNT ── */
        function updateCount() {
            const visible = [...document.querySelectorAll('.item-card')].filter(c => c.style.display !== 'none').length;
            document.getElementById('itemCount').textContent = visible + ' item' + (visible !== 1 ? 's' : '');
        }
        updateCount();

        /* ── SEARCH ── */
        function searchItems() {
            const q = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('.item-card').forEach(card => {
                card.style.display = card.innerText.toLowerCase().includes(q) ? '' : 'none';
            });
            updateCount();
        }

        /* ── VIEW TOGGLE ── */
        function setView(mode) {
            const grid = document.getElementById('itemGrid');
            const gridBtn = document.getElementById('gridBtn');
            const listBtn = document.getElementById('listBtn');
            if (mode === 'list') {
                grid.classList.add('list-view');
                listBtn.classList.add('active');
                gridBtn.classList.remove('active');
            } else {
                grid.classList.remove('list-view');
                gridBtn.classList.add('active');
                listBtn.classList.remove('active');
            }
        }

        /* ── ADD ITEM ── */
        function addItem() {
            window.location.href = '/items/create';
        }
    </script>

</body>

</html>
