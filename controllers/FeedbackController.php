<?php
require_once "../repos/FeedbackRepo.php";
require_once "../helpers/response.php";
require_once '../helpers/jwt.php';
require_once '../cache/redis.php';
// returns all feedback , cached in redis
function GetAllFeedback(){
    global $redis;
    $cacheKey= 'feedback:all';
// check redis cache 
    if($redis->exists($cacheKey)){
        response(200,"feedback fetched successfully",[
            'source' => 'redis',
            'data'=> json_decode($redis->get($cacheKey),true)
        ]);
        return;
    }
// fetch from database and cache result
    $GetAllFeedback = GetAllFeedbackRepo();
    $redis->setex($cacheKey, 3600,json_encode($GetAllFeedback));
    response(200,"feedback fetched successfully", 
    [
        'source' => 'database',
        'data'=> $GetAllFeedback
    ]);
}
// returns a single feedback by id , cached in redis
function GetFeedbackById($feedbackID){
    global $redis;
    $cacheKey= 'feedback:'. $feedbackID;
    if($redis->exists($cacheKey)){
        response(200,"feedback fetched successfully",[
            'source' => 'redis',
            'data'=> json_decode($redis->get($cacheKey),true)
        ]);
        return;
    }
    $feedback=GetFeedbackByIdRepo($feedbackID);
    if(!$feedback){
        response(404,"feedback not found");
    }
    $redis->setex($cacheKey, 3600,json_encode($feedback));
    response(200,"feedback fetched successfully",[
        'source' => 'database',
        'data'=> $feedback
    ]);
}
// returns feedback count per idea - admin only
function CountFeedbackByIdea($ideaID){
    
    $verifiedToken = verifyToken();
    require_admin($verifiedToken);
    $countidea=CountFeedbackByIdeaRepo($ideaID);
    if($countidea){
        response(200,$countidea);
    }else{
        response(404,"no feedback found");
    }

}
// returns feedback count per session - admin only
function CountFeedbackBySession($sessID){
    
    $verifiedToken = verifyToken();
    require_admin($verifiedToken);
    $countsession=CountFeedbackBySessionRepo($sessID);
    if($countsession){
        response(200,$countsession);
    }else{
        response(404,"no feedback found");
    }
}
// creates new feedback - all user only
// requires either sessID or ideaID (not both null)
function CreateFeedback($data){
    global $redis;
    $verifiedToken = verifyToken();
    require_user($verifiedToken);
    $rating = $data['rating'] ?? '';
    $content = $data['content'] ?? '';
    $timestamp = $data['timestamp'] ?? '';
    
    $userID = $verifiedToken->user_id;
    $sessID= $_GET['sessID'] ?? null;
    $ideaID= $_GET['ideaID'] ?? null;
// validate required fields
    if(empty($rating) || empty($content) || empty($timestamp) || empty($userID) || (empty($sessID) && empty($ideaID))){
        response(400,"missing fields");
        exit;
    }
    CreateFeedbackRepo($sessID,$userID,$ideaID,$timestamp,$rating,$content);
    $redis->del('feedback:all');
    response(201,"feedback created successfully");
}
// deletes feedback by id - admin only
function DeleteFeedback($feedbackID){
    global $redis;
    $verifiedToken = verifyToken();
    require_admin($verifiedToken);
    if(!GetFeedbackByIdRepo($feedbackID)){
        response(404,"feedback not found");
        exit;
    }
    DeleteFeedbackRepo($feedbackID);
    $redis->del('feedback:all');
    $redis->del('feedback:'.$feedbackID);
    response(200,"feedback deleted successfully");
}