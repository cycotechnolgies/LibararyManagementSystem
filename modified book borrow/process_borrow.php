<?php
require 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $borrow_id = isset($_POST['borrow_id']) ? $_POST['borrow_id'] : '';
    $book_id = isset($_POST['book_id']) ? $_POST['book_id'] : '';
    $member_id = isset($_POST['member_id']) ? $_POST['member_id'] : '';
    $borrow_status = isset($_POST['borrow_status']) ? $_POST['borrow_status'] : '';

    if (isset($_POST['edit'])) {
        if (!empty($borrow_id) && !empty($book_id) && !empty($member_id) && !empty($borrow_status)) {
            $stmt = $conn->prepare("UPDATE bookborrower SET book_id=?, member_id=?, borrow_status=?, borrower_date_modified=NOW() WHERE borrow_id=?");
            $stmt->bind_param('ssss', $book_id, $member_id, $borrow_status, $borrow_id);

            if ($stmt->execute()) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: All fields are required for updating a record.";
        }
    } elseif (isset($_POST['delete'])) {
        if (!empty($borrow_id)) {
            $stmt = $conn->prepare("DELETE FROM bookborrower WHERE borrow_id=?");
            $stmt->bind_param('s', $borrow_id);

            if ($stmt->execute()) {
                echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: borrow_id is required for deleting a record.";
        }
    } elseif (isset($_POST['edit'])) {
        // This is to pre-fill form data for editing
        if (!empty($borrow_id)) {
            $stmt = $conn->prepare("SELECT * FROM bookborrower WHERE borrow_id=?");
            $stmt->bind_param('s', $borrow_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $book_id = $row['book_id'];
                $member_id = $row['member_id'];
                $borrow_status = $row['borrow_status'];
            } else {
                echo "No record found with borrow_id: $borrow_id";
            }
            $stmt->close();
        }
    } else {
        if (!empty($borrow_id) && !empty($book_id) && !empty($member_id) && !empty($borrow_status)) {
            $stmt = $conn->prepare("INSERT INTO bookborrower (borrow_id, book_id, member_id, borrow_status, borrower_date_modified) VALUES (?, ?, ?, ?, NOW())");
            $stmt->bind_param('ssss', $borrow_id, $book_id, $member_id, $borrow_status);

            if ($stmt->execute()) {
                echo "Record added successfully";
            } else {
                echo "Error adding record: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: All fields are required for adding a new record.";
        }
    }
}
$conn->close();
?>
