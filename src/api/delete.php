<?php
session_start();
require_once __DIR__ . '/../utils/security.php';
require_once __DIR__ . '/../../config/db.php';

setSecurityHeaders();
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");

$data = json_decode(file_get_contents("php://input"));

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405);
    echo json_encode(["status" => "Error", "message" => "Method not allowed"]);
    die();
}

if (!isset($data->csrf_token) || !verifyCsrfToken($data->csrf_token)) {
    http_response_code(403);
    echo json_encode(["status" => "Error", "message" => "Invalid CSRF token"]);
    die();
}

if (!isset($data->id) || !is_numeric($data->id)) {
    http_response_code(400);
    echo json_encode(["status" => "Error", "message" => "Invalid or missing ID"]);
    die();
}

try {
    $stmt = $dbh->prepare("DELETE FROM asset WHERE id = ?");
    $stmt->execute([$data->id]);
    if ($stmt->rowCount() > 0) {
        echo json_encode(["status" => "Complete", "message" => "Asset deleted"]);
    } else {
        http_response_code(404);
        echo json_encode(["status" => "Error", "message" => "Asset not found"]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "Error", "message" => $e->getMessage()]);
} finally {
    $dbh = null;
}
