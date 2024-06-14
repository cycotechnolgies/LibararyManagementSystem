<?php

session_start();
include 'member.back.inc.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

<div class="row">
    <div class="card shadow mb-3">
        <div class="card-body">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-<?php echo $_SESSION['msg_type']; ?>">
                    <?php 
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    ?>
                </div>
            <?php endif; ?>
            <form action="members.php" method="POST">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="member_id"><strong>Member ID</strong></label>
                            <input id="member_id" class="form-control" type="text" placeholder="M001" name="m_id" value="<?php echo $update ? htmlspecialchars($member_id) : htmlspecialchars($newMemId);?>"/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="email"><strong>Email Address</strong></label>
                            <input id="email" class="form-control" type="email" placeholder="user@example.com" name="email" value="<?php echo $update ? htmlspecialchars($email) : ''?>"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="first_name"><strong>First Name</strong></label>
                            <input id="first_name" class="form-control" type="text" placeholder="John" name="first_name" value="<?php echo $update ? htmlspecialchars($first_name) : ''?>"/>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="last_name"><strong>Last Name</strong></label>
                            <input id="last_name" class="form-control" type="text" placeholder="Doe" name="last_name" value="<?php echo $update ? htmlspecialchars($last_name) : ''?>"/>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="dob"><strong>Date of Birth</strong></label>
                            <input id="dob" class="form-control" type="text" placeholder="YYYY/MM/DD" name="dob" value="<?php echo $update ? htmlspecialchars($birthday) : ''?>"/>
                        </div>
                    </div>
                </div>
                <div class="mb-3 d-flex justify-content-end">
                    <button class="btn btn-primary btn-md" type="submit" name="<?php echo $update ? 'update' : 'AddMember'; ?>">
                        <?php echo $update ? 'Update' : 'ADD Member'; ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<section class="content">
    <div class="custom-container">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Member ID</th>
                        <th>Email Address</th>
                        <th>First Name</th>
                        <th>Date of Birth</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM member");
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['member_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['birthday']) . "</td>";
                            echo "<td>";
                            echo "<a href='members.php?edit=" . urlencode($row['member_id']) . "' class='btn btn-success'><i class='fa-solid fa-pen-to-square'></i></a> ";
                            echo "<a href='members.php?delete=" . urlencode($row['member_id']) . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this record?\");'><i class='fa-solid fa-trash'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
    
</body>
</html>
