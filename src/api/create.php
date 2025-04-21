<?php
session_start();
require_once __DIR__ . '/../utils/security.php';
require_once __DIR__ . '/../../config/db.php';

setSecurityHeaders();
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");

$data = json_decode(file_get_contents("php://input"));

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "Error", "message" => "Method not allowed"]);
    die();
}

if (!isset($data->csrf_token) || !verifyCsrfToken($data->csrf_token)) {
    http_response_code(403);
    echo json_encode(["status" => "Error", "message" => "Invalid CSRF token"]);
    die();
}

if (!isset($data->code, $data->type, $data->description, $data->serial)) {
    http_response_code(400);
    echo json_encode(["status" => "Error", "message" => "Missing required fields"]);
    die();
}

try {
    $code = sanitizeInput($data->code);
    $type = sanitizeInput($data->type);
    $description = sanitizeInput($data->description);
    $serial = sanitizeInput($data->serial);

    $stmt = $dbh->prepare("INSERT INTO asset (code, type, description, serial) VALUES (?, ?, ?, ?)");
    $stmt->execute([$code, $type, $description, $serial]);
    http_response_code(201);
    echo json_encode(["status" => "Complete", "message" => "Asset created"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "Error", "message" => $e->getMessage()]);
} finally {
    $dbh = null;
}
