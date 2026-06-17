<?php
require_once '../connection.php';
function GetAllFeedbackRepo(){
    global $pdo;
    $query="SELECT * FROM Feedback";
    $getFeedback=$pdo->prepare($query);
    $getFeedback->execute();
    return $getFeedback->fetchAll(PDO::FETCH_ASSOC);
}
function GetFeedbackByIdRepo($feedbackID){
    global $pdo;
    $query="SELECT * FROM Feedback WHERE feedbackID=?";
    $getFeedbackById=$pdo->prepare($query);
    $getFeedbackById->execute([$feedbackID]);
    return $getFeedbackById->fetch(PDO::FETCH_ASSOC);
}
function CountFeedbackByIdeaRepo($ideaID){
    global $pdo;
    $query="SELECT ideaID, COUNT(feedbackID) AS CountFeedbackIdea
    FROM Feedback WHERE ideaID=? GROUP BY ideaID";
    $CountFeedbackByIdea=$pdo->prepare($query);
    $CountFeedbackByIdea->execute([$ideaID]);
    return $CountFeedbackByIdea->fetch(PDO::FETCH_ASSOC);

}
function CountFeedbackBySessionRepo($sessID){
    global $pdo;
    $query="SELECT sessID, COUNT(feedbackID) AS CountFeedbackSession
    FROM Feedback WHERE sessID=? GROUP BY sessID";
    $CountFeedbackBySession=$pdo->prepare($query);
    $CountFeedbackBySession->execute([$sessID]);
    return $CountFeedbackBySession->fetch(PDO::FETCH_ASSOC);

}
function CreateFeedbackRepo($sessID,$userID,$ideaID,$timestamp,$rating,$content){
    global $pdo;
    $query="INSERT INTO Feedback(sessID,userID,ideaID,timestamp,rating,content)
    VALUES(?,?,?,?,?,?)";
    $createFeedback=$pdo->prepare($query);
    return $createFeedback->execute([$sessID,$userID,$ideaID,$timestamp,$rating,$content]);
}
function DeleteFeedbackRepo($feedbackID){
    global $pdo;
    $delete=$pdo->prepare("DELETE FROM Feedback WHERE feedbackID=?");
    $delete->execute([$feedbackID]);
    return $delete->rowcount()>0;
}