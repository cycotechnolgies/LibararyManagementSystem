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
                            <label class="form-label" for="member_id"><strong>Member ID</strong></label>
                            <input id="member_id" class="form-control" type="text" placeholder="M001" name="m_id" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="email"><strong>Email Address</strong></label>
                            <input id="email" class="form-control" type="email" placeholder="user@example.com" name="email" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="first_name"><strong>First Name</strong></label>
                            <input id="first_name" class="form-control" type="text" placeholder="John" name="first_name" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="last_name"><strong>Last Name</strong></label>
                            <input id="last_name" class="form-control" type="text" placeholder="Doe" name="last_name" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="dob"><strong>Date of Birth</strong></label>
                            <input id="dob" class="form-control" type="text" placeholder="2000/05/25" name="dob" />
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary btn-sm" type="submit">ADD</button>
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
                        <th>Member ID</th>
                        <th>Email Address</th>
                        <th>First Name</th>
                        <th>Date of Birth</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Here you would add your PHP logic to generate rows dynamically -->
                    <tr>
                        <td>123</td>
                        <td>user@example.com</td>
                        <td>John</td>
                        <td>2000/05/25</td>
                        <td>
                            <a href="#" class="btn btn-success btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
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
