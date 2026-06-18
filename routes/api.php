<?php

require_once "../controllers/loginCont.php";
require_once "../controllers/registerCont.php";
require_once "../controllers/resetCont.php";
require_once "../controllers/forgetCont.php";
require_once "../controllers/userCont.php";
require_once "../controllers/investorCont.php";



$data = json_decode(file_get_contents("php://input"),true);
$path = $_SERVER['PATH_INFO'];

if ($_SERVER['REQUEST_METHOD'] == "POST" && $path == '/register') {
    register($data);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && $path == '/login'){
    login($data);
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && $path == '/forgot-password') {
   forgotPassword($data);
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && $path == '/reset-password') {
   resetPassword($data);
}

if ($_SERVER['REQUEST_METHOD'] == "GET" && $path == '/user') {
    getUserProfile();
}

if ($_SERVER['REQUEST_METHOD'] == "PUT" && $path == '/user') {
    updateUserProfile($data);
}

// Investor Get Idea Routes (muzan))
if ($_SERVER['REQUEST_METHOD'] == "GET" && $path == '/ideas') {

    if (isset($_GET['id'])) {
        getIdeaDetailsController($pdo);
    } else {
        getIdeasController($pdo);
    }
}
if ($_SERVER['REQUEST_METHOD'] == "GET" && $path == '/ideas/attachments') {

    getIdeaDocumentationsController($pdo);

}
if(
    $_SERVER["REQUEST_METHOD"]=="GET"
    &&
    $path=="/sessions"
){
    AvailableSessions();
}

if(
    $_SERVER["REQUEST_METHOD"]=="POST"
    &&
    preg_match(
        "#^/session/book/(\d+)$#",
        $path,
        $matches
    )
){
    BookSession(
        $matches[1]
    );
}

if(
    $_SERVER["REQUEST_METHOD"]=="GET"
    &&
    preg_match(
        "#^/session/(\d+)$#",
        $path,
        $matches
    )
){
    GetSessionDetails(
        $matches[1]
    );
}

if(
    $_SERVER["REQUEST_METHOD"]=="PUT"
    &&
    preg_match(
        "#^/session/(\d+)$#",
        $path,
        $matches
    )
){
    RescheduleSession(
        $matches[1],
        $data
    );
}

if(
    $_SERVER["REQUEST_METHOD"]=="DELETE"
    &&
    preg_match(
        "#^/session/(\d+)$#",
        $path,
        $matches
    )
){
    CancelConsultancySession(
        $matches[1]
    );

}
