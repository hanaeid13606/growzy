<?php

function CreateRequest(
    
    $pdo,
    $description,
    $documentation,
    $type,
    $status,
    $userID,
    $ideaID,
    $adminID = null,     
    $is_deleted = 0,     
    $deleted_at = null
)
{
    $query = "
    INSERT INTO request
    (description, documentation, type, status, userID, ideaID, adminID, is_deleted, deleted_at)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = $pdo->prepare($query);
    return $stmt->execute([
        $description,
        $documentation,
        $type,
        $status,
        $userID,
        $ideaID,
        $adminID,
        $is_deleted,
        $deleted_at
    ]);
}

// GET all requests

function GetAllRequestsRepo($pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM request");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// GET by ideaId
function GetRequestsByIdeaRepo($pdo, $ideaID)
{
    $stmt = $pdo->prepare("
        SELECT * FROM request 
        WHERE ideaID = ? AND is_deleted = 0
    ");

    $stmt->execute([$ideaID]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// GET request by ID

function GetRequestByIdRepo($pdo, $id)
{
    $stmt = $pdo->prepare("SELECT * FROM request WHERE requestID = ?");
    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// DELETE
function SoftDeleteRequestRepo($pdo, $id)
{
    $stmt = $pdo->prepare("
        UPDATE request 
        SET is_deleted = 1 
        WHERE reqID = ?
    ");

    return $stmt->execute([$id]);
}