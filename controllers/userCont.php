<?php
require_once __DIR__ . '/../connection.php';
require_once __DIR__ . '/../helpers/response.php';
require_once __DIR__ . '/../helpers/jwt.php';
require_once __DIR__ . '/../repos/userRepo.php';
require __DIR__ . '/../vendor/autoload.php';

function getUserProfile() {
    $verifiedToken = VerifyToken();
    $userID = $verifiedToken->user_id;

    $user = GetUserByIDRepo($userID);

    if ($user) {
        return response(200, "User profile retrieved successfully", $user);
    } else {
        return response(404, "User not found");
    }
}

function updateUserProfile($data) {
    $verifiedToken = VerifyToken();
    $userID = $verifiedToken->user_id;

    $name = $data['name'] ?? null;
    $email = $data['email'] ?? null;
    $yearsOfExperience = $data['yearsOfExperience'] ?? null;
    $field = $data['field'] ?? null;

    if (empty($name) || empty($email)) {
        return response(400, "Name and Email are required fields");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return response(400, "Invalid email format");
    }

    global $pdo;
    $stmt = $pdo->prepare("SELECT userID FROM user WHERE email = ? AND userID != ?");
    $stmt->execute([$email, $userID]);
    if ($stmt->fetch()) {
        return response(409, "Email is already taken by another account");
    }

    // 4. Perform update
    $success = UpdateUserRepo($userID, $name, $email, $yearsOfExperience, $field);

    if ($success) {
        $updatedUser = GetUserByIDRepo($userID);
        return response(200, "User profile updated successfully", $updatedUser);
    } else {
        return response(500, "Failed to update user profile");
    }
}
?>
