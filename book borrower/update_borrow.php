<?php
include 'config.php';

// Ensure errors are displayed for debugging purposes
ini_set('display_errors', 1);
error_reporting(E_ALL);

$borrowId = $_POST['borrowId'];
$bookId = $_POST['bookId'];
$memberId = $_POST['memberId'];
$borrowStatus = $_POST['borrowStatus'];

$sql = "UPDATE bookborrower SET book_id = :bookId, member_id = :memberId, borrow_status = :borrowStatus WHERE borrow_id = :borrowId";
$stmt = $pdo->prepare($sql);

$response = array();
try {
    $stmt->execute([
        'bookId' => $bookId,
        'memberId' => $memberId,
        'borrowStatus' => $borrowStatus,
        'borrowId' => $borrowId
    ]);
    $response['success'] = true;
} catch (PDOException $e) {
    $response['success'] = false;
    $response['error'] = $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>
