<?php
require_once "../controllers/loginCont.php";
require_once "../controllers/registerCont.php";
require_once "../controllers/resetCont.php";
require_once "../controllers/forgetCont.php";

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
