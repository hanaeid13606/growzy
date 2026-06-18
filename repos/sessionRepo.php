<?php

require_once __DIR__ . "/../connection.php";

function GetAvailableSessions()
{
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT *
        FROM consultancysession
        WHERE status = 'available'
        AND is_deleted = 0"
    );
    $stmt->execute();
    return $stmt->fetchAll(
        PDO::FETCH_ASSOC
    );
}

function GetSessionByID(
    $sessID,
    $userID
)
{
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT *
        FROM consultancysession
        WHERE sessID = ?
        AND userID = ?
        AND is_deleted = 0"
    );
    $stmt->execute([
        $sessID,
        $userID
    ]);

    return $stmt->fetch(
        PDO::FETCH_ASSOC
    );
}

function GetSessionBySessID(
    $sessID
)
{
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT *
        FROM consultancysession
        WHERE sessID = ?
        AND is_deleted = 0"
    );
    $stmt->execute([
        $sessID
    ]);

    return $stmt->fetch(
        PDO::FETCH_ASSOC
    );
}

function BookConsultancySession(
    $sessID,
    $userID
)
{
    global $pdo;
    $stmt = $pdo->prepare(
        "UPDATE consultancysession
        SET
        userID = ?,
        status = 'ongoing'
        WHERE sessID = ?
        AND status = 'available'
        AND is_deleted = 0"
    );
    return $stmt->execute([
        $userID,
        $sessID
    ]);
}

function UpdateSessionDateTime(
    $sessID,
    $dateTime,
    $userID
)
{
    global $pdo;
    $stmt = $pdo->prepare(
        "UPDATE consultancysession
        SET dateTime = ?
        WHERE sessID = ?
        AND userID = ?
        AND is_deleted = 0"
    );
    return $stmt->execute([
        $dateTime,
        $sessID,
        $userID
    ]);
}

function CancelSession(
    $sessID,
    $userID
)
{
    global $pdo;
    $stmt = $pdo->prepare(
        "UPDATE consultancysession
        SET
        status = 'Cancelled',
        is_deleted = 1
        WHERE sessID = ?
        AND userID = ?"
    );
    return $stmt->execute([
        $sessID,
        $userID
    ]);
}
