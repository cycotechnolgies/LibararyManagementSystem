<?php
require 'assets/conn.php';

session_start();

$error = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    if (empty($email) || empty($pwd)) {
        $error = "Please fill in all fields.";
    } else {
        $sql = 'SELECT user_id, email, password FROM user WHERE email = :email';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            $hash = $user['password'];
            if (password_verify($pwd, $hash)) {
                $_SESSION['user_id'] = $user['user_id']; 
                $_SESSION['user_email'] = $user['email'];
                header('Location: admin/Dashboard.php');
                exit;
            } else {
                $error = "Invalid Password..!";
            }
        } else {
            $error = "Invalid email..!";
        }
    }
}
?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    />
    <title>Login - MyLib</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap"
    />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body class="bg-gradient-primary" style="background: #f74902">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-9 col-lg-12 col-xl-10">
          <div class="card shadow-lg o-hidden border-0 my-5">
            <div class="card-body p-0">
              <div class="row">
                <div class="col-lg-6 d-none d-lg-flex">
                  <div
                    class="flex-grow-1 bg-login-image"
                    style="background: url('assets/img/lib.jpg') center / cover"
                  ></div>
                </div>
                <div class="col-lg-6">
                  <div class="p-5">
                    <div class="text-center">
                      <h4 class="text-dark mb-4">Welcome Back!</h4>
                    </div>
                    <?php
                      if ($error != "") {
                        echo "
                          <script>
                            Swal.fire({
                              icon: 'error',
                              title: 'Oops...',
                              text: '$error',
                            });
                          </script>
                        ";
                      }
                    ?>
                    <form class="user" method="post" action="">
                      <div class="mb-3">
                        <input
                          class="form-control form-control-user"
                          type="email"
                          id="InputEmail"
                          aria-describedby="emailHelp"
                          placeholder="Email Address"
                          name="email"
                          required
                        />
                      </div>
                      <div class="mb-3">
                        <input
                          class="form-control form-control-user"
                          type="password"
                          id="InputPassword"
                          placeholder="Password"
                          name="password"
                          required
                        />
                      </div>
                      <div class="mb-3">
                        <div class="custom-checkbox small">
                          <div class="form-check">
                            <input
                              class="form-check-input"
                              type="checkbox"
                              id="formCheck-1"
                            /><label class="form-check-label" for="formCheck-1"
                              >Remember Me</label
                            >
                          </div>
                        </div>
                      </div>
                      <button
                        class="btn btn-primary d-block btn-user w-100"
                        name="login"
                        type="submit"
                        style="
                          background: #f74902;
                          font-weight: bold;
                          font-size: 15.8px;
                        "
                      >
                        Login
                      </button>
                      <hr />
                    </form>
                    <div class="text-center"></div>
                    <div class="text-center">
                      <a class="small" href="register.php"
                        >Create an Account!</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
  </body>
</html>
