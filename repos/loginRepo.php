<?php
require_once __DIR__ . "/../connection.php";

function GetUserByEmail($email) {
    global $pdo;
    $select = $pdo->prepare("SELECT * FROM user WHERE email = ?");
    $select->execute([$email]);
    return $select->fetch(PDO::FETCH_ASSOC);
}
?>