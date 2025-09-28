<?php
header('Content-Type: application/json');
require 'config.php';

$type  = $_GET['type'] ?? '';
$value = trim($_GET['value'] ?? '');

$result = ['exists' => false];

if ($type === 'username') {
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $value);
    $stmt->execute();
    $stmt->store_result();
    $result['exists'] = $stmt->num_rows > 0;
    $stmt->close();
} elseif ($type === 'email') {
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $value);
    $stmt->execute();
    $stmt->store_result();
    $result['exists'] = $stmt->num_rows > 0;
    $stmt->close();
}

echo json_encode($result);
?>
