<!DOCTYPE html>
<html lang="id" x-data="{ dark: localStorage.getItem('orinamia-theme') === 'dark', mobileMenu: false, activeCat: 'medis', selectedColor: 'toska', calcQty: 50, calcType: 125000 }"
      x-init="$watch('dark', v => { document.documentElement.classList.toggle('dark', v); localStorage.setItem('orinamia-theme', v ? 'dark' : 'light') })"
      :class="{ 'dark': dark }"
      class="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PT Cahaya Binar Berlian - ORINAMIA Konveksi & Daily Wear</title>
  <meta name="description" content="Konveksi seragam profesional, seragam medis OKA, PDH/PDL, dan busana kerja terpercaya berlegalitas resmi AHU & NIB oleh PT Cahaya Binar Berlian. Berdiri sejak 2015.">

  <!-- Typography -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;0,6..72,600;1,6..72,400;1,6..72,500&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Alpine.js -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <!-- Anime.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg:           #FAF9FC;
      --surface:      #FFFFFF;
      --surface-tint: #F4EFFA;
      --border:       #E4DFEC;
      --border-subtle:#ECE7F2;
      --text:         #2D2B33;
      --text-muted:   #635D73;
      --accent:       #6E387A;
      --accent-hover: #582B62;
      --accent-light: #F4EFFA;
      --pink:         #F391EC;
      --lavender:     #AD8EEB;
      --aura-glow:    rgba(243, 145, 236, 0.12);
      --card-shadow:  0 10px 30px -10px rgba(110, 56, 122, 0.06), 0 1px 3px rgba(0,0,0,0.04);
    }

    .dark {
      --bg:           #121116;
      --surface:      #1B1921;
      --surface-tint: #24212C;
      --border:       #2E2A38;
      --border-subtle:#25212E;
      --text:         #F5F3F8;
      --text-muted:   #A9A3B5;
      --accent:       #CFA8F5;
      --accent-hover: #E1C5FF;
      --accent-light: rgba(207, 168, 245, 0.12);
      --pink:         #F391EC;
      --lavender:     #AD8EEB;
      --aura-glow:    rgba(173, 142, 235, 0.15);
      --card-shadow:  0 10px 35px -10px rgba(0, 0, 0, 0.5), 0 1px 3px rgba(0,0,0,0.3);
    }

    html { scroll-behavior: smooth; }
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background-color: var(--bg);
      color: var(--text);
      line-height: 1.6;
      overflow-x: hidden;
      transition: background-color 300ms ease, color 300ms ease;
    }

    .font-editorial { font-family: 'Newsreader', Georgia, serif; }
    .font-num {
      font-family: 'JetBrains Mono', monospace;
      font-variant-numeric: tabular-nums;
      white-space: nowrap;
    }

    /* Aura Atmospheric Background */
    .aura-spotlight {
      position: absolute;
      width: 700px;
      height: 700px;
      border-radius: 50%;
      background: radial-gradient(circle, var(--aura-glow) 0%, transparent 68%);
      filter: blur(80px);
      pointer-events: none;
      z-index: 0;
    }

    /* Glass Surfaces */
    .glass-nav {
      background: rgba(250, 249, 252, 0.85);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      border-bottom: 1px solid var(--border);
    }
    .dark .glass-nav {
      background: rgba(18, 17, 22, 0.85);
      border-bottom: 1px solid var(--border);
    }

    .atelier-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 12px;
      box-shadow: var(--card-shadow);
      transition: transform 250ms cubic-bezier(0.16, 1, 0.3, 1), box-shadow 250ms ease, border-color 250ms ease;
    }
    .atelier-card:hover {
      transform: translateY(-3px);
      border-color: var(--lavender);
      box-shadow: 0 16px 40px -12px rgba(110, 56, 122, 0.12);
    }
    .dark .atelier-card:hover {
      border-color: var(--accent);
      box-shadow: 0 16px 40px -12px rgba(0, 0, 0, 0.7);
    }

    /* Subtle Pattern */
    .dot-pattern {
      background-image: radial-gradient(var(--border) 1px, transparent 1px);
      background-size: 24px 24px;
    }

    /* Buttons */
    .btn-brand {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 22px;
      background: var(--accent);
      color: #FFFFFF;
      font-weight: 600;
      font-size: 0.875rem;
      border-radius: 8px;
      text-decoration: none;
      border: none;
      cursor: pointer;
      transition: all 200ms ease;
      box-shadow: 0 4px 14px rgba(110, 56, 122, 0.25);
    }
    .btn-brand:hover {
      background: var(--accent-hover);
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(110, 56, 122, 0.35);
    }

    .btn-ghost {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 20px;
      background: var(--surface);
      color: var(--text);
      font-weight: 600;
      font-size: 0.875rem;
      border-radius: 8px;
      text-decoration: none;
      border: 1px solid var(--border);
      cursor: pointer;
      transition: all 200ms ease;
    }
    .btn-ghost:hover {
      background: var(--surface-tint);
      border-color: var(--lavender);
    }

    /* Badge Pills */
    .badge-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 12px;
      border-radius: 999px;
      font-size: 0.75rem;
      font-weight: 600;
      background: var(--accent-light);
      color: var(--accent);
      border: 1px solid var(--border);
    }

    /* Brand Ribbon */
    .brand-ribbon {
      height: 3px;
      background: linear-gradient(90deg, #F391EC 0%, #AD8EEB 50%, #6E387A 100%);
      width: 100%;
    }

    /* Color Swatch Circle */
    .swatch-btn {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      border: 2px solid transparent;
      cursor: pointer;
      transition: transform 180ms ease, border-color 180ms ease;
      position: relative;
    }
    .swatch-btn:hover { transform: scale(1.15); }
    .swatch-btn.active {
      border-color: var(--accent);
      transform: scale(1.18);
      box-shadow: 0 0 0 3px rgba(110, 56, 122, 0.25);
    }

    /* Tab Switcher */
    .cat-tab {
      padding: 8px 18px;
      border-radius: 8px;
      font-size: 0.875rem;
      font-weight: 600;
      cursor: pointer;
      border: 1px solid transparent;
      transition: all 180ms ease;
      background: transparent;
      color: var(--text-muted);
    }
    .cat-tab.active {
      background: var(--surface);
      color: var(--accent);
      border-color: var(--border);
      box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .cat-tab:hover:not(.active) {
      color: var(--text);
      background: rgba(0,0,0,0.03);
    }

    /* [reactbits.dev] Spotlight Card Effect */
    .spotlight-card {
      position: relative;
      overflow: hidden;
    }
    .spotlight-card::before {
      content: '';
      position: absolute;
      top: var(--mouse-y, -1000px);
      left: var(--mouse-x, -1000px);
      width: 480px;
      height: 480px;
      transform: translate(-50%, -50%);
      background: radial-gradient(circle, rgba(173, 142, 235, 0.16) 0%, rgba(243, 145, 236, 0.04) 45%, transparent 70%);
      pointer-events: none;
      opacity: 0;
      transition: opacity 250ms ease;
      z-index: 1;
    }
    .spotlight-card:hover::before {
      opacity: 1;
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

    /* Shimmer Animation */
    @keyframes pulseAura {
      0%, 100% { opacity: 0.7; transform: scale(1); }
      50% { opacity: 1; transform: scale(1.05); }
    }
    .animate-aura {
      animation: pulseAura 8s infinite ease-in-out;
    }
  </style>
</head>
<body>

  @auth
  <!-- Authenticated User Top Bar: Smooth transition between Landing Page and SIMORIN Workspace -->
  <div style="background:var(--surface-tint);border-bottom:1px solid var(--border);padding:8px 24px;font-size:0.8125rem;">
    <div style="max-width:1280px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;">
      <div style="display:flex;align-items:center;gap:10px;">
        <span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:#10B981;box-shadow:0 0 8px rgba(16,185,129,0.6);"></span>
        <span style="color:var(--text-muted);">
          Sesi Aktif: <strong style="color:var(--text);">{{ auth()->user()->name }}</strong> (Peran: <span style="text-transform:capitalize;">{{ auth()->user()->role }}</span>)
        </span>
      </div>
      <div style="display:flex;align-items:center;gap:12px;">
        <a href="{{ route('dashboard') }}" class="btn-brand" style="padding:6px 14px;font-size:0.75rem;box-shadow:none;">
          Buka Dashboard Internal SIMORIN &rarr;
        </a>
      </div>
    </div>
  </div>
  @endauth

  <!-- Top Gem Ribbon -->
  <div class="brand-ribbon" aria-hidden="true"></div>

  <!-- Header & Navigation -->
  <header class="glass-nav sticky top-0 z-50">
    <div style="max-width:1280px;margin:0 auto;padding:0 24px;height:74px;display:flex;align-items:center;justify-content:space-between;gap:16px;">
      
      <!-- Brand Identity -->
      <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:12px;text-decoration:none;flex-shrink:0;">
        <div style="width:44px;height:44px;border-radius:50%;background:#fff;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;padding:2px;">
          <svg width="36" height="36" viewBox="0 0 100 100" fill="none" role="img" aria-label="Logo Orinamia Daily Wear">
            <circle cx="50" cy="50" r="42" stroke="#454547" stroke-width="6.5"/>
            <path d="M50 7 L80 35 L70 50 L58 37 L50 27 L35 42 L41 52 L27 50 L20 35 Z" fill="#F391EC"/>
            <path d="M50 93 L20 65 L30 50 L42 63 L50 73 L65 58 L59 48 L73 50 L80 65 Z" fill="#AD8EEB"/>
            <polygon points="50,43 56,50 50,57 44,50" fill="#AD8EEB"/>
          </svg>
        </div>
        <div>
          <div style="font-size:1.15rem;font-weight:700;letter-spacing:0.12em;line-height:1.1;">
            <span style="color:#E074D8;">ORI</span><span style="color:#9B78E6;">NAMIA</span>
          </div>
          <div style="font-size:0.65rem;letter-spacing:0.25em;color:var(--text-muted);font-weight:600;">
            PT CAHAYA BINAR BERLIAN
          </div>
        </div>
      </a>

      <!-- Desktop Links -->
      <nav style="display:none;align-items:center;gap:24px;" class="desktop-menu" aria-label="Navigasi Utama">
        <a href="#tentang" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Tentang Kami</a>
        <a href="#layanan" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Koleksi & Produk</a>
        <a href="#medis" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Seragam OKA</a>
        <a href="#klien" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Klien Kami</a>
        <a href="#alur" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Alur Kerjasama</a>
        <a href="#legalitas" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Legalitas</a>
      </nav>

      <!-- Right Actions -->
      <div style="display:flex;align-items:center;gap:12px;">
        
        <!-- Theme Toggle -->
        <button @click="dark = !dark" type="button" class="btn-ghost" style="padding:8px 12px;min-height:38px;" title="Ganti Tema">
          <span x-show="!dark">🌙</span>
          <span x-show="dark">☀️</span>
        </button>

        @auth
          <a href="{{ route('dashboard') }}" class="btn-brand">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Buka Meja Kerja
          </a>
        @else
          <a href="{{ route('login') }}" class="btn-brand">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Portal SIMORIN
          </a>
        @endauth

        <!-- Mobile hamburger -->
        <button @click="mobileMenu = !mobileMenu" class="btn-ghost mobile-btn" style="padding:8px;display:none;">
          <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div x-show="mobileMenu" x-transition style="border-top:1px solid var(--border);padding:16px 24px;display:flex;flex-direction:column;gap:12px;background:var(--surface);">
      <a href="#tentang" @click="mobileMenu = false" style="text-decoration:none;color:var(--text);font-weight:600;">Tentang Kami</a>
      <a href="#layanan" @click="mobileMenu = false" style="text-decoration:none;color:var(--text);font-weight:600;">Koleksi & Produk</a>
      <a href="#medis" @click="mobileMenu = false" style="text-decoration:none;color:var(--text);font-weight:600;">Seragam Medis OKA</a>
      <a href="#klien" @click="mobileMenu = false" style="text-decoration:none;color:var(--text);font-weight:600;">Klien Kami</a>
      <a href="#alur" @click="mobileMenu = false" style="text-decoration:none;color:var(--text);font-weight:600;">Alur Kerjasama</a>
      <a href="#legalitas" @click="mobileMenu = false" style="text-decoration:none;color:var(--text);font-weight:600;">Legalitas PT</a>
      <a href="https://wa.me/6285716107394" target="_blank" class="btn-brand" style="justify-content:center;margin-top:8px;">
        Konsultasi via WhatsApp (0857 1610 7394)
      </a>
    </div>
  </header>

  <style>
    @media (min-width: 900px) {
      .desktop-menu { display: flex !important; }
      .mobile-btn { display: none !important; }
    }
    @media (max-width: 899px) {
      .desktop-menu { display: none !important; }
      .mobile-btn { display: inline-flex !important; }
    }
  </style>

  <!-- HERO SECTION: High Editorial Atelier -->
  <section style="position:relative;padding:90px 24px 80px;overflow:hidden;border-bottom:1px solid var(--border);">
    
    <!-- Aura Ambient Radial Glow -->
    <div class="aura-spotlight animate-aura" style="top:-100px;left:50%;transform:translateX(-50%);"></div>

    <div style="max-width:1160px;margin:0 auto;position:relative;z-index:1;text-align:center;">
      
      <!-- Trust Pill -->
      <div style="display:inline-flex;align-items:center;gap:8px;padding:6px 16px;background:var(--surface);border:1px solid var(--border);border-radius:999px;margin-bottom:28px;box-shadow:0 2px 10px rgba(0,0,0,0.03);">
        <span style="width:8px;height:8px;border-radius:50%;background:#10B981;display:inline-block;"></span>
        <span style="font-size:0.8125rem;font-weight:600;color:var(--text);">PT CAHAYA BINAR BERLIAN</span>
        <span style="color:var(--text-muted);font-size:0.75rem;">&bull;</span>
        <span style="font-size:0.75rem;color:var(--text-muted);">Didirikan Agustus 2015</span>
      </div>

      <!-- Headline (Godly.design + ReactBits Shiny text) -->
      <h1 class="font-editorial" style="font-size:clamp(2.4rem, 5.5vw, 4.2rem);line-height:1.12;font-weight:500;color:var(--text);letter-spacing:-0.02em;max-width:960px;margin:0 auto 24px;">
        Konveksi Seragam Profesional, <i class="shiny-text">Atelier</i> Rumah Jahit, & Pakaian Medis Berstandar Tinggi.
      </h1>

      <!-- Subtitle -->
      <p style="font-size:clamp(1rem, 1.8vw, 1.18rem);color:var(--text-muted);max-width:760px;margin:0 auto 36px;line-height:1.7;">
        Solusi terpadu pembuatan seragam kerja, pakaian dinas PDH/PDL, scrub medis OKA, jas, hingga apparel komunitas. Dikelola oleh tenaga profesional dan berbadan hukum resmi dengan komitmen ketepatan waktu serta presisi jahitan.
      </p>

      <!-- Action Buttons -->
      <div style="display:flex;align-items:center;justify-content:center;gap:14px;flex-wrap:wrap;margin-bottom:48px;">
        <a href="https://wa.me/6285716107394?text=Halo%20Orinamia,%20saya%20ingin%20konsultasi%20pembuatan%20seragam"
           target="_blank"
           class="btn-brand" style="font-size:0.95rem;padding:12px 28px;">
          <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.174.086.275.072.376-.044.101-.116.433-.506.549-.68.116-.174.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/>
          </svg>
          Konsultasi & Penawaran Kerjasama
        </a>
        <a href="#layanan" class="btn-ghost" style="font-size:0.95rem;padding:12px 24px;">
          Eksplorasi Katalog
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
          </svg>
        </a>
      </div>

      <!-- Quick Metrics Strip [Spotlight Cards & Animated Tickers] -->
      <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:16px;max-width:900px;margin:0 auto;text-align:left;">
        
        <div class="atelier-card spotlight-card" style="padding:18px 22px;">
          <div style="font-size:0.75rem;color:var(--text-muted);font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Pengalaman Industri</div>
          <div class="font-num" style="font-size:1.65rem;font-weight:700;color:var(--accent);margin-top:2px;">
            <span class="anim-counter" data-val="10">10</span>+ Tahun
          </div>
          <div style="font-size:0.8rem;color:var(--text-muted);margin-top:2px;">Berdiri sejak Agustus 2015</div>
        </div>

        <div class="atelier-card spotlight-card" style="padding:18px 22px;">
          <div style="font-size:0.75rem;color:var(--text-muted);font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Kapasitas Produksi</div>
          <div class="font-num" style="font-size:1.65rem;font-weight:700;color:var(--text);margin-top:2px;">
            <span class="anim-counter" data-val="10000">10.000</span>+ Pcs
          </div>
          <div style="font-size:0.8rem;color:var(--text-muted);margin-top:2px;">Pesanan Fleksibel (Min 10 Pcs)</div>
        </div>

        <div class="atelier-card spotlight-card" style="padding:18px 22px;">
          <div style="font-size:0.75rem;color:var(--text-muted);font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Varian Seragam Medis</div>
          <div class="font-num" style="font-size:1.65rem;font-weight:700;color:var(--accent);margin-top:2px;">
            <span class="anim-counter" data-val="13">13</span> Pilihan Warna
          </div>
          <div style="font-size:0.8rem;color:var(--text-muted);margin-top:2px;">Baju OKA & Scrub Bedah</div>
        </div>

        <div class="atelier-card spotlight-card" style="padding:18px 22px;">
          <div style="font-size:0.75rem;color:var(--text-muted);font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Legalitas Badan Hukum</div>
          <div class="font-num" style="font-size:1.65rem;font-weight:700;color:var(--text);margin-top:2px;">
            AHU & NIB Resmi
          </div>
          <div style="font-size:0.8rem;color:var(--text-muted);margin-top:2px;">Kemenkumham RI Tahun 2024</div>
        </div>

      </div>

    </div>
  </section>

  <!-- SECTION 1: TENTANG KAMI & LATAR BELAKANG -->
  <section id="tentang" style="padding:90px 24px;border-bottom:1px solid var(--border);">
    <div style="max-width:1160px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));gap:48px;align-items:center;">
      
      <!-- Text Description -->
      <div>
        <span class="badge-pill" style="margin-bottom:14px;">Tentang Orinamia Konveksi</span>
        <h2 class="font-editorial" style="font-size:clamp(1.8rem, 3.2vw, 2.6rem);font-weight:500;line-height:1.2;color:var(--text);margin-bottom:20px;">
          Berawal dari Dedikasi Seorang Tenaga Medis, Berkembang Menjadi <i>Atelier</i> Konveksi Profesional.
        </h2>
        
        <p style="color:var(--text-muted);margin-bottom:16px;line-height:1.75;font-size:0.95rem;">
          <strong>ORINAMIA Konveksi</strong> didirikan pada bulan <strong>Agustus 2015</strong>, bermula dari inisiatif mandiri seorang perawat yang memiliki kepekaan tinggi terhadap kenyamanan dan standar fungsional pakaian kerja medis serta pakaian jadi.
        </p>

        <p style="color:var(--text-muted);margin-bottom:24px;line-height:1.75;font-size:0.95rem;">
          Didorong kreativitas, ketelitian pola jahitan, dan kepercayaan berkelanjutan dari berbagai instansi, ORINAMIA bertransformasi dan berekspansi menjadi unit usaha resmi di bawah naungan <strong>PT CAHAYA BINAR BERLIAN</strong>.
        </p>

        <div style="display:flex;flex-direction:column;gap:12px;padding:20px;background:var(--surface-tint);border-radius:10px;border:1px solid var(--border);">
          <div style="display:flex;align-items:center;gap:10px;">
            <span style="color:#10B981;font-weight:700;">✓</span>
            <span style="font-size:0.875rem;color:var(--text);"><strong>Standar Mutu Jahitan Halus:</strong> Menggunakan benang jahit premium dan mesin garmen modern.</span>
          </div>
          <div style="display:flex;align-items:center;gap:10px;">
            <span style="color:#10B981;font-weight:700;">✓</span>
            <span style="font-size:0.875rem;color:var(--text);"><strong>Kemitraan Multisektoral:</strong> Bekerja sama dengan rumah sakit swasta/pemerintah, BUMN, perhotelan, hingga sekolah.</span>
          </div>
          <div style="display:flex;align-items:center;gap:10px;">
            <span style="color:#10B981;font-weight:700;">✓</span>
            <span style="font-size:0.875rem;color:var(--text);"><strong>Ketepatan Waktu:</strong> Penjadwalan produksi terstruktur dengan pelacakan progres transparan.</span>
          </div>
        </div>
      </div>

      <!-- Atelier Heritage Card -->
      <div class="atelier-card" style="padding:36px;position:relative;background:var(--surface);">
        <div style="font-size:0.75rem;color:var(--accent);font-weight:700;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:12px;">Profil Entitas</div>
        <div style="font-size:1.5rem;font-weight:700;color:var(--text);margin-bottom:4px;">PT Cahaya Binar Berlian</div>
        <div style="font-size:0.875rem;color:var(--text-muted);margin-bottom:24px;">Merk Dagang: ORINAMIA Konveksi & Rumah Jahit</div>

        <div style="border-top:1px dashed var(--border);padding-top:18px;display:flex;flex-direction:column;gap:16px;">
          <div>
            <div style="font-size:0.75rem;color:var(--text-muted);font-weight:600;">Sertifikasi Kemenkumham RI</div>
            <div class="font-num" style="font-size:0.95rem;font-weight:700;color:var(--accent);margin-top:2px;">
              AHU-0202685.AH.01.30. Tahun 2024
            </div>
          </div>

          <div>
            <div style="font-size:0.75rem;color:var(--text-muted);font-weight:600;">Nomor Induk Berusaha (NIB)</div>
            <div class="font-num" style="font-size:0.95rem;font-weight:700;color:var(--text);margin-top:2px;">
              2104240036065
            </div>
          </div>

          <div>
            <div style="font-size:0.75rem;color:var(--text-muted);font-weight:600;">Alamat Workshop & Operasional</div>
            <div style="font-size:0.875rem;color:var(--text);margin-top:2px;line-height:1.5;">
              Jl Cibodas Raya No 10 D Perum 1, Karawaci, Kota Tangerang, Banten
            </div>
          </div>

          <div>
            <div style="font-size:0.75rem;color:var(--text-muted);font-weight:600;">Rekening Resmi Perusahaan</div>
            <div class="font-num" style="font-size:0.875rem;color:var(--text);margin-top:2px;">
              Bank Syariah Indonesia (BSI) <strong>7273909413</strong> a/n PT Cahaya Binar Berlian
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- SECTION 2: KOLEKSI & LAYANAN PRODUKSI -->
  <section id="layanan" style="padding:90px 24px;border-bottom:1px solid var(--border);background:var(--surface-tint);">
    <div style="max-width:1160px;margin:0 auto;">
      
      <div style="text-align:center;max-width:720px;margin:0 auto 40px;">
        <span class="badge-pill" style="margin-bottom:12px;">Portofolio & Layanan Konveksi</span>
        <h2 class="font-editorial" style="font-size:clamp(1.8rem, 3vw, 2.5rem);font-weight:500;color:var(--text);">
          Spesialisasi Busana Kerja & Pakaian Dinas
        </h2>
        <p style="color:var(--text-muted);margin-top:10px;">
          Katalog komprehensif mulai dari pakaian dinas korporat hingga baju ruang operasi rumah sakit.
        </p>
      </div>

      <!-- Category Filter Tabs -->
      <div style="display:flex;justify-content:center;gap:8px;flex-wrap:wrap;margin-bottom:36px;">
        <button type="button" class="cat-tab" :class="{ 'active': activeCat === 'medis' }" @click="activeCat = 'medis'">
          🏥 Seragam Medis & OKA
        </button>
        <button type="button" class="cat-tab" :class="{ 'active': activeCat === 'korporat' }" @click="activeCat = 'korporat'">
          👔 Kemeja PDH & Kantor
        </button>
        <button type="button" class="cat-tab" :class="{ 'active': activeCat === 'industri' }" @click="activeCat = 'industri'">
          🦺 Safety Tambang & PDL
        </button>
        <button type="button" class="cat-tab" :class="{ 'active': activeCat === 'apparel' }" @click="activeCat = 'apparel'">
          👕 Jas, Kaos & Komunitas
        </button>
      </div>

      <!-- Dynamic Catalog Grid -->
      <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));gap:24px;">
        
        <!-- Tab: Medis -->
        <template x-if="activeCat === 'medis'">
          <div style="display:contents;">
            <div class="atelier-card" style="padding:24px;">
              <div style="font-size:1.8rem;margin-bottom:10px;">🥼</div>
              <h3 style="font-size:1.1rem;font-weight:700;color:var(--text);margin-bottom:6px;">Baju OKA Kamar Bedah</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;">Dirancang khusus untuk dokter dan nakes bedah. Bahan adem, higienis, jahitan kuat, dan tidak tembus pandang.</p>
              <div class="font-num" style="margin-top:16px;font-size:0.75rem;font-weight:600;color:var(--accent);">13 Pilihan Warna Tersedia</div>
            </div>

            <div class="atelier-card" style="padding:24px;">
              <div style="font-size:1.8rem;margin-bottom:10px;">🩺</div>
              <h3 style="font-size:1.1rem;font-weight:700;color:var(--text);margin-bottom:6px;">Scrub Medis & Perawat</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;">Atasan v-neck ergonomis dengan saku fungsional dan celana pinggang karet elastis. Nyaman untuk shift panjang.</p>
              <div class="font-num" style="margin-top:16px;font-size:0.75rem;font-weight:600;color:var(--accent);">Pilihan Lengan Pendek / Panjang</div>
            </div>

            <div class="atelier-card" style="padding:24px;">
              <div style="font-size:1.8rem;margin-bottom:10px;">🧥</div>
              <h3 style="font-size:1.1rem;font-weight:700;color:var(--text);margin-bottom:6px;">Jas Dokter & Jas Laboratorium</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;">Bahan katun drill atau toyobo bertekstur rapi, potongan jatuh anggun, dan kancing berkualitas tahan cuci berkali-kali.</p>
              <div class="font-num" style="margin-top:16px;font-size:0.75rem;font-weight:600;color:var(--accent);">Standar Rumah Sakit & Klinik</div>
            </div>
          </div>
        </template>

        <!-- Tab: Korporat -->
        <template x-if="activeCat === 'korporat'">
          <div style="display:contents;">
            <div class="atelier-card" style="padding:24px;">
              <div style="font-size:1.8rem;margin-bottom:10px;">👔</div>
              <h3 style="font-size:1.1rem;font-weight:700;color:var(--text);margin-bottom:6px;">Kemeja Kerja & Kantor</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;">Kemeja eksekutif pria dan wanita dengan bordir komputer presisi. Tersedia bahan katun, oxford, dan tropical.</p>
              <div class="font-num" style="margin-top:16px;font-size:0.75rem;font-weight:600;color:var(--accent);">Potongan Slim & Regular</div>
            </div>

            <div class="atelier-card" style="padding:24px;">
              <div style="font-size:1.8rem;margin-bottom:10px;">🏛️</div>
              <h3 style="font-size:1.1rem;font-weight:700;color:var(--text);margin-bottom:6px;">Pakaian Dinas Harian (PDH)</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;">Standar resmi instansi pemerintah, BUMN, perbankan, dan swasta. Dilengkapi pangkat bahu dan saku simetris.</p>
              <div class="font-num" style="margin-top:16px;font-size:0.75rem;font-weight:600;color:var(--accent);">Sesuai Regulasi Pakaian Dinas</div>
            </div>

            <div class="atelier-card" style="padding:24px;">
              <div style="font-size:1.8rem;margin-bottom:10px;">🏨</div>
              <h3 style="font-size:1.1rem;font-weight:700;color:var(--text);margin-bottom:6px;">Seragam Hospitality & Hotel</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;">Seragam resepsionis, housekeeping, front office, dan staf hotel dengan sentuhan elegan estetis.</p>
              <div class="font-num" style="margin-top:16px;font-size:0.75rem;font-weight:600;color:var(--accent);">Dipakai di Novotel & Omar Hotel</div>
            </div>
          </div>
        </template>

        <!-- Tab: Industri -->
        <template x-if="activeCat === 'industri'">
          <div style="display:contents;">
            <div class="atelier-card" style="padding:24px;">
              <div style="font-size:1.8rem;margin-bottom:10px;">🦺</div>
              <h3 style="font-size:1.1rem;font-weight:700;color:var(--text);margin-bottom:6px;">Kemeja Safety Tambang & Proyek</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;">Dilengkapi scotlight / reflector pita 3M bercahaya tinggi, saku ganda dengan pengait pulpen, ventilasi udara punggung.</p>
              <div class="font-num" style="margin-top:16px;font-size:0.75rem;font-weight:600;color:var(--accent);">Standar K3 & Durabilitas Tinggi</div>
            </div>

            <div class="atelier-card" style="padding:24px;">
              <div style="font-size:1.8rem;margin-bottom:10px;">🏕️</div>
              <h3 style="font-size:1.1rem;font-weight:700;color:var(--text);margin-bottom:6px;">Pakaian Dinas Lapangan (PDL)</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;">Kain ripstop atau drill anti robek, lengan bisa dilipat dengan kancing pengait, fleksibel di berbagai medan.</p>
              <div class="font-num" style="margin-top:16px;font-size:0.75rem;font-weight:600;color:var(--accent);">Cocok untuk Tim Lapangan & Ekspedisi</div>
            </div>

            <div class="atelier-card" style="padding:24px;">
              <div style="font-size:1.8rem;margin-bottom:10px;">🏭</div>
              <h3 style="font-size:1.1rem;font-weight:700;color:var(--text);margin-bottom:6px;">Kemeja Pabrik & Manufaktur</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;">Seragam operator pabrik yang tahan gesekan, adem, dan mudah dicuci. Pilihan kombinasi warna kontras.</p>
              <div class="font-num" style="margin-top:16px;font-size:0.75rem;font-weight:600;color:var(--accent);">Kapasitas Pesanan Skala Ribuan Pcs</div>
            </div>
          </div>
        </template>

        <!-- Tab: Apparel -->
        <template x-if="activeCat === 'apparel'">
          <div style="display:contents;">
            <div class="atelier-card" style="padding:24px;">
              <div style="font-size:1.8rem;margin-bottom:10px;">🧥</div>
              <h3 style="font-size:1.1rem;font-weight:700;color:var(--text);margin-bottom:6px;">Jas Almamater & Blazer</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;">Jas universitas, sekolah kedinasan, dan blazer organisasi lengkap dengan puring dalam serta bordir lambang.</p>
              <div class="font-num" style="margin-top:16px;font-size:0.75rem;font-weight:600;color:var(--accent);">Bahan Twist & High Quality Wool</div>
            </div>

            <div class="atelier-card" style="padding:24px;">
              <div style="font-size:1.8rem;margin-bottom:10px;">👕</div>
              <h3 style="font-size:1.1rem;font-weight:700;color:var(--text);margin-bottom:6px;">Kaos Polos, Polo & T-Shirt Event</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;">Cotton combed 24s / 30s premium reaktif, polo shirt lacoste pique untuk gathering dan seragam santai staf.</p>
              <div class="font-num" style="margin-top:16px;font-size:0.75rem;font-weight:600;color:var(--accent);">Sablon DTF / Bordir Komputer</div>
            </div>

            <div class="atelier-card" style="padding:24px;">
              <div style="font-size:1.8rem;margin-bottom:10px;">👗</div>
              <h3 style="font-size:1.1rem;font-weight:700;color:var(--text);margin-bottom:6px;">Jaket Komunitas & Gamis Seragam</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;">Jaket bomber, jaket parasut, seragam pengajian, gamis institusi pendidikan, dan seragam sekolah terpadu.</p>
              <div class="font-num" style="margin-top:16px;font-size:0.75rem;font-weight:600;color:var(--accent);">Desain Pola Custom Sesuai Request</div>
            </div>
          </div>
        </template>

      </div>

      <!-- [motion-primitives.com & skiper-ui] Interactive Fabric Quality Accordion -->
      <div x-data="{ openSpec: null }" style="margin-top:48px;max-width:920px;margin-left:auto;margin-right:auto;">
        <div style="text-align:center;margin-bottom:18px;">
          <span class="badge-pill" style="font-size:0.75rem;">Standar Material & Tekstil</span>
          <h3 class="font-editorial" style="font-size:1.35rem;font-weight:600;color:var(--text);margin-top:8px;">
            Spesifikasi Karakteristik Kain Pilihan Orinamia
          </h3>
        </div>

        <div style="display:flex;flex-direction:column;gap:12px;">
          
          <!-- Accordion 1 -->
          <div class="atelier-card" style="overflow:hidden;">
            <button type="button" @click="openSpec = (openSpec === 1 ? null : 1)"
                    style="width:100%;padding:18px 22px;display:flex;align-items:center;justify-content:space-between;background:transparent;border:none;cursor:pointer;color:var(--text);font-family:inherit;font-weight:600;font-size:0.95rem;text-align:left;">
              <span style="display:flex;align-items:center;gap:12px;">
                <span>🩺</span>
                <span>Standar Bahan Seragam Medis OKA & Scrub Bedah</span>
              </span>
              <span class="font-num" style="color:var(--accent);font-size:1.25rem;transition:transform 200ms;" :style="openSpec === 1 ? 'transform:rotate(45deg)' : ''">+</span>
            </button>
            <div x-show="openSpec === 1" x-collapse style="padding:0 22px 22px;border-top:1px solid var(--border-subtle);font-size:0.875rem;color:var(--text-muted);line-height:1.75;">
              Menggunakan katun Toyobo Fodu atau American Drill grade A dengan kerapatan serat tinggi, sifat bahan breathable (adem), daya serap keringat maksimal, dan warna yang tahan terhadap proses sterilisasi/autoklaf suhu tinggi rumah sakit.
            </div>
          </div>

          <!-- Accordion 2 -->
          <div class="atelier-card" style="overflow:hidden;">
            <button type="button" @click="openSpec = (openSpec === 2 ? null : 2)"
                    style="width:100%;padding:18px 22px;display:flex;align-items:center;justify-content:space-between;background:transparent;border:none;cursor:pointer;color:var(--text);font-family:inherit;font-weight:600;font-size:0.95rem;text-align:left;">
              <span style="display:flex;align-items:center;gap:12px;">
                <span>👔</span>
                <span>Standar Bahan Kemeja PDH, Kantor & Jas Almamater</span>
              </span>
              <span class="font-num" style="color:var(--accent);font-size:1.25rem;transition:transform 200ms;" :style="openSpec === 2 ? 'transform:rotate(45deg)' : ''">+</span>
            </button>
            <div x-show="openSpec === 2" x-collapse style="padding:0 22px 22px;border-top:1px solid var(--border-subtle);font-size:0.875rem;color:var(--text-muted);line-height:1.75;">
              Pilihan kain Tropical, Nagata Drill, atau Valextra High Twist. Dilengkapi puring dalam lembut untuk blazer, pola kerah kaku simetris, kancing bertulang tebal, serta bordir komputer presisi dengan benang poliester anti rapuh.
            </div>
          </div>

          <!-- Accordion 3 -->
          <div class="atelier-card" style="overflow:hidden;">
            <button type="button" @click="openSpec = (openSpec === 3 ? null : 3)"
                    style="width:100%;padding:18px 22px;display:flex;align-items:center;justify-content:space-between;background:transparent;border:none;cursor:pointer;color:var(--text);font-family:inherit;font-weight:600;font-size:0.95rem;text-align:left;">
              <span style="display:flex;align-items:center;gap:12px;">
                <span>🦺</span>
                <span>Standar Safety PDL Tambang & Proyek Lapangan (K3)</span>
              </span>
              <span class="font-num" style="color:var(--accent);font-size:1.25rem;transition:transform 200ms;" :style="openSpec === 3 ? 'transform:rotate(45deg)' : ''">+</span>
            </button>
            <div x-show="openSpec === 3" x-collapse style="padding:0 22px 22px;border-top:1px solid var(--border-subtle);font-size:0.875rem;color:var(--text-muted);line-height:1.75;">
              Kain Ripstop bertekstur kotak anti sobek dengan pita reflektif (scotlight 3M) lebar 2 inci pada dada, punggung, dan lingkar lengan. Dikerjakan dengan jahitan rantai tiga baris (triple stitch) dan penguat bar-tack pada setiap sudut saku.
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>

  <!-- SECTION 3: SERAGAM MEDIS OKA INTERACTIVE SWATCH -->
  <section id="medis" style="padding:90px 24px;border-bottom:1px solid var(--border);">
    <div style="max-width:1160px;margin:0 auto;">
      
      <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));gap:48px;align-items:center;">
        
        <!-- Swatch Picker -->
        <div>
          <span class="badge-pill" style="margin-bottom:14px;">Spesialisasi Unggulan</span>
          <h2 class="font-editorial" style="font-size:clamp(1.8rem, 3.2vw, 2.6rem);font-weight:500;line-height:1.2;color:var(--text);margin-bottom:16px;">
            Palet 13 Warna Seragam Medis OKA & Kamar Operasi
          </h2>
          <p style="color:var(--text-muted);margin-bottom:24px;font-size:0.95rem;">
            Pilih warna di bawah untuk melihat simulasi visual seragam OKA produksi Orinamia. Seluruh kain telah lolos uji kenyamanan sirkulasi udara dan ketahanan pencucian sterilisasi.
          </p>

          <!-- Color Buttons Grid -->
          <div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:28px;">
            
            <button type="button" class="swatch-btn" :class="{ 'active': selectedColor === 'toska' }"
                    @click="selectedColor = 'toska'" style="background:#20B2AA;" title="Toska"></button>
            <button type="button" class="swatch-btn" :class="{ 'active': selectedColor === 'navy' }"
                    @click="selectedColor = 'navy'" style="background:#1B2A4A;" title="Navy"></button>
            <button type="button" class="swatch-btn" :class="{ 'active': selectedColor === 'maroon' }"
                    @click="selectedColor = 'maroon'" style="background:#800000;" title="Maroon"></button>
            <button type="button" class="swatch-btn" :class="{ 'active': selectedColor === 'hijau' }"
                    @click="selectedColor = 'hijau'" style="background:#2E8B57;" title="Hijau"></button>
            <button type="button" class="swatch-btn" :class="{ 'active': selectedColor === 'hijau_muda' }"
                    @click="selectedColor = 'hijau_muda'" style="background:#90EE90;" title="Hijau Muda"></button>
            <button type="button" class="swatch-btn" :class="{ 'active': selectedColor === 'soft_pink' }"
                    @click="selectedColor = 'soft_pink'" style="background:#FFB6C1;" title="Soft Pink"></button>
            <button type="button" class="swatch-btn" :class="{ 'active': selectedColor === 'pink_fanta' }"
                    @click="selectedColor = 'pink_fanta'" style="background:#FF1493;" title="Pink Fanta"></button>
            <button type="button" class="swatch-btn" :class="{ 'active': selectedColor === 'biru_muda' }"
                    @click="selectedColor = 'biru_muda'" style="background:#87CEEB;" title="Biru Muda"></button>
            <button type="button" class="swatch-btn" :class="{ 'active': selectedColor === 'biru_benhur' }"
                    @click="selectedColor = 'biru_benhur'" style="background:#0047AB;" title="Biru Benhur"></button>
            <button type="button" class="swatch-btn" :class="{ 'active': selectedColor === 'ungu' }"
                    @click="selectedColor = 'ungu'" style="background:#800080;" title="Ungu"></button>
            <button type="button" class="swatch-btn" :class="{ 'active': selectedColor === 'kuning' }"
                    @click="selectedColor = 'kuning'" style="background:#FFD700;" title="Kuning"></button>
            <button type="button" class="swatch-btn" :class="{ 'active': selectedColor === 'orange' }"
                    @click="selectedColor = 'orange'" style="background:#FFA500;" title="Orange"></button>
            <button type="button" class="swatch-btn" :class="{ 'active': selectedColor === 'putih' }"
                    @click="selectedColor = 'putih'" style="background:#FFFFFF;border:1px solid #D5CEE2;" title="Putih"></button>

          </div>

          <div style="font-size:0.875rem;color:var(--text);font-weight:600;">
            Warna Terpilih: 
            <span class="font-editorial" style="font-size:1.15rem;font-weight:600;color:var(--accent);text-transform:capitalize;"
                  x-text="selectedColor.replace('_', ' ')"></span>
          </div>

        </div>

        <!-- Interactive Visual Preview Card -->
        <div class="atelier-card" style="padding:36px;text-align:center;background:var(--surface);">
          <div style="width:120px;height:120px;border-radius:24px;margin:0 auto 20px;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 24px rgba(0,0,0,0.12);transition:background-color 250ms ease;"
               :style="{
                 'background-color': selectedColor === 'toska' ? '#20B2AA' :
                                    selectedColor === 'navy' ? '#1B2A4A' :
                                    selectedColor === 'maroon' ? '#800000' :
                                    selectedColor === 'hijau' ? '#2E8B57' :
                                    selectedColor === 'hijau_muda' ? '#90EE90' :
                                    selectedColor === 'soft_pink' ? '#FFB6C1' :
                                    selectedColor === 'pink_fanta' ? '#FF1493' :
                                    selectedColor === 'biru_muda' ? '#87CEEB' :
                                    selectedColor === 'biru_benhur' ? '#0047AB' :
                                    selectedColor === 'ungu' ? '#800080' :
                                    selectedColor === 'kuning' ? '#FFD700' :
                                    selectedColor === 'orange' ? '#FFA500' : '#FFFFFF',
                 'border': selectedColor === 'putih' ? '1px solid #D5CEE2' : 'none'
               }">
            <svg width="60" height="60" fill="none" :stroke="selectedColor === 'putih' || selectedColor === 'hijau_muda' || selectedColor === 'kuning' ? '#2D2B33' : '#FFFFFF'" stroke-width="1.8" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
          </div>

          <h3 style="font-size:1.25rem;font-weight:700;color:var(--text);margin-bottom:6px;">
            Set Seragam OKA & Scrub Bedah
          </h3>
          <p style="font-size:0.875rem;color:var(--text-muted);margin-bottom:16px;">
            Atasan kerah V ergonomis + Celana panjang pinggang serut elastis + Topi bedah (surgical cap opsional).
          </p>

          <div style="display:flex;justify-content:center;gap:12px;font-size:0.8125rem;">
            <span class="badge-pill">Ukuran S s/d 5XL</span>
            <span class="badge-pill">Katun Toyobo / Drill</span>
            <span class="badge-pill">Bordir Nama & Logo</span>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- SECTION 4: KLIEN & MITRA TERPERCAYA -->
  <section id="klien" style="padding:90px 24px;border-bottom:1px solid var(--border);background:var(--surface-tint);">
    <div style="max-width:1160px;margin:0 auto;text-align:center;">
      
      <span class="badge-pill" style="margin-bottom:14px;">Kemitraan Terpercaya</span>
      <h2 class="font-editorial" style="font-size:clamp(1.8rem, 3.2vw, 2.6rem);font-weight:500;line-height:1.2;color:var(--text);margin-bottom:16px;">
        Dipercaya Berbagai Rumah Sakit, Hotel, Korporat & Lembaga Nasional
      </h2>
      <p style="color:var(--text-muted);max-width:700px;margin:0 auto 48px;font-size:0.95rem;">
        Berikut adalah institusi dan perusahaan yang telah menjalin kerjasama pengadaan seragam dengan PT Cahaya Binar Berlian (ORINAMIA Konveksi):
      </p>

      <!-- Client Grid -->
      <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:16px;">
        
        <div class="atelier-card" style="padding:22px;text-align:center;">
          <div style="font-size:1.15rem;font-weight:700;color:var(--text);">Novotel Hotels</div>
          <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Hospitality & Perhotelan</div>
        </div>

        <div class="atelier-card" style="padding:22px;text-align:center;">
          <div style="font-size:1.15rem;font-weight:700;color:var(--text);">RS Sari Asih</div>
          <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Jaringan Rumah Sakit</div>
        </div>

        <div class="atelier-card" style="padding:22px;text-align:center;">
          <div style="font-size:1.15rem;font-weight:700;color:var(--text);">RS An-Nisa Tangerang</div>
          <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Layanan Kesehatan</div>
        </div>

        <div class="atelier-card" style="padding:22px;text-align:center;">
          <div style="font-size:1.15rem;font-weight:700;color:var(--text);">RSIA Bunda Sejati</div>
          <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">RS Ibu & Anak</div>
        </div>

        <div class="atelier-card" style="padding:22px;text-align:center;">
          <div style="font-size:1.15rem;font-weight:700;color:var(--text);">PT DNP Indonesia</div>
          <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Manufaktur Industri</div>
        </div>

        <div class="atelier-card" style="padding:22px;text-align:center;">
          <div style="font-size:1.15rem;font-weight:700;color:var(--text);">BAZNAS</div>
          <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Badan Amil Zakat Nasional</div>
        </div>

        <div class="atelier-card" style="padding:22px;text-align:center;">
          <div style="font-size:1.15rem;font-weight:700;color:var(--text);">Dompet Dhuafa</div>
          <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Lembaga Kemanusiaan</div>
        </div>

        <div class="atelier-card" style="padding:22px;text-align:center;">
          <div style="font-size:1.15rem;font-weight:700;color:var(--text);">Rumah Zakat</div>
          <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Lembaga Filantropi</div>
        </div>

        <div class="atelier-card" style="padding:22px;text-align:center;">
          <div style="font-size:1.15rem;font-weight:700;color:var(--text);">HIPKABI Banten</div>
          <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Himpunan Perawat Bedah</div>
        </div>

        <div class="atelier-card" style="padding:22px;text-align:center;">
          <div style="font-size:1.15rem;font-weight:700;color:var(--text);">NAKES PRO Volunteer</div>
          <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Komunitas Medis</div>
        </div>

        <div class="atelier-card" style="padding:22px;text-align:center;">
          <div style="font-size:1.15rem;font-weight:700;color:var(--text);">Omar Hotel</div>
          <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Akomodasi & Wisata</div>
        </div>

        <div class="atelier-card" style="padding:22px;text-align:center;">
          <div style="font-size:1.15rem;font-weight:700;color:var(--text);">Grand Mirah Hotel</div>
          <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Hospitality Suites</div>
        </div>

      </div>

    </div>
  </section>

  <!-- SECTION 5: ALUR KERJASAMA & SISTEM PEMBAYARAN DUA TAHAP -->
  <section id="alur" style="padding:90px 24px;border-bottom:1px solid var(--border);">
    <div style="max-width:1160px;margin:0 auto;">
      
      <div style="text-align:center;max-width:760px;margin:0 auto 50px;">
        <span class="badge-pill" style="margin-bottom:12px;">Transparansi Kemitraan</span>
        <h2 class="font-editorial" style="font-size:clamp(1.8rem, 3.2vw, 2.6rem);font-weight:500;line-height:1.2;color:var(--text);">
          Alur Pemesanan & Sistem Pembayaran Dua Tahap
        </h2>
        <p style="color:var(--text-muted);margin-top:10px;font-size:0.95rem;">
          Sesuai SOP resmi PT Cahaya Binar Berlian, setiap pesanan dijamin dengan dokumen Purchase Order (PO), MOU, dan penagihan dua termin yang jelas.
        </p>
      </div>

      <!-- Step Cards Grid -->
      <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));gap:24px;">
        
        <!-- Step 1 -->
        <div class="atelier-card" style="padding:28px;position:relative;">
          <div class="font-num" style="font-size:2rem;font-weight:700;color:var(--accent);opacity:0.6;margin-bottom:8px;">01</div>
          <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:8px;">Konsultasi & Sample</h3>
          <p style="font-size:0.875rem;color:var(--text-muted);line-height:1.65;">
            Diskusi kebutuhan bahan, pemilihan warna, ukuran, estimasi kuantitas (mulai 10 pcs hingga ribuan pcs), dan pembuatan sampel pola (mockup).
          </p>
        </div>

        <!-- Step 2 -->
        <div class="atelier-card" style="padding:28px;position:relative;">
          <div class="font-num" style="font-size:2rem;font-weight:700;color:var(--accent);opacity:0.6;margin-bottom:8px;">02</div>
          <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:8px;">MOU & Termin I (DP 50%)</h3>
          <p style="font-size:0.875rem;color:var(--text-muted);line-height:1.65;">
            Penandatanganan PO dan MOU kerja sama, dilanjutkan penerbitan Invoice DP 50% untuk komitmen alokasi bahan baku dan penjadwalan mesin jahit.
          </p>
        </div>

        <!-- Step 3 -->
        <div class="atelier-card" style="padding:28px;position:relative;">
          <div class="font-num" style="font-size:2rem;font-weight:700;color:var(--accent);opacity:0.6;margin-bottom:8px;">03</div>
          <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:8px;">Produksi & Quality Control</h3>
          <p style="font-size:0.875rem;color:var(--text-muted);line-height:1.65;">
            Pemotongan kain, proses jahit, bordir komputer, pembersihan benang sisa, serta quality control ketat untuk memastikan tidak ada cacat produksi.
          </p>
        </div>

        <!-- Step 4 -->
        <div class="atelier-card" style="padding:28px;position:relative;">
          <div class="font-num" style="font-size:2rem;font-weight:700;color:var(--accent);opacity:0.6;margin-bottom:8px;">04</div>
          <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:8px;">Pelunasan & Pengiriman</h3>
          <p style="font-size:0.875rem;color:var(--text-muted);line-height:1.65;">
            Penerbitan Invoice Pelunasan dengan jangka waktu maksimal 7 hari dari tanggal faktur (atau sesuai perjanjian), kemudian pesanan dikirim aman ke alamat Anda.
          </p>
        </div>

      </div>

      <!-- Interactive Estimator Card (Reactbits / Skiper UI / Motion Primitives inspired) -->
      <div class="atelier-card" style="margin-top:40px;padding:36px;background:var(--surface);">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:24px;">
          <div>
            <span class="badge-pill" style="margin-bottom:6px;">Kalkulator Transparan</span>
            <h3 class="font-editorial" style="font-size:1.45rem;font-weight:600;color:var(--text);">Simulasi Estimasi Biaya & Struktur Pembayaran Dua Termin</h3>
            <p style="font-size:0.875rem;color:var(--text-muted);margin-top:2px;">
              Pilih spesifikasi seragam dan kuantitas pemesanan (10 hingga ribuan pcs). Sistem menghitung otomatis komitmen DP 50% dan pelunasan H+7.
            </p>
          </div>
          <span style="font-size:0.75rem;color:var(--text-muted);font-weight:600;padding:4px 10px;background:var(--surface-tint);border-radius:6px;border:1px solid var(--border);">
            Sesuai PO & MOU Resmi
          </span>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(280px, 1fr));gap:24px;align-items:start;">
          
          <!-- Controls -->
          <div style="display:flex;flex-direction:column;gap:18px;">
            <div>
              <label style="display:block;font-size:0.8125rem;font-weight:600;color:var(--text);margin-bottom:8px;">
                Jenis Seragam / Produk
              </label>
              <select x-model.number="calcType" style="width:100%;padding:10px 14px;border-radius:8px;border:1px solid var(--border);background:var(--bg);color:var(--text);font-family:inherit;font-size:0.875rem;outline:none;">
                <option :value="125000">Set Seragam Medis OKA & Scrub Bedah (Estimasi Rp 125.000 / set)</option>
                <option :value="115000">Kemeja Kerja Eksekutif / PDH Bordir (Estimasi Rp 115.000 / pcs)</option>
                <option :value="145000">Kemeja Safety Proyek / PDL Scotlight 3M (Estimasi Rp 145.000 / pcs)</option>
                <option :value="75000">Kaos Polo Lacoste Pique / T-Shirt Cotton 24s (Estimasi Rp 75.000 / pcs)</option>
                <option :value="185000">Jas Almamater Kampus / Blazer Puring (Estimasi Rp 185.000 / pcs)</option>
              </select>
            </div>

            <div>
              <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                <label style="font-size:0.8125rem;font-weight:600;color:var(--text);">
                  Kuantitas Pemesanan
                </label>
                <span class="font-num" style="font-weight:700;color:var(--accent);font-size:0.95rem;" x-text="calcQty + ' Pcs'"></span>
              </div>
              <input type="range" min="10" max="1000" step="10" x-model.number="calcQty" style="width:100%;accent-color:var(--accent);cursor:pointer;">
              <div style="display:flex;justify-content:space-between;font-size:0.75rem;color:var(--text-muted);margin-top:4px;">
                <span>Min: 10 Pcs</span>
                <span>500 Pcs</span>
                <span>Max: 1.000+ Pcs</span>
              </div>
            </div>
          </div>

          <!-- Calculation Result Summary -->
          <div style="padding:22px;border-radius:10px;background:var(--surface-tint);border:1px solid var(--border);">
            <div style="font-size:0.75rem;font-weight:600;text-transform:uppercase;color:var(--text-muted);letter-spacing:0.05em;margin-bottom:12px;">
              Rincian Perhitungan Estimasi
            </div>
            
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;font-size:0.875rem;">
              <span style="color:var(--text-muted);">Estimasi Total Nilai Kontrak:</span>
              <strong class="font-num" style="color:var(--text);font-size:1.15rem;" x-text="'Rp ' + (calcQty * calcType).toLocaleString('id-ID')"></strong>
            </div>

            <div style="border-top:1px dashed var(--border);padding-top:10px;margin-bottom:10px;display:flex;justify-content:space-between;align-items:center;font-size:0.85rem;">
              <span style="color:var(--text-muted);">Termin I &bull; DP 50% (Saat PO & MOU):</span>
              <strong class="font-num" style="color:var(--accent);" x-text="'Rp ' + ((calcQty * calcType) * 0.5).toLocaleString('id-ID')"></strong>
            </div>

            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;font-size:0.85rem;">
              <span style="color:var(--text-muted);">Termin II &bull; Pelunasan (Maks H+7 Faktur):</span>
              <strong class="font-num" style="color:var(--text);" x-text="'Rp ' + ((calcQty * calcType) * 0.5).toLocaleString('id-ID')"></strong>
            </div>

            <a :href="'https://wa.me/6285716107394?text=' + encodeURIComponent('Halo PT Cahaya Binar Berlian, saya ingin mengajukan pemesanan ' + calcQty + ' pcs seragam dengan perkiraan estimasi nilai Rp ' + (calcQty * calcType).toLocaleString('id-ID') + '. Mohon informasi proposal dan PO resminya.')"
               target="_blank" class="btn-brand" style="width:100%;justify-content:center;padding:10px;">
              Kirim Rincian via WhatsApp Resmi &rarr;
            </a>
          </div>

        </div>
      </div>

    </div>
  </section>

  <!-- SECTION 6: LEGALITAS & KANTOR -->
  <section id="legalitas" style="padding:90px 24px;border-bottom:1px solid var(--border);background:var(--surface-tint);">
    <div style="max-width:1160px;margin:0 auto;">
      
      <div class="atelier-card" style="padding:48px 36px;background:var(--surface);">
        <div style="max-width:760px;margin:0 auto;text-align:center;">
          <span class="badge-pill" style="margin-bottom:12px;">Akuntabilitas Hukum</span>
          <h2 class="font-editorial" style="font-size:clamp(1.8rem, 3vw, 2.5rem);font-weight:500;color:var(--text);margin-bottom:14px;">
            Legalitas Terdaftar Resmi Negara
          </h2>
          <p style="color:var(--text-muted);font-size:0.95rem;line-height:1.7;margin-bottom:32px;">
            PT Cahaya Binar Berlian adalah entitas perseroan terbatas resmi yang memenuhi standar perpajakan dan izin usaha garmen di Indonesia.
          </p>

          <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));gap:20px;text-align:left;margin-bottom:36px;">
            <div style="padding:16px;background:var(--bg);border-radius:8px;border:1px solid var(--border);">
              <div style="font-size:0.75rem;color:var(--text-muted);font-weight:600;">Badan Hukum PT</div>
              <div style="font-weight:700;font-size:1rem;color:var(--text);margin-top:2px;">PT Cahaya Binar Berlian</div>
            </div>

            <div style="padding:16px;background:var(--bg);border-radius:8px;border:1px solid var(--border);">
              <div style="font-size:0.75rem;color:var(--text-muted);font-weight:600;">SK Kemenkumham RI</div>
              <div class="font-num" style="font-weight:700;font-size:0.9rem;color:var(--accent);margin-top:2px;">AHU-0202685.AH.01.30.2024</div>
            </div>

            <div style="padding:16px;background:var(--bg);border-radius:8px;border:1px solid var(--border);">
              <div style="font-size:0.75rem;color:var(--text-muted);font-weight:600;">Nomor Induk Berusaha (NIB)</div>
              <div class="font-num" style="font-weight:700;font-size:0.9rem;color:var(--text);margin-top:2px;">2104240036065</div>
            </div>

            <div style="padding:16px;background:var(--bg);border-radius:8px;border:1px solid var(--border);">
              <div style="font-size:0.75rem;color:var(--text-muted);font-weight:600;">Rekening Resmi Perusahaan</div>
              <div class="font-num" style="font-weight:700;font-size:0.9rem;color:var(--text);margin-top:2px;">BSI 7273909413</div>
            </div>
          </div>

          <div style="display:flex;justify-content:center;gap:12px;flex-wrap:wrap;">
            <a href="https://wa.me/6285716107394?text=Halo%20PT%20Cahaya%20Binar%20Berlian,%20saya%20ingin%20mengajukan%20penawaran%20seragam"
               target="_blank" class="btn-brand" style="padding:12px 28px;">
              Hubungi Tim Kami (0857 1610 7394)
            </a>
            @auth
              <a href="{{ route('dashboard') }}" class="btn-ghost" style="padding:12px 24px;">
                Buka Sistem Manajemen SIMORIN &rarr;
              </a>
            @else
              <a href="{{ route('login') }}" class="btn-ghost" style="padding:12px 24px;">
                Login Pengguna Sistem &rarr;
              </a>
            @endauth
          </div>

        </div>
      </div>

    </div>
  </section>

  <!-- FOOTER -->
  <footer style="padding:60px 24px 30px;background:var(--surface);border-top:1px solid var(--border);">
    <div style="max-width:1160px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));gap:36px;margin-bottom:48px;">
      
      <div>
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
          <div style="width:36px;height:36px;border-radius:50%;background:#fff;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;">
            <svg width="28" height="28" viewBox="0 0 100 100" fill="none">
              <circle cx="50" cy="50" r="42" stroke="#454547" stroke-width="6.5"/>
              <path d="M50 7 L80 35 L70 50 L58 37 L50 27 L35 42 L41 52 L27 50 L20 35 Z" fill="#F391EC"/>
              <path d="M50 93 L20 65 L30 50 L42 63 L50 73 L65 58 L59 48 L73 50 L80 65 Z" fill="#AD8EEB"/>
              <polygon points="50,43 56,50 50,57 44,50" fill="#AD8EEB"/>
            </svg>
          </div>
          <span style="font-size:1.1rem;font-weight:700;"><span style="color:#E074D8;">ORI</span><span style="color:#9B78E6;">NAMIA</span></span>
        </div>
        <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.7;">
          Atelier konveksi terkemuka di Tangerang untuk seragam kerja, pakaian dinas PDH/PDL, dan pakaian medis OKA. Bagian dari unit usaha PT Cahaya Binar Berlian.
        </p>
      </div>

      <div>
        <h4 style="font-size:0.9rem;font-weight:700;color:var(--text);margin-bottom:12px;">Alamat Workshop</h4>
        <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.7;">
          Jl Cibodas Raya No 10 D Perum 1, Karawaci, Tangerang, Banten.<br>
          Atelier Administrasi: Jl Tongkol Raya No 20C Perum 1, Karawaci, Tangerang.
        </p>
      </div>

      <div>
        <h4 style="font-size:0.9rem;font-weight:700;color:var(--text);margin-bottom:12px;">Kontak & Layanan</h4>
        <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.7;">
          Hotline / WhatsApp: <strong class="font-num" style="color:var(--text);">0857 1610 7394</strong><br>
          Operasional: Senin &ndash; Sabtu (08.00 &ndash; 17.00 WIB)<br>
          Sistem Informasi: SIMORIN (Sistem Informasi Manajemen Orinamia)
        </p>
      </div>

    </div>

    <div style="max-width:1160px;margin:0 auto;border-top:1px solid var(--border);padding-top:20px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;font-size:0.8rem;color:var(--text-muted);">
      <div>&copy; 2015 &ndash; {{ date('Y') }} PT CAHAYA BINAR BERLIAN &bull; ORINAMIA Daily Wear & Konveksi. Seluruh hak cipta dilindungi.</div>
      <div style="display:flex;gap:16px;">
        <a href="{{ route('login') }}" style="color:var(--accent);text-decoration:none;font-weight:600;">Login Staf & Owner</a>
      </div>
    </div>
  </footer>

  <!-- Anime.js Micro-Interactions, ReactBits Spotlight, & Motion Primitives -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // 1. [reactbits.dev] Spotlight Card Cursor Tracking
      document.querySelectorAll('.spotlight-card').forEach(card => {
        card.addEventListener('mousemove', e => {
          const rect = card.getBoundingClientRect();
          const x = e.clientX - rect.left;
          const y = e.clientY - rect.top;
          card.style.setProperty('--mouse-x', `${x}px`);
          card.style.setProperty('--mouse-y', `${y}px`);
        });
      });

      if (typeof anime !== 'undefined') {
        // 2. [animejs.com] Staggered Entrance
        anime({
          targets: '.atelier-card',
          opacity: [0.85, 1],
          translateY: [10, 0],
          delay: anime.stagger(35, { start: 120 }),
          duration: 750,
          easing: 'easeOutCubic'
        });

        // 3. [aura.build] Ambient Atmospheric Glow Breathing
        anime({
          targets: '.aura-spotlight',
          scale: [0.95, 1.05],
          opacity: [0.65, 0.95],
          duration: 6500,
          direction: 'alternate',
          loop: true,
          easing: 'easeInOutSine'
        });

        // 4. [reactbits.dev & animejs.com] Rolling Counter Tickers
        document.querySelectorAll('.anim-counter').forEach(counter => {
          const targetVal = parseInt(counter.getAttribute('data-val'), 10) || 0;
          anime({
            targets: counter,
            innerHTML: [0, targetVal],
            round: 1,
            easing: 'easeOutExpo',
            duration: 2200,
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

        // 5. [animejs.com] OKA Color Swatch Elastic Feedback
        document.querySelectorAll('.swatch-btn').forEach(btn => {
          btn.addEventListener('click', () => {
            anime({
              targets: btn,
              scale: [1, 1.3, 1.15],
              duration: 450,
              easing: 'easeOutElastic(1, .6)'
            });
          });
        });
      }
    });
  </script>

</body>
</html>
