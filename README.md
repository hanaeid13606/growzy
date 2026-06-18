# GROWZY - Feedback
#Description
REST API for managing feedback on ideas and consultancy sessions
#Base URL
https://localhost/GROWZY/routes/feedbackAPI.php
##ENDPOINTS
#GET/Feedback
returns all feedback
#GET/Feedback?feedbackID={feedbackID}
returns feedback by id
#GET/Feedback?countidea={ideaID}
returns feedback count for a specific idea.(admin only)
#GET/Feedback?countsession={sessID}
returns feedback count for a specific session.(admin only)
#POST /Feedback
creates new feedback (all user only)
#DELETE /Feedback?feedbackID={feedbackID}
Deletes feedback by id .(admin only)
#Authentication
Bearer Token required for protected endpoints
#Tech stack
-PHP(procedural)
-PHPmyadmin(mysql)
-redis(caching)
-JWT Authentication

