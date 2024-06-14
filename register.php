<?php
require 'assets/conn.php'; 

$error = ""; 
$success = false; 

// Get the last member ID from the database
$sql = 'SELECT MAX(CAST(SUBSTRING(member_id, 2) AS UNSIGNED)) AS last_member_id FROM member';
$stmt = $conn->prepare($sql);
$stmt->execute();
$lastMemberID = $stmt->fetch(PDO::FETCH_ASSOC)['last_member_id'];

// Increment the last member ID
$memberid = 'M' . sprintf('%03d', $lastMemberID + 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $dob = $_POST['Dob'];
    $member_id = $_POST['m_id'];

    // Validate inputs
    if (!preg_match('/^M\d{3}$/', $member_id)) {
        $error = "Invalid Member ID format. Must be in the format 'M<3-digit-number>' e.g., 'M001'.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Check for existing email
        $sql = 'SELECT * FROM member WHERE email = :email';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $existingEmail = $stmt->fetch();

        if ($existingEmail) {
            $error = "Email already registered.";
        } else {
            // Insert the new user
            $sql = 'INSERT INTO member (member_id, first_name, last_name, birthday, email) 
                    VALUES (:member_id, :first_name, :last_name, :dob, :email)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':member_id', $member_id);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':dob', $dob);
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                $success = true; // Set success flag
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register - MyLib</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert2 -->
</head>
<body class="bg-gradient-primary" style="background: #f96302">
    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-flex">
                        <div class="flex-grow-1 bg-register-image" style="background: url('assets/img/book.png') center / cover"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Create an Account!</h4>
                            </div>
                            <form class="user" method="post" action="">
                                <div class="mb-3">
                                    <input class="form-control form-control-user" type="text" id="userIdInput" placeholder="Member ID (e.g., M001)" name="m_id" value="<?= $memberid ?>" readonly>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input class="form-control form-control-user" type="text" id="exampleFirstName-1" placeholder="First Name" name="first_name" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-user" type="text" id="exampleLastName-1" placeholder="Last Name" name="last_name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input class="form-control form-control-user" type="email" id="inputEmail" placeholder="Email" name="email" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-user" type="text" id="inputDob" placeholder="Date of Birth" name="Dob">
                                    </div>
                                </div>
                                <button class="btn btn-primary d-block btn-user w-100" type="submit" style="background: #f74902; font-weight: bold">
                                    Register Account
                                </button>
                                <hr>
                            </form>
                            <div class="text-center"></div>
                            <div class="text-center">
                                <a class="small" href="index.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if ($success): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Registration Successful!',
                text: 'Your account has been created successfully.',
                showConfirmButton: true,
                confirmButtonText: 'OK',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'index.php'; // Redirect to login page
                }
            });
        </script>
    <?php elseif ($error != ""): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?= $error ?>',
            });
        </script>
    <?php endif; ?>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>
</html>
