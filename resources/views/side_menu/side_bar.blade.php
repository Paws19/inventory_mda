<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MDA Inventory System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap"
        rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        mono: ['DM Mono', 'monospace']
                    },
                    colors: {
                        navy: {
                            DEFAULT: '#1d3577',
                            dark: '#152858',
                            deep: '#0e1e45',
                            light: '#2a4a9e'
                        },
                        accent: {
                            DEFAULT: '#4d9de0',
                            bright: '#62b4f5'
                        },
                        surface: {
                            DEFAULT: '#f0f4ff',
                            '2': '#e8eeff'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: ui-sans-serif, system-ui, sans-serif;
            background: #f3f4f6;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border-radius: 8px;
            cursor: pointer;
            color: #6b7280;
            font-size: 13.5px;
            transition: background 0.15s;
            position: relative;
        }

        .nav-item:hover {
            background: #f3f4f6;
            color: #111827;
        }

        .nav-item.active {
            background: #dbeafe;
            color: #1d4ed8;
            font-weight: 500;
        }

        .nav-item svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .nav-badge {
            margin-left: auto;
            font-size: 11px;
            font-weight: 500;
            background: #dbeafe;
            color: #1d4ed8;
            padding: 1px 7px;
            border-radius: 99px;
        }

        .nav-badge.warn {
            background: #fef3c7;
            color: #92400e;
        }

        .nav-badge.success {
            background: #d1fae5;
            color: #065f46;
        }

        .page {
            display: none;
        }

        .page.active {
            display: block;
        }

        .list-header {
            display: grid;
            grid-template-columns: 2fr 1.5fr 1fr 1fr 80px;
            gap: 8px;
            padding: 10px 14px;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
            font-size: 11px;
            font-weight: 500;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .list-row {
            display: grid;
            grid-template-columns: 2fr 1.5fr 1fr 1fr 80px;
            gap: 8px;
            padding: 10px 14px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 13px;
            color: #111827;
            align-items: center;
            transition: background 0.1s;
        }

        .list-row:last-child {
            border-bottom: none;
        }

        .list-row:hover {
            background: #f9fafb;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            padding: 2px 8px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 500;
        }

        .pill-out {
            background: #fef3c7;
            color: #92400e;
        }

        .pill-due {
            background: #fee2e2;
            color: #991b1b;
        }

        .pill-ok {
            background: #d1fae5;
            color: #065f46;
        }

        .action-btn {
            padding: 4px 10px;
            font-size: 11px;
            border-radius: 6px;
            cursor: pointer;
            border: 1px solid #1d4ed8;
            color: #1d4ed8;
            background: transparent;
            transition: background 0.15s;
        }

        .action-btn:hover {
            background: #dbeafe;
        }

        .toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: #1d4ed8;
            color: white;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 13px;
            opacity: 0;
            transform: translateY(8px);
            transition: opacity 0.2s, transform 0.2s;
            pointer-events: none;
            z-index: 9999;
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        .return-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: border-color 0.15s;
        }

        .return-item:hover {
            border-color: #1d4ed8;
        }

        .item-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 14px;
            cursor: pointer;
            transition: border-color 0.15s;
        }

        .item-card:hover {
            border-color: #9ca3af;
        }
    </style>
</head>

<body class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <div class="w-60 bg-white border-r border-gray-200 flex flex-col flex-shrink-0 h-full">
        <!-- Logo -->
        <div class="p-4 border-b border-gray-200">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-700 flex items-center justify-center">
                    <svg class="w-4 h-4 fill-white" viewBox="0 0 20 20">
                        <path
                            d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zm0 6a1 1 0 011-1h6a1 1 0 010 2H4a1 1 0 01-1-1z" />
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-900">MDA System</div>
                    <div class="text-xs text-gray-400">Inventory</div>
                </div>
            </div>
        </div>

        <!-- Nav -->
        <div class="flex-1 overflow-y-auto p-2">
            <div class="text-xs font-medium text-gray-400 uppercase tracking-widest px-2 mb-1 mt-2">Main</div>

            <div class="nav-item" id="nav-dashboard" onclick="navigate('dashboard')">
                <svg viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M2 4a2 2 0 012-2h4a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2V4zm0 10a2 2 0 012-2h4a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2zm10-10a2 2 0 012-2h2a2 2 0 012 2v6a2 2 0 01-2 2h-2a2 2 0 01-2-2V4zm0 10a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Dashboard
            </div>

            <div class="text-xs font-medium text-gray-400 uppercase tracking-widest px-2 mb-1 mt-3">Inventory</div>

            <div class="nav-item active" id="nav-menu" onclick="navigate('menu')">
                <svg viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                </svg>
                Menu Items
                <span class="nav-badge">24</span>
            </div>

            <div class="nav-item" id="nav-borrow" onclick="navigate('borrow')">
                <svg viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                </svg>
                Borrow Items
                <span class="nav-badge warn">3</span>
            </div>

            <div class="nav-item" id="nav-return" onclick="navigate('return')">
                <svg viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
                Return Items
                <span class="nav-badge success">5</span>
            </div>

            <div class="text-xs font-medium text-gray-400 uppercase tracking-widest px-2 mb-1 mt-3">Reports</div>

            <div class="nav-item" id="nav-reports" onclick="navigate('reports')">
                <svg viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z"
                        clip-rule="evenodd" />
                </svg>
                Reports
            </div>

            <div class="nav-item" id="nav-settings" onclick="navigate('settings')">
                <svg viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                        clip-rule="evenodd" />
                </svg>
                Settings
            </div>
        </div>

        <!-- User -->
        <div class="p-3 border-t border-gray-200">
            <div class="flex items-center gap-2">
                <div
                    class="w-7 h-7 rounded-full bg-blue-100 flex items-center justify-center text-xs font-medium text-blue-700">
                    AD</div>
                <div>
                    <div class="text-xs font-medium text-gray-800">Admin</div>
                    <div class="text-xs text-gray-400">MDA Staff</div>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="flex-1 overflow-y-auto p-6">

        <!-- DASHBOARD -->
        <div class="page" id="page-dashboard">
            <h1 class="text-xl font-medium text-gray-900 mb-1">Dashboard</h1>
            <p class="text-sm text-gray-500 mb-6">Welcome back! Here's your overview.</p>
            <div
                class="flex items-center justify-center h-72 border border-dashed border-gray-300 rounded-xl text-gray-400 text-sm">
                Your existing dashboard content goes here</div>
        </div>

        <!-- MENU ITEMS -->
        <div class="page active" id="page-menu">
            <h1 class="text-xl font-medium text-gray-900 mb-1">Menu Items</h1>
            <p class="text-sm text-gray-500 mb-5">Manage all inventory items available in the system.</p>

            <div class="flex gap-2 mb-5">
                <input type="text" id="search-input" oninput="filterItems()" placeholder="Search items..."
                    class="flex-1 px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 bg-white" />
                <select id="cat-filter" onchange="filterItems()"
                    class="px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 bg-white">
                    <option value="">All categories</option>
                    <option>Equipment</option>
                    <option>Supplies</option>
                    <option>Tools</option>
                </select>
                <button onclick="showToast('Add item dialog would open here')"
                    class="px-4 py-2 bg-blue-700 text-white text-sm rounded-lg hover:bg-blue-800 transition-colors">+
                    Add item</button>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3" id="items-grid"></div>
        </div>

        <!-- BORROW ITEMS -->
        <div class="page" id="page-borrow">
            <h1 class="text-xl font-medium text-gray-900 mb-1">Borrow Items</h1>
            <p class="text-sm text-gray-500 mb-5">Record item borrowing transactions.</p>

            <div class="bg-white border border-gray-200 rounded-xl p-5 mb-5">
                <div class="text-sm font-medium text-gray-900 mb-4">New borrow request</div>
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Borrower name</label>
                        <input type="text" placeholder="Full name"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500" />
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Department / section</label>
                        <input type="text" placeholder="e.g. Operations"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Select item</label>
                        <select
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 bg-white">
                            <option>Projector</option>
                            <option>Extension cord</option>
                            <option>Drill set</option>
                            <option>First aid kit</option>
                            <option>Whiteboard</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Quantity</label>
                        <input type="number" min="1" value="1"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Borrow date</label>
                        <input type="date" id="borrow-date"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500" />
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">Expected return</label>
                        <input type="date" id="return-date"
                            class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500" />
                    </div>
                </div>
                <button onclick="submitBorrow()"
                    class="px-4 py-2 bg-blue-700 text-white text-sm rounded-lg hover:bg-blue-800 transition-colors">Submit
                    borrow request</button>
            </div>

            <div class="text-sm font-medium text-gray-900 mb-3">Active borrows</div>
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                <div class="list-header">
                    <span>Item</span><span>Borrower</span><span>Borrowed</span><span>Status</span><span>Action</span>
                </div>
                <div id="borrow-rows"></div>
            </div>
        </div>

        <!-- RETURN ITEMS -->
        <div class="page" id="page-return">
            <h1 class="text-xl font-medium text-gray-900 mb-1">Return Items</h1>
            <p class="text-sm text-gray-500 mb-5">Process item returns and update inventory.</p>

            <div class="grid grid-cols-3 gap-3 mb-5">
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="text-2xl font-medium text-amber-700">3</div>
                    <div class="text-xs text-gray-500 mt-1">Overdue</div>
                </div>
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="text-2xl font-medium text-blue-700">8</div>
                    <div class="text-xs text-gray-500 mt-1">Out today</div>
                </div>
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="text-2xl font-medium text-green-700">5</div>
                    <div class="text-xs text-gray-500 mt-1">Returned today</div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-5">
                <div class="text-sm font-medium text-gray-900 mb-3">Search borrow record</div>
                <div class="flex gap-2 mb-4">
                    <input type="text" id="return-search" oninput="filterReturns()"
                        placeholder="Search by name or item..."
                        class="flex-1 px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500" />
                    <button onclick="filterReturns()"
                        class="px-4 py-2 bg-blue-700 text-white text-sm rounded-lg hover:bg-blue-800 transition-colors">Search</button>
                </div>
                <div id="return-list"></div>
            </div>
        </div>

        <!-- REPORTS -->
        <div class="page" id="page-reports">
            <h1 class="text-xl font-medium text-gray-900 mb-1">Reports</h1>
            <p class="text-sm text-gray-500 mb-5">Inventory and transaction reports.</p>
            <div
                class="flex items-center justify-center h-72 border border-dashed border-gray-300 rounded-xl text-gray-400 text-sm">
                Reports content goes here</div>
        </div>

        <!-- SETTINGS -->
        <div class="page" id="page-settings">
            <h1 class="text-xl font-medium text-gray-900 mb-1">Settings</h1>
            <p class="text-sm text-gray-500 mb-5">System configuration.</p>
            <div
                class="flex items-center justify-center h-72 border border-dashed border-gray-300 rounded-xl text-gray-400 text-sm">
                Settings content goes here</div>
        </div>

    </div>

    <div class="toast" id="toast"></div>

    <script>
        const pages = ['dashboard', 'menu', 'borrow', 'return', 'reports', 'settings'];
        const navIds = {
            dashboard: 'nav-dashboard',
            menu: 'nav-menu',
            borrow: 'nav-borrow',
            return: 'nav-return',
            reports: 'nav-reports',
            settings: 'nav-settings'
        };

        function navigate(page) {
            pages.forEach(p => {
                document.getElementById('page-' + p).classList.remove('active');
                const n = document.getElementById('nav-' + p);
                if (n) n.classList.remove('active');
            });
            document.getElementById('page-' + page).classList.add('active');
            const nav = document.getElementById('nav-' + page);
            if (nav) nav.classList.add('active');
        }

        const itemsData = [{
                name: 'Projector',
                cat: 'Equipment',
                stock: 4,
                emoji: '📽'
            },
            {
                name: 'Whiteboard',
                cat: 'Equipment',
                stock: 6,
                emoji: '🟦'
            },
            {
                name: 'Extension cord',
                cat: 'Supplies',
                stock: 12,
                emoji: '🔌'
            },
            {
                name: 'Drill set',
                cat: 'Tools',
                stock: 2,
                emoji: '🔧'
            },
            {
                name: 'First aid kit',
                cat: 'Supplies',
                stock: 3,
                emoji: '🩺'
            },
            {
                name: 'Laptop stand',
                cat: 'Equipment',
                stock: 0,
                emoji: '💻'
            },
            {
                name: 'Tape measure',
                cat: 'Tools',
                stock: 8,
                emoji: '📏'
            },
            {
                name: 'Marker set',
                cat: 'Supplies',
                stock: 15,
                emoji: '✏️'
            },
            {
                name: 'Folding table',
                cat: 'Equipment',
                stock: 5,
                emoji: '🪑'
            },
            {
                name: 'Safety vest',
                cat: 'Supplies',
                stock: 1,
                emoji: '🦺'
            },
            {
                name: 'Ladder',
                cat: 'Tools',
                stock: 3,
                emoji: '🪜'
            },
            {
                name: 'Megaphone',
                cat: 'Equipment',
                stock: 2,
                emoji: '📢'
            },
        ];

        function filterItems() {
            const q = document.getElementById('search-input').value.toLowerCase();
            const cat = document.getElementById('cat-filter').value;
            renderItems(itemsData.filter(i => (!q || i.name.toLowerCase().includes(q)) && (!cat || i.cat === cat)));
        }

        function renderItems(list) {
            const grid = document.getElementById('items-grid');
            grid.innerHTML = list.map(item => {
                const cls = item.stock === 0 ? 'out' : item.stock <= 2 ? 'low' : 'ok';
                const lbl = item.stock === 0 ? 'Out of stock' : item.stock <= 2 ? 'Low stock' : 'In stock';
                const bg = item.cat === 'Equipment' ? '#dbeafe' : item.cat === 'Tools' ? '#fef3c7' : '#d1fae5';
                const stockColor = item.stock === 0 ? 'text-red-700' : item.stock <= 2 ? 'text-amber-700' :
                    'text-green-700';
                const pillClass = cls === 'ok' ? 'pill-ok' : cls === 'low' ? 'pill-out' : 'pill-due';
                return `<div class="item-card">
      <div style="width:40px;height:40px;border-radius:10px;background:${bg};display:flex;align-items:center;justify-content:center;margin-bottom:10px;font-size:20px;">${item.emoji}</div>
      <div style="font-size:13px;font-weight:500;color:#111827;margin-bottom:2px;">${item.name}</div>
      <div style="font-size:11px;color:#6b7280;margin-bottom:8px;">${item.cat}</div>
      <div style="display:flex;align-items:center;justify-content:space-between;">
        <div>
          <div style="font-size:13px;font-weight:500;" class="${stockColor}">${item.stock}</div>
          <div style="font-size:10px;color:#9ca3af;">units</div>
        </div>
        <span class="status-pill ${pillClass}">${lbl}</span>
      </div>
    </div>`;
            }).join('');
        }

        const borrowData = [{
                item: 'Projector',
                borrower: 'Maria Santos',
                dept: 'Events',
                date: 'Apr 10',
                due: 'Apr 15',
                status: 'out'
            },
            {
                item: 'Drill set',
                borrower: 'Juan Reyes',
                dept: 'Maintenance',
                date: 'Apr 8',
                due: 'Apr 12',
                status: 'due'
            },
            {
                item: 'Extension cord',
                borrower: 'Ana Cruz',
                dept: 'Operations',
                date: 'Apr 11',
                due: 'Apr 14',
                status: 'due'
            },
            {
                item: 'Whiteboard',
                borrower: 'Leo Garcia',
                dept: 'Training',
                date: 'Apr 12',
                due: 'Apr 18',
                status: 'out'
            },
            {
                item: 'Ladder',
                borrower: 'Rosa Lim',
                dept: 'Facilities',
                date: 'Apr 9',
                due: 'Apr 16',
                status: 'out'
            },
        ];

        function renderBorrows() {
            document.getElementById('borrow-rows').innerHTML = borrowData.map(b => `
    <div class="list-row">
      <span style="font-weight:500;">${b.item}</span>
      <span>${b.borrower} <span style="font-size:11px;color:#6b7280;">(${b.dept})</span></span>
      <span style="color:#6b7280;font-size:12px;">${b.date}</span>
      <span><span class="status-pill ${b.status==='due'?'pill-due':'pill-out'}">${b.status==='due'?'Overdue':'Out'}</span></span>
      <span><button class="action-btn" onclick="showToast('Return processed for ${b.item}')">Return</button></span>
    </div>`).join('');
        }

        const returnData = [{
                item: 'Projector',
                borrower: 'Maria Santos',
                dept: 'Events',
                due: 'Apr 15',
                status: 'out',
                color: '#1d4ed8'
            },
            {
                item: 'Drill set',
                borrower: 'Juan Reyes',
                dept: 'Maintenance',
                due: 'Apr 12',
                status: 'overdue',
                color: '#991b1b'
            },
            {
                item: 'Extension cord',
                borrower: 'Ana Cruz',
                dept: 'Operations',
                due: 'Apr 14',
                status: 'overdue',
                color: '#991b1b'
            },
            {
                item: 'Whiteboard',
                borrower: 'Leo Garcia',
                dept: 'Training',
                due: 'Apr 18',
                status: 'out',
                color: '#1d4ed8'
            },
            {
                item: 'Ladder',
                borrower: 'Rosa Lim',
                dept: 'Facilities',
                due: 'Apr 16',
                status: 'out',
                color: '#1d4ed8'
            },
        ];

        function filterReturns() {
            const q = document.getElementById('return-search').value.toLowerCase();
            renderReturns(q ? returnData.filter(r => r.item.toLowerCase().includes(q) || r.borrower.toLowerCase().includes(
                q)) : returnData);
        }

        function renderReturns(list) {
            const el = document.getElementById('return-list');
            if (!list.length) {
                el.innerHTML =
                    '<div style="text-align:center;padding:20px;color:#6b7280;font-size:13px;">No records found</div>';
                return;
            }
            el.innerHTML = list.map(r => `
    <div class="return-item">
      <div style="width:10px;height:10px;border-radius:50%;background:${r.color};flex-shrink:0;"></div>
      <div style="flex:1;">
        <div style="font-size:13px;font-weight:500;color:#111827;">${r.item} — <span style="font-weight:400;">${r.borrower}</span></div>
        <div style="font-size:11px;color:#6b7280;margin-top:2px;">${r.dept} · Due ${r.due} · <span style="color:${r.color};">${r.status}</span></div>
      </div>
      <button class="action-btn" onclick="showToast('${r.item} returned by ${r.borrower}')">Mark returned</button>
    </div>`).join('');
        }

        function submitBorrow() {
            showToast('Borrow request submitted!');
        }

        let toastTimer;

        function showToast(msg) {
            const t = document.getElementById('toast');
            t.textContent = msg;
            t.classList.add('show');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => t.classList.remove('show'), 2500);
        }

        const today = new Date().toISOString().split('T')[0];
        const next = new Date(Date.now() + 7 * 86400000).toISOString().split('T')[0];
        document.getElementById('borrow-date').value = today;
        document.getElementById('return-date').value = next;

        renderItems(itemsData);
        renderBorrows();
        renderReturns(returnData);
    </script>
</body>

</html>
