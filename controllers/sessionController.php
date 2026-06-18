<?php

require_once __DIR__ . "/../repos/sessionRepo.php";
require_once __DIR__ . "/../helpers/response.php";
require_once __DIR__ . "/../helpers/jwt.php";

function AvailableSessions()
{
    $sessions = GetAvailableSessions();
    response(  200,["message" => "Available sessions"],  $sessions );
}

function BookSession(
    $sessID
)
{
    $verifiedToken = VerifyToken();
    $userID = $verifiedToken->user_id;
    if(
        !is_numeric($sessID)
        ||
        $sessID <= 0
    ){
        response(422,["message"=>"Invalid session ID"]);
    }
    $session = GetSessionBySessID(
        $sessID
    );

    if(!$session){
        response( 404, ["message"=>"Session not found"]);
    }
    if(
        strtolower(
            $session["status"]
        ) != "available"
    ){
        response( 409, ["message"=>"Session is not available"] );}

    $booked = BookConsultancySession(
        $sessID,
        $userID
    );

    if(!$booked){
        response( 500,  ["message"=>"Failed to book session"] );
    }
    response( 200, ["message"=>"Session booked successfully"] );
}

function GetSessionDetails(
    $sessID
)
{
    $verifiedToken = VerifyToken();
    $userID = $verifiedToken->user_id;
    if(
        !is_numeric($sessID)
        ||
        $sessID <=0
    ){
        response( 422, ["message"=>"Invalid session ID"] );
    }

    $session = GetSessionByID(
        $sessID,
        $userID
    );
    if(!$session){
        response( 404, ["message"=>"Session not found"]);
    }

    response( 200, ["message"=>"Session retrieved successfully"],$session);
}

function RescheduleSession(
    $sessID,
    $data
)
{
    $verifiedToken = VerifyToken();
    $userID = $verifiedToken->user_id;
    if(
        !is_numeric($sessID)
        ||
        $sessID <=0
    ){
        response( 422,["message"=>"Invalid session ID"] );
    }
    $dateTime = trim(
        $data["dateTime"]
        ??
        ""
    );
    if(
        empty(
            $dateTime
        )
    ){
        response(400, ["message"=>"dateTime is required"]);
    }
    if(
        strtotime(
            $dateTime
        )
        ===
        false
    ){
        response( 400, ["message"=>"Invalid date format"] );
    }
    if(
        strtotime(
            $dateTime
        )
        <=
        time()
    ){
        response(400,["message"=>"Date must be future"] );
    }
    $session = GetSessionByID(
        $sessID,
        $userID
    );
    if(
        !$session
    ){
        response( 404, ["message"=>"Session not found"]);
    }
    if(
        strtolower(
            $session["status"]
        )
        ==
        "cancelled"
    ){
        response( 409, ["message"=>"Cannot reschedule cancelled session"] );
    }
    $updated = UpdateSessionDateTime(
        $sessID,
        $dateTime,
        $userID
    );
    if(
        !$updated
    ){
        response(500,["message"=>"Failed to update session"] );
    }
    response( 200, ["message"=>"Session rescheduled successfully"]);
}
function CancelConsultancySession(
    $sessID
)
{
    $verifiedToken = VerifyToken();
    $userID = $verifiedToken->user_id;
    if(
        !is_numeric($sessID)
        ||
        $sessID <=0
    ){
        response( 422, ["message"=>"Invalid session ID"] );
    }
    $session = GetSessionByID(
        $sessID,
        $userID
    );
    if(
        !$session
    ){
        response( 404, ["message"=>"Session not found"] );
    }
    if(
        strtolower(
            $session["status"]
        )
        ==
        "cancelled"
    ){
        response( 409, ["message"=>"Session already cancelled"]);
    }
    $cancelled = CancelSession(
        $sessID,
        $userID
    );
    if(
        !$cancelled
    ){
        response( 500, ["message"=>"Failed to cancel session"]);
    }
    response( 200,["message"=>"Session cancelled successfully"]);
}
