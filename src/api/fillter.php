<?php
require_once __DIR__ . '/../utils/security.php';
require_once __DIR__ . '/../../config/db.php';

setSecurityHeaders();
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");

if (!isset($_GET['type'])) {
    http_response_code(400);
    echo json_encode(["status" => "Error", "message" => "Missing type parameter"]);
    die();
}

try {
    $type = sanitizeInput($_GET['type']);
    $stmt = $dbh->prepare("SELECT * FROM asset WHERE type = ? LIMIT 5");
    $stmt->execute([$type]);
    $assets = $stmt->fetchAll();
    echo json_encode($assets);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "Error", "message" => $e->getMessage()]);
} finally {
    $dbh = null;
}
