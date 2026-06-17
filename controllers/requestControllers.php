<?php

require __DIR__ . "/../repos/requestRepo.php";
require __DIR__ . "/../helpers/requestHelper.php";

function AddRequest($pdo)
{
    try {

        $data = json_decode(file_get_contents("php://input"), true);

        $ideaID = $_GET["ideaId"] ?? null;
        if (!$ideaID) {
            response(400, "ideaId required");
        }

        $check = $pdo->prepare("SELECT ideaID FROM idea WHERE ideaID = ?");
        $check->execute([$ideaID]);

        if ($check->rowCount() == 0) {
            response(400, "Invalid ideaID");
        }

        $description = $data["description"] ?? null;
        $documentation = $data["documentation"] ?? null;

        if (!$description || !$documentation) {
            response(400, "Missing fields");
        }

        $result = CreateRequest(
            $pdo,
            $description,
            $documentation,
            "send",
            "pending",
            1,
            $ideaID
        );

        if ($result) {
            response(201, "Request created successfully");
        }

        response(500, "Failed");

    } catch (PDOException $e) {

        response(500, "Database error", $e->getMessage());

    } catch (Exception $e) {

        response(500, "Server error", $e->getMessage());
    }
}

// GET all requests

function GetAllRequests($pdo)
{
    $data = GetAllRequestsRepo($pdo);
    response(200, "success", $data);
}

// GET requests by ideaId
function GetRequestsByIdea($pdo)
{
    $ideaID = $_GET["ideaId"] ?? null;

    if (!$ideaID) {
        response(400, "ideaId required");
    }
    $data = GetRequestsByIdeaRepo($pdo, $ideaID);

    response(200, "success", $data);
}
// GET request by ID
function GetRequestById($pdo)
{
    $id = $_GET["id"] ?? null;
    if (!$id) {
        response(400, "ID required");
    }
    $data = GetRequestByIdRepo($pdo, $id);

    if (!$data) {
        response(404, "Request not found");
    }

    response(200, "success", $data);
}
// DELETE request   
function DeleteRequest($pdo)
{
    $id = $_GET["id"] ?? null;
    if (!$id) {
        response(400, "ID required");
    }
    $check = GetRequestByIdRepo($pdo, $id);

    if (!$check) {
        response(404, "Request not found");
    }
    $result = SoftDeleteRequestRepo($pdo, $id);

    if ($result) {
        response(200, "Deleted successfully");
    }
    response(500, "Failed");
}