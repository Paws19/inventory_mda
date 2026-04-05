<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>StockFlow — Inventory Dashboard</title>
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
                        mono: ['DM Mono', 'monospace'],
                    },
                    colors: {
                        navy: {
                            DEFAULT: '#1d3577',
                            dark: '#152858',
                            deep: '#0e1e45',
                            light: '#2a4a9e',
                        },
                        accent: {
                            DEFAULT: '#4d9de0',
                            bright: '#62b4f5',
                        },
                        surface: {
                            DEFAULT: '#f0f4ff',
                            2: '#e8eeff',
                        },
                    },
                },
            },
        }
    </script>
    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            /* prevent body from scrolling — only inner panel scrolls */
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f0f4ff;
        }

        /* Hide sidebar internal scrollbar */
        .sidebar-nav::-webkit-scrollbar {
            display: none;
        }

        .sidebar-nav {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Thin custom scrollbar for main content */
        .main-scroll::-webkit-scrollbar {
            width: 5px;
        }

        .main-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .main-scroll::-webkit-scrollbar-thumb {
            background: #c7d2f0;
            border-radius: 4px;
        }

        .main-scroll::-webkit-scrollbar-thumb:hover {
            background: #1d3577;
        }

        /* Bar chart */
        .bar-r {
            background: #1d3577;
            border-radius: 4px 4px 0 0;
        }

        .bar-d {
            background: #4d9de0;
            opacity: 0.45;
            border-radius: 4px 4px 0 0;
        }

        /* Table row hover */
        .inv-row:hover td {
            background: #f0f4ff;
        }

        /* Sidebar decorative orb */
        .sidebar::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 180px;
            height: 180px;
            background: #2a4a9e;
            border-radius: 50%;
            opacity: 0.15;
            pointer-events: none;
        }
    </style>
</head>

<body>

    <!-- Root: full viewport, no overflow, flex row -->
    <div style="display:flex; height:100vh; overflow:hidden;">

        <!-- ============================================================
       SIDEBAR — fixed width column, never scrolls with content
  ============================================================ -->
        <aside class="sidebar"
            style="
    position: relative;
    width: 218px;
    min-width: 218px;
    height: 100vh;
    background: #0e1e45;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    z-index: 50;
    flex-shrink: 0;
  ">
            <!-- Logo area -->
            <div
                style="padding:20px 16px 16px; border-bottom:1px solid rgba(255,255,255,0.07); flex-shrink:0; position:relative; z-index:1;">
                <div style="display:flex; align-items:center; gap:10px;">
                    <div
                        style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#4d9de0,#2a4a9e);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="white"
                            stroke-width="2.2" stroke-linecap="round">
                            <rect x="2" y="3" width="20" height="14" rx="2" />
                            <path d="M8 21h8M12 17v4" />
                        </svg>
                    </div>
                    <div>
                        <div style="color:#fff;font-size:14.5px;font-weight:700;letter-spacing:-0.3px;line-height:1;">
                            StockFlow</div>
                        <div
                            style="font-family:'DM Mono',monospace;font-size:9px;color:rgba(255,255,255,0.38);letter-spacing:1.5px;text-transform:uppercase;margin-top:3px;">
                            Inventory</div>
                    </div>
                </div>
            </div>

            <!-- Nav (internal scroll if content overflows, no visible scrollbar) -->
            <nav class="sidebar-nav" style="flex:1; overflow-y:auto; padding:12px 10px;">

                <div
                    style="font-family:'DM Mono',monospace;font-size:9px;letter-spacing:1.8px;text-transform:uppercase;color:rgba(255,255,255,0.28);padding:8px 8px 5px;">
                    Main</div>

                <!-- Active: Dashboard -->
                <a href="#"
                    style="display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:8px;margin-bottom:2px;color:#fff;font-size:13px;font-weight:500;text-decoration:none;background:linear-gradient(135deg,#4d9de0 0%,#2a4a9e 100%);box-shadow:0 4px 12px rgba(77,157,224,0.32);">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" style="flex-shrink:0;">
                        <rect x="3" y="3" width="7" height="7" rx="1" />
                        <rect x="14" y="3" width="7" height="7" rx="1" />
                        <rect x="3" y="14" width="7" height="7" rx="1" />
                        <rect x="14" y="14" width="7" height="7" rx="1" />
                    </svg>
                    Dashboard
                </a>

                <a href="#"
                    style="display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:8px;margin-bottom:2px;color:rgba(255,255,255,0.52);font-size:13px;font-weight:500;text-decoration:none;transition:background 0.18s,color 0.18s;"
                    onmouseover="this.style.background='rgba(255,255,255,0.07)';this.style.color='rgba(255,255,255,0.85)'"
                    onmouseout="this.style.background='';this.style.color='rgba(255,255,255,0.52)'">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" style="flex-shrink:0;">
                        <path
                            d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                    </svg>
                    Products
                    <span
                        style="margin-left:auto;background:#ef4444;color:#fff;font-family:'DM Mono',monospace;font-size:9.5px;font-weight:600;padding:1px 5px;border-radius:10px;">248</span>
                </a>

                <a href="#"
                    style="display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:8px;margin-bottom:2px;color:rgba(255,255,255,0.52);font-size:13px;font-weight:500;text-decoration:none;"
                    onmouseover="this.style.background='rgba(255,255,255,0.07)';this.style.color='rgba(255,255,255,0.85)'"
                    onmouseout="this.style.background='';this.style.color='rgba(255,255,255,0.52)'">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" style="flex-shrink:0;">
                        <path
                            d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2v-4M9 21H5a2 2 0 0 1-2-2v-4m0 0h18" />
                    </svg>
                    Warehouse
                </a>

                <a href="#"
                    style="display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:8px;margin-bottom:2px;color:rgba(255,255,255,0.52);font-size:13px;font-weight:500;text-decoration:none;"
                    onmouseover="this.style.background='rgba(255,255,255,0.07)';this.style.color='rgba(255,255,255,0.85)'"
                    onmouseout="this.style.background='';this.style.color='rgba(255,255,255,0.52)'">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" style="flex-shrink:0;">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                        <line x1="3" y1="6" x2="21" y2="6" />
                        <path d="M16 10a4 4 0 0 1-8 0" />
                    </svg>
                    Purchase Orders
                    <span
                        style="margin-left:auto;background:#ef4444;color:#fff;font-family:'DM Mono',monospace;font-size:9.5px;font-weight:600;padding:1px 5px;border-radius:10px;">5</span>
                </a>

                <div
                    style="font-family:'DM Mono',monospace;font-size:9px;letter-spacing:1.8px;text-transform:uppercase;color:rgba(255,255,255,0.28);padding:14px 8px 5px;">
                    Analytics</div>

                <a href="#"
                    style="display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:8px;margin-bottom:2px;color:rgba(255,255,255,0.52);font-size:13px;font-weight:500;text-decoration:none;"
                    onmouseover="this.style.background='rgba(255,255,255,0.07)';this.style.color='rgba(255,255,255,0.85)'"
                    onmouseout="this.style.background='';this.style.color='rgba(255,255,255,0.52)'">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" style="flex-shrink:0;">
                        <line x1="18" y1="20" x2="18" y2="10" />
                        <line x1="12" y1="20" x2="12" y2="4" />
                        <line x1="6" y1="20" x2="6" y2="14" />
                    </svg>
                    Reports
                </a>

                <a href="#"
                    style="display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:8px;margin-bottom:2px;color:rgba(255,255,255,0.52);font-size:13px;font-weight:500;text-decoration:none;"
                    onmouseover="this.style.background='rgba(255,255,255,0.07)';this.style.color='rgba(255,255,255,0.85)'"
                    onmouseout="this.style.background='';this.style.color='rgba(255,255,255,0.52)'">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" style="flex-shrink:0;">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                    Stock History
                </a>

                <div
                    style="font-family:'DM Mono',monospace;font-size:9px;letter-spacing:1.8px;text-transform:uppercase;color:rgba(255,255,255,0.28);padding:14px 8px 5px;">
                    System</div>

                <a href="#"
                    style="display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:8px;margin-bottom:2px;color:rgba(255,255,255,0.52);font-size:13px;font-weight:500;text-decoration:none;"
                    onmouseover="this.style.background='rgba(255,255,255,0.07)';this.style.color='rgba(255,255,255,0.85)'"
                    onmouseout="this.style.background='';this.style.color='rgba(255,255,255,0.52)'">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" style="flex-shrink:0;">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    Suppliers
                </a>

                <a href="#"
                    style="display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:8px;margin-bottom:2px;color:rgba(255,255,255,0.52);font-size:13px;font-weight:500;text-decoration:none;"
                    onmouseover="this.style.background='rgba(255,255,255,0.07)';this.style.color='rgba(255,255,255,0.85)'"
                    onmouseout="this.style.background='';this.style.color='rgba(255,255,255,0.52)'">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" style="flex-shrink:0;">
                        <circle cx="12" cy="12" r="3" />
                        <path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14" />
                    </svg>
                    Settings
                </a>
            </nav>

            <!-- User card at bottom -->
            <div style="padding:10px 10px 14px; border-top:1px solid rgba(255,255,255,0.07); flex-shrink:0;">
                <div style="display:flex;align-items:center;gap:8px;padding:7px 8px;border-radius:8px;cursor:pointer;"
                    onmouseover="this.style.background='rgba(255,255,255,0.07)'"
                    onmouseout="this.style.background=''">
                    <div
                        style="width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,#4d9de0,#2a4a9e);display:flex;align-items:center;justify-content:center;color:#fff;font-size:11px;font-weight:700;flex-shrink:0;">
                        JD</div>
                    <div style="min-width:0;">
                        <div
                            style="color:rgba(255,255,255,0.85);font-size:12px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                            Juan Dela Cruz</div>
                        <div style="color:rgba(255,255,255,0.32);font-size:10.5px;">Administrator</div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- ============================================================
       RIGHT SIDE — topbar (sticky) + scrollable content area
  ============================================================ -->
        <div style="flex:1; min-width:0; height:100vh; display:flex; flex-direction:column; overflow:hidden;">

            <!-- TOPBAR — never scrolls -->
            <header
                style="
      flex-shrink:0;
      height:54px;
      background:#fff;
      border-bottom:1px solid rgba(29,53,119,0.11);
      display:flex;
      align-items:center;
      gap:12px;
      padding:0 20px;
    ">
                <div
                    style="flex:1;font-size:15px;font-weight:700;color:#0e1e45;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                    Dashboard Overview</div>
                <div style="font-family:'DM Mono',monospace;font-size:11.5px;color:#94a3b8;flex-shrink:0;">Apr 05, 2026
                </div>

                <!-- Search -->
                <div
                    style="display:flex;align-items:center;gap:7px;background:#f0f4ff;border:1px solid rgba(29,53,119,0.11);border-radius:8px;padding:6px 12px;width:190px;flex-shrink:0;">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#94a3b8"
                        stroke-width="2" stroke-linecap="round" style="flex-shrink:0;">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <input type="text" placeholder="Search products, SKU…"
                        style="border:none;background:transparent;font-size:12px;color:#0e1e45;outline:none;width:100%;font-family:inherit;" />
                </div>

                <!-- Bell -->
                <div style="position:relative;width:32px;height:32px;background:#f0f4ff;border:1px solid rgba(29,53,119,0.11);border-radius:8px;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;"
                    onmouseover="this.style.borderColor='#1d3577'"
                    onmouseout="this.style.borderColor='rgba(29,53,119,0.11)'">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#64748b"
                        stroke-width="2" stroke-linecap="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                        <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                    </svg>
                    <span
                        style="position:absolute;top:6px;right:6px;width:6px;height:6px;background:#ef4444;border-radius:50%;border:1.5px solid #fff;"></span>
                </div>

                <!-- Profile -->
                <div style="width:32px;height:32px;background:#f0f4ff;border:1px solid rgba(29,53,119,0.11);border-radius:8px;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;"
                    onmouseover="this.style.borderColor='#1d3577'"
                    onmouseout="this.style.borderColor='rgba(29,53,119,0.11)'">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#64748b"
                        stroke-width="2" stroke-linecap="round">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M20 21a8 8 0 1 0-16 0" />
                    </svg>
                </div>
            </header>

            <!-- SCROLLABLE MAIN CONTENT -->
            <div class="main-scroll" style="flex:1; overflow-y:auto; padding:18px 20px;">

                <!-- WELCOME BANNER -->
                <div
                    style="position:relative;border-radius:16px;padding:20px 24px;color:#fff;display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;overflow:hidden;background:linear-gradient(120deg,#0e1e45 0%,#1d3577 45%,#2a4a9e 75%,#4d9de0 100%);">
                    <div
                        style="position:absolute;top:-30px;right:120px;width:150px;height:150px;background:rgba(255,255,255,0.06);border-radius:50%;pointer-events:none;">
                    </div>
                    <div
                        style="position:absolute;bottom:-50px;right:60px;width:200px;height:200px;background:rgba(255,255,255,0.04);border-radius:50%;pointer-events:none;">
                    </div>
                    <div style="position:relative;z-index:1;">
                        <div style="font-size:17px;font-weight:700;margin-bottom:3px;">Good morning, Juan! 👋</div>
                        <div style="font-size:12px;color:rgba(255,255,255,0.62);">Here's what's happening with your
                            inventory today.</div>
                    </div>
                    <div style="position:relative;z-index:1;display:flex;align-items:center;gap:20px;">
                        <div style="text-align:right;">
                            <div
                                style="font-family:'DM Mono',monospace;font-size:20px;font-weight:700;letter-spacing:-0.5px;">
                                ₱2.4M</div>
                            <div style="font-size:10.5px;color:rgba(255,255,255,0.48);">Total Stock Value</div>
                        </div>
                        <div style="width:1px;height:32px;background:rgba(255,255,255,0.15);"></div>
                        <div style="text-align:right;">
                            <div
                                style="font-family:'DM Mono',monospace;font-size:20px;font-weight:700;letter-spacing:-0.5px;">
                                94.2%</div>
                            <div style="font-size:10.5px;color:rgba(255,255,255,0.48);">Fulfillment Rate</div>
                        </div>
                    </div>
                </div>

                <!-- KPI CARDS -->
                <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:18px;">

                    <!-- Card 1 -->
                    <div style="background:#fff;border:1px solid rgba(29,53,119,0.11);border-radius:12px;padding:16px;cursor:pointer;transition:border-color 0.2s,box-shadow 0.2s;"
                        onmouseover="this.style.borderColor='#4d9de0';this.style.boxShadow='0 4px 18px rgba(29,53,119,0.1)'"
                        onmouseout="this.style.borderColor='rgba(29,53,119,0.11)';this.style.boxShadow=''">
                        <div
                            style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px;">
                            <div
                                style="width:35px;height:35px;border-radius:9px;background:rgba(29,53,119,0.08);display:flex;align-items:center;justify-content:center;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="#1d3577" stroke-width="2" stroke-linecap="round">
                                    <path
                                        d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                                </svg>
                            </div>
                            <span
                                style="font-family:'DM Mono',monospace;font-size:10.5px;font-weight:600;padding:2px 7px;border-radius:5px;background:rgba(46,204,142,0.1);color:#1a9966;">+12%</span>
                        </div>
                        <div
                            style="font-family:'DM Mono',monospace;font-size:23px;font-weight:700;color:#0e1e45;letter-spacing:-1px;line-height:1;margin-bottom:3px;">
                            2,481</div>
                        <div style="font-size:11.5px;color:#8a9abf;">Total Products</div>
                    </div>

                    <!-- Card 2 -->
                    <div style="background:#fff;border:1px solid rgba(29,53,119,0.11);border-radius:12px;padding:16px;cursor:pointer;transition:border-color 0.2s,box-shadow 0.2s;"
                        onmouseover="this.style.borderColor='#4d9de0';this.style.boxShadow='0 4px 18px rgba(29,53,119,0.1)'"
                        onmouseout="this.style.borderColor='rgba(29,53,119,0.11)';this.style.boxShadow=''">
                        <div
                            style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px;">
                            <div
                                style="width:35px;height:35px;border-radius:9px;background:rgba(46,204,142,0.1);display:flex;align-items:center;justify-content:center;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="#2ecc8e" stroke-width="2" stroke-linecap="round">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                            </div>
                            <span
                                style="font-family:'DM Mono',monospace;font-size:10.5px;font-weight:600;padding:2px 7px;border-radius:5px;background:rgba(46,204,142,0.1);color:#1a9966;">+8%</span>
                        </div>
                        <div
                            style="font-family:'DM Mono',monospace;font-size:23px;font-weight:700;color:#0e1e45;letter-spacing:-1px;line-height:1;margin-bottom:3px;">
                            2,104</div>
                        <div style="font-size:11.5px;color:#8a9abf;">In Stock</div>
                    </div>

                    <!-- Card 3 -->
                    <div style="background:#fff;border:1px solid rgba(29,53,119,0.11);border-radius:12px;padding:16px;cursor:pointer;transition:border-color 0.2s,box-shadow 0.2s;"
                        onmouseover="this.style.borderColor='#4d9de0';this.style.boxShadow='0 4px 18px rgba(29,53,119,0.1)'"
                        onmouseout="this.style.borderColor='rgba(29,53,119,0.11)';this.style.boxShadow=''">
                        <div
                            style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px;">
                            <div
                                style="width:35px;height:35px;border-radius:9px;background:rgba(245,166,35,0.1);display:flex;align-items:center;justify-content:center;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="#f5a623" stroke-width="2" stroke-linecap="round">
                                    <path
                                        d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                                    <line x1="12" y1="9" x2="12" y2="13" />
                                    <line x1="12" y1="17" x2="12.01" y2="17" />
                                </svg>
                            </div>
                            <span
                                style="font-family:'DM Mono',monospace;font-size:10.5px;font-weight:600;padding:2px 7px;border-radius:5px;background:rgba(245,166,35,0.1);color:#c07a00;">–3%</span>
                        </div>
                        <div
                            style="font-family:'DM Mono',monospace;font-size:23px;font-weight:700;color:#0e1e45;letter-spacing:-1px;line-height:1;margin-bottom:3px;">
                            243</div>
                        <div style="font-size:11.5px;color:#8a9abf;">Low Stock Alert</div>
                    </div>

                    <!-- Card 4 -->
                    <div style="background:#fff;border:1px solid rgba(29,53,119,0.11);border-radius:12px;padding:16px;cursor:pointer;transition:border-color 0.2s,box-shadow 0.2s;"
                        onmouseover="this.style.borderColor='#4d9de0';this.style.boxShadow='0 4px 18px rgba(29,53,119,0.1)'"
                        onmouseout="this.style.borderColor='rgba(29,53,119,0.11)';this.style.boxShadow=''">
                        <div
                            style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px;">
                            <div
                                style="width:35px;height:35px;border-radius:9px;background:rgba(232,93,108,0.1);display:flex;align-items:center;justify-content:center;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="#e85d6c" stroke-width="2" stroke-linecap="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="15" y1="9" x2="9" y2="15" />
                                    <line x1="9" y1="9" x2="15" y2="15" />
                                </svg>
                            </div>
                            <span
                                style="font-family:'DM Mono',monospace;font-size:10.5px;font-weight:600;padding:2px 7px;border-radius:5px;background:rgba(232,93,108,0.1);color:#c03042;">+2%</span>
                        </div>
                        <div
                            style="font-family:'DM Mono',monospace;font-size:23px;font-weight:700;color:#0e1e45;letter-spacing:-1px;line-height:1;margin-bottom:3px;">
                            134</div>
                        <div style="font-size:11.5px;color:#8a9abf;">Out of Stock</div>
                    </div>
                </div>

                <!-- TABLE + RIGHT PANEL -->
                <div style="display:grid;grid-template-columns:1fr 290px;gap:14px;margin-bottom:18px;">

                    <!-- INVENTORY TABLE -->
                    <div
                        style="background:#fff;border:1px solid rgba(29,53,119,0.11);border-radius:12px;padding:16px;">
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:13px;">
                            <div style="font-size:13.5px;font-weight:700;color:#0e1e45;">Recent Inventory</div>
                            <a href="#"
                                style="font-size:11.5px;font-weight:600;color:#4d9de0;text-decoration:none;"
                                onmouseover="this.style.color='#1d3577'" onmouseout="this.style.color='#4d9de0'">View
                                all →</a>
                        </div>
                        <table style="width:100%;border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <th
                                        style="text-align:left;font-family:'DM Mono',monospace;font-size:9.5px;font-weight:600;color:#8a9abf;letter-spacing:0.8px;text-transform:uppercase;padding:4px 8px;border-bottom:1px solid rgba(29,53,119,0.08);">
                                        Product</th>
                                    <th
                                        style="text-align:left;font-family:'DM Mono',monospace;font-size:9.5px;font-weight:600;color:#8a9abf;letter-spacing:0.8px;text-transform:uppercase;padding:4px 8px;border-bottom:1px solid rgba(29,53,119,0.08);">
                                        Category</th>
                                    <th
                                        style="text-align:left;font-family:'DM Mono',monospace;font-size:9.5px;font-weight:600;color:#8a9abf;letter-spacing:0.8px;text-transform:uppercase;padding:4px 8px;border-bottom:1px solid rgba(29,53,119,0.08);">
                                        Qty</th>
                                    <th
                                        style="text-align:left;font-family:'DM Mono',monospace;font-size:9.5px;font-weight:600;color:#8a9abf;letter-spacing:0.8px;text-transform:uppercase;padding:4px 8px;border-bottom:1px solid rgba(29,53,119,0.08);">
                                        Status</th>
                                    <th
                                        style="text-align:left;font-family:'DM Mono',monospace;font-size:9.5px;font-weight:600;color:#8a9abf;letter-spacing:0.8px;text-transform:uppercase;padding:4px 8px;border-bottom:1px solid rgba(29,53,119,0.08);">
                                        Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="inv-row">
                                    <td style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);">
                                        <div style="display:flex;align-items:center;gap:8px;">
                                            <div
                                                style="width:27px;height:27px;border-radius:6px;background:#eff6ff;display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0;">
                                                📦</div>
                                            <div>
                                                <div style="font-size:12px;font-weight:600;color:#0e1e45;">Wireless
                                                    Keyboard</div>
                                                <div
                                                    style="font-family:'DM Mono',monospace;font-size:9.5px;color:#8a9abf;">
                                                    SKU-00421</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);font-size:11px;color:#8a9abf;">
                                        Electronics</td>
                                    <td
                                        style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);font-family:'DM Mono',monospace;font-weight:600;font-size:12.5px;color:#0e1e45;">
                                        154</td>
                                    <td style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);">
                                        <span
                                            style="font-family:'DM Mono',monospace;font-size:10px;font-weight:600;padding:2px 6px;border-radius:5px;background:rgba(46,204,142,0.1);color:#1a9966;">In
                                            Stock</span>
                                    </td>
                                    <td
                                        style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);font-family:'DM Mono',monospace;font-size:11.5px;color:#0e1e45;">
                                        ₱46,200</td>
                                </tr>
                                <tr class="inv-row">
                                    <td style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);">
                                        <div style="display:flex;align-items:center;gap:8px;">
                                            <div
                                                style="width:27px;height:27px;border-radius:6px;background:#fff7ed;display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0;">
                                                🖥️</div>
                                            <div>
                                                <div style="font-size:12px;font-weight:600;color:#0e1e45;">USB-C Hub
                                                    Pro</div>
                                                <div
                                                    style="font-family:'DM Mono',monospace;font-size:9.5px;color:#8a9abf;">
                                                    SKU-00389</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);font-size:11px;color:#8a9abf;">
                                        Accessories</td>
                                    <td
                                        style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);font-family:'DM Mono',monospace;font-weight:600;font-size:12.5px;color:#0e1e45;">
                                        8</td>
                                    <td style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);">
                                        <span
                                            style="font-family:'DM Mono',monospace;font-size:10px;font-weight:600;padding:2px 6px;border-radius:5px;background:rgba(245,166,35,0.12);color:#c07a00;">Low
                                            Stock</span>
                                    </td>
                                    <td
                                        style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);font-family:'DM Mono',monospace;font-size:11.5px;color:#0e1e45;">
                                        ₱12,800</td>
                                </tr>
                                <tr class="inv-row">
                                    <td style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);">
                                        <div style="display:flex;align-items:center;gap:8px;">
                                            <div
                                                style="width:27px;height:27px;border-radius:6px;background:#f0fff4;display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0;">
                                                🖨️</div>
                                            <div>
                                                <div style="font-size:12px;font-weight:600;color:#0e1e45;">Laser
                                                    Printer A4</div>
                                                <div
                                                    style="font-family:'DM Mono',monospace;font-size:9.5px;color:#8a9abf;">
                                                    SKU-00312</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);font-size:11px;color:#8a9abf;">
                                        Office</td>
                                    <td
                                        style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);font-family:'DM Mono',monospace;font-weight:600;font-size:12.5px;color:#0e1e45;">
                                        0</td>
                                    <td style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);">
                                        <span
                                            style="font-family:'DM Mono',monospace;font-size:10px;font-weight:600;padding:2px 6px;border-radius:5px;background:rgba(232,93,108,0.1);color:#c03042;">Out
                                            of Stock</span>
                                    </td>
                                    <td
                                        style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);font-family:'DM Mono',monospace;font-size:11.5px;color:#0e1e45;">
                                        ₱0</td>
                                </tr>
                                <tr class="inv-row">
                                    <td style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);">
                                        <div style="display:flex;align-items:center;gap:8px;">
                                            <div
                                                style="width:27px;height:27px;border-radius:6px;background:#f5f3ff;display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0;">
                                                💺</div>
                                            <div>
                                                <div style="font-size:12px;font-weight:600;color:#0e1e45;">Ergonomic
                                                    Chair</div>
                                                <div
                                                    style="font-family:'DM Mono',monospace;font-size:9.5px;color:#8a9abf;">
                                                    SKU-00278</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);font-size:11px;color:#8a9abf;">
                                        Furniture</td>
                                    <td
                                        style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);font-family:'DM Mono',monospace;font-weight:600;font-size:12.5px;color:#0e1e45;">
                                        37</td>
                                    <td style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);">
                                        <span
                                            style="font-family:'DM Mono',monospace;font-size:10px;font-weight:600;padding:2px 6px;border-radius:5px;background:rgba(46,204,142,0.1);color:#1a9966;">In
                                            Stock</span>
                                    </td>
                                    <td
                                        style="padding:8px 8px;border-bottom:1px solid rgba(29,53,119,0.05);font-family:'DM Mono',monospace;font-size:11.5px;color:#0e1e45;">
                                        ₱222,000</td>
                                </tr>
                                <tr class="inv-row">
                                    <td style="padding:8px 8px;">
                                        <div style="display:flex;align-items:center;gap:8px;">
                                            <div
                                                style="width:27px;height:27px;border-radius:6px;background:#fff1f2;display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0;">
                                                📱</div>
                                            <div>
                                                <div style="font-size:12px;font-weight:600;color:#0e1e45;">Tablet Stand
                                                </div>
                                                <div
                                                    style="font-family:'DM Mono',monospace;font-size:9.5px;color:#8a9abf;">
                                                    SKU-00254</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding:8px 8px;font-size:11px;color:#8a9abf;">Accessories</td>
                                    <td
                                        style="padding:8px 8px;font-family:'DM Mono',monospace;font-weight:600;font-size:12.5px;color:#0e1e45;">
                                        12</td>
                                    <td style="padding:8px 8px;">
                                        <span
                                            style="font-family:'DM Mono',monospace;font-size:10px;font-weight:600;padding:2px 6px;border-radius:5px;background:rgba(245,166,35,0.12);color:#c07a00;">Low
                                            Stock</span>
                                    </td>
                                    <td
                                        style="padding:8px 8px;font-family:'DM Mono',monospace;font-size:11.5px;color:#0e1e45;">
                                        ₱9,600</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- RIGHT PANEL: Quick Actions + Activity -->
                    <div style="display:flex;flex-direction:column;gap:14px;">

                        <!-- QUICK ACTIONS -->
                        <div
                            style="background:#fff;border:1px solid rgba(29,53,119,0.11);border-radius:12px;padding:16px;">
                            <div style="font-size:13.5px;font-weight:700;color:#0e1e45;margin-bottom:11px;">Quick
                                Actions</div>
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                                <button
                                    style="display:flex;flex-direction:column;align-items:center;gap:6px;padding:12px 8px;border-radius:9px;background:#1d3577;border:none;cursor:pointer;transition:background 0.18s;"
                                    onmouseover="this.style.background='#2a4a9e'"
                                    onmouseout="this.style.background='#1d3577'">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                        stroke="white" stroke-width="2" stroke-linecap="round">
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    <span style="font-size:11px;font-weight:600;color:#fff;">Add Product</span>
                                </button>
                                <button
                                    style="display:flex;flex-direction:column;align-items:center;gap:6px;padding:12px 8px;border-radius:9px;background:#f0f4ff;border:1.5px solid rgba(29,53,119,0.12);cursor:pointer;transition:border-color 0.18s;"
                                    onmouseover="this.style.borderColor='#1d3577'"
                                    onmouseout="this.style.borderColor='rgba(29,53,119,0.12)'">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                        stroke="#1d3577" stroke-width="2" stroke-linecap="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                        <polyline points="17 8 12 3 7 8" />
                                        <line x1="12" y1="3" x2="12" y2="15" />
                                    </svg>
                                    <span style="font-size:11px;font-weight:600;color:#0e1e45;">Import CSV</span>
                                </button>
                                <button
                                    style="display:flex;flex-direction:column;align-items:center;gap:6px;padding:12px 8px;border-radius:9px;background:#f0f4ff;border:1.5px solid rgba(29,53,119,0.12);cursor:pointer;transition:border-color 0.18s;"
                                    onmouseover="this.style.borderColor='#1d3577'"
                                    onmouseout="this.style.borderColor='rgba(29,53,119,0.12)'">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                        stroke="#1d3577" stroke-width="2" stroke-linecap="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                        <polyline points="7 10 12 15 17 10" />
                                        <line x1="12" y1="15" x2="12" y2="3" />
                                    </svg>
                                    <span style="font-size:11px;font-weight:600;color:#0e1e45;">Export Report</span>
                                </button>
                                <button
                                    style="display:flex;flex-direction:column;align-items:center;gap:6px;padding:12px 8px;border-radius:9px;background:#f0f4ff;border:1.5px solid rgba(29,53,119,0.12);cursor:pointer;transition:border-color 0.18s;"
                                    onmouseover="this.style.borderColor='#1d3577'"
                                    onmouseout="this.style.borderColor='rgba(29,53,119,0.12)'">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                        stroke="#1d3577" stroke-width="2" stroke-linecap="round">
                                        <circle cx="11" cy="11" r="8" />
                                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                    </svg>
                                    <span style="font-size:11px;font-weight:600;color:#0e1e45;">Stock Check</span>
                                </button>
                            </div>
                        </div>

                        <!-- ACTIVITY FEED -->
                        <div
                            style="background:#fff;border:1px solid rgba(29,53,119,0.11);border-radius:12px;padding:16px;flex:1;">
                            <div
                                style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                                <div style="font-size:13.5px;font-weight:700;color:#0e1e45;">Recent Activity</div>
                                <a href="#"
                                    style="font-size:11px;font-weight:600;color:#4d9de0;text-decoration:none;">See
                                    all</a>
                            </div>

                            <div
                                style="display:flex;align-items:flex-start;gap:9px;padding:9px 0;border-bottom:1px solid rgba(29,53,119,0.06);">
                                <div
                                    style="width:26px;height:26px;border-radius:50%;background:rgba(46,204,142,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                        stroke="#2ecc8e" stroke-width="2.5" stroke-linecap="round">
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                </div>
                                <div>
                                    <div style="font-size:11.5px;color:#0e1e45;line-height:1.4;"><strong>+50
                                            units</strong> added to Wireless Keyboard</div>
                                    <div
                                        style="font-family:'DM Mono',monospace;font-size:9.5px;color:#8a9abf;margin-top:1px;">
                                        2 min ago · by Maria S.</div>
                                </div>
                            </div>

                            <div
                                style="display:flex;align-items:flex-start;gap:9px;padding:9px 0;border-bottom:1px solid rgba(29,53,119,0.06);">
                                <div
                                    style="width:26px;height:26px;border-radius:50%;background:rgba(245,166,35,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                        stroke="#f5a623" stroke-width="2.5" stroke-linecap="round">
                                        <path
                                            d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                                        <line x1="12" y1="9" x2="12" y2="13" />
                                    </svg>
                                </div>
                                <div>
                                    <div style="font-size:11.5px;color:#0e1e45;line-height:1.4;"><strong>USB-C
                                            Hub</strong> is running low (8 units)</div>
                                    <div
                                        style="font-family:'DM Mono',monospace;font-size:9.5px;color:#8a9abf;margin-top:1px;">
                                        15 min ago · Auto-alert</div>
                                </div>
                            </div>

                            <div
                                style="display:flex;align-items:flex-start;gap:9px;padding:9px 0;border-bottom:1px solid rgba(29,53,119,0.06);">
                                <div
                                    style="width:26px;height:26px;border-radius:50%;background:rgba(232,93,108,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                        stroke="#e85d6c" stroke-width="2.5" stroke-linecap="round">
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                </div>
                                <div>
                                    <div style="font-size:11.5px;color:#0e1e45;line-height:1.4;"><strong>–20
                                            units</strong> dispatched · PO #1042</div>
                                    <div
                                        style="font-family:'DM Mono',monospace;font-size:9.5px;color:#8a9abf;margin-top:1px;">
                                        1 hr ago · by Lean G.</div>
                                </div>
                            </div>

                            <div style="display:flex;align-items:flex-start;gap:9px;padding:9px 0;">
                                <div
                                    style="width:26px;height:26px;border-radius:50%;background:rgba(29,53,119,0.08);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                        stroke="#1d3577" stroke-width="2.5" stroke-linecap="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                </div>
                                <div>
                                    <div style="font-size:11.5px;color:#0e1e45;line-height:1.4;">Price updated for
                                        <strong>Ergonomic Chair</strong></div>
                                    <div
                                        style="font-family:'DM Mono',monospace;font-size:9.5px;color:#8a9abf;margin-top:1px;">
                                        3 hrs ago · by Admin</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STOCK MOVEMENT CHART -->
                <div style="background:#fff;border:1px solid rgba(29,53,119,0.11);border-radius:12px;padding:16px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:13px;">
                        <div style="font-size:13.5px;font-weight:700;color:#0e1e45;">Stock Movement — Last 7 Days</div>
                        <div style="display:flex;gap:14px;align-items:center;">
                            <div style="display:flex;align-items:center;gap:5px;font-size:11px;color:#8a9abf;">
                                <div style="width:9px;height:9px;background:#1d3577;border-radius:2px;"></div> Received
                            </div>
                            <div style="display:flex;align-items:center;gap:5px;font-size:11px;color:#8a9abf;">
                                <div style="width:9px;height:9px;background:#4d9de0;border-radius:2px;opacity:0.6;">
                                </div> Dispatched
                            </div>
                        </div>
                    </div>
                    <div style="display:flex;align-items:flex-end;gap:6px;height:100px;">
                        <div style="display:flex;gap:3px;align-items:flex-end;flex:1;height:100%;">
                            <div class="bar-r" style="flex:1;height:60%;"></div>
                            <div class="bar-d" style="flex:1;height:40%;"></div>
                        </div>
                        <div style="display:flex;gap:3px;align-items:flex-end;flex:1;height:100%;">
                            <div class="bar-r" style="flex:1;height:80%;"></div>
                            <div class="bar-d" style="flex:1;height:55%;"></div>
                        </div>
                        <div style="display:flex;gap:3px;align-items:flex-end;flex:1;height:100%;">
                            <div class="bar-r" style="flex:1;height:45%;"></div>
                            <div class="bar-d" style="flex:1;height:70%;"></div>
                        </div>
                        <div style="display:flex;gap:3px;align-items:flex-end;flex:1;height:100%;">
                            <div class="bar-r" style="flex:1;height:90%;"></div>
                            <div class="bar-d" style="flex:1;height:60%;"></div>
                        </div>
                        <div style="display:flex;gap:3px;align-items:flex-end;flex:1;height:100%;">
                            <div class="bar-r" style="flex:1;height:70%;"></div>
                            <div class="bar-d" style="flex:1;height:85%;"></div>
                        </div>
                        <div style="display:flex;gap:3px;align-items:flex-end;flex:1;height:100%;">
                            <div class="bar-r" style="flex:1;height:55%;"></div>
                            <div class="bar-d" style="flex:1;height:45%;"></div>
                        </div>
                        <div style="display:flex;gap:3px;align-items:flex-end;flex:1;height:100%;">
                            <div class="bar-r" style="flex:1;height:100%;"></div>
                            <div class="bar-d" style="flex:1;height:75%;"></div>
                        </div>
                    </div>
                    <div style="display:flex;gap:6px;margin-top:7px;">
                        <div
                            style="flex:1;text-align:center;font-family:'DM Mono',monospace;font-size:9.5px;color:#8a9abf;">
                            Mon</div>
                        <div
                            style="flex:1;text-align:center;font-family:'DM Mono',monospace;font-size:9.5px;color:#8a9abf;">
                            Tue</div>
                        <div
                            style="flex:1;text-align:center;font-family:'DM Mono',monospace;font-size:9.5px;color:#8a9abf;">
                            Wed</div>
                        <div
                            style="flex:1;text-align:center;font-family:'DM Mono',monospace;font-size:9.5px;color:#8a9abf;">
                            Thu</div>
                        <div
                            style="flex:1;text-align:center;font-family:'DM Mono',monospace;font-size:9.5px;color:#8a9abf;">
                            Fri</div>
                        <div
                            style="flex:1;text-align:center;font-family:'DM Mono',monospace;font-size:9.5px;color:#8a9abf;">
                            Sat</div>
                        <div
                            style="flex:1;text-align:center;font-family:'DM Mono',monospace;font-size:9.5px;color:#8a9abf;">
                            Sun</div>
                    </div>
                </div>

                <!-- Bottom breathing room -->
                <div style="height:18px;"></div>

            </div><!-- /main-scroll -->
        </div><!-- /right side -->
    </div><!-- /root -->

</body>

</html>
