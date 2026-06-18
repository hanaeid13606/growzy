<?php
require_once __DIR__ . "/../connection.php";

function RegisterUser($name, $email, $hashedPassword, $role) {
    global $pdo;
    
    $pdo->beginTransaction();
    try {
        $insertUser = $pdo->prepare("INSERT INTO user (name, email, password, role) VALUES (?, ?, ?, ?)");
        $insertUser->execute([$name, $email, $hashedPassword, $role]);
        
        if ($role === 'admin') {
            $insertAdmin = $pdo->prepare("INSERT INTO admin (name, email, password) VALUES (?, ?, ?)");
            $insertAdmin->execute([$name, $email, $hashedPassword]);
        }
        
        $pdo->commit();
        return true;
    } catch (Exception $e) {
        $pdo->rollBack();
        return false;
    }
}
?>