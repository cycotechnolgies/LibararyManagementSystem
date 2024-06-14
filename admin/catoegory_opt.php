<?php
session_start();
require 'conn.php';
require 'category.back.inc.php';
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
<div class="container">
    <div class="row">
        <div class="card shadow mb-3">
            <div class="card-body">
                <div class="errormessage">
                    <?php if (isset($_SESSION['message'])): ?>
                        <div class="alert alert-<?php echo $_SESSION['msg_type']; ?>">
                            <?php 
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
                <form action="category.php" method="POST">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mb-3">
                            <div class="mb-3">
                                <label class="form-label" for=""><strong>Category ID</strong></label>
                                <input id="" class="form-control" type="text" placeholder="C001" name="category_id" value="<?php echo $update ? htmlspecialchars($category_id) : htmlspecialchars($newCategoryId);?>" readonly required/>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 mb-3">
                            <div class="mb-3">
                                <label class="form-label" for=""><strong>Category Name</strong></label>
                                <input id="" class="form-control" type="text" placeholder="Category Name" name="category_name" value="<?php echo $update && isset($category_name) ? htmlspecialchars($category_name) : ''; ?>" required/>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 mb-3">
                            <div class="mb-3">
                                <label class="form-label" for=""><strong>Updated Date</strong></label>
                                <input id="" class="form-control" type="text" placeholder="Category Name" name="upt_date" value="<?php echo htmlspecialchars($date_modified); ?>" readonly required/>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary btn-md" type="submit" name="<?php echo $update ? 'update' : 'AddCategory'; ?>">
                            <?php echo $update ? 'Update' : 'ADD Category'; ?>
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
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT * FROM bookcategory");
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $row['category_id']; ?></td>
                                    <td><?php echo $row['category_Name']; ?></td>
                                    <td><?php echo $row['date_modified']; ?></td>
                                    <td>
                                        <a href="category.php?edit=<?php echo $row['category_id']; ?>" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="category.php?delete=<?php echo $row['category_id']; ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php
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
</div>
</body>
</html>
