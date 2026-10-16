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

    html {
      scroll-behavior: smooth;
      scroll-padding-top: 100px;
    }
    [id] {
      scroll-margin-top: 100px;
    }
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background-color: var(--bg);
      color: var(--text);
      line-height: 1.6;
      overflow-x: clip;
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
      position: sticky;
      top: 0;
      z-index: 50;
      background: rgba(250, 249, 252, 0.92);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border-bottom: 1px solid var(--border);
    }
    .dark .glass-nav {
      background: rgba(18, 17, 22, 0.92);
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
      height: 640px;
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid var(--border);
      background: var(--surface);
      background-image: 
        linear-gradient(to right, rgba(173, 142, 235, 0.04) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(173, 142, 235, 0.04) 1px, transparent 1px);
      background-size: 24px 24px;
      box-shadow: var(--card-shadow);
      user-select: none;
      touch-action: pan-y;
    }
    @media (max-width: 820px) {
      .slicer-container { height: 860px; }
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
    /* [huyml.co] Interactive Floating Cursor Preview Card */
    .cursor-preview-card {
      position: fixed;
      pointer-events: none;
      z-index: 99999;
      width: 300px;
      padding: 16px 18px;
      border-radius: 12px;
      background: rgba(250, 249, 252, 0.96);
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      border: 1px solid var(--border);
      box-shadow: 0 24px 50px -10px rgba(110, 56, 122, 0.28);
      opacity: 0;
      transform: translate3d(-50%, -50%, 0) scale(0.92);
      transition: opacity 180ms ease, transform 160ms cubic-bezier(0.16, 1, 0.3, 1);
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    .dark .cursor-preview-card {
      background: rgba(27, 25, 33, 0.96);
      box-shadow: 0 24px 50px -10px rgba(0, 0, 0, 0.75);
    }
    .cursor-preview-card.visible {
      opacity: 1;
      transform: translate3d(-50%, -50%, 0) scale(1);
    }

    /* [huyml.co] Archive Table Rows */
    .archive-table {
      width: 100%;
      border: 1px solid var(--border);
      border-radius: 12px;
      overflow: hidden;
      background: var(--surface);
    }
    .archive-header {
      display: grid;
      grid-template-columns: 56px 2.2fr 1.6fr 1.6fr 1.1fr 110px;
      padding: 14px 20px;
      background: var(--surface-tint);
      border-bottom: 1px solid var(--border);
      font-size: 0.7rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--text-muted);
    }
    .archive-row {
      display: grid;
      grid-template-columns: 56px 2.2fr 1.6fr 1.6fr 1.1fr 110px;
      align-items: center;
      padding: 18px 20px;
      border-bottom: 1px solid var(--border);
      color: var(--text);
      cursor: pointer;
      transition: all 180ms ease;
    }
    .archive-row:last-child { border-bottom: none; }
    .archive-row:hover {
      background: var(--surface-tint);
      padding-left: 28px;
    }
    .archive-row:hover .archive-arrow {
      transform: translateX(4px);
      color: var(--accent);
    }
    @media (max-width: 960px) {
      .archive-header, .archive-row {
        grid-template-columns: 44px 1.8fr 1.2fr 90px;
      }
      .archive-hide-tablet { display: none !important; }
    }
    @media (max-width: 640px) {
      .archive-header, .archive-row {
        grid-template-columns: 36px 1fr 80px;
      }
      .archive-hide-mobile { display: none !important; }
    }

    /* [huyml.co] Slide-over Craftsmanship Dossier */
    .dossier-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      z-index: 10000;
      display: flex;
      justify-content: flex-end;
    }
    .dossier-panel {
      width: 100%;
      max-width: 620px;
      height: 100vh;
      background: var(--surface);
      border-left: 1px solid var(--border);
      box-shadow: -10px 0 40px rgba(0, 0, 0, 0.35);
      overflow-y: auto;
      padding: 36px 32px;
      display: flex;
      flex-direction: column;
      gap: 24px;
      position: relative;
    }
    @media (max-width: 640px) {
      .dossier-panel { padding: 24px 20px; }
    }

    /* Sub-Header Live Atelier Ticker (Huyml style) */
    .huyml-meta-strip {
      border-bottom: 1px solid var(--border);
      background: var(--surface-tint);
      padding: 8px 24px;
      font-size: 0.75rem;
      color: var(--text-muted);
    }

    /* =========================================================================
       [huyml.co & awwwards] ATELIER SARTORIAL PRELOADER STYLING
       ========================================================================= */
    #atelier-preloader {
      position: fixed;
      inset: 0;
      z-index: 999999;
      background: #0B0A0E;
      color: #FFFFFF;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: clamp(20px, 4vw, 40px);
      overflow: hidden;
      will-change: transform;
      user-select: none;
    }
    #atelier-preloader.preloader-exit {
      transform: translateY(-100%);
      transition: transform 850ms cubic-bezier(0.77, 0, 0.175, 1);
      pointer-events: none;
    }
    .preloader-grid {
      position: absolute;
      inset: 0;
      background-image: 
        radial-gradient(circle at center, rgba(173, 142, 235, 0.08) 0, transparent 70%),
        repeating-linear-gradient(0deg, rgba(255, 255, 255, 0.018) 0, rgba(255, 255, 255, 0.018) 1px, transparent 1px, transparent 40px),
        repeating-linear-gradient(90deg, rgba(255, 255, 255, 0.018) 0, rgba(255, 255, 255, 0.018) 1px, transparent 1px, transparent 40px);
      pointer-events: none;
      z-index: 1;
    }
    .preloader-top-bar, .preloader-bottom-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: relative;
      z-index: 2;
      flex-wrap: wrap;
      gap: 12px;
    }
    .preloader-center {
      position: relative;
      z-index: 2;
      max-width: 640px;
      margin: 0 auto;
      width: 100%;
      text-align: center;
    }
    .preloader-sewing-stage {
      width: 100%;
      max-width: 440px;
      margin: 0 auto 16px;
    }
    .preloader-sewing-svg {
      width: 100%;
      height: auto;
      overflow: visible;
    }
    .preloader-counter-row {
      display: flex;
      align-items: baseline;
      justify-content: center;
      gap: 4px;
      margin-bottom: 12px;
      line-height: 1;
    }
    .preloader-counter-val {
      font-size: clamp(3.2rem, 8vw, 6.2rem);
      font-weight: 800;
      letter-spacing: -0.03em;
      background: linear-gradient(180deg, #FFFFFF 30%, #C4B5FD 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .preloader-percent-sign {
      font-family: 'Newsreader', Georgia, serif;
      font-style: italic;
      font-size: clamp(1.8rem, 4vw, 3rem);
      color: #F391EC;
      opacity: 0.9;
    }
    .preloader-phase-text {
      font-size: clamp(0.85rem, 1.6vw, 1rem);
      color: #E2D4F0;
      font-weight: 500;
      margin-bottom: 24px;
      min-height: 28px;
      letter-spacing: 0.02em;
      transition: opacity 200ms ease;
    }
    .preloader-tape-wrapper {
      width: 100%;
      height: 6px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 999px;
      overflow: hidden;
      margin-bottom: 10px;
      position: relative;
    }
    .preloader-tape-fill {
      height: 100%;
      background: linear-gradient(90deg, #F391EC, #AD8EEB, #FFFFFF);
      border-radius: 999px;
      transition: width 80ms linear;
      box-shadow: 0 0 12px #AD8EEB;
    }
    .preloader-tape-ticks {
      display: flex;
      justify-content: space-between;
      font-family: 'JetBrains Mono', monospace;
      font-size: 0.65rem;
      color: #8C809E;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }
    .preloader-skip-btn {
      background: rgba(255, 255, 255, 0.06);
      border: 1px solid rgba(255, 255, 255, 0.14);
      color: #E2D4F0;
      padding: 6px 14px;
      border-radius: 999px;
      font-size: 0.75rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 200ms ease;
    }
    .preloader-skip-btn:hover {
      background: rgba(255, 255, 255, 0.12);
      border-color: #F391EC;
      color: #FFFFFF;
    }

    /* =========================================================================
       [huyml.co] SENI MENJAHIT SCROLL TECHNIQUES:
       1. Top Chainstitch Seam
       2. Vertical Seam Rail & Floating Needle
       ========================================================================= */
    .header-chainstitch-track {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: rgba(173, 142, 235, 0.15);
      overflow: hidden;
      pointer-events: none;
    }
    .header-chainstitch-fill {
      height: 100%;
      background: linear-gradient(90deg, #F391EC, #6E387A, #AD8EEB);
      background-size: 16px 100%;
      transition: width 100ms linear;
      position: relative;
    }
    .header-chainstitch-fill::after {
      content: '';
      position: absolute;
      top: 0;
      right: 0;
      width: 6px;
      height: 3px;
      background: #FFFFFF;
      box-shadow: 0 0 6px #F391EC;
    }

    .atelier-seam-rail {
      position: fixed;
      right: 18px;
      top: 130px;
      bottom: 110px;
      width: 28px;
      z-index: 45;
      pointer-events: none;
      display: none;
    }
    @media (min-width: 1100px) {
      .atelier-seam-rail {
        display: block;
      }
    }
    .seam-tape-marks {
      position: absolute;
      right: 22px;
      top: 0;
      bottom: 0;
      width: 30px;
      font-family: 'JetBrains Mono', monospace;
      font-size: 0.6rem;
      color: var(--text-muted);
      opacity: 0.45;
    }
    .seam-tape-marks span {
      position: absolute;
      right: 0;
      transform: translateY(-50%);
      white-space: nowrap;
    }
    .seam-thread-track {
      position: absolute;
      left: 14px;
      top: 0;
      bottom: 0;
      width: 2px;
      background: repeating-linear-gradient(to bottom, rgba(173, 142, 235, 0.25) 0, rgba(173, 142, 235, 0.25) 4px, transparent 4px, transparent 8px);
    }
    .seam-thread-stitched {
      position: absolute;
      left: 0;
      top: 0;
      width: 2px;
      background: repeating-linear-gradient(to bottom, var(--accent) 0, var(--accent) 5px, #F391EC 5px, #F391EC 8px);
      box-shadow: 0 0 6px rgba(110, 56, 122, 0.4);
      transition: height 120ms linear;
    }
    .floating-seam-needle {
      position: absolute;
      left: 15px;
      pointer-events: auto;
      cursor: grab;
      transition: top 120ms cubic-bezier(0.16, 1, 0.3, 1), transform 200ms ease;
    }
    .needle-depth-badge {
      position: absolute;
      right: 32px;
      top: 50%;
      transform: translateY(-50%);
      background: var(--surface);
      border: 1px solid var(--border);
      padding: 3px 8px;
      border-radius: 999px;
      font-size: 0.68rem;
      font-weight: 700;
      white-space: nowrap;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      color: var(--text);
      opacity: 0.85;
      transition: opacity 150ms ease;
    }
    .floating-seam-needle:hover .needle-depth-badge {
      opacity: 1;
    }
  </style>
</head>
<body x-data="globalLandingTracker()" x-init="initTracker()">

  <!-- [huyml.co & awwwards] ATELIER SARTORIAL PRELOADER (SENI MENJAHIT) -->
  <div id="atelier-preloader"
       x-data="atelierPreloader()"
       x-show="!finished"
       :class="{ 'preloader-exit': exiting }"
       role="dialog"
       aria-modal="true"
       aria-label="Atelier Loading Screen">
    
    <!-- Fine Tailor Canvas Watermark Lines -->
    <div class="preloader-grid" aria-hidden="true"></div>

    <!-- Top Metadata Bar -->
    <div class="preloader-top-bar">
      <div style="display:flex;align-items:center;gap:10px;">
        <span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:#F391EC;box-shadow:0 0 8px #F391EC;"></span>
        <span style="font-size:0.75rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#E2D4F0;">
          PT CAHAYA BINAR BERLIAN &bull; ATELIER ORINAMIA
        </span>
      </div>
      <div style="font-size:0.75rem;font-family:'JetBrains Mono',monospace;color:#A99AB8;">
        KALIBRASI JAHITAN ISO 4915 &bull; <span x-text="clockText">08:00:00 WIB</span>
      </div>
    </div>

    <!-- Centerpiece: Artisan Needle & Animated Thread Seam -->
    <div class="preloader-center">
      
      <!-- Needle & Thread SVG Graphic Animation -->
      <div class="preloader-sewing-stage">
        <svg viewBox="0 0 400 120" fill="none" class="preloader-sewing-svg" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Animasi Jarum dan Benang Menjahit">
          <!-- Fabric Seam Line (Background Dash) -->
          <path d="M20 60 Q110 20, 200 60 T380 60" stroke="rgba(255,255,255,0.12)" stroke-width="2" stroke-dasharray="4 6"/>
          
          <!-- Animated Stitched Thread (Draws as progress increases) -->
          <path id="preloader-thread-path" d="M20 60 Q110 20, 200 60 T380 60" 
                stroke="url(#preloaderThreadGrad)" stroke-width="3" stroke-linecap="round" stroke-dasharray="400"
                :stroke-dashoffset="400 - (progress * 4)"/>

          <!-- Puncture Needle Marks Along Path -->
          <circle cx="20" cy="60" r="3" fill="#F391EC" :opacity="progress >= 5 ? 1 : 0.2"/>
          <circle cx="110" cy="35" r="3" fill="#F391EC" :opacity="progress >= 30 ? 1 : 0.2"/>
          <circle cx="200" cy="60" r="3" fill="#F391EC" :opacity="progress >= 55 ? 1 : 0.2"/>
          <circle cx="290" cy="85" r="3" fill="#F391EC" :opacity="progress >= 80 ? 1 : 0.2"/>
          <circle cx="380" cy="60" r="3" fill="#F391EC" :opacity="progress >= 98 ? 1 : 0.2"/>

          <!-- Moving Tailor's Needle following the thread -->
          <g :transform="'translate(' + (20 + (progress * 3.6)) + ', ' + (60 - Math.sin((progress/100) * Math.PI * 2) * 25) + ') rotate(' + (-15 + Math.sin((progress/100) * Math.PI * 4) * 20) + ')'">
            <path d="M0 -22 L3 -8 L1 18 L0 24 L-1 18 L-3 -8 Z" fill="url(#needleShine)"/>
            <ellipse cx="0" cy="-14" rx="0.8" ry="2.4" fill="#0B0A0E"/>
            <path d="M0 -14 Q6 -22, 12 -16" stroke="#F391EC" stroke-width="1.2" stroke-linecap="round"/>
          </g>

          <defs>
            <linearGradient id="preloaderThreadGrad" x1="0" y1="0" x2="400" y2="0" gradientUnits="userSpaceOnUse">
              <stop stop-color="#F391EC"/>
              <stop offset="0.5" stop-color="#AD8EEB"/>
              <stop offset="1" stop-color="#FFFFFF"/>
            </linearGradient>
            <linearGradient id="needleShine" x1="-3" y1="-22" x2="3" y2="24" gradientUnits="userSpaceOnUse">
              <stop stop-color="#FFFFFF"/>
              <stop offset="0.5" stop-color="#D1C4E9"/>
              <stop offset="1" stop-color="#7E57C2"/>
            </linearGradient>
          </defs>
        </svg>
      </div>

      <!-- Large Editorial Percentage Display -->
      <div class="preloader-counter-row">
        <span class="font-num preloader-counter-val" x-text="formattedProgress">00</span>
        <span class="preloader-percent-sign">%</span>
      </div>

      <!-- Craftsmanship Phase Ticker -->
      <div class="preloader-phase-text" x-text="currentPhase"></div>

      <!-- Tailor Tape Ruler Track (Pita Meteran Kemajuan Jahit) -->
      <div class="preloader-tape-wrapper">
        <div class="preloader-tape-fill" :style="'width: ' + progress + '%'"></div>
      </div>
      <div class="preloader-tape-ticks">
        <span>00 cm &bull; Pola</span>
        <span>25 cm &bull; Serat</span>
        <span>50 cm &bull; 12 SPI</span>
        <span>75 cm &bull; Bar-Tack</span>
        <span>100 cm &bull; Selesai</span>
      </div>

    </div>

    <!-- Bottom Skip / Dismiss Action -->
    <div class="preloader-bottom-bar">
      <button type="button" @click="dismissImmediately()" class="preloader-skip-btn">
        Lewati Animasi Intro &rarr;
      </button>
      <div style="font-size:0.75rem;color:#7E728C;font-family:'JetBrains Mono',monospace;">
        KERAJINAN TANGAN &bull; KARAWACI, TANGERANG
      </div>
    </div>
  </div>

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

      <!-- Desktop Links (Slicing Removed from Navbar) -->
      <nav style="display:none;align-items:center;gap:22px;" class="desktop-menu" aria-label="Navigasi Utama">
        <a href="#tentang" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Tentang Kami</a>
        <a href="#layanan" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Koleksi &amp; Produk</a>
        <a href="#medis" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Seragam OKA</a>
        <a href="#klien" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Klien Kami</a>
        <a href="#alur" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Alur Kerjasama</a>
        <a href="#faq" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">FAQ</a>
        <a href="#legalitas" style="text-decoration:none;color:var(--text-muted);font-size:0.875rem;font-weight:500;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Legalitas</a>
      </nav>

      <!-- Right Actions -->
      <div style="display:flex;align-items:center;gap:12px;">
        
        <!-- Theme Toggle (shadcn style) -->
        <button @click="dark = !dark; localStorage.setItem('theme', dark ? 'dark' : 'light')" type="button" class="btn-ghost" style="padding:8px;min-height:38px;width:38px;display:inline-flex;align-items:center;justify-content:center;border-radius:8px;" title="Ganti Tema">
          <svg x-show="!dark" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>
          </svg>
          <svg x-show="dark" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/>
          </svg>
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

    <!-- Tailor's Chainstitch Seam Scroll Line (Seni Menjahit) -->
    <div class="header-chainstitch-track" aria-hidden="true">
      <div class="header-chainstitch-fill" :style="'width: ' + scrollPercent + '%'"></div>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div x-show="mobileMenu" x-transition style="border-top:1px solid var(--border);padding:16px 24px;display:flex;flex-direction:column;gap:12px;background:var(--surface);">
      <a href="#tentang" @click="mobileMenu = false" style="text-decoration:none;color:var(--text);font-weight:600;">Tentang Kami</a>
      <a href="#layanan" @click="mobileMenu = false" style="text-decoration:none;color:var(--text);font-weight:600;">Koleksi &amp; Produk</a>
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

  <!-- [huyml.co] SUB-HEADER LIVE ATELIER META STRIP -->
  <div class="huyml-meta-strip">
    <div style="max-width:1280px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
      
      <!-- Studio Location & Live Time (Huyml signature) -->
      <div style="display:flex;align-items:center;gap:12px;">
        <span style="font-weight:700;color:var(--text);letter-spacing:0.04em;">ATELIER KARAWACI, ID</span>
        <span style="color:var(--border);">&bull;</span>
        <span class="font-num" style="font-weight:600;color:var(--accent);" x-text="liveTime || '08:00:00 WIB'">08:00:00 WIB</span>
        <span style="color:var(--border);">&bull;</span>
        <span style="display:inline-flex;align-items:center;gap:6px;color:#10B981;font-weight:600;">
          <span style="width:6px;height:6px;border-radius:50%;background:#10B981;"></span>
          Melayani Order Produksi &amp; Tender 2026
        </span>
      </div>

      <!-- Legal & Capacity Meta -->
      <div style="display:flex;align-items:center;gap:16px;" class="archive-hide-mobile">
        <span>Kapasitas: <strong class="font-num" style="color:var(--text);">10.000+ Pcs/Bln</strong></span>
        <span style="color:var(--border);">&bull;</span>
        <span>Akuntabilitas: <strong style="color:var(--text);">SK Kemenkumham RI 2024</strong></span>
        <span style="color:var(--border);">&bull;</span>
        <a href="#arsip" style="color:var(--accent);text-decoration:none;font-weight:700;">
          Lihat Arsip Jahitan &darr;
        </a>
      </div>

    </div>
  </div>

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

  <!-- [lafys.com, curated.design & awwwards.com] THE INTERACTIVE QUALITY & STITCH CRAFTSMANSHIP SECTION -->
  <section id="slicing" style="padding:90px 24px 80px;border-bottom:1px solid var(--border);position:relative;background:var(--bg);"
           x-data="interactiveSlicer()">
    <div style="max-width:1160px;margin:0 auto;">
      
      <!-- Quality Section Header -->
      <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:20px;margin-bottom:28px;">
        <div style="max-width:680px;">
          <div style="display:inline-flex;align-items:center;gap:8px;padding:4px 14px;background:var(--surface);border:1px solid var(--border);border-radius:999px;margin-bottom:12px;">
            <span style="width:7px;height:7px;border-radius:50%;background:#AD8EEB;"></span>
            <span style="font-size:0.75rem;font-weight:700;letter-spacing:0.08em;color:var(--accent);text-transform:uppercase;">Studio Rekayasa Mutu &amp; Anatomi Tekstil &bull; Standar ISO 4915</span>
          </div>
          <h2 class="font-editorial" style="font-size:clamp(1.9rem, 3.4vw, 2.8rem);font-weight:500;line-height:1.2;color:var(--text);margin-bottom:10px;">
            Bedah Rekayasa Mutu: Komparasi Presisi Jahitan Garmen
          </h2>
          <p style="color:var(--text-muted);font-size:0.95rem;line-height:1.65;">
            Bandingkan langsung standar jahitan atelier PT Cahaya Binar Berlian dengan konveksi pasaran melalui 3 instrumen: Slider Komparasi Mutu, Uji Pembesaran Serat 10x, dan Klasifikasi Standar ISO 4915.
          </p>
        </div>

        <!-- Mode Sub-Tabs (shadcn Tabs style) -->
        <div style="display:flex;gap:6px;flex-wrap:wrap;padding:4px;background:var(--surface-tint);border-radius:10px;border:1px solid var(--border);">
          <button type="button" class="btn-slicing-preset" :class="{ 'active': slicingSubTab === 'slicer' }" @click="slicingSubTab = 'slicer'" style="display:inline-flex;align-items:center;gap:6px;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/><path d="M5 3v4"/><path d="M19 17v4"/><path d="M3 5h4"/><path d="M17 19h4"/></svg>
            Komparasi Mutu Jahitan
          </button>
          <button type="button" class="btn-slicing-preset" :class="{ 'active': slicingSubTab === 'macro' }" @click="slicingSubTab = 'macro'" style="display:inline-flex;align-items:center;gap:6px;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 18h8"/><path d="M3 22h18"/><path d="m14 22-4-4"/><path d="M9 14h2"/><path d="M9 12a2 2 0 0 1-2-2V6h6v4a2 2 0 0 1-2 2Z"/><path d="m12 6 4-4 3 3-4 4"/><path d="m14 18 1.5 1.5"/></svg>
            Pembesaran Serat 10x
          </button>
          <button type="button" class="btn-slicing-preset" :class="{ 'active': slicingSubTab === 'iso' }" @click="slicingSubTab = 'iso'" style="display:inline-flex;align-items:center;gap:6px;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.3 8.7-5-5a1 1 0 0 0-1.4 0l-12 12a1 1 0 0 0 0 1.4l5 5a1 1 0 0 0 1.4 0l12-12a1 1 0 0 0 0-1.4Z"/><path d="m7.5 10.5 2 2"/><path d="m10.5 7.5 2 2"/><path d="m13.5 4.5 2 2"/><path d="m4.5 13.5 2 2"/></svg>
            Klasifikasi ISO 4915
          </button>
        </div>
      </div>

      <!-- SUB-TAB 1: SLICING COMPARISON SLIDER -->
      <div x-show="slicingSubTab === 'slicer'" x-transition:enter="transition ease-out duration-250">
        <!-- Interactive Presets (Awwwards / ReactBits style) -->
        <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:20px;justify-content:flex-end;">
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

            <!-- Visual Anatomy Blueprint: Pasaran Seam & Pocket Construction -->
            <div style="width:100%;height:150px;position:relative;margin:12px 0;border-radius:12px;background:radial-gradient(ellipse at 70% 50%, rgba(239,68,68,0.08) 0%, rgba(0,0,0,0.18) 100%);border:1px dashed rgba(239,68,68,0.25);overflow:hidden;display:flex;align-items:center;">
              <svg width="100%" height="100%" viewBox="0 0 900 150" fill="none" preserveAspectRatio="xMidYMid meet" style="width:100%;height:100%;">
                <defs>
                  <pattern id="pasaran-schematic-grid" width="20" height="20" patternUnits="userSpaceOnUse">
                    <line x1="0" y1="20" x2="20" y2="20" stroke="rgba(239,68,68,0.06)" stroke-width="1"/>
                    <line x1="20" y1="0" x2="20" y2="20" stroke="rgba(239,68,68,0.06)" stroke-width="1"/>
                  </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#pasaran-schematic-grid)"/>

                <!-- Garment Panel Baseline -->
                <path d="M 50 25 L 850 25 L 850 125 L 50 125 Z" fill="rgba(239, 68, 68, 0.03)" stroke="rgba(239, 68, 68, 0.15)" stroke-width="1"/>

                <!-- Pocket Contour (Pasaran) -->
                <path d="M 450 35 L 750 35 L 750 115 L 450 115 Z" fill="rgba(239, 68, 68, 0.05)" stroke="rgba(239, 68, 68, 0.3)" stroke-width="1.5"/>

                <!-- Loose, Wavy 8 SPI Stitch Lines (Irregular single thread) -->
                <path d="M 460 48 Q 535 50, 610 47 T 740 49" stroke="#EF4444" stroke-width="2.5" stroke-dasharray="14 10" stroke-linecap="round"/>
                <path d="M 740 49 L 740 105" stroke="#EF4444" stroke-width="2.5" stroke-dasharray="14 10" stroke-linecap="round"/>
                <path d="M 460 48 L 460 105" stroke="#EF4444" stroke-width="2.5" stroke-dasharray="14 10" stroke-linecap="round"/>

                <!-- Fraying loose thread tail at corner -->
                <path d="M 450 35 Q 435 45, 430 70 T 425 85" stroke="#EF4444" stroke-width="1.5" stroke-linecap="round" fill="none" opacity="0.8"/>
                <path d="M 750 35 Q 765 48, 770 65" stroke="#EF4444" stroke-width="1.5" stroke-linecap="round" fill="none" opacity="0.8"/>

                <!-- Red Warning Stress Rings at Corner (No Bar-Tack!) -->
                <circle cx="450" cy="35" r="8" stroke="#EF4444" stroke-width="1.5" stroke-dasharray="3 3" fill="rgba(239,68,68,0.2)"/>
                <circle cx="450" cy="35" r="16" stroke="#EF4444" stroke-width="1" stroke-dasharray="4 4" fill="none" opacity="0.4"/>
                <circle cx="450" cy="35" r="3" fill="#EF4444"/>

                <!-- Technical Blueprint Annotations on SVG -->
                <g transform="translate(480, 16)">
                  <rect width="180" height="22" rx="4" fill="rgba(239,68,68,0.15)" stroke="rgba(239,68,68,0.4)" stroke-width="1"/>
                  <text x="8" y="15" fill="#EF4444" font-size="10.5" font-family="'JetBrains Mono', monospace" font-weight="700">8 SPI - JAHITAN RENYUT</text>
                </g>

                <g transform="translate(240, 45)">
                  <line x1="200" y1="-10" x2="160" y2="10" stroke="#EF4444" stroke-width="1.2" stroke-dasharray="2 2"/>
                  <rect width="180" height="22" rx="4" fill="rgba(239,68,68,0.15)" stroke="rgba(239,68,68,0.4)" stroke-width="1"/>
                  <text x="8" y="15" fill="#EF4444" font-size="10" font-family="'JetBrains Mono', monospace" font-weight="700">TITIK ROBEK (NO BAR-TACK)</text>
                </g>

                <g transform="translate(560, 80)">
                  <text x="0" y="14" fill="var(--text-muted)" font-size="10" font-family="'JetBrains Mono', monospace">Toleransi Margin: &plusmn;3.5mm</text>
                  <text x="0" y="28" fill="#EF4444" font-size="10" font-family="'JetBrains Mono', monospace" font-weight="600">Daya Beban Saku: &lt;800 gram</text>
                </g>
              </svg>
            </div>

            <!-- Technical Callouts (Right side of canvas for Pasaran) -->
            <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:12px;margin-top:auto;max-width:540px;margin-left:auto;">
              <div style="padding:12px 14px;background:var(--surface);border-radius:8px;border:1px solid rgba(239,68,68,0.25);box-shadow:0 2px 6px rgba(0,0,0,0.03);">
                <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;font-weight:700;color:#DC2626;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                  </svg>
                  8 SPI (Stitch Per Inch)
                </div>
                <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Jahitan renggang, benang mudah terurai saat dicuci mesin.</div>
              </div>
              <div style="padding:12px 14px;background:var(--surface);border-radius:8px;border:1px solid rgba(239,68,68,0.25);box-shadow:0 2px 6px rgba(0,0,0,0.03);">
                <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;font-weight:700;color:#DC2626;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                  </svg>
                  Tanpa Bar-Tack
                </div>
                <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Sudut saku robek saat dibebani alat medis atau gawai.</div>
              </div>
              <div style="padding:12px 14px;background:var(--surface);border-radius:8px;border:1px solid rgba(239,68,68,0.25);box-shadow:0 2px 6px rgba(0,0,0,0.03);">
                <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;font-weight:700;color:#DC2626;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                  </svg>
                  Poliester Standar
                </div>
                <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Panas, gerah, dan mengkerut jika masuk autoklaf.</div>
              </div>
              <div style="padding:12px 14px;background:var(--surface);border-radius:8px;border:1px solid rgba(239,68,68,0.25);box-shadow:0 2px 6px rgba(0,0,0,0.03);">
                <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;font-weight:700;color:#DC2626;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                  </svg>
                  Kerah Lemas
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

            <!-- Visual Anatomy Blueprint: Orinamia Atelier Seam & Pocket Construction -->
            <div style="width:100%;height:150px;position:relative;margin:12px 0;border-radius:12px;background:radial-gradient(ellipse at 30% 50%, rgba(16,185,129,0.08) 0%, rgba(0,0,0,0.18) 100%);border:1px solid rgba(16,185,129,0.3);overflow:hidden;display:flex;align-items:center;">
              <svg width="100%" height="100%" viewBox="0 0 900 150" fill="none" preserveAspectRatio="xMidYMid meet" style="width:100%;height:100%;">
                <defs>
                  <pattern id="atelier-schematic-grid" width="20" height="20" patternUnits="userSpaceOnUse">
                    <line x1="0" y1="20" x2="20" y2="20" stroke="rgba(16,185,129,0.06)" stroke-width="1"/>
                    <line x1="20" y1="0" x2="20" y2="20" stroke="rgba(16,185,129,0.06)" stroke-width="1"/>
                  </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#atelier-schematic-grid)"/>

                <!-- Garment Panel Baseline -->
                <path d="M 50 25 L 850 25 L 850 125 L 50 125 Z" fill="rgba(16, 185, 129, 0.04)" stroke="rgba(16, 185, 129, 0.2)" stroke-width="1"/>

                <!-- Pocket Contour (Orinamia) -->
                <path d="M 450 35 L 750 35 L 750 115 L 450 115 Z" fill="rgba(16, 185, 129, 0.06)" stroke="rgba(16, 185, 129, 0.35)" stroke-width="1.5"/>

                <!-- Triple Chainstitch 14 SPI Lines (Laser straight 3 parallel rows) -->
                <!-- Row 1 -->
                <path d="M 458 46 L 742 46" stroke="#10B981" stroke-width="2" stroke-dasharray="5 3" stroke-linecap="round"/>
                <path d="M 742 46 L 742 108" stroke="#10B981" stroke-width="2" stroke-dasharray="5 3" stroke-linecap="round"/>
                <path d="M 458 46 L 458 108" stroke="#10B981" stroke-width="2" stroke-dasharray="5 3" stroke-linecap="round"/>
                <!-- Row 2 -->
                <path d="M 461 49 L 739 49" stroke="#34D399" stroke-width="1.8" stroke-dasharray="5 3" stroke-linecap="round"/>
                <path d="M 739 49 L 739 105" stroke="#34D399" stroke-width="1.8" stroke-dasharray="5 3" stroke-linecap="round"/>
                <path d="M 461 49 L 461 105" stroke="#34D399" stroke-width="1.8" stroke-dasharray="5 3" stroke-linecap="round"/>
                <!-- Row 3 (Loop interlock effect) -->
                <path d="M 464 52 L 736 52" stroke="#6EE7B7" stroke-width="1.5" stroke-dasharray="4 2" stroke-linecap="round"/>
                <path d="M 736 52 L 736 102" stroke="#6EE7B7" stroke-width="1.5" stroke-dasharray="4 2" stroke-linecap="round"/>
                <path d="M 464 52 L 464 102" stroke="#6EE7B7" stroke-width="1.5" stroke-dasharray="4 2" stroke-linecap="round"/>

                <!-- Double Bar-Tack 42-Tusukan Dense Cross-Hatch Box at Corner -->
                <g transform="translate(442, 28)">
                  <rect width="18" height="14" rx="2" fill="rgba(16,185,129,0.3)" stroke="#10B981" stroke-width="2"/>
                  <!-- 42 tusukan zigzag pattern -->
                  <path d="M 2 2 L 16 12 M 2 6 L 16 16 M 2 12 L 16 2 M 6 2 L 6 12 M 12 2 L 12 12" stroke="#FFFFFF" stroke-width="1.2"/>
                  <!-- Pulse indicator -->
                  <circle cx="9" cy="7" r="14" stroke="#10B981" stroke-width="1" stroke-dasharray="2 2" fill="none" opacity="0.5"/>
                </g>

                <g transform="translate(740, 28)">
                  <rect width="18" height="14" rx="2" fill="rgba(16,185,129,0.3)" stroke="#10B981" stroke-width="2"/>
                  <path d="M 2 2 L 16 12 M 2 6 L 16 16 M 2 12 L 16 2 M 6 2 L 6 12 M 12 2 L 12 12" stroke="#FFFFFF" stroke-width="1.2"/>
                </g>

                <!-- Technical Blueprint Annotations on SVG -->
                <g transform="translate(180, 16)">
                  <rect width="250" height="22" rx="4" fill="rgba(16,185,129,0.15)" stroke="rgba(16,185,129,0.4)" stroke-width="1"/>
                  <text x="8" y="15" fill="#10B981" font-size="10.5" font-family="'JetBrains Mono', monospace" font-weight="700">14 SPI TRIPLE CHAINSTITCH (ISO 4915)</text>
                </g>

                <g transform="translate(180, 48)">
                  <line x1="255" y1="-15" x2="265" y2="-15" stroke="#10B981" stroke-width="1.2"/>
                  <rect width="215" height="22" rx="4" fill="rgba(16,185,129,0.15)" stroke="rgba(16,185,129,0.4)" stroke-width="1"/>
                  <text x="8" y="15" fill="#10B981" font-size="10" font-family="'JetBrains Mono', monospace" font-weight="700">DOUBLE BAR-TACK 42 TUSUKAN</text>
                </g>

                <g transform="translate(180, 80)">
                  <text x="0" y="14" fill="var(--text)" font-size="10" font-family="'JetBrains Mono', monospace" font-weight="600">Presisi Toleransi: &plusmn;0.5mm</text>
                  <text x="0" y="28" fill="#10B981" font-size="10" font-family="'JetBrains Mono', monospace" font-weight="700">Beban Tarik Saku: &gt;2.5 kg (Lolos Uji)</text>
                </g>
              </svg>
            </div>

            <!-- Technical Callouts (Left side of canvas for Orinamia) -->
            <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:12px;margin-top:auto;max-width:540px;">
              <div style="padding:12px 14px;background:var(--surface-tint);border-radius:8px;border:1px solid rgba(16,185,129,0.3);box-shadow:0 2px 8px rgba(110,56,122,0.06);">
                <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;font-weight:700;color:#059669;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                    <polyline points="20 6 9 17 4 12"/>
                  </svg>
                  12 - 14 SPI Triple Chain
                </div>
                <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Jahitan rantai rapat dan lentur, tahan tarikan ekstrem.</div>
              </div>
              <div style="padding:12px 14px;background:var(--surface-tint);border-radius:8px;border:1px solid rgba(16,185,129,0.3);box-shadow:0 2px 8px rgba(110,56,122,0.06);">
                <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;font-weight:700;color:#059669;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                    <polyline points="20 6 9 17 4 12"/>
                  </svg>
                  Double Bar-Tack 42 Tusukan
                </div>
                <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Kunci silang di setiap sudut saku, sanggup menahan beban 2.5 kg.</div>
              </div>
              <div style="padding:12px 14px;background:var(--surface-tint);border-radius:8px;border:1px solid rgba(16,185,129,0.3);box-shadow:0 2px 8px rgba(110,56,122,0.06);">
                <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;font-weight:700;color:#059669;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                    <polyline points="20 6 9 17 4 12"/>
                  </svg>
                  Toyobo Fodu Grade A
                </div>
                <div style="font-size:0.75rem;color:var(--text-muted);margin-top:2px;">Serat katun murni adem, lolos uji autoklaf sterilisasi 121°C.</div>
              </div>
              <div style="padding:12px 14px;background:var(--surface-tint);border-radius:8px;border:1px solid rgba(16,185,129,0.3);box-shadow:0 2px 8px rgba(110,56,122,0.06);">
                <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;font-weight:700;color:#059669;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                    <polyline points="20 6 9 17 4 12"/>
                  </svg>
                  Interlining Fusible Jerman
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

      <!-- SUB-TAB 2: 10X MACRO LENS FIBER INSPECTION -->
      <div x-show="slicingSubTab === 'macro'" x-transition:enter="transition ease-out duration-250">
        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));gap:24px;">
          
          <!-- Card 1: Orinamia Toyobo Fodu Grade A -->
          <div class="atelier-card" style="padding:28px;border:2px solid var(--accent);background:var(--surface);">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
              <span class="badge-pill" style="background:#10B981;color:#FFFFFF;border:none;display:inline-flex;align-items:center;gap:6px;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M6 18h8"/><path d="M3 22h18"/><path d="m14 22-4-4"/><path d="M9 14h2"/><path d="M9 12a2 2 0 0 1-2-2V6h6v4a2 2 0 0 1-2 2Z"/><path d="m12 6 4-4 3 3-4 4"/><path d="m14 18 1.5 1.5"/>
                </svg>
                10x Macro: Toyobo Fodu Grade A
              </span>
              <span class="font-num" style="font-size:0.8rem;font-weight:700;color:var(--accent);">STANDAR ORINAMIA</span>
            </div>

            <!-- Microscopic SVG Fiber Simulation -->
            <div style="width:100%;height:180px;border-radius:10px;background:radial-gradient(circle at center, #231C28 0%, #15131B 100%);border:1px solid var(--border);position:relative;overflow:hidden;margin-bottom:18px;">
              <svg width="100%" height="100%" viewBox="0 0 400 180" fill="none">
                <!-- Dense parallel woven grid -->
                <defs>
                  <pattern id="fodu-grid" width="16" height="16" patternUnits="userSpaceOnUse">
                    <line x1="0" y1="8" x2="16" y2="8" stroke="#AD8EEB" stroke-width="2.5" stroke-linecap="round" opacity="0.8"/>
                    <line x1="8" y1="0" x2="8" y2="16" stroke="#F391EC" stroke-width="2.2" stroke-linecap="round" opacity="0.85"/>
                    <circle cx="8" cy="8" r="2.5" fill="#FFFFFF" opacity="0.6"/>
                  </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#fodu-grid)"/>
                <!-- Macro Lens Overlay Ring -->
                <circle cx="200" cy="90" r="70" stroke="#10B981" stroke-width="2" stroke-dasharray="4 4" fill="none" opacity="0.7"/>
                <text x="200" y="94" text-anchor="middle" fill="#FFFFFF" font-size="11" font-family="'JetBrains Mono', monospace" font-weight="600">DENSITAS TINGGI 133x72</text>
              </svg>
              <div style="position:absolute;bottom:8px;left:12px;font-size:0.65rem;color:#A9A3B5;font-family:'JetBrains Mono',monospace;">
                SERAT COMBED 40s/2 &bull; ZERO FIBER SHEDDING
              </div>
            </div>

            <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:8px;">Katun Murni Serat Panjang Sisir (Combed)</h3>
            <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;margin-bottom:16px;">
              Dipintal dari serat kapas panjang pilihan melalui proses combing (penyisiran) ganda untuk membuang serat pendek. Hasil tenunan menghasilkan permukaan licin, adem di kulit perawat/dokter, dan tidak menghasilkan serbuk debu kain (lint-free) yang berbahaya di ruang operasi.
            </p>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;font-size:0.75rem;">
              <div style="padding:10px;background:var(--surface-tint);border-radius:6px;border:1px solid var(--border);">
                <div style="color:var(--text-muted);">Daya Serap Air:</div>
                <div style="font-weight:700;color:#059669;margin-top:2px;">&lt; 2 Detik (Instan)</div>
              </div>
              <div style="padding:10px;background:var(--surface-tint);border-radius:6px;border:1px solid var(--border);">
                <div style="color:var(--text-muted);">Ketahanan Autoklaf:</div>
                <div style="font-weight:700;color:#059669;margin-top:2px;">Lolos 121°C (0% Susut)</div>
              </div>
              <div style="padding:10px;background:var(--surface-tint);border-radius:6px;border:1px solid var(--border);">
                <div style="color:var(--text-muted);">Ketahanan Pilling:</div>
                <div style="font-weight:700;color:#059669;margin-top:2px;">Skala 4.5 / 5 (Tidak Berbulu)</div>
              </div>
              <div style="padding:10px;background:var(--surface-tint);border-radius:6px;border:1px solid var(--border);">
                <div style="color:var(--text-muted);">Uji Toksisitas:</div>
                <div style="font-weight:700;color:#059669;margin-top:2px;">Bebas Formalin &amp; Logam Berat</div>
              </div>
            </div>
          </div>

          <!-- Card 2: Konveksi Pasaran TC -->
          <div class="atelier-card" style="padding:28px;border:1px solid rgba(239,68,68,0.3);background:var(--surface);">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
              <span class="badge-pill" style="background:rgba(239,68,68,0.12);color:#DC2626;border-color:rgba(239,68,68,0.3);display:inline-flex;align-items:center;gap:6px;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M6 18h8"/><path d="M3 22h18"/><path d="m14 22-4-4"/><path d="M9 14h2"/><path d="M9 12a2 2 0 0 1-2-2V6h6v4a2 2 0 0 1-2 2Z"/><path d="m12 6 4-4 3 3-4 4"/><path d="m14 18 1.5 1.5"/>
                </svg>
                10x Macro: Kain TC Pasaran
              </span>
              <span class="font-num" style="font-size:0.8rem;font-weight:700;color:#DC2626;">PASARAN MASSAL</span>
            </div>

            <!-- Microscopic SVG Fiber Simulation (Fuzzy / Loose) -->
            <div style="width:100%;height:180px;border-radius:10px;background:radial-gradient(circle at center, #2B1D20 0%, #171113 100%);border:1px solid var(--border);position:relative;overflow:hidden;margin-bottom:18px;">
              <svg width="100%" height="100%" viewBox="0 0 400 180" fill="none">
                <defs>
                  <pattern id="pasaran-grid" width="28" height="28" patternUnits="userSpaceOnUse">
                    <line x1="0" y1="14" x2="28" y2="14" stroke="#DC2626" stroke-width="1.4" opacity="0.4"/>
                    <line x1="14" y1="0" x2="14" y2="28" stroke="#DC2626" stroke-width="1.2" opacity="0.35"/>
                    <!-- Fuzzy fibers sticking out -->
                    <path d="M7 7 Q 12 2, 16 9" stroke="#E57373" stroke-width="1" fill="none" opacity="0.6"/>
                    <path d="M20 20 Q 25 15, 23 26" stroke="#E57373" stroke-width="1.2" fill="none" opacity="0.5"/>
                    <circle cx="14" cy="14" r="3" fill="#DC2626" opacity="0.3"/>
                  </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#pasaran-grid)"/>
                <circle cx="200" cy="90" r="70" stroke="#DC2626" stroke-width="2" stroke-dasharray="4 4" fill="none" opacity="0.6"/>
                <text x="200" y="94" text-anchor="middle" fill="#FF8A80" font-size="11" font-family="'JetBrains Mono', monospace" font-weight="600">RENGGANG 80x56 &bull; BULU KAIN</text>
              </svg>
              <div style="position:absolute;bottom:8px;left:12px;font-size:0.65rem;color:#E57373;font-family:'JetBrains Mono',monospace;">
                CAMPURAN SINTETIK 20s &bull; SERAT KASAR
              </div>
            </div>

            <h3 style="font-size:1.15rem;font-weight:700;color:var(--text);margin-bottom:8px;">Kain TC Campuran Poliester Kasar</h3>
            <p style="font-size:0.85rem;color:var(--text-muted);line-height:1.6;margin-bottom:16px;">
              Menggunakan benang carded pendek dengan campuran poliester daur ulang. Serat tidak beraturan mudah terlepas membentuk bulu (pilling balls), menjebak hawa panas tubuh, serta menyusut dan meleleh saat melewati proses sterilisasi autoklaf rumah sakit.
            </p>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;font-size:0.75rem;">
              <div style="padding:10px;background:var(--surface-tint);border-radius:6px;border:1px solid var(--border);">
                <div style="color:var(--text-muted);">Daya Serap Air:</div>
                <div style="font-weight:700;color:#DC2626;margin-top:2px;">&gt; 15 Detik (Gerah/Panas)</div>
              </div>
              <div style="padding:10px;background:var(--surface-tint);border-radius:6px;border:1px solid var(--border);">
                <div style="color:var(--text-muted);">Ketahanan Autoklaf:</div>
                <div style="font-weight:700;color:#DC2626;margin-top:2px;">Mengkerut &amp; Berbau Sangit</div>
              </div>
              <div style="padding:10px;background:var(--surface-tint);border-radius:6px;border:1px solid var(--border);">
                <div style="color:var(--text-muted);">Ketahanan Pilling:</div>
                <div style="font-weight:700;color:#DC2626;margin-top:2px;">Skala 2.0 / 5 (Cepat Berbulu)</div>
              </div>
              <div style="padding:10px;background:var(--surface-tint);border-radius:6px;border:1px solid var(--border);">
                <div style="color:var(--text-muted);">Dampak Klinis:</div>
                <div style="font-weight:700;color:#DC2626;margin-top:2px;">Rontokan Serat Berbahaya di OKA</div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- SUB-TAB 3: ISO 4915 STITCH CLASSIFICATION BLUEPRINT -->
      <div x-show="slicingSubTab === 'iso'" x-transition:enter="transition ease-out duration-250">
        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));gap:20px;">
          
          <!-- ISO 301 -->
          <div class="atelier-card" style="padding:24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
              <span class="badge-pill" style="font-size:0.75rem;">ISO 4915 &bull; CLASS 301</span>
              <span class="font-num" style="font-size:0.75rem;font-weight:700;color:var(--accent);">LOCKSTITCH</span>
            </div>
            
            <div style="width:100%;height:80px;background:var(--surface-tint);border-radius:8px;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
              <svg width="220" height="40" viewBox="0 0 220 40" fill="none">
                <!-- Lockstitch Graphic -->
                <line x1="10" y1="20" x2="210" y2="20" stroke="var(--border)" stroke-width="4"/>
                <g stroke="#6E387A" stroke-width="3" stroke-linecap="round">
                  <line x1="20" y1="20" x2="45" y2="20"/>
                  <line x1="55" y1="20" x2="80" y2="20"/>
                  <line x1="90" y1="20" x2="115" y2="20"/>
                  <line x1="125" y1="20" x2="150" y2="20"/>
                  <line x1="160" y1="20" x2="185" y2="20"/>
                  <line x1="195" y1="20" x2="205" y2="20"/>
                </g>
                <!-- Lock intersections -->
                <circle cx="50" cy="20" r="3.5" fill="#AD8EEB"/>
                <circle cx="85" cy="20" r="3.5" fill="#AD8EEB"/>
                <circle cx="120" cy="20" r="3.5" fill="#AD8EEB"/>
                <circle cx="155" cy="20" r="3.5" fill="#AD8EEB"/>
                <circle cx="190" cy="20" r="3.5" fill="#AD8EEB"/>
              </svg>
            </div>

            <h4 style="font-size:1.05rem;font-weight:700;color:var(--text);margin-bottom:6px;">Jahitan Kunci Sejajar (Lockstitch)</h4>
            <p style="font-size:0.8125rem;color:var(--text-muted);line-height:1.6;margin-bottom:14px;">
              Dibentuk oleh benang jarum atas yang mengait dengan benang sekoci bawah tepat di poros tengah lipatan kain. Standar Orinamia: <strong>12 - 14 SPI</strong>.
            </p>
            <div style="font-size:0.75rem;padding:8px 10px;background:var(--surface-tint);border-radius:6px;color:var(--text);">
              <strong>Implementasi:</strong> Kerah snelli dokter, placket kancing PDH, badan jas almamater.
            </div>
          </div>

          <!-- ISO 401 -->
          <div class="atelier-card" style="padding:24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
              <span class="badge-pill" style="font-size:0.75rem;">ISO 4915 &bull; CLASS 401</span>
              <span class="font-num" style="font-size:0.75rem;font-weight:700;color:var(--accent);">CHAINSTITCH</span>
            </div>

            <div style="width:100%;height:80px;background:var(--surface-tint);border-radius:8px;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
              <svg width="220" height="40" viewBox="0 0 220 40" fill="none">
                <!-- Chainstitch Graphic -->
                <path d="M 20 20 C 30 10, 40 30, 55 20 C 65 10, 75 30, 90 20 C 100 10, 110 30, 125 20 C 135 10, 145 30, 160 20 C 170 10, 180 30, 195 20" stroke="#AD8EEB" stroke-width="3" fill="none" stroke-linecap="round"/>
                <circle cx="55" cy="20" r="3" fill="#6E387A"/>
                <circle cx="90" cy="20" r="3" fill="#6E387A"/>
                <circle cx="125" cy="20" r="3" fill="#6E387A"/>
                <circle cx="160" cy="20" r="3" fill="#6E387A"/>
                <circle cx="195" cy="20" r="3" fill="#6E387A"/>
              </svg>
            </div>

            <h4 style="font-size:1.05rem;font-weight:700;color:var(--text);margin-bottom:6px;">Jahitan Rantai Multi-Benang</h4>
            <p style="font-size:0.8125rem;color:var(--text-muted);line-height:1.6;margin-bottom:14px;">
              Benang bawah membentuk anyaman jeratan rantai yang fleksibel. Memberikan daya lentur maksimal hingga 30% tanpa benang putus saat nakes membungkuk aktif.
            </p>
            <div style="font-size:0.75rem;padding:8px 10px;background:var(--surface-tint);border-radius:6px;color:var(--text);">
              <strong>Implementasi:</strong> Keliman samping baju OKA, selangkangan celana scrub nakes.
            </div>
          </div>

          <!-- ISO 504 -->
          <div class="atelier-card" style="padding:24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
              <span class="badge-pill" style="font-size:0.75rem;">ISO 4915 &bull; CLASS 504</span>
              <span class="font-num" style="font-size:0.75rem;font-weight:700;color:var(--accent);">OVERLOCK</span>
            </div>

            <div style="width:100%;height:80px;background:var(--surface-tint);border-radius:8px;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
              <svg width="220" height="40" viewBox="0 0 220 40" fill="none">
                <!-- Overlock Graphic -->
                <line x1="20" y1="28" x2="200" y2="28" stroke="var(--border)" stroke-width="3"/>
                <path d="M 25 28 L 35 12 L 45 28 L 55 12 L 65 28 L 75 12 L 85 28 L 95 12 L 105 28 L 115 12 L 125 28 L 135 12 L 145 28 L 155 12 L 165 28 L 175 12 L 185 28 L 195 12" stroke="#F391EC" stroke-width="2.5" fill="none"/>
              </svg>
            </div>

            <h4 style="font-size:1.05rem;font-weight:700;color:var(--text);margin-bottom:6px;">Obras Tiga &amp; Empat Benang</h4>
            <p style="font-size:0.8125rem;color:var(--text-muted);line-height:1.6;margin-bottom:14px;">
              Memotong sekaligus merajut tepi kain agar serat benang tidak bertiras atau terburai. Menggunakan pisau pemotong garmen presisi tajam.
            </p>
            <div style="font-size:0.75rem;padding:8px 10px;background:var(--surface-tint);border-radius:6px;color:var(--text);">
              <strong>Implementasi:</strong> Tepian kampuh dalam seluruh kemeja, snelli, dan celana.
            </div>
          </div>

          <!-- Digital Bar-Tack -->
          <div class="atelier-card" style="padding:24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
              <span class="badge-pill" style="font-size:0.75rem;background:#10B981;color:#FFFFFF;border:none;">MESIN KOMPUTER</span>
              <span class="font-num" style="font-size:0.75rem;font-weight:700;color:#059669;">42 BAR-TACK</span>
            </div>

            <div style="width:100%;height:80px;background:var(--surface-tint);border-radius:8px;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
              <svg width="220" height="40" viewBox="0 0 220 40" fill="none">
                <!-- Bar-Tack Graphic -->
                <rect x="50" y="14" width="120" height="12" rx="3" fill="#10B981" opacity="0.2"/>
                <path d="M 52 14 L 56 26 M 60 14 L 64 26 M 68 14 L 72 26 M 76 14 L 80 26 M 84 14 L 88 26 M 92 14 L 96 26 M 100 14 L 104 26 M 108 14 L 112 26 M 116 14 L 120 26 M 124 14 L 128 26 M 132 14 L 136 26 M 140 14 L 144 26 M 148 14 L 152 26 M 156 14 L 160 26 M 164 14 L 168 26" stroke="#059669" stroke-width="2.5" stroke-linecap="round"/>
              </svg>
            </div>

            <h4 style="font-size:1.05rem;font-weight:700;color:var(--text);margin-bottom:6px;">Bar-Tack Pengunci 42 Tusukan</h4>
            <p style="font-size:0.8125rem;color:var(--text-muted);line-height:1.6;margin-bottom:14px;">
              Jahitan kunci silang padat otomatis dengan kerapatan mikro. Menahan beban tarikan hingga 2.5 kg tanpa robek saat saku diisi gawai medis berat.
            </p>
            <div style="font-size:0.75rem;padding:8px 10px;background:var(--surface-tint);border-radius:6px;color:var(--text);">
              <strong>Implementasi:</strong> 4 sudut saku baju OKA, pangkal tali pinggang serut, saku kargo safety.
            </div>
          </div>

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
            <span style="width:20px;height:20px;border-radius:50%;background:rgba(16,185,129,0.12);display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
              </svg>
            </span>
            <span style="font-size:0.875rem;color:var(--text);"><strong>Standar Mutu Jahitan Halus:</strong> Menggunakan benang jahit premium dan mesin garmen modern.</span>
          </div>
          <div style="display:flex;align-items:center;gap:10px;">
            <span style="width:20px;height:20px;border-radius:50%;background:rgba(16,185,129,0.12);display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
              </svg>
            </span>
            <span style="font-size:0.875rem;color:var(--text);"><strong>Kemitraan Multisektoral:</strong> Bekerja sama dengan rumah sakit swasta/pemerintah, BUMN, perhotelan, hingga sekolah.</span>
          </div>
          <div style="display:flex;align-items:center;gap:10px;">
            <span style="width:20px;height:20px;border-radius:50%;background:rgba(16,185,129,0.12);display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
              </svg>
            </span>
            <span style="font-size:0.875rem;color:var(--text);"><strong>Ketepatan Waktu:</strong> Penjadwalan produksi terstruktur dengan pelacakan progres transparan.</span>
          </div>
        </div>
      </div>

      <!-- Atelier Heritage Card -->
      <div class="atelier-card" style="padding:clamp(22px, 3.5vw, 36px);position:relative;background:var(--surface);overflow:hidden;min-width:0;word-break:break-word;">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:12px;flex-wrap:wrap;">
          <div style="font-size:0.75rem;color:var(--accent);font-weight:700;letter-spacing:0.1em;text-transform:uppercase;">Profil Entitas</div>
          <span style="display:inline-flex;align-items:center;gap:6px;font-size:0.72rem;font-weight:700;color:#10B981;background:rgba(16, 185, 129, 0.08);padding:3px 10px;border-radius:999px;border:1px solid rgba(16, 185, 129, 0.2);">
            <span style="width:6px;height:6px;border-radius:50%;background:#10B981;"></span>
            Legalitas Aktif
          </span>
        </div>
        <div style="font-size:1.5rem;font-weight:700;color:var(--text);margin-bottom:4px;line-height:1.25;">PT Cahaya Binar Berlian</div>
        <div style="font-size:0.875rem;color:var(--text-muted);margin-bottom:22px;">Merk Dagang: ORINAMIA Konveksi &amp; Rumah Jahit</div>

        <div style="border-top:1px dashed var(--border);padding-top:18px;display:flex;flex-direction:column;gap:16px;">
          <!-- Grid for Kemenkumham and NIB -->
          <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(180px, 1fr));gap:14px;">
            <div style="background:var(--surface-tint);padding:12px 14px;border-radius:8px;border:1px solid var(--border);">
              <div style="font-size:0.7rem;color:var(--text-muted);font-weight:600;text-transform:uppercase;letter-spacing:0.04em;">SK Kemenkumham RI</div>
              <div class="font-num" style="font-size:0.875rem;font-weight:700;color:var(--accent);margin-top:3px;white-space:normal;word-break:break-word;">
                AHU-0202685.AH.01.30. Tahun 2024
              </div>
            </div>

            <div style="background:var(--surface-tint);padding:12px 14px;border-radius:8px;border:1px solid var(--border);">
              <div style="font-size:0.7rem;color:var(--text-muted);font-weight:600;text-transform:uppercase;letter-spacing:0.04em;">Nomor Induk Berusaha (NIB)</div>
              <div class="font-num" style="font-size:0.95rem;font-weight:700;color:var(--text);margin-top:3px;white-space:normal;word-break:break-word;">
                2104240036065
              </div>
            </div>
          </div>

          <!-- Alamat Workshop -->
          <div>
            <div style="font-size:0.75rem;color:var(--text-muted);font-weight:600;">Alamat Workshop &amp; Operasional</div>
            <div style="font-size:0.875rem;color:var(--text);margin-top:3px;line-height:1.55;word-break:break-word;">
              Jl Cibodas Raya No 10 D Perum 1, Karawaci, Kota Tangerang, Banten
            </div>
          </div>

          <!-- Rekening Resmi Perusahaan Box -->
          <div style="background:var(--surface-tint);border:1px solid var(--border);border-radius:10px;padding:14px 16px;" x-data="{ copied: false }">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:8px;flex-wrap:wrap;">
              <span style="font-size:0.75rem;color:var(--text-muted);font-weight:600;text-transform:uppercase;letter-spacing:0.04em;">Rekening Resmi Perusahaan</span>
              <span style="display:inline-flex;align-items:center;gap:5px;font-size:0.7rem;font-weight:700;color:var(--accent);background:var(--surface);padding:2px 8px;border-radius:999px;border:1px solid var(--border);">
                Atas Nama PT
              </span>
            </div>

            <div style="font-size:0.875rem;font-weight:600;color:var(--text);margin-bottom:6px;">
              Bank Syariah Indonesia (BSI)
            </div>

            <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;background:var(--surface);border:1px solid var(--border);border-radius:8px;padding:8px 12px;margin-bottom:6px;flex-wrap:wrap;">
              <span class="font-num" style="font-size:1.05rem;font-weight:700;letter-spacing:0.04em;color:var(--text);white-space:normal;word-break:break-all;">
                7273909413
              </span>
              <button
                type="button"
                @click="navigator.clipboard.writeText('7273909413'); copied = true; setTimeout(() => copied = false, 2000)"
                style="border:none;background:var(--surface-tint);color:var(--accent);font-size:0.75rem;font-weight:700;padding:4px 10px;border-radius:6px;cursor:pointer;display:inline-flex;align-items:center;gap:5px;transition:all 150ms ease;"
                title="Salin nomor rekening BSI">
                <span x-show="!copied" style="display:inline-flex;align-items:center;gap:4px;">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>
                  </svg>
                  Salin No. Rekening
                </span>
                <span x-show="copied" style="color:#10B981;display:inline-flex;align-items:center;gap:4px;">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                  </svg>
                  Tersalin
                </span>
              </button>
            </div>

            <div style="font-size:0.75rem;color:var(--text-muted);line-height:1.4;">
              Atas Nama: <strong style="color:var(--text);">PT Cahaya Binar Berlian</strong>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- SECTION 2: KOLEKSI & LAYANAN PRODUKSI (HUYML SELECTED WORKS ARCHIVE) -->
  <section id="layanan" style="padding:90px 24px;border-bottom:1px solid var(--border);background:var(--surface-tint);">
    <div id="arsip"></div>
    <div style="max-width:1160px;margin:0 auto;">
      
      <!-- Huyml-Inspired Section Toolbar & Switcher -->
      <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:20px;margin-bottom:32px;">
        <div style="max-width:680px;">
          <div style="display:inline-flex;align-items:center;gap:8px;padding:4px 14px;background:var(--surface);border:1px solid var(--border);border-radius:999px;margin-bottom:12px;">
            <span style="width:7px;height:7px;border-radius:50%;background:#F391EC;"></span>
            <span style="font-size:0.75rem;font-weight:700;letter-spacing:0.08em;color:var(--accent);text-transform:uppercase;">SELECTED WORKS 2015 - 2026 &bull; ATELIER ARCHIVE</span>
          </div>
          <h2 class="font-editorial" style="font-size:clamp(1.9rem, 3.4vw, 2.8rem);font-weight:500;line-height:1.2;color:var(--text);margin-bottom:10px;">
            Arsip Karya &amp; Portofolio Rekayasa Busana Kerja
          </h2>
          <p style="color:var(--text-muted);font-size:0.95rem;line-height:1.65;">
            Dokumentasi teknis spesifikasi pakaian dinas, busana medis OKA, dan pakaian kerja berstandar laboratorium PT Cahaya Binar Berlian. Arahkan kursor pada baris untuk preview melayang atau klik untuk membedah mutu jahitan.
          </p>
        </div>

        <!-- View Mode Switcher: Archive List vs Grid (shadcn segmented control style) -->
        <div style="display:flex;gap:6px;align-items:center;padding:4px;background:var(--surface);border-radius:10px;border:1px solid var(--border);">
          <button type="button" class="cat-tab" :class="{ 'active': catalogView === 'archive' }" @click="catalogView = 'archive'" style="display:inline-flex;align-items:center;gap:6px;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/>
            </svg>
            Arsip Jahitan (Huyml List)
          </button>
          <button type="button" class="cat-tab" :class="{ 'active': catalogView === 'grid' }" @click="catalogView = 'grid'" style="display:inline-flex;align-items:center;gap:6px;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/>
            </svg>
            Grid Visual
          </button>
        </div>
      </div>

      <!-- VIEW 1: HUYML SELECTED WORKS ARCHIVE TABLE -->
      <div x-show="catalogView === 'archive'" x-transition:enter="transition ease-out duration-250">
        
        <!-- Volume Filter Switcher -->
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
          <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <button type="button" class="btn-slicing-preset" :class="{ 'active': archiveVol === 'all' }" @click="archiveVol = 'all'">
              Semua Arsip (06)
            </button>
            <button type="button" class="btn-slicing-preset" :class="{ 'active': archiveVol === 'medis' }" @click="archiveVol = 'medis'">
              Vol. 01: Medis &amp; Rumah Sakit (03)
            </button>
            <button type="button" class="btn-slicing-preset" :class="{ 'active': archiveVol === 'korporat' }" @click="archiveVol = 'korporat'">
              Vol. 02: Korporat, Safety K3 &amp; Apparel (03)
            </button>
          </div>

          <div style="font-size:0.75rem;color:var(--text-muted);">
            Menampilkan: <strong class="font-num" style="color:var(--text);" x-text="filteredArchiveItems.length"></strong> Model Terdaftar
          </div>
        </div>

        <!-- Interactive Huyml Table -->
        <div class="archive-table">
          <div class="archive-header">
            <div>NO.</div>
            <div>MODEL &amp; SPESIFIKASI ATELIER</div>
            <div class="archive-hide-mobile">TEKSTIL &amp; GRAMASI</div>
            <div class="archive-hide-tablet">KONSTRUKSI JAHITAN (ISO 4915)</div>
            <div class="archive-hide-mobile">LEAD TIME</div>
            <div style="text-align:right;">BEDAH MUTU</div>
          </div>

          <template x-for="(item, idx) in filteredArchiveItems" :key="item.code">
            <div class="archive-row"
                 @mouseenter="onArchiveHover(item, $event)"
                 @mousemove="onArchiveMouseMove($event)"
                 @mouseleave="onArchiveLeave()"
                 @click="openDossier(item)">
              
              <!-- Col 1: Zero Padded Code -->
              <div class="font-num" style="font-weight:700;color:var(--accent);font-size:0.85rem;" x-text="item.code"></div>

              <!-- Col 2: Title & Badge -->
              <div style="display:flex;flex-direction:column;gap:4px;padding-right:12px;">
                <div style="font-weight:700;font-size:0.95rem;color:var(--text);line-height:1.3;" x-text="item.title"></div>
                <div style="display:flex;gap:6px;flex-wrap:wrap;align-items:center;">
                  <span class="curated-tag" style="font-size:0.65rem;" x-text="item.categoryBadge"></span>
                  <span style="font-size:0.72rem;color:var(--text-muted);" x-text="item.minOrder + ' MOQ'"></span>
                </div>
              </div>

              <!-- Col 3: Material -->
              <div class="archive-hide-mobile" style="display:flex;flex-direction:column;gap:2px;font-size:0.8rem;">
                <span style="font-weight:600;color:var(--text);" x-text="item.material"></span>
                <span style="font-size:0.72rem;color:var(--text-muted);" x-text="item.weave"></span>
              </div>

              <!-- Col 4: ISO Construction -->
              <div class="archive-hide-tablet" style="display:flex;flex-direction:column;gap:2px;font-size:0.8rem;">
                <span class="font-num" style="font-weight:700;color:var(--accent);" x-text="item.isoStitch + ' (' + item.spi + ')'"></span>
                <span style="font-size:0.72rem;color:#059669;font-weight:600;" x-text="item.reinforcement"></span>
              </div>

              <!-- Col 5: Lead Time -->
              <div class="archive-hide-mobile font-num" style="font-size:0.8rem;color:var(--text-muted);font-weight:600;" x-text="item.leadTime"></div>

              <!-- Col 6: Action -->
              <div style="text-align:right;">
                <span class="archive-arrow" style="display:inline-flex;align-items:center;gap:4px;font-size:0.8rem;font-weight:700;color:var(--accent);transition:transform 180ms ease;">
                  Bedah &rarr;
                </span>
              </div>

            </div>
          </template>
        </div>

        <!-- Micro Instruction Footnote (shadcn alert text style) -->
        <div style="margin-top:14px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;font-size:0.75rem;color:var(--text-muted);">
          <span style="display:inline-flex;align-items:center;gap:6px;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
              <circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/>
            </svg>
            <em>Arahkan kursor pada baris untuk preview kartu melayang, atau klik "Bedah &rarr;" untuk membuka lembar spesifikasi teknis lengkap beserta penawaran WhatsApp.</em>
          </span>
          <span class="font-num">Standar Jahitan ISO 4915</span>
        </div>

      </div>

      <!-- VIEW 2: VISUAL GRID WITH CATEGORY FILTER TABS -->
      <div x-show="catalogView === 'grid'" x-transition:enter="transition ease-out duration-250">
        <!-- Category Filter Tabs (shadcn style tabs) -->
        <div style="display:flex;justify-content:center;gap:8px;flex-wrap:wrap;margin-bottom:36px;">
          <button type="button" class="cat-tab" :class="{ 'active': activeCat === 'medis' }" @click="activeCat = 'medis'" style="display:inline-flex;align-items:center;gap:7px;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6V4a2 2 0 0 0-2-2h-1a.2.2 0 1 0 .3.3"/><path d="M8 15v1a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6v-4"/><circle cx="20" cy="10" r="2"/></svg>
            Seragam Medis &amp; OKA
          </button>
          <button type="button" class="cat-tab" :class="{ 'active': activeCat === 'korporat' }" @click="activeCat = 'korporat'" style="display:inline-flex;align-items:center;gap:7px;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
            Kemeja PDH &amp; Kantor
          </button>
          <button type="button" class="cat-tab" :class="{ 'active': activeCat === 'industri' }" @click="activeCat = 'industri'" style="display:inline-flex;align-items:center;gap:7px;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
            Safety Tambang &amp; PDL
          </button>
          <button type="button" class="cat-tab" :class="{ 'active': activeCat === 'apparel' }" @click="activeCat = 'apparel'" style="display:inline-flex;align-items:center;gap:7px;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"/></svg>
            Jas, Kaos &amp; Komunitas
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
              <div style="width:40px;height:40px;border-radius:10px;background:var(--surface-tint);border:1px solid var(--border);display:inline-flex;align-items:center;justify-content:center;color:var(--accent);margin-bottom:14px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6V4a2 2 0 0 0-2-2h-1a.2.2 0 1 0 .3.3"/><path d="M8 15v1a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6v-4"/><circle cx="20" cy="10" r="2"/>
                </svg>
              </div>
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
                Lead Time: 7 - 10 Hari Kerja
              </div>
            </div>

            <div class="atelier-card curated-card" style="padding:26px;">
              <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:12px;">
                <span class="curated-tag">Ergonomic Cut</span>
                <span class="curated-tag">V-Neck Lis</span>
                <span class="curated-tag">Lengan Pendek / Panjang</span>
              </div>
              <div style="width:40px;height:40px;border-radius:10px;background:var(--surface-tint);border:1px solid var(--border);display:inline-flex;align-items:center;justify-content:center;color:var(--accent);margin-bottom:14px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/><path d="M3.22 12H9.5l.5-1 2 4.5 2-7 1.5 3.5h5.27"/>
                </svg>
              </div>
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
              <div style="width:40px;height:40px;border-radius:10px;background:var(--surface-tint);border:1px solid var(--border);display:inline-flex;align-items:center;justify-content:center;color:var(--accent);margin-bottom:14px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="M9 12h6"/><path d="M12 9v6"/>
                </svg>
              </div>
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
              <div style="width:40px;height:40px;border-radius:10px;background:var(--surface-tint);border:1px solid var(--border);display:inline-flex;align-items:center;justify-content:center;color:var(--accent);margin-bottom:14px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect width="20" height="14" x="2" y="7" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                </svg>
              </div>
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
              <div style="width:40px;height:40px;border-radius:10px;background:var(--surface-tint);border:1px solid var(--border);display:inline-flex;align-items:center;justify-content:center;color:var(--accent);margin-bottom:14px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="2" x2="22" y1="22" y2="22"/><line x1="4" x2="4" y1="10" y2="10"/><line x1="20" x2="20" y1="10" y2="10"/><path d="M12 2 2 7h20L12 2z"/><path d="M8 10v8"/><path d="M12 10v8"/><path d="M16 10v8"/>
                </svg>
              </div>
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
              <div style="width:40px;height:40px;border-radius:10px;background:var(--surface-tint);border:1px solid var(--border);display:inline-flex;align-items:center;justify-content:center;color:var(--accent);margin-bottom:14px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M10 22v-6.57"/><path d="M12 11h.01"/><path d="M12 7h.01"/><path d="M14 15.43V22"/><path d="M15 11h.01"/><path d="M15 7h.01"/><path d="M16 16h.01"/><path d="M18 22v-6.57"/><path d="M18 7h.01"/><path d="M18 11h.01"/><path d="M4 22V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v18Z"/><path d="M9 11h.01"/><path d="M9 7h.01"/>
                </svg>
              </div>
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
              <div style="width:40px;height:40px;border-radius:10px;background:var(--surface-tint);border:1px solid var(--border);display:inline-flex;align-items:center;justify-content:center;color:var(--accent);margin-bottom:14px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>
                </svg>
              </div>
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
              <div style="width:40px;height:40px;border-radius:10px;background:var(--surface-tint);border:1px solid var(--border);display:inline-flex;align-items:center;justify-content:center;color:var(--accent);margin-bottom:14px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/>
                </svg>
              </div>
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
              <div style="width:40px;height:40px;border-radius:10px;background:var(--surface-tint);border:1px solid var(--border);display:inline-flex;align-items:center;justify-content:center;color:var(--accent);margin-bottom:14px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M17 18h1"/><path d="M12 18h1"/><path d="M7 18h1"/>
                </svg>
              </div>
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
              <div style="width:40px;height:40px;border-radius:10px;background:var(--surface-tint);border:1px solid var(--border);display:inline-flex;align-items:center;justify-content:center;color:var(--accent);margin-bottom:14px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/><path d="M22 10v6"/><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/>
                </svg>
              </div>
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
              <div style="width:40px;height:40px;border-radius:10px;background:var(--surface-tint);border:1px solid var(--border);display:inline-flex;align-items:center;justify-content:center;color:var(--accent);margin-bottom:14px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"/>
                </svg>
              </div>
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
              <div style="width:40px;height:40px;border-radius:10px;background:var(--surface-tint);border:1px solid var(--border);display:inline-flex;align-items:center;justify-content:center;color:var(--accent);margin-bottom:14px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="6" cy="6" r="3"/><path d="M8.12 8.12 12 12"/><path d="M20 4 8.12 15.88"/><circle cx="6" cy="18" r="3"/><path d="M14.8 14.8 20 20"/>
                </svg>
              </div>
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
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--accent);">
                  <path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6V4a2 2 0 0 0-2-2h-1a.2.2 0 1 0 .3.3"/><path d="M8 15v1a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6v-4"/><circle cx="20" cy="10" r="2"/>
                </svg>
                <span>Standar Bahan Seragam Medis OKA &amp; Scrub Bedah</span>
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
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--accent);">
                  <rect width="20" height="14" x="2" y="7" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                </svg>
                <span>Standar Bahan Kemeja PDH, Kantor &amp; Jas Almamater</span>
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
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--accent);">
                  <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>
                </svg>
                <span>Standar Safety PDL Tambang &amp; Proyek Lapangan (K3)</span>
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

            <button type="button" class="btn-ghost" style="padding:6px 12px;font-size:0.75rem;border-radius:6px;display:inline-flex;align-items:center;gap:6px;"
                    :style="showEmbroidery ? 'background:var(--accent-light);color:var(--accent);border-color:var(--accent);' : ''"
                    @click="showEmbroidery = !showEmbroidery">
              <span x-show="showEmbroidery" style="display:inline-flex;align-items:center;gap:4px;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                Bordir Aktif
              </span>
              <span x-show="!showEmbroidery">+ Bordir Nama &amp; RS</span>
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
          Operasional: Senin - Sabtu (08.00 - 17.00 WIB)<br>
          Sistem Informasi: SIMORIN (Sistem Informasi Manajemen Orinamia)
        </p>
      </div>

    </div>

    <div style="max-width:1160px;margin:0 auto;border-top:1px solid var(--border);padding-top:20px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;font-size:0.8rem;color:var(--text-muted);">
      <div>&copy; 2015 - {{ date('Y') }} PT CAHAYA BINAR BERLIAN &bull; ORINAMIA Daily Wear &amp; Konveksi. Seluruh hak cipta dilindungi.</div>
      <div style="display:flex;gap:16px;">
        <a href="{{ route('login') }}" style="color:var(--accent);text-decoration:none;font-weight:600;">Login Staf &amp; Owner</a>
      </div>
    </div>
  </footer>

  <!-- [huyml.co] FLOATING CURSOR PREVIEW CARD -->
  <div class="cursor-preview-card"
       :class="{ 'visible': cursorPreview.visible && cursorPreview.item }"
       :style="'left: ' + cursorPreview.x + 'px; top: ' + cursorPreview.y + 'px;'"
       role="tooltip"
       aria-hidden="true"
       x-cloak>
    <template x-if="cursorPreview.item">
      <div>
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
          <span class="font-num" style="font-size:0.7rem;font-weight:700;color:var(--accent);" x-text="'ARCHIVE #' + cursorPreview.item.code"></span>
          <span class="curated-tag" style="font-size:0.65rem;" x-text="cursorPreview.item.categoryBadge"></span>
        </div>
        <div style="font-size:1rem;font-weight:700;color:var(--text);line-height:1.25;margin-bottom:6px;" x-text="cursorPreview.item.title"></div>
        <div style="font-size:0.75rem;color:var(--text-muted);margin-bottom:10px;" x-text="cursorPreview.item.material"></div>

        <div style="border-top:1px dashed var(--border);padding-top:8px;display:flex;flex-direction:column;gap:4px;font-size:0.72rem;">
          <div style="display:flex;justify-content:space-between;">
            <span style="color:var(--text-muted);">Jahitan ISO:</span>
            <span class="font-num" style="font-weight:600;color:var(--text);" x-text="cursorPreview.item.isoStitch"></span>
          </div>
          <div style="display:flex;justify-content:space-between;">
            <span style="color:var(--text-muted);">Kekuatan:</span>
            <span style="font-weight:600;color:#059669;" x-text="cursorPreview.item.strength"></span>
          </div>
          <div style="display:flex;justify-content:space-between;">
            <span style="color:var(--text-muted);">Sterilisasi:</span>
            <span style="font-weight:600;color:var(--accent);" x-text="cursorPreview.item.autoclave"></span>
          </div>
        </div>

        <div style="margin-top:10px;padding-top:6px;border-top:1px solid var(--border-subtle);display:flex;align-items:center;justify-content:space-between;font-size:0.7rem;color:var(--accent);font-weight:700;">
          <span>Buka Bedah Kualitas</span>
          <span>&rarr;</span>
        </div>
      </div>
    </template>
  </div>

  <!-- [huyml.co] CRAFTSMANSHIP DOSSIER SLIDE-OVER DRAWER -->
  <div class="dossier-backdrop"
       x-show="activeDossier !== null"
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition ease-in duration-200"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0"
       @click.self="closeDossier()"
       @keydown.escape.window="closeDossier()"
       style="display:none;"
       x-cloak>
    
    <div class="dossier-panel"
         x-show="activeDossier !== null"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full">

      <template x-if="activeDossier">
        <div style="display:flex;flex-direction:column;gap:24px;">

          <!-- Drawer Sticky Top Bar -->
          <div style="display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid var(--border);padding-bottom:16px;">
            <div style="display:flex;align-items:center;gap:10px;">
              <span class="badge-pill" style="font-size:0.75rem;padding:4px 10px;" x-text="'DOSSIER #' + activeDossier.code"></span>
              <span class="curated-tag" x-text="activeDossier.categoryBadge"></span>
            </div>
            <button type="button" @click="closeDossier()" class="btn-ghost" style="padding:6px 12px;font-size:0.8rem;border-radius:6px;" title="Tutup Dossier (Esc)">
              Tutup &times; [Esc]
            </button>
          </div>

          <!-- Headline & Editorial Intro -->
          <div>
            <div style="font-size:0.75rem;font-weight:700;color:var(--accent);letter-spacing:0.12em;text-transform:uppercase;margin-bottom:6px;">
              LEMBAR BEDAH KUALITAS JAHITAN &bull; PT CAHAYA BINAR BERLIAN
            </div>
            <h3 class="font-editorial" style="font-size:1.85rem;line-height:1.2;font-weight:500;color:var(--text);margin-bottom:10px;" x-text="activeDossier.title"></h3>
            <p style="font-size:0.9rem;color:var(--text-muted);line-height:1.65;" x-text="activeDossier.lead"></p>
          </div>

          <!-- Section 1: Konstruksi Pola & Potongan -->
          <div style="padding:18px 20px;background:var(--surface-tint);border-radius:10px;border:1px solid var(--border);">
            <div style="display:flex;align-items:center;gap:8px;font-size:0.8rem;font-weight:700;color:var(--accent);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:10px;">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m21.3 8.7-5-5a1 1 0 0 0-1.4 0l-12 12a1 1 0 0 0 0 1.4l5 5a1 1 0 0 0 1.4 0l12-12a1 1 0 0 0 0-1.4Z"/><path d="m7.5 10.5 2 2"/><path d="m10.5 7.5 2 2"/><path d="m13.5 4.5 2 2"/><path d="m4.5 13.5 2 2"/>
              </svg>
              <span>Konstruksi Pola &amp; Ergonomi</span>
            </div>
            <p style="font-size:0.85rem;color:var(--text);line-height:1.65;" x-text="activeDossier.patternNotes"></p>
            <div style="margin-top:12px;display:grid;grid-template-columns:1fr 1fr;gap:10px;font-size:0.78rem;">
              <div style="padding:8px 10px;background:var(--surface);border-radius:6px;border:1px solid var(--border);">
                <div style="color:var(--text-muted);">Kampuh (Seam Allowance):</div>
                <div style="font-weight:700;color:var(--text);margin-top:2px;" x-text="activeDossier.seamAllowance"></div>
              </div>
              <div style="padding:8px 10px;background:var(--surface);border-radius:6px;border:1px solid var(--border);">
                <div style="color:var(--text-muted);">Bahan Interlining:</div>
                <div style="font-weight:700;color:var(--text);margin-top:2px;" x-text="activeDossier.interlining"></div>
              </div>
            </div>
          </div>

          <!-- Section 2: Spesifikasi Jahitan ISO 4915 -->
          <div>
            <div style="display:flex;align-items:center;gap:8px;font-size:0.8rem;font-weight:700;color:var(--text);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:12px;">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--accent);">
                <polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/>
              </svg>
              <span>Standar Mesin &amp; Klasifikasi ISO 4915</span>
            </div>
            
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
              <div class="atelier-card" style="padding:14px;">
                <div style="font-size:0.7rem;color:var(--text-muted);font-weight:600;">Kelas Jahitan ISO</div>
                <div class="font-num" style="font-size:0.95rem;font-weight:700;color:var(--accent);margin-top:2px;" x-text="activeDossier.isoStitch"></div>
                <div style="font-size:0.72rem;color:var(--text-muted);margin-top:4px;" x-text="activeDossier.isoDetail"></div>
              </div>

              <div class="atelier-card" style="padding:14px;">
                <div style="font-size:0.7rem;color:var(--text-muted);font-weight:600;">Kerapatan SPI</div>
                <div class="font-num" style="font-size:0.95rem;font-weight:700;color:var(--text);margin-top:2px;" x-text="activeDossier.spi"></div>
                <div style="font-size:0.72rem;color:var(--text-muted);margin-top:4px;">Stitches Per Inch presisi komputer</div>
              </div>

              <div class="atelier-card" style="padding:14px;">
                <div style="font-size:0.7rem;color:var(--text-muted);font-weight:600;">Spesifikasi Benang</div>
                <div style="font-size:0.825rem;font-weight:700;color:var(--text);margin-top:2px;" x-text="activeDossier.thread"></div>
                <div style="font-size:0.72rem;color:var(--text-muted);margin-top:4px;">Tahan tarikan gesek &amp; panas mesin</div>
              </div>

              <div class="atelier-card" style="padding:14px;">
                <div style="font-size:0.7rem;color:var(--text-muted);font-weight:600;">Kunci Titik Beban</div>
                <div style="font-size:0.825rem;font-weight:700;color:#059669;margin-top:2px;" x-text="activeDossier.reinforcement"></div>
                <div style="font-size:0.72rem;color:var(--text-muted);margin-top:4px;">Kunci silang komputer di sudut saku</div>
              </div>
            </div>
          </div>

          <!-- Section 3: Uji Ketahanan & Laboratorium -->
          <div style="padding:18px 20px;background:var(--surface-tint);border-radius:10px;border:1px solid var(--border);">
            <div style="display:flex;align-items:center;gap:8px;font-size:0.8rem;font-weight:700;color:var(--text);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:10px;">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--accent);">
                <path d="M6 18h8"/><path d="M3 22h18"/><path d="m14 22-4-4"/><path d="M9 14h2"/><path d="M9 12a2 2 0 0 1-2-2V6h6v4a2 2 0 0 1-2 2Z"/><path d="m12 6 4-4 3 3-4 4"/><path d="m14 18 1.5 1.5"/>
              </svg>
              <span>Pengujian Tekstil &amp; Rumah Sakit</span>
            </div>
            <div style="display:flex;flex-direction:column;gap:8px;font-size:0.8rem;">
              <div style="display:flex;align-items:flex-start;gap:8px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;margin-top:2px;">
                  <polyline points="20 6 9 17 4 12"/>
                </svg>
                <div>
                  <strong>Uji Suhu Autoklaf:</strong>
                  <span style="color:var(--text-muted);" x-text="activeDossier.autoclave"></span>
                </div>
              </div>
              <div style="display:flex;align-items:flex-start;gap:8px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;margin-top:2px;">
                  <polyline points="20 6 9 17 4 12"/>
                </svg>
                <div>
                  <strong>Ketahanan Beban Saku:</strong>
                  <span style="color:var(--text-muted);" x-text="activeDossier.pocketLoad"></span>
                </div>
              </div>
              <div style="display:flex;align-items:flex-start;gap:8px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;margin-top:2px;">
                  <polyline points="20 6 9 17 4 12"/>
                </svg>
                <div>
                  <strong>Luntur &amp; Klorin:</strong>
                  <span style="color:var(--text-muted);" x-text="activeDossier.colorfastness"></span>
                </div>
              </div>
            </div>
          </div>

          <!-- Section 4: Verified Clients -->
          <div>
            <div style="font-size:0.75rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:8px;">
              INSTANSI &amp; KLIEN PENGGUNA TERVERIFIKASI
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:6px;">
              <template x-for="(client, cIdx) in activeDossier.clients" :key="cIdx">
                <span class="curated-tag" style="padding:5px 10px;font-size:0.75rem;color:var(--text);" x-text="client"></span>
              </template>
            </div>
          </div>

          <!-- Section 5: Order Specs & WhatsApp Quote Generator -->
          <div style="margin-top:auto;padding-top:16px;border-top:1px solid var(--border);display:flex;flex-direction:column;gap:12px;">
            <div style="display:flex;justify-content:space-between;align-items:center;font-size:0.825rem;">
              <span style="color:var(--text-muted);">Lead Time Produksi:</span>
              <strong class="font-num" style="color:var(--text);" x-text="activeDossier.leadTime"></strong>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;font-size:0.825rem;">
              <span style="color:var(--text-muted);">Minimal Pemesanan (MOQ):</span>
              <strong class="font-num" style="color:var(--accent);" x-text="activeDossier.minOrder"></strong>
            </div>

            <a :href="'https://wa.me/6285716107394?text=' + encodeURIComponent('Halo Tim Atelier PT Cahaya Binar Berlian, saya ingin konsultasi penawaran produksi untuk: ' + activeDossier.title + ' (Kain: ' + activeDossier.material + ', Standar: ' + activeDossier.isoStitch + '). Mohon kirimkan surat penawaran resmi.')"
               target="_blank"
               class="btn-brand"
               style="justify-content:center;padding:12px;font-size:0.9rem;">
              <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.174.086.275.072.376-.044.101-.116.433-.506.549-.68.116-.174.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/>
              </svg>
              Minta Surat Penawaran &amp; Sampel Bahan
            </a>
          </div>

        </div>
      </template>

    </div>
  </div>

  <!-- [onepagelove.com] FLOATING ATELIER CONCIERGE CAPSULE -->
  <div class="floating-concierge" role="complementary" aria-label="Concierge Layanan Orinamia">
    <div style="display:flex;align-items:center;gap:10px;">
      <span class="pulse-dot" title="Workshop Tangerang Aktif"></span>
      <div style="line-height:1.2;">
        <div style="font-size:0.75rem;font-weight:700;color:var(--text);">Atelier Karawaci Aktif</div>
        <div style="font-size:0.65rem;color:var(--text-muted);">08.00 - 17.00 WIB</div>
      </div>
    </div>

    <div style="height:20px;width:1px;background:var(--border);"></div>

    <a href="#kalkulator" 
       @click.prevent="document.getElementById('kalkulator')?.scrollIntoView({ behavior: 'smooth', block: 'start' })"
       class="btn-ghost" style="padding:6px 12px;font-size:0.75rem;border-radius:999px;border:none;background:var(--surface-tint);">
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

  <!-- [huyml.co & awwwards] TAILOR'S BASTING SEAM & FLOATING NEEDLE SCROLL TRACKER -->
  <aside class="atelier-seam-rail" aria-label="Indikator Jelujur Jahitan">
    <!-- Soft Tailor's Tape Marks (Pita Meteran Kain) -->
    <div class="seam-tape-marks" aria-hidden="true">
      <span style="top:5%;">10cm</span>
      <span style="top:25%;">30cm</span>
      <span style="top:50%;">60cm</span>
      <span style="top:75%;">90cm</span>
      <span style="top:95%;">120cm</span>
    </div>

    <!-- Dashed Basting Thread Guide -->
    <div class="seam-thread-track" aria-hidden="true">
      <div class="seam-thread-stitched" :style="'height: ' + scrollPercent + '%'"></div>
    </div>

    <!-- The Floating Artisan Tailor's Needle -->
    <div class="floating-seam-needle"
         :style="'top: ' + Math.min(96, Math.max(2, scrollPercent)) + '%; transform: translate(-50%, -50%) rotate(' + (isScrollingDown ? '-18deg' : '14deg') + ');'"
         title="Indikator Kedalaman Pola Jahitan"
         role="status">
      <!-- Realistic Golden/Lavender Needle SVG -->
      <svg width="22" height="34" viewBox="0 0 24 38" fill="none" class="needle-svg" filter="drop-shadow(0 2px 4px rgba(110,56,122,0.3))">
        <!-- Needle Body -->
        <path d="M12 0 L15 12 L14 34 L12 38 L10 34 L9 12 Z" fill="url(#railNeedleGrad)"/>
        <!-- Needle Eye -->
        <ellipse cx="12" cy="7" rx="1.2" ry="3.5" fill="#1E1926"/>
        <!-- Silk Thread Passing Through Eye -->
        <path d="M12 7 C16 4, 20 8, 23 3" stroke="#F391EC" stroke-width="1.5" stroke-linecap="round"/>
        <defs>
          <linearGradient id="railNeedleGrad" x1="9" y1="0" x2="15" y2="38" gradientUnits="userSpaceOnUse">
            <stop stop-color="#FFFFFF"/>
            <stop offset="0.3" stop-color="#E2D4F0"/>
            <stop offset="0.7" stop-color="#9A78B8"/>
            <stop offset="1" stop-color="#552F66"/>
          </linearGradient>
        </defs>
      </svg>

      <!-- Needle Hover / Active Craftsmanship Depth Pill -->
      <div class="needle-depth-badge font-num">
        <span style="color:#F391EC;">12 SPI</span> &bull; <span x-text="Math.round(scrollPercent) + '% Pola'"></span>
      </div>
    </div>
  </aside>

  <!-- Alpine.js Components & Anime.js Interactions -->
  <script>
    function atelierPreloader() {
      return {
        progress: 0,
        finished: false,
        exiting: false,
        clockText: '08:00:00 WIB',
        phases: [
          { min: 0, max: 25, text: '[FASE 01] Membentang Pola Ukur Ergonomis Busana Medis & Industri...' },
          { min: 26, max: 55, text: '[FASE 02] Menyeleksi Serat Katun Toyobo Fodu 210 GSM Grade-A...' },
          { min: 56, max: 82, text: '[FASE 03] Mengkalibrasi Kerapatan 12-14 SPI & Kunci Double Bar-Tack...' },
          { min: 83, max: 100, text: '[FASE 04] Atelier Siap &bull; Membuka Arsip Rekayasa Busana' }
        ],
        get formattedProgress() {
          return String(Math.round(this.progress)).padStart(2, '0');
        },
        get currentPhase() {
          const p = this.phases.find(item => this.progress >= item.min && this.progress <= item.max);
          return p ? p.text : '[ATELIER SIAP] Selamat Datang';
        },
        init() {
          const updateClock = () => {
            const now = new Date();
            const wib = new Date(now.getTime() + (7 * 3600000) + (now.getTimezoneOffset() * 60000));
            const hh = String(wib.getHours()).padStart(2, '0');
            const mm = String(wib.getMinutes()).padStart(2, '0');
            const ss = String(wib.getSeconds()).padStart(2, '0');
            this.clockText = `${hh}:${mm}:${ss} WIB`;
          };
          updateClock();
          const clockInterval = setInterval(updateClock, 1000);

          const startTime = performance.now();
          const duration = 1800;

          const tick = (now) => {
            const elapsed = now - startTime;
            const rawProgress = Math.min(100, (elapsed / duration) * 100);
            
            this.progress = rawProgress < 75 
              ? (rawProgress * 1.05) 
              : 75 + ((rawProgress - 75) * 1);
            
            if (this.progress < 100 && !this.finished) {
              requestAnimationFrame(tick);
            } else {
              this.progress = 100;
              clearInterval(clockInterval);
              setTimeout(() => {
                this.exiting = true;
                setTimeout(() => {
                  this.finished = true;
                }, 850);
              }, 250);
            }
          };
          requestAnimationFrame(tick);
        },
        dismissImmediately() {
          this.progress = 100;
          this.exiting = true;
          setTimeout(() => {
            this.finished = true;
          }, 350);
        }
      };
    }

    function globalLandingTracker() {
      return {
        scrollPercent: 0,
        lastScrollY: 0,
        isScrollingDown: true,
        liveTime: '',
        catalogView: 'archive',
        archiveVol: 'all',
        cursorPreview: {
          visible: false,
          x: 0,
          y: 0,
          item: null
        },
        activeDossier: null,
        archiveItems: [
          {
            code: '01',
            title: 'Baju OKA Kamar Bedah Mayor & ICU',
            category: 'medis',
            volume: '01',
            categoryBadge: 'Medis & OKA',
            material: 'Katun Toyobo Fodu Grade A (210 GSM)',
            weave: 'Plain high-density 133x72 count, mercerized combed cotton 40s/2',
            isoStitch: 'ISO 301 & ISO 401',
            isoDetail: 'Lockstitch 14 SPI + Chainstitch Keliman Lentur',
            spi: '12 - 14 SPI',
            thread: 'Core-Spun Poly 40/2 Panas Autoklaf',
            reinforcement: 'Double Bar-Tack 42 Tusukan Komputer',
            strength: 'Uji Tarik Beban Saku 2.5 kg',
            autoclave: 'Lolos Sterilisasi 121°C Tekanan 1.2 Bar',
            pocketLoad: '2.5 kg (Stetoskop, Tensimeter & Tablet Medis)',
            colorfastness: 'Skala 4.5/5 (Tahan Pencucian Klorin RS)',
            seamAllowance: '1.5 cm Kampuh Balik Tertutup',
            interlining: 'Fusible Interlining Kerah Jerman',
            lead: 'Dirancang spesifik untuk dokter spesialis bedah dan tim perawat kamar operasi. Menggunakan katun Toyobo Fodu Grade A dengan sirkulasi udara mikro dan jahitan berdaya tahan autoklaf tinggi.',
            patternNotes: 'Pola ergonomis raglan/set-in dengan toleransi kelonggaran gerak 6 cm pada lingkar dada. Sambungan kampuh balik tertutup (flat-felled) mencegah gesekan pada kulit saat prosedur bedah berlangsung berjam-jam.',
            clients: ['RS Sari Asih Karawaci', 'RS An-Nisa Tangerang', 'RSIA Bunda Sejati', 'Klinik Pratama Banten'],
            leadTime: '7 - 10 Hari Kerja',
            minOrder: '10 Pcs'
          },
          {
            code: '02',
            title: 'Scrub Medis Ergonomis Nakes & Jaga Malam',
            category: 'medis',
            volume: '01',
            categoryBadge: 'Medis & OKA',
            material: 'Poly-Viscose Cotton Twill (195 GSM)',
            weave: 'Twill 3/1 elastisitas mekanis 4-way comfort tanpa spandeks getas',
            isoStitch: 'ISO 514 Mock Safety',
            isoDetail: 'Obras 4 Benang + Jarum Ganda Samping',
            spi: '12 SPI',
            thread: 'Polyester Filament High-Tenacity',
            reinforcement: 'Bar-Tack Segitiga 28 Tusukan',
            strength: 'Elastisitas Tarik Gerak Aktif',
            autoclave: 'Tahan Cuci Suhu 75°C Cairan Antiseptik',
            pocketLoad: '2.0 kg (Saku Dada + 2 Saku Bawah + Saku Celana)',
            colorfastness: 'Skala 4.5/5 Standar ISO 105-C06',
            seamAllowance: '1.2 cm Jahitan 4 Benang Terpadu',
            interlining: 'Lis Leher V-Neck Anti Melar',
            lead: 'Solusi seragam jaga malam dan poliklinik dengan potongan kontur tubuh modern. Memadukan kemudahan bergerak nakes dengan penataan 5 saku fungsional.',
            patternNotes: 'Celana model jogger/straight dengan pinggang serut elastis ganda dan tali pengencang internal. Dilengkapi ventilasi tersembunyi pada belahan samping atasan.',
            clients: ['RS Hermina Tangerang', 'Puskesmas Cibodas', 'RS Bhakti Asih', 'Klinik Kecantikan Karawaci'],
            leadTime: '7 - 10 Hari Kerja',
            minOrder: '10 Pcs'
          },
          {
            code: '03',
            title: 'Snelli Jas Dokter & Laboratorium Eksekutif',
            category: 'medis',
            volume: '01',
            categoryBadge: 'Jas Medis',
            material: 'American Drill 1919 Super + Puring Asahi',
            weave: 'Diagonal twill 2/1 rapat, serat katun tebal tidak tembus pandang',
            isoStitch: 'ISO 301 & ISO 504',
            isoDetail: 'Lockstitch Kerah Rebah + Obras 5 Benang Bersih',
            spi: '13 SPI',
            thread: 'Spun Polyester Glace Finish',
            reinforcement: 'Jahitan Silang Kancing Bertulang 4 Lubang',
            strength: 'Struktur Kerah Kaku Seumur Pakai',
            autoclave: 'Tahan Setrika Panas & Dry Clean Berulang',
            pocketLoad: '1.8 kg (Saku Dada Snelli & Kantong Lapisan Dalam)',
            colorfastness: 'Putih Medis Tahan Oksidasi Kekuningan',
            seamAllowance: '1.5 cm Jahitan Kamso Rapi Bersih',
            interlining: 'Fusible Canvas Jerman Press Suhu 140°C',
            lead: 'Jas dokter prestisius untuk konsulen, dokter spesialis, dan peneliti laboratorium. Potongan jatuh elegan dengan kerah notch lapel simetris standar IDI.',
            patternNotes: 'Pola tailor jas pria dan wanita terpisah. Kerah dipress dengan mesin fusi pneumatik bertekanan tinggi sehingga tidak akan menggelembung atau melepuh saat disetrika panas.',
            clients: ['Ikatan Dokter Indonesia (IDI) Cabang', 'Residen RSUD Banten', 'Laboratorium Medis Tangerang'],
            leadTime: '10 - 14 Hari Kerja',
            minOrder: '10 Pcs'
          },
          {
            code: '04',
            title: 'Kemeja PDH Eksekutif & Dinas Korporat',
            category: 'korporat',
            volume: '02',
            categoryBadge: 'Korporat & Dinas',
            material: 'Katun Nagata Drill / Tropical (225 GSM)',
            weave: 'Konstruksi tenun padat anti kusut, sirkulasi udara micro-porous',
            isoStitch: 'Twin-Needle ISO 301',
            isoDetail: 'Jahitan Jarum Ganda Rapi Jarak 1/4 Inci',
            spi: '12 - 14 SPI',
            thread: 'Coats Poly 40/2 Tahan Gesekan',
            reinforcement: 'Bar-Tack Sudut Penutup Saku & Manset',
            strength: 'Kuat Tarik Benang >40 N/cm²',
            autoclave: 'Tahan Cuci Mesin Industri 50+ Siklus',
            pocketLoad: '1.5 kg (2 Saku Dada Lipit Bertutup Kancing)',
            colorfastness: 'Skala 4.0/5 Standar Pakaian Dinas',
            seamAllowance: '1.5 cm Kamso Obras 5 Benang',
            interlining: 'Interlining Kerah Kaku & Manset Lengan',
            lead: 'Pakaian Dinas Harian (PDH) resmi untuk kementerian, BUMN, perbankan, dan swasta. Dilengkapi pangkat pundak (epaulette) dan saku lipit berstandar regulasi.',
            patternNotes: 'Pola regular fit dan slim fit dengan keliman bahu jarum ganda simetris. Penempatan bordir komputer Tajima 12 warna pada dada dan lengan dengan resolusi stik rapat tanpa kusut.',
            clients: ['PT DNP Indonesia', 'Bank Syariah Indonesia (BSI) Cabang', 'Dinas Pemkot Tangerang', 'KORPRI Unit'],
            leadTime: '10 - 14 Hari Kerja',
            minOrder: '12 Pcs'
          },
          {
            code: '05',
            title: 'Kemeja Safety K3 Tambang, Migas & Lapangan',
            category: 'industri',
            volume: '02',
            categoryBadge: 'Safety K3 & PDL',
            material: 'Ripstop Heavy Grid 240 GSM + 3M Scotchlite',
            weave: 'Anyaman kotak ripstop 5x5 mm penahan rambatan sobek mekanis',
            isoStitch: 'Triple Chainstitch ISO 401',
            isoDetail: 'Tiga Jalur Rantai Paralel Kekuatan Tarik >600 N',
            spi: '11 - 12 SPI',
            thread: 'Heavy Nylon Thread Bonded No. 30',
            reinforcement: 'Double Bar-Tack 42 Tusukan di Seluruh Titik Beban',
            strength: 'Uji Tarik Sobek >600 Newton (Heavy Duty)',
            autoclave: 'Tahan Suhu Lapangan & Pencucian Industri Berat',
            pocketLoad: '3.0 kg (Saku Kargo Ganda + Slot Pulpen & HT)',
            colorfastness: 'Hi-Vis Fluorescent Tahan Sinar UV Matahari',
            seamAllowance: '1.8 cm Kampuh Pipih Jarum Tiga',
            interlining: 'Reflektor 3M ANSI/ISEA 107-2020 Level 2',
            lead: 'Kemeja kerja lapangan berstandar keselamatan K3 nasional untuk area tambang, migas, dermaga, dan konstruksi. Menggunakan reflector 3M Scotchlite dengan pantulan cahaya tinggi.',
            patternNotes: 'Dilengkapi ventilasi aerasi jaring di bagian punggung (yoke venting) untuk melepaskan hawa panas tubuh. Lengan berkancing penahan gulungan saat beraktivitas lapangan.',
            clients: ['Kontraktor Migas Banten', 'Relawan Kemanusiaan BAZNAS', 'Surveyor Geologi & Tambang'],
            leadTime: '12 - 16 Hari Kerja',
            minOrder: '20 Pcs'
          },
          {
            code: '06',
            title: 'Jas Almamater Kampus & Blazer Komunitas',
            category: 'apparel',
            volume: '02',
            categoryBadge: 'Almamater & Blazer',
            material: 'Valextra High Twist Woolen Feel (280 GSM)',
            weave: 'High-twist yarn woven, jatuh anggun, anti kusut otomatis meregang',
            isoStitch: 'ISO 301 & Blindstitch',
            isoDetail: 'Jahitan Sum Keliman Rahasia Tanpa Benang Luar',
            spi: '12 SPI',
            thread: 'Silk-Poly Thread Match Tone',
            reinforcement: 'Busa Bahu Felting Simetris Kiri Kanan',
            strength: 'Presisi Potongan Siluet Tegap',
            autoclave: 'Khusus Dry Clean & Steam Press',
            pocketLoad: '1.2 kg (Saku Tempel Lambang & Saku Bobok Paspol)',
            colorfastness: 'Warna Tajam Tidak Pudar Terpapar Keringat',
            seamAllowance: '1.5 cm Full Puring Sutra Asahi',
            interlining: 'Kain Keras Dada & Pundak Standar Tailor',
            lead: 'Jas almamater universitas, institut kedinasan, dan blazer pengurus organisasi. Pengerjaan menggunakan busa bahu simetris dan jahitan sum keliman rahasia standar tailor rumah jahit.',
            patternNotes: 'Pola jas berfuring penuh (full lining) dengan saku paspol dalam untuk penyimpanan gawai. Patch lambang kampus dibordir timbul 3D dengan detail emblem tajam.',
            clients: ['Universitas Swasta Jabodetabek', 'Sekolah Tinggi Ilmu Kesehatan', 'Organisasi Kepemudaan Banten'],
            leadTime: '14 - 21 Hari Kerja',
            minOrder: '20 Pcs'
          }
        ],
        get filteredArchiveItems() {
          if (this.archiveVol === 'all') return this.archiveItems;
          if (this.archiveVol === 'medis') return this.archiveItems.filter(i => i.volume === '01');
          if (this.archiveVol === 'korporat') return this.archiveItems.filter(i => i.volume === '02');
          return this.archiveItems;
        },
        onArchiveHover(item, e) {
          this.cursorPreview.item = item;
          this.cursorPreview.visible = true;
          this.cursorPreview.x = e.clientX + 20;
          this.cursorPreview.y = e.clientY + 20;
        },
        onArchiveMouseMove(e) {
          if (!this.cursorPreview.visible) return;
          this.cursorPreview.x = e.clientX + 20;
          this.cursorPreview.y = e.clientY + 20;
        },
        onArchiveLeave() {
          this.cursorPreview.visible = false;
          this.cursorPreview.item = null;
        },
        openDossier(item) {
          this.cursorPreview.visible = false;
          this.activeDossier = item;
        },
        closeDossier() {
          this.activeDossier = null;
        },
        updateClock() {
          const now = new Date();
          const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
          const wib = new Date(utc + (7 * 3600000));
          const hh = String(wib.getHours()).padStart(2, '0');
          const mm = String(wib.getMinutes()).padStart(2, '0');
          const ss = String(wib.getSeconds()).padStart(2, '0');
          this.liveTime = `${hh}:${mm}:${ss} WIB`;
        },
        initTracker() {
          this.updateClock();
          setInterval(() => this.updateClock(), 1000);

          const updateScroll = () => {
            const scrollTop = window.scrollY || document.documentElement.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
            this.scrollPercent = scrollHeight > 0 ? Math.min(100, Math.max(0, (scrollTop / scrollHeight) * 100)) : 0;
            this.isScrollingDown = scrollTop >= this.lastScrollY;
            this.lastScrollY = scrollTop;
          };
          window.addEventListener('scroll', updateScroll, { passive: true });
          updateScroll();
        }
      }
    }

    function interactiveSlicer() {
      return {
        slicingSubTab: 'slicer',
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
