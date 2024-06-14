


<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    />
    <title>Book Borrow - MyLib</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css" />
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
              <h3 class="text-dark mb-0">Borrows</h3>
            </div>
            <div>
              <?php
                include 'borrows_opt.php';
              ?>
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
    <script src=""></script>
  </body>
</html>
