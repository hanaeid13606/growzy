// ana mohand
<?php


require_once __DIR__ . "/../db.php";
require_once "../controllers/idea.php";

$method = $_SERVER["REQUEST_METHOD"];

if ($method == "POST") {
    postIdea();
}

elseif ($method == "GET" && isset($_GET["id"])) {
    getIdea();
}

elseif ($method == "DELETE" && isset($_GET["id"])) {
    deleteIdeacontroller();
}

elseif ($method == "PUT") {
    updateIdeacontroller();
}