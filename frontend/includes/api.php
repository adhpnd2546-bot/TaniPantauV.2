<?php

if (isset($_SERVER['HTTP_HOST']) && (
    strpos($_SERVER['HTTP_HOST'], 'localhost') !== false ||
    strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false
)) {
    define('API_BASE_URL', 'http://127.0.0.1:8000/api');
    define('BACKEND_URL', 'http://127.0.0.1:8000');
} else {
    define('API_BASE_URL', 'https://adminpantautani.rf.gd/api');
    define('BACKEND_URL', 'https://adminpantautani.rf.gd');
}

function apiGet(string $endpoint): array
{
    $url = API_BASE_URL . $endpoint;
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 15,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTPHEADER => ['Accept: application/json'],
        CURLOPT_SSL_VERIFYPEER => false,
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200 || !$response) {
        return [];
    }

    return json_decode($response, true) ?? [];
}

function apiPost(string $endpoint, array $data = []): array
{
    $url = API_BASE_URL . $endpoint;
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 15,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            'Accept: application/json',
            'Content-Type: application/json',
        ],
        CURLOPT_SSL_VERIFYPEER => false,
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200 && $httpCode !== 201) {
        return ['error' => 'Request failed'];
    }

    return json_decode($response, true) ?? [];
}

function apiPut(string $endpoint, array $data = []): array { return ['error' => 'Not implemented']; }
function apiDelete(string $endpoint): array { return ['error' => 'Not implemented']; }
function apiPostMultipart(string $endpoint, array $data = [], $fileField = null, $filePath = null): array { return ['error' => 'Not implemented']; }


