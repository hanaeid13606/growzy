<?php
require_once __DIR__ . "/../connection.php";


function RegisterUser($name, $email, $hashedPassword, $role, $yearsOfExperience = 0, $field = '') {
    global $pdo;
    
    $pdo->beginTransaction();
    try {
        $insertUser = $pdo->prepare("INSERT INTO user (name, email, password, role, yearsOfExperience, field) VALUES (?, ?, ?, ?, ?, ?)");
        $insertUser->execute([$name, $email, $hashedPassword, $role, $yearsOfExperience, $field]);
        
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