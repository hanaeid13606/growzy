<?php
function response($code, $message, $data = null) {
    http_response_code($code);
    header('Content-Type: application/json');
    
    $payload = [];
    if (is_array($message)) {
        $payload = $message;
    } else {
        $payload['message'] = $message;
    }
    
    if ($data !== null) {
        $payload['data'] = $data;
    }
    
    echo json_encode($payload);
    exit;
}
?>