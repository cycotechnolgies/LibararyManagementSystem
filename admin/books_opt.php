<<<<<<< Updated upstream
=======
<?php
require 'conn.php';
require 'book_reg_back.php';
?>
>>>>>>> Stashed changes
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< Updated upstream
</head>
<body>

<div class="row">
    <div class="card shadow mb-3">
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="book_id"><strong>Book ID</strong></label>
                            <input id="book_id" class="form-control" type="text" placeholder="John" name="book_id" required/>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="book_name"><strong>Book Name</strong></label>
                            <input id="book_name" class="form-control" type="text" placeholder="Doe" name="book_name" required/>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="category"><strong>Category</strong></label>
                            <select class="form-select" name="category" id="category" required>
                                <option value="">-- select a category --</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary btn-md" type="submit">ADD Book</button>
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
                    <!-- Here you would add your PHP logic to generate rows dynamically -->
                    <tr>
                        <td>B001</td>
                        <td>Harry Potter</td>
                        <td>Scifi</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>
                                <button  class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <!-- Repeat this row structure for each member -->
                </tbody>
            </table>
        </div>
    </div>
</section>

    
=======
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
                <form action="books.php" method="POST" onsubmit="return validateForm()">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="book_id"><strong>Book ID</strong></label>
                                <input id="book_id" class="form-control" type="text" placeholder="B001" name="book_id" value="<?php echo $book_id; ?>" required/>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="book_name"><strong>Book Name</strong></label>
                                <input id="book_name" class="form-control" type="text" placeholder="Book Name" name="book_name" value="<?php echo $book_name; ?>" required/>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="category_id"><strong>Category</strong></label>
                                <select class="form-select" name="category_id" id="category_id" required>
                                    <option value="">-- select a category --</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo $category['category_id']; ?>" <?php if ($category_id == $category['category_id']) echo 'selected'; ?>>
                                            <?php echo $category['category_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary btn-md" type="submit" name="<?php echo $update ? 'update' : 'save'; ?>">
                            <?php echo $update ? 'Update' : 'ADD Book'; ?>
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
                        $result = $conn->query("SELECT * FROM book");
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $row['book_id']; ?></td>
                                    <td><?php echo $row['book_name']; ?></td>
                                    <td><?php echo $row['category_id']; ?></td>
                                    <td>
                                        <a href="books.php?edit=<?php echo $row['book_id']; ?>" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="books.php?delete=<?php echo $row['book_id']; ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
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

<script>
function validateForm() {
    const bookIDElement = document.getElementById('book_id');
    
    if (!bookIDElement) {
        alert('Book ID element not found');
        return false;
    }
    
    const bookID = bookIDElement.value;
    const bookIDPattern = /^B\d{3}$/;  // Pattern: Starts with 'B' followed by exactly three digits
    
    if (!bookIDPattern.test(bookID)) {
        alert('Book ID should be in the format B001');
        return false;
    }
    return true;
}
</script>

>>>>>>> Stashed changes
</body>
</html>
