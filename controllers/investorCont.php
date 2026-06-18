<?php
require_once "../helpers/response.php";
require_once "../helpers/jwt.php";
require_once "../repos/investorRepo.php";

function getIdeasController($pdo) {
    $user = VerifyToken();

    $category = isset($_GET['category']) ? $_GET['category'] : null;
    $min_investment = isset($_GET['min_investment']) ? $_GET['min_investment'] : null;

    $ideas = getAllIdeasRepo($pdo, $category, $min_investment);

    if ($ideas) {
        response(200, "Ideas retrieved successfully", $ideas);
    } else {
        response(404, "No ideas found");
    }
}

function getIdeaDetailsController($pdo) {
    $user = VerifyToken();
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    
    if (!$id) {
        response(400, "Idea ID is required");
    }

    $idea = getIdeaByIdRepo($pdo, $id);

    if ($idea) {
        response(200, "Idea details retrieved", $idea);
    } else {
        response(404, "Idea not found");
    }
}

function getIdeaDocumentationsController($pdo) {
    $user = VerifyToken();
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    
    if (!$id) {
        response(400, "Idea ID is required");
    }

    $docs = getIdeaDocsRepo($pdo, $id);

    if ($docs) {
        response(200, "Attachment retrieved", $docs);
    } else {
        response(404, "No attachment found");
    }
}
?>
