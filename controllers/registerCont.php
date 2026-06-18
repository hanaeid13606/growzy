<?php
require_once __DIR__ . '/../connection.php';
require_once __DIR__ . '/../helpers/response.php';
require_once __DIR__ . '/../repos/registerRepo.php';
require __DIR__ . '/../vendor/autoload.php';

function register($data) {
    $name = $data['name'] ?? '';
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';
    $role = $data['role'] ?? 'user'; 

    if ($role === 'admin') {
        if (($data['secret_key'] ?? '') !== 'YOUR_SECRET_KEY') {
            return response(403, ['message' => 'Invalid admin key']);
        }
    }

    $yearsOfExperience = $data['yearsOfExperience'] ?? 0;
    $field = $data['field'] ?? '';

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $success = RegisterUser($name, $email, $hashedPassword, $role, $yearsOfExperience, $field);

    if ($success) {
        return response(201, ['message' => 'User registered successfully']);
    } else {
        return response(500, ['message' => 'Registration failed']);
    }
}