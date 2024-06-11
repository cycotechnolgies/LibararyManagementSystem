<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="row">
    <div class="card shadow mb-3">
        <div class="card-body">
            <form method="POST" action="process_borrow.php">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="borrow_id"><strong>Borrow ID</strong></label>
                            <input id="borrow_id" class="form-control" type="text" placeholder="BR001" name="borrow_id" value="<?php echo isset($borrow_id) ? $borrow_id : ''; ?>" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="member_id"><strong>Member ID</strong></label>
                            <input id="member_id" class="form-control" type="text" placeholder="M001" name="member_id" value="<?php echo isset($member_id) ? $member_id : ''; ?>" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="book_id"><strong>Book ID</strong></label>
                            <input id="book_id" class="form-control" type="text" placeholder="B001" name="book_id" value="<?php echo isset($book_id) ? $book_id : ''; ?>" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="borrow_status"><strong>Status</strong></label>
                            <select class="form-select" name="borrow_status" id="borrow_status">
                                <option value="Borrowed" <?php echo isset($borrow_status) && $borrow_status == 'Borrowed' ? 'selected' : ''; ?>>Borrowed</option>
                                <option value="Returned" <?php echo isset($borrow_status) && $borrow_status == 'Returned' ? 'selected' : ''; ?>>Returned</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary btn-sm" type="submit" name="add">Add</button>
                    <button class="btn btn-success btn-sm" type="submit" name="update">Update</button>
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
                        <th>Member ID</th>
                        <th>Status</th>
                        <th>Date Modified</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'conn.php';
                    $sql = "SELECT * FROM bookborrower";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['borrow_id']}</td>
                                    <td>{$row['book_id']}</td>
                                    <td>{$row['member_id']}</td>
                                    <td>{$row['borrow_status']}</td>
                                    <td>{$row['borrower_date_modified']}</td>
                                    <td>
                                        <form method='POST' action='process_borrow.php' style='display:inline-block'>
                                            <input type='hidden' name='borrow_id' value='{$row['borrow_id']}'>
                                            <button class='btn btn-success btn-sm' type='submit' name='edit'><i class='fas fa-edit'></i> Edit</button>
                                        </form>
                                        <form method='POST' action='process_borrow.php' style='display:inline-block'>
                                            <input type='hidden' name='borrow_id' value='{$row['borrow_id']}'>
                                            <button class='btn btn-danger btn-sm' type='submit' name='delete'><i class='fas fa-trash'></i> Delete</button>
                                        </form>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No records found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
</body>
</html>
