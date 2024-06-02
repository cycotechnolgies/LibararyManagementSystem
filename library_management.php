<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        if (isset($_POST['borrowId'], $_POST['bookId'], $_POST['memberId'], $_POST['borrowStatus'])) {
            $borrowId = $_POST['borrowId'];
            $bookId = $_POST['bookId'];
            $memberId = $_POST['memberId'];
            $borrowStatus = $_POST['borrowStatus'];

            $stmt = $conn->prepare("INSERT INTO borrows (borrowId, bookId, memberId, borrowStatus) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $borrowId, $bookId, $memberId, $borrowStatus);

            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    } elseif ($action === 'update') {
        if (isset($_POST['updateBorrowId'])) {
            $borrowId = $_POST['updateBorrowId'];
            $bookId = $_POST['updateBookId'] ?? null;
            $memberId = $_POST['updateMemberId'] ?? null;
            $borrowStatus = $_POST['updateBorrowStatus'] ?? null;

            $sql = "UPDATE borrows SET ";
            $params = [];
            $types = '';

            if ($bookId !== null) {
                $sql .= "bookId=?, ";
                $params[] = $bookId;
                $types .= 's';
            }

            if ($memberId !== null) {
                $sql .= "memberId=?, ";
                $params[] = $memberId;
                $types .= 's';
            }

            if ($borrowStatus !== null) {
                $sql .= "borrowStatus=?, ";
                $params[] = $borrowStatus;
                $types .= 's';
            }

            $sql = rtrim($sql, ', ') . " WHERE borrowId=?";
            $params[] = $borrowId;
            $types .= 's';

            $stmt = $conn->prepare($sql);
            $stmt->bind_param($types, ...$params);

            if ($stmt->execute()) {
                echo "Record updated successfully";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    } elseif ($action === 'delete') {
        if (isset($_POST['deleteBorrowId'])) {
            $borrowId = $_POST['deleteBorrowId'];

            $stmt = $conn->prepare("DELETE FROM borrows WHERE borrowId=?");
            $stmt->bind_param("s", $borrowId);

            if ($stmt->execute()) {
                echo "Record deleted successfully";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}

$conn->close();
?>
