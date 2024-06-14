<?php
require_once('conn.php');

// Initialize variables
$update = false;
$user_id = $email = "";

function getLastUserId($conn) {
    $sql = "SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $lastUser = $result->fetch_assoc()) {
        return $lastUser['user_id'];
    } else {
        $lastUser = 'U000';
    }
}

function getNextUserId($lastUserId) {
    $prefix = 'U';
    $numPart = intval(substr($lastUserId, 1));
    return $prefix . str_pad($numPart + 1, 3, '0', STR_PAD_LEFT);
}

$lastUserId = getLastUserId($conn);
$newUserId = getNextUserId($lastUserId);

function handleAddStaff($conn) {
    global $newUserId;
    $user_id = $newUserId;
    $userName = $_POST['user_name'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $pwd = $_POST['pwd'];
    $cpwd = $_POST['cpwd'];

    if (strlen($pwd) < 8) {
        setSessionMessage("Password is too short. Use a minimum of 8 characters.", "danger");
    } elseif ($pwd !== $cpwd) {
        setSessionMessage("Passwords do not match.", "danger");
    } else {
        $hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (user_id, email, first_name, last_name, username, password) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssss", $user_id, $email, $first_name, $last_name, $userName, $hash_pwd);

            if ($stmt->execute()) {
                setSessionMessage("Staff record has been saved!", "success");
                redirect('staff.php');
            } else {
                setSessionMessage("Execution error: " . $stmt->error, "danger");
            }

            $stmt->close();
        } else {
            setSessionMessage("Preparation error: " . $conn->error, "danger");
        }
    }
}

function handleDeleteUser($conn) {
    $user_id = $_GET['delete'];

    if ($stmt = $conn->prepare("DELETE FROM user WHERE user_id = ?")) {
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $stmt->close();

        setSessionMessage("User record has been deleted!", "success");
        redirect('staff.php');
    } else {
        setSessionMessage("Delete error: " . $conn->error, "danger");
    }
}

function handleEditUser($conn) {
    global $update, $user_id, $userName, $email, $first_name, $last_name;

    $user_id = $_GET['edit'];
    $update = true;

    if ($stmt = $conn->prepare("SELECT * FROM user WHERE user_id = ?")) {
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
            $userName = $row['username'];
            $email = $row['email'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
        }

        $stmt->close();
    } else {
        setSessionMessage("Edit error: " . $conn->error, "danger");
    }
}

function handleUpdateUser($conn) {
    $user_id = $_POST['user_id']; 
    $userName = $_POST['user_name'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $pwd = $_POST['pwd'];
    $cpwd = $_POST['cpwd'];

    if (strlen($pwd) < 8) {
        setSessionMessage("Password is too short. Use a minimum of 8 characters.", "danger");
    } elseif ($pwd !== $cpwd) {
        setSessionMessage("Passwords do not match.", "danger");
    } else {
        $hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);

        if ($stmt = $conn->prepare("UPDATE user SET username = ?, email = ?, first_name = ?, last_name = ?, password = ? WHERE user_id = ?")) {
            $stmt->bind_param("ssssss", $userName, $email, $first_name, $last_name, $hash_pwd, $user_id);

            if ($stmt->execute()) {
                setSessionMessage("User record has been updated!", "success");
                redirect('staff.php');
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
    if (isset($_POST['AddStaff'])) {
        handleAddStaff($conn);
    } elseif (isset($_POST['update'])) {
        handleUpdateUser($conn);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['delete'])) {
        handleDeleteUser($conn);
    } elseif (isset($_GET['edit'])) {
        handleEditUser($conn);
    }
}
?>
