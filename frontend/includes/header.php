<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <script>
    (function(){
        var s=localStorage.getItem('tanipantau-dark-mode');
        var h=document.documentElement;
        if(s==='true'){h.setAttribute('data-bs-theme','dark')}else{h.setAttribute('data-bs-theme','light')}
        if(s===null){localStorage.setItem('tanipantau-dark-mode','false')}
    })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>TaniPantau - Portal Pertanian</title>
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root { --primary: #16A34A; --primary-dark: #15803D; --primary-light: rgba(22,163,74,0.1); --dark: #1e293b; --body: #64748b; --heading: #0f172a; --border: #e2e8f0; --bg: #f8fafc; --card-bg: #ffffff; --card-border: #e9edf2; --hero-end: #10b981; }
        [data-bs-theme="dark"] { --primary: #22c55e; --primary-dark: #16a34a; --primary-light: rgba(34,197,94,0.15); --dark: #0f172a; --body: #94a3b8; --heading: #f1f5f9; --border: #334155; --bg: #0f172a; --card-bg: #1e293b; --card-border: #334155; --hero-end: #047857; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--body); line-height: 1.6; margin: 0; }
        h1, h2, h3, h4, h5, h6 { color: var(--heading); }
        .text-primary { color: var(--primary) !important; }
        .bg-primary { background-color: var(--primary) !important; }
        .btn-primary { background: var(--primary); border-color: var(--primary); border-radius: 8px; padding: 10px 24px; font-weight: 600; font-size: 0.875rem; transition: all 0.2s; }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(22,163,74,0.25); }
        .btn-outline-primary { color: var(--primary); border-color: var(--primary); border-radius: 8px; font-weight: 600; font-size: 0.875rem; }
        .btn-outline-primary:hover { background: var(--primary); border-color: var(--primary); color: #fff; }
        .btn-outline-danger { border-radius: 8px; font-weight: 600; font-size: 0.875rem; }
        .btn-sm { padding: 6px 16px; font-size: 0.8125rem; }
        .btn-soft { background: var(--primary-light); color: var(--primary); border: none; border-radius: 8px; font-weight: 600; font-size: 0.875rem; padding: 10px 24px; transition: all 0.2s; }
        .btn-soft:hover { background: var(--primary); color: #fff; }
        .form-control, .form-select { border-radius: 8px; border: 1.5px solid #d1d5db; padding: 10px 14px; font-size: 0.875rem; color: #1e293b; background: #fff; transition: all 0.2s; }
        .form-control:focus, .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-light); outline: none; background: #fff; }
        .form-control:hover, .form-select:hover { border-color: #9ca3af; }
        .form-control::placeholder { color: #9ca3af; font-weight: 400; }
        .form-control-sm, .form-select-sm { padding: 8px 12px; font-size: 0.8125rem; border-radius: 6px; }
        .form-select { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; background-size: 12px; padding-right: 36px; appearance: none; }
        [data-bs-theme="dark"] .form-control, [data-bs-theme="dark"] .form-select { background-color: var(--card-bg); border-color: var(--border); color: var(--heading); }
        [data-bs-theme="dark"] .form-control:focus, [data-bs-theme="dark"] .form-select:focus { background-color: var(--card-bg); }
        [data-bs-theme="dark"] .form-control::placeholder { color: var(--body); }
        [data-bs-theme="dark"] .form-select { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2394a3b8' d='M6 8L1 3h10z'/%3E%3C/svg%3E"); }
        .form-label { font-size: 0.75rem; font-weight: 600; color: #475569; margin-bottom: 4px; letter-spacing: 0.02em; }
        [data-bs-theme="dark"] .form-label { color: var(--body); }
        .form-check-input:checked { background-color: var(--primary); border-color: var(--primary); }
        .card { background: var(--card-bg); border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04); transition: all 0.25s; }
        .card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        .badge { font-weight: 500; padding: 4px 12px; border-radius: 6px; font-size: 0.75rem; }
        .badge-sm { padding: 2px 10px; font-size: 0.6875rem; border-radius: 4px; }
        .badge-aman { background: #16a34a; color: #fff; }
        .badge-pantau { background: #d97706; color: #fff; }
        .badge-tindakan { background: #dc2626; color: #fff; }
        .badge-secondary { background: var(--body); color: #fff; }
        .table th { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.04em; color: #94a3b8; font-weight: 600; padding: 14px 12px !important; border-bottom: 1.5px solid var(--border); }
        .table td { font-size: 0.875rem; padding: 14px 12px !important; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        [data-bs-theme="dark"] .table td { border-bottom-color: var(--border); color: var(--body); }
        .table tbody tr:hover { background: #f8fafc; }
        [data-bs-theme="dark"] .table tbody tr:hover { background: rgba(51,65,85,0.2); }
        section { padding: 60px 0; }
        .navbar { padding: 0; height: 64px; background: rgba(255,255,255,0.95) !important; backdrop-filter: blur(12px); border-bottom: 1px solid var(--border); }
        [data-bs-theme="dark"] .navbar { background: rgba(30,41,59,0.95) !important; }
        .navbar-brand { font-weight: 800; font-size: 1.25rem; color: var(--heading) !important; letter-spacing: -0.02em; }
        .navbar-brand i { color: var(--primary); }
        .nav-link { font-weight: 500; font-size: 0.875rem; color: var(--body) !important; padding: 8px 16px !important; border-radius: 6px; transition: all 0.2s; }
        .nav-link:hover { color: var(--primary) !important; background: var(--primary-light); }
        .hero-wrap { background: linear-gradient(135deg, #064e3b 0%, #059669 40%, var(--hero-end) 100%); position: relative; overflow: hidden; padding: 80px 0; }
        .hero-wrap::before { content: ''; position: absolute; inset: 0; background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
        .hero-wrap .container { position: relative; z-index: 1; }
        .hero-icon { width: 72px; height: 72px; background: rgba(255,255,255,0.15); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 24px; backdrop-filter: blur(4px); border: 1px solid rgba(255,255,255,0.1); }
        .stat-box { background: var(--card-bg); border-radius: 12px; padding: 28px 24px; text-align: center; border: 1px solid var(--border); transition: all 0.25s; }
        .stat-box:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgba(0,0,0,0.06); }
        .stat-box .num { font-size: 2rem; font-weight: 800; color: var(--heading); line-height: 1.2; }
        .stat-box .label { font-size: 0.8125rem; color: var(--body); font-weight: 500; margin-top: 4px; }
        .stat-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 1.25rem; }
        .stat-icon.green { background: #dcfce7; color: #16a34a; }
        [data-bs-theme="dark"] .stat-icon.green { background: rgba(22,163,74,0.15); color: #22c55e; }
        .stat-icon.blue { background: #dbeafe; color: #2563eb; }
        [data-bs-theme="dark"] .stat-icon.blue { background: rgba(37,99,235,0.15); }
        .stat-icon.amber { background: #fef3c7; color: #d97706; }
        [data-bs-theme="dark"] .stat-icon.amber { background: rgba(217,119,6,0.15); }
        .stat-icon.red { background: #fee2e2; color: #dc2626; }
        [data-bs-theme="dark"] .stat-icon.red { background: rgba(220,38,38,0.15); }
        .filter-card { background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; padding: 24px; }
        .progress-bar-custom { height: 6px; border-radius: 3px; background: #f1f5f9; overflow: hidden; }
        [data-bs-theme="dark"] .progress-bar-custom { background: var(--border); }
        .progress-bar-custom .fill { height: 100%; border-radius: 3px; transition: width 0.6s ease; }
        .page-link { border: none; padding: 8px 16px; font-size: 0.875rem; font-weight: 500; color: var(--body); border-radius: 8px !important; margin: 0 2px; }
        .page-link:hover { background: var(--primary-light); color: var(--primary); }
        .page-item.active .page-link { background: var(--primary); color: #fff; }
        footer { background: #064e3b; color: rgba(255,255,255,0.7); padding: 32px 0; font-size: 0.8125rem; }
        footer a { transition: color 0.2s ease-in-out; }
        footer a:hover { color: #ffffff !important; }
        [data-bs-theme="dark"] footer { background: #022c22; border-top: 1px solid var(--border); }
        .navbar-toggler { width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; border-radius: 10px; border: 1.5px solid var(--border); background: var(--card-bg); padding: 0; color: var(--heading); transition: all 0.25s; cursor: pointer; }
        .navbar-toggler:hover { background: #f0fdf4; border-color: #86efac; }
        [data-bs-theme="dark"] .navbar-toggler:hover { border-color: #22c55e; }
        .navbar-toggler:focus { box-shadow: 0 0 0 3px rgba(22,163,74,0.15); outline: none; }
        .navbar-toggler[aria-expanded="true"] { background: #f0fdf4; border-color: var(--primary); }
        [data-bs-theme="dark"] .navbar-toggler[aria-expanded="true"] { background: rgba(22,163,74,0.1); }
        .navbar-toggler-icon { display: block; width: 22px; height: 22px; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath fill='%231e293b' d='M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: center; background-size: contain; }
        [data-bs-theme="dark"] .navbar-toggler-icon { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath fill='%2394a3b8' d='M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z'/%3E%3C/svg%3E"); }
        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath fill='%2316a34a' d='M18.36 5.64a1 1 0 0 1 0 1.42L13.41 12l4.95 4.95a1 1 0 1 1-1.42 1.42L12 13.41l-4.95 4.95a1 1 0 1 1-1.42-1.42L10.59 12 5.64 7.05a1 1 0 0 1 1.42-1.42L12 10.59l4.95-4.95a1 1 0 0 1 1.42 0z'/%3E%3C/svg%3E"); }
        @media (max-width: 991.98px) { .navbar { height: 56px; } .navbar .container { padding: 0 16px; } .navbar-collapse { background: var(--card-bg); border-radius: 0 0 16px 16px; box-shadow: 0 16px 40px rgba(0,0,0,0.08); padding: 8px 16px 16px; margin: 0 -16px; } .navbar-nav .ms-lg-2 { margin-left: 0 !important; margin-top: 4px; padding-top: 10px; border-top: 1.5px solid var(--border); } .navbar-nav .btn { width: 100%; text-align: center; padding: 12px !important; font-size: 0.9375rem; border-radius: 10px; } }
        @media (max-width: 768px) { .hero-wrap { padding: 48px 0; } .hero-wrap h1 { font-size: 1.75rem; } .stat-box .num { font-size: 1.5rem; } section { padding: 32px 0; } }
        .fade-in { animation: fadeUp 0.4s ease-out; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
        [data-bs-theme="dark"] .text-dark { color: var(--heading) !important; }
        [data-bs-theme="dark"] .text-muted { color: var(--body) !important; }
        [data-bs-theme="dark"] .bg-light { background-color: var(--bg) !important; }
        .transition-hover { transition: all 0.3s ease; }
        .feature-box { background: var(--card-bg); border: 1px solid var(--card-border); }
        [data-bs-theme="dark"] .feature-box { background: var(--card-bg); border-color: var(--border); }
        .feature-box:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.06); }
        [data-bs-theme="dark"] .feature-box:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.3); }
        .dark-heading { color: var(--heading); }
        .green-dark { color: #14532d; }
        [data-bs-theme="dark"] .green-dark { color: #86efac; }
        .section-bg { background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 50%, #f0fdf4 100%); }
        [data-bs-theme="dark"] .section-bg { background: linear-gradient(135deg, #052e16 0%, #0f172a 50%, #052e16 100%); }
        .accuracy-badge { background: rgba(255,255,255,0.9); color: #16a34a; }
        [data-bs-theme="dark"] .accuracy-badge { background: rgba(22,163,74,0.2); color: #86efac; border: 1px solid rgba(34,197,94,0.2); }
        .accuracy-label { color: #166534; }
        [data-bs-theme="dark"] .accuracy-label { color: #86efac; }
        .inline-primary-bg { background: #dcfce7; }
        [data-bs-theme="dark"] .inline-primary-bg { background: rgba(22,163,74,0.15); }
        .inline-blue-bg { background: #dbeafe; }
        [data-bs-theme="dark"] .inline-blue-bg { background: rgba(37,99,235,0.15); }
        .inline-amber-bg { background: #fef3c7; }
        [data-bs-theme="dark"] .inline-amber-bg { background: rgba(217,119,6,0.15); }
        .inline-pink-bg { background: #fce7f3; }
        [data-bs-theme="dark"] .inline-pink-bg { background: rgba(219,39,119,0.15); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php" style="display:flex;align-items:center;gap:8px;">
            <span class="material-symbols-outlined" style="font-variation-settings:'FILL'1;font-size:28px;color:var(--primary);">eco</span>
            <span style="font-size:1.25rem;font-weight:800;color:var(--heading);letter-spacing:-0.03em;">Tani<span style="display:inline-block;background:var(--primary);color:white;padding:1px 8px;border-radius:4px;margin-left:2px;">Pantau</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-1">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="bi bi-house-fill me-1"></i>Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#statistik"><i class="bi bi-bar-chart-fill me-1"></i>Statistik</a>
                </li>
                <li class="nav-item">
                    <button onclick="toggleDarkMode()" class="nav-link" title="Toggle Dark Mode" style="border:none;background:none;cursor:pointer;">
                        <i class="bi bi-moon-fill" id="darkModeIcon"></i>
                    </button>
                </li>
                <li class="nav-item ms-lg-2">
                    <a class="btn btn-primary btn-sm" href="<?= BACKEND_URL ?>/login">
                        <i class="bi bi-shield-lock me-1"></i> Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>