<?php
include 'config.php';

// Ensure errors are displayed for debugging purposes
ini_set('display_errors', 1);
error_reporting(E_ALL);

$borrowId = $_GET['id'];

$sql = "DELETE FROM bookborrower WHERE borrow_id = :borrowId";
$stmt = $pdo->prepare($sql);

$response = array();
try {
    $stmt->execute(['borrowId' => $borrowId]);
    $response['success'] = true;
} catch (PDOException $e) {
    $response['success'] = false;
    $response['error'] = $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>
