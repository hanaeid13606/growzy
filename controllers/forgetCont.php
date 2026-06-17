<?php
require_once __DIR__ . '/../connection.php';
require_once __DIR__ . '/../helpers/response.php';
require_once __DIR__ . '/../repos/loginRepo.php'; // Reuse dbGetUserByEmail
require_once __DIR__ . '/../repos/forgotRepo.php';
require __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;

function forgotPassword($data) {
    $email = $data['email'] ?? '';

    $user = GetUserByEmail($email);

    if (!$user) {
        return response(404, "User not found");
    }

    $payload = [
        'email' => $user['email'],
        'exp' => time() + 3600 
    ];

    $secretKey = "98b99ad61d5bc1e82dd47f3d522195493fb1a4645e7bf6c76be23b45cdf31f10";
    $token = JWT::encode($payload, $secretKey, "HS256"); // Fixed HS265 to HS256

    $success = ResetToken($email, $token);

    if ($success) {
        return response(200, "Reset token generated", ["token" => $token]);
    } else {
        return response(500, "Failed to save reset token");
    }
}