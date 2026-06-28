<?php
require_once 'includes/api.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$endpoint = $_GET['endpoint'] ?? '';
if (!$endpoint) {
    http_response_code(400);
    echo json_encode(['error' => 'Parameter endpoint diperlukan']);
    exit;
}

$result = apiGet($endpoint);
echo json_encode($result);
