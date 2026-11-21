<?php
/**
 * health.php — Health-check endpoint for Render / Docker
 * Returns HTTP 200 with a JSON payload.
 */
header('Content-Type: application/json');
http_response_code(200);

echo json_encode([
    'status' => 'ok',
]);
