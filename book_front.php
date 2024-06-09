<?php
require 'dbcon.php';
require 'book_back.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container1">
        <div>
            <div>
                <?php if ($update == true): ?>
                    <h3>Edit Book</h3>
                <?php else: ?>
                    <h1>Add Book</h1>
                <?php endif; ?>
            </div>
        </div>
        <div class="container">
            <div id="error-message" class="error-message" style="color: red;"></div>
            <div id="success-message" class="success-message" style="color: green;"></div>
            <form action="book_back.php" method="POST" onsubmit="return validateForm();">
                <div class="set">
                    <label>Book ID</label>
                    <input type="text" id="book_id" name="book_id" value="<?php echo $book_id; ?>">
                </div>
                <div class="set">
                    <label>Book Name</label>
                    <input type="text" name="book_name" value="<?php echo $book_name; ?>" required>
                </div>
                <div class="set">
                    <label>Category</label>
                    <select name="category_id">
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['category_id']; ?>" <?php if ($category_id == $category['category_id']) echo 'selected'; ?>>
                                <?php echo $category['category_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br><br>
                <div class="set">
                    <?php if ($update == true): ?>
                        <button type="submit" name="update" class="btn btn-warning">Update</button>
                    <?php else: ?>
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    <section class="content">
        <?php if (isset($_SESSION['message'])): ?>
            <div>
                <?php 
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>
        <div class="container2">
            <h1>Book Details</h1>
            <div class="container" style="margin-bottom:5em;">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Book ID</th>
                            <th>Book Name</th>
                            <th>Book Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $database->query("SELECT * FROM book");
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $row['book_id']; ?></td>
                                    <td><?php echo $row['book_name']; ?></td>
                                    <td><?php echo $row['category_id']; ?></td>
                                    <td>
                                        <a href="book_front.php?edit=<?php echo $row['book_id']; ?>" class="btn btn-success">Edit</a>
                                        <a href="book_back.php?delete=<?php echo $row['book_id']; ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='6'>No records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>
