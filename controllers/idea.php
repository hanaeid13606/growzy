<?php
require_once "../repos/connec.php";


require_once __DIR__ . "/../connection.php";
function postIdea()
{
    $data = json_decode(file_get_contents("php://input"), true);

    if (
        empty($data["title"]) ||
        empty($data["description"]) ||
        empty($data["attachment"]) ||
        empty($data["investmentRange"]) ||
        empty($data["catID"]) ||
        empty($data["userID"])
    ) {
        http_response_code(422);

        echo json_encode([
            "message" => "please enter all fields missing"
        ]);

        return;
    }

    createIdea($data);

    echo json_encode([
        "message" => "idea created successfully"
    ]);
}


function getIdea()
{
    $idea = getIdeaById($_GET["id"]);

    if (!$idea) {

        http_response_code(404);

        echo json_encode([
            "message" => "idea not found"
        ]);

        return;
    }

    echo json_encode($idea);
}


function getIdeasByPricecontroller()
{
    $ideas = getIdeasByPrice($_GET["price"]);

    http_response_code(200);

    echo json_encode($ideas);
}


function deleteIdeacontroller()
{
    $deleted = deleteIdearepo($_GET["id"]);

    if ($deleted == 0) {

        http_response_code(404);

        echo json_encode([
            "message" => "Idea not found"
        ]);

        return;
    }

    echo json_encode([
        "message" => "Idea deleted successfully"
    ]);
}


function updateIdeacontroller()
{
    $data = json_decode(file_get_contents("php://input"), true);

    if (
        empty($data["id"]) ||
        empty($data["title"]) ||
        empty($data["description"])
    ) {

        http_response_code(422);

        echo json_encode([
            "message" => "Validation errors"
        ]);

        return;
    }

    $updated = updateIdearepo($data);

    if ($updated == 0) {

        http_response_code(404);

        echo json_encode([
            "message" => "Idea not found"
        ]);

        return;
    }

    echo json_encode([
        "message" => "Idea updated successfully"
    ]);
}