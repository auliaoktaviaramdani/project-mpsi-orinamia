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
    /* [awwwards.com] Kinetic Atelier Marquee */
    .marquee-strip {
      overflow: hidden;
      white-space: nowrap;
      background: var(--surface-tint);
      border-top: 1px solid var(--border);
      border-bottom: 1px solid var(--border);
      padding: 14px 0;
      position: relative;
    }
    .marquee-track {
      display: inline-flex;
      animation: marqueeScroll 40s linear infinite;
    }
    .marquee-track:hover {
      animation-play-state: paused;
    }
    .marquee-content {
      display: inline-flex;
      align-items: center;
      gap: 36px;
      padding-right: 36px;
      font-size: 0.8125rem;
      font-weight: 700;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--text-muted);
    }
    .marquee-dot {
      color: var(--lavender);
      font-size: 0.65rem;
    }
    @keyframes marqueeScroll {
      0% { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }

    /* [lafys.com & awwwards.com] Interactive Slicer Component */
    .slicer-container {
      position: relative;
      height: 560px;
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid var(--border);
      background: var(--surface);
      box-shadow: var(--card-shadow);
      user-select: none;
      touch-action: pan-y;
    }
    @media (max-width: 820px) {
      .slicer-container { height: 680px; }
    }
    .slicer-layer {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      padding: 36px 40px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      pointer-events: none;
    }
    @media (max-width: 640px) {
      .slicer-layer { padding: 22px 18px; }
    }
    .slicer-base {
      background: var(--surface-tint);
      color: var(--text);
    }
    .slicer-overlay {
      background: var(--surface);
      color: var(--text);
      z-index: 5;
      box-shadow: 4px 0 24px rgba(0,0,0,0.1);
      will-change: clip-path;
    }
    .slicer-handle {
      position: absolute;
      top: 0;
      bottom: 0;
      width: 2px;
      transform: translateX(-50%);
      background: linear-gradient(180deg, #F391EC 0%, #AD8EEB 50%, #6E387A 100%);
      z-index: 20;
      pointer-events: none;
      box-shadow: 0 0 18px rgba(173, 142, 235, 0.7);
    }
    .slicer-pill {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 8px 16px;
      border-radius: 999px;
      background: var(--surface);
      border: 2px solid var(--lavender);
      display: flex;
      align-items: center;
      gap: 8px;
      color: var(--accent);
      box-shadow: 0 6px 20px rgba(110, 56, 122, 0.35);
      cursor: grab;
      pointer-events: auto;
      white-space: nowrap;
      transition: transform 150ms ease, box-shadow 150ms ease;
    }
    .slicer-pill:hover, .slicer-container:active .slicer-pill {
      transform: translate(-50%, -50%) scale(1.08);
      box-shadow: 0 8px 28px rgba(110, 56, 122, 0.45);
    }
    .slicer-range-input {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      cursor: ew-resize;
      z-index: 25;
      margin: 0;
    }
    .btn-slicing-preset {
      padding: 8px 16px;
      border-radius: 8px;
      font-size: 0.8125rem;
      font-weight: 600;
      border: 1px solid var(--border);
      background: var(--surface);
      color: var(--text-muted);
      cursor: pointer;
      transition: all 180ms ease;
    }
    .btn-slicing-preset:hover {
      color: var(--text);
      border-color: var(--lavender);
      background: var(--surface-tint);
    }
    .btn-slicing-preset.active {
      background: var(--accent-light);
      color: var(--accent);
      border-color: var(--accent);
      box-shadow: 0 2px 8px rgba(110, 56, 122, 0.15);
    }

    /* [onepagelove.com & awwwards.com] Scroll Progress Bar & Floating Concierge */
    #scroll-progress {
      position: fixed;
      top: 0;
      left: 0;
      height: 3px;
      background: linear-gradient(90deg, #F391EC 0%, #AD8EEB 50%, #6E387A 100%);
      z-index: 9999;
      pointer-events: none;
      transition: width 60ms linear;
    }
    .floating-concierge {
      position: fixed;
      bottom: 24px;
      right: 24px;
      z-index: 90;
      display: flex;
      align-items: center;
      gap: 12px;
      background: rgba(250, 249, 252, 0.94);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid var(--border);
      border-radius: 999px;
      padding: 8px 10px 8px 16px;
      box-shadow: 0 12px 35px -8px rgba(110, 56, 122, 0.22);
      transition: transform 200ms ease, box-shadow 200ms ease;
    }
    .dark .floating-concierge {
      background: rgba(27, 25, 33, 0.94);
      box-shadow: 0 12px 35px -8px rgba(0, 0, 0, 0.6);
    }
    .floating-concierge:hover {
      transform: translateY(-2px);
      box-shadow: 0 16px 42px -6px rgba(110, 56, 122, 0.3);
    }
    .pulse-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: #10B981;
      position: relative;
      flex-shrink: 0;
    }
    .pulse-dot::after {
      content: '';
      position: absolute;
      inset: -3px;
      border-radius: 50%;
      border: 2px solid #10B981;
      animation: pulsePing 2s cubic-bezier(0, 0, 0.2, 1) infinite;
    }
    @keyframes pulsePing {
      0% { transform: scale(1); opacity: 1; }
      100% { transform: scale(2.4); opacity: 0; }
    }

    /* [curated.design] Slicing Cards & Micro Tags */
    .curated-card {
      position: relative;
      overflow: hidden;
    }
    .curated-tag {
      display: inline-flex;
      align-items: center;
      padding: 3px 8px;
      border-radius: 4px;
      font-size: 0.7rem;
      font-weight: 600;
      background: var(--surface-tint);
      color: var(--text-muted);
      border: 1px solid var(--border-subtle);
    }
    .curated-spec-reveal {
      max-height: 0;
      opacity: 0;
      overflow: hidden;
      transition: max-height 350ms cubic-bezier(0.16, 1, 0.3, 1), opacity 300ms ease;
    }
    .curated-card:hover .curated-spec-reveal {
      max-height: 220px;
      opacity: 1;
    }
  </style>
</head>
<body x-data="globalLandingTracker()" x-init="initTracker()">

  <!-- Scroll Progress Bar (Awwwards Style) -->
  <div id="scroll-progress" :style="'width: ' + scrollPercent + '%'" aria-hidden="true"></div>

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
      <nav style="display:none;align-items:center;gap:22px;" class="desktop-menu" aria-label="Navigasi Utama">
        <a href="#tentang" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Tentang Kami</a>
        <a href="#slicing" style="text-decoration:none;color:var(--accent);font-size:0.875rem;font-weight:700;display:inline-flex;align-items:center;gap:4px;" onmouseover="this.style.color='var(--lavender)'" onmouseout="this.style.color='var(--accent)'">
          <span style="font-size:0.75rem;">✦</span> Slicing Presisi
        </a>
        <a href="#layanan" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Koleksi & Produk</a>
        <a href="#medis" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Seragam OKA</a>
        <a href="#klien" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Klien Kami</a>
        <a href="#alur" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Alur Kerjasama</a>
        <a href="#faq" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">FAQ</a>
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
      <a href="#slicing" @click="mobileMenu = false" style="text-decoration:none;color:var(--accent);font-weight:700;">✦ Slicing Komparasi Presisi</a>
      <a href="#layanan" @click="mobileMenu = false" style="text-decoration:none;color:var(--text);font-weight:600;">Koleksi & Produk</a>
      <a href="#medis" @click="mobileMenu = false" style="text-decoration:none;color:var(--text);font-weight:600;">Seragam Medis OKA</a>
      <a href="#klien" @click="mobileMenu = false" style="text-decoration:none;color:var(--text);font-weight:600;">Klien Kami</a>
      <a href="#alur" @click="mobileMenu = false" style="text-decoration:none;color:var(--text);font-weight:600;">Alur Kerjasama</a>
      <a href="#faq" @click="mobileMenu = false" style="text-decoration:none;color:var(--text);font-weight:600;">FAQ Pengadaan</a>
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

      <!-- Quick Metrics Strip [Spotlight Cards & Animated Tickers - Anti-Clipping Responsive Layout] -->
      <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));gap:20px;max-width:1140px;margin:0 auto;text-align:left;">
        
        <!-- Metric 1: Pengalaman -->
        <div class="atelier-card spotlight-card" style="padding:22px 24px;">
          <div style="font-size:0.75rem;color:var(--text-muted);font-weight:700;text-transform:uppercase;letter-spacing:0.06em;">Pengalaman Industri</div>
          <div style="display:flex;align-items:baseline;gap:6px;margin:6px 0 2px;">
            <span class="font-num" style="font-size:1.85rem;font-weight:700;color:var(--accent);">
              <span class="anim-counter" data-val="10">10</span>+
            </span>
            <span style="font-size:1.05rem;font-weight:600;color:var(--text);">Tahun</span>
          </div>
          <div style="font-size:0.8125rem;color:var(--text-muted);margin-top:2px;">Berdiri sejak Agustus 2015</div>
        </div>

        <!-- Metric 2: Kapasitas -->
        <div class="atelier-card spotlight-card" style="padding:22px 24px;">
          <div style="font-size:0.75rem;color:var(--text-muted);font-weight:700;text-transform:uppercase;letter-spacing:0.06em;">Kapasitas Produksi</div>
          <div style="display:flex;align-items:baseline;gap:6px;margin:6px 0 2px;">
            <span class="font-num" style="font-size:1.85rem;font-weight:700;color:var(--text);">
              <span class="anim-counter" data-val="10000">10.000</span>+
            </span>
            <span style="font-size:1.05rem;font-weight:600;color:var(--text);">Pcs</span>
          </div>
          <div style="font-size:0.8125rem;color:var(--text-muted);margin-top:2px;">Pesanan Fleksibel (Min 10 Pcs)</div>
        </div>

        <!-- Metric 3: Pilihan Warna Medis -->
        <div class="atelier-card spotlight-card" style="padding:22px 24px;">
          <div style="font-size:0.75rem;color:var(--text-muted);font-weight:700;text-transform:uppercase;letter-spacing:0.06em;">Varian Seragam Medis</div>
          <div style="display:flex;align-items:baseline;gap:6px;margin:6px 0 2px;">
            <span class="font-num" style="font-size:1.85rem;font-weight:700;color:var(--accent);">
              <span class="anim-counter" data-val="13">13</span>
            </span>
            <span style="font-size:1.05rem;font-weight:600;color:var(--text);white-space:normal;">Pilihan Warna</span>
          </div>
          <div style="font-size:0.8125rem;color:var(--text-muted);margin-top:2px;">Baju OKA &amp; Scrub Bedah</div>
        </div>

        <!-- Metric 4: Legalitas Resmi -->
        <div class="atelier-card spotlight-card" style="padding:22px 24px;">
          <div style="font-size:0.75rem;color:var(--text-muted);font-weight:700;text-transform:uppercase;letter-spacing:0.06em;">Legalitas Badan Hukum</div>
          <div style="display:flex;align-items:center;gap:10px;margin:8px 0 4px;flex-wrap:wrap;">
            <span style="font-size:1.35rem;font-weight:700;color:var(--text);letter-spacing:-0.02em;">
              AHU &amp; NIB
            </span>
            <span class="badge-pill" style="font-size:0.75rem;padding:3px 10px;font-weight:700;color:#10B981;background:rgba(16,185,129,0.1);border-color:rgba(16,185,129,0.3);">
              Resmi 2024
            </span>
          </div>
          <div style="font-size:0.8125rem;color:var(--text-muted);margin-top:2px;">Kemenkumham RI SK 2024</div>
        </div>

      </div>

    </div>
  </section>

  <!-- [awwwards.com] KINETIC ATELIER MARQUEE TICKER -->
  <div class="marquee-strip" aria-label="Ticker Informasi Keunggulan Orinamia">
    <div class="marquee-track">
      <div class="marquee-content">
        <span>DEDIKASI 10 TAHUN RUMAH JAHIT</span>
        <span class="marquee-dot">◆</span>
        <span>PALET 13 WARNA SERAGAM MEDIS OKA</span>
        <span class="marquee-dot">◆</span>
        <span>DOUBLE BAR-TACK &amp; TRIPLE CHAIN STITCH</span>
        <span class="marquee-dot">◆</span>
        <span>STANDAR ATELIER PT CAHAYA BINAR BERLIAN</span>
        <span class="marquee-dot">◆</span>
        <span>KATUN TOYOBO FODU GRADE A TAHAN AUTOKLAF 121°C</span>
        <span class="marquee-dot">◆</span>
        <span>LEGALITAS SK KEMENKUMHAM RI AHU-0202685.AH.01.30.2024</span>
        <span class="marquee-dot">◆</span>
        <span>KAPASITAS PRODUKSI 10.000+ PCS / BULAN</span>
        <span class="marquee-dot">◆</span>
        <span>WORKSHOP KARAWACI KOTA TANGERANG</span>
        <span class="marquee-dot">◆</span>
      </div>
      <div class="marquee-content" aria-hidden="true">
        <span>DEDIKASI 10 TAHUN RUMAH JAHIT</span>
        <span class="marquee-dot">◆</span>
        <span>PALET 13 WARNA SERAGAM MEDIS OKA</span>
        <span class="marquee-dot">◆</span>
        <span>DOUBLE BAR-TACK &amp; TRIPLE CHAIN STITCH</span>
        <span class="marquee-dot">◆</span>
        <span>STANDAR ATELIER PT CAHAYA BINAR BERLIAN</span>
        <span class="marquee-dot">◆</span>
        <span>KATUN TOYOBO FODU GRADE A TAHAN AUTOKLAF 121°C</span>
        <span class="marquee-dot">◆</span>
        <span>LEGALITAS SK KEMENKUMHAM RI AHU-0202685.AH.01.30.2024</span>
        <span class="marquee-dot">◆</span>
        <span>KAPASITAS PRODUKSI 10.000+ PCS / BULAN</span>
        <span class="marquee-dot">◆</span>
        <span>WORKSHOP KARAWACI KOTA TANGERANG</span>
        <span class="marquee-dot">◆</span>
      </div>
    </div>
  </div>

  <!-- [lafys.com, curated.design & awwwards.com] THE INTERACTIVE SLICING SECTION -->
  <section id="slicing" style="padding:90px 24px 80px;border-bottom:1px solid var(--border);position:relative;background:var(--bg);"
           x-data="interactiveSlicer()">
    <div style="max-width:1160px;margin:0 auto;">
      
      <!-- Slicing Section Header -->
      <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:20px;margin-bottom:32px;">
        <div style="max-width:680px;">
          <div style="display:inline-flex;align-items:center;gap:8px;padding:4px 14px;background:var(--surface);border:1px solid var(--border);border-radius:999px;margin-bottom:12px;">
            <span style="width:7px;height:7px;border-radius:50%;background:#AD8EEB;"></span>
            <span style="font-size:0.75rem;font-weight:700;letter-spacing:0.08em;color:var(--accent);text-transform:uppercase;">Interactive Slicing Studio</span>
          </div>
          <h2 class="font-editorial" style="font-size:clamp(1.9rem, 3.4vw, 2.8rem);font-weight:500;line-height:1.2;color:var(--text);margin-bottom:10px;">
            Anatomi Kualitas: Slicing Komparasi Presisi Jahitan
          </h2>
          <p style="color:var(--text-muted);font-size:0.95rem;line-height:1.65;">
            Tarik slider horizontal di bawah untuk membelah dan membedah langsung perbedaan spesifikasi antara konveksi pasaran vs standar jahitan halus atelier PT Cahaya Binar Berlian.
          </p>
        </div>

        <!-- Interactive Presets (Awwwards / ReactBits style) -->
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
          <button type="button" class="btn-slicing-preset" :class="{ 'active': activePreset === '50' }" @click="setPreset(50, '50')">
            50 : 50 Komparasi
          </button>
          <button type="button" class="btn-slicing-preset" :class="{ 'active': activePreset === '100-atelier' }" @click="setPreset(100, '100-atelier')">
            100% Orinamia Atelier
          </button>
          <button type="button" class="btn-slicing-preset" :class="{ 'active': activePreset === '0-pasaran' }" @click="setPreset(0, '0-pasaran')">
            100% Konveksi Pasaran
          </button>
          <button type="button" class="btn-slicing-preset" :class="{ 'active': activePreset === 'bartack' }" @click="setPreset(75, 'bartack')">
            Fokus: Bar-Tack Saku
          </button>
          <button type="button" class="btn-slicing-preset" :class="{ 'active': activePreset === 'seam' }" @click="setPreset(30, 'seam')">
            Fokus: Jahitan Rantai
          </button>
        </div>
      </div>

      <!-- Slicing Stage Container -->
      <div class="slicer-container"
           id="slicer-canvas"
           @mousemove="onMouseMove($event)"
           @touchmove="onTouchMove($event)"
           @mousedown="isDragging = true"
           @mouseup="isDragging = false">

        <!-- LAYER 1: BASE LAYER (STANDAR PASARAN) -->
        <div class="slicer-layer slicer-base">
          <div style="display:flex;justify-content:flex-end;">
            <div style="text-align:right;max-width:380px;">
              <span class="badge-pill" style="background:rgba(239,68,68,0.12);color:#DC2626;border-color:rgba(239,68,68,0.3);margin-bottom:8px;">
                Standar Konveksi Pasaran
              </span>
              <div style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:4px;">Pengerjaan Massal Konvensional</div>
              <p style="font-size:0.8125rem;color:var(--text-muted);line-height:1.5;">Fokus pada kecepatan kuantitas dengan kompromi pada kerapatan benang dan kekuatan sambungan saku.</p>
            </div>
          </div>

          <!-- Technical Callouts (Right side of canvas for Pasaran) -->
          <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:12px;margin-top:auto;max-width:540px;margin-left:auto;">
            <div style="padding:12px 14px;background:var(--surface);border-radius:8px;border:1px solid var(--border);box-shadow:0 2px 6px rgba(0,0,0,0.03);">
              <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;font-weight:700;color:#DC2626;">
                <span>⚠️</span> 8 SPI (Stitch Per Inch)
              </div>
              <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Jahitan renggang, benang mudah terurai saat dicuci mesin.</div>
            </div>
            <div style="padding:12px 14px;background:var(--surface);border-radius:8px;border:1px solid var(--border);box-shadow:0 2px 6px rgba(0,0,0,0.03);">
              <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;font-weight:700;color:#DC2626;">
                <span>⚠️</span> Tanpa Bar-Tack
              </div>
              <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Sudut saku robek saat dibebani alat medis atau gawai.</div>
            </div>
            <div style="padding:12px 14px;background:var(--surface);border-radius:8px;border:1px solid var(--border);box-shadow:0 2px 6px rgba(0,0,0,0.03);">
              <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;font-weight:700;color:#DC2626;">
                <span>⚠️</span> Poliester Standar
              </div>
              <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Panas, gerah, dan mengkerut jika masuk autoklaf.</div>
            </div>
            <div style="padding:12px 14px;background:var(--surface);border-radius:8px;border:1px solid var(--border);box-shadow:0 2px 6px rgba(0,0,0,0.03);">
              <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;font-weight:700;color:#DC2626;">
                <span>⚠️</span> Kerah Lemas
              </div>
              <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Tanpa interlining bermutu, kusut setelah dicuci.</div>
            </div>
          </div>
        </div>

        <!-- LAYER 2: CLIPPED OVERLAY LAYER (STANDAR ATELIER ORINAMIA) -->
        <div class="slicer-layer slicer-overlay" :style="'clip-path: polygon(0 0, ' + split + '% 0, ' + split + '% 100%, 0 100%)'">
          <div style="display:flex;justify-content:flex-start;">
            <div style="text-align:left;max-width:380px;">
              <span class="badge-pill" style="background:rgba(16,185,129,0.12);color:#059669;border-color:rgba(16,185,129,0.3);margin-bottom:8px;">
                Standar Atelier Orinamia &bull; PT Cahaya Binar Berlian
              </span>
              <div style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:4px;">Presisi Rumah Jahit Bersertifikat</div>
              <p style="font-size:0.8125rem;color:var(--text-muted);line-height:1.5;">Ketelitian perawat bedah yang diterapkan pada setiap helai benang, sudut saku, dan kenyamanan pemakaian nakes.</p>
            </div>
          </div>

          <!-- Technical Callouts (Left side of canvas for Orinamia) -->
          <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:12px;margin-top:auto;max-width:540px;">
            <div style="padding:12px 14px;background:var(--surface-tint);border-radius:8px;border:1px solid var(--border);box-shadow:0 2px 8px rgba(110,56,122,0.06);">
              <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;font-weight:700;color:#059669;">
                <span>✓</span> 12 - 14 SPI Triple Chain
              </div>
              <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Jahitan rantai rapat dan lentur, tahan tarikan ekstrem.</div>
            </div>
            <div style="padding:12px 14px;background:var(--surface-tint);border-radius:8px;border:1px solid var(--border);box-shadow:0 2px 8px rgba(110,56,122,0.06);">
              <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;font-weight:700;color:#059669;">
                <span>✓</span> Double Bar-Tack 42 Tusukan
              </div>
              <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Kunci silang di setiap sudut saku, sanggup menahan beban 2.5 kg.</div>
            </div>
            <div style="padding:12px 14px;background:var(--surface-tint);border-radius:8px;border:1px solid var(--border);box-shadow:0 2px 8px rgba(110,56,122,0.06);">
              <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;font-weight:700;color:#059669;">
                <span>✓</span> Toyobo Fodu Grade A
              </div>
              <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Serat katun murni adem, lolos uji autoklaf sterilisasi 121°C.</div>
            </div>
            <div style="padding:12px 14px;background:var(--surface-tint);border-radius:8px;border:1px solid var(--border);box-shadow:0 2px 8px rgba(110,56,122,0.06);">
              <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;font-weight:700;color:#059669;">
                <span>✓</span> Interlining Fusible Jerman
              </div>
              <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Kerah tegak simetris paripurna, awet ratusan kali cuci.</div>
            </div>
          </div>
        </div>

        <!-- SLICER HANDLE (The Divider Line + Draggable Pill) -->
        <div class="slicer-handle" :style="'left: ' + split + '%'">
          <div class="slicer-pill" title="Tarik untuk membandingkan spesifikasi">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
            <span class="font-num" style="font-size:0.75rem;font-weight:700;" x-text="Math.round(split) + '% : ' + (100 - Math.round(split)) + '%'"></span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
          </div>
        </div>

        <!-- ACCESSIBILITY RANGE INPUT (Touch / Mouse / Keyboard Accessible) -->
        <input type="range" min="0" max="100" step="1" x-model.number="split" @input="activePreset = 'custom'" class="slicer-range-input" aria-label="Slider Komparasi Slicing Kualitas Jahitan">
      </div>

      <!-- Interactive Hotspot Drilldowns (Curated.design / Lafys style) -->
      <div style="margin-top:28px;display:grid;grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));gap:16px;">
        
        <div class="atelier-card" style="padding:20px;cursor:pointer;" @click="setPreset(60, 'kerah')">
          <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
            <div style="width:28px;height:28px;border-radius:6px;background:var(--accent-light);display:flex;align-items:center;justify-content:center;color:var(--accent);font-weight:700;font-size:0.8rem;">01</div>
            <div style="font-weight:700;font-size:0.95rem;color:var(--text);">Kerah &amp; Interlining Jerman</div>
          </div>
          <p style="font-size:0.8125rem;color:var(--text-muted);line-height:1.6;">Menggunakan bahan pengeras fusible berkualitas impor yang tidak bergelembung saat disetrika panas tinggi.</p>
        </div>

        <div class="atelier-card" style="padding:20px;cursor:pointer;" @click="setPreset(75, 'bartack')">
          <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
            <div style="width:28px;height:28px;border-radius:6px;background:var(--accent-light);display:flex;align-items:center;justify-content:center;color:var(--accent);font-weight:700;font-size:0.8rem;">02</div>
            <div style="font-weight:700;font-size:0.95rem;color:var(--text);">Double Bar-Tack Sudut Saku</div>
          </div>
          <p style="font-size:0.8125rem;color:var(--text-muted);line-height:1.6;">Kunci jahitan bar-tack 42 tusukan otomatis mesin digital, mencegah kantong sobek akibat tarikan alat medis.</p>
        </div>

        <div class="atelier-card" style="padding:20px;cursor:pointer;" @click="setPreset(30, 'seam')">
          <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
            <div style="width:28px;height:28px;border-radius:6px;background:var(--accent-light);display:flex;align-items:center;justify-content:center;color:var(--accent);font-weight:700;font-size:0.8rem;">03</div>
            <div style="font-weight:700;font-size:0.95rem;color:var(--text);">Triple Chainstitch 14 SPI</div>
          </div>
          <p style="font-size:0.8125rem;color:var(--text-muted);line-height:1.6;">Jahitan rantai 3 jarum terintegrasi di keliman sisi, elastis saat pengguna membungkuk dan bergerak aktif.</p>
        </div>

        <div class="atelier-card" style="padding:20px;cursor:pointer;" @click="setPreset(50, '50')">
          <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
            <div style="width:28px;height:28px;border-radius:6px;background:var(--accent-light);display:flex;align-items:center;justify-content:center;color:var(--accent);font-weight:700;font-size:0.8rem;">04</div>
            <div style="font-weight:700;font-size:0.95rem;color:var(--text);">Katun Toyobo Fodu Grade A</div>
          </div>
          <p style="font-size:0.8125rem;color:var(--text-muted);line-height:1.6;">Daya serap keringat tinggi, tidak mudah kusut, serat halus nyaman di kulit, dan lolos uji autoklaf rumah sakit.</p>
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
        
        <!-- Tab: Medis (Curated.design style) -->
        <template x-if="activeCat === 'medis'">
          <div style="display:contents;">
            <div class="atelier-card curated-card" style="padding:26px;">
              <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:12px;">
                <span class="curated-tag">Toyobo Fodu Grade A</span>
                <span class="curated-tag">13 Warna</span>
                <span class="curated-tag">Min 10 Pcs</span>
              </div>
              <div style="font-size:1.8rem;margin-bottom:10px;">🥼</div>
              <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:6px;">Baju OKA Kamar Bedah</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;margin-bottom:14px;">
                Dirancang khusus untuk dokter dan nakes bedah. Bahan adem, higienis, jahitan kuat, dan tidak tembus pandang.
              </p>
              
              <!-- Curated Slicing Reveal Drawer -->
              <div class="curated-spec-reveal">
                <div style="border-top:1px dashed var(--border);padding-top:12px;margin-bottom:12px;font-size:0.75rem;color:var(--text-muted);line-height:1.6;">
                  <div>&bull; <strong>Gramasi:</strong> 210 GSM (Katun Toyobo Impor)</div>
                  <div>&bull; <strong>Ketahanan:</strong> Lolos Uji Autoklaf 121°C</div>
                  <div>&bull; <strong>Jahitan:</strong> Triple Chainstitch &amp; Double Bar-Tack</div>
                </div>
              </div>

              <div class="font-num" style="font-size:0.75rem;font-weight:600;color:var(--accent);">
                Lead Time: 7 &ndash; 10 Hari Kerja
              </div>
            </div>

            <div class="atelier-card curated-card" style="padding:26px;">
              <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:12px;">
                <span class="curated-tag">Ergonomic Cut</span>
                <span class="curated-tag">V-Neck Lis</span>
                <span class="curated-tag">Lengan Pendek / Panjang</span>
              </div>
              <div style="font-size:1.8rem;margin-bottom:10px;">🩺</div>
              <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:6px;">Scrub Medis &amp; Perawat</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;margin-bottom:14px;">
                Atasan v-neck ergonomis dengan saku fungsional dan celana pinggang serut elastis. Nyaman untuk shift panjang.
              </p>

              <!-- Curated Slicing Reveal Drawer -->
              <div class="curated-spec-reveal">
                <div style="border-top:1px dashed var(--border);padding-top:12px;margin-bottom:12px;font-size:0.75rem;color:var(--text-muted);line-height:1.6;">
                  <div>&bull; <strong>Saku:</strong> 1 Saku Dada + 2 Saku Samping Bawah</div>
                  <div>&bull; <strong>Celana:</strong> Serut Tali Karet + Saku Belakang</div>
                  <div>&bull; <strong>Kustomisasi:</strong> Bordir Komputer Nama &amp; Logo RS</div>
                </div>
              </div>

              <div class="font-num" style="font-size:0.75rem;font-weight:600;color:var(--accent);">
                Tersedia Ukuran S hingga 5XL
              </div>
            </div>

            <div class="atelier-card curated-card" style="padding:26px;">
              <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:12px;">
                <span class="curated-tag">American Drill / Twist</span>
                <span class="curated-tag">Puring Sutra Halus</span>
                <span class="curated-tag">Standar IDI &amp; RS</span>
              </div>
              <div style="font-size:1.8rem;margin-bottom:10px;">🧥</div>
              <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:6px;">Jas Dokter &amp; Jas Laboratorium</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;margin-bottom:14px;">
                Bahan bertekstur rapi, potongan jatuh anggun, kancing bertulang tebal, dan tahan cuci berkali-kali.
              </p>

              <!-- Curated Slicing Reveal Drawer -->
              <div class="curated-spec-reveal">
                <div style="border-top:1px dashed var(--border);padding-top:12px;margin-bottom:12px;font-size:0.75rem;color:var(--text-muted);line-height:1.6;">
                  <div>&bull; <strong>Pola:</strong> Kerah Rebah Notch Lapel Simetris</div>
                  <div>&bull; <strong>Finishing:</strong> Obras Rapi Bersih Tanpa Sisa Benang</div>
                  <div>&bull; <strong>Fit:</strong> Slim Fit Dokter Pria &amp; Wanita</div>
                </div>
              </div>

              <div class="font-num" style="font-size:0.75rem;font-weight:600;color:var(--accent);">
                Dipakai di 8+ Jaringan Rumah Sakit
              </div>
            </div>
          </div>
        </template>

        <!-- Tab: Korporat (Curated.design style) -->
        <template x-if="activeCat === 'korporat'">
          <div style="display:contents;">
            <div class="atelier-card curated-card" style="padding:26px;">
              <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:12px;">
                <span class="curated-tag">Katun Oxford / Tropical</span>
                <span class="curated-tag">Interlining Jerman</span>
                <span class="curated-tag">Min 10 Pcs</span>
              </div>
              <div style="font-size:1.8rem;margin-bottom:10px;">👔</div>
              <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:6px;">Kemeja Kerja &amp; Kantor</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;margin-bottom:14px;">
                Kemeja eksekutif pria dan wanita dengan bordir komputer presisi. Tampilan elegan, adem, dan mudah disetrika.
              </p>

              <div class="curated-spec-reveal">
                <div style="border-top:1px dashed var(--border);padding-top:12px;margin-bottom:12px;font-size:0.75rem;color:var(--text-muted);line-height:1.6;">
                  <div>&bull; <strong>Bordir:</strong> Mesin Komputer Digital Tajima</div>
                  <div>&bull; <strong>Kerah:</strong> Fusible Interlining Tegak Rapi</div>
                  <div>&bull; <strong>Jahitan:</strong> Jarum Dua Simetris</div>
                </div>
              </div>

              <div class="font-num" style="font-size:0.75rem;font-weight:600;color:var(--accent);">
                Potongan Slim Fit &amp; Regular
              </div>
            </div>

            <div class="atelier-card curated-card" style="padding:26px;">
              <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:12px;">
                <span class="curated-tag">Nagata Drill Grade A</span>
                <span class="curated-tag">Regulasi Dinas Resmi</span>
                <span class="curated-tag">Pangkat Bahu</span>
              </div>
              <div style="font-size:1.8rem;margin-bottom:10px;">🏛️</div>
              <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:6px;">Pakaian Dinas Harian (PDH)</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;margin-bottom:14px;">
                Standar resmi instansi kementerian, BUMN, perbankan, dan swasta. Dilengkapi pangkat bahu dan saku lipit.
              </p>

              <div class="curated-spec-reveal">
                <div style="border-top:1px dashed var(--border);padding-top:12px;margin-bottom:12px;font-size:0.75rem;color:var(--text-muted);line-height:1.6;">
                  <div>&bull; <strong>Saku:</strong> 2 Saku Tutup Kancing Depan</div>
                  <div>&bull; <strong>Warna:</strong> Khaki Pemda, Putih Kemenkes, Biru BUMN</div>
                  <div>&bull; <strong>Kekuatan:</strong> Uji Tarik Benang Kuat &gt;40 N/cm²</div>
                </div>
              </div>

              <div class="font-num" style="font-size:0.75rem;font-weight:600;color:var(--accent);">
                Sesuai Regulasi Pakaian Dinas Nasional
              </div>
            </div>

            <div class="atelier-card curated-card" style="padding:26px;">
              <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:12px;">
                <span class="curated-tag">Valextra Wool Twist</span>
                <span class="curated-tag">Desain Hospitality</span>
                <span class="curated-tag">Novotel Verified</span>
              </div>
              <div style="font-size:1.8rem;margin-bottom:10px;">🏨</div>
              <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:6px;">Seragam Hospitality &amp; Hotel</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;margin-bottom:14px;">
                Seragam resepsionis, front office, housekeeping, dan banquet dengan sentuhan mewah estetis.
              </p>

              <div class="curated-spec-reveal">
                <div style="border-top:1px dashed var(--border);padding-top:12px;margin-bottom:12px;font-size:0.75rem;color:var(--text-muted);line-height:1.6;">
                  <div>&bull; <strong>Karakter:</strong> Kain Jatuh Anggun, Tidak Panas</div>
                  <div>&bull; <strong>Aksesoris:</strong> Kancing Logam / Batok Kelapa Custom</div>
                  <div>&bull; <strong>Mitra:</strong> Hotel Novotel &amp; Omar Hotel</div>
                </div>
              </div>

              <div class="font-num" style="font-size:0.75rem;font-weight:600;color:var(--accent);">
                Portofolio Bintang 4 &amp; Resor
              </div>
            </div>
          </div>
        </template>

        <!-- Tab: Industri (Curated.design style) -->
        <template x-if="activeCat === 'industri'">
          <div style="display:contents;">
            <div class="atelier-card curated-card" style="padding:26px;">
              <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:12px;">
                <span class="curated-tag">Ripstop Kotak Anti Robek</span>
                <span class="curated-tag">Scotlight 3M Lebar 2"</span>
                <span class="curated-tag">K3 Tambang</span>
              </div>
              <div style="font-size:1.8rem;margin-bottom:10px;">🦺</div>
              <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:6px;">Kemeja Safety Tambang &amp; Proyek</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;margin-bottom:14px;">
                Dilengkapi reflector pita 3M bercahaya tinggi, saku ganda dengan slot pulpen, dan ventilasi udara jaring punggung.
              </p>

              <div class="curated-spec-reveal">
                <div style="border-top:1px dashed var(--border);padding-top:12px;margin-bottom:12px;font-size:0.75rem;color:var(--text-muted);line-height:1.6;">
                  <div>&bull; <strong>Visibilitas:</strong> Reflektor Scotlight Memenuhi ANSI/ISEA 107</div>
                  <div>&bull; <strong>Ventilasi:</strong> Jaring Punggung Breathable</div>
                  <div>&bull; <strong>Jahitan:</strong> Bar-Tack di Seluruh Titik Kritis</div>
                </div>
              </div>

              <div class="font-num" style="font-size:0.75rem;font-weight:600;color:var(--accent);">
                Durabilitas Ekstrem Standar Proyek
              </div>
            </div>

            <div class="atelier-card curated-card" style="padding:26px;">
              <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:12px;">
                <span class="curated-tag">American Drill Heavy Duty</span>
                <span class="curated-tag">Lengan Lipat</span>
                <span class="curated-tag">Outdoor Ready</span>
              </div>
              <div style="font-size:1.8rem;margin-bottom:10px;">🏕️</div>
              <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:6px;">Pakaian Dinas Lapangan (PDL)</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;margin-bottom:14px;">
                Kain ripstop atau drill anti sobek, lengan bisa digulung dengan kancing pengait, fleksibel di berbagai medan.
              </p>

              <div class="curated-spec-reveal">
                <div style="border-top:1px dashed var(--border);padding-top:12px;margin-bottom:12px;font-size:0.75rem;color:var(--text-muted);line-height:1.6;">
                  <div>&bull; <strong>Pola:</strong> Saku Kargo Dada + Slot Handphone Lapangan</div>
                  <div>&bull; <strong>Fleksibilitas:</strong> Manset Kancing Dua Tingkat</div>
                  <div>&bull; <strong>Aplikasi:</strong> Tim Ekspedisi, Surveyor, &amp; Relawan</div>
                </div>
              </div>

              <div class="font-num" style="font-size:0.75rem;font-weight:600;color:var(--accent);">
                Dipercaya Lembaga Kemanusiaan BAZNAS
              </div>
            </div>

            <div class="atelier-card curated-card" style="padding:26px;">
              <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:12px;">
                <span class="curated-tag">Poly-Cotton Anti Gesek</span>
                <span class="curated-tag">Warna Kontras</span>
                <span class="curated-tag">Kapasitas Skala Pabrik</span>
              </div>
              <div style="font-size:1.8rem;margin-bottom:10px;">🏭</div>
              <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:6px;">Kemeja Pabrik &amp; Manufaktur</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;margin-bottom:14px;">
                Seragam operator pabrik yang tahan gesekan mekanis, adem, mudah dicuci, dan tidak mudah menyerap oli.
              </p>

              <div class="curated-spec-reveal">
                <div style="border-top:1px dashed var(--border);padding-top:12px;margin-bottom:12px;font-size:0.75rem;color:var(--text-muted);line-height:1.6;">
                  <div>&bull; <strong>Material:</strong> Serat Sintetis Berperedam Gesekan</div>
                  <div>&bull; <strong>Ketahanan:</strong> Warna Stabil &gt;50x Pencucian Pabrik</div>
                  <div>&bull; <strong>Mitra:</strong> PT DNP Indonesia &amp; Mitra Industri</div>
                </div>
              </div>

              <div class="font-num" style="font-size:0.75rem;font-weight:600;color:var(--accent);">
                Kapasitas Pesanan hingga 10.000 Pcs/Bulan
              </div>
            </div>
          </div>
        </template>

        <!-- Tab: Apparel (Curated.design style) -->
        <template x-if="activeCat === 'apparel'">
          <div style="display:contents;">
            <div class="atelier-card curated-card" style="padding:26px;">
              <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:12px;">
                <span class="curated-tag">High Quality Wool Twist</span>
                <span class="curated-tag">Busa Bahu Simetris</span>
                <span class="curated-tag">Full Puring Asahi</span>
              </div>
              <div style="font-size:1.8rem;margin-bottom:10px;">🧥</div>
              <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:6px;">Jas Almamater &amp; Blazer</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;margin-bottom:14px;">
                Jas universitas, sekolah kedinasan, dan blazer organisasi lengkap dengan puring dalam serta bordir lambang.
              </p>

              <div class="curated-spec-reveal">
                <div style="border-top:1px dashed var(--border);padding-top:12px;margin-bottom:12px;font-size:0.75rem;color:var(--text-muted);line-height:1.6;">
                  <div>&bull; <strong>Bordir:</strong> Patch Lambang Universitas Presisi</div>
                  <div>&bull; <strong>Finishing:</strong> Kancing Logam Grafir Almamater</div>
                  <div>&bull; <strong>Puring:</strong> Kain Asahi Halus Mengurangi Gerah</div>
                </div>
              </div>

              <div class="font-num" style="font-size:0.75rem;font-weight:600;color:var(--accent);">
                Pilihan Bahan Twist &amp; Woll Premium
              </div>
            </div>

            <div class="atelier-card curated-card" style="padding:26px;">
              <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:12px;">
                <span class="curated-tag">Cotton Combed 24s/30s</span>
                <span class="curated-tag">Lacoste Pique</span>
                <span class="curated-tag">Sablon DTF / Bordir</span>
              </div>
              <div style="font-size:1.8rem;margin-bottom:10px;">👕</div>
              <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:6px;">Kaos Polos, Polo &amp; T-Shirt Event</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;margin-bottom:14px;">
                Cotton combed reaktif 100%, polo shirt lacoste pique untuk gathering instansi dan seragam santai staf kantor.
              </p>

              <div class="curated-spec-reveal">
                <div style="border-top:1px dashed var(--border);padding-top:12px;margin-bottom:12px;font-size:0.75rem;color:var(--text-muted);line-height:1.6;">
                  <div>&bull; <strong>Sablon:</strong> Digital Transfer Film (DTF) Anti Pecah</div>
                  <div>&bull; <strong>Kerah:</strong> Rajut Katun Tebal Tidak Mudah Melar</div>
                  <div>&bull; <strong>Karakter:</strong> 100% Katun Murni Menyerap Keringat</div>
                </div>
              </div>

              <div class="font-num" style="font-size:0.75rem;font-weight:600;color:var(--accent);">
                Kuantitas Fleksibel Mulai 10 Pcs
              </div>
            </div>

            <div class="atelier-card curated-card" style="padding:26px;">
              <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:12px;">
                <span class="curated-tag">Parasut Taslan / Drill</span>
                <span class="curated-tag">Resleting YKK Asli</span>
                <span class="curated-tag">Desain Custom Pola</span>
              </div>
              <div style="font-size:1.8rem;margin-bottom:10px;">👗</div>
              <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:6px;">Jaket Komunitas &amp; Gamis Seragam</h3>
              <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;margin-bottom:14px;">
                Jaket bomber, jaket parasut windproof, seragam pengajian, gamis institusi, dan seragam sekolah terpadu.
              </p>

              <div class="curated-spec-reveal">
                <div style="border-top:1px dashed var(--border);padding-top:12px;margin-bottom:12px;font-size:0.75rem;color:var(--text-muted);line-height:1.6;">
                  <div>&bull; <strong>Material:</strong> Taslan Waterproof / Katun Madinah</div>
                  <div>&bull; <strong>Resleting:</strong> YKK Original Kuat dan Halus</div>
                  <div>&bull; <strong>Kustomisasi:</strong> Pola Cutting Khusus Sesuai Acara</div>
                </div>
              </div>

              <div class="font-num" style="font-size:0.75rem;font-weight:600;color:var(--accent);">
                Desain Pola Custom Sesuai Request
              </div>
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

  <!-- SECTION 3: SERAGAM MEDIS OKA INTERACTIVE GARMENT STUDIO (Lafys Inspired) -->
  <section id="medis" style="padding:90px 24px;border-bottom:1px solid var(--border);"
           x-data="garmentStudio()">
    <div style="max-width:1160px;margin:0 auto;">
      
      <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));gap:48px;align-items:center;">
        
        <!-- Left Column: Swatch Picker & Garment Controls -->
        <div>
          <span class="badge-pill" style="margin-bottom:14px;">Atelier Garment Studio &bull; Lafys Inspired</span>
          <h2 class="font-editorial" style="font-size:clamp(1.8rem, 3.2vw, 2.6rem);font-weight:500;line-height:1.2;color:var(--text);margin-bottom:16px;">
            Palet 13 Warna Seragam Medis OKA &amp; Kamar Operasi
          </h2>
          <p style="color:var(--text-muted);margin-bottom:20px;font-size:0.95rem;line-height:1.65;">
            Pilih warna di bawah untuk melihat simulasi visual seragam OKA produksi Orinamia. Seluruh kain menggunakan katun Toyobo Fodu Grade A yang lolos uji sirkulasi udara dan autoklaf rumah sakit.
          </p>

          <!-- Interactive Garment Toggles -->
          <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:24px;padding:12px;background:var(--surface-tint);border-radius:10px;border:1px solid var(--border);">
            <span style="font-size:0.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;margin-right:4px;">Konfigurasi:</span>
            
            <button type="button" class="btn-ghost" style="padding:6px 12px;font-size:0.75rem;border-radius:6px;"
                    :style="sleeveType === 'pendek' ? 'background:var(--accent);color:#fff;border-color:var(--accent);' : ''"
                    @click="sleeveType = 'pendek'">
              Lengan Pendek
            </button>
            
            <button type="button" class="btn-ghost" style="padding:6px 12px;font-size:0.75rem;border-radius:6px;"
                    :style="sleeveType === 'panjang' ? 'background:var(--accent);color:#fff;border-color:var(--accent);' : ''"
                    @click="sleeveType = 'panjang'">
              Lengan Panjang (Hijab)
            </button>

            <button type="button" class="btn-ghost" style="padding:6px 12px;font-size:0.75rem;border-radius:6px;"
                    :style="showEmbroidery ? 'background:var(--accent-light);color:var(--accent);border-color:var(--accent);' : ''"
                    @click="showEmbroidery = !showEmbroidery">
              <span x-text="showEmbroidery ? '✓ Bordir Aktif' : '+ Bordir Nama & RS'"></span>
            </button>
          </div>

          <!-- Color Buttons Grid -->
          <div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:24px;">
            <template x-for="(data, key) in colors" :key="key">
              <button type="button" class="swatch-btn"
                      :class="{ 'active': selectedColor === key }"
                      @click="selectColor(key)"
                      :style="'background:' + data.hex + ';' + (key === 'putih' ? 'border:1px solid #D5CEE2;' : '')"
                      :title="data.name">
              </button>
            </template>
          </div>

          <!-- Selected Color Specification Card -->
          <div style="padding:18px 20px;border-radius:10px;background:var(--surface);border:1px solid var(--border);box-shadow:0 2px 10px rgba(0,0,0,0.03);">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
              <span class="font-editorial" style="font-size:1.25rem;font-weight:600;color:var(--text);" x-text="getColorData().name"></span>
              <span class="font-num" style="font-size:0.75rem;font-weight:600;color:var(--accent);" x-text="'Pantone: ' + getColorData().pantone"></span>
            </div>
            <div style="font-size:0.8125rem;color:var(--accent);font-weight:600;margin-bottom:6px;" x-text="'Rekomendasi Unit: ' + getColorData().unit"></div>
            <p style="font-size:0.8125rem;color:var(--text-muted);line-height:1.55;margin-bottom:14px;" x-text="getColorData().desc"></p>
            
            <a :href="'https://wa.me/6285716107394?text=' + encodeURIComponent('Halo Orinamia, saya tertarik konsultasi pemesanan Seragam Medis OKA dengan pilihan warna ' + getColorData().name + ' (' + (sleeveType === 'panjang' ? 'Lengan Panjang' : 'Lengan Pendek') + ').')"
               target="_blank" class="btn-brand" style="padding:8px 18px;font-size:0.8125rem;width:100%;justify-content:center;">
              Konsultasi Seragam Warna Ini via WhatsApp &rarr;
            </a>
          </div>

        </div>

        <!-- Right Column: Interactive Vector Scrub Mockup (Lafys Inspired) -->
        <div class="atelier-card" style="padding:32px;text-align:center;background:var(--surface);position:relative;overflow:hidden;">
          
          <!-- Garment Stage Badge -->
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;font-size:0.75rem;color:var(--text-muted);">
            <span style="display:inline-flex;align-items:center;gap:6px;">
              <span class="pulse-dot"></span>
              <span>Vector Atelier Preview</span>
            </span>
            <span class="font-num" style="font-weight:600;" x-text="sleeveType === 'panjang' ? 'Model: Lengan Panjang' : 'Model: Lengan Pendek'"></span>
          </div>

          <!-- SVG Medical Scrub Vector Mockup -->
          <div style="max-width:320px;margin:0 auto 20px;filter:drop-shadow(0 12px 24px rgba(0,0,0,0.12));transition:transform 250ms ease;">
            <svg viewBox="0 0 300 420" width="100%" height="auto" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Mockup Seragam OKA">
              
              <!-- Surgical Cap (Topi OKA) -->
              <g id="svg-scrub-cap">
                <path d="M105 32 C105 14, 195 14, 195 32 C195 44, 105 44, 105 32 Z"
                      :fill="getColorHex()"
                      stroke="rgba(0,0,0,0.15)" stroke-width="2"/>
                <path d="M105 32 Q150 42 195 32" stroke="rgba(255,255,255,0.4)" stroke-width="1.5" stroke-dasharray="2 2"/>
                <!-- Cap Ribbon Knot -->
                <path d="M192 34 C205 36, 212 45, 208 52 C204 55, 198 48, 195 38 Z" :fill="getColorHex()" opacity="0.9"/>
              </g>

              <!-- Scrub Top (Atasan V-Neck) -->
              <g id="svg-scrub-top" style="transition:all 280ms cubic-bezier(0.16, 1, 0.3, 1);transform-origin:center top;">
                
                <!-- Main Body Torso -->
                <path d="M85 70 L115 70 L150 115 L185 70 L215 70 L228 220 L72 220 Z"
                      :fill="getColorHex()"
                      stroke="rgba(0,0,0,0.12)" stroke-width="2.5"/>

                <!-- Sleeve Left (Dynamic: Short or Long) -->
                <path :d="sleeveType === 'panjang' ? 'M85 70 L35 110 L45 220 L70 215 L78 120 L72 220' : 'M85 70 L45 110 L60 148 L80 135 L75 110'"
                      :fill="getColorHex()"
                      stroke="rgba(0,0,0,0.15)" stroke-width="2"/>

                <!-- Sleeve Right (Dynamic: Short or Long) -->
                <path :d="sleeveType === 'panjang' ? 'M215 70 L265 110 L255 220 L230 215 L222 120 L228 220' : 'M215 70 L255 110 L240 148 L220 135 L225 110'"
                      :fill="getColorHex()"
                      stroke="rgba(0,0,0,0.15)" stroke-width="2"/>

                <!-- V-Neck Collar Band -->
                <path d="M115 70 L150 115 L185 70" stroke="rgba(255,255,255,0.6)" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M115 70 L150 115 L185 70" stroke="rgba(0,0,0,0.2)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                <!-- Chest Pocket (Left Chest) -->
                <g id="chest-pocket">
                  <rect x="92" y="118" width="34" height="38" rx="2" :fill="getColorHex()" stroke="rgba(0,0,0,0.2)" stroke-width="1.8"/>
                  <!-- Pen Slot Divider -->
                  <line x1="102" y1="118" x2="102" y2="156" stroke="rgba(255,255,255,0.3)" stroke-width="1.2" stroke-dasharray="2 2"/>
                  <!-- Double Bar-Tack Pocket Reinforcement -->
                  <line x1="90" y1="119" x2="95" y2="119" stroke="#AD8EEB" stroke-width="2.5"/>
                  <line x1="123" y1="119" x2="128" y2="119" stroke="#AD8EEB" stroke-width="2.5"/>
                </g>

                <!-- Computer Embroidery Simulation (On Chest Right) -->
                <g id="embroidery-preview" x-show="showEmbroidery" x-transition>
                  <rect x="160" y="122" width="54" height="18" rx="3" fill="rgba(255,255,255,0.92)" stroke="#AD8EEB" stroke-width="1"/>
                  <text x="163" y="130" font-size="5" font-family="'Plus Jakarta Sans', sans-serif" font-weight="700" fill="#2D2B33">dr. Aulia Oktavia</text>
                  <text x="163" y="136" font-size="4" font-family="'Plus Jakarta Sans', sans-serif" font-weight="600" fill="#6E387A">RS CAHAYA MEDIKA</text>
                </g>

                <!-- Lower Twin Pockets (Kiri & Kanan) -->
                <rect x="82" y="168" width="46" height="44" rx="3" :fill="getColorHex()" stroke="rgba(0,0,0,0.18)" stroke-width="1.8"/>
                <line x1="80" y1="169" x2="86" y2="169" stroke="#AD8EEB" stroke-width="2.5"/>
                <line x1="124" y1="169" x2="130" y2="169" stroke="#AD8EEB" stroke-width="2.5"/>

                <rect x="172" y="168" width="46" height="44" rx="3" :fill="getColorHex()" stroke="rgba(0,0,0,0.18)" stroke-width="1.8"/>
                <line x1="170" y1="169" x2="176" y2="169" stroke="#AD8EEB" stroke-width="2.5"/>
                <line x1="214" y1="169" x2="220" y2="169" stroke="#AD8EEB" stroke-width="2.5"/>

                <!-- Bottom Hem Double Stitch -->
                <line x1="72" y1="216" x2="228" y2="216" stroke="rgba(255,255,255,0.35)" stroke-width="1.5" stroke-dasharray="3 2"/>
              </g>

              <!-- Scrub Pants (Celana Bedah) -->
              <g id="svg-scrub-pants" style="transition:all 280ms cubic-bezier(0.16, 1, 0.3, 1);">
                <!-- Drawstring Waistband -->
                <rect x="80" y="222" width="140" height="14" rx="2" :fill="getColorHex()" stroke="rgba(0,0,0,0.15)" stroke-width="1.5"/>
                <path d="M145 228 Q150 236 155 228" stroke="#FFFFFF" stroke-width="2" fill="none"/>
                <!-- Trousers Legs -->
                <path d="M80 236 L94 395 L142 395 L150 270 L158 395 L206 395 L220 236 Z"
                      :fill="getColorHex()"
                      stroke="rgba(0,0,0,0.15)" stroke-width="2"/>
                <!-- Ankle Hem Stitches -->
                <line x1="94" y1="390" x2="142" y2="390" stroke="rgba(255,255,255,0.3)" stroke-width="1.2" stroke-dasharray="2 2"/>
                <line x1="158" y1="390" x2="206" y2="390" stroke="rgba(255,255,255,0.3)" stroke-width="1.2" stroke-dasharray="2 2"/>
              </g>

            </svg>
          </div>

          <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:4px;">
            Set Seragam OKA &amp; Scrub Bedah Orinamia
          </h3>
          <p style="font-size:0.8125rem;color:var(--text-muted);margin-bottom:16px;">
            Atasan kerah V ergonomis + Celana panjang serut karet + Topi bedah steril (surgical cap).
          </p>

          <div style="display:flex;justify-content:center;gap:8px;flex-wrap:wrap;font-size:0.75rem;">
            <span class="badge-pill">Ukuran S s/d 5XL</span>
            <span class="badge-pill">Katun Toyobo Fodu</span>
            <span class="badge-pill">Lolos Uji Autoklaf 121°C</span>
            <span class="badge-pill">Double Bar-Tack</span>
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
      <div id="kalkulator" class="atelier-card" style="margin-top:40px;padding:36px;background:var(--surface);">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:24px;">
          <div>
            <span class="badge-pill" style="margin-bottom:6px;">Kalkulator Transparan</span>
            <h3 class="font-editorial" style="font-size:1.45rem;font-weight:600;color:var(--text);">Simulasi Estimasi Biaya &amp; Struktur Pembayaran Dua Termin</h3>
            <p style="font-size:0.875rem;color:var(--text-muted);margin-top:2px;">
              Pilih spesifikasi seragam dan kuantitas pemesanan (10 hingga ribuan pcs). Sistem menghitung otomatis komitmen DP 50% dan pelunasan H+7.
            </p>
          </div>
          <span style="font-size:0.75rem;color:var(--text-muted);font-weight:600;padding:4px 10px;background:var(--surface-tint);border-radius:6px;border:1px solid var(--border);">
            Sesuai PO &amp; MOU Resmi
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
                <option :value="125000">Set Seragam Medis OKA &amp; Scrub Bedah (Estimasi Rp 125.000 / set)</option>
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
              <span style="color:var(--text-muted);">Termin I &bull; DP 50% (Saat PO &amp; MOU):</span>
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

  <!-- [onepagelove.com] SECTION FAQ: PERTANYAAN UMUM PENGADAAN & MUTU -->
  <section id="faq" style="padding:90px 24px;border-bottom:1px solid var(--border);"
           x-data="{ activeFaq: 1 }">
    <div style="max-width:880px;margin:0 auto;">
      
      <div style="text-align:center;margin-bottom:44px;">
        <span class="badge-pill" style="margin-bottom:12px;">Transparansi &amp; Layanan Pelanggan</span>
        <h2 class="font-editorial" style="font-size:clamp(1.8rem, 3.2vw, 2.5rem);font-weight:500;line-height:1.2;color:var(--text);">
          Pertanyaan Umum Pengadaan &amp; Jaminan Kualitas
        </h2>
        <p style="color:var(--text-muted);margin-top:10px;font-size:0.95rem;">
          Informasi penting mengenai jumlah minimum pesanan, alur approval sampel, regulasi perpajakan, dan garansi purna jual.
        </p>
      </div>

      <div style="display:flex;flex-direction:column;gap:14px;">
        
        <!-- FAQ 1 -->
        <div class="atelier-card" style="overflow:hidden;">
          <button type="button" @click="activeFaq = (activeFaq === 1 ? null : 1)"
                  style="width:100%;padding:20px 24px;display:flex;align-items:center;justify-content:space-between;background:transparent;border:none;cursor:pointer;color:var(--text);font-family:inherit;font-weight:700;font-size:1rem;text-align:left;">
            <span>Berapa jumlah minimum pemesanan (MOQ) di Orinamia?</span>
            <span class="font-num" style="color:var(--accent);font-size:1.35rem;transition:transform 200ms;" :style="activeFaq === 1 ? 'transform:rotate(45deg)' : ''">+</span>
          </button>
          <div x-show="activeFaq === 1" x-collapse style="padding:0 24px 22px;border-top:1px solid var(--border-subtle);font-size:0.875rem;color:var(--text-muted);line-height:1.75;">
            Kami melayani pesanan mulai dari <strong>10 pcs</strong> untuk kebutuhan tim klinik, unit medis spesialis, atau seragam komunitas. Untuk pengadaan skala korporat, BUMN, dan rumah sakit besar, kapasitas mesin garmen kami mampu memproduksi hingga <strong>10.000+ pcs per bulan</strong> dengan penjadwalan termin pengiriman bertahap sesuai kebutuhan.
          </div>
        </div>

        <!-- FAQ 2 -->
        <div class="atelier-card" style="overflow:hidden;">
          <button type="button" @click="activeFaq = (activeFaq === 2 ? null : 2)"
                  style="width:100%;padding:20px 24px;display:flex;align-items:center;justify-content:space-between;background:transparent;border:none;cursor:pointer;color:var(--text);font-family:inherit;font-weight:700;font-size:1rem;text-align:left;">
            <span>Apakah kami bisa meminta sampel mockup atau fitting ukuran terlebih dahulu?</span>
            <span class="font-num" style="color:var(--accent);font-size:1.35rem;transition:transform 200ms;" :style="activeFaq === 2 ? 'transform:rotate(45deg)' : ''">+</span>
          </button>
          <div x-show="activeFaq === 2" x-collapse style="padding:0 24px 22px;border-top:1px solid var(--border-subtle);font-size:0.875rem;color:var(--text-muted);line-height:1.75;">
            Tentu. Untuk pesanan institusi, kami menyediakan fasilitas pembuatan sample fitting 1 set lengkap dengan contoh swatch kain asli dan approval sampel bordir komputer digital sebelum produksi massal dimulai. Hal ini menjamin kesesuaian pola dan warna seragam 100% sebelum seluruh rol kain dipotong.
          </div>
        </div>

        <!-- FAQ 3 -->
        <div class="atelier-card" style="overflow:hidden;">
          <button type="button" @click="activeFaq = (activeFaq === 3 ? null : 3)"
                  style="width:100%;padding:20px 24px;display:flex;align-items:center;justify-content:space-between;background:transparent;border:none;cursor:pointer;color:var(--text);font-family:inherit;font-weight:700;font-size:1rem;text-align:left;">
            <span>Bagaimana mekanisme legalitas invoice, faktur pajak, dan rekening pembayaran?</span>
            <span class="font-num" style="color:var(--accent);font-size:1.35rem;transition:transform 200ms;" :style="activeFaq === 3 ? 'transform:rotate(45deg)' : ''">+</span>
          </button>
          <div x-show="activeFaq === 3" x-collapse style="padding:0 24px 22px;border-top:1px solid var(--border-subtle);font-size:0.875rem;color:var(--text-muted);line-height:1.75;">
            Seluruh transaksi ditagihkan atas nama badan hukum resmi <strong>PT CAHAYA BINAR BERLIAN</strong>. Kami menerbitkan Invoice resmi berkop surat, kuitansi bermeterai, serta faktur pajak resmi. Pembayaran dilakukan secara aman melalui rekening giro bank perseroan <strong>BSI 7273909413</strong> a/n PT Cahaya Binar Berlian.
          </div>
        </div>

        <!-- FAQ 4 -->
        <div class="atelier-card" style="overflow:hidden;">
          <button type="button" @click="activeFaq = (activeFaq === 4 ? null : 4)"
                  style="width:100%;padding:20px 24px;display:flex;align-items:center;justify-content:space-between;background:transparent;border:none;cursor:pointer;color:var(--text);font-family:inherit;font-weight:700;font-size:1rem;text-align:left;">
            <span>Apakah ada garansi jika terdapat cacat jahitan atau selisih ukuran?</span>
            <span class="font-num" style="color:var(--accent);font-size:1.35rem;transition:transform 200ms;" :style="activeFaq === 4 ? 'transform:rotate(45deg)' : ''">+</span>
          </button>
          <div x-show="activeFaq === 4" x-collapse style="padding:0 24px 22px;border-top:1px solid var(--border-subtle);font-size:0.875rem;color:var(--text-muted);line-height:1.75;">
            Kami memberikan <strong>Garansi Retur &amp; Perbaikan Penuh (100% Free of Charge)</strong> dalam kurun waktu 14 hari kerja pasca pesanan diterima. Jika terdapat jahitan lepas, kancing rusak, atau ukuran yang meleset dari tabel toleransi standar PO, tim atelier kami akan memperbaiki atau mengganti pakaian yang bersangkutan tanpa biaya tambahan.
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

  <!-- [onepagelove.com] FLOATING ATELIER CONCIERGE CAPSULE -->
  <div class="floating-concierge" role="complementary" aria-label="Concierge Layanan Orinamia">
    <div style="display:flex;align-items:center;gap:10px;">
      <span class="pulse-dot" title="Workshop Tangerang Aktif"></span>
      <div style="line-height:1.2;">
        <div style="font-size:0.75rem;font-weight:700;color:var(--text);">Atelier Karawaci Aktif</div>
        <div style="font-size:0.65rem;color:var(--text-muted);">08.00 &ndash; 17.00 WIB</div>
      </div>
    </div>

    <div style="height:20px;width:1px;background:var(--border);"></div>

    <a href="#kalkulator" class="btn-ghost" style="padding:6px 12px;font-size:0.75rem;border-radius:999px;border:none;background:var(--surface-tint);">
      Estimasi Biaya
    </a>

    <a href="https://wa.me/6285716107394?text=Halo%20Orinamia,%20saya%20ingin%20konsultasi%20pemesanan%20seragam%20dengan%20Atelier%20PT%20Cahaya%20Binar%20Berlian"
       target="_blank" class="btn-brand" style="padding:6px 14px;font-size:0.75rem;border-radius:999px;">
      <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.174.086.275.072.376-.044.101-.116.433-.506.549-.68.116-.174.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/>
      </svg>
      Chat WA
    </a>
  </div>

  <!-- Alpine.js Components & Anime.js Interactions -->
  <script>
    function globalLandingTracker() {
      return {
        scrollPercent: 0,
        initTracker() {
          const updateScroll = () => {
            const scrollTop = window.scrollY || document.documentElement.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
            this.scrollPercent = scrollHeight > 0 ? Math.min(100, Math.max(0, (scrollTop / scrollHeight) * 100)) : 0;
          };
          window.addEventListener('scroll', updateScroll, { passive: true });
          updateScroll();
        }
      }
    }

    function interactiveSlicer() {
      return {
        split: 50,
        activePreset: '50',
        isDragging: false,
        setPreset(val, key) {
          this.activePreset = key;
          if (typeof anime !== 'undefined') {
            anime({
              targets: this,
              split: val,
              duration: 700,
              easing: 'easeOutElastic(1, .8)'
            });
          } else {
            this.split = val;
          }
        },
        onMouseMove(e) {
          if (!this.isDragging) return;
          const rect = e.currentTarget.getBoundingClientRect();
          const x = Math.max(0, Math.min(e.clientX - rect.left, rect.width));
          this.split = Math.round((x / rect.width) * 100);
          this.activePreset = 'custom';
        },
        onTouchMove(e) {
          if (!e.touches || e.touches.length === 0) return;
          const rect = e.currentTarget.getBoundingClientRect();
          const x = Math.max(0, Math.min(e.touches[0].clientX - rect.left, rect.width));
          this.split = Math.round((x / rect.width) * 100);
          this.activePreset = 'custom';
        }
      }
    }

    function garmentStudio() {
      return {
        selectedColor: 'toska',
        sleeveType: 'pendek',
        showEmbroidery: true,
        colors: {
          toska: { name: 'Toska (Kamar Bedah)', hex: '#20B2AA', unit: 'Kamar Bedah Mayor & ICU', pantone: '16-5127 TCX', desc: 'Standar ruang operasi kamar bedah mayor, menetralkan kelelahan optik saat tindakan bedah.' },
          navy: { name: 'Navy Blue (Eksekutif)', hex: '#1B2A4A', unit: 'Dokter Spesialis & Rawat Inap', pantone: '19-3832 TCX', desc: 'Nuansa profesional dan elegan, menjadi pilihan utama konsulen dan pimpinan unit medis.' },
          maroon: { name: 'Maroon (IGD / Emergency)', hex: '#800000', unit: 'Instalasi Gawat Darurat (IGD)', pantone: '19-1528 TCX', desc: 'Warna tegas dan berwibawa, kontras tinggi di ruang resusitasi dan tindakan gawat darurat.' },
          hijau: { name: 'Hijau Kamar Operasi', hex: '#2E8B57', unit: 'Bedah Umum & Anastesi', pantone: '18-5620 TCX', desc: 'Warna klasik operasi bedah dengan kontras optimal terhadap jaringan luka dan pencahayaan.' },
          hijau_muda: { name: 'Hijau Sage Lembut', hex: '#86B595', unit: 'Poliklinik & Pediatri', pantone: '15-6315 TCX', desc: 'Memberikan atmosfer menenangkan untuk pasien anak, poli rawat jalan, dan klinik pratama.' },
          soft_pink: { name: 'Soft Pink (Kebidanan)', hex: '#F4B0C7', unit: 'Ruang VK & Kebidanan', pantone: '13-2006 TCX', desc: 'Nuansa hangat, lembut, dan menenteramkan untuk nakes ruang bersalin dan perawat bayi.' },
          pink_fanta: { name: 'Pink Fanta (Estetika)', hex: '#E63488', unit: 'Klinik Kecantikan & Dental', pantone: '18-2043 TCX', desc: 'Warna modis dan modern, sangat diminati dokter spesialis estetika, kulit, dan gigi.' },
          biru_muda: { name: 'Biru Muda (Hemodialisa)', hex: '#77B8DE', unit: 'Hemodialisa & Rehab Medik', pantone: '14-4115 TCX', desc: 'Menenangkan dan sejuk, ideal untuk unit terapi berkala dan hemodialisa.' },
          biru_benhur: { name: 'Biru Benhur (Laboratorium)', hex: '#0047AB', unit: 'Laboratorium & Farmasi RS', pantone: '18-3949 TCX', desc: 'Kontras tinggi dan tidak mudah tampak kotor, standar tim analis patologi klinik.' },
          ungu: { name: 'Ungu Royal (Radiologi)', hex: '#7A3B7E', unit: 'Radiologi & Diagnostik', pantone: '18-3224 TCX', desc: 'Eksklusif dan khas, mempermudah identifikasi tim radiografer dan penunjang diagnostik.' },
          kuning: { name: 'Kuning Kunyit (CSSD)', hex: '#D89E13', unit: 'CSSD & Unit Sterilisasi', pantone: '14-0848 TCX', desc: 'Visibilitas tinggi untuk standar higienitas sterilisasi instrumen dan isolasi.' },
          orange: { name: 'Orange Bright (Paramedis)', hex: '#E06B20', unit: 'Tim Ambulans & Evakuasi', pantone: '16-1359 TCX', desc: 'Karakter sigap dan mudah terlihat dari kejauhan dalam protokol tanggap darurat.' },
          putih: { name: 'Putih Medis Klasik', hex: '#FFFFFF', unit: 'Residen & Keperawatan Umum', pantone: '11-0601 TCX', desc: 'Simbol kemurnian, sterilitas higienis, dan kerapian paripurna rumah sakit.' }
        },
        getColorHex() {
          return this.colors[this.selectedColor]?.hex || '#20B2AA';
        },
        getColorData() {
          return this.colors[this.selectedColor] || this.colors.toska;
        },
        selectColor(key) {
          this.selectedColor = key;
          if (typeof anime !== 'undefined') {
            anime({
              targets: '#svg-scrub-top, #svg-scrub-pants',
              scale: [0.97, 1],
              duration: 350,
              easing: 'easeOutElastic(1, .6)'
            });
          }
        }
      }
    }

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
          delay: anime.stagger(30, { start: 100 }),
          duration: 700,
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

        // 5. [animejs.com] Swatch Elastic Feedback
        document.querySelectorAll('.swatch-btn').forEach(btn => {
          btn.addEventListener('click', () => {
            anime({
              targets: btn,
              scale: [1, 1.25, 1.15],
              duration: 400,
              easing: 'easeOutElastic(1, .6)'
            });
          });
        });
      }
    });
  </script>

</body>
</html>
