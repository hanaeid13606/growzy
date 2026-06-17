<?php
require_once __DIR__ . "/../connection.php";

function RegisterUser($name, $email, $hashedPassword, $role) {
    global $pdo;
    $insert = $pdo->prepare("INSERT INTO user (name, email, password, role) VALUES (?, ?, ?, ?)");
    return $insert->execute([$name, $email, $hashedPassword, $role]);
}
?>