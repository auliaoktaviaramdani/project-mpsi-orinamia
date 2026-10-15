<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk - Orinamia Daily Wear</title>
  <meta name="description" content="Masuk ke sistem manajemen Orinamia Daily Wear">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&family=Newsreader:opsz,wght@6..72,500;6..72,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: #FAF9FC;
      color: #2D2B33;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 24px;
    }
    .font-editorial { font-family: 'Newsreader', Georgia, serif; }
    .font-num { font-family: 'JetBrains Mono', monospace; font-variant-numeric: tabular-nums; }

    .ribbon {
      position: fixed; top: 0; left: 0; right: 0; height: 3px;
      background: linear-gradient(to right, #F391EC, #AD8EEB, #6E387A);
      z-index: 10;
    }
    .card {
      width: 100%; max-width: 400px;
      background: #fff;
      border: 1px solid #E4DFEC;
      border-radius: 12px;
      padding: 40px 36px;
      box-shadow: 0 4px 24px rgba(110, 56, 122, 0.08), 0 1px 4px rgba(0,0,0,0.04);
    }
    .logo-wrap {
      display: flex; flex-direction: column; align-items: center;
      gap: 8px; margin-bottom: 32px;
    }
    .brand-text {
      font-size: 1.375rem; font-weight: 700; letter-spacing: 0.14em;
    }
    .brand-text span:first-child { color: #E074D8; }
    .brand-text span:last-child  { color: #9B78E6; }
    .brand-sub {
      font-size: 0.625rem; letter-spacing: 0.35em; color: #635D73;
      font-weight: 700; text-transform: uppercase;
    }
    .form-label {
      display: block; font-size: 0.75rem; font-weight: 700;
      color: #635D73; margin-bottom: 5px; letter-spacing: 0.03em;
    }
    .form-input {
      width: 100%; min-height: 44px; padding: 10px 14px;
      border: 1px solid #E4DFEC; border-radius: 6px;
      background: #FAF9FC; color: #2D2B33;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 0.9rem; transition: border-color 150ms;
    }
    .form-input:focus {
      outline: none; border-color: #6E387A;
      box-shadow: 0 0 0 3px rgba(110, 56, 122, 0.15);
    }
    .form-group { margin-bottom: 18px; }
    .btn-login {
      width: 100%; min-height: 46px; padding: 10px;
      border-radius: 6px; border: none; cursor: pointer;
      background: #6E387A; color: #fff;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 0.9rem; font-weight: 700;
      letter-spacing: 0.02em;
      transition: background 150ms;
    }
    .btn-login:hover { background: #582B62; }
    .btn-login:focus-visible {
      outline: 2px solid #6E387A; outline-offset: 2px;
    }
    .error-msg {
      background: #FEE2E2; border: 1px solid #FCA5A5;
      border-radius: 6px; padding: 10px 14px;
      font-size: 0.8125rem; color: #7F1D1D;
      margin-bottom: 18px;
    }
    .hint {
      margin-top: 20px; text-align: center;
      font-size: 0.75rem; color: #635D73;
    }
    .hint .font-num { font-size: 0.8rem; }
    *:focus-visible {
      outline: 2px solid #6E387A !important;
      outline-offset: 2px !important;
    }
  </style>
</head>
<body>
  <div class="ribbon" aria-hidden="true"></div>

  <div class="card">
    <div class="logo-wrap">
      <svg width="52" height="52" viewBox="0 0 100 100" fill="none" role="img" aria-label="Logo Orinamia">
        <circle cx="50" cy="50" r="42" stroke="#454547" stroke-width="6.5"/>
        <path d="M50 7 L80 35 L70 50 L58 37 L50 27 L35 42 L41 52 L27 50 L20 35 Z" fill="#F391EC"/>
        <path d="M50 93 L20 65 L30 50 L42 63 L50 73 L65 58 L59 48 L73 50 L80 65 Z" fill="#AD8EEB"/>
        <polygon points="50,43 56,50 50,57 44,50" fill="#AD8EEB"/>
      </svg>
      <div class="brand-text"><span>ORI</span><span>NAMIA</span></div>
      <div class="brand-sub">Daily Wear</div>
      <h1 class="font-editorial" style="font-size:1.25rem;font-weight:600;color:#2D2B33;margin-top:6px;">
        Masuk ke Sistem
      </h1>
    </div>

    @if($errors->any())
    <div class="error-msg" role="alert">
      @foreach($errors->all() as $err)
        <p>{{ $err }}</p>
      @endforeach
    </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST" autocomplete="on">
      @csrf
      <div class="form-group">
        <label for="username" class="form-label">Username</label>
        <input
          type="text"
          id="username"
          name="username"
          class="form-input"
          value="{{ old('username') }}"
          autocomplete="username"
          required
          autofocus
          placeholder="Masukkan username Anda"
        >
      </div>

      <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          class="form-input"
          autocomplete="current-password"
          required
          placeholder="Masukkan password Anda"
        >
      </div>

      <div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;">
        <input type="checkbox" id="remember" name="remember" style="accent-color:#6E387A;width:16px;height:16px;cursor:pointer;">
        <label for="remember" style="font-size:0.8125rem;color:#635D73;cursor:pointer;">Ingat saya</label>
      </div>

      <button type="submit" class="btn-login" id="btn-login">
        Masuk
      </button>
    </form>

    <div class="hint">
      <p>Akun demo: <span class="font-num">admin</span> / <span class="font-num">password</span></p>
      <p style="margin-top:4px;">atau <span class="font-num">owner</span> / <span class="font-num">password</span></p>
    </div>
  </div>
</body>
</html>
