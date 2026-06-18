<?php
require_once __DIR__ . "/../connection.php";

function GetUserByIDRepo($userID) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT userID, name, email, role, yearsOfExperience, field FROM user WHERE userID = ?");
    $stmt->execute([$userID]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function UpdateUserRepo($userID, $name, $email, $yearsOfExperience, $field) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE user SET name = ?, email = ?, yearsOfExperience = ?, field = ? WHERE userID = ?");
    return $stmt->execute([$name, $email, $yearsOfExperience, $field, $userID]);
}
?>
