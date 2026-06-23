<?php
define('API_BASE_URL', ($_ENV['API_URL'] ?? getenv('API_URL')) ?: 'http://127.0.0.1:8000/api');
define('BACKEND_URL', ($_ENV['BACKEND_URL'] ?? getenv('BACKEND_URL')) ?: 'http://127.0.0.1:8000');
