<?php
require_once "../connection.php";

function getAllIdeasRepo($pdo, $category = null, $min_investment = null) {
    $sql = "SELECT ideaID, title, description , investmentRange, catID AS Category FROM idea WHERE 1=1";
    $params = [];

    if ($category) {
        $sql .= " AND catID = :category";
        $params['category'] = $category;
    }
    if ($min_investment) {
        $sql .= " AND investmentRange >= :min_investment";
        $params['min_investment'] = $min_investment;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getIdeaByIdRepo($pdo, $id) {
    $sql = "SELECT * FROM idea WHERE ideaID = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function getIdeaDocsRepo($pdo, $idea_id) {
    $sql = "SELECT ideaID AS id, attachment AS file_name FROM idea WHERE ideaID = :idea_id";
    $stmt = $pdo->prepare($sql); 
    $stmt->execute(['idea_id' => $idea_id]);
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}
?>
