<?php
require_once "../controllers/FeedbackController.php";
$data = json_decode(file_get_contents("php://input"),true);
$path=$_SERVER['PATH_INFO']?? '';

if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['feedbackID']) && $path=='/Feedback'){
    GetFeedbackById($_GET['feedbackID']);
}
if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['countidea']) && $path=='/Feedback'){
    CountFeedbackByIdea($_GET['countidea']);
}
if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['countsession']) && $path=='/Feedback'){
    CountFeedbackBySession($_GET['countsession']);
}
if($_SERVER['REQUEST_METHOD']=="GET" && $path =='/Feedback'){
    GetAllFeedback();
}
if($_SERVER['REQUEST_METHOD']=="POST" && $path =='/Feedback'){
    CreateFeedback($data);
}
if($_SERVER['REQUEST_METHOD']=="DELETE" && $path=='/Feedback' && isset($_GET['feedbackID'])){
    DeleteFeedback($_GET['feedbackID']);
}
