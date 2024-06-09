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
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="member_id"><strong>Borrow ID</strong></label>
                            <input id="book_id" class="form-control" type="text" placeholder="B001" name="b_id" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="mid"><strong>Member ID</strong></label>
                            <input id="mid" class="form-control" type="text" placeholder="M001" name="m_id" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="book_id"><strong>Book ID</strong></label>
                            <input id="book_id" class="form-control" type="text" placeholder="John" name="book_id" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="status"><strong>Status</strong></label>
                            <select class="form-select" name="status" id="status">
                                <option value="Borrowed">Borrowed</option>
                                <option value="Returned">Available</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary btn-sm" type="submit">Process</button>
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
                    <!-- Here you would add your PHP logic to generate rows dynamically -->
                    <tr>
                        <td>BR001</td>
                        <td>user@example.com</td>
                        <td>John</td>
                        <td>Borrowed</td>
                        <td>2000/05/25</td>
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
