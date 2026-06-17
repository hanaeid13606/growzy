<?php
require_once __DIR__ . "/../connection.php";

function UpdatePassword($email, $newPassword) {
    global $pdo;
    $update = $pdo->prepare("UPDATE user SET password = ? WHERE email = ?");
    return $update->execute([$newPassword, $email]);
}

function DeleteResetToken($token) {
    global $pdo;
    $del = $pdo->prepare("DELETE FROM password_resets WHERE token = ?");
    return $del->execute([$token]);
}
?>