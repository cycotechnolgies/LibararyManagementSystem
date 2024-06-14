<?php
session_start();
include 'staff.back.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Staff Management</title>
</head>
<body>

<div class="container mt-5">
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
            <form action="staff.php" method="POST" onsubmit="return validateForm()">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-3">
                        <label class="form-label" for="user_id"><strong>User ID</strong></label>
                        <input id="user_id" class="form-control" type="text" value="<?php echo $update ? htmlspecialchars($user_id) : htmlspecialchars($newUserId); ?>" name="user_id" readonly />
                    </div>
                    <div class="col-lg-6 col-md-12 mb-3">
                        <label class="form-label" for="user_name"><strong>User Name</strong></label>
                        <input id="user_name" class="form-control" type="text" placeholder="Saman_kumara" value="<?php echo $update ? htmlspecialchars($userName) : ''; ?>" name="user_name" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 mb-3">
                        <label class="form-label" for="first_name"><strong>First Name</strong></label>
                        <input id="first_name" class="form-control" type="text" placeholder="John" name="first_name" value="<?php echo $update ? htmlspecialchars($first_name) : ''; ?>" required />
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3">
                        <label class="form-label" for="last_name"><strong>Last Name</strong></label>
                        <input id="last_name" class="form-control" type="text" placeholder="Doe" name="last_name" value="<?php echo $update ? htmlspecialchars($last_name) : ''; ?>" required />
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3">
                        <label class="form-label" for="email"><strong>Email</strong></label>
                        <input id="email" class="form-control" type="email" placeholder="email@example.com" name="email" value="<?php echo $update ? htmlspecialchars($email) : ''; ?>" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-3">
                        <label class="form-label" for="password"><strong>Password</strong></label>
                        <input id="password" class="form-control" type="password" placeholder="********" name="pwd" <?php echo $update ? '' : 'required'; ?> />
                    </div>
                    <div class="col-lg-6 col-md-12 mb-3">
                        <label class="form-label" for="confirm_password"><strong>Confirm Password</strong></label>
                        <input id="confirm_password" class="form-control" type="password" placeholder="********" name="cpwd" <?php echo $update ? '' : 'required'; ?> />
                    </div>
                </div>
                <div class="mb-3 d-flex justify-content-end">
                    <button class="btn btn-primary btn-md" type="submit" name="<?php echo $update ? 'update' : 'AddStaff'; ?>">
                        <?php echo $update ? 'Update' : 'ADD Staff'; ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<section class="content mt-5">
    <div class="container">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM user");
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                            echo "<td>";
                            echo "<a href='staff.php?edit=" . urlencode($row['user_id']) . "' class='btn btn-success'><i class='fa-solid fa-pen-to-square'></i></a> ";
                            echo "<a href='staff.php?delete=" . urlencode($row['user_id']) . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this record?\");'><i class='fa-solid fa-trash'></i></a>";
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

<script>
function validateForm() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

    if (password && password.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false;
    }

    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
    }

    return true;
}
</script>
</body>
</html>
