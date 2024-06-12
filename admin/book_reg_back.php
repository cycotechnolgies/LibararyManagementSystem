<?php
require_once('conn.php');
session_start();

// Initialize variables
$update = false;
$book_id = $book_name = $category_id = "";

// Function to check if Book ID already exists
function checkBookExistence($conn, $book_id) {
    $stmt = $conn->prepare("SELECT * FROM book WHERE book_id = ?");
    $stmt->bind_param("s", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows > 0;
    $stmt->close();
    return $exists;
}

// Function to fetch all categories
function fetchCategories($conn) {
    $stmt = $conn->prepare("SELECT category_id, category_name FROM bookcategory");
    $stmt->execute();
    $result = $stmt->get_result();
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    $stmt->close();
    return $categories;
}

// Fetch categories for dropdown menu
$categories = fetchCategories($conn);

// Saving new book details
if (isset($_POST['save'])) {
    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    $category_id = $_POST['category_id'];

    if (checkBookExistence($conn, $book_id)) {
        $_SESSION['message'] = "Book ID already exists!";
        $_SESSION['msg_type'] = "danger";
    } else {
        $stmt = $conn->prepare("INSERT INTO book (book_id, book_name, category_id) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $book_id, $book_name, $category_id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Book record has been saved!";
        $_SESSION['msg_type'] = "success";
    }
    header("Location: books.php");
    exit();
}

// Deleting a book
if (isset($_GET['delete'])) {
    $book_id = $_GET['delete'];

    if ($book_id == 'B001') {
        $_SESSION['message'] = "The book with ID 'B001' cannot be deleted!";
        $_SESSION['msg_type'] = "danger";
    } else {
        $stmt = $conn->prepare("DELETE FROM book WHERE book_id = ?");
        $stmt->bind_param("s", $book_id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Book record has been deleted!";
        $_SESSION['msg_type'] = "danger";
    }
    header("Location: books.php");
    exit();
}

// Editing a book
if (isset($_GET['edit'])) {
    $book_id = $_GET['edit'];
    $update = true;

    $stmt = $conn->prepare("SELECT * FROM book WHERE book_id = ?");
    $stmt->bind_param("s", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $book_id = $row['book_id'];
        $book_name = $row['book_name'];
        $category_id = $row['category_id'];
    }

    $stmt->close();
}

// Updating a book
if (isset($_POST['update'])) {
    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    $category_id = $_POST['category_id'];

    // Check for existence but allow current book_id to pass
    $stmt = $conn->prepare("SELECT * FROM book WHERE book_id = ? AND book_id != ?");
    $stmt->bind_param("ss", $book_id, $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['message'] = "Book ID already exists!";
        $_SESSION['msg_type'] = "danger";
    } else {
        $stmt = $conn->prepare("UPDATE book SET book_name = ?, category_id = ? WHERE book_id = ?");
        $stmt->bind_param("sss", $book_name, $category_id, $book_id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['message'] = "Book record has been updated!";
        $_SESSION['msg_type'] = "warning";
    }
    header("Location: books.php");
    exit();
}
?>
