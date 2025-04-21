<?php
require_once __DIR__ . '/../utils/security.php';
require_once __DIR__ . '/../../config/db.php';

setSecurityHeaders();
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");

try {
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $stmt = $dbh->prepare("SELECT * FROM asset LIMIT ? OFFSET ?");
    $stmt->execute([$limit, $offset]);

    $assets = $stmt->fetchAll();
    echo json_encode($assets);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "Error", "message" => $e->getMessage()]);
} finally {
    $dbh = null;
}
