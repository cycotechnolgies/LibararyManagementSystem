<?php
require_once('conn.php');

$update = false;
$member_id = $email = "";
$date_modified = date('Y-m-d H:i:s');

function getLastCategoryId($conn) {
    $sql = "SELECT category_id FROM bookcategory ORDER BY category_id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $lastcategoryId = $result->fetch_assoc()) {
        return $lastcategoryId['category_id'];
    } else {
        $lastcategoryId = 'C000';
    }
}

function getNextCategoryId($lastcategoryId) {
    $prefix = 'C';
    $numPart = intval(substr($lastcategoryId, 1));
    return $prefix . str_pad($numPart + 1, 3, '0', STR_PAD_LEFT);
}

$lastcategoryId = getLastCategoryId($conn);
$newCategoryId = getNextCategoryId($lastcategoryId);

function handleAddCategory($conn) {
    $category_name = $_POST['category_name'];
    $date_modified = $_POST['upt_date'];
    $category_id = $_POST['category_id'];

    $sql = "INSERT INTO bookcategory(category_id, category_Name, date_modified) 
            VALUES (?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $category_id, $category_name, $date_modified);

        if ($stmt->execute()) {
            setSessionMessage("Category added successfully!", "success");
            redirect('category.php');
        } else {
            setSessionMessage("Error adding category: " . $stmt->error, "danger");
        }

        $stmt->close();
    } else {
        setSessionMessage("SQL error: " . $conn->error, "danger");
    }
}



function handleDeleteCategory($conn) {
    $category_id = $_GET['delete'];

    if ($stmt = $conn->prepare("DELETE FROM bookcategory WHERE category_id = ?")) {
        $stmt->bind_param("s", $category_id);
        $stmt->execute();
        $stmt->close();

        setSessionMessage("Category deleted successfully!", "success");
        redirect('category.php'); 
    } else {
        setSessionMessage("Error deleting category: " . $conn->error, "danger");
    }
}



function handleEditCategory($conn) {
    global $update, $category_id, $category_name, $date_modified;

    if (isset($_GET['edit'])) {
        $category_id = $_GET['edit'];
        $update = true;

        if ($stmt = $conn->prepare("SELECT * FROM bookcategory WHERE category_id = ?")) {
            $stmt->bind_param("s", $category_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $category_id = $row['category_id'];
                $category_name = $row['category_Name'];
                $date_modified = $row['date_modified'];
            } else {
                setSessionMessage("No category found with the given ID.", "warning");
            }

            $stmt->close();
        } else {
            setSessionMessage("Error fetching category details: " . $conn->error, "danger");
        }
    } else {
        setSessionMessage("No category ID provided for editing.", "danger");
    }
}




function handleUpdateCategory($conn) {
    $category_id = $_POST['category_id']; 
    $category_name = $_POST['category_name'];
    global $date_modified;

    if ($stmt = $conn->prepare("UPDATE bookcategory SET category_Name = ?, date_modified = ? WHERE category_id = ?")) {
        $stmt->bind_param("sss", $category_name, $date_modified, $category_id);

        if ($stmt->execute()) {
            setSessionMessage("Category updated successfully!", "success");
            redirect('category.php'); 
        } else {
            setSessionMessage("Error updating category: " . $stmt->error, "danger");
        }

        $stmt->close();
    } else {
        setSessionMessage("SQL error: " . $conn->error, "danger");
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
    if (isset($_POST['AddCategory'])) {
        handleAddCategory($conn);
    } elseif (isset($_POST['update'])) {
        handleUpdateCategory($conn);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['delete'])) {
        handleDeleteCategory($conn);
    } elseif (isset($_GET['edit'])) {
        handleEditCategory($conn);
    }
}

?>
