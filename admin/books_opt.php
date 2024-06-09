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

    
</body>
</html>
