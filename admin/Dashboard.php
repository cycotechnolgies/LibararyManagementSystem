<?php

session_start();

require 'conn.php';

$sql = "
    SELECT 
        (SELECT COUNT(*) FROM member) AS total_members,
        (SELECT COUNT(*) FROM book) AS total_books,
        (SELECT COUNT(*) FROM bookborrower WHERE borrow_status = 'borrowed') AS total_borrowed_books,
        (SELECT COUNT(*) FROM bookcategory) AS total_categories
";

// Execute the query using MySQLi
if ($result = $conn->query($sql)) {
    // Fetch the associative array
    $data = $result->fetch_assoc();

    // Assign the results to variables
    $total_members = $data['total_members'];
    $total_books = $data['total_books'];
    $total_borrowed_books = $data['total_borrowed_books'];
    $total_categories = $data['total_categories'];

    // Free result set
    $result->free();
} else {
    // Handle error
    echo "Error: " . $conn->error;
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
    <title>Dashboard - MyLib</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.12.0/css/all.css"
    />
  </head>
  <body id="page-top">
    <div id="wrapper">
      <nav
        class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark"
        style="background: #f96302"
      >
        <div class="container-fluid d-flex flex-column p-0">
          <a
            class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0"
            href="#"
            ><div class="sidebar-brand-icon rotate-n-15">
              <i class="fas fa-book-open"></i>
            </div>
            <div class="sidebar-brand-text mx-3"><span>MyLib</span></div></a
          >
          <hr class="sidebar-divider my-0" />
          <ul class="navbar-nav text-light" id="accordionSidebar">
            <?php include 'sidebar_item.php'?>
          </ul>
          <div class="text-center d-none d-md-inline"></div>
        </div>
      </nav>
      <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
          <nav class="navbar navbar-expand bg-white shadow mb-4 topbar">
            <div class="container-fluid">
              <button
                class="btn btn-link d-md-none rounded-circle me-3"
                id="sidebarToggleTop"
                type="button"
              >
                <i class="fas fa-bars" style="color: #f96302"></i>
              </button>
              <ul class="navbar-nav flex-nowrap ms-auto">
                <li class="nav-item dropdown no-arrow mx-1"></li>
                <div class="d-none d-sm-block topbar-divider"></div>
                <li class="nav-item dropdown no-arrow">
                <form action="../logout.php" method="POST">
                  <button type="submit" class="btn btn-dark sm:mt-2"><i class="fas fa-sign-out-alt"></i></button>
                </form>
                </li>
              </ul>
            </div>
          </nav>
          <div class="container-fluid">
            <div
              class="d-sm-flex justify-content-between align-items-center mb-4"
            >
              <h3 class="text-dark mb-0">Dashboard</h3>
            </div>
            <div class="row">
              <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-left-primary py-2">
                  <div class="card-body">
                    <div class="row g-0 align-items-center">
                      <div class="col me-2">
                        <div
                          class="text-uppercase text-primary fw-bold text-xs mb-1"
                        >
                          <span>Books</span>
                        </div>
                        <div class="text-dark fw-bold h5 mb-0">
                          <span><?php echo $total_books; ?></span>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-book fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-left-info py-2">
                  <div class="card-body">
                    <div class="row g-0 align-items-center">
                      <div class="col me-2">
                        <div
                          class="text-uppercase text-info fw-bold text-xs mb-1"
                        >
                          <span>Members</span>
                        </div>
                        <div class="row g-0 align-items-center">
                          <div class="col-auto">
                            <div class="text-dark fw-bold h5 mb-0 me-3">
                              <span><?php echo $total_members; ?></span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i
                          class="fas fa-user fa-2x text-gray-300"
                        ></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-left-warning py-2">
                  <div class="card-body">
                    <div class="row g-0 align-items-center">
                      <div class="col me-2">
                        <div
                          class="text-uppercase text-warning fw-bold text-xs mb-1"
                        >
                          <span>Borrowed</span>
                        </div>
                        <div class="text-dark fw-bold h5 mb-0">
                          <span><?php echo $total_borrowed_books; ?></span>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-bookmark fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-left-success py-2">
                  <div class="card-body">
                    <div class="row g-0 align-items-center">
                      <div class="col me-2">
                        <div
                          class="text-uppercase text-success fw-bold text-xs mb-1"
                        >
                          <span>Categories</span>
                        </div>
                        <div class="text-dark fw-bold h5 mb-0">
                          <span><?php echo $total_categories; ?></span>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-clipboard fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="bg-white sticky-footer">
          <div class="container my-auto">
            <div class="text-center my-auto copyright">
              <span>Copyright © MyLib 2024</span>
            </div>
          </div>
        </footer>
      </div>
      <a class="border rounded d-inline scroll-to-top" href="#page-top"
        ><i class="fas fa-angle-up"></i
      ></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/script.min.js"></script>
  </body>
</html>
