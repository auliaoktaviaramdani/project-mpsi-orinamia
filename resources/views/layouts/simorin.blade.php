<!DOCTYPE html>
<html lang="id" x-data="{ dark: localStorage.getItem('orinamia-theme')==='dark', mobileMenu: false }"
      x-init="$watch('dark', v => { document.documentElement.classList.toggle('dark', v); localStorage.setItem('orinamia-theme', v ? 'dark' : 'light') })"
      :class="{ 'dark': dark }"
      class="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Orinamia Daily Wear') - Sistem Manajemen</title>
  <meta name="description" content="Sistem manajemen penjualan, invoice, dan pembelian bahan baku Orinamia Daily Wear">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Newsreader:ital,opsz,wght@0,6..72,500;0,6..72,600;1,6..72,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Alpine.js & Plugins -->
  <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <!-- Anime.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg:        #FAF9FC;
      --card:      #FFFFFF;
      --tint:      #F4EFFA;
      --border:    #E4DFEC;
      --text:      #2D2B33;
      --muted:     #635D73;
      --accent:    #6E387A;
      --accent-h:  #582B62;
      --pink:      #F391EC;
      --lavender:  #AD8EEB;
      --ring:      #454547;
    }
    .dark {
      --bg:        #17161B;
      --card:      #211F27;
      --tint:      #2C2836;
      --border:    #363242;
      --text:      #F4F2F7;
      --muted:     #B5AFC4;
      --accent:    #CFA8F5;
      --accent-h:  #E0C0FF;
      --ring:      #6B5A7E;
    }

    html { scroll-behavior: smooth; }
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* Typography */
    .font-editorial { font-family: 'Newsreader', Georgia, serif; }
    .font-num {
      font-family: 'JetBrains Mono', monospace;
      font-variant-numeric: tabular-nums;
      white-space: nowrap;
    }

    /* Surfaces */
    .surface       { background: var(--card); border: 1px solid var(--border); }
    .surface-tint  { background: var(--tint); border: 1px solid var(--border); }

    /* Divider */
    .thread-divider { border-top: 1.5px dashed #D5CEE2; }
    .dark .thread-divider { border-top: 1.5px dashed #3E394D; }

    /* Badges */
    .badge-belum  { background:#FEE2E2; color:#7F1D1D; }
    .badge-dp     { background:#FEF3C7; color:#78350F; }
    .badge-lunas  { background:#D1FAE5; color:#064E3B; }
    .badge-kirim  { background:#DBEAFE; color:#1E40AF; }
    .dark .badge-belum { background:#450A0A; color:#FCA5A5; }
    .dark .badge-dp    { background:#422006; color:#FDE68A; }
    .dark .badge-lunas { background:#052E16; color:#6EE7B7; }
    .dark .badge-kirim { background:#172554; color:#93C5FD; }

    /* Buttons */
    .btn-primary {
      display: inline-flex; align-items: center; gap: 6px;
      min-height: 44px; padding: 8px 18px;
      border-radius: 6px;
      background: var(--accent); color: #fff;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 0.8125rem; font-weight: 600;
      border: none; cursor: pointer;
      transition: background 150ms;
      text-decoration: none;
    }
    .btn-primary:hover { background: var(--accent-h); }
    .btn-primary:disabled { opacity: 0.5; cursor: not-allowed; }

    .btn-outline {
      display: inline-flex; align-items: center; gap: 6px;
      min-height: 40px; padding: 6px 14px;
      border-radius: 6px;
      background: var(--card); color: var(--text);
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 0.8125rem; font-weight: 600;
      border: 1px solid var(--border); cursor: pointer;
      transition: background 150ms;
      text-decoration: none;
    }
    .btn-outline:hover { background: var(--tint); }

    .btn-danger {
      display: inline-flex; align-items: center; gap: 6px;
      min-height: 40px; padding: 6px 14px;
      border-radius: 6px;
      background: #FEE2E2; color: #7F1D1D;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 0.8125rem; font-weight: 600;
      border: 1px solid #FCA5A5; cursor: pointer;
      transition: background 150ms;
      text-decoration: none;
    }
    .btn-danger:hover { background: #FCA5A5; }
    .btn-danger:disabled { opacity: 0.5; cursor: not-allowed; }

    /* Inputs */
    .form-input {
      width: 100%; min-height: 42px;
      padding: 8px 12px;
      border-radius: 6px;
      border: 1px solid var(--border);
      background: var(--card);
      color: var(--text);
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 0.875rem;
      transition: border-color 150ms;
    }
    .form-input:focus {
      outline: none;
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(110, 56, 122, 0.15);
    }
    .form-label {
      display: block; font-size: 0.75rem;
      font-weight: 600; color: var(--muted);
      margin-bottom: 4px;
    }

    /* Table */
    .tbl th {
      padding: 10px 16px; font-size: 0.7rem;
      font-weight: 700; text-transform: uppercase;
      letter-spacing: 0.05em; color: var(--muted);
      background: var(--tint);
      border-bottom: 1px solid var(--border);
      white-space: nowrap;
    }
    .tbl td {
      padding: 14px 16px; font-size: 0.8375rem;
      border-bottom: 1px solid var(--border);
      vertical-align: middle;
    }
    .tbl tbody tr { transition: background 120ms; }
    .tbl tbody tr:hover { background: var(--tint); }
    .tbl tbody tr:last-child td { border-bottom: none; }

    /* [reactbits.dev & 21st.dev] Panel & Spotlight Surfaces */
    .panel, .surface, .spotlight-card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 8px;
      position: relative;
      overflow: hidden;
      transition: transform 200ms cubic-bezier(0.16, 1, 0.3, 1), box-shadow 200ms ease, border-color 200ms ease;
    }
    .panel::before, .surface::before, .spotlight-card::before {
      content: '';
      position: absolute;
      top: var(--mouse-y, -1000px);
      left: var(--mouse-x, -1000px);
      width: 450px;
      height: 450px;
      transform: translate(-50%, -50%);
      background: radial-gradient(circle, rgba(173, 142, 235, 0.12) 0%, rgba(243, 145, 236, 0.03) 45%, transparent 70%);
      pointer-events: none;
      opacity: 0;
      transition: opacity 250ms ease;
      z-index: 1;
    }
    .panel:hover::before, .surface:hover::before, .spotlight-card:hover::before {
      opacity: 1;
    }
    .panel:hover {
      border-color: var(--lavender);
      box-shadow: 0 8px 24px -8px rgba(110, 56, 122, 0.08);
    }
    .dark .panel:hover {
      border-color: var(--accent);
      box-shadow: 0 8px 24px -8px rgba(0, 0, 0, 0.5);
    }

    /* [reactbits.dev] Shiny Shimmer Text */
    .shiny-text {
      background: linear-gradient(110deg, var(--text) 30%, var(--pink) 50%, var(--lavender) 60%, var(--text) 75%);
      background-size: 220% 100%;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      display: inline-block;
      animation: shineSweep 5s linear infinite;
    }
    @keyframes shineSweep {
      0% { background-position: 200% 0; }
      100% { background-position: -200% 0; }
    }

    /* [aura.build] Ambient Atmospheric Lighting */
    .aura-ambient {
      position: fixed;
      pointer-events: none;
      border-radius: 50%;
      filter: blur(100px);
      z-index: 0;
      opacity: 0.35;
    }
    .aura-ambient-1 {
      top: -100px; right: 5%; width: 550px; height: 550px;
      background: radial-gradient(circle, rgba(243, 145, 236, 0.2) 0%, transparent 70%);
    }
    .aura-ambient-2 {
      bottom: 5%; left: -100px; width: 600px; height: 600px;
      background: radial-gradient(circle, rgba(173, 142, 235, 0.2) 0%, transparent 70%);
    }
    .dark .aura-ambient { opacity: 0.2; }

    /* Focus visible */
    *:focus-visible {
      outline: 2px solid var(--accent) !important;
      outline-offset: 2px !important;
    }

    /* Nav pill */
    .nav-pill {
      min-height: 40px; padding: 6px 16px;
      border-radius: 6px; font-size: 0.8125rem;
      font-weight: 600; cursor: pointer;
      transition: all 150ms; border: none;
      text-decoration: none;
      display: inline-flex; align-items: center;
      white-space: nowrap;
    }
    .nav-pill-active {
      background: var(--card);
      color: var(--accent);
      border: 1px solid var(--border);
      box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    }
    .nav-pill-inactive {
      background: transparent;
      color: var(--muted);
    }
    .nav-pill-inactive:hover { color: var(--text); background: rgba(0,0,0,0.04); }

    /* Modal overlay */
    .modal-overlay {
      position: fixed; inset: 0; z-index: 50;
      background: rgba(0,0,0,0.5);
      display: flex; align-items: center; justify-content: center;
      padding: 16px;
    }
    .modal-box {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 24px;
      width: 100%; max-width: 480px;
      max-height: 90vh; overflow-y: auto;
      position: relative;
    }

    /* Loading shimmer */
    @keyframes shimmer {
      from { background-position: -200% 0; }
      to   { background-position: 200% 0; }
    }
    .shimmer {
      background: linear-gradient(90deg, var(--tint) 25%, var(--border) 50%, var(--tint) 75%);
      background-size: 200% 100%;
      animation: shimmer 1.5s infinite;
      border-radius: 4px;
    }

    /* Print */
    @media print {
      .no-print { display: none !important; }
    }

    /* Gradient ribbon */
    .brand-ribbon {
      height: 3px;
      background: linear-gradient(to right, #F391EC, #AD8EEB, #6E387A);
      flex-shrink: 0;
    }

    /* Pagination */
    .page-link {
      display: inline-flex; align-items: center; justify-content: center;
      min-width: 36px; height: 36px; padding: 0 8px;
      border-radius: 6px; font-size: 0.8125rem;
      border: 1px solid var(--border);
      color: var(--text); background: var(--card);
      text-decoration: none; transition: all 150ms;
    }
    .page-link:hover { background: var(--tint); }
    .page-link.active { background: var(--accent); color: #fff; border-color: var(--accent); }
    .page-link.disabled { opacity: 0.4; pointer-events: none; }

    /* Responsive */
    @media (max-width: 768px) {
      .desktop-only { display: none !important; }
    }
    @media (min-width: 769px) {
      .mobile-only { display: none !important; }
    }
  </style>

  @stack('styles')
</head>
<body>

  <!-- [aura.build] Ambient Atmospheric Light Orbs -->
  <div class="aura-ambient aura-ambient-1" aria-hidden="true"></div>
  <div class="aura-ambient aura-ambient-2" aria-hidden="true"></div>

  <!-- Gradient Ribbon -->
  <div class="brand-ribbon no-print" aria-hidden="true"></div>

  <!-- Header -->
  <header class="no-print sticky top-0 z-30" style="background:var(--card);border-bottom:1px solid var(--border);backdrop-filter:blur(14px);-webkit-backdrop-filter:blur(14px);">
    <div style="max-width:1520px;margin:0 auto;padding:0 24px;height:72px;display:flex;align-items:center;justify-content:space-between;gap:16px;">

      <!-- Logo + Brand -->
      <a href="{{ route('dashboard') }}" style="display:flex;align-items:center;gap:14px;text-decoration:none;flex-shrink:0;">
        <div style="width:44px;height:44px;border-radius:50%;background:#fff;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;padding:2px;">
          <svg width="36" height="36" viewBox="0 0 100 100" fill="none" role="img" aria-label="Logo Orinamia">
            <circle cx="50" cy="50" r="42" stroke="#454547" stroke-width="6.5"/>
            <path d="M50 7 L80 35 L70 50 L58 37 L50 27 L35 42 L41 52 L27 50 L20 35 Z" fill="#F391EC"/>
            <path d="M50 93 L20 65 L30 50 L42 63 L50 73 L65 58 L59 48 L73 50 L80 65 Z" fill="#AD8EEB"/>
            <polygon points="50,43 56,50 50,57 44,50" fill="#AD8EEB"/>
          </svg>
        </div>
        <div>
          <div style="font-size:1.125rem;font-weight:700;letter-spacing:0.12em;line-height:1.1;">
            <span style="color:#E074D8;">ORI</span><span style="color:#9B78E6;">NAMIA</span>
          </div>
          <div style="font-size:0.625rem;letter-spacing:0.3em;color:var(--muted);font-weight:600;">DAILY WEAR</div>
        </div>
      </a>

      <!-- Desktop Nav -->
      <nav class="desktop-only" style="display:flex;align-items:center;gap:6px;background:var(--bg);padding:6px;border-radius:8px;border:1px solid var(--border);" aria-label="Menu Utama">
        <a href="{{ route('dashboard') }}"
           class="nav-pill {{ request()->routeIs('dashboard') ? 'nav-pill-active' : 'nav-pill-inactive' }}">
          Dashboard
        </a>
        <a href="{{ route('penjualan.index') }}"
           class="nav-pill {{ request()->routeIs('penjualan.*') ? 'nav-pill-active' : 'nav-pill-inactive' }}">
          Penjualan
        </a>
        <a href="{{ route('pembelian.index') }}"
           class="nav-pill {{ request()->routeIs('pembelian.*') ? 'nav-pill-active' : 'nav-pill-inactive' }}">
          Pembelian
        </a>
        @can('admin')
        <a href="{{ route('master.pelanggan.index') }}"
           class="nav-pill {{ request()->routeIs('master.*') ? 'nav-pill-active' : 'nav-pill-inactive' }}">
          Data Master
        </a>
        @endcan
        <a href="{{ route('laporan.index') }}"
           class="nav-pill {{ request()->routeIs('laporan.*') ? 'nav-pill-active' : 'nav-pill-inactive' }}">
          Laporan
        </a>
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('akun.index') }}"
           class="nav-pill {{ request()->routeIs('akun.*') ? 'nav-pill-active' : 'nav-pill-inactive' }}">
          Akun
        </a>
        @endif
        <a href="{{ route('home') }}"
           class="nav-pill nav-pill-inactive" title="Halaman Depan Profil PT Cahaya Binar Berlian" target="_blank"
           style="color:var(--accent);border-left:1px dashed var(--border);padding-left:12px;margin-left:4px;display:inline-flex;align-items:center;gap:6px;">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"></circle>
            <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
          </svg>
          Web Profil PT
        </a>
      </nav>

      <!-- Right Controls -->
      <div style="display:flex;align-items:center;gap:10px;flex-shrink:0;">

        <!-- User badge -->
        <span class="desktop-only" style="font-size:0.75rem;color:var(--muted);">
          <strong style="color:var(--text);">{{ auth()->user()->name }}</strong>
          &bull; <span style="text-transform:capitalize;">{{ auth()->user()->role }}</span>
        </span>

        <!-- Theme toggle -->
        <button @click="dark = !dark" type="button" class="btn-outline" style="min-height:40px;padding:6px 12px;" title="Ganti tema">
          <span x-show="!dark">🌙</span>
          <span x-show="dark">☀️</span>
          <span x-text="dark ? 'Gelap' : 'Terang'" style="font-size:0.75rem;"></span>
        </button>

        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
          @csrf
          <button type="submit" class="btn-outline" style="min-height:40px;padding:6px 12px;font-size:0.75rem;">
            Keluar
          </button>
        </form>

        <!-- Mobile menu toggle -->
        <button @click="mobileMenu = !mobileMenu" type="button" class="mobile-only btn-outline" style="min-height:40px;padding:6px 10px;">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile nav -->
    <div x-show="mobileMenu" x-transition class="mobile-only" style="background:var(--bg);border-top:1px solid var(--border);padding:12px 16px;display:flex;flex-wrap:wrap;gap:8px;">
      <a href="{{ route('dashboard') }}" class="btn-outline" style="font-size:0.75rem;">Dashboard</a>
      <a href="{{ route('penjualan.index') }}" class="btn-outline" style="font-size:0.75rem;">Penjualan</a>
      <a href="{{ route('pembelian.index') }}" class="btn-outline" style="font-size:0.75rem;">Pembelian</a>
      @if(auth()->user()->role === 'admin')
      <a href="{{ route('master.pelanggan.index') }}" class="btn-outline" style="font-size:0.75rem;">Data Master</a>
      <a href="{{ route('akun.index') }}" class="btn-outline" style="font-size:0.75rem;">Akun</a>
      @endif
      <a href="{{ route('laporan.index') }}" class="btn-outline" style="font-size:0.75rem;">Laporan</a>
      <a href="{{ route('home') }}" class="btn-outline" target="_blank" style="font-size:0.75rem;color:var(--accent);font-weight:700;">🌐 Web Profil PT</a>
    </div>
  </header>

  <!-- Flash messages -->
  @if(session('success'))
  <div class="no-print" style="max-width:1520px;margin:0 auto;padding:16px 24px 0;"
       x-data="{ show: true }" x-show="show" x-transition>
    <div style="background:#D1FAE5;border:1px solid #6EE7B7;border-radius:8px;padding:12px 16px;display:flex;align-items:center;justify-content:space-between;gap:12px;">
      <div style="display:flex;align-items:center;gap:8px;">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#064E3B" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        <span style="font-size:0.8375rem;font-weight:600;color:#064E3B;">{{ session('success') }}</span>
      </div>
      <button @click="show=false" style="background:none;border:none;cursor:pointer;color:#064E3B;font-size:1rem;">&times;</button>
    </div>
  </div>
  @endif

  @if(session('error'))
  <div class="no-print" style="max-width:1520px;margin:0 auto;padding:16px 24px 0;"
       x-data="{ show: true }" x-show="show" x-transition>
    <div style="background:#FEE2E2;border:1px solid #FCA5A5;border-radius:8px;padding:12px 16px;display:flex;align-items:center;justify-content:space-between;gap:12px;">
      <div style="display:flex;align-items:center;gap:8px;">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#7F1D1D" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        <span style="font-size:0.8375rem;font-weight:600;color:#7F1D1D;">{{ session('error') }}</span>
      </div>
      <button @click="show=false" style="background:none;border:none;cursor:pointer;color:#7F1D1D;font-size:1rem;">&times;</button>
    </div>
  </div>
  @endif

  <!-- Main Content -->
  <main style="flex:1;max-width:1520px;width:100%;margin:0 auto;padding:24px;" id="main-content">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="no-print" style="border-top:1px solid var(--border);background:var(--card);padding:16px 24px;">
    <div style="max-width:1520px;margin:0 auto;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:8px;">
      <span style="font-size:0.75rem;color:var(--muted);">
        Orinamia Daily Wear &bull; Jalan Tongkol Raya no 20C perum 1 Karawaci Tangerang &bull; M: 085716107394
      </span>
      <span style="font-size:0.75rem;color:var(--muted);">
        Bank BSI <span class="font-num">7273909413</span> a/n PT Cahaya Binar Berlian
      </span>
    </div>
  </footer>

  <!-- [reactbits.dev & animejs.com] Global Spotlight & Motion Primitives -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // 1. Cursor Spotlight Tracking for all panels
      document.querySelectorAll('.panel, .surface, .spotlight-card').forEach(card => {
        card.addEventListener('mousemove', e => {
          const rect = card.getBoundingClientRect();
          card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
          card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
        });
      });

      // 2. Anime.js Entrance & Rolling Counters
      if (typeof anime !== 'undefined') {
        anime({
          targets: '.panel, .surface',
          opacity: [0.92, 1],
          translateY: [6, 0],
          delay: anime.stagger(30, { start: 80 }),
          duration: 600,
          easing: 'easeOutCubic'
        });

        document.querySelectorAll('.anim-counter').forEach(counter => {
          const targetVal = parseInt(counter.getAttribute('data-val'), 10) || 0;
          anime({
            targets: counter,
            innerHTML: [0, targetVal],
            round: 1,
            easing: 'easeOutExpo',
            duration: 1800,
            update: function(anim) {
              const current = Math.round(anim.animations[0].currentValue);
              if (targetVal >= 1000) {
                counter.innerHTML = current.toLocaleString('id-ID');
              } else {
                counter.innerHTML = current;
              }
            }
          });
        });
      }
    });
  </script>

  @stack('scripts')
</body>
</html>
