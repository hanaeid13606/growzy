<?php

require_once __DIR__ . "/../dp.php";



function createIdea($data) {
    global $conn;
    $stmt=$conn->prepare("INSERT INTO idea
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


function getIdeaById( $id) {
        global $conn;

    $stmt =$conn->prepare(
        "SELECT * FROM idea WHERE ideaID=?"
    );

    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function getIdeasSortedByPrice($conn) {
        global $conn;

    $stmt=$conn->query(
        "SELECT * FROM idea ORDER BY investmentRange ASC"
    );

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function deleteIdearepo($id) {
        global $conn;

    $stmt =$conn->prepare(
        "DELETE FROM idea WHERE ideaID=?"
    );

    $stmt->execute([$id]);

    return $stmt->rowCount();
}

function updateIdeaRepo($data)
{
    global $conn;

    $stmt = $conn->prepare("
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
