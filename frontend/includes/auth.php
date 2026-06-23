<?php

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getUserRole() {
    return $_SESSION['user_role'] ?? null;
}

function getUserName() {
    return $_SESSION['user_name'] ?? 'User';
}

function getApiToken() {
    return $_SESSION['api_token'] ?? '';
}

function loginUser($user, $token = '') {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_role'] = $user['role'];
    $_SESSION['api_token'] = $token;
}

function logoutUser() {
    // Attempt to invalidate API token
    $token = getApiToken();
    if ($token) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, API_BASE_URL . '/auth/logout');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Authorization: Bearer ' . $token
        ]);
        curl_exec($ch);
        curl_close($ch);
    }
    session_destroy();
    header('Location: login.php');
    exit;
}
