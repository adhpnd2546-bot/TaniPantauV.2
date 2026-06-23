<?php

require_once 'includes/config.php';
require_once 'includes/api.php';

if (isLoggedIn()) {
    $role = getUserRole();
    if ($role === 'manajer') { header('Location: index.php'); exit; }
    header('Location: ' . BACKEND_URL . '/login'); exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $result = apiPost('/auth/login', ['email' => $email, 'password' => $password]);
    if (isset($result['user'])) {
        loginUser($result['user'], $result['token'] ?? '');
        $role = $result['user']['role'];
        if ($role === 'manajer') header('Location: index.php');
        elseif ($role === 'admin') header('Location: ' . BACKEND_URL . '/admin/dashboard');
        elseif ($role === 'petugas') header('Location: ' . BACKEND_URL . '/petugas/kunjungan');
        else header('Location: ' . BACKEND_URL . '/login');
        exit;
    } else {
        $error = $result['message'] ?? $result['error'] ?? 'Email atau password salah';
    }
}
?>
<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <script>
    (function(){
        var s=localStorage.getItem('tanipantau-dark-mode');
        var h=document.documentElement;
        if(s==='true'||(!s&&window.matchMedia('(prefers-color-scheme:dark)').matches)){
            h.setAttribute('data-bs-theme','dark');
        } else {
            h.setAttribute('data-bs-theme','light');
        }
    })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TaniPantau</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #16A34A; --primary-dark: #15803D; }
        [data-bs-theme="dark"] { --primary: #22c55e; --primary-dark: #16a34a; }
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #064e3b, #059669, #10b981); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px; }
        [data-bs-theme="dark"] body { background: linear-gradient(135deg, #020d08, #0a2e1a, #0d4f2a); }
        .login-card { background: white; border-radius: 16px; padding: 40px; box-shadow: 0 24px 48px rgba(0,0,0,0.2); max-width: 400px; width: 100%; }
        [data-bs-theme="dark"] .login-card { background: #1e293b; }
        .login-card h1 { font-weight: 800; color: #0f172a; font-size: 1.5rem; }
        [data-bs-theme="dark"] .login-card h1 { color: #f1f5f9; }
        .form-control { border-radius: 8px; border: 1.5px solid #e2e8f0; padding: 12px 14px; font-size: 0.875rem; transition: all 0.2s; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(22,163,74,0.12); }
        [data-bs-theme="dark"] .form-control { background: #0f172a; border-color: #334155; color: #f1f5f9; }
        [data-bs-theme="dark"] .form-control:focus { background: #0f172a; }
        .btn-primary { background: var(--primary); border: none; border-radius: 8px; padding: 12px; font-weight: 600; font-size: 0.875rem; transition: all 0.2s; }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(22,163,74,0.3); }
        .btn-outline-primary { color: var(--primary); border: 1.5px solid var(--primary); border-radius: 6px; font-weight: 500; font-size: 0.8125rem; padding: 4px 14px; transition: all 0.2s; }
        .btn-outline-primary:hover { background: var(--primary); border-color: var(--primary); color: #fff; }
        .login-icon { width: 56px; height: 56px; background: #dcfce7; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; }
        [data-bs-theme="dark"] .login-icon { background: rgba(34,197,94,0.15); }
        .login-icon i { font-size: 1.5rem; color: var(--primary); }
        [data-bs-theme="dark"] .text-muted { color: #94a3b8 !important; }
        [data-bs-theme="dark"] .btn-outline-secondary { color: #94a3b8; border-color: #334155; }
        [data-bs-theme="dark"] .btn-outline-secondary:hover { background: #334155; color: #f1f5f9; }
    </style>
</head>
<body>
    <div style="position:fixed;top:16px;right:16px;z-index:100;">
        <button onclick="toggleFrontendDarkMode()" class="btn btn-sm" style="background:rgba(255,255,255,0.2);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,0.3);border-radius:50%;width:40px;height:40px;display:flex;align-items:center;justify-content:center;color:white;cursor:pointer;">
            <i class="bi bi-moon-fill" id="darkModeIcon"></i>
        </button>
    </div>
    <div class="login-card">
        <div class="text-center mb-4">
            <div class="login-icon"><span class="material-symbols-outlined" style="font-variation-settings:'FILL'1;font-size:36px;color:#16A34A;">eco</span></div>
            <h1 style="font-weight:800;letter-spacing:-0.03em;">Tani<span style="display:inline-block;background:#16A34A;color:white;padding:2px 10px;border-radius:5px;margin-left:3px;">Pantau</span></h1>
            <p class="text-muted" style="font-size:0.875rem;">Masuk ke panel manajemen</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger d-flex align-items-center gap-2 py-2 px-3" style="border:none;border-radius:8px;font-size:0.8125rem;">
                <i class="bi bi-exclamation-circle-fill"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label fw-semibold" style="font-size:0.8125rem;">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" style="font-size:0.8125rem;">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" required>
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                        <i id="eyeIcon" class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Masuk</button>
        </form>

        </div>
    </div>
    <script>
        function togglePassword() {
            const p = document.getElementById('password');
            const e = document.getElementById('eyeIcon');
            if (p.type === 'password') { p.type = 'text'; e.classList.replace('bi-eye', 'bi-eye-slash'); }
            else { p.type = 'password'; e.classList.replace('bi-eye-slash', 'bi-eye'); }
        }
        function loginAs(e,p) { document.querySelector('[name="email"]').value=e; document.querySelector('[name="password"]').value=p; document.querySelector('form').submit(); }
        function toggleFrontendDarkMode() {
            var h = document.documentElement;
            var theme = h.getAttribute('data-bs-theme');
            var newTheme = theme === 'dark' ? 'light' : 'dark';
            h.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('tanipantau-dark-mode', newTheme === 'dark');
            var icon = document.getElementById('darkModeIcon');
            if (icon) icon.className = newTheme === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-fill';
        }
        (function(){
            var s = localStorage.getItem('tanipantau-dark-mode');
            var icon = document.getElementById('darkModeIcon');
            if (s === 'true' && icon) icon.className = 'bi bi-sun-fill';
        })();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
