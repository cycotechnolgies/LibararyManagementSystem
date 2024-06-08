<?php
// Include the configuration file for database connection
include 'config.php';

// Retrieve form data using POST method
$borrowId =$_POST['borrowId'];
$bookId = $_POST['bookId'];
$memberId = $_POST['memberId'];
$borrowStatus = $_POST['borrowStatus'];

// Check if the book ID exists in the book table
$checkBookSql = "SELECT COUNT(*) FROM book WHERE book_id = :bookId";
$checkBookStmt = $pdo->prepare($checkBookSql);
$checkBookStmt->execute(['bookId' => $bookId]);
$bookExists = $checkBookStmt->fetchColumn();

// Check if the member ID exists in the member table
$checkMemberSql = "SELECT COUNT(*) FROM member WHERE member_id = :memberId";
$checkMemberStmt = $pdo->prepare($checkMemberSql);
$checkMemberStmt->execute(['memberId' => $memberId]);
$memberExists = $checkMemberStmt->fetchColumn();

if ($bookExists > 0 && $memberExists > 0) {
    // Proceed to insert into bookborrower table
    $sql = "INSERT INTO bookborrower (borrow_id, book_id, member_id, borrow_status, borrower_date_modified) VALUES (:borrowId, :bookId, :memberId, :borrowStatus, NOW())";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute(['borrowId' => $borrowId, 'bookId' => $bookId, 'memberId' => $memberId, 'borrowStatus' => $borrowStatus]);
        // Redirect to index page after successful insertion
        header("Location: index.php");
    } catch (PDOException $e) {
        // Display error message if insertion fails
        echo "Error: " . $e->getMessage();
    }
} else {
    if ($bookExists <= 0) {
        // Display error message if book ID does not exist
        echo "Error: The book ID does not exist in the book table.";
    }
    if ($memberExists <= 0) {
        // Display error message if member ID does not exist
        echo "Error: The member ID does not exist in the member table.";
    }
}
?>
