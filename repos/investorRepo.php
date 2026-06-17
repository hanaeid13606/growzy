<?php
require_once "../connection.php";

function getAllIdeasRepo($pdo, $category = null, $min_investment = null) {
    $sql = "SELECT id, Idea_Title, Idea_Description, Investment_Range, Category FROM ideas WHERE 1=1";
    $params = [];

    if ($category) {
        $sql .= " AND Category = :category";
        $params['category'] = $category;
    }
    if ($min_investment) {
        $sql .= " AND Investment_Range >= :min_investment";
        $params['min_investment'] = $min_investment;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getIdeaByIdRepo($pdo, $id) {
    $sql = "SELECT * FROM ideas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getIdeaDocsRepo($pdo, $idea_id) {
    $sql = "SELECT id, file_name, file_path, upload_date FROM documentations WHERE idea_id = :idea_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['idea_id' => $idea_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
