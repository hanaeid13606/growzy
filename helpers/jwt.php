<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function GenerateToken($user) {
    $payload = [
        "iat" => time(),
        "exp" => time() + 3600,
        "user_id" => $user['userID'], 
        "role" => $user['role']
    ];

    return JWT::encode($payload, "98b99ad61d5bc1e82dd47f3d522195493fb1a4645e7bf6c76be23b45cdf31f10", "HS256");
}

function VerifyToken() {
    $headers = getallheaders();
    $token = $headers['Authorization'] ?? $headers['authorization'] ?? $headers['Authentication'] ?? '';

    if (!$token) {
        $token = $_SERVER['HTTP_AUTHORIZATION'] ?? $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] ?? '';
    }

    if (!$token) {
        response(401, "Token is required");
        exit;
    }

    $token = str_replace("Bearer ", "", $token);

    try {
        $decoded = JWT::decode($token, new Key("98b99ad61d5bc1e82dd47f3d522195493fb1a4645e7bf6c76be23b45cdf31f10", "HS256"));
        return $decoded; 
    } catch (Exception $e) {
        response(401, "Invalid token");
        exit;
    }
}

function require_admin($verifiedToken) {
    if ($verifiedToken->role !== "admin") {
        response(403, "Access denied: admin only");
        exit;
    }
}

function require_user($verifiedToken) {
    if ($verifiedToken->role === "admin") {
        response(403, "Access denied: users only");
        exit;
    }
}
?>