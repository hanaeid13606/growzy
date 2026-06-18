<?php
require_once __DIR__ . '/../connection.php';
require_once __DIR__ . '/../helpers/response.php';
require_once __DIR__ . '/../helpers/jwt.php';
require_once __DIR__ . '/../repos/loginRepo.php';
require __DIR__ . '/../vendor/autoload.php';

function login($data) {
    $email = $data['email'] ?? '';
    $pass = $data['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return response(400, ['message' => 'Invalid email format']);
    }

    $user = GetUserByEmail($email);
    
    if (!$user) {
        return response(404, ['message' => 'User not found']);
    }

    if (!password_verify($pass, $user['password'])) {
        return response(401, ['message' => 'invalid credentials']);
    }

    $token = GenerateToken($user);
    return response(200, ['message' => 'Logged in successfully', 'token' => $token]);
}