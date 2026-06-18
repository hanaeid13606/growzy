<?php

require_once __DIR__ . "/../connection.php";



function createIdea($data) {
    global $pdo;
    $stmt=$pdo->prepare("INSERT INTO idea
        (title,description,attachment,investmentRange,catID,userID)
        VALUES (?,?,?,?,?,?)
    ");

    return $stmt->execute([
        $data["title"],
        $data["description"],
        $data["attachment"],
        $data["investmentRange"],
        $data["catID"],
        $data["userID"]
    ]);
}


function getIdeaById($id) {
    
    global $pdo;

    $stmt =$pdo->prepare( "SELECT * FROM idea WHERE ideaID=?");

    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getAllIdeas()
{
    global $pdo;

    $stmt = $pdo->query("SELECT * FROM idea");

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getIdeasByPrice() {
        global $pdo;

    $stmt=$pdo->query(
        "SELECT * FROM idea ORDER BY investmentRange ASC"
    );

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function deleteIdearepo($id) {
        global $pdo;

    $stmt =$pdo->prepare(
        "DELETE FROM idea WHERE ideaID=?"
    );

    $stmt->execute([$id]);

    return $stmt->rowCount();
}

function updateIdeaRepo($data)
{
    global $pdo;

    $stmt = $pdo->prepare("
        UPDATE idea
        SET title=?, description=?, investmentRange=?, attachment=?
        WHERE ideaID=?
    ");

    $stmt->execute([
        $data["title"],
        $data["description"],
        $data["investmentRange"],
        $data["attachment"],
        $data["id"]
    ]);

    return $stmt->rowCount();
}
