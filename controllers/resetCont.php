<?php
require_once __DIR__ . '/../connection.php';
require_once __DIR__ . '/../helpers/response.php';
require_once __DIR__ . '/../repos/resetRepo.php';
require __DIR__ . '/../vendor/autoload.php';

function resetPassword($data) {
    global $pdo; 

    $token = $data['token'] ?? '';
    $password = $data['password'] ?? '';

    $newPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("SELECT email FROM password_resets WHERE token = ?");
    $stmt->execute([$token]);
    $resetRequest = $stmt->fetch();

    if (!$resetRequest) {
        return response(400, "Invalid or expired token");
    }

    $updateSuccess = UpdatePassword($resetRequest['email'], $newPassword);

    DeleteResetToken($token);

    if ($updateSuccess) {
        return response(200, "Password updated successfully");
    } else {
        return response(500, "Failed to update password");
    }
}