<?php
require_once('conn.php');

// Initialize variables
$update = false;
$user_id = $email = "";

function getLastBorrowId($conn) {
    $sql = "SELECT borrow_id FROM bookborrower ORDER BY borrow_id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $lastBorrow = $result->fetch_assoc()) {
        return $lastBorrow['borrow_id'];
    } else {
        $lastBorrow = 'BR000';
    }
}


function getNextBorrowId($lastBorrowId) {
    $prefix = 'BR';
    $numPart = intval(substr($lastBorrowId, 2));
    return $prefix . str_pad($numPart + 1, 3, '0', STR_PAD_LEFT);
}


$lastBorrowId = getLastBorrowId($conn);
$newBorrowId = getNextBorrowId($lastBorrowId);

function handleAddBorrow($conn) {
    global $newBorrowId;

    $book_id = $_POST['book_id'];
    $member_id = $_POST['member_id'];
    $borrow_status = $_POST['borrow_status'];

    // Example validation for book_id and member_id (adjust as needed)
    if (empty($book_id) || empty($member_id)) {
        setSessionMessage("Book ID and Member ID are required.", "danger");
    } else {
        // Check if the member_id exists in the members table
        $checkMemberQuery = "SELECT COUNT(*) as count FROM member WHERE member_id = ?";
        $stmtCheckMember = $conn->prepare($checkMemberQuery);
        $stmtCheckMember->bind_param("s", $member_id);
        $stmtCheckMember->execute();
        $resultCheckMember = $stmtCheckMember->get_result();
        $row = $resultCheckMember->fetch_assoc();
        $memberExists = $row['count'] > 0;

        if (!$memberExists) {
            setSessionMessage("Invalid Member ID.", "danger");
        } else {
            // Check if the book is already borrowed
            $checkBorrowedQuery = "SELECT COUNT(*) as count FROM bookborrower WHERE book_id = ? AND borrow_status = 'borrowed'";
            $stmtCheckBorrowed = $conn->prepare($checkBorrowedQuery);
            $stmtCheckBorrowed->bind_param("s", $book_id);
            $stmtCheckBorrowed->execute();
            $resultCheckBorrowed = $stmtCheckBorrowed->get_result();
            $row = $resultCheckBorrowed->fetch_assoc();
            $bookAlreadyBorrowed = $row['count'] > 0;

            if ($bookAlreadyBorrowed) {
                setSessionMessage("This book is already borrowed.", "danger");
            } else {
                // Proceed with inserting the borrowing record
                $borrow_id = $newBorrowId;

                $sql = "INSERT INTO bookborrower (borrow_id, book_id, member_id, borrow_status) 
                        VALUES (?, ?, ?, ?)";

                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("ssss", $borrow_id, $book_id, $member_id, $borrow_status);

                    if ($stmt->execute()) {
                        setSessionMessage("Borrow record has been saved!", "success");
                        redirect('borrow.php');
                    } else {
                        setSessionMessage("Execution error: " . $stmt->error, "danger");
                    }

                    $stmt->close();
                } else {
                    setSessionMessage("Preparation error: " . $conn->error, "danger");
                }
            }
        }
    }
}



function handleDeleteBorrow($conn) {
    $borrow_id = $_GET['delete'];

    if ($stmt = $conn->prepare("DELETE FROM bookborrower WHERE borrow_id = ?")) {
        $stmt->bind_param("s", $borrow_id);
        $stmt->execute();
        $stmt->close();

        setSessionMessage("Borrow record has been deleted!", "success");
        redirect('borrow.php');
    } else {
        setSessionMessage("Delete error: " . $conn->error, "danger");
    }
}


function handleEditBorrow($conn) {
    global $update, $borrow_id, $book_id, $member_id, $borrow_status;

    $borrow_id = $_GET['edit'];
    $update = true;

    if ($stmt = $conn->prepare("SELECT * FROM bookborrower WHERE borrow_id = ?")) {
        $stmt->bind_param("s", $borrow_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $borrow_id = $row['borrow_id'];
            $book_id = $row['book_id'];
            $member_id = $row['member_id'];
            $borrow_status = $row['borrow_status'];
        }

        $stmt->close();
    } else {
        setSessionMessage("Edit error: " . $conn->error, "danger");
    }
}


function handleUpdateBorrow($conn) {
    $borrow_id = $_POST['borrow_id']; 
    $book_id = $_POST['book_id'];
    $member_id = $_POST['member_id'];
    $borrow_status = $_POST['borrow_status'];

    // Example validation (adjust as needed)
    if (empty($book_id) || empty($member_id)) {
        setSessionMessage("Book ID and Member ID are required.", "danger");
    } else {
        if ($stmt = $conn->prepare("UPDATE bookborrower SET book_id = ?, member_id = ?, borrow_status = ? WHERE borrow_id = ?")) {
            $stmt->bind_param("ssss", $book_id, $member_id, $borrow_status, $borrow_id);

            if ($stmt->execute()) {
                setSessionMessage("Borrow record has been updated!", "success");
                redirect('borrow.php');
            } else {
                setSessionMessage("Execution error: " . $stmt->error, "danger");
            }

            $stmt->close();
        } else {
            setSessionMessage("Preparation error: " . $conn->error, "danger");
        }
    }
}


function setSessionMessage($message, $type) {
    $_SESSION['message'] = $message;
    $_SESSION['msg_type'] = $type;
}

function redirect($location) {
    header("Location: $location");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['AddBorrow'])) {
        handleAddBorrow($conn);
    } elseif (isset($_POST['update'])) {
        handleUpdateBorrow($conn);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['delete'])) {
        handleDeleteBorrow($conn);
    } elseif (isset($_GET['edit'])) {
        handleEditBorrow($conn);
    }
}
?>
