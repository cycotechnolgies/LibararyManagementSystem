<?php
session_start();
include 'borrow.back.inc.php';
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
            <form action="borrow.php" method="POST">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="member_id"><strong>Borrow ID</strong></label>
                            <input id="" class="form-control" type="text" placeholder="BR001" name="borrow_id" value="<?php echo $update ? htmlspecialchars($borrow_id) : htmlspecialchars($newBorrowId); ?>" readonly/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="mid"><strong>Member ID</strong></label>
                            <input id="" class="form-control" type="text" placeholder="M001" name="member_id" value="<?php echo $update ? htmlspecialchars($member_id) : ''; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="book_id"><strong>Book ID</strong></label>
                            <input id="" class="form-control" type="text" placeholder="John" name="book_id" value="<?php echo $update ? htmlspecialchars($book_id) : ''; ?>"/>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="status"><strong>Status</strong></label>
                            <select class="form-select" name="borrow_status" id="status">
                                <option value="Borrowed">Borrowed</option>
                                <option value="Available">Available</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3 d-flex justify-content-end">
                    <button class="btn btn-primary btn-md" type="submit" name="<?php echo $update ? 'update' : 'AddBorrow'; ?>">
                        <?php echo $update ? 'Update' : 'ADD Borrow'; ?>
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
                        <th>Borrow ID</th>
                        <th>Book ID</th>
                        <th>member ID</th>
                        <th>Status</th>
                        <th>Date Modified</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT *, DATE(borrower_date_modified) AS date_modified
                    FROM bookborrower;");
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['borrow_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['book_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['member_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['borrow_status']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['date_modified']) . "</td>";
                            echo "<td>";
                            echo "<a href='borrow.php?edit=" . urlencode($row['borrow_id']) . "' class='btn btn-success'><i class='fa-solid fa-pen-to-square'></i></a> ";
                            echo "<a href='borrow.php?delete=" . urlencode($row['borrow_id']) . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this record?\");'><i class='fa-solid fa-trash'></i></a>";
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
