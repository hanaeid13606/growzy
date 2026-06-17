<?php
require_once __DIR__ . "/../connection.php";

function ResetToken($email, $token){
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO password_resets (email, token) VALUES (?, ?)");
    return $stmt->execute([$email, $token]);
}
?>