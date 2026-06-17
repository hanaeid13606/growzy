<?php

require __DIR__ . "/../connection.php";
require __DIR__ . "/../controllers/requestControllers.php";
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "POST" && isset($_GET["ideaId"])) {

    AddRequest($pdo);

}

// GET all requests

elseif ($method == "GET" && !isset($_GET["ideaId"])) {
    GetAllRequests($pdo);
}

// GET by ideaId

elseif ($method == "GET" && isset($_GET["ideaId"])) {
    GetRequestsByIdea($pdo);
}

// GET request by ID

elseif ($method == "GET" && isset($_GET["id"])) {
    GetRequestById($pdo);
}

// DELETE request
elseif ($method == "DELETE") {
    DeleteRequest($pdo);
}