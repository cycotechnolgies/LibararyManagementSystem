<?php
require_once('conn.php');

$update = false;
$member_id = $email = "";

function getLastMemId($conn) {
    $sql = "SELECT member_id FROM member ORDER BY member_id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $lastMember = $result->fetch_assoc()) {
        return $lastMember['member_id'];
    } else {
        $lastMember = 'M000';
    }
}

function getNextMemId($lastMember) {
    $prefix = 'M';
    $numPart = intval(substr($lastMember, 1));
    return $prefix . str_pad($numPart + 1, 3, '0', STR_PAD_LEFT);
}

$lastMember = getLastMemId($conn);
$newMemId = getNextMemId($lastMember);

function handleAddMember($conn) {
    $member_id = $_POST['m_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $birthday = $_POST['dob'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        setSessionMessage("Invalid email address.", "danger");
    } else {
        $sql = "INSERT INTO member (member_id, first_name, last_name, email, birthday) 
                VALUES (?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssss", $member_id,$first_name, $last_name, $email, $birthday);

            if ($stmt->execute()) {
                setSessionMessage("Member record has been saved!", "success");
                redirect('members.php');
            } else {
                setSessionMessage("Execution error: " . $stmt->error, "danger");
            }

            $stmt->close();
        } else {
            setSessionMessage("Preparation error: " . $conn->error, "danger");
        }
    }
}


function handleDeleteMember($conn) {
    $member_id = $_GET['delete'];

    if ($stmt = $conn->prepare("DELETE FROM member WHERE member_id = ?")) {
        $stmt->bind_param("s", $member_id);
        $stmt->execute();
        $stmt->close();

        setSessionMessage("Member record has been deleted!", "success");
        redirect('members.php');
    } else {
        setSessionMessage("Delete error: " . $conn->error, "danger");
    }
}


function handleEditMember($conn) {
    global $update, $member_id, $first_name, $last_name, $email, $birthday;

    $member_id = $_GET['edit'];
    $update = true;

    if ($stmt = $conn->prepare("SELECT * FROM member WHERE member_id = ?")) {
        $stmt->bind_param("s", $member_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $member_id = $row['member_id'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $email = $row['email'];
            $birthday = $row['birthday'];
        }

        $stmt->close();
    } else {
        setSessionMessage("Edit error: " . $conn->error, "danger");
    }
}


function handleUpdateMember($conn) {
    $member_id = $_POST['m_id']; 
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $birthday = $_POST['dob'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        setSessionMessage("Invalid email address.", "danger");
    } 
    else {
        if ($stmt = $conn->prepare("UPDATE member SET first_name = ?, last_name = ?, email = ?, birthday = ? WHERE member_id = ?")) {
            $stmt->bind_param("sssss", $first_name, $last_name, $email, $birthday, $member_id);

            if ($stmt->execute()) {
                setSessionMessage("Member record has been updated!", "success");
                redirect('members.php');
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
    if (isset($_POST['AddMember'])) {
        handleAddMember($conn);
    } elseif (isset($_POST['update'])) {
        handleUpdateMember($conn);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['delete'])) {
        handleDeleteMember($conn);
    } elseif (isset($_GET['edit'])) {
        handleEditMember($conn);
    }
}

?>
